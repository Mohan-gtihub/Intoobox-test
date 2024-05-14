@php
    $cart = Session::has('cart') ? Session::get('cart') : [];
    $total = 0;
    $option_price = 0;
    $cartTotal = 0;
    
@endphp

 <!-- cart table -->
 <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="fw-bold fs-20 text-dark">Product</th>
          <th scope="col" class="fw-bold fs-20 text-dark">Price</th>
          <th scope="col" class="fw-bold fs-20 text-dark">Quantity</th>
          <th scope="col" class="fw-bold fs-20 text-dark">Total</th>
          <th scope="col" class="fw-bold fs-20 text-dark"></th>
        </tr>
      </thead>
      <tbody id="cart_view_load" data-target="{{ route('cart.get.load') }}">
        @foreach ($cart as $key => $item)
        @php
            
            $cartTotal += ($item['main_price'] + $total + $item['attribute_price']) * $item['qty'];
        @endphp
        <tr>
          <td>
            <div class="d-flex align-items-center">
            <div class="cart-img-wrap">
              <a class="product-thumb" href="{{ route('front.product', $item['slug']) }}">
                <img src="{{ uploaded_asset(explode(",", $item['photo'])[0]) }}" class="cart-img" alt="Product"></a>
            </div>
            <div>
                <p class="mb-0 text-dark ms-3 fs-18">{{ Str::limit($item['name'], 45) }}</p>
                @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                <p class="mb-0 text-dark ms-3 fs-14"><em>{{ $item['attribute']['names'][$optionkey] }}:</em>
                    {{ $option_name }}
                    ({{ PriceHelper::setCurrencyPrice($item['attribute']['option_price'][$optionkey]) }})</p>
            @endforeach
            </div>
        </div>
            
          </td>
          <td class="text-danger fs-18 align-middle">{{ PriceHelper::setCurrencyPrice($item['main_price']) }}</td>
          <td class="align-middle">
            @if ($item['item_type'] == 'normal')
            <div class="qtySelector product-quantity counter-container d-flex align-items-center bg-gray-100 px-5 py-3 w-fit">
              <button class="decreaseQtycart cartsubclick counter-button border-0 bg-transparent decrement" data-id="{{ $key }}"
              data-target="{{ PriceHelper::GetItemId($key) }}">
                <i class="fas fa-minus fs-18 text-gray-700"></i>
              </button>
              <input type="number" class="qtyValue cartcart-amount border-0 ms-4 bg-transparent" value="{{ $item['qty'] }}" disabled />
              <button class="increaseQtycart cartaddclick counter-button border-0 bg-transparent increment ms-4" data-id="{{ $key }}"
              data-target="{{ PriceHelper::GetItemId($key) }}"
              data-item="{{ implode(',', $item['options_id']) }}">
                <i class="fas fa-plus fs-18 text-gray-700"></i>
              </button>
              <input type="hidden" value="3333" id="current_stock">
            </div>
            @endif
          </td>
          <td class="text-danger fs-18 align-middle">{{ PriceHelper::setCurrencyPrice($item['main_price'] * $item['qty']) }}</td>
          <td class="text-danger fs-18 align-middle">
            <a class="remove-from-cart" href="{{ route('front.cart.destroy', $key) }}" data-toggle="tooltip" title="Remove item"><i class="fas fa-times text-danger fs-18"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- cart table -->

  <!-- cart action buttons -->
  <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-between mt-6">
    <div>
      <a href="{{ route('front.catalog') }}" class="text-uppercase w-100 w-lg-auto px-6 py-3 btn btn-danger text-white rounded-0"> Continue ShopPing</a>
    </div>
    <div class="mt-4 mt-lg-0">
      <a href="{{ route('front.cart.clear') }}" class="text-uppercase w-100 w-lg-auto px-6 py-3 btn btn-danger text-white rounded-0">Clear Cart</a>
    </div>
  </div>
  <!-- cart action buttons -->

  <!-- cart summary  -->
  <div class="row justify-content-lg-between mt-8">
    <div class="col-lg-6">
      <h5 class="fs-20 fw-bold text-dark mb-0">Discount Codes</h5>
      <form method="post" id="coupon_form" action="{{ route('front.promo.submit') }}" class="mt-6">
        @csrf
        <div class="row align-items-center">
          <div class="col-md-8">
            <input name="code" class="form-control border rounded-0 border-2" id="exampleFormControlTextarea1" placeholder="Enter your coupon code" />
          </div>
          <div class="col-md-4 mt-2 mt-lg-0">
            <button type="submit" class="btn btn-secondary btn-block w-100 w-lg-auto rounded-0 border-1 border-secondary pt-3 pb-2 text-white text-uppercase">
              APPLY COUPON
            </button>
          </div>
        </div>
      </form>
      <div class="text-right text-lg column {{ Session::has('coupon') ? '' : 'd-none' }}"><span
        class="text-muted">{{ __('Discount') }}
        ({{ Session::has('coupon') ? Session::get('coupon')['code']['title'] : '' }}) : </span><span
        class="text-gray-dark">{{ PriceHelper::setCurrencyPrice(Session::has('coupon') ? Session::get('coupon')['discount'] : 0) }}</span>
        <a class="remove-from-cart btn btn-danger btn-sm text-white p-1"
                        href="{{ route('front.promo.destroy') }}" data-toggle="tooltip"
                        title="Remove item"><i class="fas fa-times"></i></a>
</div>
    </div>
    <div class="col-lg-4">
      <div class="mt-4 mt-lg-0 p-7 border border-2 w-100 w-lg-auto">
        <h6 class="fd-20 fw-bold">Cart Total</h6>
        <div class="d-flex align-items-center justify-content-between py-3 border-1 border-bottom">
          <p class="text-dark mb-0">Subtotal</p>
          <p class="text-danger mb-0">{{ PriceHelper::setCurrencyPrice($cartTotal - (Session::has('coupon') ? Session::get('coupon')['discount'] : 0)) }}</p>
        </div>
        <div class="d-flex align-items-center justify-content-between py-3 border-1">
          <p class="text-dark mb-0">Total</p>
          <p class="text-danger mb-0 ms-lg-120 ms-12">{{ PriceHelper::setCurrencyPrice($cartTotal - (Session::has('coupon') ? Session::get('coupon')['discount'] : 0)) }}</p>
        </div>
        <div class="mt-6">
          <a href="{{ route('front.checkout.billing') }}" class="btn btn-danger text-white btn-block w-100 rounded-0 text-uppercase">
            PROCEED TO CHECKOUT
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- cart cart summar -->