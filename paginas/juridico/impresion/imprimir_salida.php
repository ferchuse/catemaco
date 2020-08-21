<?php 
	include('../../../conexi.php');
	$link = Conectarse();
	
    $consulta = "
	
	SELECT * FROM salida_archivo
	LEFT JOIN personal USING (id_personal)
	LEFT JOIN archivo USING (id_archivo)
	
	WHERE id_salida_archivo = '{$_GET["folio"]}'
	
	";
    
	
	
    $result = mysqli_query($link,$consulta);
    
	if($result){
		
		if( mysqli_num_rows($result) == 0){
			
			die("<div class='alert alert-danger'>No encontrado</div>");
			
			
		}
		
		while($row = mysqli_fetch_assoc($result)){
		
			$fila = $row ;
			
			
		}
		
	?> 
	<div class="media_carta">
		<div class="row">
			<div class="col-12 text-center" >
				<img  hidden 
				src="../../img/amt.jpg" class="img-fluid">
			</div>
			<div class="col-12 text-center">
				<h4>CORDINADORA DE TRANSPORTE GRUPO AAZ A.C.</h4>
			</div>
		</div>
		<hr>
		<legend class="text-center">SALIDA DE ARCHIVO</legend> 
		
		<div class="row">
			<div class="col-12 text-center">
				
                <p>NOMBRE EN LA RUTA () A PARTIR DEL FECHA AL <?php echo $fecha_trabajo;?></p>
			</div>	 
		</div>
		</div>
		</div>
		</div>
        <legend>LICENCIA: </legend>
        <legend>NUM.LIC: <?php echo $filas['noLicencia_conductores'];?> <p>TEL:</p></legend>
        <div class="row">
            <div class="col-5">
                <p>TITULAR:NOMBRE DEL TITULAR</p>
                <p>TITULAR:LIC.NOMBRE DEL LIC</p>
            </div>
        </div>
	</div>
<?php    
	}
	else {
		echo "Error en ".$consulta.mysqli_Error($link);
		
	}
?>																																				