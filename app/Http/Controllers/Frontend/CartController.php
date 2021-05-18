<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CartModel;
use App\Models\Backend\OrderDetailModel;
use App\Models\Backend\OrderModel;
use App\Models\Backend\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class CartController extends Controller
{
    //

    public function shareKey()
    {
        $cart = new CartModel();
        $totalQttCart = $cart->getTotalQuantity();
        $totalPriceCart = $cart->getTotalPrice();
        view()->share('totalQttCart', $totalQttCart);
        view()->share('totalPriceCart', $totalPriceCart);
    }


    public function index(){
        $this->shareKey();
        $data = [];
        $cart = new CartModel();
        $data["cart"] =  $cart->getItems();

        $cartIds = [];
        foreach($data["cart"] as $id => $valCart) {
            $cartIds[] = $id;
        }
        $products = DB::table("products")->whereIn("id", $cartIds)->get();

        $data["products"] = $products;
        return view("frontend.cart", $data);

    }


    public function payment(){

        $this->shareKey();

        $cart = new CartModel();
        $data['cart'] = $cart->getItems();

        $cartIds = [];
        foreach ($data['cart'] as $id=>$valCart){
            $cartIds[] = $id;

        }
        $products  = DB::table("products")->whereIn("id",$cartIds)->get();
        $data["products"] = $products;

        return view("frontend.payment", $data);

    }

    public function checkout(Request $request){

        $this->shareKey();
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'order_note' => 'required',
        ]);

        // lấy thông tin khách hàng
        $customer_name = $request->get("customer_name", "");
        $customer_address = $request->get("customer_address", "");
        $customer_phone = $request->get("customer_phone", "");
        $customer_email = $request->get("customer_email", "");
        $order_note = $request->get("order_note", "");


        // lây ra thông tin từ giỏ hàng
        $cart = new CartModel();
        $data["cart"] =  $cart->getItems();

        // insert đơn hàng
        $order = new OrderModel();

        $order->customer_name = $customer_name;
        $order->customer_email = $customer_email;
        $order->customer_phone = $customer_phone;
        $order->customer_address = $customer_address;
        $order->order_status = 1;
        $order->order_note = $order_note;


        foreach ($data["cart"] as $id =>$valCart ){

            $cartIds[] = $id;
            $quantity = $valCart[0]['quantity'];
            $product = ProductsModel::find($id);
            $totalPriceProduct = $quantity* $product->product_price;

            $order->total_product += $quantity;
            $order->total_price +=$totalPriceProduct;


        }
           $order->save();
            // thêm chi tiết đơn hàng
           foreach($data["cart"] as $id => $valCart) {

            $quantity = $valCart[0]['quantity'];
            $product = ProductsModel::find($id);

            $orderDetail = new OrderDetailModel();

            $orderDetail->product_id = $id;
            $orderDetail->product_price = $product->product_price;
            $orderDetail->quantity = $quantity;
            $orderDetail->order_id = $order->id;
            $orderDetail->order_status = 1;
            $orderDetail->save();
        }

        $cart->clearCart();

        return redirect("/aftercheckout")->with('status',"Thêm vào đơn hàng thành công ");

    }

    public function add(Request $request) {

        $this->shareKey();
        $cart = new CartModel();
        $id = $request->get("id", 0);
        $quantity = $request->get("quantity", 1);
        $attributes = $request->get("attributes", []);
        $cart->addCart($id, $quantity, $attributes);

        // response json
        $msg = ["text" => "thêm sản phẩm thành công"];
        return response()->json($msg, 200);
    }


    public function update(Request $request){

        $this->shareKey();
        $cart = new CartModel();
        $id = $request->get("id",0);
        $quantity = $request->get('quantity', 1);
        $attributes = $request->get("attributes", []);
        $cart ->updateCart($id,$quantity,$attributes);

        $msg= ['text' => "Cập nhật giỏ hàng thành công"];
        return response()->json($msg,200);

    }

    public function remove(Request $request){

        $this->shareKey();

        $cart = new CartModel();
        $id = $request->get("id", 0 );
        $attributes= $request->get("attributes", []);
        $cart->removeCart($id, $attributes);

        //response json

        $msg= ["text" => "Xóa sản phẩm thành công"];

        return response()->json($msg,200);
    }

    public function clear(){

        $this->shareKey();
        $cart = new CartModel();
        $cart ->clearCart();

        $msg = ['text' => "xÓA GIỎ HÀNG THÀNH CÔNG"];

        return response()->json($msg,200);

    }

    public function aftercheckout(){
        $this->shareKey();
        return view("frontend.aftercheckout");
    }

       

}
?>
