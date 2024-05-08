@extends('master.front')
@section('title')
    {{__('Dashboard')}}
@endsection
@section('content')

<!-- Page Title-->
<section class="cart-section mt-8 mt-lg-12 mb-60 mb-md-80 mb-lg-140">
        <div class="container">
          <!-- Wish List header/breadcrumb -->
          <div class="container pb-60 pb-lg-100">
            <h2 class="mb-0 text-center fw-bold text-dark heading-h2">{{__('Welcome Back')}}</h2>
            <div class="d-flex align-items-center justify-content-center mt-4">
              <div>
                <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> Home </a>
              </div>
              <div class="text-gray-700 ms-2">-</div>
              <p class="text-gray-700 ms-2 mb-0">{{__('Welcome Back')}}</p>
            </div>
          </div>
          <!-- cart header -->
          <div class="row">
            <div class="col-lg-12">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <div class="row u-d-d">
                    <div class="col-md-4 mb-4">
                        <div class="card round">
                            <div class="card-body text-center">
                                <i class="fa fa-bag-shopping"></i>
                                <p class="mt-3">{{__('All Order')}}</p>
                                <h4><b>{{$allorders}}</b></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card round">
                            <div class="card-body text-center">
                                <i class="fa fa-bag-shopping"></i>
                                <p class="mt-3">{{__('Completed Order')}}</p>
                                <h4><b>{{$delivered}}</b></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card round">
                            <div class="card-body text-center">
                                <i class="fa fa-bag-shopping"></i>
                                <p class="mt-3">{{__('Processing Order')}}</p>
                                <h4><b>{{$progress}}</b></h4>
                            </div>
                        </div>
                    </div>
        
        
                    <div class="col-md-4 mb-4">
                        <div class="card round">
                            <div class="card-body text-center">
                                <i class="fa fa-bag-shopping"></i>
                                <p class="mt-3">{{__('Canceled Order')}}</p>
                                <h4><b>{{$canceled}}</b></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card round">
                            <div class="card-body text-center">
                                <i class="fa fa-bag-shopping"></i>
                                <p class="mt-3">{{__('Pending Order')}}</p>
                                <h4><b>{{$pending}}</b></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </section>

@endsection
