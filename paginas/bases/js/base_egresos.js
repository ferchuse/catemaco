
$(document).ready(function(){ 
	
	listarRegistros();
	
	$("#imprimir_recibos").click(function(){
		imprimirTicket($(this).data("id_registro") , $("#folios_seleccionados").val());
	});
	
	$('#form_filtro').on('submit', function filtrar(event){
		event.preventDefault();
		
		listarRegistros();
		
	});
	
	
	$('#nuevo').on('click',function(){
		$('#form_edicion')[0].reset();
		$('.modal-title').text('Nuevo Egreso');
		$('#modal_edicion').modal('show');
	}); 
	
	$('#form_edicion').on('submit', guardarRecibo)
	
	
	
	
	
});

function guardarRecibo(event){
	event.preventDefault();
	let form = $(this);
	let boton = form.find(':submit');
	let icono = boton.find('.fa');
	
	boton.prop('disabled',true);
	icono.toggleClass('fa-save fa-spinner fa-pulse ');
	
	$.ajax({
		url: 'consultas/guardar_egreso.php',
		method: 'POST',
		dataType: 'JSON',
		data: form.serializeArray()
		}).done(function(respuesta){
		if(respuesta.estatus == 'success'){
			alertify.success('Se ha agregado correctamente');
			$('#modal_edicion').modal('hide');
			imprimirTicket(respuesta.folio)
			listarRegistros();
			}else{
			alertify.error('Ocurrio un error');
		}
		}).always(function(){
		boton.prop('disabled',false);
		icono.toggleClass('fa-save fa-spinner fa-pulse fa-fw');
	});
}



function listarRegistros(){
	console.log("listarRegistros()");
	
	let form = $("#form_filtro");
	let boton = form.find(":submit");
	let icono = boton.find('.fa');
	
	boton.prop('disabled',true);
	icono.toggleClass('fa-search fa-spinner fa-pulse ');
	
	return $.ajax({
		url: 'consultas/lista_egresos.php',
		data: $("#form_filtro").serialize()
		}).done(function(respuesta){
		
		$("#tabla_registros").html(respuesta)
		
		$(".imprimir").click(function(){
			imprimirTicket($(this).data("id_registro"))
		});
		
		$(".cancelar").click(confirmaCancelacion);
		
		// $("#check_all").change(checkAll);
		
		// $(".seleccionar").change(contarSeleccionados)
		
		}).always(function(){  
		
		boton.prop('disabled',false);
		icono.toggleClass('fa-search fa-spinner fa-pulse fa-fw');
		
	});
}

function imprimirTicket( folio){
	// var boton = $(this);
	// var icono = boton.find("fas");
	
	// boton.prop("disabled", true);
	// icono.toggleClass("fa-print fa-spinner fa-spin");
	
	$.ajax({
		url: "impresion/imprimir_egreso.php",
		data:{
			folio: folio
		}
		}).done(function (respuesta){
		$("#impresion").html(respuesta)
		
		setTimeout( function(){
			
			window.print();
		}, 500);
		
		}).always(function(){
		
		// boton.prop("disabled", false);
		// icono.toggleClass("fa-print fa-spinner fa-spin");
		
	});
}	




function confirmaCancelacion(event){
	console.log("confirmaCancelacion()");
	let boton = $(this);
	let icono = boton.find(".fas");
	var folio = $(this).data("id_registro");
	
	alertify.confirm('Confirmación', '¿Deseas Cancelar?', cancelarRegistro , function(){});
	
	
	function cancelarRegistro(){
		
		boton.prop("disabled", true);
		icono.toggleClass("fa-times fa-spinner fa-spin");
		
		return $.ajax({ 
			url: "consultas/cancelar_egreso.php",
			dataType:"JSON",
			data:{
				folio : folio
			}
			}).done(function (respuesta){
			if(respuesta.result == "success"){
				alertify.success("Cancelado");
				listarRegistros();
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


