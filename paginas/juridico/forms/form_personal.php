
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
					
					<input hidden name="id_archivo" id="id_archivo" value="">
					
					<div class="row">
						<div class="col-sm-6">
							
							<div class="form-group">
								<label>Nombre:</label>		
								<input class="form-control" name="nombre" id="nombre" required>
							</div>
							<div class="form-group">
								<label>Contraseña:</label>		
								<input class="form-control" name="password" id="password" required>
							</div>
							<div class="form-group">
								<label>CURP:</label>		
								<input class="form-control" name="curp" id="curp" required>
							</div>
							
							<div class="form-group">
								<label>RFC:</label>		
								<input class="form-control" name="rfc" id="rfc" required>
							</div>
							<div class="form-group">
								<label>Profesión: </label>		
								<input class="form-control" name="profesion" id="profesion" required>
							</div>
							
							<div class="form-group">
								<label>Puesto: </label>		
								<input class="form-control" name="profesion" id="profesion" required>
							</div>
							
						</div>
						
						
						<div class="col-sm-6">
							<div class="form-group">
								<label >Estatus:</label>
								<select class="form-control" id="estatus" name="estatus" required>
									<option value="">Seleccione</option>
									<option  >En Trámite</option>
									<option  >En Archivo</option>
								</select>
							</div>
							<div class="form-group">
								<label>Ubicación </label>		
								<input class="form-control" name="ubicacion" id="ubicacion" >
							</div>
							<div class="form-group">
								<label>A donde Salió </label>		
								<input class="form-control" name="lugar_salida" id="lugar_salida" >
							</div>
							<div class="form-group">
								<label >Copia:</label>
								<select class="form-control" id="copia" name="copia" required>
									<option value="">Seleccione</option>
									<option  >Original</option>
									<option  >Copia</option>
									<option  >Copia Certificada</option>
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
