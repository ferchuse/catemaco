<?php 
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	

	$insert_traspaso  ="INSERT INTO cargos SET 
	fecha_cargos = '{$_POST['fecha_cargos']}',
	id_beneficiarios = '{$_POST['id_beneficiarios']}',
	id_empresas = '{$_POST['id_empresas']}',
	concepto = '{$_POST['concepto']}',
	monto = '{$_POST["monto"]}',
	id_usuarios = '{$_COOKIE["id_usuarios"]}'
	";
	
	$result_insert = 	mysqli_query($link,$insert_traspaso);
	
	if($result_insert){
		$respuesta["estatus"] = "success";
		$respuesta["mensaje_insert"] = "Guardado Correctamente";
		$respuesta["insert_id"] = mysqli_insert_id($link);
		$respuesta["insert"] = $insert_traspaso;
		
	}
	else{
		
		$respuesta["estatus_insert"] = "error";
		$respuesta["mensaje_insert"] = "Error en insert: $insert_traspaso  ".mysqli_error($link);		
	}
	
	
	
	echo json_encode($respuesta);
	
?>