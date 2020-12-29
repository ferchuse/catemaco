<?php 
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	
	
	$query ="INSERT INTO gastos_corrida SET 
	fecha_gastos = NOW(),
	id_corridas = '{$_POST["id_corridas"]}',
	id_cat_gastos = '{$_POST["id_cat_gastos"]}',
	recibe = '{$_POST["recibe"]}',
	id_usuarios = '{$_COOKIE["id_usuarios"]}',
	id_taquilla = '{$_COOKIE["id_taquilla"]}',
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