<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM gastos_corrida
	LEFT JOIN cat_gastos USING(id_cat_gastos)
	
	WHERE id_corridas = '{$_GET["id_corridas"]}' 
	";
	

	$consulta.= "ORDER BY fecha_gastos ";
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
	?>
	<table class="table table-bordered" id="tabla_registros" width="100%" cellspacing="0">
		<thead>
			<tr>
				
				<th class="text-center">Fecha</th>
				<th class="text-center">Concepto</th>
				<th class="text-center">Importe</th>
			
			</tr>
		</thead>
		<tbody >
			<?php
				while($fila = mysqli_fetch_assoc($result)){ 
					$suma_gastos+= $fila["importe"];
					?>
				
				<tr>
					<td><?php echo $fila["fecha_gastos"];?></td>
					<td><?php echo $fila["descripcion_gastos"];?></td>
					<td>$<?php echo $fila["importe"];?></td>
				
					
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