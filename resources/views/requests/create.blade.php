@extends('layouts.master')


@section('title', 'Submit A New Request')


@section('content')

<div class="page-header">
	<h1>Submit A New Request</h1>
</div>

<div class="row">
	<div class="col-md-6">
		{!! Form::model($request, ['action' => 'RequestController@store']) !!}
		
		@include('requests.partials.object_form')

		<button type="submit" class="btn btn-success">Submit Your Request</button>
		
		{!! Form::close() !!}
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