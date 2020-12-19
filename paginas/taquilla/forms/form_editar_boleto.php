<form class="was-validated " id="form_editar_boleto" autocomplete="off">
	<!-- The Modal -->
	<div class="modal fade" id="modal_editar_boleto">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title text-center">Editar Boleto</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
					
					
					
					<div class="form-group">
						<label for="">Folio:</label> <br>
						<input  class="form-control" type="number" name="id_boletos" readonly> 
					</div>
					
					<div class="form-group">
						<label for="">Num Asiento</label> <br>
						<input  class="form-control" type="number" name="num_asiento" autofocus> 
					</div>
					
					
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
					<i class="fas fa-times"></i> Cancelar</button>
					<button type="submit" id="btn_guardar_tarjeta" class="btn btn-success">
						<i class="fas fa-check"></i> Aceptar
					</button>
				</div>
				
			</div>
		</div>
	</div>
</form>
