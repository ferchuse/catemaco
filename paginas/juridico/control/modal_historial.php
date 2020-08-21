<?php
	
	include("../../../conexi.php");
	$link = Conectarse();
	$lista_transacciones = [];
	
	
	$consulta = "
	SELECT *,
	'Salida' AS tipo_movimiento,
	archivo.nombre as archivo_nombre,
	personal.nombre as personal_nombre
	FROM salida_archivo
	LEFT JOIN usuarios USING(id_usuarios)
	LEFT JOIN archivo USING(id_archivo)
	LEFT JOIN personal USING(id_personal)
	
	
	WHERE id_archivo = '{$_GET["id_archivo"]}'
	
	
	ORDER BY
	fecha 
	";
	
	
	$result = mysqli_query($link,$consulta) or die ("<pre>Error en $consulta". mysqli_error($link). "</pre>");
	
	while($fila = mysqli_fetch_assoc($result)){
		
		$lista_transacciones[] = $fila;
		
	}
?>
<pre hidden>
	<?= $consulta;?>
</pre>


<?php
	if(count($lista_transacciones) > 0){
	?>
	
	<h4 class="d-none d-print-block">Lista Movimientosa <?=$lista_transacciones[0]["razon_social_clientes"] ?>
	</h4>
	<div class="table-responsive">
		<table class="table table-hover ">
			<tr>
				<th class="text-center">Fecha</th>
				<th class="text-center">Tipo</th>
				<th class="text-center">Personal</th>
				<th class="text-center">Lugar</th>
				<th class="text-center">Entrega</th>
			</tr>
			<?php 
				$cargos= 0;
				$abonos= 0;
				$saldo= 0;
				foreach($lista_transacciones AS $i => $transaccion){
					
				?>
				<tr class="text-center">
					
					<td><?php echo date("d/m/Y", strtotime($transaccion["fecha"]));?></td>		
					<td><?php echo ($transaccion["tipo_movimiento"]);?></td>
					<td><?php echo ($transaccion["personal_nombre"]);?></td>
					<td><?php echo ($transaccion["lugar"]);?></td>
					<td><?php echo ($transaccion["nombre_usuarios"]);?></td>
					
				</tr>
				<?php
				}
			?>
			<tfoot hidden class="h5 text-white bg-secondary text-right">
				<tr>
					<td>TOTALES:</td>
					<td></td>
					<td>$<?php echo number_format($cargos);?></td>
					<td>$<?php echo number_format($abonos);?></td>
					<td>$<?php echo number_format($saldo);?></td>
					
				</tr>
			</tfoot>
		</table>
	</div>
	<?php
	}
	else{
		
		echo "<div class='alert alert-warning'>No hay Movimientos</div>";
	}
?>


