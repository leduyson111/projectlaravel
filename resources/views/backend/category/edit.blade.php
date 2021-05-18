@extends("backend.layouts.main")

@section('title',"Tạo mới danh mục")

@section('content')
    <h1>Tạo mới danh mục</h1>


    <form name="category" action="{{url("/backend/category/update/$category->id")}}" method="post" enctype="multipart/form-data">
        @csrf

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('status'))
            <div class="alert alert-success">
                {{session("status")}}
            </div>
        @endif

        <div class="form-group">
            <label for="name">Tên danh mục:</label>
            <input type="text" name="name" value="{{$category->name}}" class="form-control" id="name">
        </div>

        <div class="form-group">
            <label for="product_image">Ảnh danh mục:</label>
            <input type="file" name="image"   class="form-control" id="image">
        </div>
        @if($category->image)
            @php
                $category->image = str_replace("public/","","$category->image");
            @endphp
            <div>
                <img src="{{asset("storage/$category->image")}}" style="width: 200px;" height="auto" alt="Lỗi ảnh">
            </div>

        @endif

        <div class="form-group">
            <label for="product_name">Đường link danh mục:</label>
            <input type="text" name="slug" value="{{$category->slug}}" class="form-control" id="slug">
        </div>
        <div class="form-group">
            <label for="product_image">Mô tả danh mục:</label>
            <textarea name="desc" class="form-control" id="category_desc" rows="10"> {{$category->desc}} </textarea>
        </div>
        <div>
            <label for="">Preview mô tả danh mục</label>
            <div>{!! $category->desc !!} </div>
        </div>

        <button type="submit" class="btn btn-info">Thêm danh mục</button>
    </form>

@endsection

@section('appendjs')

    <link rel="stylesheet" href="{{ asset("/be-assets/js/bootstrap-datetimepicker.min.css") }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset("/be-assets/js/bootstrap-datetimepicker.min.js") }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#product_publish').datetimepicker({
                format:"YYYY-MM-DD HH:mm:ss",
                icons: {
                    time: 'far fa-clock',
                    date: 'far fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-calendar-check',
                    clear: 'far fa-trash-alt',
                    close: 'far fa-times-circle'
                }
            });
        });
    </script>
    <script src="{{ asset("/be-assets/js/tinymce/tinymce.min.js") }}"></script>

    <script>
        tinymce.init({
            selector: '#category_desc'
        });

    </script>

@endsection
