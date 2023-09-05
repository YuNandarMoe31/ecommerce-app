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
                            <div class="col-lg-6 col-md-8 col-sm-12">
                                <h2><a href="javascript:void(0)" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                            class="fa fa-arrow-left"></i></a>Edit Currency</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Currencies
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Edit Currencies
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
                    <form action="{{ route('currency.update', $currency->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Currency Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Currency Name" name="name"
                                    value="{{ $currency->name }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="symbol">Currency Symbol <span class="text-danger">*</span></label>
                                <input type="text" id="symbol" class="form-control" id="symbol" placeholder="Currency Symbol" name="symbol" value="{{ $currency->symbol }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exchange_rate">Exchange Rate <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="exchange_rate" placeholder="Exchange Rate" name="exchange_rate"
                                    value="{{ $currency->exchange_rate }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="code">Code<span class="text-danger">*</span></label>
                                <input type="text" id="code" class="form-control" id="code" placeholder="Code" name="code" value="{{ $currency->code }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select id="status" name="status" class="form-control">
                                    <option value="active" {{ $currency->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $currency->status == 'inactive' ? 'selected' : '' }}>Inactive
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
