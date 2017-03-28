@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<a href="{{ Route::has('files.index') ? route('files.index') : '#' }}" class="btn btn-lg btn-primary btn-block">
				<i class="fa fa-list" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>

<form action="{{ Route::has('files.store') ? route('files.store') : '#' }}" method="POST" enctype="multipart/form-data" class="dropzone">
	{{ method_field('POST') }}
	{{ csrf_field() }}

	<div class="fallback">
		<div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
		    <input name="files[]" type="file" multiple class="form-control">

	        @if ($errors->has('files'))
	            <span class="help-block">
	                <strong>{{ $errors->first('files') }}</strong>
	            </span>
	        @endif
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<a href="{{ Route::has('files.index') ? route('files.index') : '#' }}" class="btn btn-lg btn-block btn-default">
						CANCEL
					</a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<button type="submit" class="btn btn-danger btn-block btn-lg">
						UPLOAD
					</button>
				</div>
			</div>
		</div>
	</div>
</form>
@append

@section('styles')
<link href="{{ asset('/vendor/yk/laravel-files/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('/vendor/yk/laravel-files/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet">
@append

@section('scripts')
<script src="{{ asset('/vendor/yk/laravel-files/dropzone/dist/min/dropzone.min.js') }}"></script>

<script type="text/javascript">
	Dropzone.autoDiscover = false;

	$( document ).ready(function() {

	 	$(".dropzone").dropzone({
	        url: "{{ Route::has('files.store') ? route('files.store') : '#' }}",
	    });

	});
</script>
@append