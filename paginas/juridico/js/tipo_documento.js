$(document).ready( function onLoad(){
	console.log("onLoad");
	listarRegistros(); 
	
	$('#form_edicion').submit( guardarRegistro );
	$('#form_filtros').submit( function(event){
		
		event.preventDefault();
		listarRegistros();
	});
	$('#nuevo').click( nuevoRegistro );
	
});


function listarRegistros() {
	console.log("listarRegistros()");
	let boton = $("#form_filtros").find(":submit");
	let icono = boton.find('.fas');
	
	boton.prop('disabled',true);
	icono.toggleClass('fa-search fa-spinner fa-pulse ');
	
	
	$.ajax({
		url: 'control/lista_tipo_documento.php',
		method: 'GET',
		data: $("#form_filtros").serialize()
		}).done(function(respuesta){
		
		$('#lista_registros').html(respuesta);
		
		
		$('.btn_editar').on('click', cargarRegistro);
		$('.btn_borrar').on('click', confirmaBorrar);
		
		}).always(function(){
		boton.prop('disabled',false);
		icono.toggleClass('fa-search fa-spinner fa-pulse');
		
	});
}


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
		url: 'control/guardar_tipo_documento.php',
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
			"tabla": "tipo_documento",
			"id_campo": "id_documento",
			"id_valor": $id_registro						
		}
		}).done( function alTerminar (respuesta){					
		console.log("respuesta", respuesta);
		
		$.each(respuesta.data, function(key, value){
			
			$("#form_edicion").find("#"+key).val(value);
			
		})
		
		
		$("#modal_edicion").modal("show")
		
		
		}).fail(function(){
		
		
		}).always(function(){
		$boton.prop("disabled", false);
		$icono.toggleClass("fa-edit fa-spinner fa-spin"); 
		
	})
}


function confirmaBorrar(event){
	console.log("confirmaBorrar()");
	let boton = $(this);
	let icono = boton.find(".fas");
	var id_registro = $(this).data("id_registro");
	var fila = boton.closest('tr');
	
	alertify.confirm('Confirmación', '¿Deseas Borrar?', borrarRegistro , function(){});
	
	
	function borrarRegistro(){
		
		boton.prop("disabled", true);
		icono.toggleClass("fa-times fa-spinner fa-spin");
		
		return $.ajax({ 
			url: "../../funciones/fila_delete.php",
			dataType:"JSON",
			method: "POST",
			data:{
				"tabla" : "tipo_documento",
				"id_campo" : "id_documento",
				"id_valor" : id_registro
			}
			}).done(function (respuesta){
			if(respuesta.estatus == "success"){
				fila.fadeOut(500);
			}
			else{
				alertify.error(respuesta.result);
			}
			
			}).always(function(){
			boton.prop("disabled", false);
			icono.toggleClass("fa-times fa-spinner fa-spin");
			
		});
	}
}
