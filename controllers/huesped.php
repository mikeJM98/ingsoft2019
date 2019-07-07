<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();
	require_once '../models/Huesped_model.php';
	require_once '../models/Entrada_model.php';
	$table = Huesped_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$lista = $table->listar();
			require_once("../views/Huesped/lista.php");
		}
		if ($_POST['accion']==1) {
			$tipos = $table->traer('tipo_documento','td');
			$paises = $table->traer('pais','p');
			require_once("../views/Huesped/nuevo.php");
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
			$data = $base->buscar("select *from huesped where h_estado=1 and h_id<>".(int)($_POST["id"])." and upper(h_documento)=upper('".$_POST["dni"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}
		if ($_POST["accion"]==6) {
			$data = $base->buscar("select *from huesped where h_estado=1 and h_documento='".$_POST["dni"]."' ");
			echo json_encode($data);
		}
		if ($_POST["accion"]==7) {
			$sql = "select *from ciudad where c_estado=1 and c_id>0 and c_pais=".$_POST["pais"];
			$data = $table->infosql($sql);
			$html = "<option value=''>Seleccione Ciudad</option>";
			foreach ($data as $value) {
				$html .= "<option value='".$value["c_id"]."'>".$value["c_descripcion"]."</option>";
			}
			echo $html;
		}
		if ($_POST["accion"]==10) {
			$data = $base->buscar("select *from pais where p_estado=1 and upper(p_descripcion)=upper('".$_POST["des_pais"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}
		if ($_POST["accion"]==11) {
			if (isset($_POST['lista'])) {
			}else{
				$sql = "insert into pais(p_descripcion) values('".$_POST["des_pais"]."')";
				$data = $table->insertar($sql);
			}

			$sql = "select *from pais where p_estado=1";
			$data = $table->infosql($sql);
			$html = "<option value=''>Seleccione</option>";
			foreach ($data as $value) {
				$html .= "<option value='".$value["p_id"]."'>".$value["p_descripcion"]."</option>";
			}
			echo $html;
		}
		if ($_POST["accion"]==12) {
			$data = $base->buscar("select *from ciudad where c_estado=1 and c_pais=".(int)($_POST["pais_id"])." and upper(c_descripcion)=upper('".$_POST["des_ciudad"]."')");
			if (count($data)==0) {
				echo "0";
			}else{
				echo "1";
			}
		}
		if ($_POST["accion"]==13) {
			$sql = "insert into ciudad(c_descripcion,c_pais) values('".$_POST["des_ciudad"]."','".$_POST["pais_id"]."')";
			$data = $table->insertar($sql);

			$sql = "select *from ciudad where c_estado=1 and c_id>0 and c_pais=".$_POST["pais_id"];
			$data = $table->infosql($sql);
			$html = "<option value=''>Seleccione Ciudad</option>";
			foreach ($data as $value) {
				$html .= "<option value='".$value["c_id"]."'>".$value["c_descripcion"]."</option>";
			}
			echo $html;
		}
	}else{
		require_once("../views/Huesped/index.php");
	}
?>