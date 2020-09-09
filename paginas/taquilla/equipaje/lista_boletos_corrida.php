<?php 
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta ="<option value=''>Elige Pasajero...</option>";
	
	$consulta = "SELECT * FROM boletos
	
	WHERE id_corridas = '{$_GET["id_corridas"]}' 
	AND estatus_boletos = 'Activo'
	";
	
	$respuesta .="$consulta";
	$consulta.= "ORDER BY id_boletos ";
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
		
		while($fila = mysqli_fetch_assoc($result)){ 
			$respuesta.= "<option value='{$fila["nombre_pasajero"]}'>#".$fila["id_boletos"]."-".$fila["nombre_pasajero"]."</option>";
			
		}
		
		
		
	}
	else {
		die($consulta. mysqli_error($link));
	}
	
	echo $respuesta;
?>	