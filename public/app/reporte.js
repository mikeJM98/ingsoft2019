$(function() {
	$("#"+modulo).addClass("nav-active");
	$("#"+submodulo).addClass("active");
});

function imprimir_reservas(){
	if ($("#rango1").val()=="") {
		$("#rango1").focus(); return 0;
	}
	if ($("#rango2").val()=="") {
		$("#rango2").focus(); return 0;
	}
    	var urlcomp = String(url_base).split('?');
    	var urlenvio = urlcomp[0]+'?accion=3&rango1='+$("#rango1").val()+'&rango2='+$("#rango2").val();  	
    	window.open(urlenvio, '_blank'); $("#iframe-reporte").attr("src",urlenvio); 
}

function imprimir_entradas(){
	if ($("#rango1").val()=="") {
		$("#rango1").focus(); return 0;
	}
	if ($("#rango2").val()=="") {
		$("#rango2").focus(); return 0;
	}
    	var urlcomp = String(url_base).split('?');
    	var urlenvio = urlcomp[0]+'?accion=4&rango1='+$("#rango1").val()+'&rango2='+$("#rango2").val();  	
    	window.open(urlenvio, '_blank'); $("#iframe-entrada").attr("src",urlenvio); 
}