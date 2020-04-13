
listarPaquetes();


$("#nuevo_paquete").click(function nuevo() {
	console.log("nuevo_paquete")
	
	$('#form_paquetes')[0].reset();
	$("#modal_paquetes").modal("show");
	
});



$('#form_paquetes').submit(guardarPaquete);


function listarPaquetes() {
	
	$.ajax({
		"url": "paquetes/listar_paquetes.php",
		data:{
			"id_corridas": $("#form_boletos #id_corridas").val()
		}
		}).done(function alCargar(respuesta) {
		$("#lista_paquetes").html(respuesta);
		
	});
}


function guardarPaquete(event) {
	
	event.preventDefault();
	
	let boton = $(this).find(":submit");
	let icono = boton.find(".fas");
	
	boton.prop("disabled", true);
	icono.toggleClass("fa-save fa-spinner fa-spin");
	
	$.ajax({
		url: "paquetes/guardar.php",
		method: "POST",
		dataType: "JSON",
		data: $("#form_paquetes").serialize() + "&id_corridas="+ $("#form_boletos #id_corridas").val()
		
		}).done(function (respuesta) {
		console.log("respuesta", respuesta);
		if (respuesta.estatus == "success") {
			
			alertify.success(respuesta.mensaje);
			
			$("#modal_paquetes").modal("hide");
			listarPaquetes();
			imprimirPaquete(respuesta.folio);
		}
		}).fail(function (xht, error, errnum) {
		
		alertify.error("Error", errnum);
		}).always(function () {
		boton.prop("disabled", false);
		icono.toggleClass("fa-save fa-spinner fa-spin");
		
	});
	
}



function imprimirPaquete(id_paquetes){
	console.log("imprimirPaquete()");

	
	$.ajax({
		url: "paquetes/imprimir_paquetes.php" ,
		data:{
			"id_paquetes" : id_paquetes
		}
		}).done(function (respuesta){
		
		printService.submit({
			'type': 'LABEL',
			'raw_content': respuesta
		});
		}).always(function(){
		
		
	});
}


function confirmaBorrar(event){
	console.log("confirmaBorrar")
	let $boton = $(this);
	let $fila = $(this).closest('tr');
	let $icono = $(this).find(".fas");
	$boton.prop("disabled", true);
	$icono.toggleClass("fa-trash fa-spinner fa-spin");
	
	if(confirm("¿Estás Seguro?")){
		$.ajax({ 
			"url": "../../funciones/fila_delete.php",
			"dataType": "JSON",
			"method": "POST",
			"data": {
				"tabla": "cat_gastos",
				"id_campo": "id_cat_gastos",
				"id_valor": $boton.data("id_registro")
			}
			}).done( function alTerminar (respuesta){
			console.log("respuesta", respuesta);
			
			$fila.remove();
			
			}).fail(function(xhr, textEstatus, error){
			console.log("textEstatus", textEstatus);
			console.log("error", error);
			
			}).always(function(){
			
			$boton.prop("disabled", false);
			$icono.toggleClass("fa-trash fa-spinner fa-spin"); 
		});
	}
}		



