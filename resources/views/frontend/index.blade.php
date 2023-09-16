@extends('frontend.layouts.master')

@section('content')
    <!-- Welcome Slides Area -->
    @if (count($banners) > 0)
        <section class="welcome_area">
            <div class="welcome_slides owl-carousel">
                <!-- Single Slide -->
                @foreach ($banners as $banner)
                    <div class="single_slide bg-img" style="background-image: url({{ $banner->photo }})">
                        <div class="container h-100">
                            <div class="row h-100 align-items-center">
                                <div class="col-7 col-md-8">
                                    <div class="welcome_slide_text">
                                        <p data-animation="fadeInUp" data-delay="0">{{ $banner->title }}</p>
                                        <h2 data-animation="fadeInUp" data-delay="300ms">{!! $banner->description !!}</h2>
                                        <a href="{{ $banner->slug }}" class="btn btn-primary" data-animation="fadeInUp"
                                            data-delay="1s">Buy
                                            Now</a>
                                    </div>
                                </div>
                                <div class="col-5 col-md-4">
                                    <div class="welcome_slide_image">
                                        <img src="frontend/img/bg-img/slide-1.png" alt=""
                                            data-animation="bounceInUp" data-delay="500ms">
                                        <div class="discount_badge" data-animation="bounceInDown" data-delay="1.2s">
                                            <span>30%<br>OFF</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    <!-- Welcome Slides Area -->

    @if (count($categories) > 0)
        <!-- Top Catagory Area -->
        <div class="top_catagory_area mt-50 clearfix">
            <div class="container">
                <div class="row">
                    @foreach ($categories as $category)
                        <!-- Single Catagory -->
                        <div class="col-12 col-md-4">
                            <div class="single_catagory_area mt-50">
                                <a href="{{ route('product.category', $category->slug) }}">
                                    <img src="{{ $category->photo }}" alt="{{ $category->title }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Top Catagory Area -->
    @endif

    @if (count($new_products) > 0)
        <!-- New Arrivals Area -->
        <section class="new_arrivals_area section_padding_100 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_heading new_arrivals">
                            <h5>New Arrivals</h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($new_products as $new_product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            @include('frontend.layouts._single-product', ['product' => $new_product])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- New Arrivals Area -->
    @endif

    <!-- Featured Products Area -->
    <section class="featured_product_area">
        <div class="container">
            <div class="row">
                <!-- Featured Offer Area -->
                <div class="col-12 col-lg-6">
                    <div class="featured_offer_area d-flex align-items-center"
                        style="background-image: url({{ asset($promo_banner->photo) }});">
                        <div class="featured_offer_text">
                            <h2>{!! nl2br($promo_banner->title) !!}</h2>
                            <h4>{!! $promo_banner->description !!}</h4>
                            <a href="{{ $promo_banner->slug }}" class="btn btn-primary btn-sm mt-3">Shop Now</a>
                        </div>
                    </div>
                </div>

                <!-- Featured Product Area -->
                <div class="col-12 col-lg-6">
                    <div class="section_heading featured">
                        <h5>Featured Products</h5>
                    </div>

                    <!-- Featured Product Slides -->
                    <div class="featured_product_slides owl-carousel">
                        @foreach ($featured_products as $featured_product)
                            @include('frontend.layouts._single-product', ['product' => $featured_product])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Products Area -->

    <!-- Best Rated/Onsale/Top Sale Product Area -->
    <section class="best_rated_onsale_top_sellares section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tabs_area">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-tab">
                            <li class="nav-item">
                                <a href="#top-sellers" class="nav-link" data-toggle="tab" role="tab">Top
                                    Sellers</a>
                            </li>
                            <li class="nav-item">
                                <a href="#best-rated" class="nav-link" data-toggle="tab" role="tab">Best
                                    Rated</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#on-sale" class="nav-link active" data-toggle="tab" role="tab">On
                                    Sale</a>
                            </li> --}}
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="top-sellers">
                                <div class="top_sellers_area">
                                    <div class="row">
                                        @foreach ($best_sellers as $product)
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_top_sellers">
                                                    <div class="top_seller_image">
                                                        @php
                                                            $photo = explode(',', $product->photo);
                                                        @endphp
                                                        <img src="{{ asset($photo[0]) }}" alt="Top-Sellers">
                                                    </div>
                                                    <div class="top_seller_desc">
                                                        <h5>{{ ucfirst($product->title) }}</h5>
                                                        <h6>{{ Helpers::currency_converter($product->offer_price) }}
                                                            <span>{{ Helpers::currency_converter($product->price) }}</span>
                                                        </h6>
                                                        <div class="top_seller_product_rating">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if (round($product->reviews->avg('rate')) > $i)
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                @else
                                                                    <i class="far fa-star" aria-hidden="true"></i>
                                                                @endif
                                                            @endfor
                                                        </div>

                                                        <!-- Info -->
                                                        <div
                                                            class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                            <!-- Add to cart -->
                                                            <div class="ts_product_add_to_cart">
                                                                <a href="javascript::void(0)" data-quantity="1"
                                                                    data-product-id="{{ $product->id }}"
                                                                    class="add_to_cart"
                                                                    id="add_to_cart{{ $product->id }}"><i
                                                                        class="icofont-shopping-cart"></i></a>
                                                                {{-- <a href="#" data-toggle="tooltip"
                                                                    data-placement="top" title="Add To Cart"><i
                                                                        class="icofont-shopping-cart"></i></a> --}}
                                                            </div>

                                                            <!-- Wishlist -->
                                                            <div class="ts_product_wishlist">
                                                                <a href="javascript:void(0)" class="add_to_wishlist"
                                                                    data-quantity="1" data-id="{{ $product->id }}"
                                                                    id="add_to_wishlist_{{ $product->id }}"><i
                                                                        class="icofont-heart"></i></a>
                                                            </div>

                                                            <!-- Compare -->
                                                            {{-- <div class="ts_product_compare">
                                                                <a href="compare.html" data-toggle="tooltip"
                                                                    data-placement="top" title="Compare"><i
                                                                        class="icofont-exchange"></i></a>
                                                            </div> --}}

                                                            <!-- Quick View -->
                                                            <div class="ts_product_quick_view">
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#quickview{{ $product->id }}"><i
                                                                        class="icofont-eye-alt"></i> </a>
                                                            </div>
                                                            <!-- Quick View Modal Area -->
                                                            <div class="modal fade" id="quickview{{ $product->id }}"
                                                                tabindex="-1" role="dialog" data-backdrop="false"
                                                                aria-labelledby="quickview" aria-hidden="true"
                                                                style="background:rgba(0,0,0,0.5);z-index:99;">
                                                                <div class="modal-dialog modal-lg modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <button type="button" class="close btn"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <div class="modal-body">
                                                                            <div class="quickview_body">
                                                                                <div class="container">
                                                                                    <div class="row">
                                                                                        <div class="col-12 col-lg-5">
                                                                                            <div class="quickview_pro_img">
                                                                                                @php
                                                                                                    $photo = explode(',', $new_product->photo);
                                                                                                @endphp
                                                                                                <!-- Product Image -->
                                                                                                <img class="normal_img"
                                                                                                    src="{{ $photo[0] }}"
                                                                                                    alt="{{ $new_product->title }}">
                                                                                                <!-- Product Badge -->
                                                                                                <div class="product_badge">
                                                                                                    <span>{{ $new_product->condition }}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-lg-7">
                                                                                            <div class="quickview_pro_des">
                                                                                                <h4 class="title">
                                                                                                    {{ $product->title }}
                                                                                                </h4>
                                                                                                <div
                                                                                                    class="top_seller_product_rating mb-15">
                                                                                                    @for ($i = 0; $i < 5; $i++)
                                                                                                        @if (round($product->reviews->avg('rate')) > $i)
                                                                                                            <i class="fa fa-star"
                                                                                                                aria-hidden="true"></i>
                                                                                                        @else
                                                                                                            <i class="far fa-star"
                                                                                                                aria-hidden="true"></i>
                                                                                                        @endif
                                                                                                    @endfor

                                                                                                </div>
                                                                                                <h6 class="price">$
                                                                                                    {{ number_format($product->offer_price, 2) }}
                                                                                                    <small
                                                                                                        class="text-danger"><del>{{ number_format($product->price, 2) }}</del></small>
                                                                                                </h6>
                                                                                                <p>{{ $product->summary }}
                                                                                                </p>
                                                                                                <a
                                                                                                    href="{{ route('product.detail', $product->slug) }}">View
                                                                                                    Full Product
                                                                                                    Details</a>
                                                                                            </div>
                                                                                            <!-- Add to Cart Form -->
                                                                                            <form class="cart"
                                                                                                method="post">
                                                                                                {{-- <div class="quantity">
                                        <input type="number" class="qty-text" id="qty" step="1"
                                            min="1" max="12" name="quantity" value="1">
                                    </div> --}}
                                                                                                <a href="#"
                                                                                                    data-quantity="1"
                                                                                                    data-product-id="{{ $product->id }}"
                                                                                                    class="add_to_cart"
                                                                                                    id="add_to_cart{{ $product->id }}"><i
                                                                                                        class="icofont-shopping-cart"></i>
                                                                                                    Add to
                                                                                                    Cart</a>
                                                                                                <!-- Wishlist -->
                                                                                                <div
                                                                                                    class="modal_pro_wishlist">
                                                                                                    <a href="javascript:void(0)"
                                                                                                        class="add_to_wishlist"
                                                                                                        data-quantity="1"
                                                                                                        data-id="{{ $product->id }}"
                                                                                                        id="add_to_wishlist_{{ $product->id }}"><i
                                                                                                            class="icofont-heart"></i></a>
                                                                                                </div>
                                                                                                <!-- Compare -->
                                                                                                <div
                                                                                                    class="modal_pro_compare">
                                                                                                    <a href="compare.html"><i
                                                                                                            class="icofont-exchange"></i></a>
                                                                                                </div>
                                                                                            </form>
                                                                                            <!-- Share -->
                                                                                            <div class="share_wf mt-30">
                                                                                                <p>Share with friends</p>
                                                                                                <div class="_icon">
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-facebook"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-twitter"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-pinterest"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-linkedin"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-instagram"
                                                                                                            aria-hidden="true"></i></a>
                                                                                                    <a href="#"><i
                                                                                                            class="fa fa-envelope-o"
                                                                                                            aria-hidden="true"></i></a>
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="best-rated">
                                <div class="best_rated_area">
                                    <div class="row">
                                        @foreach ($best_rated as $product)
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_top_sellers">
                                                    <div class="top_seller_image">
                                                        @php
                                                            $photo = explode(',', $product->photo);
                                                        @endphp
                                                        <img src="{{ asset($photo[0]) }}" alt="Top-Rated">
                                                    </div>
                                                    <div class="top_seller_desc">
                                                        <h5>{{ ucfirst($product->title) }}</h5>
                                                        <h6>{{ Helpers::currency_converter($product->offer_price) }}
                                                            <span>{{ Helpers::currency_converter($product->price) }}</span>
                                                        </h6>
                                                        <div class="top_seller_product_rating">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if (round($product->reviews->avg('rate')) > $i)
                                                                    <i class="fa fa-star"
                                                                        aria-hidden="true"></i>
                                                                @else
                                                                    <i class="far fa-star"
                                                                        aria-hidden="true"></i>
                                                                @endif
                                                            @endfor
                                                        </div>

                                                        <!-- Info -->
                                                        <div
                                                            class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                            <!-- Add to cart -->
                                                            <div class="ts_product_add_to_cart">
                                                                <a href="#" data-quantity="1"
                                                                    data-product-id="{{ $product->id }}"
                                                                    class="add_to_cart"
                                                                    id="add_to_cart{{ $product->id }}"><i
                                                                        class="icofont-shopping-cart"></i> </a>
                                                            </div>

                                                            <!-- Wishlist -->
                                                            <div class="ts_product_wishlist">
                                                                <a href="javascript:void(0)" class="add_to_wishlist"
                                                                    data-quantity="1" data-id="{{ $product->id }}"
                                                                    id="add_to_wishlist_{{ $product->id }}"><i
                                                                        class="icofont-heart"></i></a>
                                                            </div>

                                                            <!-- Compare -->
                                                            {{-- <div class="ts_product_compare">
                                                                <a href="compare.html" data-toggle="tooltip"
                                                                    data-placement="top" title="Compare"><i
                                                                        class="icofont-exchange"></i></a>
                                                            </div> --}}

                                                            <!-- Quick View -->
                                                            <div class="ts_product_quick_view">
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#quickview{{ $product->id }}"><i
                                                                        class="icofont-eye-alt"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- <div role="tabpanel" class="tab-pane fade show active" id="on-sale">
                                <div class="on_sale_area">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="{{ asset('frontend/img/product-img/onsale-1.png') }}"
                                                        alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Speaker</h5>
                                                    <h6>$60 <span>$70</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="{{ asset('frontend/img/product-img/onsale-2.png') }}"
                                                        alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Fancy Lamp</h5>
                                                    <h6>$34 <span>$40</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="{{ asset('frontend/img/product-img/onsale-3.png') }}"
                                                        alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Sport Bra</h5>
                                                    <h6>$63 <span>$70</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="{{ asset('frontend/img/product-img/onsale-4.png') }}"
                                                        alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>S'well Water</h5>
                                                    <h6>$12 <span>$13</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="{{ asset('frontend/img/product-img/onsale-5.png') }}"
                                                        alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Slipper</h5>
                                                    <h6>$24 <span>$36</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="{{ asset('frontend/img/product-img/onsale-6.png') }}"
                                                        alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>T-shirt</h5>
                                                    <h6>$96 <span>$120</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Best Rated/Onsale/Top Sale Product Area -->

    <!-- Offer Area -->
    <section class="offer_area">
        <div class="container">
            <div class="row">
                <!-- Beach Offer -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="beach_offer_area mb-4 mb-md-0">
                        <img src="{{ asset('frontend/img/product-img/beach.png') }}" alt="beach-offer">
                        <div class="beach_offer_info">
                            <p>Upto 70% OFF</p>
                            <h3>Beach Item</h3>
                            <a href="#" class="btn btn-primary btn-sm mt-15">SHOP NOW</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Apparels Offer -->
                    <div class="apparels_offer_area">
                        <img src="{{ asset('frontend/img/product-img/apparels.jpg') }}" alt="Beach-Offer">
                        <div class="apparels_offer_info d-flex align-items-center">
                            <div class="apparels-offer-content">
                                <h4>Apparel &amp; <br><span>Garments</span></h4>
                                <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Deals of the Week -->
                    <div class="weekly_deals_area mt-30">
                        <img src="{{ asset('frontend/img/product-img/weekly-offer.jpg') }}" alt="weekly-deals">
                        <div class="weekly_deals_info">
                            <h4>Deals of the Week</h4>
                            <div class="deals_timer">
                                <ul data-countdown="2021/02/14 14:21:38">
                                    <!-- Please use event time this format: YYYY/MM/DD hh:mm:ss -->
                                    <li><span class="days">00</span>days</li>
                                    <li><span class="hours">00</span>hours</li>
                                    <li class="d-block blank-timer"></li>
                                    <li><span class="minutes">00</span>min</li>
                                    <li><span class="seconds">00</span>sec</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Elect Offer -->
                            <div class="elect_offer_area mt-30 mt-lg-0">
                                <img src="{{ asset('frontend/img/product-img/elect.jpg') }}" alt="Elect-Offer">
                                <div class="elect_offer_info d-flex align-items-center">
                                    <div class="elect-offer-content">
                                        <h4>Electronics</h4>
                                        <a href="#" class="btn">Buy Now <i
                                                class="icofont-rounded-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Backpack Offer -->
                            <div class="backpack_offer_area mt-30">
                                <img src="{{ asset('frontend/img/product-img/backpack.jpg') }}" alt="Backpack-Offer">
                                <div class="backpack_offer_info">
                                    <h4>Backpacks</h4>
                                    <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Offer Area End -->

    <!-- Popular Brands Area -->
    @if (count($brands) > 0)
        <section class="popular_brands_area section_padding_100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="popular_section_heading mb-50">
                            <h5>Popular Brands</h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="popular_brands_slide owl-carousel">
                            @foreach ($brands as $item)
                                <div class="single_brands">
                                    <img src="{{ asset($item->photo) }}" alt="{{ $item->title }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Popular Brands Area -->

    <!-- Special Featured Area -->
    <section class="special_feature_area pt-5">
        <div class="container">
            <div class="row">
                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-ship"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Free Shipping</h6>
                            <p>For orders above $100</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-box"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Happy Returns</h6>
                            <p>7 Days free Returns</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-money"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>100% Money Back</h6>
                            <p>If product is damaged</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-live-support"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Dedicated Support</h6>
                            <p>We provide support 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Special Featured Area -->
@endsection

@section('scripts')
@endsection
