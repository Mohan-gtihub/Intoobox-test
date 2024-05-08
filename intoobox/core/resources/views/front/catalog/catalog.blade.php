<!-- Shop Toolbar-->
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

<div class="row g-3" id="main_div">
    @if ($items->count() > 0)
        @if ($checkType != 'list')
            @foreach ($items as $item)
                <div class="prod-column col-lg-3 col-md-4 col-6 d-flex flex-column prod-column align-items-center position-relative overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <a href="{{ route('front.product', $item->slug) }}">

                            <img data-src="{{ asset('assets/images/' . $item->thumbnail) }}"
                                data-src-2="{{ $item->galleries && count($item->galleries) > 0 ? asset('assets/images/' . $item->galleries[0]->photo) : '' }}" alt="Image 1"
                                class="img-fluid cat-prod-img lazy no-download rounded" /></a>
                        <!-- floating content -->
                        <div class="position-absolute cart-actions text-white fw-bold fs-14 mb-0">
                            <div class="action-btn shadow-lg">
                                <a class="product-button wishlist_store" href="{{ route('user.wishlist.store', $item->id) }}" title="{{ __('Wishlist') }}"><i class="fa-regular fa-heart fs-20"></i></a>
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
                                    <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none" data-target="{{ $item->id }}">Quick
                                        Add</button>
                                @else
                                    <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none" data-target="{{ $item->id }}" disabled>Quick
                                        Add</button>
                                @endif
                            @else
                                <a class="btn btn-danger py-3 btn-block w-100 text-dark" href="{{ $item->affiliate_link }}" target="_blank"
                                    title="{{ __('Buy Now') }}">{{ __('Buy Now') }}</a>
                            @endif
                        </div>
                        <!-- floating content -->
                    </div>
                    <p class="text-muted fw-semibold mt-4 mb-3">
                        <a class="text-muted" href="{{ route('front.product', $item->slug) }}">
                            {{ Str::limit($item->name, 35) }}</a>
                    </p>
                    <div class="d-flex">
                        <p class="text-danger fw-bold fs-18 mb-0">
                            {{ PriceHelper::grandCurrencyPrice($item) }}
                        </p>
                        @if ($item->previous_price != 0)
                            <p class="text-gray-300 fs-18 fw-bold text-decoration-line-through mb-0 ms-4">
                                {{ PriceHelper::setPreviousPrice($item->previous_price) }}</p>
                        @endif
                    </div>
                    <!-- floating content -->
                    @if ($item->previous_price && $item->previous_price != 0)
                        <p class="position-absolute off-price bg-danger text-white fw-bold fs-12 mb-0">
                            -{{ PriceHelper::DiscountPercentage($item) }}
                        </p>
                    @endif

                </div>
            @endforeach
        @else
            @foreach ($items as $item)
                <div class="prod-column col-12">

                    <div class="d-flex product-content-wrap align-items-center position-relative overflow-hidden flex-row">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ route('front.product', $item->slug) }}">

                                        <img data-src="{{ asset('assets/images/' . $item->thumbnail) }}"
                                            data-src-2="{{ $item->galleries && count($item->galleries) > 0 ? asset('assets/images/' . $item->galleries[0]->photo) : '' }}" alt="Image 1"
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
                                                <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none"
                                                    data-target="{{ $item->id }}">Quick
                                                    Add</button>
                                            @else
                                                <button class="btn btn-danger py-3 btn-block w-100 text-white product-button add_to_single_cart shadow-none" data-target="{{ $item->id }}"
                                                    disabled>Quick
                                                    Add</button>
                                            @endif
                                        @else
                                            <a class="btn btn-danger py-3 btn-block w-100 text-white shadow-none" href="{{ $item->affiliate_link }}" target="_blank"
                                                title="{{ __('Buy Now') }}">{{ __('Buy Now') }}</a>
                                        @endif
                                    </div>
                                    <!-- floating content -->
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="prod-info-content mt-4 mt-lg-0">
                                    <p class="list-prod-content fs-12 text-gray-700 mb-0 d-block">
                                        <a class="text-danger" href="{{ route('front.catalog') . '?category=' . $item->category->slug }}">{{ $item->category->name }}</a>
                                    </p>
                                    <p class="text-muted fw-semibold mt-3 mb-0">
                                        <a class="text-muted" href="{{ route('front.product', $item->slug) }}">
                                            {{ Str::limit($item->name, 42) }}
                                        </a </p>
                                    <div class="rating list-prod-content mt-3 d-block">
                                        {!! renderStarRating($item->reviews->avg('rating')) !!}
                                    </div>
                                    <div class="d-flex price mt-2">
                                        @if ($item->previous_price != 0)
                                            <p class="text-muted fs-16 fw-bold ms-0">
                                                <del>{{ PriceHelper::setPreviousPrice($item->previous_price) }}</del>
                                            </p>
                                        @endif
                                        <p class="text-dark fs-18 fw-bold ms-2">{{ PriceHelper::grandCurrencyPrice($item) }}
                                        </p>
                                    </div>
                                    <p class="mt-3 product-description list-prod-content text-gray-700 fs-16 mb-0 d-block">
                                        {{ Str::limit(strip_tags($item->sort_details), 100) }}
                                    </p>
                                </div>

                                @if ($item->previous_price && $item->previous_price != 0)
                                    <p class="position-absolute off-price bg-danger text-white fw-bold fs-14 mb-0">
                                        -{{ PriceHelper::DiscountPercentage($item) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @else
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="h4 mb-0">{{ __('No Product Found') }}</h4>
                </div>
            </div>
        </div>
    @endif
</div>


<!-- Pagination-->
<div class="row mt-15" id="item_pagination">
    <div class="col-12 mt-8 mt-lg-12">
        {{ $items->links() }}
    </div>
</div>

<script type="text/javascript" src="{{ asset('assets/front/js/catalog.js') }}"></script>
<script>
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

    $("[data-date-time]").each(function() {
        var $this = $(this),
            finalDate = $this.attr("data-date-time");

        // Find countdown elements within the current product context
        var $days = $this.find('.days');
        var $hours = $this.find('.hours');
        var $minutes = $this.find('.minutes');
        var $seconds = $this.find('.seconds');

        // Initialize countdown for each set of elements
        $this.countdown(finalDate, function(event) {
            // Update the corresponding HTML elements with the countdown values
            $days.text(event.strftime('%D'));
            $hours.text(event.strftime('%H'));
            $minutes.text(event.strftime('%M'));
            $seconds.text(event.strftime('%S'));
        });

    });





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
</script>
