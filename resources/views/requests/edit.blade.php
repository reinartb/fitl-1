@extends('layouts.master')


@section('title', 'Edit a Request')


@section('content')


<div class="page-header">
	<h1>Edit a Request</h1>
</div>

<div class="row">
	<div class="col-md-6">
		{!! Form::model($request, 
		[
			'action' => ['RequestController@update', $request->id],
			'method' => 'put',
			'style' => 'display: inline;'
		]) !!}
		
		@include('requests.partials.object_form')

		<button type="submit" class="btn btn-success">Update The Request</button>
		{!! Form::close() !!}

		@include('requests.partials.delete_object')
	</div>


	<div class="col-md-6">
		@include('requests.partials.search_items_form')
	</div>
</div>

@endsection


@section('scripts')

	<script>
	$(document).ready(function(){
	   $("#search").keyup(function(){
	       var str=  $("#search").val();
	       if(str == "") {
	               $( "#txtHint" ).html("Items will be listed here."); 
	       }else {
	               // $( "#txtHint" ).html("Jesus.");
	               $.get( "{{ url('demos/livesearch?id=') }}"+str, function( data ) {
	                   $( "#txtHint" ).html( data );  
	            });
	       }
	   });  
	}); 
	</script>

@endsection