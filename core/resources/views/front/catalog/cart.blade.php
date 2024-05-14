@extends('master.front')
@section('title')
    {{ __('Cart') }}
@endsection
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection
@section('content')
    <!-- cart section starts here -->
    <section class="cart-section my-8 my-lg-12">
        <div class="container">
            <!-- cart header -->
            <div class="container pb-60 pb-lg-100">
                <h2 class="mb-0 text-center fw-bold text-dark heading-h2">
                    Shopping Cart
                </h2>
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <div>
                        <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> Home </a>
                    </div>
                    <div class="text-gray-700 ms-2">-</div>
                    <p class="text-gray-700 ms-2 mb-0">Shop</p>
                </div>
            </div>
            <!-- cart header -->
            @if (Session::has('cart') && count(Session::get('cart')) > 0)
                <div id="view_cart_load">
                    @include('includes.cart')
                </div>
            @else
                <div class="container padding-bottom-3x mb-1">
                    <div class="card text-center">
                        <div class="card-body padding-top-2x">
                            <h3 class="card-title mb-10">{{ __('Your shopping cart is empty.') }}</h3>
                            <a class="text-uppercase w-100 w-lg-auto px-6 py-3 bg-gray-100 border-0 text-muted"
                                href="{{ route('front.catalog') }}">{{ __('View our products') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- cart section ends here -->

    <!-- delivery process section starts here -->
    <section class="delivery-section bg-gray-100 py-10 py-lg-13">
        <div class="container">
            <div class="w-100 w-lg-90 w-5xl-100 mx-auto">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="d-flex justify-content-lg-center align-items-center">
                            <div>
                                <img src="{{ asset('assets/images/cart-icon.svg') }}" alt="hand icons" class="img-fluid no-download" width="35" />
                            </div>
                            <div class="ms-5">
                                <h5 class="text-dark heading-h6 fw-bold mb-1">
                                    Low Minimums
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="d-flex justify-content-lg-center align-items-center">
                            <div>
                                <img src="{{ asset('assets/images/liquidity-icon.svg') }}" alt="hand icons" class="img-fluid no-download"  width="35" />
                            </div>
                            <div class="ms-5">
                                <h5 class="text-dark heading-h6 fw-bold mb-1">
                                    Sustainable Solutions
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 ">
                        <div class="d-flex justify-content-lg-center align-items-center">
                            <div>
                                <img src="{{ asset('assets/frontend/images/payment.png') }}" alt="hand icons" class="img-fluid no-download" />
                            </div>
                            <div class="ms-5">
                                <h5 class="text-dark heading-h6 fw-bold mb-1">
                                    Secure Payment
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="d-flex justify-content-lg-center align-items-center">
                            <div>
                                <img src="{{ asset('assets/frontend/images/support.png') }}" alt="hand icons" class="img-fluid no-download" />
                            </div>
                            <div class="ms-5">
                                <h5 class="text-dark heading-h6 fw-bold mb-1">
                                    24/7 Support
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  delivery process section ends here -->
@endsection
