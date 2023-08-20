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
                                            class="fa fa-arrow-left"></i></a>Add Shipping</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Shippings
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Add Shippings
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
                    <form action="{{ route('shipping.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="shipping_address">Shipping Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_address" placeholder="Shipping Address" name="shipping_address"
                                    value="{{ old('shipping_address') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="delivery_time">Delivery Time<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="delivery_time" placeholder="Delivery Time" name="delivery_time"
                                    value="{{ old('delivery_time') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="delivery_charge">Delivery Charge</label>
                                <input type="number" step="any" class="form-control" id="delivery_charge" placeholder="Delivery Charge" name="delivery_charge"
                                    value="{{ old('delivery_charge') }}">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select id="status" name="status" class="form-control">
                                    <option selected>Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
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
