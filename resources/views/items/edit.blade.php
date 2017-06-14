@extends('layouts.master')


@section('title', 'Edit Item')

@section('content')

<div class="page-header">
	<h1>Edit Item</h1>
</div>

{!! Form::model($item, 
	[
		'route' => ['items.update', $item->id],
		'method' => 'put',
		'style' => 'display: inline;'
	]) !!}

@include('items.partials.object_form')

<button type="submit" class="btn btn-success">Update Item</button>

{!! Form::close() !!}

@include('items.partials.delete_object')

@endsection