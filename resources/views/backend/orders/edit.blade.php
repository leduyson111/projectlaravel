@extends('backend.layouts.main')



@section('title', 'Cập nhật đơn hàng')



@section('content')

    <h1>Cập nhật đơn hàng</h1>



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



    <form name="orders" action="{{ url("/backend/orders/update/$order->id") }}" method="post" enctype="multipart/form-data">



        @csrf



        <div class="form-group">

            <label for="customer_name">Tên khách hàng:</label>

            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $order->customer_name }}">

        </div>



        <div class="form-group">

            <label for="customer_email">Email:</label>

            <input type="text" name="customer_email" class="form-control" id="customer_email" value="{{ $order->customer_email }}">

        </div>



        <div class="form-group">

            <label for="customer_phone">Số điện thoại:</label>

            <input type="text" name="customer_phone" class="form-control" id="customer_phone" value="{{ $order->customer_phone }}">

        </div>





        <div class="form-group">

            <label for="order_status">Trạng thái đơn hàng:</label>

            <select name="order_status" class="form-control" style="width: 250px">

                <option value="1" {{ $order->order_status == 1 ? "selected" : "" }}>Đang chờ xác nhận</option>

                <option value="2" {{ $order->order_status == 2 ? "selected" : "" }}>Đã xác nhận</option>

                <option value="3" {{ $order->order_status == 3 ? "selected" : "" }}>Đang vận chuyển</option>

                <option value="4" {{ $order->order_status == 4 ? "selected" : "" }}>Hoàn tất</option>

                <option value="5" {{ $order->order_status == 5 ? "selected" : "" }}>Đơn hủy</option>

                <option value="6" {{ $order->order_status == 6 ? "selected" : "" }}>Đã hoàn tiền ( hủy đơn )</option>

            </select>

        </div>



        <div class="form-group">

            <label for="customer_address">Địa chỉ:</label>

            <textarea name="customer_address" class="form-control" rows="3" id="customer_address">{{ $order->customer_address }}</textarea>

        </div>



        <div class="form-group">

            <label for="customer_phone">Sản phẩm trong đơn hàng:</label>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                <tr>

                    <th>Id sản phẩm</th>

                    <th>ảnh đại diện</th>

                    <th>tên sản phẩm</th>

                    <th>số lượng</th>

                    <th>giá tiền</th>

                    <th>tổng giá</th>

                </tr>

                </thead>

                <tbody id="list-cart-product">

                @foreach($productInOrders as $productInOrder)

                    <tr id="tr-{{ $productInOrder->id }}">

                        <td> {{ $productInOrder->id }} </td>

                        <td>

                            @if ($productInOrder->product_image)

                                <?php
                                $productInOrder->product_image = str_replace("public/", "", $productInOrder->product_image);
                                ?>

                                <div>
                                    <img src="{{ asset("storage/$productInOrder->product_image") }}" style="width: 200px; height: auto" />
                                </div>
                            @endif

                        </td>
                        <td>{{ $productInOrder->product_name }}</td>

                        <td>
                            {{ $productInOrder->quantity }}
                        </td>
                        <td class="product_price">
                            {{ $productInOrder->product_price }}
                        </td>
                        <td class="product_price_total">
                            {{ $productInOrder->product_price * $productInOrder->quantity }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="font-weight: bold">Tổng tiền thanh toán: <strong id="payment-price">{{ $order->total_price }}</strong></div>

        </div>

        <div class="form-group">
            <label for="order_note">Ghi chú:</label>
            <textarea name="order_note" class="form-control" rows="3" id="order_note">{{ $order->order_note }}</textarea>
        </div>
        <button type="submit" class="btn btn-info">Cập nhật đơn hàng</button>

    </form>

@endsection

@section('appendjs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function () {
            function updateCart() {
                var total = 0;

                $("input[name='product_quatity[]").each(function (index, value) { // lặp lại 1 hàm không tên
                    console.log(index);
                    console.log(value);
                    var t = $(this); // chính giá trị của ô input

                    var tr = t.closest("tr"); // gán giá trị của cột vào 1 biến
                    var quantity = t.val(); // gán giá trị chính ô input là rỗng

                    var price = tr.find("td.product_price").text(); // gán giá trị vào 1 biến, lấy phần tử con của thẻ tr

                    price = parseFloat(price);
                    var tt = quantity*price;
                    console.log(quantity);
                    console.log(price);
                    console.log(tt);
                    tr.find("td.product_price_total").text(tt);
                    total += tt;
                });
                $("#payment-price").text(total);  // gán giá trị vào thẻ tổng tiền
            }
            $('#search_product').select2({
                placeholder: 'Tìm 1 sản phẩm',
                ajax: {
                    type:'POST', //thuộc tính post
                    data:function (params) {
                        query = {
                            search: params.term, //tìm kiếm sản phẩm trong ô
                            _token: "{{ csrf_token() }}"
                        };
                        return query;
                    },
                    url: "{{ url('/backend/orders/searchProduct') }}", // gửi dữ liệu sang trang searchProduct
                    processResults: function (data) { // chuyển các dữ liệu vào data
                        console.log(data);
                        return data;
                    }
                }
            });
            $("#addtocart").on("click",function (e) {  // nếu nút thêm sản phẩm được click
                e.preventDefault();// ngăn chặn chuyển hướng sang trang khác

                var id = $('#search_product').val(); // gán id giá trị là rỗng

                id = parseInt(id); // ép kiểu dữ liệu
                if(id>0){ // nếu tồn tại cái id   là đã tồn tại 1 sản phẩm

                    $.ajax({
                        method: "POST",
                        url: "{{ url('/backend/orders/ajaxSingleProduct') }}", // gửi dữ liệu đến trang ajaxSingleProduct
                        data: { id: id,_token: "{{ csrf_token() }}" } // dữ liệu ta gửi đi , đối tượng ta post đi là id đại diện cho sp
                    }).done(function( product ) { // lấy dữ liệu trong ajax ra
                        console.log(product);
                        checkTr = $("tbody#list-cart-product").find("#tr-"+product.id).length;  // lấy dữ liệu con của tbody

                        checkTr = parseInt(checkTr); // ép kiểu cho biết checkTr

                        if(product.id !== "undefined" && product.product_quantity > 0 && checkTr <1){
                            // nếu có tồn tại số lượn và sản phẩm thì thêm 1 sản phẩm có id như trên vào bảng
                            var html = '<tr id="tr-'+product.id+'">\n' +
                                '<td>\n' +
                                '\n' + product.id +
                                '<input type="hidden" name="product_ids[]" class="form-control" style="width: 150px" value="'+product.id+'">\n' +
                                '</td>\n' +
                                '<td><img src="'+product.product_image+'" style="width: 100px; height: auto;"> </td>\n' +
                                '<td>'+product.product_name+'</td>\n' +
                                '<td>\n' +
                                '<input type="number" name="product_quatity[]" class="form-control" style="width: 150px" value="1">\n' +
                                '</td>\n' +
                                '<td class="product_price">\n' +
                                product.product_price +
                                '\n' +
                                '</td>\n' +
                                '<td class="product_price_total">\n' +
                                product.product_price +
                                '</td>\n' +
                                '\n' +
                                '<td>\n' +
                                '  <a href="#" class="btn btn-danger removeCart">Xóa</a>\n' +
                                '</td>\n' +
                                '</tr>';

                            $( "tbody#list-cart-product" ).append( html );// chèn nội dung vào thẻ con của #list-cart-product

                            updateCart(); // load lại trang
                        }else{
                            alert("Thêm sản phẩm không thành công do đã có sản phẩm trong giỏ hàng hoặc lỗi hệ thống");
                        }

                    });
                }else{
                    alert("Chọn sản phẩm trước khi thêm giỏ hàng");

                }
                console.log(id);
            });
            $("body").on("click","a.removeCart",function (e) { // click vào nút xóa
                e.preventDefault();
                $(this).closest("tr").remove(); // xóa hàng đã click thẻ tr
                updateCart(); // load lại trang

            });
            $("body").on("change", "input[name='product_quatity[]']", function () { //khi tăng giá trị số lượng ô inout

                var quantity = $(this).val(); //gán giá trị cho số lượng = rỗng
                quantity = parseInt(quantity);

                if (quantity > 0 && quantity < 100) {  // nhập sản phẩm quá 100 sản phẩm sẽ load lại ô input
                    updateCart();
                } else {
                    $(this).val(1);// quá 100 sẽ chuyển số lượng thành 1
                    alert("chỉ được mua số lượng (1 đến 99)/một sản phẩm");
                    updateCart(); // load lại trang
                }
            });
        });
    </script>

@endsection
