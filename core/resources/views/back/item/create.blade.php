@extends('master.back')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h3 class="mb-0 bc-title"><b>{{ __('Create Product') }}</b> </h3>
                    <a class="btn btn-primary   btn-sm" href="{{ route('back.item.index') }}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
            </div>
        </div>

        <!-- Form -->


        <div class="row">
            <div class="col-lg-12">
                @include('alerts.alerts')
            </div>
        </div>
        <!-- Nested Row within Card Body -->
        <form class="admin-form tab-form" action="{{ route('back.item.store') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="normal" name="item_type">
            @csrf
            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }} *</label>
                                <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="slug">{{ __('Slug') }} *</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('Enter Slug') }}" value="{{ old('slug') }}">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group pb-0  mb-0">
                                <label class="d-block">{{ __('Featured Image') }} *</label>
                            </div>
                            <div class="form-group position-relative ">
                                <label class="text-sm"><small>{{ __('Image Size Should Be 800 x 800. or square size') }}</small></label>
                                <div class="input-group" data-toggle="aizuploader" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ trans('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount {{ $errors->has('photo') ? ' is-invalid' : '' }}">{{ trans('Choose File') }}</div>
                                    <input type="hidden" name="photo" value="{{ isset($company) ? $company->photo : old('photo') }}" class="selected-files" required>
                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="file-preview"></div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group pb-0  mb-0">
                                <label>{{ __('Gallery Images') }} </label>
                            </div>
                            <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                <div id="gallery-images" class="">
                                    <div class="d-block gallery_image_view">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-sm"><small>{{ __('Image Size Should Be 800 x 800. or square size') }}</small></label>
                                <div class="input-group" data-toggle="aizuploader" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ trans('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount {{ $errors->has('galleries') ? ' is-invalid' : '' }}">{{ trans('Choose File') }}</div>
                                    <input type="hidden" name="galleries" value="{{ isset($company) ? $company->logo : old('galleries') }}" class="selected-files" required>
                                    @if ($errors->has('galleries'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('galleries') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="file-preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="min-qty">{{ __('Minimum Qty') }}*</label>
                                        <div class="input-group mb-3">
                                            <input type="number" min="1" id="min-qty" name="min_qty" class="form-control" placeholder="{{ __('1') }}" value="{{ old('min_qty') }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="multiple">{{ __('Multiple') }}*</label>
                                        <div class="input-group mb-3">
                                            <input type="number" min="1" id="multiple" name="multiple" class="form-control" placeholder="{{ __('x1') }}" value="{{ old('multiple') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="switch-primary">
                                    <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_bulk_discount" value="1" checked>
                                    <span class="switch-body"></span>
                                    <span class="switch-text">{{ __('Bulk discount') }}</span>
                                </label>
                            </div>
                            <div id="discount-items-section">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="items[]" placeholder="{{ __('Number of itmes') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="price[]" placeholder="{{ __('Price') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-btn">
                                        <button type="button" class="btn btn-success add-discount-items" data-text="{{ __('Number of itmes') }}" data-text1="{{ __('100.0') }}"> <i
                                                class="fa fa-plus"></i> </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="sort_details">{{ __('Short Description') }} *</label>
                                <textarea name="sort_details" id="sort_details" class="form-control" placeholder="{{ __('Short Description') }}">{{ old('sort_details') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="details">{{ __('Description') }} *</label>
                                <textarea name="details" id="details" class="form-control text-editor" rows="6" placeholder="{{ __('Enter Description') }}">{{ old('details') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="tags">{{ __('Product Tags') }}
                                </label>
                                <input type="text" name="tags" class="tags" id="tags" placeholder="{{ __('Tags') }}" value="">
                            </div>
                            <div class="form-group">
                                <label class="switch-primary">
                                    <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_specification" value="1" checked>
                                    <span class="switch-body"></span>
                                    <span class="switch-text">{{ __('Specifications') }}</span>
                                </label>
                            </div>
                            <div id="specifications-section">
                                <div class="d-flex">

                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="specification_name[]" placeholder="{{ __('Specification Name') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="specification_description[]" placeholder="{{ __('Specification description') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-btn">
                                        <button type="button" class="btn btn-success add-specification" data-text="{{ __('Specification Name') }}"
                                            data-text1="{{ __('Specification Description') }}"> <i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="meta_keywords">{{ __('Meta Keywords') }}
                                </label>
                                <input type="text" name="meta_keywords" class="tags" id="meta_keywords" placeholder="{{ __('Enter Meta Keywords') }}" value="">
                            </div>

                            <div class="form-group">
                                <label for="meta_description">{{ __('Meta Description') }}
                                </label>
                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5" placeholder="{{ __('Enter Meta Description') }}">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" class="check_button" name="is_button" value="0">
                            <button type="submit" class="btn btn-secondary mr-2">{{ __('Save') }}</button>
                            <button type="submit" class="btn btn-info save__edit">{{ __('Save & Edit') }}</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="discount_price">{{ __('Current Price') }} *</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ PriceHelper::adminCurrency() }}</span>
                                    </div>
                                    <input type="text" id="discount_price" name="discount_price" class="form-control" placeholder="{{ __('Enter Current Price') }}" min="1" step="0.1"
                                        value="{{ old('discount_price') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="previous_price">{{ __('Previous Price') }}
                                </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ $curr->sign }}</span>
                                    </div>
                                    <input type="text" id="previous_price" name="previous_price" class="form-control" placeholder="{{ __('Enter Previous Price') }}" min="1"
                                        step="0.1" value="{{ old('previous_price') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="category_id">{{ __('Select Category') }} *</label>
                                <select name="category_id" id="category_id" data-href="{{ route('back.get.subcategory') }}" class="form-control">
                                    <option value="" selected>{{ __('Select One') }}</option>
                                    @foreach (DB::table('categories')->whereStatus(1)->get() as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subcategory_id">{{ __('Select Sub Category') }} </label>
                                <select name="subcategory_id" id="subcategory_id" data-href="{{ route('back.get.childcategory') }}" class="form-control">
                                    <option value="">{{ __('Select One') }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="childcategory_id">{{ __('Select Child Category') }} </label>
                                <select name="childcategory_id" id="childcategory_id" class="form-control">
                                    <option value="">{{ __('Select One') }}</option>
                                </select>
                            </div>

                            {{-- <div class="form-group">
                        <label for="brand_id">{{ __('Select Brand') }} </label>
                        <select name="brand_id" id="brand_id" class="form-control" >
                            <option value="" selected>{{__('Select Brand')}}</option>
                            @foreach (DB::table('brands')->whereStatus(1)->get() as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="stock">{{ __('Total in stock') }}
                                    *</label>
                                <div class="input-group mb-3">
                                    <input type="number" min="1" id="stock" name="stock" class="form-control" placeholder="{{ __('Total in stock') }}" value="{{ old('stock') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tax_id">{{ __('Select Tax') }} *</label>
                                <select name="tax_id" id="tax_id" class="form-control">
                                    <option value="">{{ __('Select One') }}</option>
                                    @foreach (DB::table('taxes')->whereStatus(1)->get() as $tax)
                                        <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sku">{{ __('SKU') }} *</label>
                                <input type="text" name="sku" class="form-control" id="sku" placeholder="{{ __('Enter SKU') }}" value="{{ Str::random(10) }}">
                            </div>
                            <div class="form-group">
                                <label for="video">{{ __('Video Link') }} </label>
                                <input type="text" name="video" class="form-control" id="video" placeholder="{{ __('Enter Video Link') }}" value="{{ old('video') }}">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="length">{{ __('Length') }}*</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="length" name="length" class="form-control" placeholder="{{ __('Item length') }}" value="{{ old('length') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tax_id">{{ __('Breadth') }} *</label>
                                <input type="text" name="breadth" class="form-control" id="breadth" placeholder="{{ __('Item breadth') }}" value="{{ old('breadth') }}">
                            </div>
                            <div class="form-group">
                                <label for="height">{{ __('Height') }} *</label>
                                <input type="text" name="height" class="form-control" id="height" placeholder="{{ __('Item height') }}" value="{{ old('height') }}">
                            </div>
                            <div class="form-group">
                                <label for="weight">{{ __('Weight') }} *</label>
                                <input type="text" name="weight" class="form-control" id="weight" placeholder="{{ __('Item weight') }}" value="{{ old('weight') }}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>


    </div>

    </div>
@endsection
