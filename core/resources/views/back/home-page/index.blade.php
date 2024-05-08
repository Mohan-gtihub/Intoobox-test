@extends('master.back')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/back/css/select2.css') }}">
@endsection
@section('content')
    <!-- Start of Main Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h3 class="mb-0 bc-title"><b>{{ __('Language') }}</b></h3>
                </div>
            </div>
        </div>

        {{-- Create Table Btn --}}

        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-md-3">
                        <div class="nav flex-column nav-pills nav-secondary" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link" id="v-pills-t8-tab" data-toggle="pill" href="#v-pills-t8" role="tab"
                                aria-controls="v-pills-t8"
                                aria-selected="false">{{ __('Popular Categories') }}</a> 
                            <a class="nav-link active" id="v-pills-t9-tab" data-toggle="pill" href="#v-pills-t9"
                                role="tab" aria-controls="v-pills-t9"
                                aria-selected="true">{{ __('Shop By Categories Banner') }}</a>
                            
                            <a class="nav-link" id="v-pills-t10-tab" data-toggle="pill" href="#v-pills-t10" role="tab"
                                aria-controls="v-pills-t10"
                                aria-selected="false">{{ __('Home Page 8 Super Items') }}</a>
                                <a class="nav-link" id="v-pills-t4-tab" data-toggle="pill" href="#v-pills-t4" role="tab"
                                aria-controls="v-pills-t4" aria-selected="false">{{ __('Featured Categories') }}</a>
                        </div>
                    </div>
                    <div class="col-7 col-md-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-t9" role="tabpanel"
                                aria-labelledby="v-pills-t9-tab">
                                <form class="admin-form" action="{{ route('back.hero.banner.update') }}"method="POST"
                                    enctype="multipart/form-data">
                                    @include('alerts.alerts')
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">{{ __('Image 1') }} *</label>
                                        <br>
                                        <img class="admin-img"
                                            src="{{ isset($hero_banner['img1']) ? asset('assets/images/' . $hero_banner['img1']) : asset('assets/images/placeholder.png') }}"
                                            alt="No Image Found">
                                        <br>
                                        <span class="mt-1">{{ __('Image Size Should Be 868 x 1399.') }}</span>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo" name="img1"
                                                id="file" aria-label="File browser example">
                                            <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="v-pills-t8" role="tabpanel" aria-labelledby="v-pills-t8-tab">
                                <form class="admin-form" action="{{ route('back.home4.category.update') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @php
                                        if (isset($home_4_popular_category)) {
                                            $home_4_popular_category = $home_4_popular_category;
                                        } else {
                                            $home_4_popular_category = [];
                                        }
                                    @endphp
                                    <label for="basic">{{ __('Select Sub Category') }} </label>
                                    <select name="home_4_popular_category[]" id="basic" class="form-control"
                                        multiple data-href="{{ route('back.get.childcategory') }}">
                                        @foreach (DB::table('categories')->whereStatus(1)->get() as $category)
                                            <option value="{{ $category->id }}"
                                                {{ in_array($category->id, $home_4_popular_category) ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-t11" role="tabpanel" aria-labelledby="v-pills-t11-tab">
                                <form class="admin-form" action="{{ route('back.third.banner.update') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">{{ __('Banner Image') }} *</label>
                                        <br>
                                        <img class="admin-img" src="{{ asset('assets/images/' . $third_banner['img1']) }}"
                                            alt="No Image Found">
                                        <br>
                                        <span class="mt-1">{{ __('Image Size Should Be 870 x 1400.') }}</span>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo" name="img1"
                                                id="file" aria-label="File browser example">
                                            <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
                                    </div>
                                </form>
                            </div>

                                    <div class="tab-pane fade" id="v-pills-t10" role="tabpanel"
                                        aria-labelledby="v-pills-t10-tab">
                                        <form class="admin-form" action="{{ route('back.home8.itme.update') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            @php
                                                if (isset($home_8_popular_item)) {
                                                    $home_8_popular_item = $home_8_popular_item;
                                                } else {
                                                    $home_8_popular_item = [];
                                                }
                                            @endphp
                                            <label for="basic">{{ __('Select Items') }} </label>
                                            <select name="home_8_popular_item[]" id="basic2" class="form-control"
                                                multiple>
                                                @foreach (DB::table('items')->whereStatus(1)->get() as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ in_array($item->id, $home_8_popular_item) ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-secondary ">{{ __('Submit') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="v-pills-t4" role="tabpanel" aria-labelledby="v-pills-t4-tab">
                                <form class="admin-form" action="{{ route('back.feature.category.update') }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="feature_title">{{ __('Section Title') }} *</label>
                                        <input type="text" name="feature_title" class="form-control"
                                            id="feature_title" placeholder="{{ __('Feture Category') }}"
                                            value="{{ $feature_category['feature_title'] }}">
                                    </div>
                                    <hr>
                                    <h2 class=""><b>{{ __('Category 1 :') }}</b></h2>

                                    <div class="form-group">
                                        <label for="feature_category_id1">{{ __('Select Category') }} *</label>
                                        <select name="category_id1" id="feature_category_id1"
                                            data-href="{{ route('back.get.subcategory') }}" class="form-control">
                                            <option value="">{{ __('Select One') }}</option>
                                            @foreach (DB::table('categories')->whereStatus(1)->get() as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $feature_category['category_id1'] ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="feature_subcategory_id1">{{ __('Select Sub Category') }} </label>
                                        <select name="subcategory_id1" id="feature_subcategory_id1" class="form-control"
                                            data-href="{{ route('back.get.childcategory') }}">
                                            <option value="">{{ __('Select one') }}</option>
                                            @foreach (DB::table('subcategories')->where('category_id', $feature_category['category_id1'])->whereStatus(1)->get() as $subcat)
                                                <option value="{{ $subcat->id }}"
                                                    {{ $subcat->id == $feature_category['subcategory_id1'] ? 'selected' : '' }}>
                                                    {{ $subcat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="feature_childcategory_id1">{{ __('Select Child Category') }} </label>
                                        <select name="childcategory_id1" id="feature_childcategory_id1"
                                            class="form-control">
                                            <option value="">{{ __('Select one') }}</option>
                                            @foreach (DB::table('chield_categories')->where('category_id', $feature_category['category_id1'])->whereStatus(1)->get() as $chieldcategory)
                                                <option value="{{ $chieldcategory->id }}"
                                                    {{ $chieldcategory->id == $feature_category['childcategory_id1'] ? 'selected' : '' }}>
                                                    {{ $chieldcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>
                                    <h2 class=""><b>{{ __('Category 2 :') }}</b></h2>
                                    <div class="form-group">
                                        <label for="feature_category_id2">{{ __('Select Category') }} *</label>
                                        <select name="category_id2" id="feature_category_id2"
                                            data-href="{{ route('back.get.subcategory') }}" class="form-control">
                                            <option value="">{{ __('Select One') }}</option>
                                            @foreach (DB::table('categories')->whereStatus(1)->get() as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $feature_category['category_id2'] ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="feature_subcategory_id2">{{ __('Select Sub Category') }} </label>
                                        <select name="subcategory_id2" id="feature_subcategory_id2" class="form-control"
                                            data-href="{{ route('back.get.childcategory') }}">
                                            <option value="">{{ __('Select one') }}</option>
                                            @foreach (DB::table('subcategories')->where('category_id', $feature_category['category_id2'])->whereStatus(1)->get() as $subcat)
                                                <option value="{{ $subcat->id }}"
                                                    {{ $subcat->id == $feature_category['subcategory_id2'] ? 'selected' : '' }}>
                                                    {{ $subcat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="feature_childcategory_id2">{{ __('Select Child Category') }} </label>
                                        <select name="childcategory_id2" id="feature_childcategory_id2"
                                            class="form-control">
                                            <option value="">{{ __('Select one') }}</option>
                                            @foreach (DB::table('chield_categories')->where('category_id', $feature_category['category_id2'])->whereStatus(1)->get() as $chieldcategory)
                                                <option value="{{ $chieldcategory->id }}"
                                                    {{ $chieldcategory->id == $feature_category['childcategory_id2'] ? 'selected' : '' }}>
                                                    {{ $chieldcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                    <h2 class=""><b>{{ __('Category 3 :') }}</b></h2>
                                    <div class="form-group">
                                        <label for="feature_category_id3">{{ __('Select Category') }} *</label>
                                        <select name="category_id3" id="feature_category_id3"
                                            data-href="{{ route('back.get.subcategory') }}" class="form-control">
                                            <option value="">{{ __('Select One') }}</option>
                                            @foreach (DB::table('categories')->whereStatus(1)->get() as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $feature_category['category_id3'] ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="feature_subcategory_id3">{{ __('Select Sub Category') }} </label>
                                        <select name="subcategory_id3" id="feature_subcategory_id3" class="form-control"
                                            data-href="{{ route('back.get.childcategory') }}">
                                            <option value="">{{ __('Select one') }}</option>
                                            @foreach (DB::table('subcategories')->where('category_id', $feature_category['category_id3'])->whereStatus(1)->get() as $subcat)
                                                <option value="{{ $subcat->id }}"
                                                    {{ $subcat->id == $feature_category['subcategory_id3'] ? 'selected' : '' }}>
                                                    {{ $subcat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="feature_childcategory_id3">{{ __('Select Child Category') }} </label>
                                        <select name="childcategory_id3" id="feature_childcategory_id3"
                                            class="form-control">
                                            <option value="">{{ __('Select one') }}</option>
                                            @foreach (DB::table('chield_categories')->where('category_id', $feature_category['category_id3'])->whereStatus(1)->get() as $chieldcategory)
                                                <option value="{{ $chieldcategory->id }}"
                                                    {{ $chieldcategory->id == $feature_category['childcategory_id3'] ? 'selected' : '' }}>
                                                    {{ $chieldcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                    <h2 class=""><b>{{ __('Category 4 :') }}</b></h2>
                                    <div class="form-group">
                                        <label for="feature_category_id4">{{ __('Select Category') }} *</label>
                                        <select name="category_id4" id="feature_category_id4"
                                            data-href="{{ route('back.get.subcategory') }}" class="form-control">
                                            <option value="">{{ __('Select One') }}</option>
                                            @foreach (DB::table('categories')->whereStatus(1)->get() as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $feature_category['category_id4'] ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="feature_subcategory_id4">{{ __('Select Sub Category') }} </label>
                                        <select name="subcategory_id4" id="feature_subcategory_id4" class="form-control"
                                            data-href="{{ route('back.get.childcategory') }}">
                                            <option value="">{{ __('Select one') }}</option>
                                            @foreach (DB::table('subcategories')->where('category_id', $feature_category['category_id4'])->whereStatus(1)->get() as $subcat)
                                                <option value="{{ $subcat->id }}"
                                                    {{ $subcat->id == $feature_category['subcategory_id4'] ? 'selected' : '' }}>
                                                    {{ $subcat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="feature_childcategory_id4">{{ __('Select Child Category') }} </label>
                                        <select name="childcategory_id4" id="feature_childcategory_id4"
                                            class="form-control">
                                            <option value="">{{ __('Select one') }}</option>
                                            @foreach (DB::table('chield_categories')->where('category_id', $feature_category['category_id4'])->whereStatus(1)->get() as $chieldcategory)
                                                <option value="{{ $chieldcategory->id }}"
                                                    {{ $chieldcategory->id == $feature_category['childcategory_id4'] ? 'selected' : '' }}>
                                                    {{ $chieldcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
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
    <!-- End of Main Content -->
@endsection

@section('scripts')
    <script type="" src="{{asset('assets/back/js/select2.js')}}"></script>
    <script>
        $('#basic').select2({
            theme: "bootstrap"
        });
        $('#basic2').select2({
            theme: "bootstrap"
        });
    </script>
@endsection
