<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();
	require_once '../models/Cliente_model.php';
	$table = Cliente_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$lista = $table->listar();
			require_once("../views/Clientes/lista.php");
		}
		if ($_POST['accion']==1) {
			$tipos = $table->traer('tipo_cliente','tc');
			require_once("../views/Clientes/nuevo.php");
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
			$data = $base->buscar("select *from cliente where c_estado='1' and c_id<>".(int)($_POST["id"])." and upper(c_dni)=upper('".$_POST["dni"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}
		if ($_POST["accion"]==6) {
			$data = $base->buscar("select *from cliente where c_estado=1 and c_dni='".$_POST["dni"]."' ");
			echo json_encode($data);
		}	
	}else{
		require_once("../views/Clientes/index.php");
	}
?>