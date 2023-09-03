@extends('backend.layouts.master')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <div class="col-lg-12">
                    @include('backend.layouts.notification')
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="block-header">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h2>
                                    <a href="javascript:void(0)" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                            class="fa fa-arrow-left"></i></a>Order
                                    <a href="{{ route('order.create') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-circle"></i> Create Coupon</a>
                                </h2>
                                <ul class="breadcrumb float-left">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Orders
                                    </li>
                                </ul>
                                <p class="float-right">Total Orders: {{ \App\Models\Order::count() }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 pb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->payment_method == 'cod' ? 'Cash on Delivery' : $order->payment_method }}
                                            </td>
                                            <td class="text-uppercase">{{ $order->payment_status }}</td>
                                            <td>{{ number_format($order->total_amount, 2) }}</td>
                                            <td><span
                                                    class="badge 
                                                @if ($order->condition == 'pending') badge-info 
                                                @elseif($order->condition == 'processing')
                                                    badge-primary
                                                @elseif($order->condition == 'delivered')
                                                    badge-success
                                                @else 
                                                    badge-danger @endif">
                                                    {{ $order->condition }}</span></td>
                                            <td>
                                                <a href="{{ route('order.show', $order->id) }}" data-toggle="tooltip"
                                                    title="view" data-placement="bottom"
                                                    class="float-left btn btn-sm btn-outline-warning"><i
                                                        class="fas fa-download"></i></a>
                                                <form class="float-left ml-1"
                                                    action="{{ route('order.destroy', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="" data-toggle="tooltip" title="delete"
                                                        data-id="{{ $order->id }}" data-placement="bottom"
                                                        class="delete-btn btn btn-sm btn-outline-danger"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                </form>
                                            </td>
                                        </tr>   
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Product Image</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $item)
                                            <tr>
                                                <td></td>
                                                <td><img src="{{ $item->photo }}" alt="" style="max-width: 100px"></td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->pivot->quantity }}</td>
                                                <td>{{ number_format($item->price,2) }}</td>
                                            </tr>  
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-5 border py-3">
                                <p>   
                                    <strong>Sub-total</strong> : $ {{ number_format($order->sub_total,2) }}
                                </p>
                                @if($order->delivery_charge>0)
                                <p>   
                                    <strong>Shipping Cost</strong> : $ {{ number_format($order->delivery_charge,2) }}
                                </p>
                                @endif
                                @if($order->coupon>0)
                                <p>   
                                    <strong>Coupon</strong> : $ {{ number_format($order->coupon,2) }}
                                </p>
                                @endif
                                <p>   
                                    <strong>Total</strong> : $ {{ number_format($order->total_amount,2) }}
                                </p>
                                <form action="{{ route('order.status', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <strong>Status</strong>
                                    <select name="condition" class="form-control" id="">
                                        <option value="pending" {{ $order->condition=='pending' ? 'selected' : '' }} {{ $order->condition=='delivered' || $order->condition=='cancelled' ? 'disabled' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->condition=='processing' ? 'selected' : '' }} {{ $order->condition=='delivered' || $order->condition=='cancelled' ? 'disabled' : '' }}>Processing</option>
                                        <option value="delivered" {{ $order->condition=='delivered' ? 'selected' : '' }} {{ $order->condition=='cancelled' ? 'disabled' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->condition=='cancelled' ? 'selected' : '' }} {{ $order->condition=='delivered' ? 'disabled' : '' }}>Cancelled</option>
                                    
                                    </select>
                                    <button class="btn btn-sm btn-success mt-3">Update</button>
                                </form>
                            </div>
                            <div class="col-1"></div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-btn').click(function(e) {
            var form = $(this).closest('form');
            var dataId = $(this).data('id');
            e.preventDefault();
            // sweet alert
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    form.submit();
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>
    <script>
        $('input[name=toggle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();

            $.ajax({
                url: "{{ route('coupon.status') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id
                },
                success: function(response) {
                    if (response.status) {
                        alert(response.message);
                    } else {
                        alert('Please try again');
                    }
                }
            });
        });
    </script>
@endsection
