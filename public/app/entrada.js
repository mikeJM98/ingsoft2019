$(function() {
	$("."+modulo).addClass("active");
	$("#"+modulo).css("display", "block");
	$("#"+submodulo).addClass("active"); listado(); $("#alerta").hide();
});

function listado(){
	$("#titulo").text("Lista de habitaciones (Ocupadas, Reservadas, Libres) hoy");
	$("#content").empty().html("<center> <br><br><img src='../public/img/cargando.gif'> </center>");
	$.ajax({
		url:url_base,
		data:'accion=0',
		type:'post',
		success: function(data) {
			$("#content").empty().html(data);
		}
	});
}

function nuevo(){
	$("#titulo").text("Registro nueva "+tabla);
	$("#content").empty().html("<center> <br><br><img src='../public/img/cargando.gif'> </center>");
	$.ajax({
		url:url_base,
		data:'accion=1',
		type:'post',
		success: function(data) {
			$("#content").empty().html(data);
		}
	});
}

function agregarpais(){
	$('#des_pais').val(""); $("#botonpais").removeAttr("disabled");
    	$("#agregarpais").modal("show");
}

function guardar_pais() {
	$.ajax({
		url:url_base,
		data:'accion=5&'+$("#form_pais").serialize(),
		type:'post',
		success: function(data) {
			if (data==1) {
				alert("INGRESE OTRO PAIS ... YA EXISTE");
			}else{
				if ($('#des_pais').val().trim() === '') {
					$('#des_pais').val(""); $('#des_pais').focus();
				     	alert("DEBE INGRESAR NOMBRE DEL PAIS"); return false;
				}
				$("#botonpais").attr("disabled","true");
				$.ajax({
					url:url_base,
					data:'accion=11&'+$("#form_pais").serialize(),
					type:'post',
					success: function(data) {
						$("#pais").empty().html(data); traerciudad();
						$("#agregarpais").modal("hide"); return false;
					}
				}); return false;
			}
		}
	});  return false;
}

function agregarciudad(){
	$.ajax({
    	    	url:url_base,
		data:'accion=11&lista=1',
		type:'post',
        	success: function(data) {
            	$("#pais_id").empty().html(data);
            	$('#des_ciudad').val(""); $("#pais_id").val($("#pais").val()); $("#botonciudad").removeAttr("disabled");
    			$("#agregarciudad").modal("show");
        	}
    	});
}

function guardar_ciudad() {
	$.ajax({
		url:url_base,
		data:'accion=12&'+$("#form_ciudad").serialize(),
		type:'post',
		success: function(data) {
			if (data==1) {
				alert("INGRESE OTRA CIUDAD ... YA EXISTE");
			}else{
				if ($('#des_ciudad').val().trim() === '') {
					$('#des_ciudad').val(""); $('#des_ciudad').focus();
				     	alert("DEBE INGRESAR NOMBRE DE CIUDAD"); return false;
				}
				$("#botonciudad").attr("disabled","true");
				$.ajax({
					url:url_base,
					data:'accion=13&'+$("#form_ciudad").serialize(),
					type:'post',
					success: function(data) {
						$("#ciudad").empty().html(data); $("#pais").val($("#pais_id").val());
						$("#agregarciudad").modal("hide"); return false;
					}
				}); return false;
			}
		}
	});  return false;
}

function traerciudad(ciudad){
	if ($("#pais").val()!="") {
		$.ajax({
	    	    	url:url_base,
			data:'accion=10&pais='+$("#pais").val(),
			type:'post',
	        	success: function(data) {
	            	$("#ciudad").empty().html(data);
	            	$("#ciudad").val(ciudad);
	        	}
	    	});
	}else{
		$("#ciudad").empty().html('<option value="">Seleccione Ciudad</option>');
	}
}

function traerhabitaciones(){
	if ($("#tipo_hab").val()!="") {
		$.ajax({
	    	    	url:url_base,
			data:'accion=7&tipo='+$("#tipo_hab").val(),
			type:'post',
	        	success: function(data) {
	            	$("#habitacion").empty().html(data);
	            	$("#preciohab").val("0.00"); $("#total").val("0.00");
	        	}
	    	});
	}else{
		$("#preciohab").val("0.00"); $("#total").val("0.00");
	}
}

function infohab(){
	$.ajax({
    	    	url:url_base,
		data:'accion=9&hab='+$("#habitacion").val(),
		type:'post',
        	success: function(data) {
            	$("#preciohab").val(data); 
            	$("#total").val(parseFloat($("#preciohab").val())*parseInt($("#dias").val()));
        	}
    	});
}

function dias_est(){
	if ($("#fechafin").val()==$("#fechaini").val()) {
		$("#dias").val("1");
	}else{
		$.ajax({
	    	    	url:url_base,
			data:'accion=15&fin='+$("#fechafin").val(),
			type:'post',
	        	success: function(data) {
	            	$("#dias").val(data);
	            	$("#total").val(parseFloat($("#preciohab").val())*parseInt($("#dias").val()));
	        	}
	    	});
	}
}

function agregar(){
	if($("#tipo_hab").val()==""){
		$("#tipo_hab").focus(); return 0;
	}
	if($("#habitacion").val()==""){
		$("#habitacion").focus(); return 0;
	}
	if($("#habitacion_"+$("#habitacion").val()).length==false){
		html ="<tr id='habitacion_"+$("#habitacion").val()+"'>"+
		"<td> <input type='hidden' name='habitacion_id[]' value='"+$("#habitacion").val()+"'> "+$("#habitacion option:selected").html()+"</td>"+
		"<td> "+$("#tipo_hab option:selected").html()+"</td>"+
		"<td><button class='btn btn-danger btn-xs' onclick=$(this).closest('tr').remove();> <i class='fa fa-times-circle'></i> </button></td>"+
		"</tr>";
		$("#lista").append(html); $("#habitacion").val("");
	}else{
		alert('La habitacion ya esta en la lista para su reserva');
	}
}

function buscarcliente(){
	if ($("#dni").val().length==8 || $("#dni").val().length==11) {
		$.ajax({
			data: 'accion=6&dni='+$("#dni").val(),
	     		url:   url_base,
	     		type:  'post',
	     		success: function(data) {
	     			var datos = eval(data);
	     			if(datos==""){
	     				//alerta('error',"Cliente no existe ... complete los demas campos!");
	     			}else{
	     				$("#nombres").val(datos[0]["h_nombres"]);
	                  	$("#tipo_documento").val(datos[0]["h_tipodocumento"]);
	                  	$.ajax({
						data: 'accion=14&ciudad='+datos[0]["h_nacionalidad"],
				     		url:   url_base,
				     		type:  'post',
				     		success: function(data) {
			     				$("#pais").val(data); traerciudad(datos[0]["h_nacionalidad"]);
				     		}
					});
	     			}
	     		}
		});
	}
}

function tipodoc(){
	if ($("#tipo_documento").val()==1) {
		$("#doc").text('DNI'); $("#name").text('Nombres');
		$("#dni").attr('placeholder','Nro DNI');
		$("#dni").attr('maxlength','8'); $("#dni").attr('minlength','8');
	}else{
		$("#doc").text('RUC'); $("#name").text('Razon_social');
		$("#dni").attr('placeholder','Nro RUC');
		$("#dni").attr('maxlength','11'); $("#dni").attr('minlength','11');
	}
}

function guardar(){
	if ($('#nombres').val().trim() === '') {
		$('#nombres').val(""); $('#nombres').focus();
	     	alert("DEBE INGRESAR "+$("#name").text().toUpperCase()+" DEL CLIENTE"); return false;
	}
	$("#botonguardar").attr("disabled","true");
	$.ajax({
		url:url_base,
		data:'accion=2&'+$("#formulario").serialize(),
		type:'post',
		success: function(data) {
			if (data==1) {
				$("#alerta_text").text(tabla.toUpperCase()+' REGISTRADO');
			}else{
				$("#alerta_text").text('Ocurrió Un Error! Comunica Este Error');
			}
			alerta_hide(); listado(); return false;
		}
	}); return false;
}

var idmant = 0;
function confirmar(id){
	idmant=id; $("#confirmar").modal("show");
}

function eliminar(){
	$.ajax({
		url:url_base,
		data:'accion=4&id='+idmant,
		type:'post',
		success: function(data) {
			if (data==1) {
				$("#alerta_text").text(tabla.toUpperCase()+' TERMINADA');
			}else{
				$("#alerta_text").text('Ocurrió Un Error! Comunica Este Error');
			}
			$("#confirmar").modal("hide"); alerta_hide(); listado();
		}
	});
}

function infoentrada(id){
	$.ajax({
		url:url_base,
		data:'accion=16&id='+id,
		type:'post',
		success: function(data) {
			$("#info_conten").empty().html(data);
			$("#infoentrada").modal("show");
		}
	});
}

function agregar_servicio(id){
	$("#entra_id").val(id); $("#precio_servicio").val(""); $("#servicio_id").val("");
	$("#botonservicio").removeAttr("disabled");
	$("#agregar_servicio").modal("show");
}

function guardar_servicio() {
	$("#botonservicio").attr("disabled","true");
	$.ajax({
		url:url_base,
		data:'accion=17&'+$("#form_servicio").serialize(),
		type:'post',
		success: function(data) {
			alert("SERVICIO AGREGADO CORRECTAMENTE A ESTA ESTADIA");
			$("#agregar_servicio").modal("hide");
		}
	});  return false;
}

function alerta_hide(){
	$("#alerta").css('display','block');
	setTimeout(function() { $("#alerta").css('display','none'); }, 1700);
}