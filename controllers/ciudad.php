<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();
	require_once '../models/Ciudad_model.php';
	$table = Ciudad_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$lista = $table->listar();
			require_once("../views/Ciudad/lista.php");
		}
		if ($_POST['accion']==1) {
			$paises = $table->traer('pais','p');
			require_once("../views/Ciudad/nuevo.php");
		}
		if ($_POST["accion"]==2) {
			$data = $table->guardar();
			echo $data;
		}
		if ($_POST["accion"]==3) {
			$data = $table->info($_POST['id']);
			echo json_encode($data);
		}
		if ($_POST["accion"]==4) {
			$data = $table->eliminar($_POST['id']);
			echo $data;
		}
		if ($_POST["accion"]==5) {

			$data = $base->buscar("select *from ciudad where c_estado=1 and c_id<>".(int)($_POST["id"])." and c_pais=".(int)($_POST["pais"])." and upper(c_descripcion)=upper('".$_POST["descripcion"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}	
	}else{
		require_once("../views/Ciudad/index.php");
	}
?>