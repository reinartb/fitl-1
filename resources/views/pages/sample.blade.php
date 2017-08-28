@extends('layouts.master')

@section('title', 'About')

@section('content')

<div class="container">

	<div class="row">
		<div class="col-md-6">
			<select class="form-control" name="requested_by_section" id="section_list" style="width: 100%">
			</select>
		</div>
		<div class="col-md-6">
			<select class="form-control" name="item_id" id="item_list" style="width: 100%">
			</select>
		</div>

		<div>

	</div>
	
	<br>
	<br>

	<div class="row">
		<div class="text-center">
			<button id="searchsepp" class="btn btn-success">Search SEPP</button>
		</div>
	</div>

	<hr>

	<div class="row">
		<table class="table clickable-row">
			<thead>
				<th>Item Name</th>
				<th>SEPP Q1</th>
				<th>SEPP Q2</th>
				<th>SEPP Q3</th>
				<th>SEPP Q4</th>
				<th>Quantity Requested</th>
			</thead>
			<tbody id="search-results-table">

			</tbody>
		</table>


	</div>




	<br>
	<hr>
	<br>

	<div class="row">

		{{ Form::open([
			'method'=>'post',
			'class'=> 'col-md-6 col-md-offset-3',
			'id'=>'addrequest'
			]) }}

			<div class="form-group">
				<select class="form-control" name="item_id" id="item_list">
				</select>
			</div>

			<div class="text-center">
				{{Form::submit('Add to Request', ['name'=>'addrequest', 'class'=>'btn btn-orange'])}}
			</div>

		{!! Form::close() !!}
	</div>

	<hr>

	<h2>Items Requested</h2>
	<table class="table clickable-row">
		<thead>
			<th>Item ID</th>
			<th>Item Name</th>
		</thead>
		<tbody id="wtf">

		</tbody>
	</table>

	<hr>

	<div class="row">

		{{ Form::open([
			'method'=>'post',
			'class'=> 'col-md-6 col-md-offset-3',
			'id'=>'submitrequest'
			]) }}

			<div class="text-center">
				{{Form::submit('Submit Request', ['name'=>'submitrequest', 'class'=>'btn btn-orange'])}}
			</div>

		{!! Form::close() !!}
	</div>


</div>

@include('requests.partials.modal')

@endsection




@section('scripts')

@include('requests.partials.request_script')

	<script>

	/*****************
	DESCRIPTION
	--------------
	This Javascript function adds items to the itemcart table when a user clicks 
	on the submit button with the ID "addrequest".

	Code is split out between 2 sections, and they are both explained below.
	*****************/

	$('#addrequest').on('submit', function(e) {
       	e.preventDefault();

       	/*****************
		SECTION 1
		------------------
		Here, the Javascript finds the selected item based on the Select2 option
		by the user. 

		It then runs an AJAX request that adds the selected item's ITEM ID and 
		adds it in the itemcart table.

       	*****************/

		var sample = document.getElementById("item_list");
		var itemid = sample.options[sample.selectedIndex].value;

       	// alert(item_id);

       	$.ajax({
           	type: 'POST',
           	url: '{{ url("additem") }}',
           	dataType: 'json',
           	data: {item_id: itemid},
           	headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
           	success: function( msg ) {
           		// alert (msg.msg);
            	// $("body").append("<div>"+ msg.msg +"</div>");
        	}
       	});

       	/*****************
		SECTION 2
		------------------
		Once the ITEM ID has been added to the itemcart table, the function below
		retrieves all the items in the itemcart table and gets additional data
		associated with that item.

		After retrieving the ITEM IDs and their data, they are appended to a table
		for presentation.

       	*****************/

       	// Set request
	    var request = $.get('{{ url("getitem") }}');

	    // When it's done
	    request.done(function(response) {
	    	newresponse = response;
			console.log(response);
			console.log(response.length);

			var newRowContent = "<tr> <td>" + response[response.length-1].item_id + "</td> <td>" + response[response.length-1].name + "</td> </tr>";
			$("#wtf").append(newRowContent);
	    });

    });

    

    $('#submitrequest').on('submit', function(e) {
       	e.preventDefault();

   		$.ajax({
           	type: 'POST',
           	url: '{{ url("submitcart") }}',
           	dataType: 'json',
           	data: {sample: JSON.stringify(newresponse)},
           	headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
           	success: function( msg ) {
           		console.log(msg.msg);
            	// $("body").append("<div>"+ msg.msg +"</div>");
        	}
       	});


       	// console.log(newresponse);

   });


    $('#item_list').select2({
		placeholder: "Select An Item",
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