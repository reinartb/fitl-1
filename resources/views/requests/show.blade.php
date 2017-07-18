@extends('layouts.master')

@section('title', 'Show Request')

@section('content')


	<div class="page-header">
		<a href="{{ action('RequestController@edit', $request->id) }}" class="btn btn-warning pull-right">Edit Request</a>
		<h2>Requisition and Issuance Slip Number: {{ $request->ris_number }}</h2>
	</div>

	<div class="row">
		<div class="col-md-4">
		<h3>Request Details</h3>
			<!-- <table class="table">
				<thead>
					<th>Header</th>
					<th>Details</th>
				</thead>
				<tbody>
					<tr>
						<td>Requested By Section</td>
						<td>{{ $request->requested_by_section }}</td>
					</tr>
					<tr>
						<td>Requested By User</td>
						<td>{{ $request->requested_by_user }}</td>
					</tr>
					<tr>
						<td>Requested At</td>
						<td> {{ Carbon\Carbon::parse($request->created_at)->format('F d, Y h:i:s A') }}</td>
					</tr>
					<tr>	
						<td>Request Purpose</td>
						<td> {{ $request->purpose }}</td>
					</tr>
				</tbody>
			</table> -->


			<div class="list-group">
				<div class="list-group-item">
					<h4>Requested By Section:</h4>
					<p>
						{{ $request->section->short_name }}
						<br>
						{{ $request->section->long_name }}
					</p>
				</div>
				<div class="list-group-item">
					<h4>Requested By User: </h4>
					<p>{{ $request->requested_by_user }}</p>
				</div>
				<div class="list-group-item">
					<h4>Requested At:</h4>
					<p> {{ Carbon\Carbon::parse($request->created_at)->format('F d, Y h:i:s A') }}</p>
				</div>
				<div class="list-group-item">	
					<h4>Request Purpose:</h4>
					<p> {{ $request->purpose }}</p>
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<h3>Items Requested</h3>
			<table class="table clickable-row">
				<thead>
					<th>Item Name</th>
					<th>Quantity Requested</th>
				</thead>
				<tbody>
				@foreach ($request->items as $item)
					<tr>
						<td><a href="{{ route('items.show', $item->id) }}">{{ $item->name }}</a></td>
						<td>{{ $item->pivot->quantity_requested }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection
