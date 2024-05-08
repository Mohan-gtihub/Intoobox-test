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
        <p class="text-gray-700 ms-2 mb-0">Catalogues</p>
      </div>
    </div>
    <!-- Catalogues header/breadcrumb -->

    <!-- Catalogues container -->
    <div class="row">
      @foreach($catalogues as $catalogue)
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ asset('assets/images/' . $catalogue->photo) }}" class="card-img-top no-download" alt="Image Alt Text">
                <div class="card-body text-center">
                    <h5 class="card-title">{{$catalogue->name}}</h5>
                    <a target="_blank" href="{{asset('assets/pdf/'.$catalogue->pdf)}}" class="text-danger">View catalogue</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection