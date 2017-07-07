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
			'style' => 'display: inline;'
		]) !!}
		
		@include('requests.partials.object_form')

		<button type="submit" class="btn btn-success">Update The Request</button>
		{!! Form::close() !!}

		@include('requests.partials.delete_object')
	</div>


	<div class="col-md-8">
		@include('requests.partials.search_items_form')
	</div>
</div>

@endsection


@section('scripts')

	<script>
	

	$('#addrequest').on('submit', function(e) {
	       	e.preventDefault();

			var data = $('#item_list').select2('data');

	       	$.ajax({
	           	type: 'POST',
	           	url: '{{ url("additem") }}',
	           	dataType: 'json',
	           	data: {item_id: data[0].id},
	           	headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
	           	success: function( response ) {

					var newRowContent = 
						"<tr> <td>" + response.item_id + 
						"</td> <td>" + response.item_name + 
						"</td> <td> Delete Button </td> </tr>" ;

					$("#wtf").append(newRowContent);

	           		alert (response.msg);
	            	// $("body").append("<div>"+ msg.msg +"</div>");
	        	}
	       	});
	    });



	    $('#item_list').select2({
			placeholder: "Search Item . . .",
		    minimumInputLength: 2,

			ajax: {
				url: '{{ url("searchitem") }}',
		        dataType: 'json',
		        delay: 500,
		        data: function (params) {
		            return {
		                q: $.trim(params.term)
		            };
		        },
		        processResults: function (data) {
		            return { results: data };

		        },
				cache: true
			},

			language: {
		    	noResults: function() {
		        	return "No Results Found. <a href='http://google.com'>Add Item?</a>";
		    	}
			},
			escapeMarkup: function (markup) {
				return markup;
			}
		});



	</script>

@endsection