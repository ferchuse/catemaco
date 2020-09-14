<?php 
	session_start();
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	$totales = array_fill (  0 ,  1 , 0 ); //Llena el array totales con 10 elementos en 0s
	
	
	
	$consulta = "
	SELECT * FROM beneficiarios
	LEFT JOIN (
	SELECT
	id_beneficiarios,
	SUM(monto)  AS cargos 
	FROM cargos
	WHERE 
	MONTH(fecha_cargos) = '{$_GET["mes"]}'
	AND YEAR(fecha_cargos) = '{$_GET["year"]}'
	AND estatus = 'Activo'
	GROUP BY id_beneficiarios
	) as t_cargos
	USING (id_beneficiarios)
	
	LEFT JOIN (
	SELECT
	id_beneficiarios,
	SUM(monto)  AS entradas 
	FROM recibos_entradas
	WHERE 
	MONTH(fecha_aplicacion) BETWEEN '{$_GET["mes_inicial"]}'
	AND '{$_GET["mes_final"]}'
	AND YEAR(fecha_aplicacion) = '{$_GET["year"]}'
	AND estatus_deposito = 'Activo'
	GROUP BY id_beneficiarios
	) as t_depositos
	USING (id_beneficiarios)
	
	LEFT JOIN (
	SELECT
	id_beneficiarios,
	SUM(monto_ReciboSalidas)  AS salidas 
	FROM recibos_salidas
	WHERE 
	MONTH(fecha_aplicacion) BETWEEN '{$_GET["mes_inicial"]}'
	AND '{$_GET["mes_final"]}'
	AND YEAR(fecha_aplicacion) = '{$_GET["year"]}'
	AND estatus_reciboSalidas = 'Activo'	
	GROUP BY id_beneficiarios
	) as t_salidas
	USING (id_beneficiarios)
	"; 
	if($_GET["id_beneficiarios"] != ''){
		
		$consulta.=  " AND  id_beneficiarios = '{$_GET["id_beneficiarios"]}'"; 
	}
	
	$consulta.=  " ORDER BY nombre_beneficiarios"; 
	
	$result = mysqli_query($link,$consulta);
	
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			die("<div class='alert alert-danger'>No hay registros</div>");
		}
		
		while($fila = mysqli_fetch_assoc($result)){
			// console_log($fila);
			$filas[] = $fila ;
		}
	?>
	
	<pre hidden >
		Id_empresas <?php echo $_SESSION["id_empresas"]?>
		Session Id <?php echo session_id()?>
		Sesiion Estatus <?php echo session_status()?>
		Consulta <?php echo $consulta?>
	</pre>
	<table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Beneficiario</th>
				<th>Entradas</th>
				<th>Salidas</th>
				<th>Saldo</th>
				
			</thead>
			<tbody id="">
				<?php 
					foreach($filas as $index=>$fila){
						
						$total[1]+= $fila["entradas"];
						$total[2]+= $fila["salidas"];
						$total[3]+=  $fila["entradas"] - $fila["salidas"]  ;
					?>
					<tr>						
						<td><?php echo $fila["nombre_beneficiarios"]?></td>
						<td class="text-right">$<?php echo number_format($fila["entradas"])?></td>
						<td class="text-right">$<?php echo number_format($fila["salidas"])?></td>
						<td class="text-right">$<?php echo number_format( $fila["entradas"] - $fila["salidas"] )?></td>
					</tr>
					<?php
					}
				?>
			</tbody>
			<tfoot>
				<tr class="bg-secondary text-white">
					<td><?php echo mysqli_num_rows($result);?> Registros</td>
					<td class="text-right">$<?= number_format($total[1]);?></td>
					<td class="text-right">$<?= number_format($total[2]);?></td>
					<td class="text-right">$<?= number_format($total[3]);?></td>
				</tr>
			</tfoot>
		</table>
	</div>
	
	<?php
		
		
	}
	else {
		echo  "Error en ".$consulta.mysqli_Error($link);
	}
	
?>	