<?php 
	session_start();
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	$totales = array_fill (  0 ,  1 , 0 ); //Llena el array totales con 10 elementos en 0s
	
	
	
	$consulta = "
	SELECT * FROM base_beneficiarios
	
	LEFT JOIN (
	SELECT
	id_beneficiarios,
	SUM(monto)  AS ingresos 
	FROM base_ingresos
	WHERE 
	MONTH(fecha) = '{$_GET["mes"]}'
	AND YEAR(fecha) = '{$_GET["year"]}'
	AND estatus = 'Activo'
	GROUP BY id_beneficiarios
	) as t_ingresos
	
	USING (id_beneficiarios)
	
	LEFT JOIN (
	SELECT
	id_beneficiarios,
	SUM(monto)  AS egresos 
	FROM base_egresos
	WHERE 
	MONTH(fecha) = '{$_GET["mes"]}'
	AND YEAR(fecha) = '{$_GET["year"]}'
	AND estatus = 'Activo'	
	GROUP BY id_beneficiarios
	) as t_egresos
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
				<th>Ingresos</th>
				<th>Egresos</th>
				<th>Saldo</th>
				
			</thead>
			<tbody id="">
				<?php 
					foreach($filas as $index=>$fila){
						
						$total[1]+= $fila["ingresos"];
						$total[2]+= $fila["egresos"];
						$total[3]+=  $fila["ingresos"] - $fila["egresos"]  ;
					?>
					<tr>						
						<td><?php echo $fila["nombre_beneficiarios"]?></td>
						<td class="text-right">$<?php echo number_format($fila["ingresos"])?></td>
						<td class="text-right">$<?php echo number_format($fila["egresos"])?></td>
						<td class="text-right">$<?php echo number_format( $fila["ingresos"] - $fila["egresos"] )?></td>
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