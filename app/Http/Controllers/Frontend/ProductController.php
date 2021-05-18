<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductsModel;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{

    public  function shareKey(){
        $cart = new CartModel();
        $totalQttCart = $cart->getTotalQuantity();
        $totalPriceCart = $cart->getTotalPrice();
        view()->share('totalQttCart', $totalQttCart);
        view()->share('totalPriceCart', $totalPriceCart);

    }

    public function index($id){

        $product = ProductsModel::find($id);

        $data['product'] = $product;
        return view("frontend.single-product", $data);

    }

    public function shop(){

        $data = [];
        $products = DB::table('products')->orderBy("product_price","desc")->get();
        $data['products'] = $products;

        return view("frontend.shop", $data);
    }


    public function category($id){

        $this->shareKey();
        $category = DB::table('category')->where("id", "=", $id)->first();
        $categories = DB::table('category')->get();
        $discountProducts =ProductsModel::where("category_id", "=", $id)->orderBy("product_price")->limit(10)->get();


        $data = [];
        $data['categories'] = $categories;
        $data['category']= $category;
        $data['discountProducts'] = $discountProducts;

        return view("frontend.product-category",$data);

    }

}
