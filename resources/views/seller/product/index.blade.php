@extends('seller.layouts.master')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <div class="col-lg-12">
                    @include('seller.layouts.notification')
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="block-header">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h2>
                                    <a href="javascript:void(0)" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                            class="fa fa-arrow-left"></i></a>Product
                                    <a href="{{ route('seller-product.create') }}" class="btn btn-sm btn-outline-secondary"><i
                                            class="fas fa-plus-circle"></i> Create Product</a>
                                </h2>
                                <ul class="breadcrumb float-left">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('seller') }}"><i class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Products
                                    </li>
                                </ul>
                                <p class="float-right">Total Products: {{ $products->count() }}</p>
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
                                            @php
                                                $photo = explode(',', $item->photo);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td><img src="{{ $photo[0] }}" alt="Brand Image"
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
                                                    <a href="{{ route('seller-product.show', $item->id) }}" 
                                                        data-toggle="tooltip" title="add attribute" data-placement="bottom"
                                                        class="float-left btn btn-sm btn-outline-info mr-1"><i
                                                            class="fas fa-plus-circle"></i></a>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#productId{{ $item->id }}"
                                                        data-toggle="tooltip" title="view" data-placement="bottom"
                                                        class="float-left btn btn-sm btn-outline-secondary mr-1"><i
                                                            class="fas fa-eye"></i></a>
                                                    <a href="{{ route('seller-product.edit', $item->id) }}" data-toggle="tooltip"
                                                        title="edit" data-placement="bottom"
                                                        class="float-left btn btn-sm btn-outline-warning mr-1"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form class="float-left ml-1"
                                                        action="{{ route('seller-product.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="" data-toggle="tooltip" title="delete"
                                                            data-id="{{ $item->id }}" data-placement="bottom"
                                                            class="delete-btn btn btn-sm btn-outline-danger"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </form>
                                                </td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="productId{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        @php
                                                            $product = \App\Models\Product::where('id', $item->id)->first();
                                                            
                                                        @endphp
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-uppercase"
                                                                    id="exampleModalLabel">
                                                                    {{ $product->title }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <strong>Summary:</strong>
                                                                <p>{!! $product->summary !!}</p>

                                                                <strong>Description:</strong>
                                                                <p>{!! $product->description !!}</p>

                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <strong>Price:</strong>
                                                                        <p>{{ number_format($product->price, 2) }}</p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Offer Price:</strong>
                                                                        <p>{{ number_format($product->offer_price, 2) }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <strong>Stock:</strong>
                                                                        <p>{{ $product->stock }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <strong>Category:</strong>
                                                                        <p>{{ \App\Models\Category::where('id', $product->cat_id)->value('title') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>Child Category:</strong>
                                                                        <p>{{ \App\Models\Category::where('id', $product->child_cat_id)->value('title') }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <strong>Brand:</strong>
                                                                        <p>{{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>Vendor:</strong>
                                                                        <p>{{ \App\Models\User::where('id', $product->vendor_id)->value('full_name') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <strong>Size:</strong>
                                                                        <p class="badge badge-success">
                                                                            {{ $product->size }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong>Condition:</strong>
                                                                        <p class="badge badge-primary">
                                                                            {{ $product->condition }}</p>
                                                                    </div>
                                                                    {{-- <div class="col-md-6">
                                                                        <strong>Status:</strong>
                                                                        <p class="badge badge-warning">
                                                                            {{ $product->status }}</p>
                                                                    </div> --}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                url: "{{ route('seller.product.status') }}",
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
