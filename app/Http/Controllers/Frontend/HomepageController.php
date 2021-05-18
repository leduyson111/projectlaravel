<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\CategoryModel;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
      public function shareKey()
    {
        $cart = new CartModel();
        $totalQttCart = $cart->getTotalQuantity();
        $totalPriceCart = $cart->getTotalPrice();
        view()->share('totalQttCart', $totalQttCart);
        view()->share('totalPriceCart', $totalPriceCart);
    }

    public function index() {

        $this->shareKey();


        $categories = DB::table("category")->get();
        $data = ["categories" => $categories ];
      
        $producta = [];
            $producta = DB::table("products")->orderBy('id', 'desc')->take(8)->get();
            $productPrice  = DB::table('products')->orderBy('product_price','desc')->take(8)->get();

        $data["producta"] = $producta;
        $data['productPrice']  = $productPrice;

        $cart = new CartModel();
        $data["cart"] =  $cart->getItems();
        $cartIds = [];
        foreach($data["cart"] as $id => $valCart) {
            $cartIds[] = $id;
        }
        $products = DB::table("products")->whereIn("id", $cartIds)->get();
        $data['products']  = $products;

        return view("frontend.home2", $data);
    }

 

}
