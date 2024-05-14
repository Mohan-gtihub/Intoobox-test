<div >
	<div class="form-group">
		<label>{{ trans('File Name') }}</label>
		<input type="text" class="form-control" value="{{ $file->file_name }}" disabled>
	</div>
	<div class="form-group">
		<label>{{ trans('File Type') }}</label>
		<input type="text" class="form-control" value="{{ $file->type }}" disabled>
	</div>
	<div class="form-group">
		<label>{{ trans('File Size') }}</label>
		<input type="text" class="form-control" value="{{ formatBytes($file->file_size) }}" disabled>
	</div>
	<div class="form-group">
		<label>{{ trans('Uploaded At') }}</label>
		<input type="text" class="form-control" value="{{ $file->created_at }}" disabled>
	</div>
	<div class="form-group text-center">
		@php
			if($file->file_original_name == null){
			    $file_name = trans('Unknown');
			}else{
				$file_name = $file->file_original_name;
			}
		@endphp
		<a class="btn btn-secondary" href="{{ asset($file->file_name) }}" target="_blank" download="{{ $file_name }}.{{ $file->extension }}">{{ trans('Download') }}</a>
	</div>
</div>
