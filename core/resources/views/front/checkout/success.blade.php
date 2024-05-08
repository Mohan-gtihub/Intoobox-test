@extends('master.front')

@section('title')
    {{__('Order Success')}}
@endsection

@section('content')
    <!-- Page Title-->
<div class="container pt-8 pt-lg-12 pt-xxl-60 pb-60 pb-lg-80 pb-xxl-100">
    <h2 class="mb-0 text-center fw-bold text-dark heading-h2">
      {{__('Success')}}
    </h2>
    <div class="d-flex align-items-center justify-content-center mt-4">
      <div>
        <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> Home </a>
      </div>
      <div class="text-gray-700 ms-2">-</div>
      <p class="text-gray-700 ms-2 mb-0">{{__('Success')}}</p>
    </div>
</div>
  <!-- Page Content-->

  <style>
          .thank_you {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.07);
            max-width: 100%;
          }
          .thanks__heading {
            font-size: 60px;
            color: #ff6363;
            line-height: 100%;
          }
          .thank__link {
            font-size: 30px;
            color: #171717;
          }
          .box__column {
            background-color: #e2e2e2;
          }
          @media (min-width: 992px) {
            .thank_you {
              max-width: 80%;
              margin-left: auto;
              margin-right: auto;
            }
            .thanks-heading {
              font-size: 86px;
              color: #ff6363;
              font-weight: 700;
              line-height: 100%;
            }
          }
        </style>

        <section class="py-5 py-lg-5 py-xl-5">
          <div class="thank_you">
            <div class="row g-0">
              <div class="col-lg-5 box__column">
                <div class="d-flex flex-column align-items-center justify-content-center py-12 py-md-60 py-lg-80">
                  <img src="{{ asset('assets/images/GiftBox.gif') }}" alt="A box thanking user for shopping" class="img-fluid" width="300">
                  <div class="mt-12 mt-lg-80">
                    <a href="{{route('front.catalog')}}"class="btn btn-danger rounded-pill text-uppercase fs-16 text-white px-6 py-3">
                      View our products again
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-7">
                <div class="py-6 px-6">
                  <div class="text-end">
                    <a href="{{route('front.index')}}" class="thank__link">
                      <i class="fas fa-times fs-16"></i>
                    </a>
                  </div>
                  <h2
                    class="mb-0 mt-8 thanks__heading text-uppercase text-center"
                  >
                    thank <br />
                    you !
                  </h2>
                  <p
                    class="text-center fs-16 mt-4 mb-0 text-muted text-uppercase"
                  >
                    For choosing <span class="fw-bold">In Too Box</span>
                  </p>
                  <div class="mt-12">
                    <p class="text-center fs-16 mb-6 text-muted">
                      Your order has been placed and
                      <br class="d-none d-lg-block" />
                      will be processed as soon as possible.
                    </p>
                    <p class="text-center fs-16 mb-6 text-muted">
                      Make sure you make note of your
                      <br class="d-none d-lg-block" />
                      order number, which is
                      <span class="fw-bolder"><b>{{$order->transaction_number}}</b></span>
                    </p>
                    <p class="text-center fs-16 text-muted">
                      You will be receiving an email shortly
                      <br class="d-none d-lg-block" />
                      with confimation of your order.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection