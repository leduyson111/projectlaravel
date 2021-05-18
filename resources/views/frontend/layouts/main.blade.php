<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Coron - Fashion eCommerce Bootstrap4 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('fe-assets\assets\img\favicon.png')}}">

    <!-- all css here -->
    <link rel="stylesheet" href="{{ asset('fe-assets\assets\css\bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fe-assets\assets\css\plugin.css') }}">
    <link rel="stylesheet" href="{{ asset('fe-assets\assets\css\bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('fe-assets\assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('fe-assets\assets\css\responsive.css') }}">
    <script src="{{asset('fe-assets\assets\js\vendor\modernizr-2.8.3.min.js')}}"></script>
</head>
<body>
<!-- Add your site or application content here -->

<!--pos page start-->
<div class="pos_page">
    <div class="container">
        <!--pos page inner-->
        <div class="pos_page_inner">
            <!--header area -->
          @include("frontend.partials.header")
            <!--header end -->

            <!--pos home section-->
           @yield("content")
            <!--pos home section end-->
        </div>
        <!--pos page inner end-->
    </div>
</div>
<!--pos page end-->

<!--footer area start-->

<!--footer area end-->

<!-- modal area start -->
@include("frontend.partials.footer")

<!-- modal area end -->

<!-- all js here -->

<script src="{{ asset('fe-assets\assets\js\vendor\jquery-1.12.0.min.js') }}"></script>
<script src="{{ asset('fe-assets\assets\js\popper.js') }}"></script>
<script src="{{ asset('fe-assets\assets\js\bootstrap.min.js') }}"></script>
<script src="{{ asset('fe-assets\assets\js\ajax-mail.js') }}"></script>
<script src="{{ asset('fe-assets\assets\js\plugins.js') }}"></script>
<script src="{{ asset('fe-assets\assets\js\main.js') }}"></script>

@yield("appentjs")


</body>
</html>
