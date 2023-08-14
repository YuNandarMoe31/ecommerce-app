@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Address</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">My Address</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="my-account-navigation mb-50">
                        <ul>
                            @include('frontend.user.sidebar')
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <h6 class="mb-3">Billing Address</h6>
                                <address>
                                    @if ($user->address || $user->state || $user->city || $user->country || $user->postcode)
                                        {{ $user->address }} <br>
                                        {{ $user->state }} <br>
                                        {{ $user->city }} <br>
                                        {{ $user->country }} <br>
                                        {{ $user->postcode }}
                                    @else
                                        No address information available.
                                    @endif
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addressModal">Edit Address</a>
                            </div>

                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                <address>
                                    @if ($user->saddress || $user->sstate || $user->scity || $user->scountry || $user->spostcode)
                                        {{ $user->saddress }} <br>
                                        {{ $user->sstate }} <br>
                                        {{ $user->scity }} <br>
                                        {{ $user->scountry }} <br>
                                        {{ $user->spostcode }}
                                    @else
                                        No shipping address information available.
                                    @endif
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#shippingModal">Edit Shipping Address</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Address Modal -->
            <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addressModalLabel">Edit Address</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('billing.address', $user->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control">{{ $user->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" name="country" id="country"
                                        value="{{ $user->country }}">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" id="city"
                                        value="{{ $user->city }}">
                                </div>
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="number" class="form-control" name="postcode" id="postcode"
                                        value="{{ $user->postcode }}">
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state" id="state"
                                        value="{{ $user->state }}">
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Modal -->
            <div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="shippingModalLabel">Edit Shipping Address</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('shipping.address', $user->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="saddress">Shipping Address</label>
                                    <textarea name="saddress" id="saddress" class="form-control">{{ $user->saddress }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="scountry">Shipping Country</label>
                                    <input type="text" class="form-control" name="scountry" id="scountry"
                                        value="{{ $user->scountry }}">
                                </div>
                                <div class="form-group">
                                    <label for="scity">Shipping City</label>
                                    <input type="text" class="form-control" name="scity" id="scity"
                                        value="{{ $user->scity }}">
                                </div>
                                <div class="form-group">
                                    <label for="spostcode">Shipping Postcode</label>
                                    <input type="number" class="form-control" name="spostcode" id="spostcode"
                                        value="{{ $user->spostcode }}">
                                </div>
                                <div class="form-group">
                                    <label for="sstate">Shipping State</label>
                                    <input type="text" class="form-control" name="sstate" id="sstate"
                                        value="{{ $user->sstate }}">
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->
@endsection
