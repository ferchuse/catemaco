<?php 
	session_start();
	if(count($_SESSION) == 0){
		die("<div class='alert alert-danger'>Tu Sesión ha caducado, recarga la página.</div>");
	}
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	include('../../../funciones/console_log.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	
	
	$consulta = "SELECT *, nombre_origenes as destino FROM boletos 
	LEFT JOIN precios_boletos USING(id_precio)
	LEFT JOIN origenes ON precios_boletos.id_destinos = origenes.id_origenes
	WHERE id_corridas = '{$_GET["id_corridas"]}'
	ORDER BY id_boletos DESC
	";
  
	
	$result = mysqli_query($link,$consulta);
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			die("<div class='alert alert-danger'>No hay registros</div>");
			
		}
		
	?>  
	<pre hidden>
		<?php echo $consulta;?>
	</pre>
	
	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th hidden ></th>
				<th>Folio Boleto</th>
				<th>Num Asiento</th>
				<th>Nombre Pasajero</th>
				<th>Destino</th>
				<th>Precio</th>
				<th hidden>Origen </th>
				<th hidden>Destino</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				
				while($fila = mysqli_fetch_assoc($result)){
					// console_log($fila);
					$filas = $fila ;
					
				?>
				<tr>
				
					<td><?php echo $filas["id_boletos"]?></td>
					<td><?php echo $filas["num_asiento"]?></td>
					<td><?php echo $filas["nombre_pasajero"];?></td>
					<td ><?php echo $filas["destino"]?></td>
					<td>$<?php echo number_format($filas["precio_boletos"])?></td>
					<td hidden><?php
						echo $filas["estatus_corridas"]."<br>";
						if($filas["estatus_corridas"] == "Cancelado"){
							echo $fila["datos_cancelacion"];
							
						}
					?></td>
				</tr>
				
				<?php
					$boletos_vendidos++;;
					$total_guia+= $filas["precio_boletos"];
					
				}
			?>
			
			<tr hidden>
				<td colspan="4"> TOTALES</td>
				<td><?php echo number_format($total_saldo_unidades);?></td>
				<td><?php echo number_format($total_ingresos);?></td>
				<td><?php echo number_format($total_cargos);?></td>
				<td><?php echo number_format($ingresos)?></td>
				
			</tr>
		</tbody>
	</table>
	
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label>Boletos Vendidos</label>
				<input type="" class="form-control" readonly  id="boletos_vendidos" value="<?php echo mysqli_num_rows($result)?>">
			</div>
		</div>
		<div class="col-6">
			<Div class="form-group">
				<label>Total Guia</label>
				<input type="" class="form-control" readonly   id="total_guia" value="<?php echo $total_guia?>">	
			</div>
		</div>
	</div>
	<?php
		
	}
	
	else {
		echo "Error en ".$consulta.mysqli_Error($link);
		
	}
	
	
?>		