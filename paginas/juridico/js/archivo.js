$(document).ready( function onLoad(){
	console.log("onLoad");
	listarRegistros(); 
	
	$('#password').blur( verificaPassword );
	$('#form_edicion').submit( guardarRegistro );
	$('#form_salida').submit( guardarSalida );
	$('#form_filtros').submit( function(event){
		
		event.preventDefault();
		listarRegistros();
	});
	$('.nuevo').click( nuevoRegistro );
	$('#form_edicion').find("#estatus").change( function(){
		
		if($(this).val() == "En Archivo"){
			$("#ubicacion").closest(".form-group").show();
			$("#lugar_salida").closest(".form-group").hide();
		}
		else{
			$("#ubicacion").closest(".form-group").hide();
			$("#lugar_salida").closest(".form-group").show();
		}
		
	} );
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
	$("#link_imagen").attr("href", "");
	$("#foto_thumb").attr("src", "");
	$("#foto").val("");
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


function guardarSalida(event){
	console.log("guardarRegistro")
	event.preventDefault();
	let datos = $(this).serialize();
	let boton = $(this).find(":submit");
	let icono = boton.find(".fas");
	
	
	
	
	boton.prop("disabled", true);
	icono.toggleClass("fa-save fa-spinner fa-spin");
	
	
	verificaPassword().done(function(respuesta){
		if(respuesta.valido =="NO"){
			alertify.error("Contraseña Incorrecta")
			boton.prop("disabled", false);
			icono.toggleClass("fa-save fa-spinner fa-spin");
			
		}
		else{
			$.ajax({
				url: 'control/guardar_salida.php',
				dataType: 'JSON',
				method: 'POST',
				data: datos
				
				}).done(function(respuesta){
				
				if(respuesta.estatus == "success"){
					alertify.success('Se ha agregado correctamente');
					$('#form_salida')[0].reset();
					$('#modal_salida').modal("hide");
					imprimirSalida(respuesta.folio)
					
					listarRegistros();
					}else{
					
					console.log(respuesta.mensaje);
				}
				}).always(function(){
				
				boton.prop("disabled", false);
				icono.toggleClass("fa-save fa-spinner fa-spin");
				
				
			}); 
			
			
		}
		
	})
	
	
}


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
		$('.btn_salida').on('click', modalSalida);
		$('.btn_historial').on('click', modalHistorial);
		
		}).always(function(){
		boton.prop('disabled',false);
		icono.toggleClass('fa-search fa-spinner fa-pulse');
		
	});
}

function imprimirSalida(folio) {
	console.log("imprimirSalida()");
	// let boton = $("#form_filtros").find(":submit");
	// let icono = boton.find('.fas');
	
	// boton.prop('disabled',true);
	// icono.toggleClass('fa-search fa-spinner fa-pulse ');
	
	
	$.ajax({
		url: 'impresion/imprimir_salida.php',
		method: 'GET',
		data: {
			"folio" :folio
		}
		}).done(function(respuesta){
		
		$('#impresion').html(respuesta);
		
		window.print();
		
		}).always(function(){
		// boton.prop('disabled',false);
		// icono.toggleClass('fa-search fa-spinner fa-pulse');
		
	});
}

function verificaPassword() {
	console.log("verificaPassword()");
	
	
	return $.ajax({
		url: 'control/verifica_password.php',
		method: 'GET',
		data:{
			"id_personal": $("#id_personal").val(),
			"password": $("#password").val()
		}
	});
}


function modalSalida(event){
	$("#salida_id_archivo").val($(this).data("id_registro"));
	$("#salida_nombre").val($(this).data("nombre"));
	
	$("#modal_salida").modal("show");
	
}



function modalHistorial(event){
	
	console.log("modalHistorial()");
	let boton = $(this);
	let icono = boton.find('.fas');
	let id_registro = boton.data('id_registro');
	
	
	boton.prop('disabled',true);
	icono.toggleClass('fa-clock fa-spinner fa-spin ');
	
	
	
	return $.ajax({
		url: 'control/modal_historial.php',
		method: 'GET',
		data:{
			"id_archivo": id_registro
		}
		}).done(function(respuesta){
		
		$("#modal_historial .modal-body").html(respuesta);
		$("#modal_historial").modal("show");
		}).always(function(){
		
		boton.prop('disabled',false);
		icono.toggleClass('fa-clock fa-spinner fa-spin ');
		
		
	});
	
	
	$("#modal_salida").modal("show");
	
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
			
			$("#form_edicion").find("#"+key).val(value);
			switch(key){
				case "foto":
				console.log("foto" , value)
				$("#foto_thumb").attr("src", value);
				$("#link_imagen").attr("href", value);
				console.log("link_imagen ", value)
				break;
				case "estatus":
				
				if(value == "En Archivo"){
					$("#ubicacion").closest(".form-group").show();
					$("#lugar_salida").closest(".form-group").hide();
				}
				else{
					$("#ubicacion").closest(".form-group").hide();
					$("#lugar_salida").closest(".form-group").show();
				}
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
