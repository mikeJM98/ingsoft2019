<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$lista = $base->listar('categoria','c');
			require_once("../views/Categorias/lista.php");
		}
		if ($_POST['accion']==1) {
			require_once("../views/Categorias/nuevo.php");
		}
		if ($_POST["accion"]==2) {
			$data = $base->guardar('categoria','c');
			echo $data;
		}
		if ($_POST["accion"]==3) {
			$data = $base->info('categoria','c',$_POST['id']);
			echo json_encode($data);
		}
		if ($_POST["accion"]==4) {
			$data = $base->eliminar('categoria','c',$_POST['id']);
			echo $data;
		}
		if ($_POST["accion"]==5) {
			$data = $base->buscar("select *from categoria where c_estado=1 and c_id<>".(int)($_POST["id"])." and upper(c_descripcion)=upper('".$_POST["descripcion"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}		
	}else{
		require_once("../views/Categorias/index.php");
	}
?>