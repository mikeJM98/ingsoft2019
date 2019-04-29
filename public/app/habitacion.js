$(function() {
	$("."+modulo).addClass("active");
	$("#"+modulo).css("display", "block");
	$("#"+submodulo).addClass("active"); listado(); $("#alerta").hide();
});

function listado(){
	$("#titulo").text("Lista de habitaciones");
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

function agregar(){
	if($("#categoria").val()==""){
		$("#categoria").focus(); return 0;
	}
	if($("#descr").val().trim() ==""){
		$("#descr").val("").focus(); return 0;
	}
	//if($("#enser_"+$("#categoria").val()).length==false){
		html ="<tr id='enser_"+$("#categoria").val()+"'>"+
		"<td> <input type='hidden' name='categoria_id[]' value='"+$("#categoria").val()+"'> "+$("#categoria option:selected").html()+"</td>"+
		"<td> <input type='hidden' name='descripcion_enser[]' value='"+$("#descr").val()+"'> "+$("#descr").val()+"</td>"+
		"<td><button class='btn btn-danger btn-xs' onclick=$(this).closest('tr').remove();> <i class='fa fa-times-circle'></i> </button></td>"+
		"</tr>";
		$("#lista").append(html);
		$("#categoria").val("");$("#descr").val("");
	//}else{
	//	alerta('error','Ya Agregó Esta Descripcion','ERROR OPERACION');
	//}
}

function guardar(){
	$.ajax({
		url:url_base,
		data:'accion=5&'+$("#formulario").serialize(),
		type:'post',
		success: function(data) {
			if (data==1) {
				alert("INGRESE OTRO NRO DE "+tabla.toUpperCase()+" ... YA EXISTE");
			}else{
				if ($('#nro').val().trim() === '') {
					$('#nro').val(""); $('#nro').focus();
				     	alert("DEBE INGRESAR NRO PARA LA "+tabla.toUpperCase()); return false;
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
				dataType: "json",
				success: function(info) {
					$("#content").empty().html(data);
					var datos = eval(info.data);
					$("#id").val(datos[0]["h_id"]);
					$("#descripcion").val(datos[0]["h_descripcion"]);
					$("#nro").val(datos[0]["h_nro"]);
					$("#precio").val(datos[0]["h_precio"]);
					$("#tipo_habitacion option[value='"+datos[0]["h_tipohabitacion"]+"']").prop('selected', true);

					var enseres = eval(info.enseres);
					for (var i = 0; i < enseres.length; i++) {
						html ="<tr id='enser_"+enseres[i]["e_categoria"]+"'>"+
						"<td> <input type='hidden' name='categoria_id[]' value='"+enseres[i]["e_categoria"]+"'> "+enseres[i]["c_descripcion"]+"</td>"+
						"<td> <input type='hidden' name='descripcion_enser[]' value='"+enseres[i]["e_descripcion"]+"'> "+enseres[i]["e_descripcion"]+"</td>"+
						"<td><button class='btn btn-danger btn-xs' onclick=$(this).closest('tr').remove();> <i class='fa fa-times-circle'></i> </button></td>"+
						"</tr>";
						$("#lista").append(html);
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