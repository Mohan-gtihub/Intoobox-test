
@extends('master.front')
@section('title')
    {{ __('Wishlist') }}
@endsection
@section('content')
    <!-- Page Title-->
    <section class="cart-section mt-8 mt-lg-12 mb-60 mb-md-80 mb-lg-140">
        <div class="container">
            <!-- Wish List header/breadcrumb -->
            <div class="container pb-60 pb-lg-100">
                <h2 class="mb-0 text-center fw-bold text-dark heading-h2">{{__('Wishlist')}}</h2>
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <div>
                        <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> {{__('Home')}} </a>
                    </div>
                    <div class="text-gray-700 ms-2">-</div>
                    <p class="text-gray-700 ms-2 mb-0">{{__('Wishlist')}}</p>
                </div>
            </div>
            <!-- Page Content-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr class="">
                                  <th scope="col" class="fw-bold fs-20 text-dark">Products</th>
                                  <th scope="col" class="fw-bold fs-20 text-dark">Price</th>
                                  <th scope="col" class="fw-bold fs-20 text-dark">
                                    Stock Status
                                  </th>
                                  <th scope="col" class="fw-bold fs-20 text-dark"></th>
                                  <th scope="col" class="fw-bold fs-20 text-dark"></th>
                                </tr>
                              </thead>
                              <tbody>
                                @if ($wishlist_items->count() > 0)
                                @foreach ($wishlist_items as $product)
                                <tr class="">
                                  <td class="d-flex align-items-center">
                                    <div class="cart-img-wrap">
                                      <img src="{{asset('assets/images/'.$product->photo)}}" alt="" width="85px" class="cart-img">
                                    </div>
                                    <p class="mb-0 text-dark ms-3 fs-18">{{$product->name}}</p>
                                  </td>
                                  <td class="text-danger fs-18 align-middle">{{PriceHelper::grandCurrencyPrice($product)}}</td>
                                  <td class="text-danger fs-18 align-middle">{{$product->stock == 0 ? __('Out of stock') : __('In Stock')}}</td>
                                  <td class="text-danger fs-18 align-middle">
                                    @if ($product->is_stock())
                                    @if ($product->item_type != 'affiliate')
                                    <button  class="product-button add_to_single_cart btn btn-danger text-white fw-semibold btn-block w-100 py-3 px-5 rounded-0 text-uppercase" data-target="{{$product->id}}">
                                      Add To Cart
                                    </button>
                                    @endif
                   
                                    @else
                                    <button disabled="" class="btn btn-secondary text-dark fw-semibold btn-block w-100 py-3 px-5 rounded-0 text-uppercase">
                                      Out Of Stock
                                    </button>
                                  @endif
                                  </td>
                                  <td class="text-danger fs-18 ps-6  align-middle">
                                    <a class="remove-from-cart" href="{{route('user.wishlist.delete',$product->getWishlistItemId())}}" data-toggle="tooltip" title="Remove item">
                                      <i class="fas fa-times text-danger fs-18"></i>
                                    </a>
                                  </td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="text-center">
                                  <td class="text-center" colspan="5">{{__('No Product Found')}}</td>
                                </tr>
                                @endif
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
