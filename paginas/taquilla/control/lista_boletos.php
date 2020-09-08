<?php 
	
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	include('../../../funciones/dame_permiso.php');
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
				<th ></th>
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
					
					$filas = $fila ;
					
				?>
				<tr>
					<td>
						<?php if($fila["estatus_boletos"] != 'Cancelado'){
							$total_guia+= $filas["precio_boletos"];
						?>
						
						<button class="btn btn-info imprimir" title="Reimprimir"     data-id_registro='<?php echo $filas["id_boletos"]?>'>
							<i class="fas fa-print"></i>
						</button>	
						<?php
							if(dame_permiso("venta_boletos.php", $link) == 'Supervisor'){
							?>
							<button class="btn btn-danger cancelar" title="Cancelar"     data-id_registro='<?php echo $filas["id_boletos"]?>'>
								<i class="fas fa-times"></i>
							</button>	
							
							<?php
							}
						}
						elseif($fila["estatus_boletos"] == 'Cancelado'){
							
							echo "<span class='badge badge-danger'>".$filas["estatus_boletos"]."</span>";
							echo "<small >".$filas["datos_cancelacion"]."</small>";
							
						}
						
						?>
					</td>
					<td><?php echo $filas["id_boletos"]?></td>
					<td><?php echo $filas["num_asiento"]?></td>
					<td><?php echo $filas["nombre_pasajero"];?></td>
					<td ><?php echo $filas["destino"]?></td>
					<td>$<?php echo number_format($filas["precio_boletos"])?></td>
					
				</tr>
				
				<?php
					$boletos_vendidos++;;
					
					
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