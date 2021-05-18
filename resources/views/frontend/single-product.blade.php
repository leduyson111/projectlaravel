@extends('frontend.layouts.main')

@section('title', 'Chi tiết sản phẩm')

@section('content')

    <div class="product_details">
        <div class="row">
            <?php
            $product->product_image = str_replace("public/", "", $product->product_image);
            ?>
            <div class="col-lg-5 col-md-6">
                <div class="product_tab fix">
                    <div class="product_tab_button">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#p_tab1" role="tab" aria-controls="p_tab1" aria-selected="false"><img src="{{ asset("storage/$product->product_image") }}" alt=""></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#p_tab2" role="tab" aria-controls="p_tab2" aria-selected="false"><img src="{{url("fe-assets\assets\img\cart\cart2.jpg")}}" alt=""></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#p_tab3" role="tab" aria-controls="p_tab3" aria-selected="false"><img src="{{url("fe-assets\assets\img\cart\cart4.jpg")}}" alt=""></a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content produc_tab_c">
                        <div class="tab-pane fade show active" id="p_tab1" role="tabpanel">
                            <div class="modal_img">
                             

                                <a href="#"><img src="{{ asset("storage/$product->product_image") }}" alt=""></a>
                                <div class="img_icone">
                                    <img src="{{url("fe-assets/assets\img\cart\span-new.png")}}" alt="">
                                </div>
                                <div class="view_img">
                                    <a class="large_view" href="{{ asset("storage/$product->product_image") }}"><i class="fa fa-search-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="p_tab2" role="tabpanel">
                            <div class="modal_img">
                                <a href="#"><img src="{{url("fe-assets/assets\img\product\product14.jpg")}}" alt=""></a>
                                <div class="img_icone">
                                    <img src="assets\img\cart\span-new.png" alt="">
                                </div>
                                <div class="view_img">
                                    <a class="large_view" href="{{url("fe-assets/assets\img\product\product13.jpg")}}"><i class="fa fa-search-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="p_tab3" role="tabpanel">
                            <div class="modal_img">
                                <a href="#"><img src="{{url("fe-assets/assets\img\product\product15.jpg")}}" alt=""></a>
                                <div class="img_icone">
                                    <img src="assets\img\cart\span-new.png" alt="">
                                </div>
                                <div class="view_img">
                                    <a class="large_view" href="{{url("fe-assets/assets\img\product\product14.jpg")}}"> <i class="fa fa-search-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="product_d_right">
                    <h1>{{ $product->product_name }}</h1>
                    <div class="product_ratting mb-10">
                        <ul>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"> Write a review </a></li>
                        </ul>
                    </div>
                    <div class="product_desc">
                        <p> {!! $product->product_desc !!}</p>
                    </div>

                    <div class="content_price mb-15">
                        <span>${{ $product->product_price }}</span>
                    </div>
                    <div class="box_quantity mb-20">
                        <form action="#">
                            <label>quantity</label>
                            <input min="0" max="100" name="quantity" value="1" type="number">
                        </form>
                        <button  id="addtocart" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        <a href="#" title="add to wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    </div>
                    <div class="product_d_size mb-20">
                        <label for="group_1">size</label>
                        <select name="size" id="group_1">
                            <option value="1">S</option>
                            <option value="2">M</option>
                            <option value="3">L</option>
                        </select>
                    </div>

                    <div class="sidebar_widget color">
                        <h2>Choose Color</h2>
                        <div class="widget_color">
                            <ul>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li> <a href="#"></a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_stock mb-20">
                        <p>{{ $product->product_quantity }} items</p>
                        <span> In stock </span>
                    </div>
                    <div class="wishlist-share">
                        <h4>Share on:</h4>
                        <ul>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                            <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


<div id="aftercart" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo giỏ hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Thêm sản phẩm vào giỏ hàng thành công! Vui lòng
                    chọn hành động để tiếp tục</p>
                <a href="{{ url("/cart") }}" class="btn btn-success">Đến trang giỏ hàng</a>
                <a href="{{ url("/payment") }}" class="btn btn-info">Đến trang thanh toán</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tiếp tục mua sắm</button>
            </div>
        </div>
    </div>
</div>
    

@endsection



@section("appentjs")
    <script>
        $(document).ready(function () {
            $("#addtocart").on("click", function (e) {
                e.preventDefault();
                var id = $(this).data("id");
                id = parseInt(id);
                var quantity = $("input[name='quantity']").val();
                quantity = parseInt(quantity);
                if (id > 0) {
                    $.ajax({
                        method: "POST",
                        url: "{{ url('/cart/add') }}",
                        data: { id: id,quantity: quantity,_token: "{{ csrf_token() }}" }
                    }).done(function( product ) {
                        $('#aftercart').modal();
                    });
                } else {
                    alert("có lỗi hệ thống vui lòng liên hệ admin");
                }
                console.log(quantity);
            });
        });
    </script>
@endsection
