
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
								<label >NOMBRE:</label>
								<select class="form-control" id="sector" name="sector" required>
									<option value="">Seleccione</option>
									<option  >Jurídico</option>
									<option  >Gestoría</option>
								</select>
							</div>
							<div class="form-group">
								<label >Jurisdicción:</label>
								<select class="form-control" id="jurisdiccion" name="jurisdiccion" required>
									<option value="">Seleccione</option>
									<option  >Estatal</option>
									<option  >Federal</option>
								</select>
							</div>
							<div class="form-group">
								<label>Nombre </label>		
								<input class="form-control" name="nombre" id="nombre" required>
							</div>
							<div class="form-group">
								<label>Descripción </label>		
								<textarea class="form-control" name="descripcion" id="descripcion" required></(textarea>
							</div>
							
							<div class="form-group">
								<label>Empresa </label>		
								<?php echo generar_select($link, "empresas", "id_empresas", "nombre_empresas", false); ?>
							</div>
							
							<div class="form-group">
								<label>Tipo Documento </label>		
								<?php echo generar_select($link, "tipo_documento", "id_documento", "tipo_documento", false); ?>
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
							<div class="form-group">
								<span class="btn btn-success fileinput-button">
									<i class="fas fa-upload"></i> Cargar Archivo
									<input class="fileupload" type="file" accept="image/*" name="files[]" data-url="../../fileupload/server_upload.php" >
								</span>
								
								<div class="progress " >
									<div class="progress-bar progress-bar-striped active" >
									</div>
								</div>	
								<a id="link_imagen">
									<img id="foto_thumb" class="w-50">
								</a>
								<input class="url" id="foto" type="hidden" name="foto" >
								
								
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
