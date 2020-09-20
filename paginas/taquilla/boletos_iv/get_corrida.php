<?php 
	 
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	
	//Inserta detalle de boletos
	
	$consulta ="SELECT * FROM corridas 
	WHERE  
	id_administrador = '{$_SESSION['id_administrador']}' ,
	AND estatus_corridas = 'Activo'
	";
	$result = 	mysqli_query($link,$insert);
	
	if($result){
		
		if(mysqli_num_rows($result) == 0){
			
			
		}
	}
	else{ 
		$respuesta["result"] = "error";		
		$respuesta["mensaje"] = "Error en insert: $insert  ".mysqli_error($link);		
	}		
	
	
	
	echo json_encode($respuesta);
	
	?>	