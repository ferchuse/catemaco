<?php
	include("../../paginas/login/login_check.php");
	include('../../conexi.php');
	include('../../funciones/generar_select.php');
	// include_once('../../funciones/dame_permiso.php');
	
	$link = Conectarse();
	$nombre_pagina = "Boleto Abierto";
	
	
?>
<!DOCTYPE html>
<html lang="es">
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
		<div id="wrapper" class="">
			<?php include("../../menu.php")?>	
			<div id="content-wrapper">		
				<div class="container-fluid">		
					<!-- Breadcrumbs-->
					<ol class="breadcrumb d-print-none">
						<li class="breadcrumb-item">
							<a href="#">Taquilla</a>
						</li>
						<li class="breadcrumb-item active"><?php echo $nombre_pagina;?></li>
					</ol>
					
					<div class="card card-primary">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12">
									<?php 
										
										if(dame_permiso("boleto_abierto.php", $link) == "Supervisor"){
											$permiso = "";
										}
										else{
											$permiso = "hidden";
										}
									?>
									<form id="form_filtros" >
										<div class="row" <?= $permiso?> >
										
										
										<div class="form-group  col-sm-3">
											<label>
												Usuario:
											</label>
											<?php
												echo generar_select($link, "usuarios" , "id_usuarios", "nombre_usuarios", true, false, false, $_COOKIE["id_usuarios"],0, "id_usuarios" , "filtro_usuarios")
											?>
										</div>
										</div>
									</form>
									<div class="card card-primary mt-4 ">
										<div class="card-header bg-secondary text-white">
											<b> <i class="fas fa-ticket"></i> Boleto Abierto</b>
											<button  id="nueva_caja" type="button" class="btn btn-success mb-2 d-print-none float-right">
												<i class="fas fa-plus"></i> Nuevo
											</button>
										</div>
										<div class="card-body table-responsive">
											<div class="table-responsive" id="lista_caja">
												
												<h3 class="text-center">Cargando <i class="fas fa-spinner fa-pulse"></i></h3>
											</div>
										</div>
									</div>
								</div>
							
							</div>
						</div><!-- /.card-body-->
					</div><!-- /.card -->
				</div><!-- /.container-fluid -->
				
				
				<!-- Sticky Footer -->
				<footer class="sticky-footer">
					<div class="container my-auto ">
						<div class="copyright text-center my-auto">
							<span class="d-print-none">Copyright © Glifo Media 2020</span>
						</div>
					</div>
				</footer>
			</div> 
			<!-- /.content-wrapper -->
		</div>
		<!-- /#wrapper -->
		
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded d-print-none" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>
		
		<div class="d-print-block p-2" style="max-width:100mm;" hidden id="ticket" >
		</div>
		<?php include("caja/form_caja.php")?>
		
		<?php include("../../scripts.php")?>
		<!-- /.content-wrapper-->
		<script src="../../plugins/pos_print/websocket-printer.js" > </script>
		
		
		
		<script src="caja/caja.js?v=<?= date("Y-m-d-H-s")?>"></script>
		
	</body>
</html>																														