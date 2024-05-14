@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection

@section('content')
    @php
        function renderStarRating($rating, $maxRating = 5)
        {
            $fullStar = "<i class = 'far fa-star filled'></i>";
            $halfStar = "<i class = 'far fa-star-half filled'></i>";
            $emptyStar = "<i class = 'far fa-star'></i>";
            $rating = $rating <= $maxRating ? $rating : $maxRating;

            $fullStarCount = (int) $rating;
            $halfStarCount = ceil($rating) - $fullStarCount;
            $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

            $html = str_repeat($fullStar, $fullStarCount);
            $html .= str_repeat($halfStar, $halfStarCount);
            $html .= str_repeat($emptyStar, $emptyStarCount);
            $html = $html;
            return $html;
        }
    @endphp

    <!-- main-content -->
    <main class="main-content">
        <!-- Hero section start here -->
        <!-- Hero section start here -->

        <!-- Slider main container -->
        <div class="swiper">
            <!-- Additional required wrapper -->
            @if ($extra_settings->is_t2_slider == 1)
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($sliders as $slider)
                        <section class="swiper-slide d-flex align-items-center p-2 p-lg-0" id="trigger-left">
                            <a href="{{ $slider->url }}">
                                <img src="{{ asset('assets/images/' . $slider->photo) }}" alt="" class="img-fluid rounded rounded-lg-0" id="heroimg"/>
                            </a>
                        </section>
                    @endforeach
                </div>
            @endif
            <!-- swiper btns -->
            <div class="swiper-button-prev d-none d-lg-flex"></div>
            <div class="swiper-button-next d-none d-lg-flex"></div>
            <!-- swiper btns -->
        </div>
        <!-- Hero section end here -->


        <!-- banner section start here -->
        <section class="categories-section px-0 d-lg-none d-sm-block">
            <div class="row p-2 g-3">
                <div class="col-6"><img src="{{ asset('assets/images/b1.jpg') }}" alt="" class="img-fluid rounded" /></div>
                <div class="col-6"><img src="{{ asset('assets/images/b2.jpg') }}" alt="" class="img-fluid rounded" /></div>
                <div class="col-6"><img src="{{ asset('assets/images/b3.jpg') }}" alt="" class="img-fluid rounded" /></div>
                <div class="col-6 "><img src="{{ asset('assets/images/b4.jpg') }}" alt="" class="img-fluid rounded" /></div>
            </div>
        </section>
        <!-- banner section end here -->

        <!-- categories  section starts here -->
        <section class="categories-section px-0">
            <div class="px-0 container-5xl">
                <div class="row g-0">
                    <div class="col-lg-5 p-0 order-1 order-lg-1">
                        @if (isset($hero_banner))
                            <img data-src="{{ asset('assets/images/' . $hero_banner['img1']) }}" alt="categories left image" class="lazy cat-left-col-img no-download" />
                        @else
                            <img src="{{ asset('assets/frontend/images/flower-card.png') }}" alt="categories left image" class="cat-left-col-img no-download" />
                        @endif
                    </div>
                    <div class="col-lg-7 p-4 p-lg-14 order-3 order-lg-2">
                        <div class="d-flex justify-content-between align-items-center mb-8 mb-lg-10">
                            <h2 class="text-dark heading-h2 mb-0">Shop By Categories</h2>

                            <a href="{{ route('front.catalog') }}" class="text-dark">All Products
                                <i class="fas ms-2 text-sm text-dark fa-arrow-right"></i></a>
                        </div>
                        <!-- Producta row -->
                        <div class="row g-4">
                            @foreach ($feature_category_items as $key => $feature_category_item)
                                @if ($key < 6)
                                    @php
                                        $thumbs = [];
                                    @endphp
                                    @if ($feature_category_item->photo != null)
                                        @php
                                            $thumbs = explode(',', $feature_category_item->photo);
                                        @endphp
                                    @endif
                                    <div class="col-6 col-lg-4 d-flex flex-column align-items-center prod-column position-relative overflow-hidden">
                                        <div class="position-relative overflow-hidden">
                                            <a href="{{ route('front.product', $feature_category_item->slug) }}">

                                                <img @foreach ($thumbs as $key => $thumb)
                                                @if ($key === 0)
                                                data-src="{{ uploaded_asset($thumb) }}"
                                                @else
                                                    data-src-2="{{ uploaded_asset($thumb) }}"
                                                    @endif @endforeach
                                                    alt="Image 1" class="img-fluid cat-prod-img lazy no-download rounded" /></a>
                                            <!-- floating content -->
                                            <div class="position-absolute cart-actions text-white fw-bold fs-14 mb-0">
                                                <div class="action-btn shadow-lg">
                                                    <a class="product-button wishlist_store" href="{{ route('user.wishlist.store', $feature_category_item->id) }}" title="{{ __('Wishlist') }}"><i
                                                            class="fa-regular fa-heart fs-20"></i></a>
                                                </div>
                                                <div class="mt-2 quick-view-btn action-btn shadow-lg" data-product-id="{{ $feature_category_item->id }}">
                                                    <i class="fas fa-search fs-20"></i>
                                                </div>

                                                <a data-target="{{ route('fornt.compare.product', $feature_category_item->id) }}" class="mt-2 action-btn shadow-lg product-button product_compare"
                                                    href="javascript:;" title="{{ __('Compare') }}"><i class="fa-solid fa-arrow-right-arrow-left fs-18"></i></a>
                                            </div>

                                            @if ($feature_category_item->previous_price && $feature_category_item->previous_price != 0)
                                                <p class="position-absolute off-price bg-danger text-white fw-bold fs-12 mb-0">
                                                    -{{ PriceHelper::DiscountPercentage($feature_category_item) }}
                                                </p>
                                            @endif
                                            @if ($feature_category_item->is_stock())
                                                <span
                                                    class="position-absolute item-badge text-white fw-bold fs-12 mb-0
                                              @if ($feature_category_item->is_type == 'feature') bg-warning
                                              @elseif($feature_category_item->is_type == 'new')
                                              bg-success
                                              @elseif($feature_category_item->is_type == 'top')
                                              bg-info
                                              @elseif($feature_category_item->is_type == 'best')
                                              bg-dark
                                              @elseif($feature_category_item->is_type == 'flash_deal')
                                                bg-success @endif
                                              ">{{ $feature_category_item->is_type != 'undefined' ? ($feature_category_item->is_type != 'flash_deal' ? ucfirst(str_replace('_', ' ', $feature_category_item->is_type)) : 'Deal') : '' }}</span>
                                            @else
                                                <span class="position-absolute item-badge text-white fw-bold fs-12 mb-0 bg-danger">{{ __('Sold') }}</span>
                                            @endif

                                            <!-- timer -->
                                            @if ($feature_category_item->is_type == 'flash_deal' && $feature_category_item->date != null && \Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($feature_category_item->date)))
                                                <div class="timer position-absolute mx-auto align-items-center justify-content-between bg-white p-2" data-date-time="{{ $feature_category_item->date }}">
                                                    <div class="time">
                                                        <p class="days mb-0 fs-16 fw-bold text-danger" id="days">00</p>
                                                        <p class="mb-0 fs-12 font-smeibold text-muted">Days</p>
                                                    </div>
                                                    <div>:</div>
                                                    <div class="time">
                                                        <p class="hours mb-0 fs-16 fw-bold text-danger" id="hours">00</p>
                                                        <p class="mb-0 fs-12 font-smeibold text-muted">Hours</p>
                                                    </div>
                                                    <div>:</div>
                                                    <div class="time">
                                                        <p class="minutes mb-0 fs-16 fw-bold text-danger" id="minutes">00</p>
                                                        <p class="mb-0 fs-12 font-smeibold text-muted">Mins</p>
                                                    </div>
                                                    <div>:</div>
                                                    <div class="time">
                                                        <p class="seconds mb-0 fs-16 fw-bold text-danger" id="seconds">00</p>
                                                        <p class="mb-0 fs-12 font-smeibold text-muted">Sec</p>
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- timer -->

                                            <div class="quick-add-btn position-absolute">
                                                @if ($feature_category_item->item_type != 'affiliate')
                                                    @if ($feature_category_item->is_stock())
                                                        <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none"
                                                            data-target="{{ $feature_category_item->id }}">Quick
                                                            Add</button>
                                                    @else
                                                        <a class="btn btn-danger py-3 btn-block w-100 text-white shadow-none" href="{{ route('front.product', $feature_category_item->slug) }}"
                                                            title="{{ __('Details') }}"><i class="icon-arrow-right"></i></a>
                                                    @endif
                                                @else
                                                    <a class="btn btn-danger py-3 btn-block w-100 text-white" href="{{ $feature_category_item->affiliate_link }}" target="_blank"
                                                        title="{{ __('Buy Now') }}"><i class="icon-arrow-right"></i></a>
                                                @endif
                                            </div>
                                            <!-- floating content -->
                                        </div>
                                        <p class="text-muted fw-semibold mt-4 mb-3">
                                            <a class="text-muted" href="{{ route('front.product', $feature_category_item->slug) }}">{{ Str::limit($feature_category_item->name, 35) }}</a>
                                        </p>
                                        <div class="d-flex">
                                            <p class="text-danger fw-bold fs-18 mb-0 ms-4">{{ PriceHelper::grandCurrencyPrice($feature_category_item) }}</p>
                                            @if ($feature_category_item->previous_price != 0)
                                                <p class="text-gray-300 fs-18 fw-bold text-decoration-line-through mb-0  ms-4">
                                                    {{ PriceHelper::setPreviousPrice($feature_category_item->previous_price) }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-5 d-flex align-items-center justify-content-center bg-red-400 p-6 order-2 order-lg-3">
                        <h2 class="heading-h2 fw-normal text-white text-center">
                            New design in {{ date('Y') }}
                        </h2>
                    </div>
                    <div class="col-lg-7 bg-gray-100 py-8 py-lg-12 px-12 px-lg-80 order-4 order-lg-4">
                        <h3 class="heading-h3 text-dark mb-6 mg-lg-8r">
                            Discover our collection of bakery boxes! We have a wide
                            selection of boxes to suit all pastry creations:
                        </h3>
                        <p class="text-dark fs-16 mb-10">
                            Welcome to IN TOO BOX! You're in the perfect place to find the
                            most beautiful boxes available on the internet. Here you can
                            findgift boxes of all shapes and colours to make your gifts
                            shine. Enter our catalogue of creativity and find gift boxes
                            that will brighten up anyone's day. It almost doesn't matter
                            what goes inside, with ourgift boxes you are sure to impress!
                            Discover them!
                        </p>
                        <div class="view-more">
                            <a href="#" class="btn btn-outline-danger text-uppercase text-sm fw-bold w-auto border border-2 border-danger shadow-none px-4 py-2 rounded-pill text-dark">
                                View More
                                <i class="fas ms-2 text-sm text-dark fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- categories section ends here -->

        <!-- best selling section starts here -->
        <section class="best-selling-section py-12 py-lg-60">
            <div class="container-fluid container-5xl px-4 px-md-6 px-lg-8 px-5xl-0">
                <h2 class="text-dark text-capitalize fw-semibold text-center heading-h2 mb-0">
                    Best Selling Food Boxes
                </h2>
                <p class="text-muted w-100 w-md-80 w-lg-70 mx-auto lh-base text-center mt-2 mb-0">
                    Discover our wide range of food boxes and cardboard packaging for
                    take away food available in different formats. <br>The take away food
                    packaging is perfect for restaurants, bars, delivery businesses,
                    caterings or for private use.
                </p>
                <div class="mt-6 mt-8">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="row g-4">
                                <div class="col-lg-8">
                                    <div class="h-100 p-8 d-flex flex-column flex-lg-row align-items-start bg-red-light food-box-item foodox-item-1">
                                        <div class="img-wrapp">
                                            <img src="{{ asset('assets/frontend/images/best-prod-1.png') }}" alt="first food box" class="best-prod-img no-download" />
                                        </div>
                                        <div class="ps-0 mt-4 mt-lg-0 ps-lg-12">
                                            <p class="text-danger fs-14 mb-0 fw-semibold">
                                                #New Arrivals
                                            </p>
                                            <h3 class="heading-h4 fw-semibold mb-0 text-dark mt-3">
                                                Biryani Boxes
                                            </h3>
                                            <div class="mt-6">
                                                <a href="{{ route('front.catalog') }}?subcategory=biryani-boxes"
                                                    class="btn btn-outline-danger text-uppercase text-sm fw-bold border border-2 border-danger shadow-none px-4 py-2 rounded-pill text-dark">
                                                    Shop Now
                                                    <i class="fas ms-2 text-sm text-dark fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 position-relative">
                                    <div class="h-100 p-8 bg-green-light food-box-item foodox-item-2">
                                        <div class="img-wrapp content-box-1-img overflow-hidden py-4">
                                            <img src="{{ asset('assets/frontend/images/best-prod-2.png') }}" alt="first food box" class="best-prod-img no-download" />
                                        </div>
                                        <div class="content-box ">
                                            <div class="ps-8 ps-lg-0">
                                                <p class="text-danger fs-14 mb-0 fw-semibold">
                                                    #New Arrivals
                                                </p>
                                                <h3 class="heading-h4 fw-semibold mb-0 text-dark mt-3">
                                                    Wrap Boxes
                                                </h3>
                                                <div class="mt-6">
                                                    <a href="{{ route('front.catalog') }}?subcategory=Wrap-Box"
                                                        class="btn btn-outline-danger text-uppercase text-sm fw-bold border border-2 border-danger shadow-none px-4 py-2 rounded-pill text-dark">
                                                        Shop Now
                                                        <i class="fas ms-2 text-sm text-dark fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 position-relative">
                                    <div class="h-100 p-8 bg-green-light food-box-item foodox-item-3">
                                        <div class="img-wrapp content-box-2-img">
                                            <img src="{{ asset('assets/frontend/images/best-prod-4.png') }}" alt="first food box" class="best-prod-img no-download" />
                                        </div>
                                        <div class="content-box">
                                            <div class="ps-8 ps-lg-0 mt-4 mt-lg-0">
                                                <p class="text-danger fs-14 mb-0 fw-semibold">
                                                    #Most popular
                                                </p>
                                                <h3 class="heading-h4 fw-semibold mb-0 text-dark mt-3">
                                                    Sandwich Boxes
                                                </h3>
                                                <div class="mt-6">
                                                    <a href="{{ route('front.catalog') }}?subcategory=sandwich-boxes"
                                                        class="btn btn-outline-danger text-uppercase text-sm fw-bold border border-2 border-danger shadow-none px-4 py-2 rounded-pill text-dark">
                                                        Shop Now
                                                        <i class="fas ms-2 text-sm text-dark fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="h-100 p-8 d-flex flex-column flex-lg-row align-items-start bg-red-light food-box-item foodox-item-4">
                                        <div class="img-wrapp">
                                            <img src="{{ asset('assets/frontend/images/best-prod-5.png') }}" alt="first food box" class="best-prod-img no-download" />
                                        </div>
                                        <div class="ps-4 ps-lg-12">
                                            <p class="text-danger fs-14 mb-0 fw-semibold">
                                                #Hot collection
                                            </p>
                                            <h3 class="heading-h4 fw-semibold mb-0 text-dark mt-3">
                                                Boat Trays
                                                <div class="mt-6">
                                                    <a href="{{ route('front.catalog') }}?subcategory=boat-trays"
                                                        class="btn btn-outline-danger text-uppercase text-sm fw-bold border border-2 border-danger shadow-none px-4 py-2 rounded-pill text-dark">
                                                        Shop now
                                                        <i class="fas ms-2 text-sm text-dark fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="h-100 p-8 bg-yellow-light food-box-item foodox-item-5">
                                <div class="d-flex flex-column ps-8">
                                    <div>
                                        <p class="text-danger fs-14 mb-0 fw-semibold">
                                            #Treding now
                                        </p>
                                        <h3 class="heading-h4 fw-semibold mb-0 text-dark mt-3">
                                            Pizza Boxes
                                        </h3>
                                        <div class="mt-6">
                                            <a href="{{ route('front.catalog') }}?subcategory=Pizza-Box-"
                                                class="btn btn-outline-danger text-uppercase text-sm fw-bold border border-2 border-danger shadow-none px-4 py-2 rounded-pill text-dark">
                                                Shop now
                                                <i class="fas ms-2 text-sm text-dark fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="img-wrapp mt-8">
                                    <img src="{{ asset('assets/frontend/images/best-prod-3.png') }}" width="354" alt="first food box" class="best-prod-img no-download" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  best selling section ends here -->


        <!-- gift box section starts here -->
        <section class="gift-section">
            <div class="container">
                <h2 class="text-dark text-capitalize fw-semibold text-center heading-h2 mb-0">
                    Super cool Gift box
                </h2>
                <p class="text-muted w-100 w-md-60 w-lg-50 mx-auto lh-base text-center mt-2 mb-0">
                    It almost doesn't matter what goes inside, with ourgift boxes you
                    are sure to impress! Discover them
                </p>
                <div class="mt-6 w-100 w-lg-90 w-5xl-100 mx-auto mt-8">
                    <div class="row g-4">
                        @foreach ($select_8_item_home as $item)
                        @php
                                        $thumbs = [];
                                    @endphp
                                    @if ($item->photo != null)
                                        @php
                                            $thumbs = explode(',', $item->photo);
                                        @endphp
                                    @endif
                            <div class="col-6 col-lg-3 d-flex flex-column prod-column align-items-center position-relative overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ route('front.product', $item->slug) }}">

                                        <img  @foreach ($thumbs as $key => $thumb)
                                        @if ($key === 0)
                                        data-src="{{ uploaded_asset($thumb) }}"
                                        @else
                                            data-src-2="{{ uploaded_asset($thumb) }}"
                                            @endif @endforeach alt="Image 1"
                                            class="img-fluid cat-prod-img lazy no-download rounded" /></a>
                                    <!-- floating content -->
                                    <div class="position-absolute cart-actions text-white fw-bold fs-14 mb-0">
                                        <div class="action-btn shadow-lg">
                                            <a class="product-button wishlist_store" href="{{ route('user.wishlist.store', $item->id) }}" title="{{ __('Wishlist') }}"><i
                                                    class="fa-regular fa-heart fs-20"></i></a>
                                        </div>
                                        <div class="mt-2 quick-view-btn action-btn shadow-lg" data-product-id="{{ $item->id }}">
                                            <i class="fas fa-search fs-20"></i>
                                        </div>

                                        <a data-target="{{ route('fornt.compare.product', $item->id) }}" class="mt-2 action-btn shadow-lg product-button product_compare" href="javascript:;"
                                            title="{{ __('Compare') }}"><i class="fa-solid fa-arrow-right-arrow-left fs-18"></i></a>
                                    </div>

                                    @if ($item->previous_price && $item->previous_price != 0)
                                        <p class="position-absolute off-price bg-danger text-white fw-bold fs-12 mb-0">
                                            -{{ PriceHelper::DiscountPercentage($item) }}
                                        </p>
                                    @endif
                                    @if ($item->is_stock())
                                        <span
                                            class="position-absolute item-badge text-white fw-bold fs-12 mb-0
                                      @if ($item->is_type == 'feature') bg-warning
                                      @elseif($item->is_type == 'new')
                                      bg-success
                                      @elseif($item->is_type == 'top')
                                      bg-info
                                      @elseif($item->is_type == 'best')
                                      bg-dark
                                      @elseif($item->is_type == 'flash_deal')
                                        bg-success @endif
                                      ">{{ $item->is_type != 'undefined' ? ($item->is_type != 'flash_deal' ? ucfirst(str_replace('_', ' ', $item->is_type)) : 'Deal') : '' }}</span>
                                    @else
                                        <span class="position-absolute item-badge text-white fw-bold fs-12 mb-0 bg-danger">{{ __('Sold') }}</span>
                                    @endif

                                    <!-- timer -->
                                    @if ($item->is_type == 'flash_deal' && $item->date != null && \Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($item->date)))
                                        <div class="timer position-absolute mx-auto align-items-center justify-content-between bg-white p-2" data-date-time="{{ $item->date }}">
                                            <div class="time">
                                                <p class="days mb-0 fs-16 fw-bold text-danger" id="days">00</p>
                                                <p class="mb-0 fs-12 font-smeibold text-muted">Days</p>
                                            </div>
                                            <div>:</div>
                                            <div class="time">
                                                <p class="hours mb-0 fs-16 fw-bold text-danger" id="hours">00</p>
                                                <p class="mb-0 fs-12 font-smeibold text-muted">Hours</p>
                                            </div>
                                            <div>:</div>
                                            <div class="time">
                                                <p class="minutes mb-0 fs-16 fw-bold text-danger" id="minutes">00</p>
                                                <p class="mb-0 fs-12 font-smeibold text-muted">Mins</p>
                                            </div>
                                            <div>:</div>
                                            <div class="time">
                                                <p class="seconds mb-0 fs-16 fw-bold text-danger" id="seconds">00</p>
                                                <p class="mb-0 fs-12 font-smeibold text-muted">Sec</p>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- timer -->

                                    <div class="quick-add-btn position-absolute">
                                        @if ($item->item_type != 'affiliate')
                                            @if ($item->is_stock())
                                                <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none " data-target="{{ $item->id }}">Quick
                                                    Add</button>
                                            @else
                                                <a class="btn btn-danger py-3 btn-block w-100 text-white" href="{{ route('front.product', $item->slug) }}" title="{{ __('Details') }}"><i
                                                        class="icon-arrow-right"></i></a>
                                            @endif
                                        @else
                                            <a class="btn btn-danger py-3 btn-block w-100 text-white" href="{{ $item->affiliate_link }}" target="_blank" title="{{ __('Buy Now') }}"><i
                                                    class="icon-arrow-right"></i></a>
                                        @endif
                                    </div>
                                    <div class="quick-add-btn position-absolute">
                                        @if ($item->item_type != 'affiliate')
                                            @if ($item->is_stock())
                                                <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none text-white"
                                                    data-target="{{ $item->id }}">Quick
                                                    Add</button>
                                            @else
                                                <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none text-white" data-target="{{ $item->id }}"
                                                    disabled>Quick
                                                    Add</button>
                                            @endif
                                        @else
                                            <a class="btn btn-danger py-3 btn-block w-100 text-white" href="{{ $item->affiliate_link }}" target="_blank"
                                                title="{{ __('Buy Now') }}">{{ __('Buy Now') }}</a>
                                        @endif
                                    </div>
                                    <!-- floating content -->
                                </div>

                                <p class="text-muted fw-semibold mt-4 mb-3">
                                    <a class="text-muted" href="{{ route('front.product', $item->slug) }}">{{ Str::limit($item->name, 22) }}</a>
                                </p>
                                <div class="d-flex">
                                    <p class="text-danger fw-bold fs-18 mb-0 ">
                                        {{ PriceHelper::grandCurrencyPrice($item) }}
                                    </p>
                                    @if ($item->previous_price != 0)
                                        <p class="text-gray-300 fs-18 fw-bold text-decoration-line-through mb-0 ms-4">{{ PriceHelper::setPreviousPrice($item->previous_price) }}</p>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- gift section ends here -->

        <!-- luxury box section starts here -->
        <section class="luxury-section" id="luxpadd">
            <div class="container-fluid container-5xl px-4 px-md-6 px-lg-8 px-5xl-0">
                <h2 class="text-dark text-capitalize fw-semibold text-center heading-h2 mb-0">
                    Luxury Packaging Boxes
                </h2>
                <p class="text-muted w-100 w-md-60 w-lg-50 mx-auto lh-base text-center mt-2 mb-0">
                    The luxury cardboard boxes have all the characteristics that define
                    a premium packaging<br> quality of materials, solidity, textures, and
                    also ecological.
                </p>
                <div class="mt-6 mt-8">
                    <div class="row g-4">
                        <div class="col-md-6 position-relative col-lg-3 d-flex flex-column align-items-center overflow-hidden">
                            <img src="{{ asset('assets/frontend/images/luxury-prod-1.png') }}" alt="Image 1" class="img-fluid cat-prod-img no-download cursor-pointer"
                                onclick="redirectToPage('{{ route('front.catalog') }}?category=corporate-gifting')">
                            <a href="{{ route('front.catalog') }}?category=corporate-gifting"
                                class="text-dark text-decoration-none mb-0 heading-h5 px-4 fw-semibold py-3 position-absolute bg-white luxury-text">
                                Corporate Gifting
                            </a>
                        </div>
                        <div class="col-md-6 position-relative col-lg-3 d-flex flex-column align-items-center overflow-hidden">
                            <img src="{{ asset('assets/frontend/images/luxury-prod-2.png') }}" alt="Image 1" class="img-fluid cat-prod-img no-download cursor-pointer"
                                onclick="redirectToPage('{{ route('front.catalog') }}?subcategory=wedding-gifting')">
                            <a href="{{ route('front.catalog') }}?subcategory=wedding-gifting"
                                class="text-dark text-decoration-none mb-0 heading-h5 px-4 fw-semibold py-3 position-absolute bg-white luxury-text">
                                Wedding Gifting
                            </a>
                        </div>
                        <div class="col-md-6 position-relative col-lg-3 d-flex flex-column align-items-center overflow-hidden">
                            <img src="{{ asset('assets/frontend/images/luxury-prod-3.png') }}" alt="Image 1" class="img-fluid cat-prod-img no-download cursor-pointer"
                                onclick="redirectToPage('{{ route('front.catalog') }}?subcategory=festive-gifting')">
                            <a href="{{ route('front.catalog') }}?subcategory=festive-gifting"
                                class="text-dark text-decoration-none mb-0 heading-h5 px-4 fw-semibold py-3 position-absolute bg-white luxury-text">
                                Festive Gifting
                            </a>
                        </div>
                        <div class="col-md-6 position-relative col-lg-3 d-flex flex-column align-items-center overflow-hidden">
                            <img src="{{ asset('assets/frontend/images/luxury-prod-4.png') }}" alt="Image 1" class="img-fluid cat-prod-img no-download cursor-pointer"
                                onclick="redirectToPage('{{ route('front.catalog') }}?subcategory=birthday-gifting')">
                            <a href="{{ route('front.catalog') }}?subcategory=birthday-gifting"
                                class="text-dark text-decoration-none mb-0 heading-h5 px-4 fw-semibold py-3 position-absolute bg-white luxury-text">
                                Birthday Gifting
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- luxury  section ends here -->

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
        <style>
            .brand-slider .owl-nav.disabled {
                display: block;
            }
        </style>
        <!-- logo grid section starts here -->
        @if ($extra_settings->is_t2_brand_section == 1)
            <div class="py-12 py-lg-60 w-100 w-lg-90 container w-5xl-100 mx-auto">
                <div class="brand-slider owl-carousel">
                    @foreach ($brands as $brand)
                        <div class="slider-item py-2 logo-wrap d-flex justify-content-center">
                            <img class="d-block hi-50 lazy no-download" src="{{ asset('assets/images/' . $brand->photo) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <!--  logo grid  section ends here -->
    @endsection
    <script>
        function redirectToPage(url) {
            window.location.href = url;
        }
    </script>
