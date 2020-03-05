$(document).ready(function(){
	listarRegistros();
	
	$('#form_edicion').submit( guardarRegistro );
	$('.nuevo').click( nuevoRegistro );
	$('#num_eco').blur( buscarUnidad );
	$('#form_filtro').on('submit', function filtrar(event){
		event.preventDefault();
		
		listarRegistros();
		
	});
	
});

function buscarUnidad(){
	console.log("id_unidades", $("#id_unidades").val());
	
	
	$('#num_eco').addClass("cargando");
	var num_eco = $(this).val();
	
	
	$.ajax({
		url: '../../funciones/fila_select.php',
		method: 'GET',
		data: {
			tabla: "unidades",
			id_campo: "num_eco",
			id_valor: num_eco
			
		}
		}).done(function(respuesta){
		
		if(respuesta.count_rows > 0){
			alertify.warning("La unidad ya existe")
			$.each(respuesta.data, function(name , value){
				$("#form_edicion").find("#"+ name).val(value);
				
			});
		}
		
		}).always(function(){
		$('#num_eco').removeClass("cargando");
		
	});
}




function nuevoRegistro(event){
	
	$("#form_edicion")[0].reset();
	$('#modal_edicion').modal({ backdrop: 'static'}).modal('show').on('shown.bs.modal', function () {
		$('#form_edicion input:eq(0)').trigger("focus");
		$('#form_edicion input:eq(0)').trigger("focus");
	});
}
function guardarRegistro(event){
	event.preventDefault();
	let datos = $(this).serializeArray();
	let boton = $(this).find(":submit");
	let icono = boton.find(".fas");
	
	boton.prop("disabled", true);
	icono.toggleClass("fa-save fa-spinner fa-spin");
	
	$.ajax({
		url: 'control/guardar_unidades_historial.php',
		dataType: 'JSON',
		method: 'POST',
		data: {
			tabla: 'unidades',
			datos: datos
		}
	}).done(
	function(respuesta){
		boton.prop("disabled", false);
		icono.toggleClass("fa-save fa-spinner fa-spin");
		
		if(respuesta.estatus == "success"){ 
			alertify.success('Se ha agregado correctamente');
			$('#form_edicion')[0].reset();
			$('#modal_edicion').modal("hide");
			listarRegistros();
			}else{
			console.log(respuesta.mensaje);
		}
	});
	
	
}

function listarRegistros() {
	console.log("listarRegistros()");
	
	let form = $("#form_filtro");
	let boton = form.find(":submit");
	let icono = boton.find('.fas');
	
	boton.prop('disabled',true);
	icono.toggleClass('fa-search fa-spinner fa-pulse ');
	
	return $.ajax({
		url: 'control/listar_unidades.php',
		method: 'GET',
		data: form.serialize()
		}).done(function(respuesta){
		
		$('#lista_registros').html(respuesta);
		// $('#tabla_registros').DataTable({
		// "language": {
		// "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
		// }
		// });
		
		$('.btn_editar').on('click', cargarRegistro);
		$('.btn_historial').on('click', mostrarHistorial);
		
		}).always(function(){
		
		boton.prop('disabled',false);
		icono.toggleClass('fa-search fa-spinner fa-pulse fa-fw');
		
	});
}
//FUNCION DE Cargar datos
function cargarRegistro() {
	console.log("cargarRegistro()");
	var $boton = $(this);
	var id_registro= $(this).data("id_registro");
	
	$boton.prop("disabled", true);
	
	$.ajax({
		url: '../../funciones/fila_select.php',
		method: 'GET',
		data: {
			tabla: "unidades",
			id_campo: "num_eco",
			id_valor: id_registro
			
		}
		}).done(function(respuesta){
		console.log("imprime registros")
		$boton.prop("disabled", false);
		
		$.each(respuesta.data, function(name , value){
			$("#form_edicion").find("#"+ name).val(value);
			
		});
		
		$("#modal_edicion").modal("show");
		// $('#lista_registros').html(respuesta);
		
	});
}

function mostrarHistorial() {
	console.log("mostrarHistorial()");
	var $boton = $(this);
	var id_registro= $(this).data("id_registro");
	
	$boton.prop("disabled", true);
	
	$.ajax({
		url: 'control/mostrar_historial.php',
		method: 'GET',
		data: {
			"num_eco": id_registro
		}
		}).done(function(respuesta){
		console.log("imprime registros")
		$boton.prop("disabled", false);
		
		
		$("#modal_historial .modal-body").html(respuesta);
		
		
		$("#modal_historial").modal("show");
		
	});
}