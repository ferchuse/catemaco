<?php 
	
	echo setcookie("id_taquilla", $_GET["id_taquilla"],  time() + (3600 * 24), "/");
	
	
	
?>