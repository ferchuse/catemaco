<form class="was-validated " id="form_propietario">
	<!-- The Modal -->
	<div class="modal fade" id="modal_propietario">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title text-center"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
					<input type="text" hidden class="form-control" id="id_propietarios" name="id_propietarios">
					<div class="form-group">
						<label for="nombre_propietarios">Nombre</label>
						<input type="text" class="form-control" id="nombre_propietarios" name="nombre_propietarios" required>
					</div> 
					<div class="form-group">
						<label for="estatus">Estatus</label>
						<select class="form-control" id="estatus" name="estatus">
							<option value="">Seleccione:</option>
							<option selected value="Activo">Activo</option>
							<option value="Inactivo">Inactivo</option>
						</select>
					</div> 
					<div class="form-group">
						<label for="id_empresas">Empresa</label>
						<?php echo generar_select($link, "empresas", "id_empresas", "nombre_empresas", false, false, true);?>
					</div> 
					<?php if(dame_permiso("propietarios.php", $link) == 'Supervisor'){ ?>
						<div class="form-group">
							<label for="usuario_propietarios">USUARIO:</label>
							<input type="text" class="form-control" id="usuario_propietarios" name="usuario_propietarios" >
						</div> 
						<div class="form-group">
							<label for="password_propietarios">CONTRASEÑA:</label>
							<input type="text" class="form-control" id="password_propietarios" name="password_propietarios" >
						</div> 
						<?php 
						}
					?>
					
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
