@extends('master.front')

@section('title')
    {{ $item->name }}
@endsection

@section('meta')
    <meta name="keywords" content="{{ $item->meta_keywords }}">
    <meta name="description" content="{{ $item->meta_description }}">
@endsection
@section('styleplugins')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/owl.min.css') }}" />
@endsection


@section('content')
    <section class="cart-section my-6 my-lg-8">
        <!-- product breadcrumb -->
        <div class="container">
            <h2 class="mb-0 text-center fw-bold text-dark heading-h2">
                Product Details
            </h2>
            <div class="d-flex align-items-center justify-content-center mt-4">
                <div>
                    <a href="{{ route('front.index') }}" class="fs-16 fw text-dark"> Home </a>
                </div>
                <div class="text-gray-700 ms-2">-</div>
                <div>
                    <a href="#" class="fs-16 ms-2 fw text-dark"> Shop </a>
                </div>
                <div class="text-gray-700 ms-2">-</div>
                <p class="text-gray-700 ms-2 mb-0">{{ $item->name }}</p>
            </div>
        </div>
        <!-- product breadcrumb -->
    </section>

    <!-- single product section -->
    <div class="container container-5xl">
        <div class="row">
            <div class="col-lg-5">
                <div class="product-gallery">
                    @if ($item->video)
                        <div class="gallery-wrapper">
                            <div class="gallery-item d-flex align-items-center shadow-sm bg-white rounded-pill px-6 py-4 video-btn text-center">
                                <a href="{{ $item->video }}" title="Watch video" class="product-video">
                                    <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.409 7.35331C17.8893 7.60872 18.291 7.99 18.5712 8.45629C18.8514 8.92259 18.9994 9.45632 18.9994 10.0003C18.9994 10.5443 18.8514 11.078 18.5712 11.5443C18.291 12.0106 17.8893 12.3919 17.409 12.6473L4.597 19.6143C2.534 20.7363 0 19.2763 0 16.9683V3.03331C0 0.723308 2.534 -0.735693 4.597 0.385307L17.409 7.35331Z"
                                            fill="#FF6363" />
                                    </svg>
                                    <span class="ms-1 text-danger product-video">
                                        Play Video
                                    </span>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($item->previous_price && $item->previous_price != 0)
                        <div class="product-badge bg-success"> -{{ PriceHelper::DiscountPercentage($item) }}</div>
                    @endif
                    <div class="product-thumbnails insize">
                        <div class="product-details-slider owl-carousel">
                            
                            @php
                                $photos = [];
                            @endphp
                            @if ($item->galleries != null)
                                @php
                                    $photos = explode(',', $item->galleries);
                                @endphp
                            @endif
                            @foreach ($photos as $key => $photo)
                                <div class="item">
                                    <img class="no-download" src="{{ uploaded_asset($photo) }}" alt="zoom" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @php
                    $itemDetails = $item->bulk_discount ? json_decode($item->bulk_discount, true) : [];
                @endphp
                @if (count($itemDetails) > 0)
                    <div class="mt-8 mt-lg-12">
                        <h5 class="fw-medium mb-4">BULK DEAL</h5>
                        <table class="table border rounded-2">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-danger fw-semibold py-4 px-6 w-50">
                                        Quantity
                                    </th>
                                    <th scope="col" class="text-danger fw-semibold py-4 px-6 w-50">
                                        Price Per Box
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemDetails as $detail)
                                    @php
                                        $discountedPrice = $detail['price'] ?? $item->discount_price;

                                        if ($item->discount_price > 0) {
                                            $discountPercentage = 100 - ($discountedPrice / $item->discount_price) * 100;
                                        } else {
                                            $discountPercentage = 0; // Default to 0% if actual price is zero
                                        }
                                    @endphp
                                    <tr>
                                        <td class="py-4 px-6 w-50">{{ $detail['items'] ?? '0' }}</td>
                                        <td class="py-4 px-6 w-50">₹ {{ $detail['price'] ?? '0' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            @php
                function renderStarRating($rating, $maxRating = 5)
                {
                    $fullStar = "<i class = 'fas fa-star filled'></i>";
                    $halfStar = "<i class = 'fas fa-star-half filled'></i>";
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
            <div class="col-lg-7 mt-6 mt-lg-0 ps-lg-80 pe-lg-1">
                <input type="hidden" id="item_id" value="{{ $item->id }}">
                <input type="hidden" id="demo_price" value="{{ PriceHelper::setConvertPrice($item->discount_price) }}">
                <input type="hidden" value="{{ PriceHelper::setCurrencySign() }}" id="set_currency">
                <input type="hidden" value="{{ PriceHelper::setCurrencyValue() }}" id="set_currency_val">
                <input type="hidden" value="{{ $setting->currency_direction }}" id="currency_direction">
                <h3 class="text-dark fw-bold heading-h3 mb-0">{{ $item->name }}</h3>
                <div class="d-flex align-items-center mt-5">
                    <div class="d-flex rating-stars">
                        {!! renderStarRating($item->reviews->avg('rating')) !!}
                    </div>
                    <p class="text-danger mb-0 ms-6">({{ count($reviews) }} reviews)</p>
                </div>
                <h5 class="mt-7 mt-lg-9 mb-0 text-danger heading-h3 fw-semibold price-area">
                    <span id="main_price" class="main-price">{{ PriceHelper::grandCurrencyPrice($item) }}</span>
                    @if ($item->previous_price != 0)
                        <small class="d-inline-block"><del>{{ PriceHelper::setPreviousPrice($item->previous_price) }}</del></small>
                    @endif
                </h5>
                <div class="w-lg-75">
                    <div class="mt-7">
                    @foreach ($attributes as $attribute)
                        @if ($attribute->options->count() != 0)
                            <div class="mb-6 d-flex align-items-center justify-content-between">
                                <label for="{{ $attribute->name }}" class="options-label left-titles">{{ $attribute->name }}</label>
                                <span class="text-dark fs-16 ">:</span>
                                <hr>
                                <select class="form-control fs-16 attribute_option w-50" id="{{ $attribute->name }}">
                                    @foreach ($attribute->options->where('stock', '!=', '0') as $option)
                                        <option value="{{ $option->name }}" data-type="{{ $attribute->id }}" data-href="{{ $option->id }}"
                                            data-target="{{ PriceHelper::setConvertPrice($option->price) }}">
                                            {{ $option->name }}</option>
                                    @endforeach
                                </select>
                                <hr>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="d-flex align-items-center justify-content-cetner">
                    @if ($item->item_type == 'normal')
                        <div class="counter-container d-flex align-items-center justify-content-cetner bg-gray-100 px-3 py-2 w-fit">
                            <button class="counter-button border-0 bg-transparent decrement decreaseQty subclick" data-multiple="{{ $item->multiple }}">
                                <i class="fas fa-minus fs-18 text-gray-700"></i>
                            </button>
                            <input type="text" class="border-0 cart-qty bg-transparent qtyValue " id="cart-qty" min="{{ $item->min_qty }}" value="{{ $item->min_qty }}">
                            <button class="counter-button border-0 bg-transparent increment increaseQty addclick" data-multiple="{{ $item->multiple }}">
                                <i class="fas fa-plus fs-18 text-gray-700"></i>
                            </button>
                            <input type="hidden" value="3333" id="current_stock">
                        </div>
                    @endif
                    <div class="ms-6 flex-grow-1">
                        @if ($item->is_stock())
                            <button class="btn px-6 py-4 border-0 text-white w-100 text-uppercase rounded rounded-lg-0 d-flex align-items-center justify-content-center btn-danger" id="add_to_cart"><span
                                    class="d-none d-md-block">Add to Cart</span><span class="d-block d-md-none"><svg class="" width="25" height="31" viewBox="0 0 25 31" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.8 28C2.03 28 1.3706 27.7256 0.821802 27.1768C0.273002 26.628 -0.000930956 25.9691 2.37691e-06 25.2V8.4C2.37691e-06 7.63 0.274402 6.9706 0.823202 6.4218C1.372 5.873 2.03094 5.59907 2.8 5.6H5.6C5.6 4.06 6.14833 2.74167 7.245 1.645C8.34167 0.548333 9.66 0 11.2 0C12.74 0 14.0583 0.548333 15.155 1.645C16.2517 2.74167 16.8 4.06 16.8 5.6H19.6C20.37 5.6 21.0294 5.8744 21.5782 6.4232C22.127 6.972 22.4009 7.63093 22.4 8.4V25.2C22.4 25.97 22.1256 26.6294 21.5768 27.1782C21.028 27.727 20.3691 28.0009 19.6 28H2.8ZM2.8 25.2H19.6V8.4H16.8V11.2C16.8 11.5967 16.6656 11.9294 16.3968 12.1982C16.128 12.467 15.7957 12.6009 15.4 12.6C15.0033 12.6 14.6706 12.4656 14.4018 12.1968C14.133 11.928 13.9991 11.5957 14 11.2V8.4H8.4V11.2C8.4 11.5967 8.2656 11.9294 7.9968 12.1982C7.728 12.467 7.39573 12.6009 7 12.6C6.60333 12.6 6.2706 12.4656 6.0018 12.1968C5.733 11.928 5.59907 11.5957 5.6 11.2V8.4H2.8V25.2ZM8.4 5.6H14C14 4.83 13.7256 4.1706 13.1768 3.6218C12.628 3.073 11.9691 2.79907 11.2 2.8C10.43 2.8 9.7706 3.0744 9.2218 3.6232C8.673 4.172 8.39907 4.83093 8.4 5.6Z"
                                            fill="#ffffff"></path>
                                    </svg></span></button>
                        @else
                            <button class="btn px-6 py-4 border-0 text-white text-uppercase rounded-0 d-flex align-items-center justify-content-center btn-danger" id="add_to_cart"
                                disabled>{{ __('Out of stock') }}</button>
                        @endif
                    </div>
                    <div class="ms-6">
                        <a class="btn btn-gray wishlist_store wishlist_text bg-gray-100 py-3 px-4" href="{{ route('user.wishlist.store', $item->id) }}"><i
                                class="fa-regular fa-heart text-muted fs-24"></i></a>
                    </div>
                </div>
               
                <div class="my-12 my-lg-8 devider"></div>
                <div class="line-sep1"></div>
                <div class=" d-flex justify-content-between">
                    <span class="text-dark fs-16 left-titles"> Availability </span>
                    <span class="text-dark fs-16"> : </span>
                    @if ($item->is_stock())
                        <span class="text-success text-success fs-16 text-start w-50">{{ __('In Stock') }}</span>
                    @else
                        <span class="text-danger text-success fs-16 text-start w-50">{{ __('Out of stock') }}</span>
                    @endif
                </div>
                <div class="mt-5 d-flex justify-content-between">
                    <span class="text-dark fs-16 left-titles"> Dimensions </span>
                    <span class="text-dark fs-16 "> : </span>
                    <span class="text-muted fs-16 text-start  w-50">W 4.0” D 4.0” H 3.0” </span>
                </div>
                <div class="mt-5 d-flex justify-content-between">
                    <span class="text-dark fs-16 left-titles"> SKU </span>
                    <span class="text-dark fs-16"> : </span>
                    <span class="text-muted fs-16 text-start  w-50">{{ $item->sku }}</span>
                </div>
                <div class="line-sep2"></div>
                </div>
                

                <div class="mt-5 mt-lg-8 devider"></div>
                <div class="mt-5">
                    <h5 class="fw-medium mb-4">DESCRIPTION</h5>
                    <p class="text-muted" style="text-align: justify;"> {{ $item->sort_details }}</p>
                </div>
                <style>
                    .left-titles {
                        width: 155px;
                        display: inline-block;
                    }
                </style>
                <div>
                </div>

            </div>
        </div>
    </div>
    <!-- single product section -->

    <!-- product review and extra information and reviews -->
    <div class="container my-60 my-lg-80">
        <ul class="nav nav-tabs text-center" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description"
                    aria-selected="false">Product Description</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="specification-tab" data-bs-toggle="tab" data-bs-target="#specification" type="button" role="tab" aria-controls="specification"
                    aria-selected="true">Specifications</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="true">Reviews</a>
            </li>
        </ul>
        <div class="tab-content px-0">
            <div class="tab-pane fade active show" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div style="text-align: justify;">
                    {!! $item->details !!}
                </div>
            </div>
            <div class="tab-pane fade" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                <div class="comparison-table">
                    <table class="table table-borderless">
                        <thead class="bg-white">
                        </thead>
                        <!--<tbody>-->
                        <!--    <tr class="bg-white">-->
                        <!--        <th class="text-uppercase">{{ __('Specifications') }}</th>-->
                        <!--        <td><span class="text-medium">{{ __('Descriptions') }}</span></td>-->
                        <!--    </tr>-->
                        @if ($sec_name)
                            @foreach (array_combine($sec_name, $sec_details) as $sname => $sdetail)
                                <tr>
                                    <td colspan="1">{{ $sname }}</td>
                                    <td colspan="5">{{ $sdetail }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td>{{ __('No Specifications') }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-md-8">
                        @forelse ($reviews as $review)
                            <div class="single-review">
                                <div class="comment">
                                    <div class="comment-author-ava">
                                        <img class="lazy no-download" alt="Comment author" data-src="{{ asset('assets/images/' . $review->user->photo) }}"
                                            onerror="this.onerror=null; this.src='https://shopmangrove.net/placeholder.jpg'" />
                                    </div>
                                    <div class="comment-body">
                                        <div class="comment-header d-flex flex-wrap justify-content-between">
                                            <div>
                                                <h4 class="comment-title mb-1">{{ $review->subject }}</h4>
                                                <span>{{ $review->user->first_name }}</span>
                                                <span class="ml-3">{{ $review->created_at->format('M d, Y') }}</span>
                                            </div>
                                            <div class="mb-2">
                                                <div class="rating-stars">
                                                    @php
                                                        for ($i = 0; $i < $review->rating; $i++) {
                                                            echo "<i class = 'fas fa-star filled'></i>";
                                                        }
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                        <p class="comment-text mt-2">{{ $review->review }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-5">{{ __('No Review') }}</div>
                        @endforelse
                        <div class="row mt-15">
                            <div class="col-lg-12 text-center">
                                {{ $reviews->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="d-inline align-baseline display-3 mr-1">
                                        {{ round($item->reviews->avg('rating'), 2) }} </div>
                                    <div class="d-inline align-baseline text-sm text-warning mr-1">
                                        <div class="rating-stars">
                                            {!! renderStarRating($item->reviews->avg('rating')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <label class="text-medium text-sm">5 {{ __('stars') }} <span class="text-muted">-
                                            {{ $item->reviews->where('status', 1)->where('rating', 5)->count() }}</span></label>
                                    <div class="progress margin-bottom-1x">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: {{ $item->reviews->where('status', 1)->where('rating', 5)->sum('rating') * 20 }}%; height: 2px;" aria-valuenow="100"
                                            aria-valuemin="{{ $item->reviews->where('rating', 5)->sum('rating') * 20 }}" aria-valuemax="100"></div>
                                    </div>
                                    <label class="text-medium text-sm">4 {{ __('stars') }} <span class="text-muted">-
                                            {{ $item->reviews->where('status', 1)->where('rating', 4)->count() }}</span></label>
                                    <div class="progress margin-bottom-1x">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: {{ $item->reviews->where('status', 1)->where('rating', 4)->sum('rating') * 20 }}%; height: 2px;"
                                            aria-valuenow="{{ $item->reviews->where('rating', 4)->sum('rating') * 20 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <label class="text-medium text-sm">3 {{ __('stars') }} <span class="text-muted">-
                                            {{ $item->reviews->where('status', 1)->where('rating', 3)->count() }}</span></label>
                                    <div class="progress margin-bottom-1x">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $item->reviews->where('rating', 3)->sum('rating') * 20 }}%; height: 2px;"
                                            aria-valuenow="{{ $item->reviews->where('rating', 3)->sum('rating') * 20 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <label class="text-medium text-sm">2 {{ __('stars') }} <span class="text-muted">-
                                            {{ $item->reviews->where('status', 1)->where('rating', 2)->count() }}</span></label>
                                    <div class="progress margin-bottom-1x">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: {{ $item->reviews->where('status', 1)->where('rating', 2)->sum('rating') * 20 }}%; height: 2px;"
                                            aria-valuenow="{{ $item->reviews->where('rating', 2)->sum('rating') * 20 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <label class="text-medium text-sm">1 {{ __('star') }} <span class="text-muted">-
                                            {{ $item->reviews->where('status', 1)->where('rating', 1)->count() }}</span></label>
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: {{ $item->reviews->where('status', 1)->where('rating', 1)->sum('rating') * 20 }}; height: 2px;" aria-valuenow="0"
                                            aria-valuemin="{{ $item->reviews->where('rating', 1)->sum('rating') * 20 }}" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                @if (Auth::user())
                                    <div class="pb-2"><a class="btn btn-danger text-white btn-block" href="#" data-bs-toggle="modal" data-bs-target="#leaveReview"><span
                                                class="text-white">{{ __('Leave a Review') }}</span></a>
                                    </div>
                                @else
                                    <div class="pb-2"><a class="btn btn-danger btn-block text-white" href="{{ route('user.login') }}"><span class="text-white">{{ __('Login') }}</span></a></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product review and extra information and reviews -->

    <!-- featured products -->
    @if (count($related_items) > 0)
        <section class="fetured-prodcuts pb-12 pb-lg-60">
            <div class="container">
                <h2 class="text-dark text-capitalize fw-semibold text-center heading-h2 mb-0">
                    {{ __('You May Also Like') }}</h2>

                <div class="mt-6 mt-8">
                    <div class="relatedproductslider owl-carousel">

                        @foreach ($related_items as $related)
                            @php
                                $thumbs = [];
                            @endphp
                            @if ($related->photo != null)
                                @php
                                    $thumbs = explode(',', $related->photo);
                                @endphp
                            @endif
                            <div class="slider-item">
                                <div class="d-flex flex-column prod-column align-items-center position-relative overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="{{ route('front.product', $related->slug) }}">
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
                                                <a class="product-button wishlist_store" href="{{ route('user.wishlist.store', $related->id) }}" title="{{ __('Wishlist') }}"><i
                                                        class="fa-regular fa-heart fs-20"></i></a>
                                            </div>
                                            <div class="mt-2 quick-view-btn action-btn shadow-lg" data-product-id="{{ $related->id }}">
                                                <i class="fas fa-search fs-20"></i>
                                            </div>

                                            <a data-target="{{ route('fornt.compare.product', $related->id) }}" class="mt-2 action-btn shadow-lg product-button product_compare" href="javascript:;"
                                                title="{{ __('Compare') }}"><i class="fa-solid fa-arrow-right-arrow-left fs-18"></i></a>
                                        </div>

                                        @if ($related->previous_price && $related->previous_price != 0)
                                            <p class="position-absolute off-price bg-danger text-white fw-bold fs-12 mb-0">
                                                -{{ PriceHelper::DiscountPercentage($related) }}
                                            </p>
                                        @endif
                                        @if ($related->is_stock())
                                            <span
                                                class="position-absolute item-badge text-white fw-bold fs-12 mb-0
                                          @if ($related->is_type == 'feature') bg-warning
                                          @elseif($related->is_type == 'new')
                                          bg-success
                                          @elseif($related->is_type == 'top')
                                          bg-info
                                          @elseif($related->is_type == 'best')
                                          bg-dark
                                          @elseif($related->is_type == 'flash_deal')
                                            bg-success @endif
                                          ">{{ $related->is_type != 'undefined' ? ($related->is_type != 'flash_deal' ? ucfirst(str_replace('_', ' ', $related->is_type)) : 'Deal') : '' }}</span>
                                        @else
                                            <span class="position-absolute item-badge text-white fw-bold fs-12 mb-0 bg-danger">{{ __('Sold') }}</span>
                                        @endif

                                        <!-- timer -->
                                        @if ($related->is_type == 'flash_deal' && $related->date != null && \Carbon\Carbon::now()->lt(\Carbon\Carbon::parse($related->date)))
                                            <div class="timer position-absolute mx-auto align-items-center justify-content-between bg-white p-2" data-date-time="{{ $related->date }}">
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
                                            @if ($related->item_type != 'affiliate')
                                                @if ($related->is_stock())
                                                    <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none" data-target="{{ $related->id }}">Quick
                                                        Add</button>
                                                @else
                                                    <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none" data-target="{{ $related->id }}"
                                                        disabled>Quick
                                                        Add</button>
                                                @endif
                                            @else
                                                <a class="btn btn-danger py-3 btn-block w-100 text-white shadow-none" href="{{ $related->affiliate_link }}" target="_blank"
                                                    title="{{ __('Buy Now') }}">{{ __('Buy Now') }}</a>
                                            @endif
                                        </div>
                                        <!-- floating content -->
                                    </div>
                                    <p class="text-muted fw-semibold mt-4 mb-3">
                                        <a class="text-muted" href="{{ route('front.product', $related->slug) }}">
                                            {{ Str::limit($related->name, 35) }}</a>
                                    </p>
                                    <div class="d-flex">
                                        <p class="text-danger fw-bold fs-18 mb-0">
                                            {{ PriceHelper::grandCurrencyPrice($related) }}
                                        </p>
                                        @if ($related->previous_price != 0)
                                            <p class="text-gray-300 fs-18 fw-bold text-decoration-line-through mb-0 ms-4">
                                                {{ PriceHelper::setPreviousPrice($related->previous_price) }}</p>
                                        @endif
                                    </div>

                                    <!-- timer -->
                                    @if ($related->is_type == 'flash_deal' && $related->date != null)
                                        <div class="timer position-absolute mx-auto align-items-center justify-content-between bg-white p-2" data-date-time="{{ $related->date }}">
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

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- featured products -->

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
    @auth
        <form class="modal fade ratingForm" action="{{ route('front.review.submit') }}" method="post" id="leaveReview" tabindex="-1">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Leave a Review') }}</h4>
                        <button class="close modal_close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        @php
                            $user = Auth::user();
                        @endphp
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review-name">{{ __('Your Name') }}</label>
                                    <input class="form-control" type="text" id="review-name" value="{{ $user->first_name }}" required>
                                </div>
                            </div>
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review-email">{{ __('Your Email') }}</label>
                                    <input class="form-control" type="email" id="review-email" value="{{ $user->email }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review-subject">{{ __('Subject') }}</label>
                                    <input class="form-control" type="text" name="subject" id="review-subject" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review-rating">{{ __('Rating') }}</label>
                                    <select name="rating" class="form-control" id="review-rating">
                                        <option value="5">5 {{ __('Stars') }}</option>
                                        <option value="4">4 {{ __('Stars') }}</option>
                                        <option value="3">3 {{ __('Stars') }}</option>
                                        <option value="2">2 {{ __('Stars') }}</option>
                                        <option value="1">1 {{ __('Star') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review-message">{{ __('Review') }}</label>
                            <textarea class="form-control" name="review" id="review-message" rows="8" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="submit"><span>{{ __('Submit Review') }}</span></button>
                    </div>
                </div>
            </div>
        </form>
    @endauth
@endsection
