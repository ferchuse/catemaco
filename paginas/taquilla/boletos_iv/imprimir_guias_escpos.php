<?php 
	session_start();
	if(count($_SESSION) == 0){
		die("<div class='alert alert-danger'>Tu Sesión ha caducado, recarga la página.</div>");
	}
	include('../../../conexi.php');
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	
	
	
	$consulta_guia = "SELECT *, nombre_origenes as destino,
	COUNT(id_boletos) AS cantidad
	FROM	boletos 
	LEFT JOIN usuarios USING(id_usuarios)
	LEFT JOIN corridas USING(id_corridas)
	
	LEFT JOIN precios_boletos USING(id_precio)
	LEFT JOIN origenes ON precios_boletos.id_destinos = origenes.id_origenes
	WHERE id_corridas = '{$_GET["id_corridas"]}' 
	GROUP BY id_precio
	";
  
	
	$result_guia = mysqli_query($link,$consulta_guia);
	
	
	while($fila_guia = mysqli_fetch_assoc($result_guia)){
		
		$guias[] = $fila_guia ;
	}
	
	if($result_guia){
		
		if( mysqli_num_rows($result_guia) == 0){
			die("<div class='alert alert-danger'>No hay boletos venidos</div>");
			
		}
		
		
		
		$respuesta = file_get_contents('logo_brujaz.tmb');
		
		$empresa = "";
		
		$respuesta.=   "\x1b"."@";
		$respuesta.= "\x1b"."E".chr(1); // Bold
		$respuesta.= "!";
		$respuesta.=   "$empresa \n";
		$respuesta.=   "GUIA \n";
		$respuesta.=  "\x1b"."E".chr(0); // Not Bold
		$respuesta.= "!\x11"; //font size
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
		if(!$result_guia){
			echo "<pre>".mysqli_error($result_guia)."</pre>";
			
		}
		
		foreach($guias AS $i =>$fila){
			$importe= $fila["cantidad"] * $fila["precio_boletos"];
			$total_guia+= $importe;
			$total_boletos += $fila["cantidad"];
			
			
			$respuesta.=  $fila["cantidad"]."\x09";
			$respuesta.=  $fila["nombre_pasajero"]."\x09"."\x09";
			$respuesta.="$". $fila["precio_boletos"]."\x09   ";
			$respuesta.= "$" .	number_format($importe,0);
			
			$respuesta.= "\x1b"."d".chr(1). "\n"; // Blank line
			
			
			
		}
		
		
		$respuesta.= "TOTAL: $". number_format($total_guia). "\n"; // Blank line
		$respuesta.= "Boletos Vendidos: ". $total_boletos ."\n"; // Blank line
		$respuesta.= "\x1b"."d".chr(1). "\n"; // Blank line
		$respuesta.= "VA"; // Cut
		echo base64_encode ( $respuesta );
		
		exit(0);
		
	?>  
	
	
	
	
	<?php
		
	}
	
	else {
		echo "Error en ".$consulta.mysqli_Error($link);
		
	}
	
	
?>		