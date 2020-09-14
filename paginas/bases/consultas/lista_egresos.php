<?php 
	
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	include('../../../funciones/dame_permiso.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	$totales = array_fill (  0 ,  1 , 0 ); //Llena el array totales con 10 elementos en 0s
	
	
	
	$consulta = "SELECT * FROM base_egresos
	LEFT JOIN usuarios USING(id_usuarios)
	LEFT JOIN base_beneficiarios USING(id_beneficiarios)
	WHERE  DATE(fecha) BETWEEN '{$_GET['fecha_inicial']}' AND '{$_GET['fecha_final']}'
	
	";
	
	
	
	// $consulta.=  " ORDER BY id_egreso ASC"; 
	
	
	$result = mysqli_query($link,$consulta);
	
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			die("<div class='alert alert-danger'>No hay registros</div>");
		}
		
		while($fila = mysqli_fetch_assoc($result)){
			
			$filas[] = $fila ;
		}
	?>
	
	<pre hidden>
		Id_empresas <?php echo $_SESSION["id_empresas"]?>
		Session Id <?php echo session_id()?>
		Sesiion Estatus <?php echo session_status()?>
		Consulta <?php echo $consulta?>
	</pre>
	<table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th hidden><input type="checkbox" id="check_all"></th>
				<th></th>
				<th>Folio</th>
				<th>Fecha </th>
				<th>Beneficiario</th>
				<th>Monto</th>
				<th>Observaciones</th>
				<th>Estatus</th>
				<th>Usuario</th>
			</thead>
			<tbody >
				<?php 
					foreach($filas as $index=>$fila){
					?>
					<tr>
						<td hidden  class="text-center"><input type="checkbox" class="seleccionar" value='<?php echo $fila['id_egreso']?>'></td>
						<td class="text-center"> 
							<?php if($fila["estatus"] != 'Cancelado' ){
								$totales[0]+= $fila["monto"];
								if(dame_permiso("base_egresos.php", $link) == 'Supervisor'){ 
								?>
								<button class="btn btn-danger cancelar" title="Cancelar" data-id_registro='<?php echo $fila['id_egreso']?>'>
									<i class="fas fa-times"></i>
								</button>
								<button class="btn btn-outline-info imprimir" data-id_registro='<?php echo $fila['id_egreso']?>'>
									<i class="fas fa-print"></i>
								</button>
								<?php
								}
							?>
							
							<?php	
							}
							else{
								echo "<span class='badge badge-danger'>".$fila["estatus"]."<br>".$fila["datos_cancelacion"]."</span>";
							}
							?>
						</td>
						<td><?php echo $fila["id_egreso"]?></td>
						<td><?php echo $fila["fecha"]?></td>
						<td><?php echo $fila["nombre_beneficiarios"]?></td>
						<td class="text-right">$<?php echo number_format($fila["monto"], 2)?></td>
						<td><?php echo $fila["observaciones"]?></td>
						<td><?php echo $fila["estatus"]?></td>
						<td><?php echo $fila["nombre_usuarios"]?></td>
						
					</tr>
					<?php
						
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					
					<?php
						foreach($totales as $i =>$total){
						?>
						<td class="text-right h6">$<?php echo number_format($total, 2)?></td>
						<?php	
						}
					?>
					<td></td>
					<td></td>
					<td></td>
					
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