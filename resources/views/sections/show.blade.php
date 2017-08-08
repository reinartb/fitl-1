@extends('layouts.master')

@section('title', 'Show Section')

@section('content')

<div class="page-header">
	<a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning pull-right">Edit Section</a>
	<h1>{{ $section->short_name }}</h1>
</div>

<div class="list-group">
	<div class="list-group-item">
		<h4>Short Name:</h4>
		<p>{{ $section->short_name }}</p>
	</div>
	<div class="list-group-item">
		<h4>Long Name:</h4>
		<p>{{ $section->long_name }}</p>
	</div>
	<div class="list-group-item">
		<h4>Created At:</h4>
		<p>{{ Carbon\Carbon::parse($section->created_at)->format('F d, Y h:i:s A') }}</p>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-8">
		<h4>SEPP for Section's Items</h4>
		<br>
		<table class="table table-bordered">
			<thead>
				<th>Item</th>
				<th>Year</th>
				<th>Q1</th>
				<th>Q2</th>
				<th>Q3</th>
				<th>Q4</th>
			</thead>
			<tbody>
				@foreach($section->sepp as $sepp)
					<tr>
						<td><a href="{{ route('items.show', $sepp->item->id) }}">{{ $sepp->item->name }}</a></td>
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

<h4>Request Log</h4>

<br>

<div class="list-group">
	@foreach($section->requests as $r)
		<div class="list-group-item">
			<p>RIS Number: <a href="{{ action('RequestController@show', $r->id) }}">{{ $r->ris_number }}</a></p>
			<p>Requested By: {{ $r->requested_by_user }}</p>
			<p>Requested At: {{ Carbon\Carbon::parse($r->created_at)->format('F d, Y h:i:s A') }}</p>

			<table class="table table-bordered" style="width: 50%">						
				<thead>
					<th>Item</th>
					<th>Quantity Requested</th>
				</thead>
				<tbody>
					@foreach($r->items as $i) 
						<tr>
							<td><a href="{{ route('items.show', $i->id) }}">{{ $i->name }}</a></td>
							<td>{{ $i->pivot->quantity_requested }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endforeach
</div>
<!-- </div> -->


</div>
@endsection
