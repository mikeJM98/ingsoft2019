<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$lista = $base->listar('Pais','p');
			require_once("../views/Pais/lista.php");
		}
		if ($_POST['accion']==1) {
			require_once("../views/Pais/nuevo.php");
		}
		if ($_POST["accion"]==2) {
			$data = $base->guardar('Pais','p');
			echo $data;
		}
		if ($_POST["accion"]==3) {
			$data = $base->info('Pais','p',$_POST['id']);
			echo json_encode($data);
		}
		if ($_POST["accion"]==4) {
			$data = $base->eliminar('Pais','p',$_POST['id']);
			echo $data;
		}
		if ($_POST["accion"]==5) {
			$data = $base->buscar("select *from Pais where p_estado=1 and p_id<>".(int)($_POST["id"])." and upper(p_descripcion)=upper('".$_POST["descripcion"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}		
	}else{
		require_once("../views/Pais/index.php");
	}
?>