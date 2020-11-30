<?php
	$nombre_pagina = "Límites Mensuales";
	$id= "id_cargos";
	$tabla = "cargos_unidades";
	
	include("../../conexi.php");
	include("../../funciones/generar_select.php");
	include("../../paginas/login/login_check.php");
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
		
		<title>Limites Mensuales</title>
		<?php include("../../styles.php")?>
	</head>
	
	<body id="page-top">
		
		<?php include("../../navbar.php")?>
		
		
		<div id="wrapper" class="d-print-none">
			
			<!-- Sidebar -->
			<?php include("../../menu.php")?>
			
			<div id="content-wrapper">
				
				<div class="container-fluid">
					
					<!-- Breadcrumbs-->
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="#">Movimientos</a>
						</li> 
						<li class="breadcrumb-item active">Límites Mensuales</li>
					</ol>
					
					
					
					<!--Form Filtro !-->
					<form id="form_filtro" autocomplete="off">
						
						
						<div class="row mb-2">
							<div class="col-sm-3">
								<label for="nombre_condonaciones">Mes:</label>
								
								
								<select class="form-control" name="mes_cargos">
									<option value="202112">2021-12 </option>
									<option value="202111">2021-11 </option>
									<option value="202110">2021-10 </option>
									<option value="202109">2021-09 </option>
									<option value="202108">2021-08 </option>
									<option value="202107">2021-07 </option>
									<option value="202106">2021-06 </option>
									<option value="202105">2021-05 </option>
									<option value="202104">2021-04 </option>
									<option value="202103">2021-03 </option>
									<option value="202102">2021-02 </option>
									<option value="202101">2021-01 </option>
									<option value="202012">2020-12 </option>
									<option selected value="202011">2020-11 </option>
									<option value="202010">2020-10 </option>
									<option value="202009">2020-09 </option>
									<option value="202008">2020-08 </option>
									<option value="202007">2020-07 </option>
									<option value="202006">2020-06 </option>
									<option value="202005">2020-05 </option>
									<option value="202004">2020-04 </option>
									<option value="202003">2020-03 </option>
									<option value="202002">2020-02 </option>
									<option value="202001">2020-01 </option>
									
								</select>
								
							</div>
							
							
							<div class="col-sm-2 mt-4">
								<button class="btn btn-primary " >
									<i class="fas fa-search"></i> Buscar
								</button>
							</div>
							
							
						</div>
						
					</form>
					
					<hr>
					<div class="card card-primary mb-3" >
						<div class="card-header bg-info text-white">
							<i class="fas fa-table"></i>
							<?php echo $nombre_pagina?> 
						</div>
						<div class="card-body">
							<div class="table-responsive" id="tabla_registros">
								<h4 class="text-center">
									
								</h4>
							</div>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
				
				<!-- Sticky Footer -->
				<footer class="sticky-footer">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright © Glifo Media 2018</span>
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
		
		<div class="d-print-block p-2 " hidden id="ticket" >
		</div>
		
		
		<?php include("../../scripts.php")?>
		<script src="js/limites_mensuales.js"></script>
	</body>
	
</html>																																		