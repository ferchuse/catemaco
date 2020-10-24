<?php 
	
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	include('../../../funciones/console_log.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	
	function dame_permiso($url_paginas,$link){
		
		// return false;
		$consulta = "SELECT * FROM permisos LEFT JOIN paginas USING(id_paginas) 
		WHERE url_paginas = '$url_paginas' 
		AND id_usuarios = {$_COOKIE["id_usuarios"]}";
		
		
		$result = mysqli_query($link, $consulta) or die("Error dame_permiso($consulta) ". mysqli_error($link));
		
		if(mysqli_num_rows($result) > 0){
			while($fila = mysqli_fetch_assoc($result)){
				
				$respuesta= $fila["permiso"];
			}
			
			if($respuesta == "Sin Acceso"){
				return "hidden"; 
			}
			else{
				return $respuesta;
			}
			
			
		}
		else{
			
			return false;//"Pagina no existe, $url_paginas,{$_COOKIE["id_usuarios"]}, $consulta";
		}
		
	}
	
	
	$consulta = "SELECT * FROM corridas 
	
	LEFT JOIN taquillas USING(id_taquilla)
	LEFT JOIN unidades USING(num_eco)
	LEFT JOIN empresas ON corridas.id_empresas = empresas.id_empresas
	LEFT JOIN origenes USING(id_origenes)
	LEFT JOIN (
	SELECT id_origenes AS id_destinos, 
	nombre_origenes AS nombre_destinos 
	FROM origenes ) AS t_destinos 
	USING(id_destinos)
	LEFT JOIN usuarios USING(id_usuarios)
	LEFT JOIN (
	SELECT id_corridas, SUM(precio_boletos) AS importe_corridas
	FROM boletos WHERE estatus_boletos <> 'Cancelado' GROUP BY id_corridas
	) AS t_importes USING(id_corridas)
	WHERE 1
	
	
	AND date(fecha_corridas) BETWEEN '{$_GET["fecha_inicial"]}' AND '{$_GET["fecha_final"]}'
	";
	
	
	if($_GET["id_usuarios"] != ""){
		$consulta.="AND corridas.id_usuarios = '{$_GET["id_usuarios"]}'";
	}
	if($_GET["id_empresas"] != ""){
		$consulta.="AND corridas.id_empresas = '{$_GET["id_empresas"]}'";
	}	
	if($_GET["num_eco"] != ""){
		$consulta.="AND corridas.num_eco = '{$_GET["num_eco"]}'";
	}
	
	//Si la taquilla es indios verdes solo ostrar corridas de indios verdes
	if($_GET["id_taquilla"] == "INDIOS VERDES"){
		$consulta.="AND corridas.id_taquilla = '4'";
	}
	elseif($_GET["id_taquilla"] != "INDIOS VERDES" && $_GET["id_taquilla"] != "" ){
		//si la taquilla es diferente de IV y diferente de "Todos" mostrar CABADA, SAn andres y catemaco
		
		$consulta.=" AND corridas.id_taquilla <> '4'";
	}
	
	
	
	$consulta.="
	ORDER BY id_corridas DESC "
	;
	
	
	$result = mysqli_query($link,$consulta);
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			die("<div class='alert alert-danger'>No hay registros 	</div> ");
			
		}
		
		
		
	?> 
	<pre hidden >
		<?php echo $consulta?>
	</pre>
	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th class=" d-print-none">Estatus</th>
				<th>
					Estatus Pago
					<input type="checkbox" id="check_todos" >
				</th>
				<th>Folio</th>
				<th>Num Eco</th>
				<th>Taquilla </th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Total</th>
				<th>Origen </th>
				<th>Destino </th>
				<th>Usuario</th>
				
			</tr>
		</thead>
		<tbody>
			<?php 
				
				while($fila = mysqli_fetch_assoc($result)){
					
					$filas = $fila ;
					
				?>
				<tr>
					
					
					<td class=" d-print-none">
						<?php
							switch($filas["estatus_corridas"]){
								case "Activa":
								echo "<span class='badge badge-success'>".$filas["estatus_corridas"]."</span>";
							?>
							<button class="btn btn-success  btn-sm btn_venta" title="Venta de Boletos" 
							data-id_corridas="<?php echo $filas["id_corridas"]?>"
							data-num_eco="<?php echo $filas["num_eco"]?>"
							data-asientos="<?php echo $filas["asientos"]?>"
							>
								<i class="fas fa-ticket-alt"></i> Venta de Boletos
							</button>
							<button class="btn btn-primary  btn-sm finalizar_corrida" title="Finalizar Corrida" 
							data-id_registro="<?php echo $filas["id_corridas"]?>">
								<i class="fas fa-check"></i> Finalizar Corrida
							</button>
							
							<?php
								break;
								
								case "Finalizada":
								
								echo "<span class='badge badge-warning'>".$filas["estatus_corridas"]."</span>";
								
								// if(dame_permiso(""))
							?>
							
							<button  class="btn btn-info  btn-sm imprimir " hidden title="Imprimir" data-id_registro='<?php echo $filas["id_corridas"]?>'>
								<i class="fas fa-print"></i> Imprimir Guía
							</button>	
							
							<?php
								
								
								break;
								
								case "Cancelada":
								echo "<span class='badge badge-danger'>".$filas["estatus_corridas"]."</span>";
								echo "<small>".$filas["datos_cancelacion"]."</small>";
								break;
								
							}
							
						?>
						
						
						<?php if($fila["estatus_corridas"] != 'Cancelada'){?>
							
							<button hidden class="btn btn-info imprimir" title="Imprimir"     data-id_registro='<?php echo $filas["id_corridas"]?>'>
								<i class="fas fa-print"></i>
							</button>	
							<?php
								if(dame_permiso("venta_boletos.php", $link) == 'Supervisor'){
								?>
								<button class="btn btn-danger cancelar" title="Cancelar"     data-id_registro='<?php echo $filas["id_corridas"]?>'>
									<i class="fas fa-times"></i> Cancelar
								</button>	
								<button class="btn btn-warning  btn-sm editar" title="Editar" 
								data-id_registro="<?php echo $filas["id_corridas"]?>"
								data-num_eco="<?php echo $filas["num_eco"]?>"
								>
									<i class="fas fa-edit"></i> Editar
								</button>
								<button class="btn btn-secondary  btn-sm cambiar_unidad" title="Cambiar Unidad" 
								data-id_registro="<?php echo $filas["id_corridas"]?>"
								data-num_eco="<?php echo $filas["num_eco"]?>"
								>
									<i class="fas fa-exchange-alt"></i> Cambiar Unidad
								</button>
								
								
								<?php
								}
							}
						?>
						
						
					</td>
					<td>
						<?php
							switch($filas["estatus_pago"]){
								case "PENDIENTE":
								if($filas["estatus_corridas"] == "Finalizada"){
									echo "<label class='badge badge-warning'> <input type='checkbox' form='form_pagar_corridas' name='corridas[]' class='select' value='{$filas["id_corridas"]}' data-importe_corridas='{$filas["total_guia"]}'>";
									echo $filas["estatus_pago"]."</label>";
								}
								
								break;
								
								case "PAGADA":
								
								echo "<span class='badge badge-success'>".$filas["estatus_pago"]."</span>";
								
								
							?>
							<?php
								
								
								break;
								
								case "Cancelada":
								echo "<span class='badge badge-danger'>".$filas["estatus_corridas"]."</span>";
								break;
								
							}
							
						?>
						
						
					</td>
					<td><?php echo $filas["id_corridas"]?></td>
					<td><?php echo $filas["num_eco"]?></td>
					<td><?php echo $filas["nombre_taquilla"]?></td>
					<td><?php echo $filas["fecha_corridas"]?></td>
					<td><?php echo $filas["hora_corridas"]?></td>
					
					<td  class="text-right">
						$<?php echo number_format($filas["importe_corridas"], 0)?>
					</td>
					
					<td><?php echo $filas["origen"]?></td>
					<td><?php echo $filas["destino"]?></td>
					<td><?php echo $filas["nombre_usuarios"]?></td>
					
				</tr>
				
				<?php
					if($fila["estatus_corridas"] != "Cancelada"){
						
						$total_corrida+= $filas["importe_corridas"];
					}
					
					
				}
			?>
			
			
		</tbody>
		<tfoot>
			<tr class="bg-secondary text-white">
				<td colspan="7">TOTAL</td>
				<td class="text-right">$<?= number_format($total_corrida,0)?></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tfoot>
	</table>
	
	<?php
		
	}
	
	else {
		echo "Error en ".$consulta.mysqli_Error($link);
		
	}
	
	
?>						