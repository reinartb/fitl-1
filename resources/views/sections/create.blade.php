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

@include('sections.partials.object_form')

<button type="submit" class ="btn btn-success">Create Section</button>

{!! Form::close() !!}

@endsection