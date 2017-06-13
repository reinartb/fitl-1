@extends('layouts.master')


@section('title', 'Submit A New Request')


@section('content')

{!! Form::model($request, ['action' => 'RequestController@store']) !!}

<div class="page-header">
	<h1>Submit A New Request</h1>
</div>

@include('requests.partials.object_form')

<button type="submit" class="btn btn-success btn-lg">Submit Your Request</button>


{!! Form::close() !!}


@endsection