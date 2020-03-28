<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM paquetes
	LEFT JOIN taquillas ON taquillas.id_taquilla = paquetes.id_taquilla_destino
	
	WHERE id_corridas = '{$_GET["id_corridas"]}' 
	";
	

	$consulta.= "ORDER BY id_paquetes ";
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
	?>
	<table class="table table-bordered" id="tabla_registros" width="100%" cellspacing="0">
		<thead>
			<tr>
				
				<th class="text-center">Folio</th>
				<th class="text-center">Taquilla Destino</th>
				<th class="text-center">Costo</th>
			
			</tr>
		</thead>
		<tbody >
			<?php
				while($fila = mysqli_fetch_assoc($result)){ 
					$suma_paquetes+= $fila["costo"];
					?>
				
				<tr>
					<td><?php echo $fila["id_paquetes"];?></td>
					<td><?php echo $fila["nombre_taquilla"];?></td>
					<td>$<?php echo $fila["costo"];?></td>
				
					
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
				<td ><B> Total Paquetes</b></td>
				<td >
					$<?php echo number_format($suma_paquetes);?>.
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