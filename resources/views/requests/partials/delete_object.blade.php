<hr>

<h2>Delete this Request:</h2>

{!! Form::open([
	'action' => ['RequestController@destroy', $request->id],
	'method' => 'delete',
	'class' => 'delete-object'
]) !!}

<button type="submit" class="btn btn-danger">Delete this Request</button>

{!! Form::close() !!}