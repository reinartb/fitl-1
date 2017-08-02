@extends('layouts.master')

@section('title', 'Add A New SEPP')

@section('content')

<div class="page-header">
	<h1>Add a New SEPP</h1>
</div>

{!! Form::model ($sepp, 
	[
		'route' => ['sepp.store', $sepp->id],
		'style' => 'display: inline;'
	]) !!}


		@include('sepp.partials.object_form')

		<button type="submit" class ="btn btn-success">Create SEPP Entry</button>

{!! Form::close() !!}

@endsection

@section('scripts')

	<!-- <script src="{{ asset('js/request.js') }}"></script> -->

	@include('requests.partials.request_script')
	

@endsection