<?php 
	session_start();
	if(count($_SESSION) == 0){
		die("<div class='alert alert-danger'>Tu Sesión ha caducado, recarga la página.</div>");
	}
	include('../../../conexi.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	
	
	
	$consulta_guia = "SELECT *, nombre_origenes as destino
	
	FROM	boletos 
	LEFT JOIN usuarios USING(id_usuarios)
	LEFT JOIN corridas USING(id_corridas)
	
	LEFT JOIN precios_boletos USING(id_precio)
	LEFT JOIN origenes ON precios_boletos.id_destinos = origenes.id_origenes
	WHERE id_corridas = '{$_GET["id_corridas"]}' 
	ORDER BY num_asiento
	";
  
	
	$result_guia = mysqli_query($link,$consulta_guia);
	
	
	while($fila_guia = mysqli_fetch_assoc($result_guia)){
		
		$guias[] = $fila_guia ;
	}
	
	
	
	$consulta_gastos = "SELECT * FROM gastos_corrida
	LEFT JOIN cat_gastos USING(id_cat_gastos)
	
	WHERE id_corridas = '{$_GET["id_corridas"]}' 
	ORDER BY fecha_gastos ";
	
	
	$result_gastos = mysqli_query($link,$consulta_gastos);
	
	while($fila = mysqli_fetch_assoc($result_gastos)){ 
		$gastos[] = $fila ;
		
	}
	
	if($result_guia){
		
		if( mysqli_num_rows($result_guia) == 0){
			die("<div class='alert alert-danger'>No hay boletos venidos</div>");
			
		}
		
		
		
		$respuesta = file_get_contents('logo_brujaz.tmb');
		
		$empresa = "";
		
		$respuesta.=   "\x1b"."@";
		$respuesta.= "\x1b"."E".chr(1); // Bold
		// $respuesta.= "!";
		// $respuesta.= "!";
		$respuesta.= "!\x10"; //font size
		$respuesta.=   "$empresa \n";
		$respuesta.=   "GUIA \n";
		$respuesta.=  "\x1b"."E".chr(0); // Not Bold
		$respuesta.= "!\x10"; //font size
		$respuesta.= "Folio: ". $guias[0]["id_corridas"];
		$respuesta.= "\x1b"."d".chr(1); // 4 Blank lines
		$respuesta.= "Fecha:". $guias[0]["fecha_corridas"];
		$respuesta.= "\x1b"."d".chr(1); // 4 Blank lines
		
		$respuesta.= "Taquillero:". $guias[0]["nombre_usuarios"];
		$respuesta.= "\x1b"."d".chr(1); // 4 Blank lines
		
		$respuesta.= "Num Eco:". $guias[0]["num_eco"];
		$respuesta.= "\x1b"."d".chr(1); // 4 Blank lines
		
		
		$respuesta.=   "\x1b"."@"; // RESET defaults
		$respuesta.= "\x1b"."d".chr(2); // 4 Blank lines
		
		
		
		$total_guia = 0;
		$total_boletos = 0;
		if(!$result_guia){
			echo "<pre>".mysqli_error($result_guia)."</pre>";
			
		}
		
		foreach($guias AS $i =>$fila){
			if($fila["estatus_boletos"] == "Cancelado"){
				
				
				$respuesta.= "CANCELADO:";
				$respuesta.=  $fila["num_asiento"]."\x09";
				$respuesta.=  $fila["nombre_pasajero"]."\x09"."\x09";
				$respuesta.="$". number_format($fila["precio_boletos"],2)."\x09   ";
				
				$respuesta.= "\x1b"."d".chr(1); // Blank line
				
			}
			else{
				$importe= $fila["precio_boletos"];
				$total_guia+= $importe;
				$total_boletos++;
				
				$respuesta.=  $fila["num_asiento"]."\x09";
				$respuesta.=  $fila["nombre_pasajero"]."\x09"."\x09";
				$respuesta.="$". number_format($fila["precio_boletos"],2)."\x09   ";
				
				$respuesta.= "\n"; // Blank line
				
				
			}
			
			
		}
		
		$respuesta.= "!\x10"; //font size
		$respuesta.= "\nTOTAL:   $". number_format($total_guia). "\n"; // Blank line
		$respuesta.= "Boletos Vendidos:  ". $total_boletos ."\n"; // Blank line
		$respuesta.= "\x1b"."d".chr(1). "\n"; // Blank line
		// $respuesta.= "VA"; // Cut
		
		
		//GASTOS
		
		
		$respuesta.=   "\x1b"."@";
		$respuesta.= "\x1b"."E".chr(1); // Bold
		$respuesta.= "!\x10"; //font size
		$respuesta.=   "LISTA DE  GASTOS \n";
		
		
		foreach($gastos AS $i =>$gasto){
			$importe= $gasto["importe"];
			$total_gastos+= $importe;
			
			$respuesta.=  $gasto["fecha_gastos"]."\x09";
			$respuesta.=  $gasto["descripcion_gastos"]."\x09"."\x09";
			$respuesta.="$". number_format($gasto["importe"])."\x09   ";
			$respuesta.= "\x1b"."d".chr(1); // Blank line
			
			$respuesta.=   "\x1b"."@"; 
		}
		
			$respuesta.=   "\nTOTAL BOLETOS: $". number_format($total_guia). "\n";
			$respuesta.=   "TOTAL GASTOS: $". number_format($total_gastos). "\n";
			$respuesta.=   "BALANCE: $". number_format($total_guia - $total_gastos). "\n";
		
		
		
		$respuesta.= "VA"; // Cut
		
		
		
		
		// echo  ( $respuesta );
		echo base64_encode ( $respuesta );
		
		exit(0);
		
		
		
	}
	
	else {
		echo "Error en ".$consulta.mysqli_Error($link);
		
	}
	
	
?>				