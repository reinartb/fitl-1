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


@endsection