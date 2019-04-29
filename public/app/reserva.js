$(function() {
	$("."+modulo).addClass("active");
	$("#"+modulo).css("display", "block");
	$("#"+submodulo).addClass("active"); listado(); $("#alerta").hide();
});

function listado(){
	$("#titulo").text("Lista de reservas realizadas");
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

function listaclientes(){
    	$.ajax({
    	    	url:url_base,
		data:'accion=8',
		type:'post',
        	success: function(data) {
            	$("#conten_clientes").empty().html(data);
            	$('.table-clientes').DataTable();
            	$("#lista_clientes").modal("show");
        	}
    	});
}

function clientesel(id,cliente) {
    	$("#cliente").val(id);$("#clientename").val(cliente);
    	$("#lista_clientes").modal("hide");
}

function traerhabitaciones(){
	$.ajax({
    	    	url:url_base,
		data:'accion=7&fecha='+$("#fecha").val()+'&tipo='+$("#tipo_hab").val(),
		type:'post',
        	success: function(data) {
            	$("#habitacion").empty().html(data);
        	}
    	});
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

function guardar(){
	if ($('#clientename').val().trim() === '') {
		$('#clientename').val(""); $('#clientename').focus();
	     	alert("DEBE BUSCAR EL CLIENTE DE LA "+tabla.toUpperCase()); return false;
	}
	if ($('#lista tr').length == 0) {
	     	alert("NO ESTA RESERVANDO NINGUNA HABITACION"); return false;
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