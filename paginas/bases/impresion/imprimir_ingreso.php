<?php 
	include('../../../conexi.php');
	
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	
	$consulta = "SELECT * FROM base_ingresos
	LEFT JOIN bases USING(id_base)
	LEFT JOIN usuarios USING(id_usuarios)
	
	
	WHERE id_ingreso = {$_GET["folio"]}";
	
	
	$result = mysqli_query($link,$consulta);
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			
			die("<div class='alert alert-danger'>Registro no encontrado</div>");
			
			
		}
		
		while($row = mysqli_fetch_assoc($result)){
			
			$fila = $row ;
			
		}
		
		$respuesta = "";
		
		
		
		$respuesta.=  "\x1b"."@";
		$respuesta.= "\x1b"."E".chr(1); // Bold
		$respuesta.= "!";
		$respuesta.= "RECIBO DE INGRESO \n";
		$respuesta.= "\x1b"."E".chr(0); // Not Bold
		$respuesta.= "!\x10";
		$respuesta.= "\x1b"."d".chr(1); // 4 Blank lines
		$respuesta.= "Folio:   ". $fila["id_ingreso"]. "\n";
		$respuesta.= "Fecha:   " . date('d/m/Y', strtotime($fila["fecha"]))."\n";
		$respuesta.= "Hora:    " . date('H:i:s', strtotime($fila["fecha"]))."\n";
		$respuesta.= "Realiza: ". $fila["realiza"]."\n";
		$respuesta.= "Monto:   $ ". $fila["monto"]."\n";
		$respuesta.= "Recibe:  ". $fila["nombre_usuarios"]."\n";
		
		$respuesta.= "\x1b"."d".chr(1); // Blank line
		
		$respuesta.= "\x1b"."d".chr(1). "\n"; // Blank line
		$respuesta.= "VA"; // Cut
		
		
		
		echo base64_encode ( $respuesta );
		exit(0);
		
		
		
	}
	else {
		echo "Error en ".$consulta.mysqli_Error($link);
		
	}
	
	
	
	
?>


