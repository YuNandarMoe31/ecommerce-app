@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Cart</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Cart Area -->
    <div class="cart_area section_padding_100_70 clearfix">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <div class="cart-table">
                        <div class="table-responsive">
                            @include('frontend.layouts._cart-list')
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="cart-apply-coupon mb-30">
                        <h6>Have a Coupon?</h6>
                        <p>Enter your coupon code here &amp; get awesome discounts!</p>
                        <!-- Form -->
                        <div class="coupon-form">
                            <form action="{{ route('coupon.add') }}" method="POST" id="coupon-form">
                                @csrf
                                <input type="text" class="form-control" name="code"
                                    placeholder="Enter Your Coupon Code">
                                <button type="submit" class="btn btn-primary coupon-btn">Apply Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="cart-total-area mb-30">
                        <h5 class="mb-3">Cart Totals</h5>
                        <div class="table-responsive">
                            <table class="table mb-3">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>{{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Save Amount</td>
                                        <td>
                                            @if (session()->has('coupon') && is_numeric(session('coupon')['value']))
                                                - {{ number_format(session()->get('coupon')['value'],2) }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>
                                            @if (session()->has('coupon') && is_numeric(session('coupon')['value']))
                                                $ {{ number_format((float)str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal())-session()->get('coupon')['value'],2) }}
                                            @else
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('checkout1') }}" class="btn btn-primary d-block">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.cart_delete', function(e) {
                e.preventDefault();
                var cart_id = $(this).data('id');
                var token = "{{ csrf_token() }}";
                var path = "{{ route('cart.delete') }}";
                var data = {
                    cart_id: cart_id,
                    _token: token,
                };

                $.ajax({
                    url: path,
                    type: "POST",
                    dataType: "json",
                    data: JSON.stringify(data),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    },
                    success: function(data) {
                        if (data['status']) {
                            $('body #header-ajax').html(data['header']);
                            // $('body #cart-counter').html(data['cart_count']);

                            swal({
                                title: "Good job!",
                                text: data['message'],
                                icon: "success",
                                button: "ok",
                            });
                            // location.reload();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        // Handle error
                    }

                });
            });
        })
    </script>

    <script>
        $(document).on('click', '.qty-text', function() {
            var id = $(this).data('id');

            var spinner = $(this),
                input = spinner.closest("div.quantity").find('input[type="number"]');

            if (input.val() == 1) {
                return false;
            }

            if (input.val() != 1) {
                var newVal = parseFloat(input.val());
                $('#qty-input-' + id).val(newVal);
            }

            var productQuantity = $("#update-cart-" + id).data('product-quantity');
            update_cart(id, productQuantity);
        });

        function update_cart(id, productQuantity) {
            var rowId = id;
            var product_qty = $('#qty-input-' + rowId).val();
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.update') }}";
            var data = {
                _token: token,
                product_qty: product_qty,
                rowId: rowId,
                productQuantity: productQuantity
            }

            $.ajax({
                url: path,
                type: "POST",
                dataType: "json",
                data: JSON.stringify(data),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                },
                success: function(data) {
                    console.log(data);
                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart_list').html(data['cart_list']);
                        // $('body #cart-counter').html(data['cart_count']);

                        // swal({
                        //     title: "Good job!",
                        //     text: data['message'],
                        //     icon: "success",
                        //     button: "ok",
                        // });
                        alert(data['message']);

                    } else {
                        alert(data['message']);
                    }
                }
            })
        }
    </script>

    <script>
        $(document).on('click', '.coupon-btn', function(e) {
            e.preventDefault();
            var code = $('input[name=code]').val();

            $('.coupon-btn').html('<i class="fas fa-spinner fa-spin"></i> Applying...');
            $('#coupon-form').submit();
        });
    </script>
@endsection
