@extends('layouts.master')


@section('title', 'Edit a Request')


@section('content')


<div class="page-header">
	<h1>Edit a Request</h1>
</div>

<div class="row">

	<div class="col-md-4">
		{!! Form::model($request, 
		[
			'action' => ['RequestController@update', $request->id],
			'method' => 'put',
			'style' => 'display: inline;',
			'id' => 'submitrequest'
		]) !!}
		
		@include('requests.partials.object_form')

	</div>

	<div class="col-md-8">
		@include('requests.partials.search_items_form')
	</div>

</div>

<hr>

<div class="text-center">
	<button id="updaterequest" type="submit" class="btn btn-success btn-lg">Update The Request</button>
	&nbsp
	&nbsp
	&nbsp
	&nbsp
	{!! Form::close() !!}

	@include('requests.partials.delete_object')
</div>

@include('requests.partials.modal')

@endsection

@section('scripts')
	@include('requests.partials.request_script')

@endsection