@extends('master.front')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <!-- Page Title-->
    <section class="cart-section mt-8 mt-lg-12 mb-60 mb-md-80 mb-lg-140">
        <div class="container">
            <!-- Wish List header/breadcrumb -->
            <div class="container pb-60 pb-lg-100">
                <h2 class="mb-0 text-center fw-bold text-dark heading-h2">{{ $user->first_name }}</h2>
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <div>
                        <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> {{__('Home')}} </a>
                    </div>
                    <div class="text-gray-700 ms-2">-</div>
                    <p class="text-gray-700 ms-2 mb-0">{{ __('Welcome Back') }}, {{ $user->first_name }}</p>
                </div>
            </div>
            <!-- Page Content-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                            <form class="row" action="{{ route('user.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="avater" class="form-label">Default file input example</label>
                                        <input class="form-control pt-3" type="file" name="photo" id="avater">
                                        @error('photo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-fn">{{ __('First Name') }}</label>
                                        <input class="form-control" name="first_name" type="text" id="account-fn"
                                            value="{{ $user->first_name }}">
                                        @error('first_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-ln">{{ __('Last Name') }}</label>
                                        <input class="form-control" type="text" name="last_name" id="account-ln"
                                            value="{{ $user->last_name }}">
                                        @error('last_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-email">{{ __('E-mail Address') }}</label>
                                        <input class="form-control" name="email" type="email" id="account-email"
                                            value="{{ $user->email }}">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-phone">{{ __('Phone Number') }}</label>
                                        <input class="form-control" name="phone" type="text" id="account-phone"
                                            value="{{ $user->phone }}">
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account-pass">{{ __('New Password') }}</label>
                                        <input class="form-control" name="password" type="text" id="account-pass"
                                            placeholder="{{ __('Change your password') }}">
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr class="mt-2 mb-3">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="custom-control custom-checkbox d-block">
                                            <input class="custom-control-input" name="newsletter" type="checkbox"
                                                id="subscribe_me" {{ $check_newsletter ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="subscribe_me">{{ __('Subscribe') }}</label>
                                        </div>
                                        <button class="btn btn-danger text-white margin-right-none"
                                            type="submit"><span>{{ __('Update Profile') }}</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
