@extends('layouts.master')

@section('title', 'Show Request')

@section('content')
		<h1>Requisition and Issuance Slip Number: {{ $request->ris_number }}</h1>
		<p>{{ $request->requested_by_section }}</p>
		<p>{{ $request->requested_by_user }}</p>
		<p>{{ $request->created_at }}</p>
		<p>{{ $request->purpose }}</p>
@endsection
