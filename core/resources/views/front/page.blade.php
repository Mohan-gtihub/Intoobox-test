@extends('master.front')

@section('title')
    {{__('Page')}}
@endsection

@section('content')
    <!-- Page Title-->
    <div class="container pt-8 pt-lg-12 pt-xxl-60 pb-60 pb-lg-10 pb-xxl-100">
        <h1 class="mb-0 text-center fw-bold text-dark heading-h2">
            {{$page->title}}
        </h1>
        <div class="d-flex align-items-center justify-content-center mt-4">
          <div>
            <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> Home </a>
          </div>
          <div class="text-gray-700 ms-2">-</div>
          <p class="text-gray-700 ms-2 mb-0">{{$page->title}}</p>
        </div>
    </div>
<!-- Page Content-->
<div class="pb-5 ">
    <div class="container ">
        <!-- Categories-->
        <div class="row">
            <style>
               .d-page-content ul li{list-style:disc !important;}
            </style>
            <div class="col-lg-12 mb-4 mt-4">
                <div class="card border-0">
                    <div class="card-body px-4 py-5">
                        <div class="d-page-content">
                            {!! $page->details !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>

@endsection
