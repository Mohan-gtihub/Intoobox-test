@extends('master.front')
@section('title')
    {{__('Order Track')}}
@endsection

@section('content')
<div class="container">
    <!-- checkout header/breadcrumb -->
    <div class="pt-12 pt-lg-8 pb-12 pb-lg-60">
      <h2 class="mb-0 text-center fw-bold text-dark heading-h2">
        Order Tracking
      </h2>
      <div class="d-flex align-items-center justify-content-center mt-4">
        <div>
          <a href="{{url('/')}}" class="fs-16 fw text-dark"> Home </a>
        </div>
        <div class="text-gray-700 ms-2">-</div>
        <p class="text-gray-700 ms-2 mb-0">Shop</p>
      </div>
    </div>
    <!-- checking order header/breadcrumb -->

    <!-- checking order form -->
    <div class="row justify-content-center mb-12 mb-md-80 mb-lg-120">
      <div class="col-md-8 col-lg-6">
        <form action="#" class="">
          <div class="row">
            <div class="col-md-12">
              <p class="fs-16 text-muted mb-0">
                To track your order please enter your Order ID in the box
                below and press the "Track" button. This was given to you on
                your receipt and in the confirmation email you should have
                received.
              </p>
            </div>
            <div class="col-md-12 mt-8">
              <label for="fname" class="form-label text-dark fs-16 mb-5">
                Order number <span class="ms-2 text-danger">*</span>
              </label>
              <input class="form-control border rounded-0 border-1" type="text" id="order_number" name="order_number" placeholder="Found in your order confirmation email">
            </div>
            <div class="col-md-12 mt-8">
              <label for="fname" class="form-label text-dark fs-16 mb-5">
                Billing email <span class="ms-2 text-danger">*</span>
              </label>
              <input class="form-control border rounded-0 border-1" type="email" id="email" name="email" placeholder="Email you used for order">
            </div>
            <div class="col-md-6 mt-10">
              <button class="btn btn-danger text-white btn-block w-100 py-3 shadow-0 outline-0 rounded-0 text-uppercase" id="submit_number"  data-href="{{route('front.order.track.submit')}}" type="submit">
                Tracking Order
              </button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
    <div class="row py-4">
        <div class="col-lg-12">
            <div id="track-order">

            </div>
        </div>
    </div>
    <!-- checking order form -->
  </div>
@endsection

