<script>
	$('#submitrequest').on('submit', function(e) {
		e.preventDefault();

		var array_quantity_requested = [];
		var array_item_id = [];
		var invalid = false;

		$('#search-results-table tr input').each( function () {
			// Gets item ID from the input field and pushes it into an array of all Item IDs.
				
	        var item_id = $(this).attr('item-id');
	        
	        array_item_id.push(item_id);

			// Checks if quantity requested field has a value or not.
			if (this.value.length == 0) { // If no value, message is passed and the invalid variable comes true.
				var message = 'The item with Item ID ' + item_id + ' has no quantity requested.';
				alert (message);
				invalid = true;
			} else { // If value is present, value inside input field is passed into an array.
				array_quantity_requested.push(this.value);				
			}

		});

		// This stops the Javascript and exists the function when there is no value in
		// the quantity requested field above.
		if (invalid) {
			return false;
		}

		// Checks if there are actually items inside the cart.
		if ( array_quantity_requested.length > 0 ) { // If there are items, Item IDs and respective quantity
													 // requested are submitted to controller using Ajax.
			$.ajax({
	           	type: 'POST',
	           	url: '{{ url("submitrequest") }}',
	           	dataType: 'json',
	           	data: {item_id: array_item_id, quantity_requested: array_quantity_requested},
	           	headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
	           	success: function( response ) {
	           		// Checks if items were successfully added to the temporary itemcart table.
	           		if (response.status != 'success') {
	           			alert (response.msg);
	           		}           			         
	        	}

	       	}).done( function () { // After successfully performing the Ajax, the form is told to continue with it submit operation.
	       		$('#submitrequest').unbind('submit').submit();
	       	});
		} else { // If no items in cart, alert the message below.
			alert ('No items were added to the request. Please add items.');
		}
	});


	$('#addrequest').on('submit', function(e) {
	   	e.preventDefault();

		var invalid = false;
		var selected_item = $('#item_list').select2('data');

		console.log(selected_item);


		if (selected_item.length == 0) {
			alert('Please pick an item first.');
			return false
		}

		var selected_section = $('#section_list').select2('data');

		if (selected_section.length == 0) {
			alert ('Please pick a section first.');
			return false;
		}

		// if (invalid) {
		// 	return false;
		// }



	   	$.ajax({
	       	type: 'POST',
	       	url: '{{ url("additem") }}',
	       	dataType: 'json',
	       	data: {item_id: selected_item[0].id},
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

						"<td> 10 </td>" +
						"<td> 10 </td>" +
						"<td> 10 </td>" +
						"<td> 10 </td>" +
						
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