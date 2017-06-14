
<div class="row">
	<div class="col-md-8">

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('ris_number', 'RIS Number:')  !!}
					{!! Form::text('ris_number', null,['class' => 'form-control', 'placeholder' => 'Enter Your RIS Number Here', 'autocomplete' => 'off']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('requested_by_section', 'Requested By Section:')  !!}
					{!! Form::text('requested_by_section', null,['class' => 'form-control', 'placeholder' => 'Section Name', 'autocomplete' => 'off']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('requested_by_user', 'Requested By:')  !!}
					{!! Form::text('requested_by_user', null,['class' => 'form-control', 'placeholder' => 'What is your name?', 'autocomplete' => 'off']) !!}
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('purpose', 'Purpose of Request:')  !!}
					{!! Form::textarea('purpose', null,[
						'class' => 'form-control', 
						'autocomplete' => 'off',
						'rows' => '8'
					]) !!}
				</div>
			</div>
		</div>

		<hr>

		<div class="form-group">
			{!! Form::label('item_id[]', 'Item List') !!}
			{!! Form::select(
				'item_id[]',
				$item,
				$request->items->pluck('id')->all(),
				[
					'multiple' => true,
					'class' => 'form-control'
				]
			) !!}

		</div>
	</div>

	<div class="col-md-4">
		<h1>The items to be picked will be placed here.</h1>		
	</div>
	
</div>




