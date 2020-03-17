<?php 
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	include('../../../funciones/console_log.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	$boletos_id= implode("," ,$_GET['boletos']);
	
	$consulta = "SELECT * FROM gastos 
	LEFT JOIN usuarios  USING(id_usuarios)
	LEFT JOIN cat_gastos USING(id_cat_gastos)
	LEFT JOIN corridas USING(id_corridas)
	
	WHERE id_gasto = {$_GET['id_gasto']}";
  
	
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
		$respuesta.=   "GRUPO ZITLALTEPEC \n";
		$respuesta.=  "\x1b"."E".chr(0); // Not Bold
		$respuesta.= "!\x10";
		$respuesta.= "\x1b"."d".chr(1); // 4 Blank lines
		$respuesta.= "Folio:". $registro["id_gasto"]. "\n";
		$respuesta.= "Corrida:". $registro["id_corridas"]. "\n";
		$respuesta.= "Num Eco:". $registro["num_eco"]. "\n";
		$respuesta.= "Fecha:" . ($registro["fecha_boletos"])."\n";
		$respuesta.= "Recibe :". $registro["recibe"]."\n";
		$respuesta.= "Concepto :". $registro["descripcion_gastos"]."\n";
		$respuesta.= "Importe: $ ". $registro["importe"]."\n";
		$respuesta.=  "Taquillero:" . $item["nombre_usuarios"]."\n";
		$respuesta.= "\x1b"."d".chr(1); // Blank line
		$respuesta.= "aSeguro de Viajero\n"; // Blank line
		$respuesta.= "\x1b"."d".chr(1). "\n"; // Blank line
		$respuesta.= "VA"; // Cut
		
	}
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


