<?php 
	
	
	$consulta = "SELECT * FROM corridas
	
	WHERE estatus_corridas = 'Activa' 
	AND fecha_corridas >= CURDATE()
	";
	
	
	$consulta.= "ORDER BY fecha_corridas ";
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
		
		while($fila = mysqli_fetch_assoc($result)){ 
			$corridas[] = $fila;
			
		}
		
		
		
	}
	else {
		die($consulta. mysqli_error($link));
	}
	
	
?>	