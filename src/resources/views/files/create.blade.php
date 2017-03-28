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

<form action="{{ Route::has('files.store') ? route('files.store') : '#' }}" method="POST" enctype="multipart/form-data">
	{{ method_field('POST') }}
	{{ csrf_field() }}

	<div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
	    <input name="files[]" type="file" multiple class="form-control">

        @if ($errors->has('files'))
            <span class="help-block">
                <strong>{{ $errors->first('files') }}</strong>
            </span>
        @endif
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-danger btn-block btn-lg">
			UPLOAD
		</button>
	</div>

</form>
@append

@section('styles')
<link href="{{ asset('/vendor/yk/laravel-files/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
@append