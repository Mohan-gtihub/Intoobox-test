@extends('master.back')
@section('title',trans('Upload New File'))
@section('style')

@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Upload Files') }}</b> </h3>
                <a class="btn btn-primary btn-sm" href="{{ route('uploaded-files.index') }}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
        </div>
    </div>
        <!-- breadcrumb -->

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h2">{{trans('Drag & drop your files')}}</h5>
    </div>
    <style>
        .uppy-DashboardTabs{
            height: 420px !important;
        }
    </style>
    <div class="card-body">
    	<div id="aiz-upload-files" class="h-420px" style="min-height: 65vh !important;">

    	</div>
    </div>
</div>
    </div>
@endsection

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			AIZ.plugins.aizUppy();
		});
	</script>
@endsection
