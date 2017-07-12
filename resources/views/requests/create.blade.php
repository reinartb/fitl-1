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

@endsection

@section('scripts')


	<script>

		/*****************
		DESCRIPTION
		--------------
		This Javascript function adds items to the itemcart table when a user clicks 
		on the submit button with the ID "addrequest".
		
		First, the Javascript finds the selected item based on the Select2 option
		by the user. 

		It then runs an AJAX request that adds the selected item's ITEM ID and 
		adds it in the itemcart table.

		After the AJAX is successfully run, it adds a new row in the "Items Requested"
		table.

		*****************/

		$('#submitrequest').on('submit', function(e) {
			e.preventDefault();

				var array_quantity_requested = [];
				var array_item_id = [];

				$('#search-results-table tr input').each( function () {

					var item_id = $(this).parent().parent().find('[id*=delete]').attr('id').substring(12);
					array_item_id.push(item_id);

					array_quantity_requested.push(this.value);
				});
				
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

	       	});

		    setTimeout(function() {
			    $('#updaterequest').unbind('submit').submit();	
		    }, 1000);
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
		        	return "No Results Found. <a href='http://google.com'>Add Item?</a>";
		    	}
			},
			escapeMarkup: function (markup) {
				return markup;
			}
		});

	</script>

@endsection