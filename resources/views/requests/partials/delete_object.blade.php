{!! Form::open([
	'action' => ['RequestController@destroy', $request->id],
	'method' => 'delete',
	'class' => 'delete-object',
	'style' => 'display: inline;'
]) !!}

<button type="submit" class="btn btn-danger">Delete this Request</button>

{!! Form::close() !!}