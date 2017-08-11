@extends('	layouts.master')

@section('title', 'All Sections')

@section('content')

<div class="page-header">
	<a href="{{ route('sections.create') }}" class="btn btn-success pull-right">+ Create New Section</a>

	<h1>Sections</h1>
</div>


<!-- <div class="row"> -->
	<table class="table">
		<thead>
			<th>Section Code</th>
			<th>Section Name</th>
			<th>Options</th>
		</thead>
		<tbody>
			@foreach ($sections as $section)
				<tr>
					<td>{{ $section->short_name }}</td>
					<td>{{ $section->long_name }}</td>
					<td><a href="{{ route('sections.show', $section->id) }}" >Show</a>
					&nbsp
					<a href="{{ route('sections.edit', $section->id) }}">Edit</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	<div class="text-center">
		{{ $sections->links() }}
	</div>
<!-- </div> -->

<!-- 
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

				<a href="{{ route('sections.show', $section->id) }}" class="btn btn-primary btn-sm">Show</a>
				<a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning btn-sm">Edit</a>

			</div>
		</div>
	</div>
@endforeach -->


</div>


@endsection