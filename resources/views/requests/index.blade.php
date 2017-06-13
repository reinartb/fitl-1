@extends('layouts.master')

@section('title', 'Supply Requests')

@section('content')
<div class="page-header">
	<h1>Digital Requisition and Issuance Slips</h1>
</div>

<div class="list-group">

@foreach ($requests as $request)
	<!-- <a href="{{ url('requests', [$request->id]) }}" class="list-group-item"> -->
	<div class="list-group-item">	
		<div class="row">
			<div class="col-md-4">
				<h2 class="list-group-item-heading"> {{ $request->ris_number }} </h2>
				<p class="list-group-item-text"> {{ $request->requested_by_section }}</p>
				<p class="list-group-item-text"> Requested by: {{ $request->requested_by_user }}</p>
			</div>
			<div class="col-md-6">
				<p class="list-group-item-text"> Purpose: {{ $request->purpose }} </p>
				<br>
				<p class="list-group-item-text"> Requested on: {{ $request->created_at }}</p>
			</div>
			<div class="col-md-2">
				<a href="{{ action('RequestController@show', $request->id) }}" class="btn btn-primary">Show</a>
				&nbsp
				<a href="{{ action('RequestController@edit', $request->id) }}" class="btn btn-warning">Edit</a>
			</div>
		</div>
	</div>
	<!-- </a> -->
@endforeach

</div>

@endsection



