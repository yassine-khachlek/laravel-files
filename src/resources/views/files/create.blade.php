@extends('layouts.app')

@section('content')
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