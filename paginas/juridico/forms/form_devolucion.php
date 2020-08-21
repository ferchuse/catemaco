
<form id="form_salida" autocomplete="off" class="was-validated">
	<div class="modal " id="modal_salida">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Salida de Documento</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
					
					<input hidden name="id_archivo" id="salida_id_archivo" value="">
					
					<div class="row">
						<div class="col-sm-12">
							
							<div class="form-group">
								<label>Nombre Documento :</label>		
								<input class="form-control" readonly type="text" id="salida_nombre" >
							</div>
							<div class="form-group">
								<label>Fecha :</label>		
								<input class="form-control" type="date" name="fecha" id="fecha" required value="<?= date("Y-m-d")?>">
							</div>
							<div class="form-group">
								<label >Solicita:</label>
								<?php echo generar_select($link, "personal", "id_personal", "nombre", false, false, true); ?>
							</div>
							<div class="form-group">
								<label>Contraseña:</label>		
								<input class="form-control" autocomplete="off"  type="password" name="password" id="password" required>
							</div>
							<div class="form-group">
								<label>A donde sale:</label>		
								<input class="form-control" type="text" name="lugar" id="lugar" required>
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
