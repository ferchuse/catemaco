<?php 
	
	include('../../../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	$fecha_cancelacion = date("Y-m-d H:i:s");

	$cancelar = "UPDATE gastos_corrida
	
	SET
	estatus_gastos = 'Cancelado',
	datos_cancelacion='Usuario: {$_COOKIE["nombre_usuarios"]} <br> Fecha: $fecha_cancelacion'
	
	WHERE  id_gastos = '{$_GET["id_registro"]}'";
	
	$result = mysqli_query($link,$cancelar) ;
	
	$respuesta["consulta"] = "$cancelar";
	if($result){
		$respuesta["result"] = "success";
	}
	else{
		$respuesta["result"] = "Error en ". mysqli_Error($link);
	}
	
	
	echo json_encode($respuesta);
	
?>