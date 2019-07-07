<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();
	require_once '../models/Entrada_model.php';
	$table = Entrada_model::conectar();

	if(isset($_POST['accion'])){
		if ($_POST['accion']==0) {
			$actualizarhab = $table->listar();
			$habitaciones = $table->infosql("select *from habitacion inner join tipo_habitacion on(habitacion.h_tipohabitacion=tipo_habitacion.th_id) where habitacion.h_estado>0");
			require_once("../views/Entradas/lista.php");
		}
		if ($_POST['accion']==1) {
			$paises = $table->infosql("select *from pais where p_estado=1");
			$tipos = $table->traer("tipo_habitacion",'th');
			require_once("../views/Entradas/nuevo.php");
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
			$data = $base->buscar("select *from pais where p_estado=1 and upper(p_descripcion)=upper('".$_POST["des_pais"]."')");
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
			$sql = "select *from habitacion where (h_estado=1 or h_estado=3) and h_tipohabitacion=".$_POST["tipo"];
			$data = $table->infosql($sql);
			$html = "<option value=''>Seleccione</option>";
			foreach ($data as $value) {
				$html .= "<option value='".$value["h_id"]."'>Habitacion Nro. ".$value["h_nro"]."</option>";
			}
			echo $html;
		}
		if ($_POST["accion"]==9) {
			$sql = "select *from habitacion where h_id=".$_POST["hab"];
			$data = $table->infosql($sql);
			if (count($data)==0) {
				echo '0.00';
			}else{
				echo $data[0]["h_precio"];
			}
		}
		if ($_POST["accion"]==8) {
			$clientes = $base->listar('cliente','c');
			require_once("../views/Entradas/clientes.php");
		}
		if ($_POST["accion"]==10) {
			$sql = "select *from ciudad where c_estado=1 and c_id>0 and c_pais=".$_POST["pais"];
			$data = $table->infosql($sql);
			$html = "<option value=''>Seleccione Ciudad</option>";
			foreach ($data as $value) {
				$html .= "<option value='".$value["c_id"]."'>".$value["c_descripcion"]."</option>";
			}
			echo $html;
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
		if ($_POST["accion"]==14) {
			$sql = "select *from ciudad where c_id=".$_POST["ciudad"];
			$data = $table->infosql($sql);
			echo $data[0]["c_pais"];
		}
		if ($_POST["accion"]==15) {
			$diff = strtotime($_POST["fin"]) - strtotime(date('Y-m-d')); 
                	$dias = round($diff / 86400);
                	echo $dias;
		}
		if ($_POST["accion"]==16) {
			$sql = "select entrada.*,habitacion.h_nro,habitacion.h_precio,huesped.h_nombres,empleado.e_nombres from entrada inner join huesped on(entrada.e_huesped=huesped.h_id) inner join habitacion on(entrada.e_habitacion=habitacion.h_id) inner join empleado on(entrada.e_empleado=empleado.e_id) where habitacion.h_id=".$_POST["id"]." and entrada.e_estado=1";
			$data = $table->infosql($sql);
			$html = "<table width='100%'>";
			foreach ($data as $value) {
				$html .= "<tr>";
				$html .= "<td> <b> Nombre Huesped : </b>".$value["h_nombres"]."</td>";
				$html .= "<td> <b> S/.Total Estadia : </b>".$value["e_total"]." soles.</td>";
				$html .= "</tr>";
				$html .= "<tr>";
				$html .= "<td> <b> Fecha Inicio : </b>".$value["e_fechaini"]."</td>";
				$html .= "<td> <b> Fecha Fin : </b>".$value["e_fechafin"]."</td>";
				$html .= "</tr>";
			}
			$html .= "</table>";
			$html .= "<center><h4>Lista de servicios</h4></center>";

			$sql = "select entrada.e_id from entrada inner join huesped on(entrada.e_huesped=huesped.h_id) inner join habitacion on(entrada.e_habitacion=habitacion.h_id) inner join empleado on(entrada.e_empleado=empleado.e_id) where habitacion.h_id=".$_POST["id"]." and entrada.e_estado=1";
			$data = $table->infosql($sql);
			foreach ($data as $key) {
				$temp=$key['e_id'];
			}
			$sql = "select *from servicio inner join tipo_servicio on(servicio.s_tiposervicio=tipo_servicio.ts_id) where servicio.s_entrada=".$temp;
			$data = $table->infosql($sql);
			
			$html .= "<table class='table table-bordered table-condensed'>";
			$html .= "<tr> <th>Descripcion</th> <th>Precio Servicio</th> </tr>";
			if (count($data)==0) {
				$html .= "<tr> <td coldspan colspan='2'> <b> Sin Servicios Esta Estadia </b></td> </tr>";
			}else{
				foreach ($data as $value) {
					$html .= "<tr>";
					$html .= "<td> <b>".$value["ts_descripcion"]." </b></td>";
					$html .= "<td> <b> S/.Costo Servicio : ".$value["s_total"]." soles. </b> </td>";
					$html .= "</tr>";
				}
			}
			$html .= "</table> <br>";
			$html .= '<center> <button data-dismiss="modal" class="btn btn-danger" type="button">Cerrar Info.</button> </center>';

			echo $html;
		}
		if ($_POST["accion"]==17) {
			$sql = "insert into servicio(s_entrada,s_tiposervicio,s_total) values('".$_POST["entra_id"]."',".$_POST["servicio_id"].",'".$_POST["precio_servicio"]."')";
			$data = $table->insertar($sql);
			echo $data;
		}
		if ($_POST["accion"]==18) {
			$sql = "select entrada.e_id from entrada inner join huesped on(entrada.e_huesped=huesped.h_id) inner join habitacion on(entrada.e_habitacion=habitacion.h_id) inner join empleado on(entrada.e_empleado=empleado.e_id) where habitacion.h_id=".$_POST["id"]." and entrada.e_estado=1";
			$data = $table->infosql($sql);
			foreach ($data as $key) {
				$temp=$key['e_id'];
			}
			echo $temp;
		}
	}else{
		$servicios = $table->infosql("select *from tipo_servicio where ts_estado=1");
		require_once("../views/Entradas/index.php");
	}
?>