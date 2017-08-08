@extends('layouts.master')

@section('title', 'Submit A New Request')

@section('content')

<div class="page-header">
	<h1>Submit A New Request</h1>
</div>

<div class="row">
	<div class="col-md-4">
		{!! Form::model($request, [
			'action' => 'RequestController@store',
			'id'=>'submitrequest'
			]) !!}
		
		@include('requests.partials.object_form')		
	</div>

	
	<div class="col-md-8">
		@include('requests.partials.search_items_form')
	</div>
</div>

<hr>

<div class="text-center">
		{{Form::submit('Submit Request', ['name'=>'submitrequest', 'class'=>'btn btn-success btn-lg'])}}
</div>

{!! Form::close() !!}

@include('requests.partials.modal')

@endsection

@section('scripts')

@include('requests.partials.request_script')	

@endsection