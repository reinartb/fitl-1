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


		<div class="text-center">
				{{Form::submit('Submit Request', ['name'=>'submitrequest', 'class'=>'btn btn-success'])}}
		</div>

		
		{!! Form::close() !!}
	</div>

	
	<div class="col-md-8">
		@include('requests.partials.search_items_form')
	</div>
</div>

<!-- <button type="button" class="btn btn-info btn-lg" id="myBtn">Open Modal</button> -->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
		<div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			    <h4 class="modal-title">Add New SEPP</h4>
			</div>
		    <div class="modal-body" style="overflow: hidden;">
		    	@include('sepp.partials.object_form')

		    </div>
		    <div class="modal-footer">
		    	<button type="button" id="add-sepp" class="btn btn-success">Add SEPP</button>
		    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>

		</div>
  
	</div>
</div>

@endsection

@section('scripts')

	<!-- <script src="{{ asset('js/request.js') }}"></script> -->

<script>



</script>

	@include('requests.partials.request_script')


	

@endsection