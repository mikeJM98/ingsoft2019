<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();
	require_once '../models/Producto_model.php';
	$table = Producto_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$lista = $table->listar();
			require_once("../views/Productos/lista.php");
		}
		if ($_POST['accion']==1) {
			$categorias = $table->traer('categoria','c');
			require_once("../views/Productos/nuevo.php");
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
			$data = $base->buscar("select *from producto where p_estado=1 and p_id<>".(int)($_POST["id"])." and p_categoria=".(int)($_POST["categoria"])." and upper(p_descripcion)=upper('".$_POST["descripcion"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}	
	}else{
		require_once("../views/Productos/index.php");
	}
?>