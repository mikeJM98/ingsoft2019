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
	$("#titulo").text("Registro nuevo usuario");
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

function buscarempleado(){
	if ($("#dni").val().length==8) {
		$.ajax({
			data: 'accion=6&dni='+$("#dni").val(),
	     		url:   url_base,
	     		type:  'post',
	     		success: function(data) {
	     			var datos = eval(data);
	     			if(datos==""){
	     				//alerta('error',"Empleado no existe ... complete los demas campos!");
	     			}else{
	     				$("#nombres").val(datos[0]["e_nombres"]);
	     				$("#apellidos").val(datos[0]["e_apellidos"]);
	                  	$("#celular").val(datos[0]["e_celular"]);
	                  	$("#direccion").val(datos[0]["e_direccion"]);
	                  	$("#tipo_empleado").val(datos[0]["e_tipoempleado"]);
	                  	$("#sexo").val(datos[0]["e_sexo"]);
	                  	$("#usuario").val(datos[0]["e_usuario"]);
	                  	$("#clave").val(datos[0]["e_clave"]);
	     			}
	     		}
		});
	}
}

function guardar(){
	$.ajax({
		url:url_base,
		data:'accion=5&'+$("#formulario").serialize(),
		type:'post',
		success: function(data) {
			if (data==1) {
				alert('Este empleado con DNI: '+$("#dni").val()+' !ya esta Registrado');
			}else{
				if ($('#nombres').val().trim() === '') {
					$('#nombres').val("").focus();
				     	alert('ERROR!!! El empleado esta sin nombre'); return false;
				}
				if ($('#apellidos').val().trim() === '') {
					$('#apellidos').val("").focus();
				     	alert('ERROR!!! El empleado esta sin apellidos'); return false;
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
					$("#id").val(datos[0]["e_id"]);
					$("#dni").val(datos[0]["e_dni"]);
					$("#nombres").val(datos[0]["e_nombres"]);
	     				$("#apellidos").val(datos[0]["e_apellidos"]);
	                  	$("#celular").val(datos[0]["e_celular"]);
	                  	$("#direccion").val(datos[0]["e_direccion"]);
	                  	$("#sexo").val(datos[0]["e_sexo"]);
	                  	$("#usuario").val(datos[0]["e_usuario"]);
	                  	$("#clave").val(datos[0]["e_clave"]);
	                  	$("#tipo_empleado").val(datos[0]["e_tipoempleado"]);
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
var idmant = 0;
function bloquea(id){
	idmant=id; $("#bloquear").modal("show");
}
function bloquear(){
	$.ajax({
		url:url_base,
		data:'accion=7&id='+idmant,
		type:'post',
		success: function(data) {
			if (data==1) {
				$("#alerta_text").text(tabla.toUpperCase()+' BLOQUEADO');
			}else{
				$("#alerta_text").text('Ocurrió Un Error! Comunica Este Error');
			}
			$("#bloquear").modal("hide"); alerta_hide(); listado();
		}
	});
}
var idmant = 0;
function desbloquea(id){
	idmant=id; $("#desbloquear").modal("show");
}
function desbloquear(){
	$.ajax({
		url:url_base,
		data:'accion=8&id='+idmant,
		type:'post',
		success: function(data) {
			if (data==1) {
				$("#alerta_text").text(tabla.toUpperCase()+' DESBLOQUEADO');
			}else{
				$("#alerta_text").text('Ocurrió Un Error! Comunica Este Error');
			}
			$("#desbloquear").modal("hide"); alerta_hide(); listado();
		}
	});
}

function alerta_hide(){
	$("#alerta").css('display','block');
	setTimeout(function() { $("#alerta").css('display','none'); }, 1700);
}