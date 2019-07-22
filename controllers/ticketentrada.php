<?php 
require_once '../models/Base_model.php';
$base = Base_model::conectar();
require_once '../models/Entrada_model.php';
$table = Entrada_model::conectar();

if(isset($_GET['accion'])){
    if ($_GET['accion']==0) {
        $sql = "select entrada.*,habitacion.h_nro,habitacion.h_precio,huesped.h_nombres,empleado.e_nombres from entrada inner join huesped on(entrada.e_huesped=huesped.h_id) inner join habitacion on(entrada.e_habitacion=habitacion.h_id) inner join empleado on(entrada.e_empleado=empleado.e_id) where habitacion.h_id=".$_GET["id"]." and entrada.e_estado=1";
			$data = $table->infosql($sql);
			$html ='<h1 class="modal-title">HOSPEDAJE FLOR DEL VALLE</h1>
			<h2>Factura simplificada / ticket</h2>';
			$total=0;
			foreach ($data as $value) {
				$html .= "<p>";
				$html .= "<h3> <b> Nombre Huesped : </b>".$value["h_nombres"]."</h3>";
				$html .= "</p>";
				$html .= "<p>";
				$html .= "<h3> <b> Fecha Inicio : </b>".$value["e_fechaini"]."</h3>";
				$html .= "</p>";
				$html .= "<p>";
				$html .= "<h3> <b> Fecha Fin : </b>".$value["e_fechafin"]."</h3>";
				$html .= "</p>";
				$html .= "<p>";
				$html .= "<h3> <b> Nombre Vendedor : </b>".$_SESSION["usuario"]."</h3>";
				$html .= "</p>";
				$total +=$value["e_total"];
			}
			$html .= "<center><h4>Lista de servicios</h4></center>";

			$sql = "select entrada.e_id from entrada inner join huesped on(entrada.e_huesped=huesped.h_id) inner join habitacion on(entrada.e_habitacion=habitacion.h_id) inner join empleado on(entrada.e_empleado=empleado.e_id) where habitacion.h_id=".$_GET["id"]." and entrada.e_estado=1";
			$data = $table->infosql($sql);
			foreach ($data as $key) {
				$temp=$key['e_id'];
			}
			$sql = "select tipo_servicio.ts_descripcion, sum(servicio.s_total) as s_total from servicio inner join tipo_servicio on(servicio.s_tiposervicio=tipo_servicio.ts_id) where servicio.s_entrada=".$temp." group by ts_descripcion";
			$data = $table->infosql($sql);
			
			$html = $html.'<table border="1" width="100%" >';
			$html .= "<tr> <th>Producto</th> <th>Precio</th> <th>Cantidad</th> <th>total</th> </tr>";
			$html .= "<tr>";
			$html .= "<td> Habitacion"."</td>";
			$html .= "<td>".$value["e_total"]."</td>";
			$html .= "<td>1</td>";
			$html .= "<td>".$value["e_total"]."</td>";
			$html .= "</tr>";
			if (count($data)==0) {
				#$html .= "<tr> <td coldspan colspan='2'> <b> Sin Servicios Esta Estadia </b></td> </tr>";
			}else{
				foreach ($data as $value) {
					$html .= "<tr>";
					$html .= "<td>".$value["ts_descripcion"]."</td>";
					$html .= "<td> ".$value["s_total"]."</td>";
					$html .= "<td>1</td>";
					$html .= "<td> ".$value["s_total"]."</td>";
					$html .= "</tr>";
					$total +=$value["s_total"];
				}
			}
			$html .= "<tr>";
			$html .= "<td>";
			$html .= "</td>";
			$html .= "<td>";
			$html .= "</td>";
			$html .= "<td>Total</td>";
			$html .= "<td> S/. ".$total."</td>";
			$html .= "</tr>";
			$html .= "</table> <br>";

			require_once '../public/tcpdf/tcpdf.php';
        		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        		$pdf->SetCreator(PDF_CREATOR);
        		$pdf->SetAuthor('Carlos Yrigoin');
        		$pdf->SetTitle('Ticket Reservas - Hotel');
        		$pdf->SetSubject('Software');
        		$pdf->SetKeywords('reportes,dioses');

        		$subtitulobebe = "TICKET DE RESERVAS";
         		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
       	 	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        		$pdf->setFontSubsetting(true);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->AddPage("A");
			$pdf->writeHTML($html, true, 0, true, 0);

			$nombre_archivo = utf8_decode("ticket.pdf");
			$pdf->Output($nombre_archivo, 'I');
			
			$data = $table->eliminar($_GET['id']);
			echo $data;
    }
}
?>