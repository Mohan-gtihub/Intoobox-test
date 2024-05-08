@php
    $grandSubtotal = 0;
    $qty = 0;
    $option_price = 0;
@endphp
@if (Session::has('cart'))

                        <div class="cart-items">
                            @foreach (Session::get('cart') as $key => $cart)
                            @php
                            // Calculate the subtotal for each item
                            $subtotal = ($cart['main_price'] + $cart['attribute_price']) * $cart['qty'];
                            $grandSubtotal += $subtotal; // Accumulate the subtotal for each item
                        @endphp
                                <div class="cart-item d-flex align-items-start justify-content-between mb-8 pe-3">
                                    <div class="cart-img-wrap">
                                        <img src="{{ asset('assets/images/' . $cart['photo']) }}" alt=""
                                            class="cart-img no-download" />
                                    </div>
                                    <div class="px-2">
                                        <p class="mb-0 text-dark" title="{{ Str::limit($cart['name'], 45) }}">
                                            {{ Str::limit($cart['name'], 15) }}</p>
                                        @foreach ($cart['attribute']['option_name'] as $optionkey => $option_name)
                                            <span
                                                class="att fs-10"><em>{{ $cart['attribute']['names'][$optionkey] }}:</em>
                                                {{ $option_name }}
                                                ({{ PriceHelper::setCurrencyPrice($cart['attribute']['option_price'][$optionkey]) }})</span>
                                        @endforeach
                                        <div class="counter-container d-flex align-items-center justify-content-between bg-gray-100 px-2 py-2 w-fit mt-1">
                                            <button class="decreaseQtycart cartsubclick counter-button border-0 bg-transparent decrement" data-target="{{ PriceHelper::GetItemId($key) }}">
                                                <i class="fas fa-minus fs-18 text-gray-700"></i>
                                            </button>
                                            <input type="number" class="qtyValue cartcart-amount border-0 ms-4 bg-transparent" value="{{ $cart['qty'] }}"
                                                disabled />
                                            <button class="increaseQtycart cartaddclick counter-button border-0 bg-transparent increment ms-1" data-target="{{ PriceHelper::GetItemId($key) }}" data-item="{{ implode(',', $cart['options_id']) }}">
                                                <i class="fas fa-plus fs-18 text-gray-700"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-dark mb-0">
                                            {{ PriceHelper::setCurrencyPrice($cart['main_price']) }}</p>
                                        <div class="mt-5 text-end py-3">
                                            <div class="entry-delete"><a href="{{ route('front.cart.destroy', $key) }}"><i class="fas fa-times text-dark"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-12 mt-lg-60">
                            <div
                                class="d-flex align-items-center justify-content-between border-top border-bottom py-4">
                                <p class="text-dark fw-bold mb-0">Subtotal</p>
                                <p class="text-danger mb-0 fw-bold">
                                    {{ PriceHelper::setCurrencyPrice($grandSubtotal) }}</p>
                            </div>
                        </div>
                        <!-- checkout button -->
                        <div class="checkout-offcanvas-cart-btn mt-8">
                            <a href="{{ route('front.cart') }}" class="btn btn-danger text-white btn-block w-100 rounded-0 text-uppercase py-3">VIEW CART</a>
                            {{-- <a href="{{ route('front.checkout.billing') }}" class="btn btn-danger text-white btn-block w-100 rounded-0 text-uppercase py-3"> PROCEED TO CHECKOUT </a> --}}
                        </div>
                        <!-- checkout button -->
                    @else
                        <p class="text-center text-danger">{{ __('Cart empty') }}</p>
                    @endif
