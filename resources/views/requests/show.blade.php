@extends('layouts.master')

@section('title', 'Show Request')

@section('content')

	<div class="page-header">
		<a href="{{ action('RequestController@edit', $request->id) }}" class="btn btn-warning pull-right">Edit Request</a>
		<h1>Requisition and Issuance Slip Number: {{ $request->ris_number }}</h1>
	</div>

	<div class="list-group">
		<div class="list-group-item">
			<h4>Requested By Section:</h4>
			<p>{{ $request->requested_by_section }}</p>
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
	<hr>

	<h2>Items Requested</h2>
	<table class="table">
		<thead>
			<th>Item Name</th>
		</thead>
		<tbody>
		@foreach ($request->items as $item)
			<tr>
				<td>{{ $item->name }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@endsection
