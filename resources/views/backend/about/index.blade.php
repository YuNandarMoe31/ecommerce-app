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
                                            class="fa fa-arrow-left"></i></a>Edit About Us</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-lg-12">
                            @include('backend.layouts.notification')
                        </div>
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
                    <form action="{{ route('about.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="heading">About Us Heading <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="heading" placeholder="About Us Heading"
                                    name="heading" value="{{ $about->heading }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="content">About Us Content</label>
                                <textarea rows="5" class="form-control" id="content" placeholder="About Us Content" name="content"
                                    value="{{ $about->content }}"></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="image">Image <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="image"
                                        value="{{ asset($about->image) }}">
                                </div>
                                <div id="holder">
                                    <img src="{{ asset($about->image) }}" alt=""
                                        style="max-width:100px;margin-top:15px;max-height:100px;">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="experience">Years of Experience</label>
                                <input type="text" class="form-control" id="experience" placeholder="Years of Experience"
                                    name="experience" value="{{ $about->experience }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="happy_customer">Happy Customer</label>
                                <input type="text" class="form-control" id="happy_customer" placeholder="Happy Customer"
                                    name="happy_customer" value="{{ $about->happy_customer }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="team_advisor">Team Advisor</label>
                                <input type="text" class="form-control" id="team_advisor" placeholder="Team Advisor"
                                    name="team_advisor" value="{{ $about->team_advisor }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="return_customer">Return Customer</label>
                                <input type="text" class="form-control" id="return_customer"
                                    placeholder="Return Customer" name="return_customer"
                                    value="{{ $about->return_customer }}">
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
        $('#lfm1').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
