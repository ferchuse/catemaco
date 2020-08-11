$(document).ready( function onLoad(){
	console.log("onLoad");
	listarRegistros(); 
	
	$('#form_edicion').submit( guardarRegistro );
	$('#form_filtros').submit( function(event){
		
		event.preventDefault();
		listarRegistros();
	});
	$('.nuevo').click( nuevoRegistro );
	// $("#tabla_registros").tableExport();
	
});


$('.fileupload').fileupload({
	dataType: 'json',
	done: function (e, data) {
		
		$form_group = $(this).closest(".form-group");
		
		$.each(data.result.files, function (index, file) {
			$form_group.find(".url").val("/catemaco/fileupload/files/"+file.name);
			
			$form_group.find("img").attr("src", "/catemaco/fileupload/files/"+file.name);
			
		});
	},
	progressall: function (e, data) {
		$form_group = $(this).closest(".form-group");
		
		var progress = parseInt(data.loaded / data.total * 100, 10);
		$form_group.find(".progress-bar").css("width" , progress +"%");
		$form_group.find(".progress-bar").html(progress +"%");
	}
});




function nuevoRegistro(event){
	console.log("nuevoRegistro") 
	$("#form_edicion")[0].reset();
	$("#modal_edicion").modal("show");
	
}
function guardarRegistro(event){
	console.log("guardarRegistro")
	event.preventDefault();
	let datos = $(this).serialize();
	let boton = $(this).find(":submit");
	let icono = boton.find(".fas");
	
	boton.prop("disabled", true);
	icono.toggleClass("fa-save fa-spinner fa-spin");
	
	$.ajax({
		url: 'control/guardar_archivo.php',
		dataType: 'JSON',
		method: 'POST',
		data: datos
		
	}).done(
	function(respuesta){
		
		if(respuesta.estatus == "success"){
			alertify.success('Se ha agregado correctamente');
			$('#form_edicion')[0].reset();
			$('#modal_edicion').modal("hide");
			listarRegistros();
			}else{
			console.log(respuesta.mensaje);
		}
		}).always(function(){
		
		boton.prop("disabled", false);
		icono.toggleClass("fa-save fa-spinner fa-spin");
		
		
	}); 
}

//FUNCION DE ENLISTAR
function listarRegistros() {
	console.log("listarRegistros()");
	let boton = $("#form_filtros").find(":submit");
	let icono = boton.find('.fas');
	
	boton.prop('disabled',true);
	icono.toggleClass('fa-search fa-spinner fa-pulse ');
	
	
	$.ajax({
		url: 'control/lista_archivo.php',
		method: 'GET',
		data: $("#form_filtros").serialize()
		}).done(function(respuesta){
		
		$('#lista_registros').html(respuesta);
		
		
		$('.btn_editar').on('click', cargarRegistro);
		
		}).always(function(){
		boton.prop('disabled',false);
		icono.toggleClass('fa-search fa-spinner fa-pulse');
		
	});
}
function cargarRegistro(event){
	console.log("event", event);
	let $boton = $(this);
	let $icono = $(this).find(".fas");
	let $id_registro = $(this).data("id_registro");				
	$boton.prop("disabled", true);
	$icono.toggleClass("fa-edit fa-spinner fa-spin");				
	$.ajax({ 
		"url": "../../funciones/fila_select.php",
		"dataType": "JSON",
		"data": {
			"tabla": "archivo",
			"id_campo": "id_archivo",
			"id_valor": $id_registro						
		}
		}).done( function alTerminar (respuesta){					
		console.log("respuesta", respuesta);
		
		$.each(respuesta.data, function(key, value){
			
			$("#"+key).val(value);
			switch(key){
				case "foto":
				$("#foto_thumb").attr("src", value);
				break;
				
				
				default:
				
				
			}
		})
		
		
		$("#modal_edicion").modal("show")
		
		
		}).fail(function(){
		
		
		}).always(function(){
		$boton.prop("disabled", false);
		$icono.toggleClass("fa-edit fa-spinner fa-spin"); 
		
	})
}
