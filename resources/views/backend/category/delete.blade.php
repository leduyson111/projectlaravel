@extends('backend.layouts.main')

@section('title',"Xóa danh mục")

@section('content')
    <h1>Xóa sản phẩm</h1>
    <form action="{{url("/backend/category/destroy/$category->id")}}" method="post" name="category">
        @csrf
        <div class="form-group">
            <label for="id">ID danh mục: </label>
            <p>{{$category->id}}</p>
        </div>
        <div class="form-group">
            <label for="product_name">Tên danh mục: </label>
            <p>{{$category->name}}</p>
        </div>
        <button class="btn btn-danger" type="submit">Xác nhận xóa danh mục</button>
    </form>
@endsection
