@extends('layouts.master')

@section('title', 'Show Section')

@section('content')

<div class="page-header">
	<a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning pull-right">Edit Section</a>
	<h1>{{ $section->long_name }}</h1>
</div>


<div class="row">
	<div class="col-md-3">
		<h3><strong>Section Details</strong></h3>
		<p></p>
	</div>
	<div class="col-md-9">
		<table class="table table-bordered">
			<thead>
				<th>Code</th>
				<th>Name</th>
				<th>Created At</th>
			</thead>
			<tbody>
				<tr>
					<td>{{ $section->short_name }}</td>
					<td>{{ $section->long_name }}</td>
					<td>{{ Carbon\Carbon::parse($section->created_at)->format('F d, Y') }}</td>
				</tr>
			</tbody>

		</table>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-3">
		<h3><strong>SEPP Log</strong></h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum mauris nibh, eget consequat diam mollis porta. Quisque accumsan hendrerit sapien, suscipit gravida ligula lobortis feugiat. Quisque enim augue, consequat sed ipsum id, molestie fringilla neque. Donec ac diam malesuada, venenatis dui nec, placerat ipsum.</p>
	</div>
	<div class="col-md-9">
		<table class="table table-bordered">
			<thead>
				<th>Item</th>
				<th>Year</th>
				<th>Q1</th>
				<th>Q2</th>
				<th>Q3</th>
				<th>Q4</th>
			</thead>
			<tbody>
				@foreach($sepp as $s)
					<tr>
						<td><a href="{{ route('items.show', $s->item->id) }}">{{ $s->item->name }}</a></td>
						<td>{{ $s->year }} </td>
						<td>{{ $s->q1_quantity }}</td>
						<td>{{ $s->q2_quantity }}</td>
						<td>{{ $s->q3_quantity }}</td>
						<td>{{ $s->q4_quantity }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-3">
		<h3><strong>Request Log</strong></h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum mauris nibh, eget consequat diam mollis porta. Quisque accumsan hendrerit sapien, suscipit gravida ligula lobortis feugiat. Quisque enim augue, consequat sed ipsum id, molestie fringilla neque. Donec ac diam malesuada, venenatis dui nec, placerat ipsum.</p>
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-md-4">

			<?php $count = 1;?>

			@foreach ($requests as $r)
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="text-center">RIS Number: <a href="{{ action('RequestController@show', $r->id) }}">{{ $r->ris_number }}</a></div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6 text-center">
								<strong>Requested By:</strong> 
								<br>{{ $r->requested_by_user }}
							</div>
							<div class="col-md-6 text-center">
								<strong>Requested At:</strong> 
								<br>{{ Carbon\Carbon::parse($r->created_at)->format('F d, Y') }}
							</div>
						</div>
					</div>
							
					<table class="table table-bordered">						
						<thead>
							<th>Item</th>
							<th>Quantity Requested</th>
						</thead>
						<tbody>
							@foreach($r->items as $i) 
								<tr>
									<td><a href="{{ route('items.show', $i->id) }}">{{ $i->name }}</a></td>
									<td>{{ $i->pivot->quantity_requested }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<?php if($count %ceil($section->requests()->count() ) != 0 ): ?>

		                </div>

		                <div class="col-sm-4">

		        <?php endif; $count++;?>

			@endforeach
			</div>
		</div>
	{{ $requests->links() }}
	</div>
</div>

@endsection
