@extends('layouts.master')

@section('title', 'About')

@section('content')

<div class="container">

<div class="input-group">
	<span class="input-group-addon"><small>Search Item</small></span>
	<select class="form-control" id="item_list">
	</select>
</div>

</select>
<hr>
<div class="js-example-tags-container"></div>


<hr>


<div class="container">
	<div class="search">
	    <div class="row">
	        <div class="input-group">
	            <span class="input-group-addon"><small>Search Item</small></span>
	            <input type="text" autocomplete="off" id="search" class="form-control" placeholder="Enter Item Name Here">
	        </div>
	    </div>   
	</div>

	<hr>

	<div class="row">
		<div id="txtHint" class="title-color text-center">Items will be listed here.</div>
	</div>
</div>

@endsection


@section('scripts')

	<script>
	$('#item_list').select2({
		placeholder: "Choose tags...",
	    minimumInputLength: 2,

		ajax: {
			url: '{{ url("demos/livesearch") }}',
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