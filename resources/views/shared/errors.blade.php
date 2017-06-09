@if ( count(session('errors')) > 0 )
	<div class="alert alert-danger">
		@foreach (session('errors')->all() as $error)
		{{ $error }}<br>
		@endforeach	
	</div>
@endif