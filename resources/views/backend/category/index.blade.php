@extends('backend.layouts.main')

@section('title','Danh sách danh mục')

@section('content')
    <h1>Danh sách danh mục</h1>
    <div style="padding: 10px; border: 1px solid #4e73df">

        <form name="search_category" method="get" action="{{ htmlspecialchars($_SERVER["REQUEST_URI"]) }}" class="form-inline">
            <input name="category_name" value="{{ $searchKeyword }}" class="form-control" style="width: 350px; margin-right: 20px" placeholder="Nhập tên sản phẩm bạn muốn tìm kiếm ..." autocomplete="off">

            <select name="category_sort" class="form-control" style="width: 150px; margin-right: 20px">
                <option value="">Sắp xếp</option>

                <option {{$sort == 'id_asc' ? "selected" : "" }} value="id_asc">Danh sách tăng dần</option>

                <option {{$sort == 'id_desc' ? "selected" : "" }}  value="id_desc">Danh sách giảm dần</option>

            </select>



            <div style="padding: 10px 0">
                <input type="submit" name="search" class="btn btn-success" value="Lọc kết quả">
            </div>
            <div style="padding: 10px 0;">
                <a href="#" id="clear-search" class="btn btn-warning">Clear filter</a>
            </div>
            <input type="hidden" name="page" value="1">
        </form>

    </div>
    {{ $category->links() }}

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div style="padding:20px">
        <a href="{{url('/backend/category/create')}}" class="btn btn-info"> Thêm danh mục </a>
    </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Id danh mục</th>
            <th>Tên danh mục</th>
            <th>Link danh mục</th>
            <th>ảnh danh mục</th>
            <th>Mô tả</th>

            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($category) && !empty($category))
            @foreach($category as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td>
                        @if($category->image)
                            <?php
                            $category->image = str_replace("public/", "",$category->image);
                            ?>
                            <div>
                                <img src='{{asset("storage/$category->image")}}' style="width: 200px; height: auto;" alt="">
                            </div>


                        @endif
                    </td>
                    <td>{!!$category->desc!!}</td>
                    <td>
                        <a href='{{url("/backend/category/edit/$category->id")}}' class="btn btn-warning">Sửa danh mục</a>
                        <a href='{{url("/backend/category/delete/$category->id")}}' class="btn btn-danger">Xóa danh mục</a>
                    </td>
                </tr>
            @endforeach
        @else
            Chưa có danh mục trong CSDL
        @endif
        </tbody>
        <tfoot>
        <tr>
            <th>Id danh mục</th>
            <th>Tên danh mục</th>
            <th>Link danh mục</th>
            <th>ảnh danh mục</th>
            <th>Mô tả</th>

            <th>Hành động</th>
        </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
@endsection

@section('appendjs')



    <script type="text/javascript">



        $(document).ready(function () {

            $("#clear-search").on("click", function (e) {
                e.preventDefault();
                $("input[name='category_name']").val('');
                $("select[name='category_sort']").val('');
                $("form[name='search_category']").trigger("submit");
            });
            $("a.page-link").on("click", function (e) {
                e.preventDefault();
                var rel = $(this).attr("rel");
                if (rel == "next") {
                    var page = $("body").find(".page-item.active > .page-link").eq(0).text();
                    console.log(" : " + page);
                    page = parseInt(page);
                    page += 1;
                } else if(rel == "prev") {
                    var page = $("body").find(".page-item.active > .page-link").eq(0).text();
                    console.log(page);
                    page = parseInt(page);
                    page -= 1;

                } else {

                    var page = $(this).text();

                }
                console.log(page);
                page = parseInt(page);
                $("input[name='page']").val(page);
                $("form[name='search_category']").trigger("submit");

            });

        });

    </script>



@endsection
