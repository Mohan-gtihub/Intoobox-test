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
    <div class="pt-12 pt-lg-8 pb-12 pb-lg-60">
      <h2 class="mb-0 text-center fw-bold text-dark heading-h2">Coupons</h2>
      <div class="d-flex align-items-center justify-content-center mt-4">
        <div>
          <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> Home </a>
        </div>
        <div class="text-gray-700 ms-2">-</div>
        <p class="text-gray-700 ms-2 mb-0">Coupons</p>
      </div>
    </div>
    <!-- Catalogues container -->
    <div class="row  mb-10">
      <div class="coupons-slider owl-carousel">
      @foreach ($coupons as $item)
        <div class="slider-item cursor-pointer">
          <img class="d-block lazy cursor-pointer no-download" data-coupon="{{ $item->code_name}}" src="{{ asset('assets/images/' . $item->banner) }}" alt="{{ $item->title}}" title="{{ $item->title}}">
        </div>
      @endforeach
        </div>
    </div>
</div>
@endsection