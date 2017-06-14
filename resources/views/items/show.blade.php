@extends('layouts.master')

@section('title', 'Show Item')

@section('content')
		<div class="page-header">
			<a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning pull-right">Edit Item</a>
			<h1>{{ $item->name }}</h1>
		</div>

		<div class="list-group">
			<div class="list-group-item">
				<h4>Created At:</h4>
				<p>{{ Carbon\Carbon::parse($item->created_at)->format('F d, Y h:i:s A') }}</p>
			</div>
		</div>
@endsection
