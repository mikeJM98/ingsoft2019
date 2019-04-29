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

function guardar(){
	$.ajax({
		url:url_base,
		data:'accion=5&'+$("#formulario").serialize(),
		type:'post',
		success: function(data) {
			if (data==1) {
				alert("INGRESE OTRA DESCRIPCION PARA "+tabla.toUpperCase()+" ... YA EXISTE");
				//alerta('error','Ingrese otra descripcion para la '+tabla,'ESTA DESCRIPCION YA EXISTE');
			}else{
				if ($('#descripcion').val().trim() === '') {
					$('#descripcion').val(""); $('#descripcion').focus();
				     	alert("DEBE INGRESAR DESCRIPCION PARA "+tabla.toUpperCase()); return false;
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
	                    	for (i = 0; i < form.length; i++) { 
	                        	$("#"+form[i]).val(datos[0][campos[i]]);
	                    	}
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