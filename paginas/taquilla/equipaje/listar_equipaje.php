<?php 
	
	include('../../../conexi.php');
	include('../../../funciones/dame_permiso.php');
	$link = Conectarse();
	$suma_importe = 0;
	$consulta = "SELECT * FROM equipaje
	LEFT JOIN usuarios USING(id_usuarios)
	
	WHERE DATE(fecha_equipaje) = '{$_GET["fecha"]}'
	";
	
	
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
	?>
	<table class="table table-bordered" id="tabla_registros" width="100%" cellspacing="0">
		<thead>
			<tr>
				
				
				<th class="text-center">Folio</th>
				<th class="text-center">Concepto</th>
				<th class="text-center">Pasajero</th>
				<th class="text-center">Tamaño</th>
				<th class="text-center">Importe</th>
				<th class="text-center">Usuario</th>
				<th class="text-center"></th>
				
			</tr>
		</thead>
		<tbody >
			<?php
				while($fila = mysqli_fetch_assoc($result)){ 
					
				?>
				
				<tr>
					
					<td><?php echo $fila["id_equipaje"];?></td>
					<td><?php echo $fila["tipo_equipaje"];?></td>
					<td><?php echo $fila["pasajero"];?></td>
					<td><?php echo $fila["tipo_equipaje"];?></td>
					<td>$<?php echo $fila["importe"];?></td>
					<td><?php echo $fila["nombre_usuarios"];?></td>
					<td>
						<?php 
							
							if(dame_permiso("equipaje.php", $link) == 'Supervisor' AND $fila["estatus"] != "Cancelado"){
							?>
							<button class="btn btn-danger btn_cancelar" title="Cancelar"     data-id_registro='<?php echo $fila["id_equipaje"]?>'>
								<i class="fas fa-times"></i>
							</button>	
							<?php
							}
							if($fila["estatus"] == "Cancelado"){
								
								echo "<span class='badge badge-danger'>".$fila["estatus"]. "<br>". $fila["datos_cancelacion"]."</span>";
								
							}
							else{
								$suma_importe+= $fila["importe"];
								
							}
						?>
						
					</td>
					
					
				</tr>
				
				<?php 	
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td >
					<?php echo mysqli_num_rows($result);?> Registro(s).
				</td>
				<td ><B> Total Equipaje</b></td>
				<td ></td>
				<td ></td>
				<td >
					$<?php echo number_format($suma_importe,2);?>
				</td>
			</tr>
		</tfoot>
	</table>
	
	
	<?php
		
		
	}
	else {
		echo "Error en".$consulta. mysqli_error($link);
	}
	
	
?>	