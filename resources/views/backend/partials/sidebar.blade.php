
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
@php

    $session_admin_login = session('admin_login', false);

    $session_admin_login["avatar"] = str_replace("public/", "", $session_admin_login["avatar"]);

@endphp
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
{{--            <i class="fas fa-laugh-wink"></i>--}}
            <img class="img-profile rounded-circle" width="32px" height="32px" src="{{ asset("storage/".$session_admin_login["avatar"]) }}">
        </div>
        <div class="sidebar-brand-text mx-3"  >{{ $session_admin_login["name"] }} <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/backend/')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashbroad</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/backend/category/index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Danh mục</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{url('/backend/product/index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Sản phẩm</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{url('/backend/orders/index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Đơn hàng</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{url('/backend/settings/')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Cấu hình</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/backend/slide/index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Slide</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{url('/backend/admins/index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Thành viên</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Divider -->

    <!-- Sidebar Toggler (Sidebar) -->

    <div class="text-center d-none d-md-inline">

        <button class="rounded-circle border-0" id="sidebarToggle"></button>

    </div>



</ul>

