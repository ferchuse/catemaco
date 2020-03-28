<form id="form_paquetes" autocomplete="off" class="was-validated">
	<div class="modal " id="modal_paquetes">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Nuevo Paquete</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<div class="modal-body">
					<div class="form-group">		
						<label >Taquilla Destino:</label>
							<?= generar_select($link, "taquillas", "id_taquilla", "nombre_taquilla", false, false, true) ?>
					</div>
					
					<div class="form-group">		
						<label >Destinatario:</label>
						<input class="form-control" type="text" name="destinatario" id="destinatario" required>
					</div>
					<div class="form-group">		
						<label >Contenido:</label>
						<input class="form-control" type="text" name="contenido" id="contenido" required>
					</div>
					<div class="form-group">		
						<label >Costo:</label>
						<input class="form-control" type="number" name="costo" id="costo" required>
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
