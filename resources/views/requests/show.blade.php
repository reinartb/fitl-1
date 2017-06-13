@extends('layouts.master')

@section('title', 'Show Request')

@section('content')

		<div class="page-header">
			<a href="{{ action('RequestController@edit', $request->id) }}" class="btn btn-warning pull-right">Edit Request</a>
			<h1>Requisition and Issuance Slip Number: {{ $request->ris_number }}</h1>
		</div>

		<p>Requested By Section: {{ $request->requested_by_section }}</p>
		<p>Requested By User: {{ $request->requested_by_user }}</p>
		<p>Requested At: {{ $request->created_at }}</p>
		<p>Request Purpose: {{ $request->purpose }}</p>
@endsection
