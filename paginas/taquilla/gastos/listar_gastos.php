<?php 
	
	include('../../../conexi.php');
	include('../../../funciones/dame_permiso.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM gastos_corrida
	LEFT JOIN cat_gastos USING(id_cat_gastos)
	WHERE id_corridas = '{$_GET["id_corridas"]}' 
	";
	
	
	if($_GET["id_usuarios"] != ""){
		$consulta.=" AND gastos_corrida.id_usuarios = '{$_GET["id_usuarios"]}' ";
	}
	
	
	$consulta.= " ORDER BY fecha_gastos ";
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
	?>
	<table class="table table-bordered" id="tabla_registros" width="100%" cellspacing="0">
		<thead>
			<tr>
				
				
				<th class="text-center">Folio</th>
				<th class="text-center">Concepto</th>
				<th class="text-center">Importe</th>
				
			</tr>
		</thead>
		<tbody >
			<?php
				while($fila = mysqli_fetch_assoc($result)){ 
					
					
				?>
				
				<tr>
					
					<td><?php echo $fila["id_gastos"];?></td>
					<td><?php echo $fila["descripcion_gastos"];?></td>
					<td>$<?php echo $fila["importe"];?></td>
					
					
					<td>
						<?php
							if($fila["estatus_gastos"] == "Cancelado"){
								echo "<span class='badge badge-danger'>{$fila["datos_cancelacion"]}</span>";
							}
							else{
								
								$suma_gastos+= $fila["importe"];
								
								if(dame_permiso("venta_boletos.php", $link) == 'Supervisor'){
								?>
								<button class="btn btn-danger cancelar_gasto" title="Cancelar"     data-id_registro='<?php echo $fila["id_gastos"]?>'>
									<i class="fas fa-times"></i>
								</button>	
								
								<?php 	
								}
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
		<?php echo mysqli_num_rows($result);?> Registros.
		</td>
		<td ><B> Total Gastos</b></td>
		<td >
		$<?php echo number_format($suma_gastos);?>.
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