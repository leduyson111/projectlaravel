@extends('frontend.layouts.main')

@section('title', 'giỏ hàng')

@section('content')
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="index.html">home</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Shopping Cart</li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->



 <!--shopping cart area start -->
<div class="shopping_cart_area">
    <form action="#"> 
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="cart_page table-responsive">
                            <table>
                        <thead>
                            <tr>
                                <th class="product_remove">Delete</th>
                                <th class="product_thumb">Image</th>
                                <th class="product_name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product_quantity">Quantity</th>
                                <th class="product_total">Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                
                                $total = 0;

                            @endphp

                            @if ($products)
                            @foreach ($products as $product )

                                @php
                                    $product->product_image = str_replace("public/", "", $product->product_image);
                                @endphp

                                    <tr>
                                        <td class="product_remove"><a class="icon_close removeCart" data-id="{{ $product->id }}" href="#"><i class="fa fa-trash-o"></i></a></td>
                                        <td class="product_thumb"><a href="./single-product/{{ $product->id }}"><img src="{{ asset("storage/$product->product_image") }}" alt=""></a></td>
                                        <td class="product_name"><a href="./single-product/{{ $product->id }}">{{ $product->product_name }}</a></td>
                                        <td class="product-price">£{{ $product->product_price }}</td>
                                        <td class="product_quantity">
                                            <div class="pro-qty">
                                                <input min="0" name="qttCart[]"  class="qttCart" data-id="{{ $product->id }}" max="100" value="{{ $cart[$product->id][0]['quantity'] }}"  type="number">
                                            </div>
                                        </td>
                                        <td class="product_total">£ {{  (int)$cart[$product->id][0]['quantity'] * (float)$product->product_price   }}
                                            @php
                                                $total += $cart[$product->id][0]['quantity'] * $product->product_price;
                                            @endphp
                                        </td>
                                    </tr>
                            @endforeach    


                        @endif

                        </tbody>
                    </table>   
                        </div>  
                            
                    </div>
                 </div>
             </div>
             <!--coupon code area start-->
            <div class="coupon_area">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code">
                            <h3>Coupon</h3>
                            <div class="coupon_inner">   
                                <p>Enter your coupon code if you have one.</p>                                
                                <input placeholder="Coupon code" type="text">
                                <button type="submit">Apply coupon</button>
                            </div>    
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code">
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">
                               <div class="cart_subtotal">
                                   <p>Subtotal</p>
                                   <p class="cart_amount">£{{ $total }}.00</p>
                               </div>
                           
                         
                               <div class="cart_subtotal">
                                   <p>Total</p>
                                   <p class="cart_amount">£{{ $total }}.00</p>
                               </div>
                               <div class="checkout_btn">
                                   <a  href="{{ url("/payment") }}">Proceed to Checkout</a>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--coupon code area end-->
        </form> 
 </div>

@endsection

@section("appentjs")
    <script>
        $(document).ready(function () {
            $("body").on("click", ".qtybtn", function (e) {
                var input = $(this).closest(".pro-qty").find("input").eq(0);
                var id = input.data("id");
                id = parseInt(id);
                var qtt = input.val();
                qtt = parseInt(qtt);
                if (id > 0 && qtt > 0) {
                    $.ajax({
                        method: "POST",
                        url: "{{ url('/cart/update') }}",
                        data: { id: id,quantity: qtt,_token: "{{ csrf_token() }}" }
                    }).done(function( product ) {
                        location.reload();
                    });
                } else {
                    alert("có lỗi hệ thống vui lòng liên hệ admin");
                }
            });
            $(".qttCart").on("change", function (e) {
                // alert(111);
                var id = $(this).data("id");
                id = parseInt(id);
                var qtt = $(this).val();
                qtt = parseInt(qtt);
                if (id > 0 && qtt > 0) {
                    $.ajax({
                        method: "POST",
                        url: "{{ url('/cart/update') }}",
                        data: { id: id,quantity: qtt,_token: "{{ csrf_token() }}" }
                    }).done(function( product ) {
                        location.reload();
                    });
                } else {
                    alert("có lỗi hệ thống vui lòng liên hệ admin");
                }
                console.log(id);
            });
            $(".removeCart").on("click", function (e) {
                e.preventDefault();
                var id = $(this).data("id");
                id = parseInt(id);
                if (id > 0) {
                    $.ajax({
                        method: "POST",
                        url: "{{ url('/cart/remove') }}",
                        data: { id: id,_token: "{{ csrf_token() }}" }
                    }).done(function( product ) {
                        location.reload();
                    });
                } else {
                    alert("có lỗi hệ thống vui lòng liên hệ admin");
                }
                console.log(id);
            });
        });
    </script>
@endsection
