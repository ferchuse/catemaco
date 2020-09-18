<?php 
	session_start();
	include('../../../conexi.php');
	include('../../../funciones/generar_select.php');
	include('../../../funciones/numero_a_letras.php');
	
	$link = Conectarse();
	$filas = array();
	$respuesta = array();
	
	
	
	if(!isset($_GET["folios"])){
		$folios = [$_GET["folio"]];	
	}
	else{	
		$folios = explode(",", $_GET["folios"]);
	}
	
	foreach($folios as $i => $folio){
		
		$consulta = "SELECT * FROM base_egresos 
		LEFT JOIN base_beneficiarios USING(id_beneficiarios) 
		LEFT JOIN usuarios USING(id_usuarios)
		WHERE id_egreso= '{$folio}'";
		
		
		$result = mysqli_query($link,$consulta); 
		if($result){
			
			// echo "FOlios: ".  sizeof($folios). " I". $i;
			if( mysqli_num_rows($result) == 0){
				
				die("<div class='alert alert-danger'>Registro No Encontrado</div>");
				
				
			}
			
			while($fila = mysqli_fetch_assoc($result)){
				
				$filas = $fila ;
				
			}
			
		?> 
		<div class="media_carta">
			<div class="row">
				<div class="col-2 text-center" >
					<img  src="../../img/logo.jpg" class="img-fluid">
				</div>
				<div class="col-7 text-center">
					<h4>Coordinadora de Transporte Grupo AAZ AC</h4>
					<legend>Egreso </legend> 
				</div>
			</div>
			
			<div class="row">
				<div class="col-6">
					<h5>
						Beneficiario: <?php echo $filas["nombre_beneficiarios"]?><br>
						Observaciones: <?php echo $filas["observaciones"]?><br> 
					</h5>
				</div>	 
				<div class="col-6 text-right">	
					<h4>Folio: <?php echo $filas["id_egreso"]?></h4>
					<h5>
						Bueno por: $  <?php echo number_format($filas["monto"], 2)?><br>
						Fecha: <?php echo $filas["fecha"]?><br>
						
					</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<p>Recibi la cantidad de $<?=$filas["monto"]?>
						(<?php echo NumeroALetras::convertir($filas["monto"], 'PESOS', 'CENTAVOS')?>)
					</p>
					<br>
					<p>Por concepto de: <?php echo $filas["observaciones"];?></p>
				</div>	 
			</div>
			
			
			<div class="row text-center">
				<div class="col-4 ">
				</div>
				<div class="col-4 border-bottom">
					<?php echo $filas["nombre_beneficiarios"];?>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-4 ">
				</div>
				<div class="col-4 ">
					Recibí
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-6 border-top">
					Impreso por: <?php echo $_COOKIE["nombre_usuarios"];?><br>
					Fecha Impresión: <?php echo date("Y-m-d h:i:s");?>
				</div>
				<div class="col-6 text-right">
					Creado por: <?php echo $filas["nombre_usuarios"];?><br>
					Fecha Creación: <?php echo $filas["fecha"]?><br>
				</div>
			</div> 
		</div> 
		
		<br>
		<br>
		<br>
		<br>
		<hr>
		
		<div class="media_carta">
			<div class="row">
				<div class="col-2 text-center" >
					<img  src="../../img/logo.jpg" class="img-fluid">
				</div>
				<div class="col-7 text-center">
					<h4>Coordinadora de Transporte Grupo AAZ AC</h4>
					<legend>Egreso </legend> 
				</div>
			</div>
			
			<div class="row">
				<div class="col-6">
					<h5>
						Beneficiario: <?php echo $filas["nombre_beneficiarios"]?><br>
						Observaciones: <?php echo $filas["observaciones"]?><br> 
					</h5>
				</div>	 
				<div class="col-6 text-right">	
					<h4>Folio: <?php echo $filas["id_egreso"]?></h4>
					<h5>
						Bueno por: $  <?php echo number_format($filas["monto"], 2)?><br>
						Fecha: <?php echo $filas["fecha"]?><br>
						
					</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<p>Recibi la cantidad de $<?=$filas["monto"]?>
						(<?php echo NumeroALetras::convertir($filas["monto"], 'PESOS', 'CENTAVOS')?>)
					</p>
					<br>
					<p>Por concepto de: <?php echo $filas["observaciones"];?></p>
				</div>	 
			</div>
			
			
			<div class="row text-center">
				<div class="col-4 ">
				</div>
				<div class="col-4 border-bottom">
					<?php echo $filas["nombre_beneficiarios"];?>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-4 ">
				</div>
				<div class="col-4 ">
					Recibí
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-6 border-top">
					Impreso por: <?php echo $_COOKIE["nombre_usuarios"];?><br>
					Fecha Impresión: <?php echo date("Y-m-d h:i:s");?>
				</div>
				<div class="col-6 text-right">
					Creado por: <?php echo $filas["nombre_usuarios"];?><br>
					Fecha Creación: <?php echo $filas["fecha"]?><br>
				</div>
			</div> 
		</div>
		
		<?php
			if($i < sizeof($folios) - 1){
				
				echo '<div style="page-break-after: always"></div>';
			}
		?>
		
		<?php    
			
		}
		else {
			echo "Error en ".$consulta.mysqli_Error($link);
			
		}
	}
	
	
	
?>																																				