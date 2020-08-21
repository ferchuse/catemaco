<?php 
	include('../../../conexi.php');
	$link = Conectarse();
	
    $consulta = "
	
	SELECT *,
	personal.nombre AS personal_nombre,
	archivo.nombre AS archivo_nombre
	
	FROM devolucion
	LEFT JOIN personal USING (id_personal)
	LEFT JOIN archivo USING (id_archivo)
	LEFT JOIN usuarios USING (id_usuarios)
	
	WHERE id_devolucion = '{$_GET["folio"]}'
	
	";
    
	
	
    $result = mysqli_query($link,$consulta);
    
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			
			die("<div class='alert alert-danger'>No encontrado</div>");
			
			
		}
		
		while($row = mysqli_fetch_assoc($result)){
			
			$fila = $row ;
			
			
		}
		
	?> 
	
	<div class="row">
		<div class="col-3 text-center" >
			<img  src="../../img/logo.jpg" class="img-fluid">
		</div>
		<div class="col-7 text-center">
			<h4>Coordinadora de Transporte Grupo AAZ AC</h4>
			<legend>Devolución de Documento</legend> 
		</div>
	</div>
	<hr>
	
	<div class="row">
		<div class="col-12 text-center">
			<p>Fecha: <?php echo $fila["fecha"];?></p>
		</div>	 
	</div>
	<div class="row">
		<div class="col-12 text-center">
			<p>Entrega: <?php echo $fila["personal_nombre"];?></p>
		</div>	 
	</div>
	<div class="row">
		<div class="col-12 text-center">
			<p>Dcoumento: <?php echo $fila["archivo_nombre"];?></p>
		</div>	 
	</div>
	<div class="row">
		<div class="col-12 text-center">
			<p>Recibe: <?php echo $fila["nombre_usuarios"];?></p>
		</div>	 
	</div>
	<div class="row">
		<div class="col-12 text-center">
			<p>Fecha de impresión: <?php echo date("d/m/Y H:i:s");?></p>
		</div>	 
	</div>
	
	<?php    
	}
	else {
		echo "Error en ".$consulta.mysqli_Error($link);
		
	}
?>																																				