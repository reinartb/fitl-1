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

		<button id="updaterequest" type="submit" class="btn btn-success">Update The Request</button>
		{!! Form::close() !!}

		@include('requests.partials.delete_object')
	</div>

	<div class="col-md-8">
		@include('requests.partials.search_items_form')
	</div>
</div>

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
	@include('requests.partials.request_script')

@endsection