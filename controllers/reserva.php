<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();
	require_once '../models/Reserva_model.php';
	$table = Reserva_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$lista = $table->listar();
			require_once("../views/Reservas/lista.php");
		}
		if ($_POST['accion']==1) {
			$tipos = $base->listar('tipo_habitacion','th');
			require_once("../views/Reservas/nuevo.php");
		}
		if ($_POST["accion"]==2) {
			$data = $table->guardar();
			echo $data;
		}
		if ($_POST["accion"]==4) {
			$data = $table->eliminar($_POST['id']);
			echo $data;
		}
		if ($_POST["accion"]==5) {
			$data = $base->buscar("select *from cliente where c_estado='1' and c_dni='".$_POST["dni"]."' ");
			echo json_encode($data);
		}

		if ($_POST["accion"]==7) {
			$sql = "select e_habitacion from entrada where e_estado=1 and e_fechafin>='".$_POST["fecha"]."' ";
			$ocupadas = $table->infosql($sql);

			$sql = "select detalle_reserva.dr_habitacion from reserva inner join detalle_reserva on(reserva.r_id=detalle_reserva.dr_reserva) where reserva.r_estado=1 and r_fecha='".$_POST["fecha"]."' ";
			$reservadas = $table->infosql($sql);

			$sql = "select *from habitacion where h_tipohabitacion=".$_POST["tipo"];
			$data = $table->infosql($sql);
			$html = "<option value=''>Seleccione</option>";
			foreach ($data as $value) {
				$estado_hab = ""; $estado_com = "";
				foreach ($reservadas as $v) {
					if ($v['dr_habitacion']==$value["h_id"]) {
						$estado_hab = "disabled"; $estado_com = "Habitacion Reservada"; break;
					}
				}
				foreach ($ocupadas as $v) {
					if ($v['e_habitacion']==$value["h_id"]) {
						$estado_hab = "disabled"; $estado_com = "Habitacion Ocupada"; break;
					}
				}
				$html .= "<option value='".$value["h_id"]."' ".$estado_hab.">Habitacion Nro. ".$value["h_nro"].' '.$estado_com."</option>";
			}
			echo $html;
		}
		if ($_POST["accion"]==8) {
			$clientes = $base->listar('cliente','c');
			require_once("../views/Reservas/clientes.php");
		}
	}else{
		require_once("../views/Reservas/index.php");
	}
?>