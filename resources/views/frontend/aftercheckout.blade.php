@extends('frontend.layouts.main')

@section('title', 'giỏ hàng')

@section('content')
@if (session('status'))
<br>
  
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif


@endsection