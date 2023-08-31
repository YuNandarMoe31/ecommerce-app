@extends('backend.layouts.master')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                                </h2>
                                <ul class="breadcrumb float-left">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Product Attribute
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
                            <h6 class="m-0 font-weight-bold text-primary text-uppercase">
                                <strong>{{ $product->title }}</strong>
                            </h6>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-7">
                                <form action="{{ route('product.attribute', $product->id) }}" method="POST">
                                    @csrf

                                    <div id="product_attribute" class="content"
                                        data-mfield-options='{"section": ".group","btnAdd":"#btnAdd","btnRemove":".btnRemove"}'>
                                        <div class="row">
                                            <div class="col-md-12"><button type="button" id="btnAdd"
                                                    class="btn btn-sm my-2 btn-primary"><i
                                                        class="fas fa-plus-circle"></i></button></div>
                                        </div>
                                        <div class="row group">
                                            <div class="col-md-2">
                                                <label for="">Size</label>
                                                <input class="form-control form-control-sm" name="size[]" placeholder="S"
                                                    type="text">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Original Price</label>
                                                <input class="form-control form-control-sm" name="original_price[]"
                                                    placeholder="eg. 1200" type="number" step="any">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Offer Price</label>
                                                <input class="form-control form-control-sm" name="offer_price[]"
                                                    placeholder="eg. 1200" type="number" step="any">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Stock</label>
                                                <input class="form-control form-control-sm" name="stock[]"
                                                    placeholder="eg. 4" type="number">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btnRemove"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-info mt-2">Submit</button>
                                </form>

                            </div>
                            <div class="col-md-5">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                {{-- <th>No</th> --}}
                                                <th>Size</th>
                                                <th>Original Price</th>
                                                <th>Offer Price</th>
                                                <th>Stock</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($productattr))
                                                @foreach ($productattr as $item)
                                                    <tr>
                                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                                        <td>{{ $item->size }}</td>
                                                        <td>$ {{ number_format($item->original_price,2) }}</td>
                                                        <td>$ {{ number_format($item->offer_price,2) }}</td>
                                                        <td>{{ $item->stock }}</td>
                                                        <td>
                                                            <form class="float-left ml-1"
                                                                action="{{ route('product.attribute.destroy', $item->id) }}"
                                                                method="POST">
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
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
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
    <script src="{{ asset('backend/js/jquery.multifield.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('#product_attribute').multifield();
    </script>
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
@endsection
