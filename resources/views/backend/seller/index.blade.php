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
                                            class="fa fa-arrow-left"></i></a>Banner
                                    <a href="{{ route('seller.create') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-circle"></i> Create Banner</a>
                                </h2>
                                <ul class="breadcrumb float-left">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Banners
                                    </li>
                                </ul>
                                <p class="float-right">Total Banners: {{ \App\Models\Banner::count() }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Banner</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Sellers</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Is Verified</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sellers as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ $item->photo == null ? Helpers::userDefaultImage() : asset($item->photo) }}" alt="Seller Image"
                                                    style="max-height: 90px; max-width: 120px;"></td>
                                                <td>{{ $item->full_name }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>
                                                    <input type="checkbox" name="verified" value="{{ $item->id }}"
                                                        data-toggle="switchbutton"
                                                        {{ $item->is_verified ? 'checked' : '' }}
                                                        data-onlabel="Yes" data-offlabel="No" data-size="sm"
                                                        data-onstyle="success" data-offstyle="danger">
                                                </td>
                                                {{-- <td>{{ $item->is_verified ? 'Yes' : 'No' }}</td> --}}
                                                <td>
                                                    <input type="checkbox" name="toggle" value="{{ $item->id }}"
                                                        data-toggle="switchbutton"
                                                        {{ $item->status == 'active' ? 'checked' : '' }}
                                                        data-onlabel="active" data-offlabel="inactive" data-size="sm"
                                                        data-onstyle="success" data-offstyle="danger">
                                                </td>
                                                <td>
                                                    <a href="{{ route('seller.edit', $item->id) }}" data-toggle="tooltip"
                                                        title="edit" data-placement="bottom"
                                                        class="float-left btn btn-sm btn-outline-warning"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form class="float-left ml-1"
                                                        action="{{ route('seller.destroy', $item->id) }}" method="POST">
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

            <!-- Footer -->
            {{-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer> --}}
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   
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
                url: "{{ route('seller.status') }}",
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
    <script>
        $('input[name=verified]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();

            $.ajax({
                url: "{{ route('seller.verified') }}",
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
