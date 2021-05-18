<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\CategoryModel;
use App\Models\Backend\ProductsModel;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function index(Request $request){

        //    $category  = CategoryModel::all();

        $sort = $request->query('category_sort', "");

        $searchKeyword = $request->query('category_name','');
        // $category = DB::table('category')->paginate(10);

        // $category =CategoryModel::where('name',"LIKE","%".$searchKeyword."%")->paginate(10);
        $queryORM = CategoryModel::where('name', "LIKE", "%".$searchKeyword."%");


        if($sort == "id_asc"){
            $queryORM ->orderBy('id','asc');

        }
        if($sort == "id_desc"){
            $queryORM->orderBy('id','desc');

        }
        $category = $queryORM->paginate(10);
        // truyền xuống view
        $data = [];
        $data['category'] = $category;

        // truyền keyword search xuống view

        $data["searchKeyword"] = $searchKeyword;
        $data['sort'] = $sort;
        return view("backend.category.index",$data);


    }
    public  function create(){
        return view("backend.category.create");

    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => ' required',
            'slug' =>'required',
            'desc' => 'required',
            'image'=> 'required'

        ]);
        $name = $request->input('name', '');
        $slug = $request->input('slug', '');
        $desc = $request->input('desc', '');

        $pathCategoryImage = $request->file('image')->store('public/productimages');
        //    var_dump($pathCategoryImage);
        //         die;
        $category = new CategoryModel();
        $category->name = $name;
        $category->slug = $slug;
        $category->desc = $desc;
        $category->image = $pathCategoryImage;

        $category->save();


        return redirect("/backend/category/index")->with('status', 'thêm sản phẩm thành công !');

    }
    public function edit(Request $request,$id){
        $category = CategoryModel::findOrFail($id);

        $data = [];
        $data['category'] = $category;

        return view("backend.category.edit",$data);
    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name'=> 'required',
            'image'=>'required',
            'slug' => 'required',
            'desc' => 'required'
        ]);

        $name = $request->input("name", '');
        $slug = $request->input("slug", "");
        $desc = $request->input("desc", '');

        $category = CategoryModel::findOrFail($id);

        $category->name = $name;
        $category->slug = $slug;
        $category->desc = $desc;

        if ($request->hasFile('image')){
            $pathCategoryImage = $request->file('image')->store("public/productimages");
            $category->image = $pathCategoryImage;
        }
        $category->save();

        return redirect("backend/category/edit/$id")->with("status","Cập nhật danh mục thành công");

    }

    public function delete($id){

        $category = CategoryModel::findOrFail($id);
        $data = [];
        $data['category'] = $category;

        return view("backend.category.delete",$data);
    }

    public function destroy($id){

        $countProducts = DB::table('products')->count();
        if ($countProducts>0){
            return  redirect("/backend/category/index")->with("status","Xóa tất cả các sản phẩm thuộc danh mục  này trước khi xóa danh mục");

        }

        $category = CategoryModel::findOrFail($id);
        $category->delete();

        return redirect("backend/category/index")->with("status","Xóa danh mục thành công");


    }
}
