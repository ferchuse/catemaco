<form class="was-validated " id="form_salida" autocomplete>
	<!-- The Modal -->
	<div class="modal fade" id="modal_salida">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				
				<!-- Modal Header -->
				<div class="modal-header">
					<h5 class="modal-title text-center"></h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
					<input type="text" hidden class="form-control" id="id_deposito" name="id_deposito">
					<div class="form-group">
						<label for="id_empresas">EMPRESA</label>
						<?php echo generar_select($link, "empresas", "id_empresas", "nombre_empresas", false, false, true, $_SESSION["id_empresas"]); ?>
					</div>
					<div class="form-group">
						<label for="id_beneficiarios">BENEFICIARIO</label>
						<?php echo generar_select($link, "beneficiarios", "id_beneficiarios", "nombre_beneficiarios",  false, false, true); ?>
					</div> 
					
					<div class="form-group">
						<label for="id_motivo_entrada">Motivo:</label>
						<?php echo generar_select($link, "motivos_entrada", "id_motivo_entrada", "motivo",  false, false, true); ?>
					</div> 
					<div class="form-group">
						<label for="concepto">Concepto:</label>
						<input type="text" class="form-control" id="concepto" name="concepto" required>
					</div> 
					<div class="form-group">
						<label for="monto">MONTO</label>
						<input type="number" class="form-control" id="monto" name="monto" required step="any">
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
