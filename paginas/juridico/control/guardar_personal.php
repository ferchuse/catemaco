<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	
	$q_usuario ="INSERT INTO personal SET  
	id_personal = '{$_POST['id_personal']}' , 
	curp = '{$_POST['curp']}' , 
	rfc = '{$_POST['rfc']}' , 
	nombre= '{$_POST['nombre']}' , 
	password= '{$_POST['password']}' , 
	profesion = '{$_POST['profesion']}' , 
	puesto ='{$_POST['puesto']}',
	estatus ='{$_POST['estatus']}',
	telefono ='{$_POST['telefono']}'
		
	ON DUPLICATE KEY UPDATE
	
	id_personal = '{$_POST['id_personal']}' , 
	curp = '{$_POST['curp']}' , 
	rfc = '{$_POST['rfc']}' , 
	nombre= '{$_POST['nombre']}' , 
	password= '{$_POST['password']}' , 
	profesion = '{$_POST['profesion']}' , 
	puesto ='{$_POST['puesto']}',
	estatus ='{$_POST['estatus']}',
	telefono ='{$_POST['telefono']}'
	
	
	";	
	
	$result_usuarios = 	mysqli_query($link,$q_usuario);
	
	if($result_usuarios){
		
		$respuesta["action"] = "insert";
		$respuesta["estatus"] = "success";
		$respuesta["mensaje"] = "Guardado";
		$id_usuarios = mysqli_insert_id($link);
	}
	else{
		$respuesta["estatus"] = "error";
		$respuesta["mensaje"] = "Error en $q_usuario ".mysqli_error($link);		
	}
	
	
	
	
	
	echo json_encode($respuesta);
	
?>