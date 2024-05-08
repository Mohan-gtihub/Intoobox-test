@extends('master.back')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h3 class=" mb-0 bc-title"><b>{{ __('Create Slider') }}</b> </h3>
                    <a class="btn btn-primary btn-sm" href="{{ route('back.slider.index') }}"><i
                            class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body ">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-12">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                            role="tab" aria-controls="pills-profile"
                                            aria-selected="false">{{ __('Home 2') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">
                                        <form action="{{ route('back.slider.store') }}" method="POST"
                                            enctype="multipart/form-data">

                                            @csrf
                                            <input type="hidden" name="home_page" value="theme2" id="">
                                            @include('alerts.alerts')
                                            

                                            <div class="form-group">
                                                <label for="hash-title">{{ __('Hash Title') }} *</label>
                                                <input type="text" name="hash_title" class="form-control" id="hash-title"
                                                    placeholder="{{ __('New Arrivals') }}" value="{{ old('hash_title') }}">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="title">{{ __('Title') }} *</label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    placeholder="{{ __('Enter Title') }}" value="{{ old('title') }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="slider-link">{{ __('Link') }} *</label>
                                                <input type="text" name="link" class="form-control"
                                                    id="slider-link" placeholder="{{ __('Enter Link') }}"
                                                    value="{{ old('link') }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="details">{{ __('Details') }} *</label>
                                                <textarea name="details" id="details" class="form-control" rows="5"
                                                    placeholder="{{ __('Enter Details') }}"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label id="slider_text" for="name">{{ __('Set Slider Image') }}
                                                    *</label>
                                                <br>
                                                <img class="admin-img" src="{{ asset('assets/images/placeholder.png') }}"
                                                    alt="No Image Found">
                                                <br>
                                                <span id="chenge_label2"
                                                    class="mt-1">{{ __('Image Size Should Be 1296 x 530 ') }}</span>
                                            </div>

                                            <div class="form-group position-relative ">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo"
                                                        name="photo" id="file" aria-label="File browser example">
                                                    <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-secondary ">{{ __('Submit') }}</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endsection
