<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductsModel;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;


class ProductsController extends Controller
{
    //

    public function index(Request $request){

     // $products = ProductsModel::all();
     // $products = DB::table('products')->paginate(10);

        $sort = $request->query("product_sort","");

        $searchKeyword = $request->query('product_name',"");
        $productStatus = (int)$request->query("product_status","");
        $allProductStatus = [1,2];

        $queryORM = ProductsModel::where('product_name',"LIKE","%".$searchKeyword."%");
        if (in_array($productStatus,$allProductStatus)){
            $queryORM = $queryORM->where('product_status',$productStatus);
        }
        if ($sort=="price_asc"){
            $queryORM->orderBy("product_price","asc");
        }

        if ($sort=="price_desc"){
            $queryORM->orderBy("product_price","desc");
        }

        if ($sort=="quantity_asc"){
            $queryORM->orderBy("product_quantity","asc");
        }
        if ($sort=="quantity_desc"){
            $queryORM->orderBy("product_quantity","desc");
        }
        $products= $queryORM->paginate(10);

//        $products = ProductsModel::where('product_name',"LIKE","%".$searchKeyword."%")->paginate(10);

        $data = [];
        $data['products'] = $products;

        // truyền keywword xuống view
        $data['searchKeyword'] = $searchKeyword;
        $data['productStatus'] =$productStatus;
        $data['sort'] = $sort;

        return view("backend.products.index",$data);

    }

    public function create(){
        $data = [];
        $categories = DB::table('category')->get();
        $data['categories'] = $categories;

//        echo "<pre>";
//        print_r($categories);
//        echo "</pre>";
        return view("backend.products.create",$data);

    }

    public function delete($id){


        $product = ProductsModel::findOrFail($id);

        // truyền dự liệu xg view
        $data = [];
        $data['product'] = $product;

        return view("backend.products.delete",$data);

    }

    public function destroy($id){

        echo "<br>" .$id;
        /// lấy đối tượng model dựa trên biến $id
        $product = ProductsModel::findOrFail($id);
        $product->delete();

        return redirect("/backend/product/index")->with("status","Xóa sản phẩm thành công !");

    }

    public function edit($id){
        $product = ProductsModel::findOrFail($id); // để lấy 1 sản phẩm từ ProductsModel dựa theo id chúng ta lấy được từ router

        //truyền dữ liệu xuống view
        $data = [];

        $categories = DB::table('category')->get();

        $data['categories'] = $categories;
        // echo "<pre>";
        // print_r($categories);
        // echo "</pre>";
        $data['product'] = $product;

        // echo "<pre>";
        // print_r($product);
        // echo "</pre>";
        return view("backend.products.edit",$data);

    }
    // phương thức sẽ nhập data post đi và cập nhật vào trong csdl
    public function update(Request $request,$id){
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";

        // validate dữ liệu

        $validatedData = $request->validate([
            'product_name' => "required",
            'category_id' => "required",
            'product_desc' => "required",
            'product_publish'=> "required",
            'product_quantity' => "required",
            "product_price" => "required",
        ]);

        $product_name = $request->input('product_name',"");
        $category_id = $request->input("category_id", 0);

        $product_status = $request->input("product_status",1);
        $product_desc = $request->input("product_desc","");

        $product_publish = $request->input("product_publish","");
        $product_quantity = $request->input("product_quantity",0);
        $product_price = $request->input("product_price",0);

        // khi $product_publish không được nhập dữ liệu
        // ta gán giá trị là thời gian hiện tại theo dang Y-m-d H:i:s

        if(!$product_publish){
            $product_publish = date("Y-m-d H:i:s");

        }
        // lấy đối tượng model dữ trên biến id
        $product =  ProductsModel::findOrFail($id);

        // gán dữ liệu từ request cho thuộc tính của biến $product
        // $product là đối tượng khởi tạo từ model ProductModel

        $product->product_name = $product_name;
        $product->category_id =$category_id;

        $product->product_status = $product_status;
        $product->product_desc = $product_desc;
        $product->product_publish = $product_publish;
        $product->product_quantity = $product_quantity;
        $product->product_price = $product_price;

     // upload ảnh
        if ($request->hasFile('product_image')){  // hasFile nếu người dùng upload ảnh mời thì sẽ load ảnh mới lên nếu kh load thi vẫn giữ nguyên ảnh cũ

            $pathProductImage  = $request->file('product_image')->store("public/productimages");
            $product->product_image =$pathProductImage;

        }
        // lưu sản phẩm
        $product->save();

        // chuyển hướng về trang /backend/product/edit/id
        return redirect("/backend/product/edit/$id")->with('status', 'cập nhật sản phẩm thành công !');

    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'product_name' => "required",
            'product_desc' => "required",
            'product_image'=> "required",
            'product_quantity' => "required",
            "product_price" => "required",
        ]);



        $product_name = $request->input('product_name',"");
        $product_status = $request->input("product_status",1);

        $category_id = $request->input("category_id",0);


        $product_desc =$request->input('product_desc',"");
        $product_publish = $request->input('product_publish',"");
        $product_quantity =$request->input("product_quantity",0);
        $product_price = $request->input("product_price",0);

        $pathProductImage = $request->file('product_image')->store('public/productimages');

//        var_dump($pathProductImage);
//        die();
        $product = new ProductsModel();

        // khi $product_publish không được nhập dữ liệu
        // ta sẽ gán giá trị là thời gian hiện tại theo dang Y-M-D H:I:S
        if (!$product_publish){
            $product_publish = date('Y-m-d H:i:s');
        }
        // gán dữ liệu từ request  cho các thuộc tính của biến $product
        //$product là đối tượng khởi tạo model ProductModel
        $product->product_name  = $product_name;
        $product->category_id =$category_id;

        $product->product_status = $product_status;
        $product->product_desc = $product_desc;
        $product->product_publish = $product_publish;
        $product->product_quantity = $product_quantity;
        $product->product_price = $product_price;

        // gắn tạm image là rỗng vì ta chưa load ảnh lên
        $product->product_image = $pathProductImage;


        // lưu sản phẩm
        $product->save();


        // thêm sản phẩm thanh công sẽ chuyển hương sang trang index

        return redirect("/backend/product/index")->with('status',"Thêm sản phẩm thành công !");



    }

}
