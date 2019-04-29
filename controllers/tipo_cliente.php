<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$lista = $base->listar('tipo_cliente','tc');
			require_once("../views/Tipocliente/lista.php");
		}
		if ($_POST['accion']==1) {
			require_once("../views/Tipocliente/nuevo.php");
		}
		if ($_POST["accion"]==2) {
			$data = $base->guardar('tipo_cliente','tc');
			echo $data;
		}
		if ($_POST["accion"]==3) {
			$data = $base->info('tipo_cliente','tc',$_POST['id']);
			echo json_encode($data);
		}
		if ($_POST["accion"]==4) {
			$data = $base->eliminar('tipo_cliente','tc',$_POST['id']);
			echo $data;
		}
		if ($_POST["accion"]==5) {
			$data = $base->buscar("select *from tipo_cliente where tc_estado=1 and tc_id<>".(int)($_POST["id"])." and upper(tc_descripcion)=upper('".$_POST["descripcion"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}		
	}else{
		require_once("../views/Tipocliente/index.php");
	}
?>