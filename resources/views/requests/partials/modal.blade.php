<!-- Modal -->
<div class="modal fade" id="seppModal" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
		<div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			    <h4 class="modal-title">Add New SEPP</h4>
			</div>
		    <div class="modal-body" style="overflow: hidden;">
		    	@include('sepp.partials.object_form')

		    </div>
		    <div class="modal-footer">
		    	<button type="button" id="add-sepp" class="btn btn-success">Add SEPP</button>
		    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
		</div>
	</div>
</div>

<div class="modal fade" id="itemModal" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
		<div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			    <h4 class="modal-title">Add New Item</h4>
			</div>
		    <div class="modal-body" style="overflow: hidden;">
		    	@include('items.partials.object_form')

		    </div>
		    <div class="modal-footer">
		    	<button type="button" id="add-item" class="btn btn-success">Add Item</button>
		    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
		</div>
	</div>
</div>