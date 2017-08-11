@extends('layouts.master')


@section('title', 'Item List')

@section('content')

<div class="page-header">

	<a href="{{ route('items.create') }}" class="btn btn-success pull-right">+ Create New Item</a>
	<h1>Items</h1>

</div>


<div class="row">
		<table class="table">
			<thead>
				<th>Item Name</th>
				<th>Created At</th>
				<th>Options</th>
			</thead>
			<tbody>
				@foreach ($items as $item)
					<tr>
						<td>{{ $item->name }}</td>
						<td>{{ Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
						<td><a href="{{ route('items.show', $item->id) }}" >Show</a>
						&nbsp
						<a href="{{ route('items.edit', $item->id) }}">Edit</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	<div class="text-center">
		{{ $items->links() }}
	</div>
</div>



<!-- <div class="list-group">
	@foreach ($items as $item)
		<div class="list-group-item">	
			<div class="row">
				<div class="col-md-8">			
					<h2 class="list-group-item-heading"> {{ $item->name }} </h2>
					<p class="list-group-item-text"> Created At: {{ Carbon\Carbon::parse($item->created_at)->format('F d, Y h:i:s A') }}</p>
				</div>

				<div class="col-md-4">
					<a href="{{ route('items.show', $item->id) }}" class="btn btn-primary">Show</a>
					&nbsp
					<a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
					&nbsp
					@include('items.partials.delete_object')
				</div>

			</div>
		</div>
	@endforeach
</div>
 -->


@endsection