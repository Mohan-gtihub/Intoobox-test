@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection
@section('title')
    {{ __('About') }}
@endsection

@section('content')
    <div class="container">
        <!-- about us header/breadcrumb -->
        <div class="pt-12 pt-lg-8 pb-12 pb-lg-80">
            <h2 class="mb-0 text-center fw-bold text-dark heading-h2">
                About Us
            </h2>
            <div class="d-flex align-items-center justify-content-center mt-4">
                <div>
                    <a href="{{ route('front.index') }}" class="fs-16 fw text-dark"> Home </a>
                </div>
                <div class="text-gray-700 ms-2">-</div>
                <p class="text-gray-700 ms-2 mb-0">About Us</p>
            </div>
        </div>
        <!-- about us header/breadcrumb -->

        <!-- about us container -->
        <div class="row w-lg-80 m-auto">
            <div class="col-md-6 pe-md-6">
                <div>
                    <img src="{{ asset('assets/frontend/images/about-img-1.png') }}" alt="" class="about-img" />
                </div>
                <h4 class="heading-h4 fw-bold mb-0 mt-4">
                    Know More About IN TOO BOX
                </h4>
                <p class="text-muted mb-0 mt-4">
                    Our aim is to offer our clients with reliable packaging solutions
                    that are both practical and cost effective. We seek to adapt and
                    be in trend with the latest packing needs and ensure customer's
                    satisfaction with our diverse range of products while providing
                    our customers with reliable and efficient customer service.
                </p>
            </div>
            <div class="col-md-6 mt-6 mt-md-0 ps-md-6">
                <div>
                    <img src="{{ asset('assets/frontend/images/about-img-2.png') }}" alt="" class="about-img" />
                </div>
                <h4 class="heading-h4 fw-bold mb-0 mt-4">Who We Are</h4>
                <p class="text-muted mb-0 mt-4">
                    Established in Year 2022, In Too Box has been designing and
                    manufacturing Standard Card Board Boxes, Rigid Boxes, Corporate
                    Gifting, Protective Packaging and offering an extensive range of
                    ancillary products to the wider Indian market. At In Too Box, our
                    goal is to be more than just another supplier; we strive to be the
                    easiest and most cost effective packaging supplier.
                </p>
            </div>
        </div>
        <!-- about us container -->
    </div>

    <!-- why choose us section -->
    <section class="why-choose-section bg-gray-100 py-12 mt-60 mt-lg-80 py-lg-60">
        <div class="container">
            <div class="text-center">
                <h2 class="heading-h2 mb-0">Why Choose Us</h2>
                <p class="text-muted mb-0">Our Benefit</p>
            </div>

            <div class="row mt-12 mt-60">
                <div class="col-md-6 pe-md-6">
                    <div class="video-thumb position-relative overflow-hidden">
                        <!-- The image -->
                        <!-- <img
                    src="{{ asset('assets/frontend/images/about-img-2.png') }}"
                    alt="Thumbnail"
                    class="w-full"
                  /> -->

                        <!-- The button -->
                        <a href="#" class="play-video absolute bg-danger" data-mfp-src="https://www.youtube.com/embed/YOUR_VIDEO_ID">
                            <img src="{{ asset('assets/frontend/images/play.png') }}" alt="" class="w-auto h-auto object-cover" />
                        </a>
                    </div>
                </div>
                <div class="col-md-6 mt-6 mt-md-0 ps-md-6">
                    <div class="d-flex">
                        <div>
                            <img src="{{ asset('assets/frontend/images/cart-icon.svg') }}" alt="hand icons" class="img-fluid" width="35" />
                        </div>
                        <div class="ms-6 ms-lg-9">
                            <h5 class="text-dark heading-h4 fw-bold mb-4">
                              Low Minimums
                            </h5>
                            <p class="text-gray-700 text-base fs-16 mb-0">
                                For all order over 99$. It has been arrived as soon as
                                possible
                            </p>
                        </div>
                    </div>

                    <div class="d-flex mt-6 mt-lg-8">
                        <div>
                            <img src="{{ asset('assets/frontend/images/support.png') }}" alt="hand icons" class="img-fluid" />
                        </div>
                        <div class="ms-6 ms-lg-9">
                            <h5 class="text-dark heading-h4 fw-bold mb-4">
                                24/7 Support
                            </h5>
                            <p class="text-gray-700 text-base fs-16 mb-0">
                                If goods have Problems. It has been achieving great heights
                                so far as its popularity
                            </p>
                        </div>
                    </div>

                    <div class="d-flex mt-6 mt-lg-8">
                        <div>
                            <img src="{{ asset('assets/frontend/images/payment.png') }}" alt="hand icons" class="img-fluid" />
                        </div>
                        <div class="ms-6 ms-lg-9">
                            <h5 class="text-dark heading-h4 fw-bold mb-4">
                                Secure Payment
                            </h5>
                            <p class="text-gray-700 text-base fs-16 mb-0">
                                If goods have Problems. It has been achieving great heights
                                so far as its popularity
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- why choose us section -->

    <!-- our team section -->
    <section class="our-team-section mt-60 mt-lg-80">
        <div class="container">
            <div class="text-center">
                <h2 class="heading-h2 mb-0">Our Design Team</h2>
                <p class="text-muted mb-0 text-center mt-3">
                    On the other hand, we denounce with righteous indignation and
                    dislike <br class="d-none d-md-block" />
                    men who are so beguiled and demoralized
                </p>
            </div>
            <div class="mt-6 mt-8">
                <div class="row">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="team-container">
                                <img src="{{ asset('assets/frontend/images/team-img-1.png') }}" alt="" class="team-img" />
                                <div class="team-info bg-danger text-white px-4 py-3">
                                    <span class="fw-semibold"> Diane Thompson </span>
                                    <span class="ms-2">/</span>
                                    <span class="ms-2">Leader Design</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-6 mt-lg-0">
                            <div class="team-container">
                                <img src="{{ asset('assets/frontend/images/team-img-2.png') }}" alt="" class="team-img" />
                                <div class="team-info bg-danger text-white px-4 py-3">
                                    <span class="fw-semibold"> Diane Thompson </span>
                                    <span class="ms-2">/</span>
                                    <span class="ms-2">Leader Design</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-6 mt-lg-0">
                            <div class="team-container">
                                <img src="{{ asset('assets/frontend/images/team-img-3.png') }}" alt="" class="team-img" />
                                <div class="team-info bg-danger text-white px-4 py-3">
                                    <span class="fw-semibold"> Diane Thompson </span>
                                    <span class="ms-2">/</span>
                                    <span class="ms-2">Leader Design</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our team section -->

    <!-- logo grid section starts here -->
    @if ($extra_settings->is_t2_brand_section == 1)
        <div class="py-12 py-lg-60 w-100 w-lg-90 container w-5xl-100 mx-auto">
            <!-- Additional required wrapper -->
            <style>
                .brand-slider .owl-nav.disabled {
                    display: block;
                }
            </style>
            <div class="brand-slider owl-carousel">
                @foreach ($brands as $brand)
                    <div class="slider-item p-2 logo-wrap d-flex justify-content-center">
                        <img class="d-block hi-50 lazy" src="{{ asset('assets/images/' . $brand->photo) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <!--  logo grid  section ends here -->
@endsection
