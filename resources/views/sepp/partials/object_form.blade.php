<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<!-- <div class="input-group"> -->
				<label>Search Item</label>
				<select class="form-control" name="item_id" id="item_list_sepp" style="width: 100%">
				</select>
			<!-- </div> -->
		</div>

		<div class="form-group">
			<label>Search Section</label>
			<select class="form-control" name="section_id" id="section_list_sepp" style="width: 100%">
			</select>
		</div>

		<hr>

		<div class="form-group">
			{!! Form::label('year', 'Year:') !!}
			{!! Form::number('year', null, 
				[
					'class' => 'form-control',
					'placeholder' => 'Enter the year here.',
					'autocomplete' => 'off'
				]) 
			!!}
		</div>

	</div>
</div>

<div class="row">
	<div class="col-md-6">
		
		<div class="form-group">
			{!! Form::label('q1_quantity', 'Q1 SEPP:') !!}
			{!! Form::number('q1_quantity', null, 
				[
					'class' => 'form-control',
					'placeholder' => 'Enter the item\'s Q1 SEPP value.',
					'autocomplete' => 'off'
				])
			!!}
		</div>

		<div class="form-group">
			{!! Form::label('q2_quantity', 'Q2 SEPP:') !!}
			{!! Form::number('q2_quantity', null, 
				[
					'class' => 'form-control',
					'placeholder' => 'Enter the item\'s Q2 SEPP value.',
					'autocomplete' => 'off'
				])
			!!}
		</div>
	</div>
	<div class="col-md-6">

		<div class="form-group">
			{!! Form::label('q3_quantity', 'Q3 SEPP:') !!}
			{!! Form::number('q3_quantity', null, 
				[
					'class' => 'form-control',
					'placeholder' => 'Enter the item\'s Q3 SEPP value.',
					'autocomplete' => 'off'
				])
			!!}
		</div>

		<div class="form-group">
			{!! Form::label('q4_quantity', 'Q4 SEPP:') !!}
			{!! Form::number('q4_quantity', null, 
				[
					'class' => 'form-control',
					'placeholder' => 'Enter the item\'s Q4 SEPP value.',
					'autocomplete' => 'off'
				])
			!!}
		</div>
	</div>

</div>