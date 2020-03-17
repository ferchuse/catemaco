<?php 
	session_start();
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	include('../../../funciones/console_log.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	
	$consulta = "##Importes por Usuario
	SELECT
	id_usuarios,
	nombre_usuarios,
	suma_boletos,
	suma_gastos
	FROM
	usuarios
	
	
	LEFT JOIN (
	SELECT
	id_usuarios,
	SUM(precio_boletos) AS suma_boletos
	FROM
	boletos
	WHERE
	estatus_boletos <> 'Cancelado'
	AND DATE(fecha_boletos) BETWEEN '{$_GET["fecha_inicial"]}'
	AND '{$_GET["fecha_final"]}'
	
	GROUP BY
	id_usuarios
	) AS t_boletos USING (id_usuarios)
	
	LEFT JOIN (
	SELECT
	id_usuarios,
	SUM(importe) AS suma_gastos
	FROM
	gastos_corrida
	WHERE
	estatus_gastos <> 'Cancelado'
	AND DATE(fecha_gastos) BETWEEN '{$_GET["fecha_inicial"]}'
	AND '{$_GET["fecha_final"]}'
	
	GROUP BY
	id_usuarios
	) AS t_gastos USING (id_usuarios)
	WHERE usuarios.id_administrador = '1'
	";
	
  
	
	$result = mysqli_query($link,$consulta);
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			die("<div class='alert alert-danger'>No hay registros $consulta</div>");
			
		}
		
		
		
	?>  
	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th>Usuario</th>
				<th>Venta de Boletos</th>
				<th>Gastos</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				
				while($fila = mysqli_fetch_assoc($result)){
					
					$filas = $fila ;
					$totales[0]+= $filas["suma_boletos"];
					$totales[1]+= $filas["suma_gastos"];
					$balance_usuario  = $filas["suma_boletos"] - $filas["suma_gastos"] ;
					$balance_total+= $balance_usuario;
				?>
				<tr>
					<td>
						
						<?php echo $filas["nombre_usuarios"] == ''? 0 : $filas["nombre_usuarios"] ?>
						
					</td>
					
					<td>
						<a href="abonos_usuario.php?<?php 
							
							echo "id_usuarios={$filas["id_usuarios"]}
							&fecha_inicial={$_GET["fecha_inicial"]}
							&fecha_final={$_GET["fecha_final"]}
							&nombre_usuarios={$filas["nombre_usuarios"]}
							
							";
							
							?>">
							<?php echo $filas["suma_boletos"]  == '' ? 0 : $filas["suma_boletos"]?>
						</a>	
					</td>
					<td>
						<a href="abonos_general_usuario.php?<?php 
							echo "id_usuarios={$filas["id_usuarios"]}
							&fecha_inicial={$_GET["fecha_inicial"]}
							&fecha_final={$_GET["fecha_final"]}
							&nombre_usuarios={$filas["nombre_usuarios"]}
							";
							?>">
							
							<?php echo $filas["suma_gastos"]  == ''? 0 : $filas["suma_gastos"] ?>
						</a>	
					</td>
					</a>
					<td>
						<?php echo number_format($balance_usuario); ?>
					</td>
				</tr>
				
				<?php
					
					
				}
			?>
			
			
		</tbody>
		<tfoot>
			<tr class="h5">
				<td ><b> TOTALES<b></td>
					<?php
						$gran_total = 0;
						foreach($totales as $i =>$total){
							
						?>
						<td ><b><?php echo number_format($total)?></b></td>
						<?php	
						}
						
						
					?>
					<td ><b>$<?php echo number_format($balance_total)?></b></td>
					
				</tr>
				</tfoot>
			</table>
			
			<pre hidden>
				<?php echo $consulta;?>
			</pre>
			<?php
				
			}
			
			else {
				echo "Error en ".$consulta.mysqli_Error($link);
				
			}
			
			
		?>																							