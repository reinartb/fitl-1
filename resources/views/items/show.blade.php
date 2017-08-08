@extends('layouts.master')

@section('title', 'Show Item')

@section('content')
<div class="page-header">
	<a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning pull-right">Edit Item</a>
	<h1>{{ $item->name }}</h1>
</div>

<div class="list-group">
	<div class="list-group-item">
		<h4>Created At:</h4>
		<p>{{ Carbon\Carbon::parse($item->created_at)->format('F d, Y h:i:s A') }}</p>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-8">

		<h4>SEPP for Different Departments</h4>
		<br>

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
						<td>{{ $sepp->section->short_name }}</td>
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

<!-- <div class="col-md-6"> -->
	<h4>Request Log</h4>
	<br>
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
<!-- </div> -->


@endsection
