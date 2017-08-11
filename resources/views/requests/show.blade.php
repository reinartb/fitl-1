@extends('layouts.master')

@section('title', 'Show Request')

@section('content')


	<div class="page-header">
		<a href="{{ action('RequestController@edit', $request->id) }}" class="btn btn-warning pull-right">Edit Request</a>
		<h2>Requisition and Issuance Slip Number: {{ $request->ris_number }}</h2>
	</div>

	<div class="row">
		<div class="col-md-3">
			<h3><strong>Request Details</strong></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum mauris nibh, eget consequat diam mollis porta. Quisque accumsan hendrerit sapien, suscipit gravida ligula lobortis feugiat.</p>
		</div>
		<div class="col-md-9">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td><strong>Requested By Section</strong></td>
						<td><a href="{{ route('sections.show', $request->section->id) }}">{{ $request->section->long_name }}</a></td>
					</tr>
					<tr>
						<td><strong>Requested By User</strong></td>
						<td>{{ $request->requested_by_user }}</td>
					</tr>
					<tr>
						<td><strong>Requested At</strong></td>
						<td>{{ Carbon\Carbon::parse($request->created_at)->format('F d, Y') }}</td>
					</tr>
					<tr>	
						<td><strong>Request Purpose</strong></td>
						<td>{{ $request->purpose }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<hr>
	<div class="row">
		<div class="col-md-3">
			<h3><strong>Items Requested</strong></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum mauris nibh, eget consequat diam mollis porta. Quisque accumsan hendrerit sapien, suscipit gravida ligula lobortis feugiat.</p>
		</div>
		<div class="col-md-9">
			<table class="table clickable-row">
				<thead>
					<th>Item Name</th>
					<th>Quantity Requested</th>
					<th>SEPP Q1</th>
					<th>SEPP Q2</th>
					<th>SEPP Q3</th>
					<th>SEPP Q4</th>
				</thead>
				<tbody>
				@foreach ($request->items as $item)
					<tr>
						<td><a href="{{ route('items.show', $item->id) }}">{{ $item->name }}</a></td>
						<td> {{ $item->pivot->quantity_requested }}</td>
						<td> {{ $item->sepp()->where('section_id', $request->section->id)->first()->q1_quantity }} </td>
						<td> {{ $item->sepp()->where('section_id', $request->section->id)->first()->q2_quantity }} </td>
						<td> {{ $item->sepp()->where('section_id', $request->section->id)->first()->q3_quantity }} </td>
						<td> {{ $item->sepp()->where('section_id', $request->section->id)->first()->q4_quantity }} </td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection
