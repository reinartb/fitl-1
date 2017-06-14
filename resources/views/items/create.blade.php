@extends('layouts.master')

@section('title', 'Create A New Item')

@section('content')

<div class="page-header">
	<h1>Edit Item</h1>
</div>

{!! Form::model($item, 
	[
		'route' => ['items.store', $item->id],
		'style' => 'display: inline;'
	]) !!}

@include('items.partials.object_form')

<button type="submit" class="btn btn-success">Create Item</button>

{!! Form::close() !!}

@endsection