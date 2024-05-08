@extends('master.front')

@section('meta')
    <meta name="keywords" content="{{$setting->meta_keywords}}">
    <meta name="description" content="{{$setting->meta_description}}">
@endsection

@section('title')
    {{__('Catalogues')}}
@endsection

@section('content')
<div class="container">
    <!-- Catalogues header/breadcrumb -->
    <div class="pt-12 pt-lg-8 pb-12 pb-lg-80">
        <h2 class="mb-0 text-center fw-bold text-dark heading-h2">
            Catalogues
        </h2>
        <div class="d-flex align-items-center justify-content-center mt-4">
            <div>
                <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> Home </a>
            </div>
            <div class="text-gray-700 ms-2">-</div>
            <p class="text-gray-700 ms-2 mb-0">{{$catalogue->name}}</p>
        </div>
    </div>
    <!-- Catalogues header/breadcrumb -->

    <!-- Catalogues container -->
    <div class="row">
        <div class="col-md-12 text-center">
            <iframe src="https://docs.google.com/viewer?url={{asset('assets/pdf/'.$catalogue->pdf)}}&embedded=true" frameborder="0" height="500px" width="100%"></iframe>
        </div>
        <div class="col-md-12 my-6 text-center"><a class="btn btn-danger text-white rounded-0 px-3" href="{{asset('assets/pdf/'.$catalogue->pdf)}}">Download <i class="fa fa-download"></i></a></div>
    </div>
</div>
@endsection

@section('script')

@endsection
