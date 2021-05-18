@extends('frontend.layouts.main')
@section('title', 'Tất cả sản phẩm')

@section('content')
<br>

<div class="new_product_area product_two">
        <div class="row">
            <div class="col-12">
                <div class="block_title">
                <h3>  products by category     </h3>
            </div>
            </div> 
        </div>
        <div class="row">
            <div class="single_p_active owl-carousel">

                @if ($discountProducts)
                @foreach ($discountProducts as $product )

                <?php
                $product->product_image = str_replace("public/", "", $product->product_image);
                ?>

                    <div class="col-lg-3">
                        <div class="single_product">
                            <div class="product_thumb">
                            <a href="../single-product/{{ $product->id }}"><img src="{{ asset("storage/$product->product_image") }}" alt=""></a> 
                            <div class="img_icone">
                                <img src="{{url('fe-assets/assets\img\cart\span-new.png')}}" alt="">
                            </div>
                            <div class="product_action">
                                <a href="#"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                            </div>
                            </div>
                            <div class="product_content">
                                <span class="product_price">${{ $product->product_price }}</span>
                                <h3 class="product_title"><a href="../single-product/{{ $product->id }}">{{ $product->product_name }}</a></h3>
                            </div>
                            <div class="product_info">
                                <ul>
                                    <li><a href="#" title=" Add to Wishlist ">Add to Wishlist</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">View Detail</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
                    
                @endif
         
            </div> 
        </div>      
    </div> 

@endsection