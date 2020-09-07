<?php
	include('../../conexi.php');
	$link = Conectarse();
	$nombre_pagina = "Ingresos";
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
					
					<!--Form Filtro !-->
					<form id="form_filtro" autocomplete="off">
						<div class="row mb-2">
							<div class="col-12">
								<div class="col-12 mb-3">
									<button class="btn btn-primary btn-sm" >
										<i class="fas fa-search"></i> Buscar
									</button>
									<button type="button" class="btn btn-success btn-sm" id="nuevo">
										<i class="fas fa-plus"></i> Nuevo
									</button>
									
								</div>
								
							</div>
						</div>
						
						<div class="row mb-2">
							<div class="col-sm-2">
								<label for="fecha_inicial">Fecha Inicial:</label>
								<input class="form-control" type="date" name="fecha_inicial" id="fecha_inicial" value="<?php echo date("Y-m-d");?>">	
							</div>
							<div class="col-sm-2">
								<label for="fecha_final">Fecha Final:</label>
								<input class="form-control" type="date" name="fecha_final" id="fecha_final" value="<?php echo date("Y-m-d");?>">
							</div>
							
						</div>
						
					</form>
					<hr>
					
					
					<div class="card mb-3">
						<div class="card-header">
							<i class="fas fa-table"></i>
							Lista de <?php echo $nombre_pagina; ?>
							<button hidden  id="imprimir_recibos" class="btn btn-info btn-sm float-right" type="button">
								<i class="fas fa-print"></i> Imprimir <span id="cant_seleccionados"></span>
							</button>
							<input type="hidden" id="folios_seleccionados" name="folios_seleccionados" >
						</div>
						<div class="card-body">
							
							<div class="table-responsive" id="tabla_registros">
								<table class="table table-bordered" id="tabla_recibos" width="100%" cellspacing="0" >
									<thead>
										<tr>
											<th class="text-center">Fecha</th>
											<th class="text-center">Realiza</th>
											<th class="text-center">Monto</th>
											<th class="text-center">Estatus</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									
									<tbody >
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
			include('forms/form_ingreso.php');
		?>
		<script src="../../plugins/pos_print/websocket-printer.js" > </script>
		<script src="js/base_ingresos.js?v=<?= date("d-m-Y-H-i-s")?>"></script>
		
	</body>
</html>
