<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM tipo_documento 
	
	"; 
	 
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
	?>
	<table class="table table-bordered" id="tabla_registros" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th class="text-center">Tipo de Documento</th>
				<th class="text-center"></th>
			</tr>
		</thead>
		<tbody >
			<?php
				while($fila = mysqli_fetch_assoc($result)){
					
					
					?>
				
				<tr>
					<td><?php echo $fila["tipo_documento"];?></td>
				
					<td>
						<button class="btn btn-warning btn_editar" data-id_registro="<?php echo $fila["id_documento"];?>">
							<i class="fas fa-edit"></i>
						</button>
						<button class="btn btn-danger btn_borrar" data-id_registro="<?php echo $fila["id_documento"];?>">
							<i class="fas fa-trash"></i>
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