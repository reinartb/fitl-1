
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{!! Form::label('short_name', 'Section Code:') !!}
			{!! Form::text('short_name', null, 
				[
					'class' => 'form-control',
					'placeholder' => 'Enter the Section Code Here',
					'autocomplete' => 'off'
				]) 
			!!}
		</div>

		<div class="form-group">
			{!! Form::label('long_name', 'Section Name (Full):') !!}
			{!! Form::text('long_name', null, 
				[
					'class' => 'form-control',
					'placeholder' => 'Enter the Section\'s Full Name Here',
					'autocomplete' => 'off'
				]) 
			!!}

		</div>
	</div>
</div>