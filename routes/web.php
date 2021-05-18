<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/fronend', "Frontend\HomepageController@index");
Route::get('/fronend/singleproduct', "Frontend\HomepageController@singleProduct");
Route::get('/cart', "Frontend\CartController@index");
Route::post('/cart/add',"Frontend\CartController@add");
Route::post('/cart/update',"Frontend\CartController@update");
Route::post('/cart/remove',"Frontend\CartController@remove");
Route::post('/cart/clear', "Frontend\CartController@clear");
Route::get('/payment', "Frontend\CartController@payment");
Route::get('/aftercheckout', "Frontend\CartController@aftercheckout");

Route::post('/payment/checkout', "Frontend\CartController@checkout");







Route::get('/backend', "Backend\DashboardController@index")->middleware('backendauth');
Route::get("/backend/product/index","Backend\ProductsController@index")->middleware('backendauth');
Route::get("/backend/product/create","Backend\ProductsController@create");
Route::get("/backend/product/delete/{id}","Backend\ProductsController@delete")->middleware('backendauth');
Route::get("/backend/product/edit/{id}","Backend\ProductsController@edit")->middleware('backendauth');

// lưu sản phẩm
Route::post("/backend/product/store","Backend\ProductsController@store")->middleware('backendauth');

// cập nhật sản phẩm
Route::post('backend/product/update/{id}',"Backend\ProductsController@update")->middleware('backendauth');

// xóa sản phẩm thực
Route::post('/backend/product/destroy/{id}', "Backend\ProductsController@destroy")->middleware('backendauth');

Route::get("/backend/category/index","Backend\CategoryController@index")->middleware('backendauth');
Route::get("/backend/category/create","Backend\CategoryController@create")->middleware('backendauth');
Route::get("/backend/category/delete/{id}","Backend\CategoryController@delete")->middleware('backendauth');


Route::get("/backend/category/edit/{id}","Backend\CategoryController@edit")->middleware('backendauth');

Route::post("/backend/category/store","Backend\CategoryController@store")->middleware('backendauth');

Route::post("/backend/category/update/{id}","Backend\CategoryController@update")->middleware('backendauth');
// xóa danh mục thật

Route::post("/backend/category/destroy/{id}","Backend\CategoryController@destroy")->middleware('backendauth');

Route::get("/backend/orders/index","Backend\OrderController@index")->middleware('backendauth');

Route::get("/backend/orders/create","Backend\OrderController@create")->middleware('backendauth');

Route::get("/backend/orders/edit/{id}","Backend\OrderController@edit")->middleware('backendauth');
Route::get("/backend/orders/delete/{id}","Backend\OrderController@delete")->middleware('backendauth');
Route::post("/backend/orders/store","Backend\OrderController@store")->middleware('backendauth');
Route::post("/backend/orders/update/{id}","Backend\OrderController@update")->middleware('backendauth');
Route::post("/backend/orders/destroy/{id}","Backend\OrderController@destroy")->middleware('backendauth');

Route::post('/backend/orders/searchProduct', "Backend\OrderController@searchProduct")->middleware('backendauth');
Route::post('/backend/orders/ajaxSingleProduct', "Backend\OrderController@ajaxSingleProduct")->middleware('backendauth');

Route::get("/backend/settings","Backend\SettingController@edit")->middleware('backendauth');
Route::post("/backend/settings/update","Backend\SettingController@update")->middleware('backendauth');


//slide
Route::get("/backend/slide/create","Backend\silderController@create")->middleware('backendauth');
Route::get("/backend/slide/index","Backend\silderController@index")->middleware('backendauth');
Route::get("/backend/slide/edit/{id}","Backend\silderController@edit")->middleware('backendauth');
Route::get("/backend/slide/delete/{id}","Backend\silderController@delete")->middleware('backendauth');


// admin

Route::get('/backend/admins/index', "Backend\AdminController@index")->middleware('backendauth');
Route::get('/backend/admins/create', "Backend\AdminController@create")->middleware('backendauth');
Route::get('/backend/admins/edit/{id}', "Backend\AdminController@edit")->middleware('backendauth');
Route::get('/backend/admins/delete/{id}', "Backend\AdminController@delete")->middleware('backendauth');
Route::post('/backend/admins/store', "Backend\AdminController@store")->middleware('backendauth');
Route::post('/backend/admins/update/{id}', "Backend\AdminController@update")->middleware('backendauth');
Route::post('/backend/admins/destroy/{id}', "Backend\AdminController@destroy")->middleware('backendauth');


// authen admin
Route::get('/backend/admin-login', "Backend\AdminLoginController@loginview");
Route::post('/backend/admin-login', "Backend\AdminLoginController@loginPost");
Route::get('/backend/admin-logout', "Backend\AdminLoginController@logout")->middleware('backendauth');


Route::get('/',"Frontend\HomepageController@index");
Route::get('/single-product/{id}', "Frontend\ProductController@index");

Route::get('/shop', "Frontend\ProductController@shop");
Route::get('/category/{id}', "Frontend\ProductController@category");







