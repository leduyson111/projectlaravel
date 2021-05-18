@extends('backend.layouts.main')

@section('titile',"Tạo mới admin")

@section('content')

    <h1>Tạo mới admin</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <form action="{{url("/backend/admins/store")}}" method="post" enctype="multipart/form-data" name="category">
        @csrf

        <div class="form-group">
            <label for="name">Tên: </label>
            <input type="text" name="name" id="name" class="form-control" value="{{old('name',"")}}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email"  id="email" class="form-control" value="{{old('email','')}}">
        </div>

        <div class="form-group">
            <label for="image">ảnh đại diện</label>
            <input type="file" name="avatar"  id="image"  class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control"  id="password" value="{{old('password','')}}">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Nhập lại mật khẩu: </label>
            <input type="text" name="password_confirmation" class="form-control"   id="password_confirmation" value="{{old('password_confirmation','')}}">
        </div>

        <div class="form-group">
            <label for="desc">Ghi chú</label>
            <input type="text" name="desc" class="form-control"   id="desc" value="{{old('desc','')}}">
        </div>
        <button type="submit" class="btn btn-info">Thêm sản phẩm</button>

    </form>

@endsection


