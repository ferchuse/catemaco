
<form id="form_edicion" autocomplete="off" class="was-validated">
	<div class="modal " id="modal_edicion">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Nuevo Registro</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
					
					<input hidden name="id_personal" id="id_personal" value="">
					
					<div class="row">
						<div class="col-sm-6">
							
							<div class="form-group">
								<label>Nombre:</label>		
								<input class="form-control" name="nombre" id="nombre" required>
							</div>
							<div class="form-group">
								<label>CURP:</label>		
								<input class="form-control" name="curp" id="curp" required>
							</div>
							<div class="form-group">
								<label>Contraseña:</label>		
								<input class="form-control" type="password" name="password" id="password" required>
							</div>
							
							<div class="form-group">
								<label>RFC:</label>		
								<input class="form-control" name="rfc" id="rfc" >
							</div>
							
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Profesión: </label>		
								<input class="form-control" name="profesion" id="profesion" >
							</div>
							
							<div class="form-group">
								<label>Puesto: </label>		
								<input class="form-control" name="puesto" id="puesto" >
							</div>
								
							<div class="form-group">
								<label>Telefono:</label>		
								<input class="form-control" type="tel" name="telefono" id="telefono" >
							</div>
							<div class="form-group">
								<label >Estatus:</label>
								<select class="form-control" id="estatus" name="estatus" required>
									
									<option selected >Activo</option>
									<option  >Inactivo</option>
								</select>
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
