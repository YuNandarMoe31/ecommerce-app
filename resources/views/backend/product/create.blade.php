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
                                            class="fa fa-arrow-left"></i></a>Add Product</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin') }}"><i class="fas fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Products
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Add Products
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
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                    value="{{ old('title') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="summary">Summary</label>
                                <textarea type="text" class="form-control" id="summary" placeholder="Summary" name="summary">{{ old('summary') }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" placeholder="Description" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="stock">Stock <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="stock" placeholder="Stock" name="stock"
                                    value="{{ old('stock') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control" id="price" placeholder="Price"
                                    name="price" value="{{ old('price') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="discount">Discount</label>
                                <input type="number" min="0" max="100" step="any" class="form-control" id="discount"
                                    placeholder="Discount" name="discount" value="{{ old('discount') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Photo <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="brand_id">Brands</label>
                                <select id="brand_id" name="brand_id" class="form-control">
                                    <option selected>Brands</option>
                                    @foreach (\App\Models\Brand::get() as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vendor_id">Vendor</label>
                                <select id="vendor_id" name="vendor_id" class="form-control">
                                    <option selected>Vendor</option>
                                    @foreach (\App\Models\User::where('role', 'vendor')->get() as $vendor)
                                        <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="size">Size</label>
                                <select id="size" name="size" class="form-control">
                                    <option selected>size </option>
                                    <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>Small
                                    </option>
                                    <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>Large
                                    </option>
                                    <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>Extra Large
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cat_id">Category</label>
                                <select id="cat_id" name="cat_id" class="form-control">
                                    <option selected>Category</option>
                                    @foreach (\App\Models\Category::where('is_parent', 1)->get() as $category)
                                        <option value="{{ $category->id }}" {{ old('cat_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 d-none" id="child_cat_div">
                                <label for="child_cat_id">Child Category</label>
                                <select id="child_cat_id" name="child_cat_id" class="form-control">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option selected>Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="condition">Condition</label>
                                <select id="condition" name="condition" class="form-control">
                                    <option selected>Condition </option>
                                    <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New
                                    </option>
                                    <option value="popular" {{ old('condition') == 'popular' ? 'selected' : '' }}>Popular
                                    </option>
                                    <option value="winter" {{ old('condition') == 'winter' ? 'selected' : '' }}>Winter
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
        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>
    <script>
        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            if(cat_id != null) {
                $.ajax({
                    url: "/admin/category/"+cat_id+"/child",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cat_id: cat_id,
                    },
                    success: function(response) {
                        var html_option = "<option value=''>Child Category</option>";
                        if(response.status) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(response.data, function(id, title) {
                                html_option += "<option value='"+id+"'>"+title+"</option>"
                            });
                        }
                        else {
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                    }
                });
            }
        });
    </script>
@endsection
