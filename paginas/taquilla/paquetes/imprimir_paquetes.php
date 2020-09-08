<?php 
	include('../../../conexi.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	// $boletos_id= implode("," ,$_GET['boletos']);
	
	$consulta = "SELECT * FROM paquetes
	LEFT JOIN usuarios  USING(id_usuarios)
	LEFT JOIN taquillas ON taquillas.id_taquilla = paquetes.id_taquilla_destino
	LEFT JOIN corridas USING(id_corridas)
	WHERE id_paquetes = '{$_GET["id_paquetes"]}' 
	";
	
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
		$respuesta.= "!"; //Double Height
		$respuesta.= "\x1b"."E".chr(1); // Bold
		
		$respuesta.=  "  ENVIO DE PAQUETERIA \n";
		$respuesta.=  "\x1b"."E".chr(0); // Not Bold
		$respuesta.= "!".chr(0);
			// $respuesta.= "!"; //Double Height
		
		
		// $respuesta.=  "  ENVIO DE PAQUETERIA \n";
	
		// $respuesta.= "!".chr(0);
		// $respuesta.= "!".chr(0). "FONTA A \n";
		// $respuesta.= "!".chr(1). "FONTA B \n";
		
		$respuesta.= "\x1b"."d".chr(1); // 4 Blank lines
		$respuesta.= "  Folio:". $registro["id_paquetes"]. "\n";
		$respuesta.= "  Num Eco:". $registro["num_eco"]. "\n";
		$respuesta.= "  Fecha:" . date("d/m/Y", strtotime($registro["fecha_paquetes"]))."\n";
		$respuesta.= "  Hora:" . date("H:i:s", strtotime($registro["fecha_paquetes"]))."\n";
		$respuesta.= "  Taquilla Destino :". $registro["nombre_taquilla"]."\n";
		$respuesta.= "  Tamaño :". $registro["tipo_paquete"]."\n";
		$respuesta.= "  Contenido :". $registro["contenido"]."\n";
		$respuesta.= "  Destinatario :". $registro["destinatario"]."\n";
		$respuesta.= "  Costo: $ ". $registro["costo"]."\n";
		$respuesta.= "  Taquillero:" . $_COOKIE["nombre_usuarios"]."\n\n\n\n";
		
		$respuesta.= "VA"; // Cut
		
		
		$respuesta.=   "\x1b"."@";
		$respuesta.= "!"; //Double Height
		$respuesta.= "\x1b"."E".chr(1); // Bold
		
		$respuesta.=  "  ENVIO DE PAQUETERIA \n";
		$respuesta.=  "\x1b"."E".chr(0); // Not Bold
		$respuesta.= "!".chr(0);
		
		$respuesta.= "\x1b"."d".chr(1); // 4 Blank lines
		$respuesta.= "  Folio:". $registro["id_paquetes"]. "\n";
		$respuesta.= "  Num Eco:". $registro["num_eco"]. "\n";
		$respuesta.= "  Fecha:" . date("d/m/Y", strtotime($registro["fecha_paquetes"]))."\n";
		$respuesta.= "  Hora:" . date("H:i:s", strtotime($registro["fecha_paquetes"]))."\n";
		$respuesta.= "  Taquilla Destino :". $registro["nombre_taquilla"]."\n";
		$respuesta.= "  Contenido :". $registro["contenido"]."\n";
		$respuesta.= "  Destinatario :". $registro["destinatario"]."\n";
		$respuesta.= "  Costo: $ ". $registro["costo"]."\n";
		$respuesta.= "  Taquillero:" . $_COOKIE["nombre_usuarios"]."\n\n";
		$respuesta.= "       COPIA \n\n\n";
		
		$respuesta.= "VA"; // Cut
		
		
		// /* Output an example receipt */
		// echo ESC."@"; // Reset to defaults
		// echo ESC."E".chr(1); // Bold
		// echo "FOO CORP Ltd.\n"; // Company
		// echo ESC."E".chr(0); // Not Bold
		// echo ESC."d".chr(1); // Blank line
		// echo "Receipt for whatever\n"; // Print text
		// echo ESC."d".chr(4); // 4 Blank lines
		
		// /* Bar-code at the end */
		// echo ESC."a".chr(1); // Centered printing
		
		// echo ESC."d".chr(1); // Blank line
		// echo "987654321\n"; // Print number
		// $respuesta.= " \x1d"."V\x41".chr(3); // Cut
		
		// $respuesta = "@@aHello World
		// !aESC/POS Printer Test
		// !aGoodbye World
		// VA"; 
		
		echo base64_encode ( $respuesta );
		exit(0);
		
		
		
	}
	else {
		echo "Error en ".$consulta.mysqli_Error($link);
		
	}
	
	
?>


