@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection
@section('content')
    <div class="container my-60 my-md-80 my-lg-120 d-flex align-items-center justify-content-center">
        <img src="{{ asset('assets/frontend/images/404.png') }}" alt="" class="img-fluid" />
    </div>
@endsection
