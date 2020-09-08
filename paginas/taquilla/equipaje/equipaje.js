listarEquipaje();


$("#lista_equipaje").on("click", ".btn_cancelar", confirmarCancelacion);


$("#nuevo_equipaje").click(function nuevo() {
	console.log("nuevo_equipaje")
	
	$('#form_equipaje')[0].reset();
	$("#modal_equipaje").modal("show");
	
});


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
			
		}
		}).done(function alCargar(respuesta) {
		$("#lista_equipaje").html(respuesta);
		
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
		data: $("#form_equipaje").serialize() + "&id_corridas="+ $("#form_boletos #id_corridas").val()
		
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
		url: "imprimir_equipaje.php" ,
		data:{
			"id_equipaje" : id_equipaje
		}
		}).done(function (respuesta){
		
		printService.submit({
			'type': 'LABEL',
			'raw_content': respuesta
		});
		}).always(function(){
		
		
	});
}
