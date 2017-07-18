@extends('	layouts.master')

@section('title', 'All Sections')

@section('content')

<div class="page-header">
	<h1>Sections</h1>
</div>

<div class="list-group">

	<div class="list-group-item">
		<div class="row">
			<div class="col-md-2">
				<div class="list=group-item-text"><strong>Section Code</strong></div>
			</div>

			<div class="col-md-6">
				<div class="list-group-item-text"><strong>Section Name (Full)</strong></div>
			</div>

			<div class="col-md-4">



			</div>
		</div>
	</div>

@foreach ($sections as $section)
	<div class="list-group-item">
		<div class="row">
			<div class="col-md-2">
				<div class="list=group-item-text">{{ $section->short_name }}</div>
			</div>

			<div class="col-md-6">
				<div class="list-group-item-text">{{ $section->long_name }}</div>
			</div>

			<div class="col-md-4">
				<a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning btn-sm">Edit</a>
				{!! Form::open([
					'route' => ['sections.destroy', $section->id],
					'method' => 'delete',
					'class' => 'delete-object',
					'style' => 'display: inline;'
				]) !!}

				<button type="submit" class="btn btn-danger btn-sm">Delete</button>

				{!! Form::close() !!}

			</div>
		</div>
	</div>
@endforeach


</div>


@endsection