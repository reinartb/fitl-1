{!! Form::open([
	'action' => ['RequestController@search', $request->id],
	'method' => 'get'
])  !!}

<div class="form-group">
	{!! Form::label('q', 'Search Items:')  !!}
	{!! Form::text('q', null,[
		'class' => 'form-control', 
		'placeholder' => 'Search For . . .', 
		'autocomplete' => 'off'
	]) !!}

	<button class="btn btn-default" type="submit">Search</button>

</div>

{!! Form::close() !!}