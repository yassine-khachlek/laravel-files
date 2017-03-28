@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<a href="{{ Route::has('files.create') ? route('files.create') : '#' }}" class="btn btn-lg btn-success btn-block">
				<i class="fa fa-upload" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>

<table class="table table-striped table-hover">
	<body>
	@foreach($files as $file)
		<tr>
			<td>
				{{ $file->id }}
			</td>
			<td>
				@if (in_array($file->extension, ['jpg', 'jpeg', 'png', 'gif']))
					<img src="{{ route('files.show', ['id' => $file->id, 'slug' => str_slug($file->name).'.'.$file->extension]) }}" class="img-thumbnail img-responsive" style="width: 100px;">
				@endif
			</td>
			<td>
				{{ $file->name }}.{{ $file->extension }}
			</td>
			<td>
				{{ round($file->size / pow(10, 6), 2) }} MB
			</td>
			<td>
				<form action="{{ Route::has('files.destroy') ? route('files.destroy', ['id' => $file->id]) : '#' }}" method="POST" class="form-inline pull-right">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}
					<button type="submit" class="btn btn-lg btn-danger">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</button>
				</form>

				<a href="{{ $file->link }}" target="_blank" class="btn btn-lg btn-primary pull-right">
					<i class="fa fa-external-link" aria-hidden="true"></i>
				</a>

				<a href="{{ $file->downloadLink }}" class="btn btn-lg btn-primary pull-right">
					<i class="fa fa-download" aria-hidden="true"></i>
				</a>
			</td>
		</tr>
	@endforeach
	</body>
</table>

@if( method_exists($files, 'links') )
	{{ $files->links() }}
@endif
@append

@section('styles')
<link href="{{ asset('/vendor/yk/laravel-files/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

<style type="text/css">
	.table :last-child > a {
		margin-left: 8px;
	}
	.table :last-child > form {
		margin-left: 8px;
	}
</style>
@append