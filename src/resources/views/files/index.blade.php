@extends('layouts.app')

@section('content')
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
		</tr>
	@endforeach
	</body>
</table>

@if( method_exists($files, 'links') )
	{{ $files->links() }}
@endif
@append