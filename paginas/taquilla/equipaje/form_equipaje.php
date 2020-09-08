<form id="form_equipaje" autocomplete="off" class="was-validated">
	<div class="modal " id="modal_equipaje">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Equipaje Extra</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<div class="modal-body">
					<div class="form-group">		
						<label >Corrida:</label>
						<select required class="form-control" id="equipaje_id_corridas" name="id_corridas" required>
								<option value="">Elige...</option>
							<?php foreach($corridas as $corrida ){?>
							
								<option value="<?= $corrida["id_corridas"]?>">
									<?= date("d-m-Y", strtotime($corrida["fecha_corridas"]))." Eco: ".$corrida["num_eco"] ?>
									
								</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">		
						<label >Tamaño:</label>
						<select required class="form-control" id="tipo_equipaje" name="tipo_equipaje" required>
							
							<option value="">Elige...</option>
							<option data-precio="170">MOCHILA GRANDE $170</option>
							<option data-precio="110">MOCHILA MEDIANA $110</option>
							<option data-precio="90">MOCHILA PEQUEÑA $90</option>
							<option data-precio="340">MALETA GRANDE $340</option>
							<option data-precio="240">MALETA MEDIANA $240</option>
							<option data-precio="140">MALETA PEQUEÑA $140</option>
						</select>
					</div>
					<div class="form-group">		
						<label >Importe:</label>
						<input class="form-control" type="number" name="importe" id="importe" readonly>
					</div>
					<div class="form-group">		
						<label >Pasajero:</label>
						<input class="form-control" type="text" name="pasajero" id="pasajero" required>
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
