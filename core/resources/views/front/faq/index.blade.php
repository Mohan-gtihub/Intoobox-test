@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
    {{__('FAQ')}}
@endsection

@section('content')
    <!-- Page Title-->
<div class="container pt-8 pt-lg-12 pt-xxl-60 pb-60 pb-lg-80 pb-xxl-100">
    <h1 class="mb-0 text-center fw-bold text-dark heading-h2">
        {{__('FAQs')}}
    </h1>
    <div class="d-flex align-items-center justify-content-center mt-4">
      <div>
        <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> Home </a>
      </div>
      <div class="text-gray-700 ms-2">-</div>
      <p class="text-gray-700 ms-2 mb-0">{{__('FAQs')}}</p>
    </div>
</div>
  <!-- Page Content-->
  <div class="container pt-3 pb-3">
    <div class="row pb-4">
        @foreach ($fcategories as $category)
            <div class="col-lg-4 col-md-6">
                <a href="{{route('front.faq.details',$category->slug)}}" class="card mb-4 faq-box">
                    <div class="card-body">
                        <h6 class="card-title">{{$category->name}}</h6>
                        <p class="card-text text-muted">{{$category->text}}</p>
                        <span class="text-sm text-danger link">{{ __('View Details') }} <i class="icon-chevron-right"></i></span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
  </div>
@endsection
