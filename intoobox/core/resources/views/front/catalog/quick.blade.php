
<div class="container container-5xl">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-gallery">
                    @if ($item->video)
                        <div class="gallery-wrapper">
                            <div
                                class="gallery-item d-flex align-items-center shadow-sm bg-white rounded-pill px-6 py-4 video-btn text-center">
                                <a href="{{ $item->video }}" title="Watch video" class="product-video">
                                    <svg width="19" height="20" viewBox="0 0 19 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
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
        <div class="item rounded-3">
            <a href="{{ asset('assets/images/' . $item->photo) }}" data-zoom-image="{{ asset('assets/images/' . $item->photo) }}">
                <img class="" src="{{ asset('assets/images/' . $item->photo) }}" alt="zoom" />
            </a>
        </div>
        @foreach ($galleries as $key => $gallery)
            <div class="item rounded-3">
                <a href="{{ asset('assets/images/' . $gallery->photo) }}" data-zoom-image="{{ asset('assets/images/' . $gallery->photo) }}">
                    <img class="" src="{{ asset('assets/images/' . $gallery->photo) }}" alt="zoom" />
                </a>
            </div>
        @endforeach
    </div>
</div>
                </div>
            </div>

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
            <div class="col-lg-6 mt-6 mt-lg-0 ps-lg-80 pe-lg-12">
                <input type="hidden" id="item_id" value="{{ $item->id }}">
                        <input type="hidden" id="demo_price"
                            value="{{ PriceHelper::setConvertPrice($item->discount_price) }}">
                        <input type="hidden" value="{{ PriceHelper::setCurrencySign() }}" id="set_currency">
                        <input type="hidden" value="{{ PriceHelper::setCurrencyValue() }}" id="set_currency_val">
                        <input type="hidden" value="{{ $setting->currency_direction }}" id="currency_direction">
                <h3 class="text-dark fw-bold heading-h3 mb-0">{{ $item->name }}</h3>
                <div class="d-flex align-items-center mt-5">
                    <div class="d-flex">
                        {!! renderStarRating($item->reviews->avg('rating')) !!}
                    </div>
                    <p class="text-danger mb-0 ms-6">({{count($reviews)}} reviews)</p>
                </div>
                <h5 class="mt-7 mt-lg-9 mb-0 text-danger heading-h3 fw-semibold">
                    {{ PriceHelper::grandCurrencyPrice($item) }}
                    @if ($item->previous_price != 0)
                        <small
                            class="d-inline-block"><del>{{ PriceHelper::setPreviousPrice($item->previous_price) }}</del></small>
                    @endif
                </h5>

                
                <p class="mt-5 fs-16 text-gray-700 mb-0">
                    {{ $item->sort_details }}
                </p>
                <div class="mt-8 mt-lg-12 d-flex align-items-center justify-content-cetner">
                    @if ($item->item_type == 'normal')
                    <div class="counter-container d-flex align-items-center justify-content-cetner bg-gray-100 px-3 py-2 w-fit">
                        <button class="counter-button border-0 bg-transparent decrement decreaseQty subclick"  data-multiple="{{$item->multiple}}">
                            <i class="fas fa-minus fs-18 text-gray-700"></i>
                        </button>
                        <input type="text" class="border-0 cart-qty bg-transparent qtyValue cart-amount quickQtyValue" id="cart-qty" min="{{$item->min_qty}}" value="{{$item->min_qty}}" />
                        <button class="counter-button border-0 bg-transparent increment increaseQty addclick"  data-multiple="{{$item->multiple}}">
                            <i class="fas fa-plus fs-18 text-gray-700"></i>
                        </button>
                        <input type="hidden" value="3333" id="current_stock">
                    </div>
                    @endif
                    <div class="ms-4">
                        @if ($item->is_stock())
                            <button class="btn px-6 py-4 border-0 text-white text-uppercase rounded rounded-lg-0 d-flex align-items-center justify-content-center btn-danger"
                                id="add_to_cart"><span class="d-none d-md-block">Add to Cart</span><span class="d-block d-md-none">
                            <svg width="25" height="31" viewBox="0 0 25 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.8 28C2.03 28 1.3706 27.7256 0.821802 27.1768C0.273002 26.628 -0.000930956 25.9691 2.37691e-06 25.2V8.4C2.37691e-06 7.63 0.274402 6.9706 0.823202 6.4218C1.372 5.873 2.03094 5.59907 2.8 5.6H5.6C5.6 4.06 6.14833 2.74167 7.245 1.645C8.34167 0.548333 9.66 0 11.2 0C12.74 0 14.0583 0.548333 15.155 1.645C16.2517 2.74167 16.8 4.06 16.8 5.6H19.6C20.37 5.6 21.0294 5.8744 21.5782 6.4232C22.127 6.972 22.4009 7.63093 22.4 8.4V25.2C22.4 25.97 22.1256 26.6294 21.5768 27.1782C21.028 27.727 20.3691 28.0009 19.6 28H2.8ZM2.8 25.2H19.6V8.4H16.8V11.2C16.8 11.5967 16.6656 11.9294 16.3968 12.1982C16.128 12.467 15.7957 12.6009 15.4 12.6C15.0033 12.6 14.6706 12.4656 14.4018 12.1968C14.133 11.928 13.9991 11.5957 14 11.2V8.4H8.4V11.2C8.4 11.5967 8.2656 11.9294 7.9968 12.1982C7.728 12.467 7.39573 12.6009 7 12.6C6.60333 12.6 6.2706 12.4656 6.0018 12.1968C5.733 11.928 5.59907 11.5957 5.6 11.2V8.4H2.8V25.2ZM8.4 5.6H14C14 4.83 13.7256 4.1706 13.1768 3.6218C12.628 3.073 11.9691 2.79907 11.2 2.8C10.43 2.8 9.7706 3.0744 9.2218 3.6232C8.673 4.172 8.39907 4.83093 8.4 5.6Z" fill="#ffffff"></path>
                            </svg>
                            </span></button>
                        @else
                            <button
                                class="btn px-6 py-4 border-0 text-white text-uppercase rounded-0 d-flex align-items-center justify-content-center btn-danger"
                                id="add_to_cart" disabled>{{ __('Out of stock') }}</button>
                        @endif
                    </div>
                    <div class="ms-4">
                        <a class="btn btn-gray wishlist_store wishlist_text bg-gray-100 px-4 py-3 border-0" href="{{route('user.wishlist.store',$item->id)}}"><i class="fa-regular fa-heart text-muted fs-24"></i></a>
                    </div>
                </div>
                <style>
                    .left-titles {
                        width: 85px;
                        display: inline-block;
                    }
                </style>
                <div class="my-12 my-lg-60 devider"></div>
                <div>
                    <span class="text-dark fs-16 left-titles"> Availability </span>
                    <span class="ms-8 text-dark fs-16"> : </span>
                    @if ($item->is_stock())
                        <span class="text-success  ms-8 text-success fs-16">{{ __('In Stock') }}</span>
                    @else
                        <span class="text-danger  ms-8 text-success fs-16">{{ __('Out of stock') }}</span>
                    @endif
                </div>
                <div class="mt-5">
                    <span class="text-dark fs-16 left-titles"> Dimensions </span>
                    <span class="ms-8 text-dark fs-16"> : </span>
                    <span class="ms-8 text-muted fs-16">W 4.0” D 4.0” H 3.0” </span>
                </div>
                <div class="t-c-b-area">

                    <div class="pt-1 mt-5">
                        <span class="text-medium left-titles">{{ __('Categories') }}</span>
                        <span class="ms-8 text-dark fs-16"> : </span>
                        <span class="ms-8 fs-16">
                            <a class="fs-14 text-danger" href="{{ route('front.catalog') . '?category=' . $item->category->slug }}">{{ $item->category->name }}</a>
                            @if ($item->subcategory->name)
                                / <a class="fs-14 text-danger" href="{{ route('front.catalog') . '?subcategory=' . $item->subcategory->slug }}">{{ $item->subcategory->name }}</a>
                            @endif
                            
                        </span>
                    </div>
                    @if ($item->tags)
                    <div class="mt-5 mb-1"><span class="text-medium left-titles">{{ __('Tags') }}</span>
                        <span class="ms-8 text-dark fs-16"> : </span>
                        <span class="ms-8 fs-16">
                            
                                @foreach (explode(',', $item->tags) as $tag)
                                    @if ($loop->last)
                                        <a class="fs-14 text-danger"
                                            href="{{ route('front.catalog') . '?tag=' . $tag }}">{{ $tag }}</a>
                                    @else
                                        <a class="fs-14 text-danger"
                                            href="{{ route('front.catalog') . '?tag=' . $tag }}">{{ $tag }}</a>,
                                    @endif
                                @endforeach
                          
                        </span>
                    </div>
                    @endif
                    @if ($item->item_type == 'normal')
                        <div class="mt-5 mb-4">
                            <span class="text-dark fs-16 left-titles">{{ __('SKU') }}</span>
                            <span class="ms-8 text-dark fs-16"> : </span>
                            <span class="ms-8 fs-16"> #{{ $item->sku }}</span>
                        </div>
                    @endif
                </div>
                <div class="mt-5">
                    @php
                    $shareBtns=Share::page(route('front.product', $item->slug), $item->name)
                    ->facebook()
                    ->twitter()
                    ->linkedin($item->meta_description)
                    ->whatsapp()
                    ->getRawLinks();
                    @endphp
                    <span class="text-dark fs-16 left-titles"> Share on </span>
                    <span class="ms-8 text-dark fs-16"> : </span>
                    <span class="ms-8 fs-16">
                    <a target="_blank" href="https://www.instagram.com/intoobox/" class="fab fa-instagram text-muted ms-4"></a>
                    <a target="_blank" href="{{ $shareBtns['facebook'] }}" class="fab fa-facebook text-muted ms-4"></a>
                    <a target="_blank" href="https://www.youtube.com/" class="fab fa-youtube ms-3 text-muted"></a>
                    <a target="_blank" href="http://pinterest.com/pin/create/link/?url={{route('front.product', $item->slug)}}" class="fab fa-pinterest ms-3 text-muted"></a>
                    </span>
                </div>
            </div>
        </div>
    </div>

