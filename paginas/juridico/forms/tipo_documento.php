
<form id="form_edicion" autocomplete="off" class="was-validated">
	<div class="modal " id="modal_edicion">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tipo de Documento</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
					
					<input hidden name="id_documento" id="id_documento" value="">
					
					<div class="row">
						<div class="col-sm-12">
							
							<div class="form-group">
								<label>Tipo de Documento :</label>		
								<input class="form-control" type="text" id="tipo_documento" name="tipo_documento" >
							</div>
													
						</div>
					</div>
				</div>
				
				
				
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
					<i class="fas fa-times"></i> Cancelar</button>
					<button type="submit" class="btn btn-success " >
					<i class="fas fa-save"></i> Guardar </button>
				</div>
			</div>
		</div>
	</div>
</form>		
