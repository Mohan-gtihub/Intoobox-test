@extends('master.back')
@section('title',trans('All uploaded files'))
@section('styles')
@endsection
@section('content')
    <div class="container-fluid">

        <!-- breadcrumb -->
		   <!-- Page Heading -->
		   <div class="card mb-4">
			<div class="card-body">
				<div class="d-sm-flex align-items-center justify-content-between">
					<h3 class="mb-0 bc-title"><b>{{ __('Upload Files') }}</b> </h3>
					<a class="btn btn-primary btn-sm" href="{{ route('uploaded-files.create') }}"><i class="fas fa-plus"></i> {{trans('Upload New File')}}</a>
					</div>
			</div>
		</div>
    <!-- container -->

<div class="card">
    <div class="card-header">
    <form id="sort_uploads" action="">
        <div class="card-header row">
            <div class="col-md-2">
                <h5 class="mb-0 h2">{{trans('All files')}}</h5>
            </div>
            <div class="col-md-4">
                <select class="form-control form-control-xs aiz-selectpicker" name="sort" onchange="sort_uploads()">
                    <option value="newest" @if($sort_by == 'newest') selected="" @endif>{{ trans('Sort by newest') }}</option>
                    <option value="oldest" @if($sort_by == 'oldest') selected="" @endif>{{ trans('Sort by oldest') }}</option>
                    <option value="smallest" @if($sort_by == 'smallest') selected="" @endif>{{ trans('Sort by smallest') }}</option>
                    <option value="largest" @if($sort_by == 'largest') selected="" @endif>{{ trans('Sort by largest') }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control form-control-xs" name="search" placeholder="{{ trans('Search your files') }}" value="{{ $search }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">{{ trans('Search') }}</button>
            </div>
        </div>
    </form>
    </div>
    <div class="card-body">
    	<div class="row gutters-5">
    		@foreach($all_uploads as $key => $file)
    			@php
    				if($file->file_original_name == null){
    				    $file_name = trans('Unknown');
    				}else{
    					$file_name = $file->file_original_name;
	    			}
    			@endphp
    			<div class="col-md-2">
    				<div class="aiz-file-box">
    					<div class="dropdown-file" >
    						<a class="dropdown-link" data-toggle="dropdown">
    							<i class="fa fa-ellipsis-v" style="font-size: medium !important;"></i>
    						</a>
    						<div class="dropdown-menu dropdown-menu-right">
    							<a href="javascript:void(0)" class="dropdown-item" onclick="detailsInfo(this)" data-id="{{ $file->id }}">
    								<i class="fas fa-info-circle mr-2"></i>
    								<span>{{ trans('Details Info') }}</span>
    							</a>
    							<a href="{{ asset($file->file_name) }}" target="_blank" download="{{ $file_name }}.{{ $file->extension }}" class="dropdown-item">
    								<i class="fa fa-download mr-2"></i>
    								<span>{{ trans('Download') }}</span>
    							</a>
    							<a href="javascript:void(0)" class="dropdown-item" onclick="copyUrl(this)" data-url="{{ asset($file->file_name) }}">
    								<i class="fas fa-clipboard mr-2"></i>
    								<span>{{ trans('Copy Link') }}</span>
    							</a>
    							<a href="javascript:void(0)" class="dropdown-item confirm-alert" data-href="{{ route('uploaded-files.destroy', $file->id ) }}" data-target="#delete-modal">
    								<i class="fas fa-trash mr-2"></i>
    								<span>{{ trans('Delete') }}</span>
    							</a>
    						</div>
    					</div>
    					<div class="card card-file aiz-uploader-select c-default" title="{{ $file_name }}.{{ $file->extension }}">
    						<div class="card-file-thumb" style="overflow: hidden !important;">
    							@if($file->type == 'image')
    								<img src="{{ asset($file->file_name) }}" class="img-fluid">
    							@elseif($file->type == 'video')
    								<i class="fas fa-file-video"></i>
    							@else
    								<i class="fas fa-file"></i>
    							@endif
    						</div>
    						<div class="card-body">
    							<h6 class="d-flex">
    								<span class="text-truncate title">{{ $file->id.'-'.$file_name }}</span>
    								<span class="ext">.{{ $file->extension }}</span>
    							</h6>
    							<p>{{ formatBytes($file->file_size) }}</p>
    						</div>
    					</div>
    				</div>
    			</div>
    		@endforeach
    	</div>
		<div class="aiz-pagination mt-3">
			{{ $all_uploads->appends(request()->input())->links() }}
		</div>
    </div>
</div>
        <div id="delete-modal" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title h6">{{ trans('Delete Confirmation') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="mt-1">{{ trans('Are you sure to delete this file?') }}</p>
                        <button type="button" class="btn btn-link mt-2" data-dismiss="modal">{{ trans('Cancel') }}</button>
                        <a href="" class="btn btn-primary mt-2 comfirm-link">{{ trans('Delete') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="info-modal" class="modal fade">
            <div class="modal-dialog modal-dialog-right">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h2">{{ trans('File Info') }}</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal">
							<i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
                        <div class="c-preloader text-center absolute-center">
                            <i class="las la-spinner la-spin la-3x opacity-70"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
	<script type="text/javascript">
		function detailsInfo(e){
            $('#info-modal-content').html('<div class="c-preloader text-center absolute-center"><i class="las la-spinner la-spin la-3x opacity-70"></i></div>');
			var id = $(e).data('id')
			$('#info-modal').modal('show');
			$.post('{{ route('uploaded-files.info') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('#info-modal-content').html(data);
				// console.log(data);
			});
		}
		function copyUrl(e) {
			var url = $(e).data('url');
			var $temp = $("<input>");
		    $("body").append($temp);
		    $temp.val(url).select();
		    try {
			    document.execCommand("copy");
			    AIZ.plugins.notify('success', '{{ trans('Link copied to clipboard') }}');
			} catch (err) {
			    AIZ.plugins.notify('danger', '{{ trans('Oops, unable to copy') }}');
			}
		    $temp.remove();
		}
        function sort_uploads(el){
            $('#sort_uploads').submit();
        }
	</script>
@endsection
