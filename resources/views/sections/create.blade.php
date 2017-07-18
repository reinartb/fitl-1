@extends('layouts.master')

@section('title', 'Add A New Section')

@section('content')

<div class="page-header">
	<h1>Add a New Section</h1>
</div>

{!! Form::model ($section, 
	[
		'route' => ['sections.store', $section->id],
		'style' => 'display: inline;'
	]) !!}

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{!! Form::label('short_name', 'Section Code:') !!}
			{!! Form::text('short_name', null, 
				[
					'class' => 'form-control',
					'placeholder' => 'Enter the Section Code Here',
					'autocomplete' => 'off'
				]) 
			!!}
		</div>

		<div class="form-group">
			{!! Form::label('long_name', 'Section Name (Full):') !!}
			{!! Form::text('long_name', null, 
				[
					'class' => 'form-control',
					'placeholder' => 'Enter the Section\'s Full Name Here',
					'autocomplete' => 'off'
				]) 
			!!}

		</div>
	</div>
</div>

<button type="submit" class ="btn btn-success">Create Section</button>

{!! Form::close() !!}

@endsection