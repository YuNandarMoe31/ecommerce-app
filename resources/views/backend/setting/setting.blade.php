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
                                            class="fa fa-arrow-left"></i></a>Edit Setting</h2>
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
                    <form action="{{ route('setting.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="title">Project Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                    value="{{ $setting->title }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="meta_keywords">Meta Keyword <span class="text-danger">*</span></label>
                                <input id="meta_keywords" class="form-control" id="meta_keywords" placeholder="Meta Keyword" name="meta_keywords" value="{{ $setting->meta_keywords }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="meta_description">Meta Description <span class="text-danger">*</span></label>
                                <textarea id="meta_description" rows="5" class="form-control" id="meta_description" placeholder="Meta Description" name="meta_description">{{ $setting->meta_description }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="footer">Footer </label>
                                <input id="footer" class="form-control" id="footer" placeholder="Footer" name="footer" value="{{ $setting->footer }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="favicon">Favicon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="favicon" value="{{ $setting->favicon }}">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="logo">Logo <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm1" data-input="thumbnail1" data-preview="holder1"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail1" class="form-control" type="text" name="logo" value="{{ $setting->logo }}">
                                </div>
                                <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" placeholder="Email Address" name="email"
                                    value="{{ $setting->email }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Address" name="address"
                                    value="{{ $setting->address }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="phone" placeholder="Phone" name="phone"
                                    value="{{ $setting->phone }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fax">Fax <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="fax" placeholder="Fax" name="fax"
                                    value="{{ $setting->fax }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="facebook_url">Facebook Url</label>
                                <input type="text" class="form-control" id="facebook_url" placeholder="Facebook Url" name="facebook_url"
                                    value="{{ $setting->facebook_url }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="twitter_url">Twitter Url</label>
                                <input type="text" class="form-control" id="twitter_url" placeholder="Twitter Url" name="twitter_url"
                                    value="{{ $setting->twitter_url }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="linkedin_url">Linkedin Url</label>
                                <input type="text" class="form-control" id="linkedin_url" placeholder="Linkedin Url" name="linkedin_url"
                                    value="{{ $setting->linkedin_url }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pinterest_url">Pinterest Url</label>
                                <input type="text" class="form-control" id="pinterest_url" placeholder="Pinterest Url" name="pinterest_url"
                                    value="{{ $setting->pinterest_url }}">
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
