
$("#nuevo_gasto").click(function nuevo() {
	console.log("nuevo_gasto")
	
	$('#form_gasto')[0].reset();
	$("#modal_gasto").modal("show");
	
});



$('#form_gasto').submit(guardarGasto);


function listarGastos() {
	
	$.ajax({
		"url": "gastos/listar_gastos.php",
		data:{
			"id_corridas": $("#form_boletos #id_corridas").val()
		}
		}).done(function alCargar(respuesta) {
		$("#lista_gastos").html(respuesta);
		
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

function guardarGasto(event) {
	
	event.preventDefault();
	
	let boton = $(this).find(":submit");
	let icono = boton.find(".fas");
	
	boton.prop("disabled", true);
	icono.toggleClass("fa-save fa-spinner fa-spin");
	
	$.ajax({
		url: "gastos/guardar.php",
		method: "POST",
		dataType: "JSON",
		data: $("#form_gasto").serialize() + "&id_corridas="+ $("#form_boletos #id_corridas").val()
		
		}).done(function (respuesta) {
		console.log("respuesta", respuesta);
		if (respuesta.estatus == "success") {
			
			alertify.success(respuesta.mensaje);
			
			$("#modal_gasto").modal("hide");
			listarGastos();
			imprimirGasto(respuesta.folio);
		}
		}).fail(function (xht, error, errnum) {
		
		alertify.error("Error", errnum);
		}).always(function () {
		boton.prop("disabled", false);
		icono.toggleClass("fa-save fa-spinner fa-spin");
		
	});
	
}


function imprimirGasto(id_gasto){
	console.log("imprimirGasto()");

	
	$.ajax({
		url: "impresion/imprimir_gasto.php" ,
		data:{
			"id_gasto" : id_gasto
		}
		}).done(function (respuesta){
		
		printService.submit({
			'type': 'LABEL',
			'raw_content': respuesta
		});
		}).always(function(){
		
		
	});
}
