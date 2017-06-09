@extends('layouts.master')


@section('title', 'Submit A New Request')


@section('content')

{!! Form::model($request, ['action' => 'RequestController@store']) !!}

<div class="page-header">
	<h1>Submit A New Request</h1>
</div>

<div class="form-group">
	{!! Form::label('ris_number', 'RIS Number:')  !!}
	{!! Form::text('ris_number', '',['class' => 'form-control', 'placeholder' => 'Enter Your RIS Number Here', 'autocomplete' => 'off']) !!}
</div>

<div class="form-group">
	{!! Form::label('requested_by_section', 'Requested By Section:')  !!}
	{!! Form::text('requested_by_section', '',['class' => 'form-control', 'placeholder' => 'Section Name', 'autocomplete' => 'off']) !!}
</div>

<div class="form-group">
	{!! Form::label('requested_by_user', 'Requested By:')  !!}
	{!! Form::text('requested_by_user', '',['class' => 'form-control', 'placeholder' => 'What is your name?', 'autocomplete' => 'off']) !!}
</div>

<div class="form-group">
	{!! Form::label('purpose', 'Purpose of Request:')  !!}
	{!! Form::textarea('purpose', '',['class' => 'form-control', 'autocomplete' => 'off']) !!}
</div>

<button type="submit" class="btn btn-success btn-lg">Submit Your Request</button>


{!! Form::close() !!}


@endsection