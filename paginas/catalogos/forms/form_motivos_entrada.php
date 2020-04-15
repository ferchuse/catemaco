<form class="was-validated " autocomplete="off" id="form_edicion">
	<!-- The Modal -->
	<div class="modal fade" id="modal_edicion">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title text-center"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
					<input type="text" hidden class="form-control" id="id_motivo_entrada" name="id_motivo_entrada">
					<div class="form-group">
						<label for="motivo">Motivo de Entrada</label>
						<input type="text" class="form-control" id="motivo" name="motivo" required>
					</div> 
					
				</div> 
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
					<button type="submit" class="btn btn-outline-success"><i class="fa fa-save"></i> Guardar</button>
				</div>
				
			</div>
		</div>
	</div>
</form>
