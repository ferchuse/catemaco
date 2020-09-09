<?php 
	include('../../../conexi.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	// $boletos_id= implode("," ,$_GET['boletos']);
	
	$consulta = "SELECT * FROM equipaje 
	LEFT JOIN usuarios  USING(id_usuarios)
	LEFT JOIN corridas USING(id_corridas)
	
	WHERE id_equipaje = '{$_GET['id_equipaje']}'";
	
	
	$result = mysqli_query($link,$consulta);
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			
			die("<div class='alert alert-danger'>Registro no encontrado</div>");
			
			
		}
		
		while($fila = mysqli_fetch_assoc($result)){
			
			$registro = $fila ;
			
		}
		
		$respuesta = "";
		
		
		$respuesta.=   "\x1b"."@";
		$respuesta.= "\x1b"."E".chr(1); // Bold
		$respuesta.= "!";
		$respuesta.=   "Equipaje extra \n";
		$respuesta.=  "\x1b"."E".chr(0); // Not Bold
		$respuesta.= "!\x10";
		$respuesta.=   "\x1b"."@";
		$respuesta.= "\x1b"."d".chr(1); // 4 Blank lines
		$respuesta.= "Folio:            ". $registro["id_equipaje"]. "\n";
		$respuesta.= "Corrida:          ". $registro["id_corridas"]. "\n";
		$respuesta.= "Fecha de Corrida: ".  date("d-m-Y", strtotime($registro["fecha_corridas"]))."\n";
		$respuesta.= "Hora de Corrida:  ". date("H:i:s", strtotime($registro["hora_corridas"]))."\n";
		$respuesta.= "Num Eco:          ". $registro["num_eco"]. "\n";
		$respuesta.= "Fecha:            " . date("d-m-Y", strtotime($registro["fecha_equipaje"]))."\n";
		$respuesta.= "Hora:             " . date("H:i:s", strtotime($registro["fecha_equipaje"]))."\n";
		$respuesta.= "Pasajero:         ". $registro["pasajero"]."\n";
		$respuesta.= "Tamano:           ". $registro["tipo_equipaje"]."\n";
		$respuesta.= "Importe:          $ ". $registro["importe"]."\n";
		$respuesta.=  "Usuario:         " . $_COOKIE["nombre_usuarios"]."\n\n";
		// $respuesta.=  utf8_decode ("tamañp ácébnós")."n\n";
		// $respuesta.=  utf8_encode ("tamañp ácébnós")."n\n";
		$respuesta.= "\x1b"."d".chr(1); // Blank line
		$respuesta.= "  _________________\n\n"; // Blank line
		$respuesta.= "aFIRMA DE RECIBIDO\n"; // Blank line
		$respuesta.= "\x1b"."d".chr(1). "\n"; // Blank line
		$respuesta.= "VA"; // Cut
		
		
		
		
		
		echo base64_encode ( $respuesta );
		exit(0);
		
		
		
	}
	else {
		echo "Error en ".$consulta.mysqli_Error($link);
		
	}
	
	
?>


