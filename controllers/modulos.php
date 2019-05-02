<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$lista = $base->listar('modulos','m');
			require_once("../views/modulos/lista.php");
		}
		if ($_POST['accion']==1) {
			require_once("../views/modulos/nuevo.php");
		}
		if ($_POST["accion"]==2) {
			$data = $base->guardar('modulos','m');
			echo $data;
		}
		if ($_POST["accion"]==3) {
			$data = $base->info('modulos','m',$_POST['id']);
			echo json_encode($data);
		}
		if ($_POST["accion"]==4) {
			$data = $base->eliminar('modulos','m',$_POST['id']);
			echo $data;
		}
		if ($_POST["accion"]==5) {
			$data = $base->buscar("select * from modulos where m_estado=1 and m_id<>".(int)($_POST["id"])." and upper(m_descripcion)=upper('".$_POST["descripcion"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}		
	}else{
		require_once("../views/modulos/index.php");
	}
?>