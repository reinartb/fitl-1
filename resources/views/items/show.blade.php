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

		<pre>
		{{$item->sepp->first()->section->short_name}}


		{{-- dd($sections) --}}

		</pre>

		<table class="table">
			<thead>
				<th>Section</th>
				<th>Q1</th>
				<th>Q2</th>
				<th>Q3</th>
				<th>Q4</th>
			</thead>
			<tbody>
				@foreach ($sections as $s_id => $sepp)
					<tr>
						<td>{{ $sepp->first()->section->short_name }}</td>
						@foreach ($sepp as $s)
							<td>{{ $s->sepp_quantity }}</td>
						@endforeach
					</tr>
				@endforeach
			</tbody>


		</table>
@endsection
