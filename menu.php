<?php 
	if(!isset($_COOKIE["tipo_usuario"])){
		$_COOKIE["tipo_usuario"] = "recaudacion";
	}
	if($_COOKIE["tipo_usuario"] == "propietario"){?>
	
	
	<?php
	}
	else{
	?>
	
	<ul class="sidebar navbar-nav d-print-none">
		<li class="nav-item active"> 
			<a class="nav-link" href="../../index.php">
				<i class="fas fa-fw fa-home"></i>
				<span>
					Inicio 
					
				</span>
			</a>
		</li>
		<li class="nav-item dropdown ">
			<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" >
				<i class="fas fa-fw fa-folder"></i>
				<span>Catálogos</span>
			</a>
			<div class="dropdown-menu " >
				<?php 
					$q_catalogos = "SELECT * FROM paginas WHERE categoria_paginas = 'Catálogos'";	
					
					$result_catalogos = mysqli_query($link, $q_catalogos);
					if(!$result_catalogos){
						echo mysqli_error($link);
					}
					
					while($fila = mysqli_fetch_assoc($result_catalogos)){
						echo "<a class='dropdown-item' href='../../paginas/catalogos/{$fila["url_paginas"]}' ";
						echo dame_permiso($fila["url_paginas"], $link).">-{$fila['nombre_paginas']}</a>";
						
					}
				?> 
			</div>
		</li> 
		
		
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" >
				<i class="fas fa-fw fa-exchange-alt"></i>
				<span>Movimientos</span>
				</a>
			<div class="dropdown-menu" >
				<?php 
					$q_catalogos = "SELECT * FROM paginas WHERE categoria_paginas = 'Movimientos'";	
					$result_catalogos = mysqli_query($link, $q_catalogos);
					while($fila = mysqli_fetch_assoc($result_catalogos)){
						
						
						echo "<a class='dropdown-item' href='../../paginas/movimientos/{$fila["url_paginas"]}' ";
						echo dame_permiso($fila["url_paginas"], $link).">-{$fila['nombre_paginas']}</a>";
						
					}
				?> 
			</div> 
		</li> 
		
			<?php if(dame_permiso("base_ingresos.php", $link) != "Sin Acceso"){?> 
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" >
					<i class="fas fa-fw fa-home"></i>
					<span>Bases</span>
				</a>
				<div class="dropdown-menu" >
					<?php 
						$q_catalogos = "SELECT * FROM paginas WHERE categoria_paginas = 'Bases'";	
						$result_catalogos = mysqli_query($link, $q_catalogos);
						while($fila = mysqli_fetch_assoc($result_catalogos)){
							echo "<a class='dropdown-item' href='../../paginas/bases/{$fila["url_paginas"]}' ";
							echo dame_permiso($fila["url_paginas"], $link).">-{$fila['nombre_paginas']}</a>";
						}
					?> 
					
				</div>
			</li> 
			<?php 
			}
		?>
		
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" >
				<i class="fas fa-fw fa-dollar-sign"></i> 
				<span>Saldos</span>
			</a>
			<div class="dropdown-menu" > 
				<?php 
					$q_catalogos = "SELECT * FROM paginas WHERE categoria_paginas = 'Saldos'";	
					$result_catalogos = mysqli_query($link, $q_catalogos);
					while($fila = mysqli_fetch_assoc($result_catalogos)){
						echo "<a class='dropdown-item' href='../../paginas/saldos/{$fila["url_paginas"]}' ";
						echo dame_permiso($fila["url_paginas"], $link).">-{$fila['nombre_paginas']}</a>";
					}
				?> 
				
			</div>
		</li>
		
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" >
				<i class="fas fa-fw fa-ticket-alt "></i>
				<span>Catemaco</span>
			</a>
			<div class="dropdown-menu" >
				<?php 
					$q_catalogos = "SELECT * FROM paginas WHERE categoria_paginas = 'Catemaco' ORDER BY orden_paginas";	
					$result_catalogos = mysqli_query($link, $q_catalogos);
					while($fila = mysqli_fetch_assoc($result_catalogos)){
						echo "<a class='dropdown-item' href='../../paginas/taquilla/{$fila["url_paginas"]}' ";
						echo dame_permiso($fila["url_paginas"], $link).">-{$fila['nombre_paginas']}</a>";
					}
				?>
			</div>
		</li>
		
		<?php if(dame_permiso("archivo.php", $link) == "Supervisor"){?> 
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" >
					<i class="fas fa-fw fa-briefcase"></i>
					<span>Jurídico</span>
				</a>
				<div class="dropdown-menu" >
					<?php 
						$q_catalogos = "SELECT * FROM paginas WHERE categoria_paginas = 'Jurídico'";	
						$result_catalogos = mysqli_query($link, $q_catalogos);
						while($fila = mysqli_fetch_assoc($result_catalogos)){
							echo "<a class='dropdown-item' href='../../paginas/juridico/{$fila["url_paginas"]}' ";
							echo dame_permiso($fila["url_paginas"], $link).">-{$fila['nombre_paginas']}</a>";
						}
					?> 
					
				</div>
			</li> 
			<?php 
			}
		?>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" >
				<i class="fas fa-fw fa-cogs"></i>
				<span>Administración</span>
			</a>
			<div class="dropdown-menu" >
				<?php 
					$q_catalogos = "SELECT * FROM paginas WHERE categoria_paginas = 'Administración'";	
					$result_catalogos = mysqli_query($link, $q_catalogos);
					while($fila = mysqli_fetch_assoc($result_catalogos)){
						echo "<a class='dropdown-item' href='../../paginas/administracion/{$fila["url_paginas"]}' ";
						echo dame_permiso($fila["url_paginas"], $link).">-{$fila['nombre_paginas']}</a>";
					}
				?> 
				
			</div>
		</li> 
		
		
	</ul>
	
	<?php
	}
?>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span >×</span>
				</button>
			</div>
			<div class="modal-body">¿Estás seguro que deseas cerrar sesión?</div>
			<div class="modal-footer">
				<button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
				<a class="btn btn-primary" href="../../paginas/login/logout.php">Salir</a>  
			</div>
		</div>
	</div>
</div>				