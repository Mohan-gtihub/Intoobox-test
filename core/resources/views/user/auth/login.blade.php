@extends('master.front')
@section('title')
    {{__('Account')}}
@endsection
@section('content')

  <section class="cart-section">
    <div class="container">
      <!-- checkout header/breadcrumb -->
      <div class="container pt-8 pb-12 pb-lg-60">
        <h2 class="mb-0 text-center fw-bold text-dark heading-h2"> Account </h2>
        <div class="d-flex align-items-center justify-content-center mt-4">
          <div>
            <a href="#" class="fs-16 fw text-dark"> Home </a>
          </div>
          <div class="text-gray-700 ms-2">-</div>
          <p class="text-gray-700 ms-2 mb-0">Account</p>
        </div>
      </div>
      <!-- checkout header/breadcrumb -->
      <!-- login register tab -->
      <div class="container mb-60 mb-md-80 mb-lg-120">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="false">Login</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="true">Register</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
            <div class="row justify-content-center">
              <div class="col-md-8 col-lg-8">
                <form action="{{route('user.register.submit')}}" method="POST" class="">
                  @csrf
                  <div class="row">
                    <div class="col-md-6 mb-6">
                      <label for="fname" class="form-label text-dark fs-16 mb-4"> Fist Name* </label>
                      <input class="form-control border rounded-0 border-1" type="text" name="first_name" placeholder="{{__('First Name')}}" id="reg-fn" value="{{old('first_name')}}">
                      @error('first_name')
                      <p class="text-danger">{{$message}}</p>
                      @endif
                    </div>
                    <div class="col-md-6 mb-6">
                      <label for="lname" class="form-label text-dark fs-16 mb-4"> Last Name* </label>
                      <input class="form-control border rounded-0 border-1" type="text"  name="last_name" placeholder="{{__('Last Name')}}" id="reg-ln" value="{{old('last_name')}}">
                      @error('last_name')
                      <p class="text-danger">{{$message}}</p>
                      @endif
                    </div>
                    <div class="col-md-6 mb-6">
                      <label for="email" class="form-label text-dark fs-16 mb-4"> Email* </label>
                      <input class="form-control border rounded-0 border-1" type="email" name="email" placeholder="{{__('E-mail Address')}}" id="reg-email" value="{{old('email')}}">
                      @error('email')
                      <p class="text-danger">{{$message}}</p>
                      @endif
                    </div>
                    <div class="col-md-6 mb-6">
                      <label for="phone" class="form-label text-dark fs-16 mb-4"> Phone* </label>
                      <input class="form-control border rounded-0 border-1" name="phone" type="tel" placeholder="{{__('Phone Number')}}" id="reg-phone" value="{{old('phone')}}">
                      @error('phone')
                      <p class="text-danger">{{$message}}</p>
                      @endif
                    </div>
                    <div class="col-md-6 mb-6">
                      <label for="password" class="form-label text-dark fs-16 mb-4"> {{__('Password')}}* </label>
                      <input class="form-control border rounded-0 border-1" type="password" id="reg-pass" name="password" placeholder="">
                      @error('password')
                      <p class="text-danger">{{$message}}</p>
                      @endif
                    </div>
                    <div class="col-md-6 mb-8">
                      <label for="pssword" class="form-label text-dark fs-16 mb-4"> {{__('Confirm Password')}}* </label>
                      <input class="form-control border rounded-0 border-1" type="password" id="reg-pass-confirm" name="password_confirmation" placeholder="" />
                    </div>
                    @if ($setting->recaptcha == 1)
              <div class="col-lg-12 mb-4">
                  {!! NoCaptcha::renderJs() !!}
                  {!! NoCaptcha::display() !!}
                  @if ($errors->has('g-recaptcha-response'))
                  @php
                      $errmsg = $errors->first('g-recaptcha-response');
                  @endphp
                  <p class="text-danger mb-0">{{__("$errmsg")}}</p>
                  @endif
              </div>
              @endif
                    <div class="col-md-12">
                      <button class="btn btn-danger text-white btn-block w-100 py-3 shadow-0 outline-0 rounded-0 text-uppercase"> {{__('Register')}} </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="tab-pane fade active show" id="login" role="tabpanel" aria-labelledby="login-tab">
            <div class="row justify-content-center">
              <div class="col-md-8 col-lg-5">
                <form method="post" action="{{route('user.login.submit')}}" class="">
                  @csrf
                  <div class="row">
                    <div class="col-md-12 mb-6">
                      <label for="fname" class="form-label text-dark fs-16 mb-4"> Username or email address* </label>
                      <input class="form-control border rounded-0 border-1" type="email" id="email"name="login_email" placeholder="{{ __('Email') }}" value="{{old('login_email')}}">
                      @error('login_email')
                        <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <label for="lname" class="form-label text-dark fs-16 mb-4"> Password* </label>
                      <input class="form-control border rounded-0 border-1" type="password" id="password" name="login_password" placeholder="{{ __('Password') }}">
                      @error('login_password')
                        <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="mt-4 d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" />
                      <label class="form-check-label text-muted" for="flexCheckChecked"> Remember me </label>
                    </div>
                    <a href="{{route('user.forgot')}}" class="mb-0 text-muted">Fogot your Password?</a>
                  </div>
                  <div class="mt-9">
                    <button class="btn btn-danger text-white btn-block w-100 py-3 shadow-0 outline-0 rounded-0 text-uppercase"> sign in </button>
                  </div>
                </form>
                <div class="row mt-8">
                  <div class="col-md-6">
                    <a href="{{route('social.provider','google')}}" class="bg-danger shadow-sm text-white d-flex align-items-center justify-content-center p-4">
                      <i class="fab fa-google me-3"></i> Google </a>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('social.provider','facebook')}}" class="bg-primary shadow-sm text-white d-flex align-items-center justify-content-center p-4">
                      <i class="fab fa-facebook me-3"></i> Facebook </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- login register tab -->
    </div>
  </section>
  <section class="delivery-section bg-gray-100 py-10 py-lg-13">
    <div class="container">
      <div class="w-100 w-lg-90 mx-auto">
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="d-flex align-items-center">
              <div>
                <img src="{{asset('assets/frontend/images/hand.png')}}" alt="hand icons" class="img-fluid" />
              </div>
              <div class="ms-5">
                <h5 class="text-dark heading-h6 fw-bold mb-1"> Free Delivery </h5>
                <p class="text-gray-700 text-base fs-16 mb-0"> For all order over ₹ 2000.00 </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="d-flex align-items-center">
              <div>
                <img src="{{asset('assets/frontend/images/return.png')}}" alt="hand icons" class="img-fluid" />
              </div>
              <div class="ms-5">
                <h5 class="text-dark heading-h6 fw-bold mb-1"> 30 Days Return </h5>
                <p class="text-gray-700 text-base fs-16 mb-0"> If goods have Problems </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="d-flex align-items-center">
              <div>
                <img src="{{asset('assets/frontend/images/payment.png')}}" alt="hand icons" class="img-fluid" />
              </div>
              <div class="ms-5">
                <h5 class="text-dark heading-h6 fw-bold mb-1"> Secure Payment </h5>
                <p class="text-gray-700 text-base fs-16 mb-0"> 100% secure payment </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="d-flex align-items-center">
              <div>
                <img src="{{asset('assets/frontend/images/support.png')}}" alt="hand icons" class="img-fluid" />
              </div>
              <div class="ms-5">
                <h5 class="text-dark heading-h6 fw-bold mb-1"> 24/7 Support </h5>
                <p class="text-gray-700 text-base fs-16 mb-0"> Dedicated support </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
