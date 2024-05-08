@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
    {{__('Products')}}
@endsection

@section('content')
@php
if(request('category')){
$title=request('category');
}elseif(request('subcategory')){
  $title=request('subcategory');
}elseif(request('childcategory')){
  $title=request('childcategory');
}elseif(request('search')){
  $title=request('search');
}else{
  $title='Shop';
}
@endphp
       <!-- Product header -->
   <div class="container pt-8 pt-lg-12 pt-xxl-60 pb-60 pb-lg-80 pb-xxl-100">
    <h2 class="mb-0 text-center fw-bold text-dark heading-h2">
      {{ ucfirst(str_replace('-', ' ', $title))}}
    </h2>
    <div class="d-flex align-items-center justify-content-center mt-4">
      <div>
        <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> Home </a>
      </div>
      <div class="text-gray-700 ms-2">-</div>
      <p class="text-gray-700 ms-2 mb-0">{{ ucfirst(str_replace('-', ' ', $title))}}</p>
    </div>
  </div>
  <!-- Product header -->

  <!-- filter  section starts here -->
  <section class="filter-section bg-gray-100 py-4">
    <div class="container">
      <div class="row">
        <div
          class="filter col-12 col-lg-3 py-2 d-inline-flex align-items-center justify-content-center justify-content-lg-start"
        >
          <span class="text-dark"> Filter </span>
          <span class="ms-6 text-dark">
            <i class="fas fa-chevron-down fs-12"></i>
          </span>
          <nav class="filter-nav">
            <ul class="filter filter-nav-list bg-white ps-0 mb-0 shadow-sm border-top border-2 border-danger" id="quick_filter">
                <li><a data-href=""><i class="fas text-dark fa-chevron-right me-1"></i>{{__('All products')}} </a></li>
                <li class="filter-nav-item px-4 py-1"><a href="javascript:;" data-href="feature"><i class="fas text-dark fa-chevron-right me-1"></i>{{__('Featured products')}} </a></li>
                <li class="filter-nav-item px-4 py-1"><a href="javascript:;" data-href="best"><i class="fas text-dark fa-chevron-right me-1"></i>{{__('Best sellers')}} </a></li>
                <li class="filter-nav-item px-4 py-1"><a href="javascript:;" data-href="top"><i class="fas text-dark fa-chevron-right me-1"></i>{{__('Top rated')}} </a></li>
                <li class="filter-nav-item px-4 py-1"><a href="javascript:;" data-href="new"><i class="fas text-dark fa-chevron-right me-1"></i>{{__('New Arrival')}} </a></li>
            </ul>
          </nav>
        </div>
        <div
          class="paginate col-12 col-lg-6 d-flex flex-column flex-lg-row align-items-center justify-content-center mt-4 mt-lg-0"
        >
          <p class="mb-0 dark fs-16">{{__('Showing')}}:</span><span>1 - {{$setting->view_product}} of {{ $items->total() }} {{__('results')}}</p>
          <div class="ms-0 ms-lg-12 mt-4 mt-lg-0 d-flex align-items-center">
            <p class="text-dark mb-0 fs-16">View:</p>
            <p class="mb-0 dispaly-product active fs-16 ms-4">12</p>
            <p class="mb-0 dispaly-product fs-16 ms-4">24</p>
            <p class="mb-0 dispaly-product fs-16 ms-4">All</p>
          </div>
        </div>
        <div
          class="sort col-12 col-lg-3 d-flex flex-column flex-md-row align-items-center mt-4 mt-lg-0 justify-content-center justify-content-lg-start"
        >
          <select class="form-select w-fit w-lg-min px-3 py-2 text-dark border-0 bg-transparent shadow-none"
          aria-label="Default select example"" id="sorting">
            <option class="text-dark" value="">{{__('All Products')}}</option>
            <option class="text-dark" value="low_to_high" {{request()->input('low_to_high') ? 'selected' : ''}}>{{__('Low - High Price')}}</option>
            <option class="text-dark" value="high_to_low" {{request()->input('high_to_low') ? 'selected' : ''}}>{{__('High - Low Price')}}</option>
            </select>
            <div class="d-flex ms-2 mt-2 mt-lg-0 shop-view">
                <a class="list-view {{Session::has('view_catalog') && Session::get('view_catalog') == 'grid' ? 'active' : ''}} " data-step="grid" href="javascript:;" data-href="{{route('front.catalog').'?view_check=grid'}}">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect class="" width="10.6667" height="10.6667" rx="1.33333"  />
                        <rect class="g" x="12.667" width="10.6667" height="10.6667" rx="1.33333"  />
                        <rect class="g" y="12.6667" width="10.6667" height="10.6667" rx="1.33333"  />
                        <rect class="g" x="12.667" y="12.6667" width="10.6667" height="10.6667" rx="1.33333"  />
                    </svg>
                </a>
                <a class="list-view {{Session::has('view_catalog') && Session::get('view_catalog') == 'list' ? 'active' : ''}}" href="javascript:;" data-step="list" data-href="{{route('front.catalog').'?view_check=list'}}"><i class="fa-solid fa-list fs-24 mt-2"></i></a>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!--  filter  section ends here -->

  <!-- Products section starts here -->
  <section class="products-section my-8 my-lg-12">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-3">
          <aside class="sidebar sidebar-offcanvas position-left">
            <span class="sidebar-close"><i class="icon-x"></i></span>
            <!-- Widget Categories-->
            <section class="widget widget-categories card rounded p-4">
              <h3 class="widget-title">Shop Categories</h3>
              <ul id="category_list" class="category-scroll">
                @foreach ($categories as $getcategory)
                <li class="has-children  {{isset($category) && $category->id == $getcategory->id ? 'expanded active' : ''}} ">
                  <a class="category_search" href="javascript:;"  data-href="{{$getcategory->slug}}">{{$getcategory->name}}</a>

                    <ul id="subcategory_list">
                        @foreach ($getcategory->subcategory as $getsubcategory)
                        <li class="{{isset($subcategory) && $subcategory->id == $getsubcategory->id ? 'active' : ''}}">
                          <a class="subcategory" href="javascript:;" data-href="{{$getsubcategory->slug}}">{{$getsubcategory->name}}</a>

                          <ul id="childcategory_list">
                            @foreach ($getsubcategory->childcategory as $getchildcategory)
                            <li class="{{isset($childcategory) && $getchildcategory->id == $getchildcategory->id ? 'active' : ''}}">
                              <a class="childcategory" href="javascript:;" data-href="{{$getchildcategory->slug}}">{{$getchildcategory->name}}</a>

                            </li>
                            @endforeach
                        </ul>
                        </li>
                        @endforeach
                    </ul>
                  </li>
                @endforeach
            </ul>
            </section>

            <!-- Widget Price Range-->
            <section class="widget widget-categories card rounded p-4">
              <h3 class="widget-title">Filter by Price</h3>
              <form class="price-range-slider" method="post" data-start-min="{{request()->input('minPrice') ? request()->input('minPrice') : '0'}}" data-start-max="{{request()->input('maxPrice') ? request()->input('maxPrice') : $setting->max_price}}" data-min="0" data-max="{{$setting->max_price}}" data-step="5">
                <div class="ui-range-slider"></div>
                <footer class="ui-range-slider-footer">
                  <div class="column">
                    <button class="btn btn-danger btn-sm" id="price_filter" type="button"><span class="text-white">{{__('Filter')}}</span></button>
                  </div>
                  <div class="column">
                    <div class="ui-range-values">
                      <div class="ui-range-value-min">{{PriceHelper::setCurrencySign()}}<span class="min_price"></span>
                        <input type="hidden">
                      </div>-
                      <div class="ui-range-value-max">{{PriceHelper::setCurrencySign()}}<span class="max_price"></span>
                        <input type="hidden">
                      </div>
                    </div>
                  </div>
                </footer>
              </form>
            </section>

            @if ($setting->is_attribute_search == 1)
              @foreach ($attrubutes as $attrubute)
              
              <section class="widget widget-categories card rounded p-4">
                <h3 class="widget-title">{{ __('Filter by') }} {{$attrubute->name}}</h3>
                @foreach ($options as $option)
                @if ($attrubute->keyword == $option->attribute->keyword)
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input option" {{isset($subcategory) && $subcategory->id == $option->id ? 'checked' : ''}}   type="checkbox" value="{{$option->name}}" id="{{$attrubute->id}}{{$option->name}}">
                  <label class="custom-control-label" for="{{$attrubute->id}}{{$option->name}}">{{$option->name}}<span class="text-muted"></span></label>
              </div>  
                @endif
                @endforeach
              </section>
              @endforeach
              @endif
          </aside>
        </div>
        <div class="col-lg-9">
          <!-- Products -->
          <div class="row g-4">
            <div class="col-12 mt-8 mt-lg-12" id="list_view_ajax">
                @include('front.catalog.catalog')
            </div>
            <!-- pagination -->
            

            <!-- pagination -->
          </div>
          <!-- Products -->
        </div>
      </div>
    </div>
  </section>
  <!-- Products section ends here -->


      <form id="search_form" class="d-none" action="{{route('front.catalog')}}" method="GET">

        <input type="text" name="maxPrice" id="maxPrice" value="{{request()->input('maxPrice') ? request()->input('maxPrice') : ''}}">
        <input type="text" name="minPrice" id="minPrice" value="{{request()->input('minPrice') ? request()->input('minPrice') : ''}}">
        <input type="text" name="brand" id="brand" value="{{isset($brand) ? $brand->slug : ''}}">
        <input type="text" name="brand" id="brand" value="{{isset($brand) ? $brand->slug : ''}}">
        <input type="text" name="category" id="category" value="{{isset($category) ? $category->slug : ''}}">
        <input type="text" name="quick_filter" id="quick_filter" value="">
        <input type="text" name="childcategory" id="childcategory" value="{{isset($childcategory) ? $childcategory->slug : ''}}">
        <input type="text" name="page" id="page" value="{{isset($page) ? $page : ''}}">
        <input type="text" name="attribute" id="attribute" value="{{isset($attribute) ? $attribute : ''}}">
        <input type="text" name="option" id="option" value="{{isset($option) ? $option : ''}}">
        <input type="text" name="subcategory" id="subcategory" value="{{isset($subcategory) ? $subcategory->slug : ''}}">
        <input type="text" name="sorting" id="sorting" value="{{isset($sorting) ? $sorting : ''}}">
        <input type="text" name="view_check" id="view_check" value="{{isset($view_check) ? $view_check : ''}}">


        <button type="submit" id="search_button" class="d-none"></button>
    </form>
@endsection

