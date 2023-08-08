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
                                            class="fa fa-arrow-left"></i></a>Product
                                    <a href="{{ route('product.create') }}" class="btn btn-sm btn-outline-secondary"><i
                                            class="fas fa-plus-circle"></i> Create Product</a>
                                </h2>
                                <ul class="breadcrumb float-left">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Products
                                    </li>
                                </ul>
                                <p class="float-right">Total Products: {{ \App\Models\Product::count() }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Product</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Photo</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Status</th>
                                            <th>Condition</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td><img src="{{ $item->photo }}" alt="Brand Image"
                                                        style="max-height: 90px; max-width: 120px;"></td>
                                                </td>
                                                <td>{{ $item->size }}</td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>{{ number_format($item->discount, 2) }} %</td>
                                                <td>
                                                    <input type="checkbox" name="toggle" value="{{ $item->id }}"
                                                        data-toggle="switchbutton"
                                                        {{ $item->status == 'active' ? 'checked' : '' }}
                                                        data-onlabel="active" data-offlabel="inactive" data-size="sm"
                                                        data-onstyle="success" data-offstyle="danger">
                                                </td>
                                                <td>
                                                    @if ($item->condition == 'new')
                                                        <span class="badge badge-success">
                                                            {{ $item->condition }}
                                                        </span>
                                                    @elseif ($item->condition == 'popular')
                                                        <span class="badge badge-warning">
                                                            {{ $item->condition }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-primary">
                                                            {{ $item->condition }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('brand.edit', $item->id) }}" data-toggle="tooltip"
                                                        title="edit" data-placement="bottom"
                                                        class="float-left btn btn-sm btn-outline-warning"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form class="float-left ml-1"
                                                        action="{{ route('brand.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="" data-toggle="tooltip" title="delete"
                                                            data-id="{{ $item->id }}" data-placement="bottom"
                                                            class="delete-btn btn btn-sm btn-outline-danger"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                url: "{{ route('product.status') }}",
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
