{!! Form::open([
	'route' => ['items.destroy', $item->id],
	'method' => 'delete',
	'class' => 'delete-object',
	'style' => 'display: inline;'
]) !!}

<button type="submit" class="btn btn-danger">Delete This Item</button>

{!! Form::close() !!}