<?php 
	session_start();
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	$totales = array_fill (  0 ,  1 , 0 ); //Llena el array totales con 10 elementos en 0s
	
	
	
	$consulta = "
	SELECT
	
	fecha,
	id_ingreso AS folio,
	base,
	monto,
	'Ingreso' AS tipo
	
	FROM base_ingresos
	LEFT JOIN bases USING(id_base)
	WHERE 
	MONTH(fecha) BETWEEN '{$_GET["mes_inicial"]}'
	AND '{$_GET["mes_final"]}'
	AND YEAR(fecha) = '{$_GET["year"]}'
	AND estatus = 'Activo'
	
	
	UNION
	
	SELECT
	fecha,
	id_egreso AS folio,
	' ' AS base,
	monto,
	'Egreso' AS tipo
	
	FROM base_egresos
	WHERE 
	MONTH(fecha) BETWEEN '{$_GET["mes_inicial"]}'
	AND '{$_GET["mes_final"]}'
	AND YEAR(fecha) = '{$_GET["year"]}'
	AND estatus = 'Activo'
	
	
	
	"; 
	
	$consulta.=  " ORDER BY fecha"; 
	
	
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
				<th>Tipo</th>
				<th>Folio</th>
				<th>Fecha</th>
				<th>Base</th>
				<th>Monto</th>
				
				
			</thead>
			<tbody id="">
				<?php 
					foreach($filas as $index=>$fila){
						
						$total[1]+= $fila["ingresos"];
						$total[2]+= $fila["egresos"];
						$total[2]+= $fila["egresos"];
						$total[3]+=  $fila["ingresos"] - $fila["egresos"]  ;
					?>
					<tr>						
						<td><?php 
							
							if($fila["tipo"] == "Ingreso"){
								
								echo "<span class='badge badge-success'>".$fila["tipo"]."</span>";
								
							}
							else{
								echo "<span class='badge badge-danger'>".$fila["tipo"]."</span>";
							}
							
							
						?></td>
						<td><?php echo $fila["folio"]?></td>
						<td><?php echo $fila["fecha"]?></td>
						<td><?php echo $fila["base"]?></td>
						<td class="text-right">$<?php echo number_format($fila["monto"])?></td>
					</tr>
					<?php
					}
					?>
					</tbody>
					<tfoot>
				<tr class="bg-secondary text-white">
					<td><?php echo mysqli_num_rows($result);?> Registros</td>
					<td class="text-right"></td>
					<td class="text-right"></td>
					<td class="text-right"></td>
					<td class="text-right"></td>
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