<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	
	$consulta ="INSERT INTO salida_archivo SET  
	id_usuarios = '{$_COOKIE['id_usuarios']}' , 
	id_archivo = '{$_POST['id_archivo']}' , 
	id_personal = '{$_POST['id_personal']}' , 
	fecha = '{$_POST['fecha']}' , 
	lugar = '{$_POST['lugar']}'
	
	";	
	
	$result = 	mysqli_query($link,$consulta);
	
	if($result){
		
		// $respuesta["action"] = "insert";
		$respuesta["estatus"] = "success";
		$respuesta["mensaje"] = "Guardado";
		$respuesta["folio"] = mysqli_insert_id($link);
		
	}
	else{
		$respuesta["estatus"] = "error";
		$respuesta["mensaje"] = mysqli_error($link);		
		$respuesta["consulta"] = $consulta;		
	}
	
	
	
	
	
	echo json_encode($respuesta);
	
?>