<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	
	$q_usuario ="INSERT INTO tipo_documento SET  
	id_documento = '{$_POST['id_documento']}' , 
	tipo_documento = '{$_POST['tipo_documento']}' 
	
	
	ON DUPLICATE KEY UPDATE
	
	id_documento = '{$_POST['id_documento']}' , 
	tipo_documento = '{$_POST['tipo_documento']}' 
	
	
	";	
	
	$result_usuarios = 	mysqli_query($link,$q_usuario);
	
	if($result_usuarios){
		
		$respuesta["action"] = "insert";
		$respuesta["estatus"] = "success";
		$respuesta["mensaje"] = "Guardado";
		$respuesta["affected_rows"] = mysqli_affected_rows($link);
	
	}
	else{
		$respuesta["estatus"] = "error";
		$respuesta["mensaje"] = "Error en $q_usuario ".mysqli_error($link);		
	}
	
	
	
	
	
	echo json_encode($respuesta);
	
?>