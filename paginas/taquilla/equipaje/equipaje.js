var printService = new WebSocketPrinter();

listarEquipaje();

$("#fecha").change(function(){
	
	listarEquipaje();
	listarPaquetes();
})

$("#lista_equipaje").on("click", ".btn_cancelar", confirmarCancelacion);


$("#nuevo_equipaje").click(function nuevo() {
	console.log("nuevo_equipaje")
	
	$('#form_equipaje')[0].reset();
	$("#modal_equipaje").modal("show");
	
});


$('#equipaje_id_corridas').change(eligeBoleto);
$('#tipo_equipaje').change(eligeEquipaje);

$('#form_equipaje').submit(guardarEquipaje);


function eligeEquipaje() {
	console.log("eligeEquipaje")
	
	$("#importe").val($(this).find("option:selected").data("precio"));
	
}

function listarEquipaje() {
	
	$.ajax({
		"url": "equipaje/listar_equipaje.php",
		data:{
			"fecha": $("#fecha").val()
		}
		}).done(function alCargar(respuesta) {
		$("#lista_equipaje").html(respuesta);
		
	});
}

function eligeBoleto(evnt) {
	
	let id_corridas = $(this).val();
	console.log()
	$.ajax({
		"url": "equipaje/lista_boletos_corrida.php",
		data:{
			"id_corridas": id_corridas
		}
		}).done(function alCargar(respuesta) {
		$("#pasajero").html(respuesta);
		
	});
}


function confirmarCancelacion(event){
	console.log("confirmarCancelacion")
	let $boton = $(this);
	let $fila = $(this).closest('tr');
	let $icono = $(this).find(".fas");
	let id_registro = $(this).data("id_registro");
	
	
	if(confirm("¿Estás Seguro?")){
		
		$boton.prop("disabled", true);
		$icono.toggleClass("fa-times fa-spinner fa-spin");
		$.ajax({ 
			"url": "equipaje/cancelar_equipaje.php",
			"dataType": "JSON",
			"method": "POST",
			"data": {
				"id_registro": id_registro
			}
			}).done( function alTerminar (respuesta){
			console.log("respuesta", respuesta);
			
			listarEquipaje();
			
			}).fail(function(xhr, textEstatus, error){
			console.log("textEstatus", textEstatus);
			console.log("error", error);
			
			}).always(function(){
			
			$boton.prop("disabled", false);
			$icono.toggleClass("fa-times fa-spinner fa-spin"); 
		});
	}
}		

function guardarEquipaje(event) {
	
	event.preventDefault();
	
	let boton = $(this).find(":submit");
	let icono = boton.find(".fas");
	
	boton.prop("disabled", true);
	icono.toggleClass("fa-save fa-spinner fa-spin");
	
	$.ajax({
		url: "equipaje/guardar.php",
		method: "POST",
		dataType: "JSON",
		data: $("#form_equipaje").serialize()
		
		}).done(function (respuesta) {
		console.log("respuesta", respuesta);
		if (respuesta.estatus == "success") {
			
			alertify.success(respuesta.mensaje);
			
			$("#modal_equipaje").modal("hide");
			listarEquipaje();
			imprimirEquipaje(respuesta.folio);
		}
		}).fail(function (xht, error, errnum) {
		
		alertify.error("Error", errnum);
		}).always(function () {
		boton.prop("disabled", false);
		icono.toggleClass("fa-save fa-spinner fa-spin");
		
	});
	
}


function imprimirEquipaje(id_equipaje){
	console.log("imprimirequipaje()");
	
	
	$.ajax({
		url: "equipaje/imprimir_equipaje.php" ,
		data:{
			"id_equipaje" : id_equipaje
		}
		}).done(function (respuesta){
		
		let ticket_text = atob(respuesta);
		
		console.log("Texto Ticket:", ticket_text);
		
		window.AppInventor.setWebViewString(ticket_text);
		
		
		
		printService.submit({
			'type': 'LABEL',
			'raw_content': respuesta
		});
		
		
		}).always(function(){
		
		
	});
}
