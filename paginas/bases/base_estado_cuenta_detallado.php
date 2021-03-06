<?php
	include('../../conexi.php');
	$link = Conectarse();
	$nombre_pagina = "Estado de Cuenta";
	include('../../funciones/generar_select.php');
	include("../../paginas/login/login_check.php");
	
	
	
	
	
?>


<!DOCTYPE html>
<html lang="es_mx">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo $nombre_pagina;?></title>
		<?php include('../../styles.php')?>
	</head>
	<body id="page-top">
		<?php include("../../navbar.php")?>
		<div id="wrapper" class="d-print-none">
			<?php include("../../menu.php")?>	
			<div id="content-wrapper">		
				<div class="container-fluid">		
					<!-- Breadcrumbs-->
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="#">Bases</a> 
						</li>
						<li class="breadcrumb-item active"><?php echo $nombre_pagina; ?></li>
					</ol>
					
					<form id="form_filtro" autocomplete="off">
						<button  type="submit" id="btn_buscar"  class="btn btn-primary" >
							<i class="fas fa-search"></i> Buscar
						</button> 
						<div class="row"> 
							<div class="col-sm-2">
								<label>Año:</label>
								<select class="form-control filtro" id="year" name="year" >
									<option <?= date("Y") == "2020" ? "selected": "";?> value="2020">2020</option>
									<option <?= date("Y") == "2021" ? "selected": "";?> value="2021">2021</option>
									<option <?= date("Y") == "2022" ? "selected": "";?> value="2022">2022</option>
									<option <?= date("Y") == "2023" ? "selected": "";?> value="2023">2023</option>
								</select>
							</div>
							<div class="col-sm-2">
								<label>Mes Inicial:</label>
								<select class="form-control filtro" id="mes_inicial" name="mes_inicial" >
									
									<option <?= date("n") == "1" ? "selected": "";?> value="1">Enero</option>
									<option <?= date("n") == "2" ? "selected": "";?> value="2">Febrero</option>
									<option <?= date("n") == "3" ? "selected": "";?> value="3">Marzo</option>
									<option <?= date("n") == "4" ? "selected": "";?> value="4">Abril</option>
									<option <?= date("n") == "5" ? "selected": "";?> value="5">Mayo</option>
									<option <?= date("n") == "6" ? "selected": "";?> value="6">Junio</option>
									<option <?= date("n") == "7" ? "selected": "";?> value="7">Julio</option>
									<option <?= date("n") == "8" ? "selected": "";?> value="8">Agosto</option>
									<option <?= date("n") == "9" ? "selected": "";?> value="9">Septiembre</option>
									<option <?= date("n") == "10" ? "selected": "";?> value="10">Octubre</option>
									<option <?= date("n") == "11" ? "selected": "";?> value="11">Noviembre</option>
									<option <?= date("n") == "12" ? "selected": "";?> value="12">Diciembre</option>
									
								</select>
							</div>
							<div class="col-sm-2">
								<label>Mes Final:</label>
								<select class="form-control filtro" id="mes_final" name="mes_final" >
									
									<option <?= date("n") == "1" ? "selected": "";?> value="1">Enero</option>
									<option <?= date("n") == "2" ? "selected": "";?> value="2">Febrero</option>
									<option <?= date("n") == "3" ? "selected": "";?> value="3">Marzo</option>
									<option <?= date("n") == "4" ? "selected": "";?> value="4">Abril</option>
									<option <?= date("n") == "5" ? "selected": "";?> value="5">Mayo</option>
									<option <?= date("n") == "6" ? "selected": "";?> value="6">Junio</option>
									<option <?= date("n") == "7" ? "selected": "";?> value="7">Julio</option>
									<option <?= date("n") == "8" ? "selected": "";?> value="8">Agosto</option>
									<option <?= date("n") == "9" ? "selected": "";?> value="9">Septiembre</option>
									<option <?= date("n") == "10" ? "selected": "";?> value="10">Octubre</option>
									<option <?= date("n") == "11" ? "selected": "";?> value="11">Noviembre</option>
									<option <?= date("n") == "12" ? "selected": "";?> value="12">Diciembre</option>
									
								</select>
							</div>
							<div class="col-sm-3" hidden >
								<label >Base:</label>
								<?= generar_select($link, "bases", "id_base", "base", true); ?>
							</div>
						</div>
						
						<div class="row">
							
							<div class="col-sm-1 mb-3">
								
								
							</div>
						</div>
						
						
						
					</form>
					<hr>
					<div class="card mb-3">
						<div class="card-header">
							<i class="fas fa-table"></i>
							<?php echo $nombre_pagina; ?>
						</div>
						<div class="card-body">
							
							<div class="table-responsive">
								<table class="table table-bordered" id="tabla_registros" width="100%" cellspacing="0" >
									<thead>
										<tr>
											<th class="text-center">Acciones</th>
											<th class="text-center">Folio</th>
											<th class="text-center">Fecha</th>
											<th class="text-center">Fecha Aplicación</th>
											<th class="text-center">Beneficiario</th>
											<th class="text-center">Concepto</th>
											<th class="text-center">Monto</th>
											<th class="text-center">Estatus</th>
											<th class="text-center">Usuario</th>
										</tr>
									</thead>
									
									<tbody id="containerLista">
										<tr>
											<td colspan="8"><h3 class="text-center">Cargando...</h3></td>
										</tr>
									</tbody>
								</table>
								<div id="mensaje"></div>
							</div>
						</div>
						
					</div>
				</div>
				<!-- /.container-fluid -->
				
				<!-- Sticky Footer -->
				<footer class="sticky-footer">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright  Glifo Media 2020</span>
						</div>
					</div>
				</footer>
				
			</div>
			<!-- /.content-wrapper -->
		</div>
		<!-- /#wrapper -->
		
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>	
		<div class="d-print-inline d-none p-2 carta"   id="impresion">
			
		</div>
		
		<?php 
			include("../../scripts.php");
		?>
		<script >
			$(document).ready( function onLoad(){ 
	
	
	listarRegistros();
	
	
	

	
	$('#form_filtro').on('submit', function filtrar(event){
		
		listarRegistros();
		return false;
	});
	
	
		
});





function listarRegistros(){
	console.log("listarRegistros()");
	
	let form = $("#form_filtro");
	let boton = form.find(":submit");
	let icono = boton.find('.fa');
	
	boton.prop('disabled',true);
	icono.toggleClass('fa-search fa-spinner fa-pulse ');
	
	return $.ajax({
		url: 'consultas/lista_estado_cuenta_detalle.php',
		data: $("#form_filtro").serialize()
		}).done(function(respuesta){
		
		$("#tabla_registros").html(respuesta)
		
		
		}).always(function(){  
		
		boton.prop('disabled',false);
		icono.toggleClass('fa-search fa-spinner fa-pulse fa-fw');
		
	});
}


			
			</script>
	</body>
</html>
