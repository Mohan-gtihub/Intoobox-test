@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $category->meta_keywords }}">
    <meta name="description" content="{{ $category->meta_descriptions }}">
@endsection
@section('title')
    {{ __('FAQ') }}
@endsection

@section('content')
    <!-- Page Title-->
    <div class="container pt-8 pt-lg-12 pt-xxl-60 pb-60 pb-lg-80 pb-xxl-100">
        <h2 class="mb-0 text-center fw-bold text-dark heading-h2">
            {{ $category->name }}
        </h2>
        <div class="d-flex align-items-center justify-content-center mt-4">
            <div>
                <a href="{{ route('front.index') }}" class="fs-16 fw text-dark"> Home </a>
            </div>
            <div class="text-gray-700 mx-2">-</div>
            <div>
                <a href="{{ route('front.faq') }}" class="fs-16 fw text-dark"> {{ __('FAQs') }} </a>
            </div>
            <div class="text-gray-700 ms-2">-</div>
            <p class="text-gray-700 ms-2 mb-0">{{ $category->name }}</p>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-1x mb-3">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($category->faqs as $key => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{ $key }}">
                        <button class="accordion-button collapsed fw-bold fs-18" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ $key }}" aria-expanded="false"
                            aria-controls="flush-collapse{{ $key }}">
                            <div class="faq-question">{{ $faq->title }}</div>
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $key }}" class="accordion-collapse collapse"
                        aria-labelledby="flush-heading{{ $key }}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body pb-5 pt-3">
                            {{ $faq->details }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
