<?php 
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	
	
	$query ="INSERT INTO base_beneficiarios SET 
	id_beneficiarios = '{$_POST["id_beneficiarios"]}',
	nombre_beneficiarios = '{$_POST["nombre_beneficiarios"]}'
	
	ON DUPLICATE KEY UPDATE
	
	id_beneficiarios = '{$_POST["id_beneficiarios"]}',
	nombre_beneficiarios = '{$_POST["nombre_beneficiarios"]}'
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