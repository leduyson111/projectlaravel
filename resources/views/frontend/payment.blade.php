@extends('frontend.layouts.main')
@section('title', 'Thanh toán')

@section('content')

<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="index.html">home</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>checkout</li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->


<!--Checkout page section-->
<div class="Checkout_section">

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
    <div class="checkout_form">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form name="order" method="post" action="{{ url("/payment/checkout") }}">
                        @csrf
                        <h3>Billing Details</h3>
                        <div class="row">

                            <div class="col-lg-6 mb-30">
                                <label>Fullname <span>*</span></label>
                                <input type="text" name="customer_name" placeholder="fullname">    
                            </div>
                            <div class="col-lg-6 mb-30">
                                <label>Address  <span>*</span></label>
                                <input type="text" name="customer_address"  placeholder="Address"> 
                            </div>
                        
                            <div class="col-lg-6 mb-30">
                                <label>Phone<span>*</span></label>
                                <input type="text" name="customer_phone" placeholder="phone"> 

                            </div> 
                             <div class="col-lg-6 mb-30">
                                <label> Email <span>*</span></label>
                                  <input type="text" name="customer_email" placeholder="email"> 

                            </div> 
                            <div class="col-12 mb-30">
                                <label> Order notes</label>
                                <input type="text"  name="order_note" placeholder="Order notes">     
                            </div>
                          	    	    	    	    	    	    
                        </div>
                        <div class="payment_method">
                            <div class="order_button">
                                <button type="submit">Đặt hàng</button> 
                            </div>    
                        </div>
                    </form>    
               
            </div>
            
            <div class="col-lg-6 col-md-6">
                <form action="#">    
                    <h3>Your order</h3> 

                    @php
                        $total = 0;
                    @endphp

             

                    <div class="order_table table-responsive mb-30">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($products)
                            @foreach ($products as $product )
                            @php $total += $cart[$product->id][0]['quantity'] * $product->product_price @endphp
            
                                <tr>
                                    <td> {{ $product->product_name }}	</td>
                                    <td> ${{  (int)$cart[$product->id][0]['quantity'] *  (float)$product->product_price  }}.00</td>
                                </tr> 
                                

                            @endforeach
                                
                            @endif
                              
                            </tbody>
                            <tfoot>
                                <tr class="order_total">
                                    <th>Order Total</th>
                                    <td><strong>${{ $total }}.00</strong></td>
                                </tr>
                            </tfoot>
                        </table>     
                    </div>
                   
                </form>         
            </div>  
            

        </div> 
        </div>        
</div>




@endsection