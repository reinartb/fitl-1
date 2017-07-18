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

@endsection


@section('scripts')

	<script>
	
		$('#submitrequest').on('submit', function(e) {
			e.preventDefault();

			var array_quantity_requested = [];
			var array_item_id = [];
			var invalid = false;

			$('#search-results-table tr input').each( function () {
				var item_id = $(this).parent().parent().find('[id*=delete]').attr('id').substring(12);
				array_item_id.push(item_id);

				if (this.value.length == 0) {
					var message = 'The item with Item ID ' + item_id + ' has no quantity requested.';
					alert (message);
					invalid = true;
				} else {
					array_quantity_requested.push(this.value);				
				}

			});

			// for (i = 0; i < array_quantity_requested.length; i++) {
			// 	if (array_quantity_requested[i].val().trim().length == 0) {
			// 		alert ("Please fill all input fields!");
			// 		return false;
			// 	}
			// }

			if (invalid) {
				return false;
			}

			if ( array_quantity_requested.length > 0 ) {
				$.ajax({
		           	type: 'POST',
		           	url: '{{ url("submitrequest") }}',
		           	dataType: 'json',
		           	data: {item_id: array_item_id, quantity_requested: array_quantity_requested},
		           	headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
		           	success: function( response ) {
		           		// Checks if item was successfully added to cart.
		           		if (response.status != 'success') {
		           			alert (response.msg);
		           		}           			         
		        	}

		       	}).done( function () {
		       		$('#submitrequest').unbind('submit').submit();
		       	});
			} else {
				alert ('No items were added to the request. Please add items.');
			}
		});


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

	           		// Checks if item was successfully added to cart.
	           		if (response.status == 'success') {

		           		// If successfully added to cart, a new row will be added inside the search results table.
						var newRowContent = 
							"<tr> <td>" + response.item_id + "</td>" +
							"<td>" + response.item_name + "</td>" + 

							"<td> <input type=\"number\"> </td>" +
							
							//Sets the delete button to have an ID that has the Item ID of that row appended.
							"<td> <button id=\"item-delete-" + response.item_id +"\" class=\"btn btn-danger btn-sm\"> Delete </button> </td> </tr>" ;


						$("#search-results-table").append(newRowContent);
	           		}

           			// If not successful, return error message from Controller.
           			alert (response.msg);	         

	        	}

	       	});
	    });

		$(document).ready(function(){
		  	$('#search-results-table').on('click', '[id*=delete]', function() {
		  		
		  		//Retrieves the item ID from the ID of the button.
		  		var item_id = $(this).attr('id').substring(12);

		  		$.ajax({
		           	type: 'DELETE',
		           	url: '{{ url("deleteitem") }}',
		           	dataType: 'json',
		           	data: {item_id: item_id},
		           	headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
		           	success: function( response ) {
		           		alert(response.msg);
		        	}
		       	});

		   		// Removes the row of the item being clicked.
		   		$(this).parent().parent().remove();

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
		        	return "No Results Found. <a href='{{ url('items/create') }}'>Add Item?</a>";
		    	}
			},
			escapeMarkup: function (markup) {
				return markup;
			}
		});


	    $('#section_list').select2({
			placeholder: "Search Sections . . .",
		    minimumInputLength: 2,

			ajax: {
				url: '{{ url("section/select2-search") }}',
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
		        	return "No Results Found. <a href='{{ route('sections.create') }}'>Add Section?</a>";
		    	}
			},
			escapeMarkup: function (markup) {
				return markup;
			}
		});


	</script>

@endsection