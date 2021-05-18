@extends('backend.layouts.login')
@section('title', 'Đăng nhập')
@section('content')

    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
    <!-- Outer Row -->

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->

                    <div  class="row">
                        <div class="col-lg-6 d-none d-lg-block" style="background-image: url('https://scontent.fhan5-5.fna.fbcdn.net/v/t1.0-9/120852897_355853538940648_351548506002199308_o.jpg?_nc_cat=108&ccb=2&_nc_sid=09cbfe&_nc_ohc=xYC0Ej8ksIYAX9SyXhT&_nc_ht=scontent.fhan5-5.fna&oh=401e03f027ca06a1ac1e4e14989afe9f&oe=601143E4');background-repeat: no-repeat; background-size: cover; background-position: center center;" ></div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập quản trị Admin </h1>
                                    </div>

                                    <form name="adminlogin" action="{{ url('/backend/admin-login') }}" method="post" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember_me" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" value="Login" class="btn btn-primary btn-user btn-block">

                                    </form>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
