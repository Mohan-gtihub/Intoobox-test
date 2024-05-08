<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontsawesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/omni.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/aos.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/jquery.countdown.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/swiper.min.css')}}" />
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favicon.ico')}}" type="image/x-icon" />
    <title>{{ __('Password Reset') }}</title>
    <meta name="description" content="" />
</head>

<body>
    <!-- main-content -->
    <main class="main-content forgot-password-wrapper">
        <!-- logo -->
        <div class="container">
            <div class="d-flex align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('assets/frontend/images/logo-main.png') }}" alt="Logo"
                        class="img-fluid logo" />

                </div>
            </div>
        </div>
        <!-- logo -->

        <!-- password section starts here -->
        <section class="password-section pt-12">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-7 col-4xl-6">
                        <form method="POST" action="{{ route('user.forgot.submit') }}" class="">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="heading-h4 fw-bold text-dark mb-0 pb-2 text-center border-bottom"> Forgot
                                        PassWord</h5>
                                </div>
                                <div class="col-md-12 mt-8 mt-lg-12">
                                    <label for="fname" class="form-label text-dark fs-16 mb-4">Email:*</label>
                                    <input class="form-control border bg-gray-100 rounded-0 border-1" type="email"
                                        id="email" name="email" placeholder="info@intoobox.com" />
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button
                                        class="btn btn-danger text-white btn-block w-100 py-3 shadow-0 outline-0 rounded-0 text-uppercase">reset
                                        my password</button>
                                </div>
                            </div>
                        </form>
                        <div class="mt-2">
                            <a href="{{ route('user.login') }}"
                                class="text-secondary text-uppercase text-decoration-underline">
                                {{__('Login')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- password section starts here -->
    </main>
    <!-- main-content -->

    <!-- js files -->
    <script src="{{ asset('assets/frontend/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('assets/frontend/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/aos.js')}}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/jquery.plugin.min.js')}}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{ asset('assets/frontend/js/plugins/swiper-bundle.min.js')}}"></script>
    <script src="{{ asset('assets/frontend/js/app.js')}}"></script>
</body>

</html>
