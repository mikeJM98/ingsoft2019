$(function() {
	$("."+modulo).addClass("active");
	$("#"+modulo).css("display", "block");
	$("#"+submodulo).addClass("active"); listado(); $("#alerta").hide();
});

function listado(){
	$("#titulo").text("Lista de "+submodulo);
	$("#content").empty().html("<center> <br><br><img src='../public/img/cargando.gif'> </center>");
	$.ajax({
		url:url_base,
		data:'accion=0',
		type:'post',
		success: function(data) {
			$("#content").empty().html(data);
			$('.table-data').DataTable();
		}
	});
}

function nuevo(){
	$("#titulo").text("Registro nuevo "+tabla);
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
	                  	$("#celular").val(datos[0]["h_celular"]);
	                  	$("#direccion").val(datos[0]["h_direccion"]);
	                  	$("#tipo_documento").val(datos[0]["h_tipodocumento"]);
	                  	$("#pais").val(datos[0]["h_nacionalidad"]);
	     			}
	     		}
		});
	}
}
function tipodoc(){
	if ($("#tipo_documento").val()==1) {
		$("#doc").text('# DNI');
		$("#dni").attr('placeholder','Nro DNI');
		$("#dni").attr('maxlength','8'); $("#dni").attr('minlength','8');
	}else{
		$("#doc").text('# RUC');
		$("#dni").attr('placeholder','Nro RUC');
		$("#dni").attr('maxlength','11'); $("#dni").attr('minlength','11');
	}
}

function traerciudad(ciudad){
	if ($("#pais").val()!="") {
		$.ajax({
	    	    	url:url_base,
			data:'accion=7&pais='+$("#pais").val(),
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

function guardar(){
	$.ajax({
		url:url_base,
		data:'accion=5&'+$("#formulario").serialize(),
		type:'post',
		success: function(data) {
			if (data==1) {
				alert('Este huesped con Documento: '+$("#dni").val()+' !ya esta Registrado');
			}else{
				if ($('#nombres').val().trim() === '') {
					$('#nombres').val("").focus();
				     	alert('ERROR!!! El huesped esta sin nombre'); return false;
				}
				$("#botonguardar").attr("disabled","true");
				$.ajax({
					url:url_base,
					data:'accion=2&'+$("#formulario").serialize(),
					type:'post',
					success: function(data) {
						if (data==1) {
							if($("#id").val()==""){
								$("#alerta_text").text(tabla.toUpperCase()+' REGISTRADO');
							}else{
								$("#alerta_text").text(tabla.toUpperCase()+' MODIFICADO');
							}
						}else{
							$("#alerta_text").text('Ocurrió Un Error! Comunica Este Error');
						}
						alerta_hide(); listado(); return false;
					}
				}); return false;
			}
		}
	}); 
	return false;
}

function modificar(id){
	$("#titulo").text("Modificar "+tabla);
	$("#content").empty().html("<center> <br><br><img src='../public/img/cargando.gif'> </center>");
	$.ajax({
		url:url_base,
		data:'accion=1',
		type:'post',
		success: function(data) {
			$.ajax({
				url:url_base,
				data:'accion=3&id='+id,
				type:'post',
				success: function(info) {
					$("#content").empty().html(data);
					var datos = eval(info);
					$("#id").val(datos[0]["h_id"]);
					$("#dni").val(datos[0]["h_documento"]);
					$("#nombres").val(datos[0]["h_nombres"]);
					$("#direccion").val(datos[0]["h_direccion"]);
					$("#celular").val(datos[0]["h_celular"]);
					$("#email").val(datos[0]["email"]);
					$("#tipo_documento").val(datos[0]["h_tipodocumento"]);
					$("#pais").val(datos[0]["p_id"]); traerciudad(datos[0]["h_nacionalidad"]); tipodoc();
				}
			});
		}
	});
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
				$("#alerta_text").text(tabla.toUpperCase()+' ELIMINADO');
			}else{
				$("#alerta_text").text('Ocurrió Un Error! Comunica Este Error');
			}
			$("#confirmar").modal("hide"); alerta_hide(); listado();
		}
	});
}

function alerta_hide(){
	$("#alerta").css('display','block');
	setTimeout(function() { $("#alerta").css('display','none'); }, 1700);
}
function agregarpais(){
	$('#des_pais').val(""); $("#botonpais").removeAttr("disabled");
    	$("#agregarpais").modal("show");
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
function guardar_pais() {
	$.ajax({
		url:url_base,
		data:'accion=10&'+$("#form_pais").serialize(),
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
						alert("veda");
						$("#pais").empty().html(data); traerciudad();
						$("#agregarpais").modal("hide"); 
						return false;
					}
				}); return false;
				alert("no veda");
			}
		}
	});  return false;
}