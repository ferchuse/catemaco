<form id="form_gasto" autocomplete="off" class="was-validated">
	<div class="modal " id="modal_gasto">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Nuevo Gasto</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<div class="modal-body">
					<div class="form-group">		
						<label >Concepto:</label>
						<?= generar_select($link, "cat_gastos", "id_cat_gastos", "descripcion_gastos", false, false, true) ?>
					</div>
					<div class="form-group">		
						<label >Importe:</label>
						<input class="form-control" type="number" name="importe" id="importe" required>
					</div>
					<div class="form-group">		
						<label >Recibe:</label>
						<input class="form-control" type="text" name="recibe" id="recibe" required>
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
