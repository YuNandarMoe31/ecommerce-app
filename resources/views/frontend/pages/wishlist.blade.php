@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive" id="wishlist_list">
                            @include('frontend.layouts._wishlist')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Table Area -->
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.move_to_cart', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.move.cart') }}";
            var data = {
                _token: token,
                rowId: rowId,
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
                beforeSend: function() {
                    $(this).html(
                        '<i class="fas fa-spinner fa-spin"></i> Movint to cart...');
                },
                success: function(data) {
                    if (data['status']) {
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        // $('body #header-ajax').html(data['header']);
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "ok",
                        });
                    } else {
                        swal({
                            title: "Opps!",
                            text: "Something went wrong",
                            icon: "warning",
                            button: "ok",
                        });
                    }
                },
                error: function(err) {
                    console.log(err);
                    swal({
                        title: "Error!",
                        text: "Error found",
                        icon: "error",
                        button: "ok",
                    });
                }

            })
        });
    </script>
     <script>
        $(document).on('click', '.wishlist_delete', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.delete') }}";
            var data = {
                _token: token,
                rowId: rowId,
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
                    if (data['status']) {
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        $('body #header-ajax').html(data['header']);
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "ok",
                        });
                    }
                },
                error: function(err) {
                    swal({
                        title: "Error!",
                        text: "Error found",
                        icon: "error",
                        button: "ok",
                    });
                }

            })
        });
    </script>
@endsection
