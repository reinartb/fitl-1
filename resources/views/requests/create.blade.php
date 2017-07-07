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

		<!-- <button type="submit" class="btn btn-success">Submit Your Request</button> -->
		
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