@extends('backend.layouts.main')

@section('title','Sửa sản phẩm')

@section('content')
    <h1> Cấu hình trang web</h1>
    @if($errors ->any())
        <div class="aler alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{url("/backend/settings/update")}}" name="settings" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="site_name">Tên trang web: </label>
            <input type="text" name="site_name" class="form-control" id="site_name" value="{{isset($settingConvert["site_name"]) ? $settingConvert["site_name"]: "" }}">
        </div>
        <div class="form-group">

            <label for="logo">Ảnh logo:</label>

            <input type="file" name="logo" class="form-control" id="logo">
            @if(isset($settingConvert['logo']) && ($settingConvert['logo']))
                <?php
                $settingConvert["logo"] = str_replace("public/", "", $settingConvert["logo"]);
                ?>
                <div>
                    <img src="{{asset("storage"."/".$settingConvert['logo'])}}" style="width: 200px" height="auto" alt="">
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="meta_title"> Meta title</label>
            <input type="text" name="meta_title" class="form-control" value="{{isset($settingConvert['meta_title']) ? $settingConvert['meta_title'] : ""}}" id="meta_title">

        </div>
        <div class="form-group">
            <label for="meta_desc"> Meta description: </label>
            <textarea name="meta_desc" id="meta_desc" class="form-control"  rows="4">{{isset($settingConvert["meta_desc"]) ? $settingConvert["meta_desc"] : ""}}</textarea>
        </div>

        <div class="form-group">
            <label for="meta_keyword">Meta keyword: </label>
            <textarea name="meta_keyword" id="meta_keyword" class="form-control"   rows="4">
                {{ isset($settingConvert["meta_keyword"]) ? $settingConvert["meta_keyword"] : "" }}
            </textarea>
        </div>
        <button type="submit" class="btn btn-info">Lưu cấu hình</button>

    </form>
@endsection
