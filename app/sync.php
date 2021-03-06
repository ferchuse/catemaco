<?php 
	header("Content-Type: application/json");
	
	include('../conexi.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	$respuesta["post"] = $_POST;
	
	
	
	
	// INSERT 
	foreach ($_POST["corridas"] AS $corrida){
		
		$insert ="INSERT IGNORE INTO corridas SET 
		id_corridas= '{$corrida['id_corridas']}',
		fecha_corridas= '{$corrida['fecha_corridas']}',
		hora_corridas= '{$corrida['hora_corridas']}',
		total_guia= '{$corrida['total_guia']}',
		id_taquillas = '{$corrida['id_taquillas']}',
		id_usuarios = '{$corrida["id_usuarios"]}',
		origen = '{$corrida["origen"]}',
		destino = '{$corrida["destino"]}',
		num_eco = '{$corrida["num_eco"]}',
		id_empresas = '{$corrida["id_empresas"]}',
		id_administrador = '2',
		estatus_corridas = 'Finalizada'
		";
		
		$result = 	mysqli_query($link,$insert);
		
		if($result){
			$respuesta["estatus_insert"] = "success";
			$respuesta["mensaje_insert"] = "Guardado Correctamente";
			$respuesta["insert"] = $insert;
		}
		else{
			$respuesta["estatus_insert"] = "error";
			$respuesta["mensaje_insert"] = "Error en insert: $insert  ".mysqli_error($link);		
		}
		
	}
	
	$respuesta["post_zitlalli"] = post_zitlalli($_POST);
	
		function post_zitlalli($corridas){
		$url = 'http://zitlalli.com/app/sync.php';
		
		$ch = curl_init(); //ajax
		curl_setopt($ch, CURLOPT_URL, $url); //url
		curl_setopt($ch, CURLOPT_POST, true); // method
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($corridas)) ; // data
		
		$result = curl_exec($ch);
		if($result === FALSE){
			$respuesta["curl_estatus"] = "error";
			$respuesta["curl_mensaje"] = 'Curl failed: '. curl_error($ch);
		}
		else{
			
		}
		curl_close($ch);
		return $result;
	}		
	
	
	
	
	
	////TAQUILLAS
	
	$update_folios = "UPDATE taquillas 
	SET folio_corrida = '{$_POST["folio_corrida"]}',
	folio_taquilla = '{$_POST["folio_taquilla"]}'
	WHERE id_taquilla = '{$_POST["corridas"][0]["id_taquillas"]}'
	";
	$respuesta["update_folios"] = $update_folios;
	
	$result = mysqli_query($link,$update_folios);
	if($result){
		$respuesta["estatus_folios"] = "success";
		$respuesta["mensaje_folios"] = "Guardado Correctamente";
	}
	else{
		$respuesta["estatus_folios"] = "error";
		$respuesta["mensaje_folios"] = mysqli_error($link);		
	}
	
	echo json_encode($respuesta);
	
	
	
?>			