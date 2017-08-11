@extends('layouts.master')


@section('title', 'Edit Section')

@section('content')

<div class="page-header">
	<h1>Edit Section</h1>
</div>

{!! Form::model($section, 
	[
		'route' => ['sections.update', $section->id],
		'method' => 'put',
		'style' => 'display: inline;'
	]) !!}

@include('sections.partials.object_form')

<button type="submit" class="btn btn-success">Update Section</button>

{!! Form::close() !!}

{!! Form::open([
	'route' => ['sections.destroy', $section->id],
	'method' => 'delete',
	'class' => 'delete-object',
	'style' => 'display: inline;'
]) !!}

	<button type="submit" class="btn btn-danger">Delete</button>

{!! Form::close() !!}

@endsection