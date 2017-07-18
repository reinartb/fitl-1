
<!-- <div class="row">
	<div class="col-md-6"> -->
		<div class="form-group">
			{!! Form::label('ris_number', 'RIS Number:')  !!}
			{!! Form::text('ris_number', null,['class' => 'form-control', 'placeholder' => 'Enter Your RIS Number Here', 'autocomplete' => 'off']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('requested_by_section', 'Requested By Section:')  !!}
			
			<br>

			<select class="form-control" name="requested_by_section" id="section_list" style="width: 100%">
				@if ($request->requested_by_section)
					<option value="{{ $request->requested_by_section }}">Samples</option>
				@endif

			</select>

		</div>

		<div class="form-group">
			{!! Form::label('requested_by_user', 'Requested By:')  !!}
			{!! Form::text('requested_by_user', null,['class' => 'form-control', 'placeholder' => 'What is your name?', 'autocomplete' => 'off']) !!}
		</div>
	<!-- </div> -->

<!-- 	<div class="col-md-6"> -->
		<div class="form-group">
			{!! Form::label('purpose', 'Purpose of Request:')  !!}
			{!! Form::textarea('purpose', null,[
				'class' => 'form-control', 
				'autocomplete' => 'off',
				'rows' => '8'
			]) !!}
		</div>
<!-- 	</div>
</div> -->

<hr>





