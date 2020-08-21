<?php 
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
	
	
	
	$update ="UPDATE archivo SET  
	estatus = 'En Trámite' , 
	lugar_salida = '{$_POST['lugar']}'
	
	WHERE id_archivo = '{$_POST['id_archivo']}' 
	
	
	";	
	
	$result_update = 	mysqli_query($link,$update);
	
	if($result_update){
		
		$respuesta["update"]["estatus"] = "success";
		$respuesta["update"]["mensaje"] = "Actualizado";
	
	}
	else{
		$respuesta["update"]["estatus"] = "error";
		$respuesta["update"]["mensaje"] = mysqli_error($link);		
				
	}
	
	$respuesta["update"]["consulta"] = $update;
	
	
	
	echo json_encode($respuesta);
	
?>