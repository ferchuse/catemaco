<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM personal 
	
	"; 
	 
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
	?>
	<table class="table table-bordered" id="tabla_registros" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center">Nombre</th>
				<th class="text-center">Profesión</th>
				<th class="text-center">Puesto</th>
				<th class="text-center">Teléfono</th>
				<th class="text-center">Estatus</th>
				<th class="text-center"></th>
			</tr>
		</thead>
		<tbody >
			<?php
				while($fila = mysqli_fetch_assoc($result)){
					
					$badge = $fila["estatus"] == "Activo" ? "badge-success" : "badge-danger";
					
					?>
				
				<tr>
					<td><?php echo $fila["nombre"];?></td>
					<td><?php echo $fila["profesion"];?></td>
					<td><?php echo $fila["puesto"];?></td>
					<td><?php echo $fila["telefono"];?></td>
					<td><?php echo "<span class='$badge badge'>".$fila["estatus"]."</span>";?></td>
					<td>
						<button class="btn btn-warning btn_editar" data-id_registro="<?php echo $fila["id_personal"];?>">
							<i class="fas fa-edit"></i>
						</button>
					</td>
				</tr>
				
				<?php 	
				}
			?>
		</tbody>
	</table>
	
	
	<?php
		
		
	}
	else {
		echo "Error en".$consulta. mysqli_error($link);
	}
	
	
?>	