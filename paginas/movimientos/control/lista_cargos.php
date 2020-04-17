<?php 
	session_start();
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	$totales = array_fill (  0 ,  1 , 0 ); //Llena el array totales con 10 elementos en 0s
	
	
	
	$consulta = "SELECT * FROM cargos
	LEFT JOIN empresas USING(id_empresas)
	LEFT JOIN usuarios USING(id_usuarios)
	LEFT JOIN beneficiarios USING(id_beneficiarios)
	WHERE  DATE(fecha_cargos)
	BETWEEN '{$_GET['fecha_inicial']}' 
	AND '{$_GET['fecha_final']}'"; 
	
	if($_GET["id_beneficiarios"] != ''){
		$consulta.=  " AND  id_beneficiarios = '{$_GET["id_beneficiarios"]}'"; 
	}
	
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
				<th></th>
				<th>Folio</th>
				<th>Fecha</th>
				<th>Beneficiario</th>
				<th>Empresa</th>
				<th>Concepto</th>
				<th>Monto</th>
				<th>Usuario</th>
			</thead>
			<tbody id="">
				<?php 
					foreach($filas as $index=>$fila){
					?>
					<tr>
						<td class="text-center"> 
							<?php 
								if($fila["estatus"] == 'Cancelado'){
									echo "<span class='badge badge-danger'>".$fila["estatus"]."<br>".$fila["datos_cancelacion"]."</span>";
								}
								else{
									$totales[0]+= $fila["monto"];
								?>
								<button class="btn btn-danger cancelar" title="Cancelar" data-id_registro='<?php echo $fila['id_cargos']?>'>
									<i class="fas fa-times"></i>
								</button>
								<?php
								}
							?>
						</td>
						<td><?php echo $fila["id_cargos"]?></td>
						<td><?php echo date("d-m-Y", strtotime($fila["fecha_cargos"]))?></td>
						<td><?php echo $fila["nombre_beneficiarios"]?></td>
						<td><?php echo $fila["nombre_empresas"]?></td>
						<td><?php echo $fila["concepto"]?></td>
						<td>$<?php echo number_format($fila["monto"])?></td>
						<td><?php echo $fila["nombre_usuarios"]?></td>
					</tr>
					<?
					}
				?>
			</tbody>
			<tfoot>
				<tr class="bg-secondary text-white">
					<td class="h6"><?= count($filas)?> Registros</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<?php
						foreach($totales as $i =>$total){
						?>
						<td class="h6">$<?php echo number_format($total)?></td>
						<?php	
						}
					?>
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