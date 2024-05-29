<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @if (url()->current() == route('front.index'))
        <title>@yield('hometitle')</title>
    @else
        <title>{{ $setting->title }} -@yield('title')</title>
    @endif

    <!-- SEO Meta Tags-->
    @yield('meta')
    <meta name="author" content="{{ $setting->title }}">
    <meta name="distribution" content="web">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Favicon Icons-->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('assets/images/' . $setting->favicon) }}">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontsawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}?v=1.0">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/omni.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/jquery.countdown.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/swiper.min.css') }}" />
    @yield('styleplugins')
    <!-- Color css -->
    {{-- <link
        href="{{ asset('assets/front/css/color.php?primary_color=') . str_replace('#', '', $setting->primary_color) }}"
        rel="stylesheet"> --}}

    <!-- Modernizr-->
    <script src="{{ asset('assets/front/js/modernizr.min.js') }}"></script>

    @if (DB::table('languages')->where('is_default', 1)->first()->rtl == 1)
        <link rel="stylesheet" href="{{ asset('assets/front/css/rtl.css') }}">
    @endif
    <style>
        {{ $setting->custom_css }}
    </style>
    {{-- Google AdSense Start --}}
    @if ($setting->is_google_adsense == '1')
        {!! $setting->google_adsense !!}
    @endif
    {{-- Google AdSense End --}}

    {{-- Google AnalyTics Start --}}
    @if ($setting->is_google_analytics == '1')
        {!! $setting->google_analytics !!}
    @endif
    {{-- Google AnalyTics End --}}

    {{-- Facebook pixel  Start --}}
    @if ($setting->is_facebook_pixel == '1')
        {!! $setting->facebook_pixel !!}
    @endif
    {{-- Facebook pixel End --}}

</head>
<!-- Body-->

<body
    class="
@if ($setting->theme == 'theme1') body_theme1
@elseif($setting->theme == 'theme2')
body_theme2
@elseif($setting->theme == 'theme3')
body_theme3
@elseif($setting->theme == 'theme4')
body_theme4 @endif
">
    {{-- @if ($setting->is_loader == 1) --}}
    <!-- Preloader Start -->
    @if ($setting->is_loader == 1)
        <div id="preloader">
            <img src="{{ asset('assets/images/' . $setting->loader) }}" alt="{{ __('Loading...') }}">
        </div>
    @endif

    <!-- Preloader endif -->
    {{-- @endif --}}
    @if ($setting->theme == 'theme2')
        <!-- top bar -->
        <div class="container-fluide">
            <!-- top marquee -->
            <div id="shopify-section-sections--14861833830490__announcement-bar" class="shopify-section shopify-section-group-header-group">
                <div class="announcement-bar d-block active-screen" role="region" aria-label="Announcement" style="opacity: 1; visibility: visible">
                    <div class="container layout--scroll">
                        <div class="row">
                            @for ($i = 0; $i < 12; $i++)
                                <div class="announcement-bar__item-scroll">
                                    <div class="announcement-bar__message text-center">
                                        <p class="mb-0 fs-14" style="line-height: 1">
                                            {{ $setting->top_nav_text }}
                                        </p>
                                    </div>
                                </div>
                            @endfor

                        </div>
                    </div>
                </div>
            </div>
            <!-- top marquee -->
        </div>
        <!-- topbar-->
        <!-- searchbar for mobile and tab -->
        <div class="mob-search align-items-center px-4 bg-white py-4 py-md-8 shadow-sm w-100">
            <form action="{{ route('front.catalog') }}" class="d-flex border align-items-center flex-grow-1">
                <input type="text" name="search" class="form-control text-muted fs-14  border-0 bg-transparent" placeholder="Start Searching . . . ." aria-label="search-bar"
                    aria-describedby="serach-bar" />
                <button type="submit" class="bg-transparent search-btn pt-2 pe-2 border-0" id="mobile-search-action">
                    <i class="fas fa-search fs-22 text-gray-600"></i>
                </button>
            </form>
            <div>
                <i id="hideMobSearch" class="fas fa-times pt-2 fs-28 ms-4 ms-lg-6 text-muted"></i>
            </div>
        </div>
        <!-- searchbar for mobile and tab -->
        @php
            $categories = App\Models\Category::with([
                'subcategory' => function ($query) {
                    $query->where('status', 1);
                },
            ])
                ->where('status', 1)
                ->orderBy('serial', 'asc')
                ->take(8)
                ->get();
        @endphp
        <!-- moile menu -->
        <div class="mobile-menu">
            <!-- Slideable (Mobile) Menu-->

            <div class="p-4 text-end">
                <a id="closeMobileNav" href="#">
                    <i class="fas fa-times fs-20 text-dark"></i>
                </a>
            </div>

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item text-center" role="presentation">
                    <span class="" id="mmenu-tab" data-bs-toggle="tab" data-bs-target="#mmenu-content" role="tab" aria-controls="mmenu-content" aria-selected="false">Menu</span>
                </li>
                <li class="nav-item text-center" role="presentation">
                    <span class="active" id="mcat-tab" data-bs-toggle="tab" data-bs-target="#mcat-content" role="tab" aria-controls="mcat-content" aria-selected="true">Category</span>
                </li>
            </ul>
            <div class="tab-content p-0">
                <div class="tab-pane fade" id="mmenu-content" role="tabpanel" aria-labelledby="mmenu-tab">
                    <nav class="slideable-menu">
                        <ul>
                            @if (!Auth::user())
                                <li class="">
                                    <div class="mt-8 px-4 ">
                                        <a href="{{ route('user.login') }}" class="btn btn-danger w-100 text-white">Login</a>
                                    </div>
                                </li>
                            @else
                                @php
                                    $user = Auth::user();
                                @endphp
                                <li class="user-list-item text-center px-4 py-2 bg-gray-100 user-info-avatar">
                                    <img src="{{ $user->photo ? asset('assets/images/' . $user->photo) : asset('assets/images/placeholder.png') }}" alt="" class="avatar" />
                                    <h6 class="mt-2 fs-14 mb-0 fw-semibold">{{ $user->first_name }}
                                        {{ $user->last_name }}</h6>
                                    <p class="text-muted fs-12 mb-0">{{ __('Joined') }}
                                        {{ $user->created_at->format('M D Y') }}</p>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark" href="{{ route('user.dashboard') }}"><i class="icon-command"></i>{{ __('Dashboard') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark" href="{{ route('user.profile') }}"><i class="icon-user"></i>{{ __('Profile') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark" href="{{ route('user.ticket') }}"><i class="icon-file-text"></i>{{ __('Support Ticket') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex justify-content-between align-items-center text-dark" href="{{ route('user.order.index') }}"><span
                                            class="fs-16 text-dark">{{ __('Orders') }}</span><span class="badge badge-default badge-pill">{{ $user->orders->count() }}</span></a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark" href="{{ route('user.address') }}"><i class="icon-map-pin"></i>{{ __('Address') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex justify-content-between align-items-center text-dark" href="{{ route('user.wishlist.index') }}"><span
                                            class="fs-16 text-dark">{{ __('Wishlist') }}</span><span class="badge badge-default badge-pill">{{ $user->wishlists->count() }}</span></a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark remove-account with-badge" data-bs-toggle="modal" data-bs-target="#deleteAccount" href="javascript:;"><i
                                            class="icon-trash"></i>{{ __('Delete Account') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark with-badge" href="{{ route('user.logout') }}"><i class="icon-log-out"></i>{{ __('Log out') }}</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="tab-pane fade active show" id="mcat-content" role="tabpanel" aria-labelledby="mcat-tab">
                    <nav class="slideable-menu">
                        <div class="widget-categories mobile-cat">
                            <ul id="category_list">
                                @foreach ($categories as $category)
                                    <li class="has-children">
                                        <a href="{{ route('front.catalog') . '?category=' . $category->slug }}" class="category_search mb-0">
                                            {{ $category->name }}
                                            <span><i id="expandCategory" class="fas fa-chevron-down"></i></span>
                                        </a>
                                        <ul id="subcategory_list">
                                            @foreach ($category->subcategory as $subcategory)
                                                <li>
                                                    <a class="subcategory" href="{{ route('front.catalog') . '?subcategory=' . $subcategory->slug }}">
                                                        {{ $subcategory->name }}
                                                    </a>
                                                    <ul id="childcategory_list">
                                                        @foreach ($subcategory->childcategory as $childcategory)
                                                            <li>
                                                                <a class="childcategory" href="{{ route('front.catalog') . '?childcategory=' . $childcategory->slug }}">
                                                                    {{ $childcategory->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

        </div>
        <!-- moile menu -->


        <div class="position-relative">
            <ul class="category-navigation shadow-sm ps-0 mb-0 text-danger" id="navItems">
                <li id="closeNav" class="text-end close-btn px-6 py-4">
                    <i class="fas fa-times fs-20 text-dark"></i>
                </li>
                @foreach ($categories as $pcategory)
                    <li class="main-category d-flex align-items-center justify-content-between px-6 py-4">
                        <a href="{{ route('front.catalog') . '?category=' . $pcategory->slug }}" class="main-item text-dark fw-semibold fs-14">
                            {{ $pcategory->name }}
                        </a>
                        @if ($pcategory->subcategory->count() > 0)
                            <i class="fas fa-chevron-right fw-semibold text-danger fs-12"></i>
                        @endif
                        <!-- sub category -->
                        @if ($pcategory->subcategory->count() > 0)
                            <ul class="sub-category shadow-sm position-absolute mb-0 ps-0">
                                @foreach ($pcategory->subcategory as $scategory)
                                    <li class="sub-category-items d-flex align-items-center justify-content-between px-6 py-4">
                                        <a href="{{ route('front.catalog') . '?subcategory=' . $scategory->slug }}" class="main-item text-dark fw-semibold fs-14">
                                            {{ $scategory->name }}
                                        </a>
                                        @if ($scategory->childcategory->count() > 0)
                                            <i class="fas fa-chevron-right fw-semibold text-danger fs-12"></i>
                                        @endif
                                        <!-- sub sub category -->
                                        @if ($scategory->childcategory->count() > 0)
                                            <ul class="sub-sub-category shadow-sm position-absolute mb-0 ps-0">
                                                @foreach ($scategory->childcategory as $childcategory)
                                                    <li class="sub-sub-category-items d-flex align-items-center justify-content-between px-6 py-4">
                                                        <a href="{{ route('front.catalog') . '?childcategory=' . $childcategory->slug }}" class="main-item text-dark fw-semibold fs-14">
                                                            {{ $childcategory->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <!-- sub sub category -->
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <!-- sub category -->
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- categories -->

        <!-- top nav -->
        <div class="container-fluid position-relative top-nav d-none d-md-block px-4 px-md-10 px-lg-80 pb-6 pt-12 pt-md-100 pt-lg-14 pt-xxl-60 pt-3xl-60">
            <div class="d-flex align-items-end justify-content-between">
                <div id="navbarIcon" class="d-flex justify-content-center category-menu">
                    <i class="fas fa-bars fs-24 text-muted"></i>
                </div>
                <div class="d-flex justify-content-center logo-wrap-main">
                    <a class="text-center" href="{{ route('front.index') }}">
                        <img src="{{ asset('assets/frontend/images/logo-main.png') }}" alt="Logo" class="img-fluid logo" /></a>
                </div>
                <div class="d-flex align-items-center">
                    <div class="d-none d-lg-block">
                        <form action="{{ route('front.catalog') }}" class="d-inline-flex mb-0">
                            <div class="input-group border rounded-pill">
                                <input class="typeahead form-control border-0 bg-transparent" type="search" name="search" id="example-search-input" autocomplete="off"
                                    placeholder="Start Searching . . . .">
                                <span class="input-group-append border-0  bg-transparent">
                                    <button class="btn btn-outline-secondary rounded-bottom bg-transparent border-0 mt-1 py-2 shadow-none" type="submit">
                                        <i class="fas fa-search fs-24 text-gray-600"></i>
                                    </button>
                                </span>
                                <div class="autocomplete-body" id="trending-autocomplete">
                                    @php

                                        $pupular_cateogries = json_decode($trending_categories->home_4_popular_category, true);
                                    @endphp
                                    <div class="st-autocomplete-content">
                                        <ul class="st-trending-elements py-2">
                                            @foreach (App\Models\Category::whereIn('id', $pupular_cateogries)->get() as $pupular)
                                                <li class="badge rounded-pill bg-light"><a class="text-danger text-lowercase"
                                                        href="{{ route('front.catalog') . '?pupular=' . $pupular->slug }}">{{ $pupular->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-block d-lg-none">
                        <div class="bg-transparent search-btn border-0 show-mob-search" id="showMobSearch">
                            <i class="fas fa-search fs-26 text-gray-600"></i>
                        </div>
                    </div>
                    @if (Auth::check())
                        <div class="position-relative cart-icons d-none d-lg-block">
                            <a href="{{ route('user.wishlist.index') }}">
                                <i class="fa-regular fa-heart ms-3 ms-lg-6 fs-28 text-gray-600"></i>
                                <span class="count-label wishlist_count"> {{ Auth::user()->wishlists->count() }}
                                </span>
                            </a>
                        </div>
                    @else
                        <div class="position-relative cart-icons d-none d-lg-block">
                            <a href="{{ route('user.wishlist.index') }}">
                                <i class="fa-regular fa-heart ms-3 ms-lg-6 fs-28 text-gray-600"></i>
                                <span class="count-label wishlist_count"> 0 </span>
                            </a>
                        </div>
                    @endif
                    <div class="position-relative cart-icons">
                        <a data-bs-toggle="offcanvas" href="#cartOffcanvas" role="button" aria-controls="cartOffcanvas">
                            <svg class="ms-4 ms-lg-6" width="23" height="28" viewBox="0 0 23 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.8 28C2.03 28 1.3706 27.7256 0.821802 27.1768C0.273002 26.628 -0.000930956 25.9691 2.37691e-06 25.2V8.4C2.37691e-06 7.63 0.274402 6.9706 0.823202 6.4218C1.372 5.873 2.03094 5.59907 2.8 5.6H5.6C5.6 4.06 6.14833 2.74167 7.245 1.645C8.34167 0.548333 9.66 0 11.2 0C12.74 0 14.0583 0.548333 15.155 1.645C16.2517 2.74167 16.8 4.06 16.8 5.6H19.6C20.37 5.6 21.0294 5.8744 21.5782 6.4232C22.127 6.972 22.4009 7.63093 22.4 8.4V25.2C22.4 25.97 22.1256 26.6294 21.5768 27.1782C21.028 27.727 20.3691 28.0009 19.6 28H2.8ZM2.8 25.2H19.6V8.4H16.8V11.2C16.8 11.5967 16.6656 11.9294 16.3968 12.1982C16.128 12.467 15.7957 12.6009 15.4 12.6C15.0033 12.6 14.6706 12.4656 14.4018 12.1968C14.133 11.928 13.9991 11.5957 14 11.2V8.4H8.4V11.2C8.4 11.5967 8.2656 11.9294 7.9968 12.1982C7.728 12.467 7.39573 12.6009 7 12.6C6.60333 12.6 6.2706 12.4656 6.0018 12.1968C5.733 11.928 5.59907 11.5957 5.6 11.2V8.4H2.8V25.2ZM8.4 5.6H14C14 4.83 13.7256 4.1706 13.1768 3.6218C12.628 3.073 11.9691 2.79907 11.2 2.8C10.43 2.8 9.7706 3.0744 9.2218 3.6232C8.673 4.172 8.39907 4.83093 8.4 5.6Z"
                                    fill="#707070" />
                            </svg>
                            <span class="count-label cart_count">{{ Session::has('cart') ? count(Session::get('cart')) : '0' }}</span>
                        </a>

                    </div>
                    <div class="d-none user-options d-lg-block py-2">
                        <a href="">
                            <i class="fa-regular fa-user ms-3 ms-lg-6 fs-28 text-gray-600"></i>
                        </a>
                        <ul class="user-list bg-white rounded-3 ps-0 mb-0 shadow-lg">
                            @if (!Auth::user())
                                <li class="user-list-item px-4 py-2 user-info-avatar">
                                    <p class="text-muted fs-14 mb-2">
                                        Sign in to you account or register new to get full control
                                        over your orders
                                    </p>
                                    <a href="{{ route('user.login') }}" class="btn btn-danger text-white btn-block text-capitalize w-100 py-3 shadow-0 outline-0 text-uppercase">
                                        Sign in
                                    </a>
                                </li>
                            @else
                                @php
                                    $user = Auth::user();
                                @endphp
                                <li class="user-list-item text-center px-4 py-2 bg-gray-100 user-info-avatar">
                                    <img src="{{ $user->photo ? asset('assets/images/' . $user->photo) : asset('assets/images/placeholder.png') }}" alt="" class="avatar" />
                                    <h6 class="mt-2 fs-14 mb-0 fw-semibold">{{ $user->first_name }}
                                        {{ $user->last_name }}</h6>
                                    <p class="text-muted fs-12 mb-0">{{ __('Joined') }}
                                        {{ $user->created_at->format('M D Y') }}</p>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark" href="{{ route('user.dashboard') }}"><i class="icon-command"></i>{{ __('Dashboard') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark" href="{{ route('user.profile') }}"><i class="icon-user"></i>{{ __('Profile') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark" href="{{ route('user.ticket') }}"><i class="icon-file-text"></i>{{ __('Support Ticket') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex justify-content-between align-items-center text-dark" href="{{ route('user.order.index') }}"><span
                                            class="fs-16 text-dark">{{ __('Orders') }}</span><span class="badge badge-default badge-pill">{{ $user->orders->count() }}</span></a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark" href="{{ route('user.address') }}"><i class="icon-map-pin"></i>{{ __('Address') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex justify-content-between align-items-center text-dark" href="{{ route('user.wishlist.index') }}"><span
                                            class="fs-16 text-dark">{{ __('Wishlist') }}</span><span class="badge badge-default badge-pill">{{ $user->wishlists->count() }}</span></a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark remove-account with-badge" data-bs-toggle="modal" data-bs-target="#deleteAccount" href="javascript:;"><i
                                            class="icon-trash"></i>{{ __('Delete Account') }}</a>
                                </li>
                                <li class="user-list-item px-4 py-2">
                                    <a class="fs-14 d-flex text-dark with-badge" href="{{ route('user.logout') }}"><i class="icon-log-out"></i>{{ __('Log out') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>



                </div>
            </div>
        </div>
        <!--mobile top nav -->
        <div class="container-fluid d-flex d-md-none container-5xl position-relative top-nav px-4 py-4">
            <div class="d-flex align-items-center justify-content-between">
                <div id="navbarIcon" class="d-flex justify-content-center category-menu">
                    <i class="fas fa-bars fs-24 text-muted"></i>
                </div>
                <div class="ms-4">
                    <div class="bg-transparent mt-1 search-btn border-0 show-mob-search" id="showMobSearch">
                        <i class="fas fa-search fs-22 text-gray-600"></i>
                    </div>
                </div>
                <div class="logo-wrap-mobile d-flex align-items-center justify-content-center flex-grow-1">
                    <img src="{{ asset('assets/frontend/images/logo-main.png') }}" alt="Logo" class="logo-mobile" />
                </div>
                <div class="position-relative cart-icons">
                    @if (Auth::check())
                    <a href="{{ route('user.wishlist.index') }}">
                        <i class="fa-regular fa-heart ms-3 ms-lg-6 fs-28 text-gray-600"></i>
                        <span class="count-label wishlist_count"> {{ Auth::user()->wishlists->count() }}
                        </span>
                    </a>
                    @else
                    <a href="{{ route('user.wishlist.index') }}">
                        <i class="fa-regular fa-heart ms-3 ms-lg-6 fs-28 text-gray-600"></i>
                        <span class="count-label wishlist_count"> 0
                        </span>
                    </a>
                    @endif
                </div>
                <div class="position-relative cart-icons">
                    <a data-bs-toggle="offcanvas" href="#cartOffcanvas" role="button" aria-controls="cartOffcanvas">
                        <svg class="ms-4 ms-lg-6" width="23" height="28" viewBox="0 0 23 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.8 28C2.03 28 1.3706 27.7256 0.821802 27.1768C0.273002 26.628 -0.000930956 25.9691 2.37691e-06 25.2V8.4C2.37691e-06 7.63 0.274402 6.9706 0.823202 6.4218C1.372 5.873 2.03094 5.59907 2.8 5.6H5.6C5.6 4.06 6.14833 2.74167 7.245 1.645C8.34167 0.548333 9.66 0 11.2 0C12.74 0 14.0583 0.548333 15.155 1.645C16.2517 2.74167 16.8 4.06 16.8 5.6H19.6C20.37 5.6 21.0294 5.8744 21.5782 6.4232C22.127 6.972 22.4009 7.63093 22.4 8.4V25.2C22.4 25.97 22.1256 26.6294 21.5768 27.1782C21.028 27.727 20.3691 28.0009 19.6 28H2.8ZM2.8 25.2H19.6V8.4H16.8V11.2C16.8 11.5967 16.6656 11.9294 16.3968 12.1982C16.128 12.467 15.7957 12.6009 15.4 12.6C15.0033 12.6 14.6706 12.4656 14.4018 12.1968C14.133 11.928 13.9991 11.5957 14 11.2V8.4H8.4V11.2C8.4 11.5967 8.2656 11.9294 7.9968 12.1982C7.728 12.467 7.39573 12.6009 7 12.6C6.60333 12.6 6.2706 12.4656 6.0018 12.1968C5.733 11.928 5.59907 11.5957 5.6 11.2V8.4H2.8V25.2ZM8.4 5.6H14C14 4.83 13.7256 4.1706 13.1768 3.6218C12.628 3.073 11.9691 2.79907 11.2 2.8C10.43 2.8 9.7706 3.0744 9.2218 3.6232C8.673 4.172 8.39907 4.83093 8.4 5.6Z"
                                fill="#707070" />
                        </svg>
                        <span class="count-label cart_count">{{ Session::has('cart') ? count(Session::get('cart')) : '0' }}</span>
                    </a>
                </div>
            </div>
        </div>
        <!--mobile top nav -->
        <!-- top nav -->
        <!-- center navigation -->
        <div class="cetner-category-nav d-none d-lg-block mx-auto py-4 py-lg-4 w-lg-100 border-bottom ">
            <ul class="d-flex cat-list center-nav ps-0 mb-0 align-items-center justify-content-center">
                @php $mainCategoryCount = 0; @endphp

                @foreach ($categories as $mainCategory)
                    @if ($mainCategoryCount < 9)
                        <li class="ms-6 cat-list-item position-relative">
                            <a href="{{ route('front.catalog') . '?category=' . $mainCategory->slug }}" class="text-dark main-link fs-14 fw-bold">
                                {{ $mainCategory->name }}
                            </a>
                            @if ($mainCategory->subcategory->count() > 0)
                                <ul class="sub-cat-list bg-white ps-0 mb-0 shadow-sm ">
                                    @foreach ($mainCategory->subcategory as $mainsubCategory)
                                        <li class="sub-cat-list-item px-4 py-2 d-inline-flex position-relative">
                                            <a href="{{ route('front.catalog') . '?subcategory=' . $mainsubCategory->slug }}" class="fs-12 fw-semibold text-dark">
                                                <i class="fas text-dark fa-chevron-right me-1"></i>
                                                {{ $mainsubCategory->name }}
                                            </a>
                                            @if ($mainsubCategory->childcategory->count() > 0)
                                                <ul class="sub-sub-cat-list bg-white ps-0 mb-0 shadow-sm ">
                                                    @foreach ($mainsubCategory->childcategory as $mainchildCategory)
                                                        <li class="sub-sub-cat-list-item px-4 py-2">
                                                            <a href="{{ route('front.catalog') . '?childcategory=' . $mainchildCategory->slug }}" class="fs-12 fw-semibold text-dark">
                                                                <i class="fas text-dark fa-chevron-right me-1"></i>
                                                                {{ $mainchildCategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @php $mainCategoryCount++; @endphp
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- center navigation -->
        <!-- main-content -->
        <main class="main-content">

            @yield('content')

            <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" data-bs-scroll="true" data-bs-backdrop="false" aria-labelledby="cartOffcanvas">
                <div class="offcanvas-header">
                    <button type="button" class="btn--close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <h5 class="heading-h4 fw-bold mb-12 mb-lg-60">Shopping Cart</h5>
                    <div class="cart_view_header" id="header_cart_load" data-target="{{ route('front.header.cart') }}">
                        @include('includes.header_cart')
                    </div>

                </div>
            </div>
            <!-- off canvas cart  -->
            <!--    announcement banner section start   -->
            <a class="announcement-banner" href="#announcement-modal"></a>
            <div id="announcement-modal" class="mfp-hide white-popup" id="alertsize">

                @if ($setting->announcement_type == 'newletter')
                    <div class="announcement-with-content">
                        <div class="row align-items-lg-center">
                            <div class="col-lg-6 p-0 d-none d-lg-block">
                                <img src="{{ asset('assets/frontend/images/modal-img.png') }}" alt="img" class="modal-img" />
                            </div>
                            <div class="col-lg-6 px-4 px-md-8 px-lg-12 d-flex flex-column align-items-center">
                                <h3 class="mb-3 fw-bold text-center mt-6 mt-lg-0">{{ $setting->announcement_title }}-</h3>
                                <p class="mb-3  text-center">
                                    {{ $setting->announcement_details }}
                                </p>
                                <form class="subscriber-form mt-4" action="{{ route('front.subscriber.submit') }}">
                                    <div class="row justify-content-md-center">
                                        <div class="col-12">
                                            <input class="form-control border rounded-0 border-1 py-4 modal-input" type="email" id="name" name="email" placeholder="Enter Email" />
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-dark text-white btn-block w-100 py-4 shadow-0 outline-0 rounded-0 text-uppercase">
                                                 Now
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal-scl-icons mt-2">
                                    <a href="https://www.facebook.com/intoobox/" class="fab fa-facebook text-dark bg-white"></a>
                                    <!-- Facebook -->
                                    <a href="https://www.instagram.com/intoobox/" class="fab fa-instagram ms-3 text-dark bg-white"></a>
                                    <!-- Instagram -->
                                    <a href="https://www.youtube.com/channel/UC4a0s-1yxtzi6otS-P_p3OA" class="fab fa-youtube ms-3 text-dark bg-white"></a>
                                    <!-- YouTube -->
                                    <a href="https://www.pinterest.com/" class="fab fa-pinterest ms-3 text-dark bg-white"></a>
                                    <!-- Pinterest -->
                                </div>

                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No thanks
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ $setting->announcement_link }}">
                        <img src="{{ asset('assets/images/' . $setting->announcement) }}" alt="">
                    </a>
                @endif
            </div>
            <!-- subscription modal -->
            <!--    announcement banner section end   -->
            <!-- Quick View modal -->
            <div class="modal fade rounded-0" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl position-relative rounded-0" role="document">
                    <div class="modal-content rounde-0 bg-white">
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body p-6" id="quickViewContent">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="deleteAccount" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Remove Account') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ __('Are You Sure?') }}</p>
                            <p>{{ __('Do you realy want to delete this account?') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <a href="{{ route('user.account.remove') }}" type="button" class="btn btn-danger text-white">{{ __('Remove Account') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer start -->
            <footer class="footer-bg pt-60 pt-md-80 pt-xl-100">
                <div class="container">
                    <div class="w-100 w-3xl-90 mx-auto">
                        <div class="row gx-5 align-items-start justify-content-start">
                            <div class="col-md-6 col-lg-3">
                                <div class="d-flex">
                                    <h6 class="fs-20 font-smeibold text-white mb-0">
                                        Follow Us :
                                    </h6>
                                    <div class="footer-icon-social">
                                        <a href="https://www.facebook.com/intoobox/" class="fab fa-facebook text-dark ms-2 bg-white"></a>
                                        <!-- Facebook -->
                                        <a href="https://www.instagram.com/intoobox/" class="fab fa-instagram ms-2 text-dark bg-white"></a>
                                        <!-- Instagram -->
                                        <a href="https://www.youtube.com/channel/UC4a0s-1yxtzi6otS-P_p3OA" class="fab fa-youtube ms-2 text-dark bg-white"></a>
                                        <!-- YouTube -->
                                        <a href="https://www.pinterest.com/" class="fab fa-pinterest ms-2 text-dark bg-white"></a>
                                        <!-- Pinterest -->
                                    </div>
                                </div>
                                <p class="mt-8 text-gray-700 fs-14 fw-semibold mb-4">
                                    {{ $setting->footer_address }}
                                </p>
                                <p class="text-gray-700 fs-14 fw-semibold mb-4">
                                    Phone : {{ $setting->footer_phone }}
                                </p>
                                <p class="text-gray-700 fs-14 fw-semibold mb-4">
                                    Email: {{ $setting->footer_email }}
                                </p>
                                <p class="text-gray-700 fs-14 fw-semibold mb-4">
                                    Web: www.intoobox.com
                                </p>
                            </div>
                            <div class="col-md-6 col-lg-2 ps-lg-6 mt-8 mt-md-0">
                                <h6 class="fs-20 font-smeibold text-white mb-0">Company</h6>
                                <div class="mt-8">
                                    <div class="mb-4">
                                        <a href="{{ route('front.about') }}" class="text-gray-700 fs-14 fw-semibold footer-links text-decoration-none">
                                            About us
                                        </a>
                                    </div>
                                    <div class="mb-4">
                                        <a href="{{ route('front.coupons') }}" class="text-gray-700 fs-14 fw-semibold footer-links text-decoration-none">
                                            Coupons
                                        </a>
                                    </div>
                                    <div class="mb-4">
                                        <a href="{{ route('front.catalogues') }}" class="text-gray-700 fs-14 fw-semibold footer-links text-decoration-none">
                                            Catalogue
                                        </a>
                                    </div>
                                    <li class="mb-4">
                                        <a href="{{ route('front.order.track') }}" class="text-gray-700 fs-14 fw-semibold footer-links text-decoration-none">
                                            Track Orders
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="{{ route('front.contact') }}" class="text-gray-700 fs-14 fw-semibold footer-links text-decoration-none">
                                            Contact Us
                                        </a>
                                    </li>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 ps-lg-8 mt-8 mt-md-0">
                                <h6 class="fs-20 font-smeibold text-white mb-0">
                                    More Information
                                </h6>
                                <div class="mt-8">

                                    @if ($setting->is_faq == 1)
                                        <div class="mb-4">
                                            <a href="{{ route('front.faq') }}" class="text-gray-700 fs-14 fw-semibold footer-links text-decoration-none">
                                                FAQs
                                            </a>
                                        </div>
                                    @endif
                                    @foreach (DB::table('pages')->wherePos(2)->orwhere('pos', 1)->get() as $page)
                                        <div class="mb-4">
                                            <a class="text-gray-700 fs-14 fw-semibold footer-links text-decoration-none" href="{{ route('front.page', $page->slug) }}">{{ $page->title }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 ps-lg-3 mt-8 mt-lg-0">
                                <h6 class="fs-20 font-smeibold text-white mb-0">Newsletter</h6>
                                <p class="mt-8 text-gray-700 fs-14 fw-semibold mb-4">
                                    Stay Updated on all that's new add noteworthy
                                </p>
                                <form class="mt-8 subscriber-form" action="{{ route('front.subscriber.submit') }}" method="post">
                                    @csrf
                                    <div class="input-group rounded-pill submit-form overflow-hidden">
                                        <input type="text" name="email" class="form-control text-white border-0 bg-transparent p-4" placeholder="Email" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" style="width: auto!important;height: auto!important;" />
                                        <button type="submit" class="input-group-text btn btn-danger subscrie-btn rounded-pill" id="basic-addon2">
                                            <i class="fa-regular fa-paper-plane text-white"></i>
                                            </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="header-bg d-flex flex-column flex-lg-row justify-content-between border-top py-6 mt-8">
                            <p class="text-white fs-14 mb-0">
                                Copyright © {{ date('Y') }}
                                <a href="" class="text-uppercase text-white fs-16 fw-semibold">IN TOO BOX</a>
                                . All rights reserved
                            </p>
                            <div class="d-flex mt-5 mt-lg-0">
                                <img src="{{ asset('assets/frontend/images/master.png') }}" alt="" class="img-fluid" />
                                <img src="{{ asset('assets/frontend/images/visa.png') }}" alt="" class="ms-2 img-fluid" />
                                <img src="{{ asset('assets/frontend/images/blue.png') }}" alt="" class="ms-2 img-fluid" />
                                <img src="{{ asset('assets/frontend/images/discover.png') }}" alt="" class="ms-2 img-fluid" />
                                <img src="{{ asset('assets/frontend/images/bank.png') }}" alt="" class="ms-2 img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scrollToTopBtn showBtn">
                    <svg width="9" height="17" viewBox="0 0 9 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.85355 0.646447C4.65829 0.451184 4.34171 0.451184 4.14645 0.646447L0.964466 3.82843C0.769203 4.02369 0.769203 4.34027 0.964466 4.53553C1.15973 4.7308 1.47631 4.7308 1.67157 4.53553L4.5 1.70711L7.32843 4.53553C7.52369 4.7308 7.84027 4.7308 8.03553 4.53553C8.2308 4.34027 8.2308 4.02369 8.03553 3.82843L4.85355 0.646447ZM5 17L5 1L4 1L4 17L5 17Z"
                            fill="white" />
                    </svg>
                </button>
            </footer>
            <!-- footer ends here -->
            <!-- bottom bar for mobiles -->
            <div class="btm-menu-bar px-4 py-4 d-flex d-md-none align-items-center justify-content-between">
                <li class="btn-menu-item">
                    <a href="{{ route('front.index') }}" class="d-flex flex-column align-items-center justify-content-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 9.4854C2 9.05443 2.21936 8.65012 2.58867 8.40037L11.6887 2.24637C12.1744 1.91788 12.8256 1.91788 13.3113 2.24637L22.4114 8.40037C22.7807 8.65012 23 9.05443 23 9.4854V21.0029C23 22.1058 22.0598 23 20.9 23H4.1C2.9402 23 2 22.1059 2 21.0029V9.4854Z"
                                stroke="#707070" stroke-width="2.3" />
                            <path
                                d="M15.125 13.8125C15.125 15.2622 13.9497 16.4375 12.5 16.4375C11.0503 16.4375 9.875 15.2622 9.875 13.8125C9.875 12.3628 11.0503 11.1875 12.5 11.1875C13.9497 11.1875 15.125 12.3628 15.125 13.8125Z"
                                stroke="#707070" stroke-width="2.6" />
                        </svg>
                        <span class="mt-1 d-block"> Home </span>
                    </a>
                </li>
                <li class="btn-menu-item">
                    <a href="{{ route('front.catalog') }}" class="d-flex flex-column align-items-center justify-content-center">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_12_6)">
                                <path
                                    d="M1.04546 2.35227C1.04546 1.63053 1.63053 1.04546 2.35227 1.04546H4.96591C5.68765 1.04546 6.27273 1.63053 6.27273 2.35227V4.96591C6.27273 5.68765 5.68765 6.27273 4.96591 6.27273H2.35227C1.63053 6.27273 1.04546 5.68765 1.04546 4.96591V2.35227Z"
                                    stroke="#707070" stroke-width="2" />
                                <path
                                    d="M8.88637 2.35227C8.88637 1.63053 9.47145 1.04546 10.1932 1.04546H12.8068C13.5286 1.04546 14.1136 1.63053 14.1136 2.35227V4.96591C14.1136 5.68765 13.5286 6.27273 12.8068 6.27273H10.1932C9.47145 6.27273 8.88637 5.68765 8.88637 4.96591V2.35227Z"
                                    stroke="#707070" stroke-width="2" />
                                <path
                                    d="M16.7273 2.35227C16.7273 1.63053 17.3123 1.04546 18.0341 1.04546H20.6477C21.3695 1.04546 21.9545 1.63053 21.9545 2.35227V4.96591C21.9545 5.68765 21.3695 6.27273 20.6477 6.27273H18.0341C17.3123 6.27273 16.7273 5.68765 16.7273 4.96591V2.35227Z"
                                    stroke="#707070" stroke-width="2" />
                                <path
                                    d="M1.04546 10.1932C1.04546 9.47145 1.63053 8.88637 2.35227 8.88637H4.96591C5.68765 8.88637 6.27273 9.47145 6.27273 10.1932V12.8068C6.27273 13.5286 5.68765 14.1136 4.96591 14.1136H2.35227C1.63053 14.1136 1.04546 13.5286 1.04546 12.8068V10.1932Z"
                                    stroke="#707070" stroke-width="2" />
                                <path
                                    d="M8.88637 10.1932C8.88637 9.47145 9.47145 8.88637 10.1932 8.88637H12.8068C13.5286 8.88637 14.1136 9.47145 14.1136 10.1932V12.8068C14.1136 13.5286 13.5286 14.1136 12.8068 14.1136H10.1932C9.47145 14.1136 8.88637 13.5286 8.88637 12.8068V10.1932Z"
                                    stroke="#707070" stroke-width="2" />
                                <path
                                    d="M16.7273 10.1932C16.7273 9.47145 17.3123 8.88637 18.0341 8.88637H20.6477C21.3695 8.88637 21.9545 9.47145 21.9545 10.1932V12.8068C21.9545 13.5286 21.3695 14.1136 20.6477 14.1136H18.0341C17.3123 14.1136 16.7273 13.5286 16.7273 12.8068V10.1932Z"
                                    stroke="#707070" stroke-width="2" />
                                <path
                                    d="M1.04546 18.0341C1.04546 17.3123 1.63053 16.7273 2.35227 16.7273H4.96591C5.68765 16.7273 6.27273 17.3123 6.27273 18.0341V20.6477C6.27273 21.3695 5.68765 21.9545 4.96591 21.9545H2.35227C1.63053 21.9545 1.04546 21.3695 1.04546 20.6477V18.0341Z"
                                    stroke="#707070" stroke-width="2" />
                                <path
                                    d="M8.88637 18.0341C8.88637 17.3123 9.47145 16.7273 10.1932 16.7273H12.8068C13.5286 16.7273 14.1136 17.3123 14.1136 18.0341V20.6477C14.1136 21.3695 13.5286 21.9545 12.8068 21.9545H10.1932C9.47145 21.9545 8.88637 21.3695 8.88637 20.6477V18.0341Z"
                                    stroke="#707070" stroke-width="2" />
                                <path
                                    d="M16.7273 18.0341C16.7273 17.3123 17.3123 16.7273 18.0341 16.7273H20.6477C21.3695 16.7273 21.9545 17.3123 21.9545 18.0341V20.6477C21.9545 21.3695 21.3695 21.9545 20.6477 21.9545H18.0341C17.3123 21.9545 16.7273 21.3695 16.7273 20.6477V18.0341Z"
                                    stroke="#707070" stroke-width="2" />
                            </g>
                            <defs>
                                <clipPath id="clip0_12_6">
                                    <rect width="23" height="23" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="mt-1 d-block"> Catalogs </span>
                    </a>
                </li>
                @if (Auth::check())
                    <li class="btn-menu-item">
                        <a href="{{ route('user.wishlist.index') }}" class="d-flex flex-column align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="22" viewBox="0 0 25 22" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M24 6.63895C24 14.6179 12.5005 21.3334 12.5005 21.3334C12.5005 21.3334 1 14.5186 1 6.65512C1 3.44451 3.55556 0.88895 6.75 0.88895C9.94444 0.88895 12.5 4.72228 12.5 4.72228C12.5 4.72228 15.0556 0.88895 18.25 0.88895C21.4444 0.88895 24 3.44451 24 6.63895Z"
                                    stroke="#707070" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="mt-1 d-block"> Wishlist (<span class="wishlist_count">{{ Auth::user()->wishlists->count() }}</span>) </span>
                        </a>
                    </li>
                @else
                    <li class="btn-menu-item">
                        <a href="{{ route('user.wishlist.index') }}" class="d-flex flex-column align-items-center justify-content-center">
                            <svg width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M26 7.90625C26 16.102 14.0005 23 14.0005 23C14.0005 23 2 16 2 7.92286C2 4.625 4.66667 2 8 2C11.3333 2 14 5.9375 14 5.9375C14 5.9375 16.6667 2 20 2C23.3333 2 26 4.625 26 7.90625Z"
                                    stroke="#707070" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="mt-1 d-block"> Wishlist (0) </span>
                        </a>
                    </li>
                @endif
                <li class="btn-menu-item">
                    <a href="{{ route('user.profile') }}" class="d-flex flex-column align-items-center justify-content-center">
                        <i class="fa-regular fa-user fs-28 text-gray-600"></i>
                        <span class="mt-1 d-block"> Profile </span>
                    </a>
                </li>
            </div>
            <!-- bottom bar for mobiles -->

            <style>
                .btm-menu-bar {
                    position: fixed;
                    width: 100%;
                    bottom: 0px;
                    left: 0px;
                    right: 0px;
                    background-color: #ffffff;
                    box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.1);
                    z-index: 2000;
                }

                .btm-menu-bar .btn-menu-item a span {
                    color: #252525;
                    font-size: 11px;
                    font-family: "jost", sans-serif;
                    font-weight: 500;
                }

                .btm-menu-bar .btn-menu-item a:hover span {
                    color: #000;
                }
            </style>
        </main>
    @else
        @include('master.other-themes')
    @endif


    <!-- Cookie alert dialog  -->
    @if ($setting->is_cookie == 1)
        @include('cookie-consent::index')
    @endif
    <!-- Cookie alert dialog  -->

    <div id="wp" class="wa-icon-fix">
        <i class="fa-brands "></i>
    </div>
    <div class="chat-box">
        <div class="chat-top">
            <p class="mb-0 text-white">Intoobox Support</p>
            <div id="close" class="close text-white cursor-pointer">
                <i class="fa-solid fa-xmark text-white"></i>
            </div>
        </div>
        <div class="wp-btn-box">
            <p class="text-muted mb-6">How can we help you today?</p>
            <div class="">
                <a target="_blank" href="https://wa.me/918886547678?text=" class="wp-btn w-100">
                    <span>
                        <i class="fa-brands "></i>
                    </span>
                    <span class="ms-3">Let's talk on whatsapp </span>
                    <span class="ms-4">
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
    @php
        $mainbs = [];
        $mainbs['is_announcement'] = $setting->is_announcement;
        $mainbs['announcement_delay'] = $setting->announcement_delay;
        $mainbs['overlay'] = $setting->overlay;
        $mainbs = json_encode($mainbs);
    @endphp

    <script>
        var mainbs = {!! $mainbs !!};
        var decimal_separator = '{!! $setting->decimal_separator !!}';
        var thousand_separator = '{!! $setting->thousand_separator !!}';
    </script>

    <script>
        let language = {
            Days: '{{ __('Days') }}',
            Hrs: '{{ __('Hrs') }}',
            Min: '{{ __('Min') }}',
            Sec: '{{ __('Sec') }}',
        }
    </script>



    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script type="text/javascript" src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.zoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/front/js/lazy.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/lazy.plugin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/myscript.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>

    <script src="{{ asset('assets/frontend/js/plugins/aos.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/swiper-bundle.min.js') }}"></script>
    @yield('script')
    <script type="text/javascript" src="{{ asset('assets/front/js/scripts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/js/app.js') }}"></script>

    @if ($setting->is_facebook_messenger == '12')
        <!-- Messenger Chat Plugin Code -->
        <div id="fb-root"></div>

        <!-- Your Chat Plugin code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "{{ $setting->facebook_messenger }}");
            chatbox.setAttribute("attribution", "biz_inbox");
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml: true,
                    version: 'v11.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    @endif



    <script type="text/javascript">
        let mainurl = '{{ route('front.index') }}';

        let view_extra_index = 0;
        // Notifications
        function SuccessNotification(title) {
            $.notify({
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-check-circle'
            }, {
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: true,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 2000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }

        function DangerNotification(title) {
            $.notify({
                // options
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-exclamation-triangle'
            }, {
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }
        // Notifications Ends

        $(document).ready(function() {
            $('.quick-view-btn').on('click', function() {
                var productId = $(this).data('product-id');
                var url = '{{ route('front.product.quick', ':id') }}';
                url = url.replace(':id', productId)
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        $('#quickViewContent').html(response);
                        $('#quickViewModal').modal('show');
                        // Initialize Owl Carousel after the modal is fully shown
                        $('#quickViewModal').on('shown.bs.modal', function() {
                            $('.product-details-slider').owlCarousel({
                                loop: true,
                                items: 1,
                                autoplayTimeout: 5000,
                                smartSpeed: 1200,
                                autoplay: false,
                                thumbs: true,
                                dots: false,
                                thumbImage: true,
                                animateOut: 'fadeOut',
                                animateIn: 'fadeIn',
                                thumbContainerClass: 'owl-thumbs',
                                thumbItemClass: 'owl-thumb-item',
                            });
                            $('.product-details-slider .item').zoom();
                            $('#quickViewModal').on('input', '.qtyValue', function(event) {
                                handleInput(event);
                            });
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                DangerNotification('{{ Session::get('error') }}')
            })
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            $(document).ready(function() {
                SuccessNotification('{{ Session::get('success') }}');
            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.typeahead').on('focus', function() {
                $('#trending-autocomplete').show();
            });

            $('.typeahead').on('blur', function() {
                // Delay the hide action slightly to allow the click on the autocomplete item
                setTimeout(function() {
                    $('#trending-autocomplete').hide();
                }, 200);
            });

            // Handle clicks on autocomplete items
            $('#trending-autocomplete').on('click', 'a', function(e) {
                e.preventDefault();
                window.location.href = $(this).attr('href');
            });

            $("#wp").on("click", function() {
                $(".chat-box").toggleClass("show");
            });
            $("#close").on("click", function() {
                $(".chat-box").toggleClass("show");
            });
        });

        document.addEventListener('contextmenu', function(e) {
            // Check if the right-click occurred on an image with a specific class
            if (e.target.classList.contains('no-download')) {
                e.preventDefault();
            }
        });
        var qtyInputs = document.getElementsByClassName('qtyValue');

        for (var i = 0; i < qtyInputs.length; i++) {
            qtyInputs[i].addEventListener('input', function() {
                var inputValue = this.value.trim();

                // Remove non-numeric characters
                var cleanedValue = inputValue.replace(/[^0-9]/g, '');

                // Update the input value with the cleaned value
                this.value = cleanedValue;

                // Replace empty input with default value of 1
                if (cleanedValue === '') {
                    this.value = '1';
                }

                if (/^[1-9]\d*$/.test(cleanedValue)) {
                    // Valid input
                } else {
                    // Invalid input
                    DangerNotification('Please enter a number greater than or equal to 1.');
                }
            });
        }

        function handleInput(event) {
            var inputValue = event.target.value.trim();

            // Remove non-numeric characters
            var cleanedValue = inputValue.replace(/[^0-9]/g, '');

            // Update the input value with the cleaned value
            event.target.value = cleanedValue;

            // Replace empty input with default value of 1
            if (cleanedValue === '') {
                event.target.value = '1';
            }

            if (/^[1-9]\d*$/.test(cleanedValue)) {
                // Valid input
            } else {
                // Invalid input
                alert('Please enter a number greater than or equal to 1.');
            }
        }
        if (window.announcementClosed) {
            document.querySelector(".announcement-bar").remove();
        }
    </script>

</body>

</html>
