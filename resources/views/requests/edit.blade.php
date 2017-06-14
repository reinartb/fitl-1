@extends('layouts.master')


@section('title', 'Edit a Request')


@section('content')


<div class="page-header">
	<h1>Edit a Request</h1>
</div>

{!! Form::model($request, 
	[
		'action' => ['RequestController@update', $request->id],
		'method' => 'put',
		'style' => 'display: inline;'
	]) !!}

@include('requests.partials.object_form')

<button type="submit" class="btn btn-success">Update The Request</button>

{!! Form::close() !!}

@include('requests.partials.delete_object')

@endsection