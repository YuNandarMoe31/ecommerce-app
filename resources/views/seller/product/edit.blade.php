@extends('seller.layouts.master')

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
                    <form action="{{ route('seller-product.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                    value="{{ $product->title }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="summary">Summary</label>
                                <textarea type="text" class="form-control" id="summary" placeholder="Summary" name="summary">{{ $product->summary }}</textarea>
                            </div>
                            <div class="description form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" placeholder="Description" name="description">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="stock">Stock <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="stock" placeholder="Stock" name="stock"
                                    value="{{ $product->stock }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control" id="price" placeholder="Price"
                                    name="price" value="{{ $product->price }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="discount">Discount</label>
                                <input type="number" min="0" max="100" step="any" class="form-control"
                                    id="discount" placeholder="Discount" name="discount" value="{{ $product->discount }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Photo <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail1" data-preview="holder1"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail1" class="form-control" type="text" name="photo"
                                        value="{{ $product->photo }}">
                                </div>
                                <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                            <div class=" form-group col-md-12">
                                <label for="description">Size Guide <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm2" data-input="thumbnail2" data-preview="holder2"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail2" class="form-control" type="text" name="size_guide" value="{{ $product->size_guide }}">
                                </div>
                                <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="brand_id">Brands</label>
                                <select id="brand_id" name="brand_id" class="form-control">
                                    <option selected>Brands</option>
                                    @foreach (\App\Models\Brand::get() as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="size">Size</label>
                                <select id="size" name="size" class="form-control">
                                    <option>size </option>
                                    <option value="S" {{ $product->size == 'S' ? 'selected' : '' }}>Small
                                    </option>
                                    <option value="M" {{ $product->size == 'M' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="L" {{ $product->size == 'L' ? 'selected' : '' }}>Large
                                    </option>
                                    <option value="XL" {{ $product->size == 'XL' ? 'selected' : '' }}>Extra Large
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cat_id">Category</label>
                                <select id="cat_id" name="cat_id" class="form-control">
                                    <option>Category</option>
                                    @foreach (\App\Models\Category::where('is_parent', 1)->get() as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->cat_id ? 'selected' : '' }}>
                                            {{ $category->title }}</option>
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
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="condition">Condition</label>
                                <select id="condition" name="condition" class="form-control">
                                    <option selected>Condition </option>
                                    <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}>New
                                    </option>
                                    <option value="popular" {{ $product->condition == 'popular' ? 'selected' : '' }}>
                                        Popular
                                    </option>
                                    <option value="winter" {{ $product->condition == 'winter' ? 'selected' : '' }}>Winter
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="additional_info">Additional Info</label>
                                <textarea type="text" class="description form-control" id="additional_info" placeholder="Additional Info"
                                    name="additional_info">{{ $product->additional_info }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="return_cancellation">Return Cancellation</label>
                                <textarea type="text" class="description form-control" id="return_cancellation" placeholder="Return Cancellation"
                                    name="return_cancellation">{{ $product->return_cancellation }}</textarea>
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
        $('#lfm1, #lfm2').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('.description').summernote();
        });
        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>
    <script>
        var child_cat_id = {{ $product->child_cat_id }};
        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            if (cat_id != null) {
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cat_id: cat_id,
                    },
                    success: function(response) {
                        var html_option = "<option value=''>Child Category</option>";
                        if (response.status) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(response.data, function(id, title) {
                                html_option += "<option value='" + id + "' " + (child_cat_id ==
                                    id ? 'selected' : '') + ">" + title + "</option>"
                            });
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                    }
                });
            }
        });
        if (child_cat_id != null) {
            $('#cat_id').change();
        }
    </script>
@endsection
