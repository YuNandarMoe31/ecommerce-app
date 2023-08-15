@extends('backend.layouts.master')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="block-header">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h2><a href="javascript:void(0)" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                            class="fa fa-arrow-left"></i></a>Edit Coupon</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Coupons
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Add Coupons
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="code">Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="code" placeholder="code" name="code"
                                    value="{{ $coupon->code }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="value">Coupon Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="value" placeholder="value" name="value"
                                    value="{{ $coupon->value }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="status">Coupon Status <span class="text-danger">*</span></label>
                                <select id="status" name="status" class="form-control">
                                    <option selected>Status</option>
                                    <option value="active" {{ $coupon->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $coupon->status == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type">Coupon Type <span class="text-danger">*</span></label>
                                <select id="type" name="type" class="form-control">
                                    <option selected>type </option>
                                    <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed
                                    </option>
                                    <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent
                                    </option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
