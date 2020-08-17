<?php 
	session_start();
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	
	$q_usuario ="INSERT INTO archivo SET  
	id_archivo = '{$_POST['id_archivo']}' , 
	sector = '{$_POST['sector']}' , 
	nombre= '{$_POST['nombre']}' , 
	descripcion = '{$_POST['descripcion']}' , 
	id_empresas ='{$_POST['id_empresas']}',
	id_documento ='{$_POST['id_documento']}',
	copia ='{$_POST['copia']}',
	estatus ='{$_POST['estatus']}',
	ubicacion ='{$_POST['ubicacion']}',
	foto ='{$_POST['foto']}',
	thumbnail ='{$_POST['thumbnail']}',
	jurisdiccion ='{$_POST['jurisdiccion']}',
	lugar_salida ='{$_POST['lugar_salida']}'
	
	ON DUPLICATE KEY UPDATE
	
	id_archivo = '{$_POST['id_archivo']}' , 
	sector = '{$_POST['sector']}' , 
	nombre= '{$_POST['nombre']}' , 
	descripcion = '{$_POST['descripcion']}' , 
	id_empresas ='{$_POST['id_empresas']}',
	id_documento ='{$_POST['id_documento']}',
	copia ='{$_POST['copia']}',
	estatus ='{$_POST['estatus']}',
	ubicacion ='{$_POST['ubicacion']}',
	foto ='{$_POST['foto']}',
	thumbnail ='{$_POST['thumbnail']}',
	jurisdiccion ='{$_POST['jurisdiccion']}',
	lugar_salida ='{$_POST['lugar_salida']}'
	
	
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