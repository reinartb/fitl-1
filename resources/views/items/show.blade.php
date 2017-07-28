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
			<div class="text-center">
				<h4>SEPP for Different Departments</h4>
			</div>

			<div class="col-md-6 col-md-offset-3">
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
@endsection
