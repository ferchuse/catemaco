<?php 
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	
	
	$query ="INSERT INTO equipaje SET 
	fecha_equipaje = NOW(),
	id_corridas = '{$_POST["id_corridas"]}',
	tipo_equipaje = '{$_POST["tipo_equipaje"]}',
	pasajero = '{$_POST["pasajero"]}',
	id_usuarios = '{$_COOKIE["id_usuarios"]}',
	importe = '{$_POST["importe"]}'
	
	";	
	
	
	
	$exec_query = 	mysqli_query($link,$query);
	$respuesta["query"] = $query;
	
	if($exec_query){
		$respuesta["estatus"] = "success";
		$respuesta["mensaje"] = "Guardado";
		$respuesta["folio"] = mysqli_insert_id($link);
		
		
    }else{
		
		$respuesta["estatus"] = "error";
		$respuesta["mensaje"] = "Error en insert: $query  ".mysqli_error($link);		
	}
	
	echo json_encode($respuesta);
	
?>