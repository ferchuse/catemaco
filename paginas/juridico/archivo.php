<?php 
	include_once("../login/login_check.php");
	include("../../conexi.php");
	include("../../funciones/generar_select.php");
	
	$link = Conectarse();
	
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Archivo</title>
		<?php include('../../styles.php')?>
		<link href="../../fileupload/fileupload.css" rel='stylesheet' type='text/css'>
	</head>
	<body id="page-top">
		<?php include("../../navbar.php")?>
		<div id="wrapper" class="d-print-none">
			<?php include("../../menu.php")?>	
			<div id="content-wrapper" >		
				<div class="container-fluid">		
					<!-- Breadcrumbs-->
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="#">Jurídico</a>
						</li>
						<li class="breadcrumb-item active">Archivo</li>
					</ol>
					
					<form id="form_filtros" autocomplete="off">
						<div class="row mb-2">
							<div class="col-12">
								<div class="col-12 mb-3">
									<button  class="btn btn-primary btn-sm" >
										<i class="fas fa-search"></i> Buscar
									</button>
									
									<button type="button" class="btn btn-success btn-sm nuevo" >
										<i class="fas fa-plus"></i> Nuevo
									</button>
									<button hidden class="btn btn-info btn-sm" onclick="window.print()" type="button">
										<i class="fas fa-print"></i> Imprimir
									</button>
								</div>
								
							</div>
						</div>
						
						
						<div class="row mb-2"> 
							<div class="col-sm-1">
								<label for="">Tipo:</label>
							</div>	
							<div class="col-2">			
								<?php echo generar_select($link, "tipo_documento", "id_documento", "tipo_documento", true); ?>
							</div> 
							<div class="col-sm-1">
								<label >Estatus:</label>
							</div>	
							<div class="col-2">			
								<select class="form-control"  name="estatus" >
									<option value="">Todos</option>
									<option  >En Trámite</option>
									<option  >En Archivo</option>
								</select>
							</div> 
							<div class="col-sm-1">
								<label >Sector:</label>
							</div>	
							<div class="col-2">			
								<select class="form-control"  name="sector" >
									<option value="">Todos</option>
									<option  >Jurídico</option>
									<option  >Gestoría</option>
								</select>
							</div> 
						</div>
						
						<div class="row mb-2"> 
							<div class="col-sm-1">
								<label>Empresa </label>		
							</div>	
							<div class="col-2">			
								
								<?php echo generar_select($link, "empresas", "id_empresas", "nombre_empresas", true); ?>
								
							</div> 
							
						</div>
					</form>
					<hr>
					
					
					<div class="card mb-3">
						<div class="card-header">
							<i class="fas fa-table"></i>
							Lista de Archivo
						</div>
						<div class="card-body">
							<div class="table-responsive" id="lista_registros">
								<h3 >Cargando...</h3>
							</div>
						</div>
						
					</div>
					<!-- /.container-fluid -->
					
					<!-- Sticky Footer -->
					<footer class="sticky-footer">
						<div class="container my-auto">
							<div class="copyright text-center my-auto">
								<span>Copyright © Glifo Media 2020</span>
							</div>
						</div>
					</footer>
					
				</div>
				<!-- /.content-wrapper -->
			</div>
			<!-- /#wrapper -->
			
			<a class="scroll-to-top rounded" href="#page-top">
				<i class="fas fa-angle-up"></i>
			</a>		
			
			
			
			<div id="modal_historial" class="modal fade d-print-none" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title text-center">Historial de Movimientos <span id="nombre_historial"></span></h3>
							<button type="button" class="close d-print-none" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
						</div>
						<div class="modal-footer d-print-none">
							<button type="button" class="btn btn-danger" data-dismiss="modal">
								<i class="fa fa-times"></i> Cerrar
							</button>
							<button type="button" id="btn_imprimir_edo_cuenta" class="btn btn-info" >
								<i class="fa fa-print"></i> Imprimir
							</button>
						</div>
					</div>
				</div>
			</div>	
			
			<div id="impresion" class="d-none d-print-block" >
				
			</div>	
			
			
			<?php include("forms/form_salida.php")?>
			<?php include("forms/form_archivo.php")?>
			<?php include("../../scripts.php")?>
			
			<script src="../../fileupload/jquery.ui.widget.js"></script>
			<script src="../../fileupload/jquery.fileupload.js"></script>
			
			<script src="js/archivo.js?v=<?= date("d.m.Y.his")?>" ></script>
			
		</body>
	</html>
