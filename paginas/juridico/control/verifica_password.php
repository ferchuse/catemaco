<?php 
	header("Content-Type: application/json");
	include('../../../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM personal 
	WHERE id_personal = '{$_GET["id_personal"]}'
	AND password = '{$_GET["password"]}'
	
	"; 
	
	$result = mysqli_query($link,$consulta);
	
	if($result){
		$num_registros = mysqli_num_rows($result);
		$respuesta["estatus"] = $result;
		if($num_registros > 0 ){
			$respuesta["valido"] = "SI";
		}	
		else{
			$respuesta["valido"] = "NO";
		}
	}
	else {
		$respuesta["result"] = $result;
		$respuesta["estatus"] = $result;
		$respuesta["mensaje"] =  mysqli_error($link);
		
	}
	
	
	
	echo json_encode($respuesta);
?>	