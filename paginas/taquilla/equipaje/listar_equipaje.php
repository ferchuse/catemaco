<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM equipaje
	LEFT JOIN usuarios USING(id_usuarios)
	
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
				<th class="text-center">Importe</th>
			
			</tr>
		</thead>
		<tbody >
			<?php
				while($fila = mysqli_fetch_assoc($result)){ 
					$suma_importe+= $fila["importe"];
					?>
				
				<tr>
					
					<td><?php echo $fila["id_equipaje"];?></td>
					<td><?php echo $fila["tipo_equipaje"];?></td>
					<td><?php echo $fila["pasajero"];?></td>
					<td>$<?php echo $fila["importe"];?></td>
				
					
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