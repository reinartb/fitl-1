@extends('layouts.master')

@section('title', 'Show Item')

@section('content')
<div class="page-header">
	<a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning pull-right">Edit Item</a>
	<h1>{{ $item->name }}</h1>
</div>


<div class="row">
	<div class="col-md-3">
		<h3><strong>Item Details</strong></h3>
		<p></p>
	</div>
	<div class="col-md-9">
		<table class="table table-bordered">
			<thead>
				<th>Name</th>
				<th>Created At</th>
			</thead>
			<tbody>
				<tr>
					<td>{{ $item->name }}</td>
					<td>{{ Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
				</tr>
			</tbody>

		</table>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-3">
		<h3><strong>SEPP Log</strong></h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum mauris nibh, eget consequat diam mollis porta. Quisque accumsan hendrerit sapien, suscipit gravida ligula lobortis feugiat.</p>
	</div>
	<div class="col-md-9">

		<table class="table table-bordered">
			<thead>
				<th>Section</th>
				<th>Year</th>
				<th>Q1</th>
				<th>Q2</th>
				<th>Q3</th>
				<th>Q4</th>
			</thead>
			<tbody>
				@foreach($item->sepp as $sepp) 
					<tr>
						<td><a href="{{ route('sections.show', $sepp->section->id) }}">{{ $sepp->section->short_name }}</a></td>
						<td>{{ $sepp->year }} </td>
						<td>{{ $sepp->q1_quantity }}</td>
						<td>{{ $sepp->q2_quantity }}</td>
						<td>{{ $sepp->q3_quantity }}</td>
						<td>{{ $sepp->q4_quantity }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-3">
		<h3><strong>Request Log</strong></h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum mauris nibh, eget consequat diam mollis porta.</p>
	</div>
	<div class="col-md-9">
		<table class="table table-bordered">
		<thead>
			<th>Date and Time Requested</th>
			<th>RIS Number</th>
			<th>Section</th>
			<th>Requested By</th>
			<th>Quantity Requested</th>
		</thead>
		<tbody>
			@foreach($item->requests as $r) 
				<tr>
					<td>{{ Carbon\Carbon::parse($r->created_at)->format('F d, Y h:i:s A') }}</td>
					<td><a href="{{ action('RequestController@show', $r->id) }}">{{ $r->ris_number }}</a></td>
					<td>{{ $r->section->short_name }}</td>
					<td>{{ $r->requested_by_user }}</td>
					<td>{{ $r->pivot->quantity_requested }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
</div>



@endsection
