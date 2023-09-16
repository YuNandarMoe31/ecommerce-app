{{-- @foreach ($products as $product) --}}
<!-- Single Product -->
<div class="single-product-area mb-30">
    <div class="product_image">
        @php
            $photo = explode(',', $product->photo);
        @endphp
        <!-- Product Image -->
        <img class="normal_img" src="{{ asset($photo[0]) }}" alt="">

        <!-- Product Badge -->
        <div class="product_badge">
            <span>{{ $product->condition }}</span>
        </div>

        <!-- Wishlist -->
        <div class="product_wishlist">
            <a href="javascript:void(0)" class="add_to_wishlist" data-quantity="1" data-id="{{ $product->id }}"
                id="add_to_wishlist_{{ $product->id }}"><i class="icofont-heart"></i></a>
        </div>

        <!-- Compare -->
        <div class="product_compare">
            <a href="compare.html"><i class="icofont-exchange"></i></a>
        </div>
    </div>

    <!-- Product Description -->
    <div class="product_description">
        <!-- Add to cart -->
        <div class="product_add_to_cart">
            <a href="#" data-quantity="1" data-product-id="{{ $product->id }}" class="add_to_cart"
                id="add_to_cart{{ $product->id }}"><i class="icofont-shopping-cart"></i> Add to
                Cart</a>
        </div>

        <!-- Quick View -->
        <div class="product_quick_view">
            <a href="#" data-toggle="modal" data-target="#quickview{{ $product->id }}"><i
                    class="icofont-eye-alt"></i> Quick
                View</a>
        </div>

        <p class="brand_name">
            {{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}
        </p>
        <a href="{{ route('product.detail', $product->slug) }}">{{ $product->title }}</a>
        <h6 class="product-price">$ {{ number_format($product->offer_price, 2) }}
            <small class="text-danger"><del>{{ number_format($product->price, 2) }}</del></small>
        </h6>
    </div>
</div>
<!-- Quick View Modal Area -->
<div class="modal fade" id="quickview{{ $product->id }}" tabindex="-1" role="dialog" data-backdrop="false"
    aria-labelledby="quickview" aria-hidden="true" style="background:rgba(0,0,0,0.5);z-index:99;">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="quickview_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="quickview_pro_img">
                                    @php
                                        $photo = explode(',', $product->photo);
                                    @endphp
                                    <!-- Product Image -->
                                    <img class="normal_img" src="{{ $photo[0] }}" alt="{{ $product->title }}">
                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span>{{ $product->condition }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="quickview_pro_des">
                                    <h4 class="title">{{ $product->title }}</h4>
                                    <div class="top_seller_product_rating mb-15">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <h6 class="price">$ {{ number_format($product->offer_price, 2) }}
                                        <small
                                            class="text-danger"><del>{{ number_format($product->price, 2) }}</del></small>
                                    </h6>
                                    <p>{{ $product->summary }}</p>
                                    <a href="{{ route('product.detail', $product->slug) }}">View Full Product
                                        Details</a>
                                </div>
                                <!-- Add to Cart Form -->
                                <form class="cart" method="post">
                                    {{-- <div class="quantity">
                                        <input type="number" class="qty-text" id="qty" step="1"
                                            min="1" max="12" name="quantity" value="1">
                                    </div> --}}
                                    <a href="#" data-quantity="1" data-product-id="{{ $product->id }}"
                                        class="add_to_cart" id="add_to_cart{{ $product->id }}"><i
                                            class="icofont-shopping-cart"></i> Add to
                                        Cart</a>
                                    <!-- Wishlist -->
                                    <div class="modal_pro_wishlist">
                                        <a href="javascript:void(0)" class="add_to_wishlist" data-quantity="1"
                                            data-id="{{ $product->id }}" id="add_to_wishlist_{{ $product->id }}"><i
                                                class="icofont-heart"></i></a>
                                    </div>
                                    <!-- Compare -->
                                    <div class="modal_pro_compare">
                                        <a href="compare.html"><i class="icofont-exchange"></i></a>
                                    </div>
                                </form>
                                <!-- Share -->
                                <div class="share_wf mt-30">
                                    <p>Share with friends</p>
                                    <div class="_icon">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View Modal Area -->
{{-- @endforeach --}}
