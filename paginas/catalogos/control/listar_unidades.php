<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM unidades 
	LEFT JOIN empresas USING(id_empresas) 
	LEFT JOIN  propietarios  USING (id_propietarios)
	WHERE 1 
	";
	
	if($_GET["num_eco"] != ''){
		$consulta.= " AND num_eco = '{$_GET["num_eco"]}' ";
	}
	
	if($_GET["id_empresas"] != ''){
		$consulta.= " AND id_empresas = '{$_GET["id_empresas"]}' ";
	}
	if($_GET["estatus_unidades"] != ''){
		$consulta.= " AND estatus_unidades = '{$_GET["estatus_unidades"]}' ";
	}
	if($_GET["id_propietarios"] != ''){
		$consulta.= " AND id_propietarios = '{$_GET["id_propietarios"]}' ";
	}
	$consulta.= "ORDER BY num_eco ";
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
	?>
	<table class="table table-bordered" id="tabla_registros" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center">Num Eco</th>
				<th class="text-center">Propietario</th>
				<th class="text-center">Empresa</th>
				<th class="text-center">Asientos</th>
				<th class="text-center">Fecha Alta</th>
				<th class="text-center">Estatus</th>
				<th class="text-center">Acciones</th>
			</tr>
		</thead>
		<tbody >
			<?php
				while($fila = mysqli_fetch_assoc($result)){?>
				
				<tr>
					<td><?php echo $fila["num_eco"];?></td>
					<td><?php echo $fila["nombre_propietarios"];?></td>
					<td><?php echo $fila["nombre_empresas"];?></td>
					<td><?php echo $fila["asientos"];?></td>
					<td><?php echo $fila["fecha_ingreso"];?></td>
					<td><?php echo $fila["estatus_unidades"];?></td>
					<td>
						<button class="btn btn-warning btn_editar" data-id_registro="<?php echo $fila["num_eco"];?>">
							<i class="fas fa-edit"></i>
						</button>
						<button class="btn btn-info btn_historial" data-id_registro="<?php echo $fila["num_eco"];?>">
							<i class="fas fa-clock"></i> 
						</button>
						<a target="_blank" class="btn btn-default" href="unidades/detalles_unidad.php?serie=<?php echo $fila["serie"];?>">
							<i class="fas fa-print"></i> 
						</a>
						<a class="btn btn-secondary" href="unidades/imprimir_qr.php?serie=<?php echo $fila["serie"];?>">
							<i class="fas fa-qrcode"></i> 
						</a>
						
					</td>
				</tr>
				
				<?php 	
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="7">
					<?php echo mysqli_num_rows($result);?> Registros.
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