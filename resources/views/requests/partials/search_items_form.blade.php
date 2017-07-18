

{{ Form::open([
	'method'=>'post',
	'id'=>'addrequest'
	]) }}

	<div class="form-group">
		<!-- <div class="input-group"> -->
			<label>Search Item</label>
			<div class="row">
				<div class="col-md-8">
					<select class="form-control" name="item_id" id="item_list" style="width: 100%">
					</select>
				</div>
				
				<div class="col-md-4">
					<div class="text-center">
						{{Form::submit('Add to Request', ['name'=>'addrequest', 'class'=>'btn btn-success btn-block'])}}
					</div>
				</div>
			</div>
		<!-- </div> -->
	</div>


{!! Form::close() !!}


<hr>

<h3>Items Requested</h3>
<table class="table clickable-row">
	<thead>
		<th>Item ID</th>
		<th>Item Name</th>
		<th>Quantity Requested </th>
		<th>Options</th>
	</thead>
	<tbody id="search-results-table">
		@foreach ($request->items as $item)
			<tr> 
				<td> {{ $item->id }} </td> 
				<td> {{ $item->name }} </td> 
				<td> <input type="number" item-id="{{ $item->id }}" value="{{ $item->pivot->quantity_requested }}"> </td>
				<td> <button id="item-delete-{{ $item->id}}" class="btn btn-danger btn-sm"> Delete</button></td> 
			</tr>
		@endforeach
	</tbody>
</table>


