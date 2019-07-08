<?php
	require_once '../models/Base_model.php';
	$base = Base_model::conectar();
	require_once '../models/Reporte_model.php';
	$table = Reporte_model::conectar();

	if(isset($_GET['accion'])){
		if ($_GET['accion']==1) {
			require_once("../views/Reportes/reserva_dia.php");
		}
		if ($_GET['accion']==3) {
			$sql = "select *from reserva inner join cliente on(reserva.r_cliente=cliente.c_id) where reserva.r_estado=1 and reserva.r_fecha>='".$_GET['rango1']."' and r_fecha<='".$_GET['rango2']."' ";
			$lista = $table->listar($sql);

			$html = '<h3>REPORTE DE RESERVAS --- HPFV</h3>';
        		$html = $html.'<table border="1" width="100%" >';
            	$html = $html.'<tr>';
            	$html = $html.'<th>Nro</th> <th>Fecha reserva</th> <th>Cliente</th> <th>Empleado</th>';
            	$html = $html.'</tr>';
			foreach ($lista as $value) {
				$html = $html.'<tr>';
				$html = $html.'<td>'.$value["r_id"].'</td>';
				$html = $html.'<td>'.$value["r_fecha"].'</td>';
				$html = $html.'<td>'.$value["c_nombres"].'</td>';
				$html = $html.'<td>'.$_SESSION['usuario'].'</td>';
				$html = $html.'</tr>';
			}
        		$html = $html.'</table>';

			require_once '../public/tcpdf/tcpdf.php';
        		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        		$pdf->SetCreator(PDF_CREATOR);
        		$pdf->SetAuthor('Carlos Yrigoin');
        		$pdf->SetTitle('Reporte Reservas - Hotel');
        		$pdf->SetSubject('Software');
        		$pdf->SetKeywords('reportes,dioses');

        		$subtitulobebe = "REPORTE DE RESERVAS";
         		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
       	 	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        		$pdf->setFontSubsetting(true);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->AddPage("A");
			$pdf->writeHTML($html, true, 0, true, 0);

        		$nombre_archivo = utf8_decode("reportereservas.pdf");
        		$pdf->Output($nombre_archivo, 'I');
		}
		if ($_GET['accion']==2) {
			require_once("../views/Reportes/entrada_dia.php");
		}
		if ($_GET['accion']==4) {
			$sql = "select entrada.*,habitacion.h_nro,habitacion.h_precio,huesped.h_nombres,empleado.e_nombres from entrada inner join huesped on(entrada.e_huesped=huesped.h_id) inner join habitacion on(entrada.e_habitacion=habitacion.h_id) inner join empleado on(entrada.e_empleado=empleado.e_id) where entrada.e_fechaini>='".$_GET['rango1']."' and e_fechaini<='".$_GET['rango2']."' ";
			$lista = $table->listar($sql);

			$html = '<h3>REPORTE DE ENTRADAS --- HPFV</h3>';
        		$html = $html.'<table border="1" width="100%" >';
            	$html = $html.'<tr>';
            	$html = $html.'<th>Nro</th> <th>Fecha inicio</th> <th>Fecha fin</th> <th>Nro Hab.</th> <th>Cliente</th> <th>Empleado</th> <th>Precio</th>';
				$html = $html.'</tr>';
				$total=0;
			foreach ($lista as $value) {
				$html = $html.'<tr>';
				$html = $html.'<td>'.$value["e_id"].'</td>';
				$html = $html.'<td>'.$value["e_fechaini"].'</td>';
				$html = $html.'<td>'.$value["e_fechafin"].'</td>';
				$html = $html.'<td>'.$value["h_nro"].'</td>';
				$html = $html.'<td>'.$value["h_nombres"].'</td>';
				$html = $html.'<td>'.$value["e_nombres"].'</td>';
				$html = $html.'<td>'.$value["h_precio"].'</td>';
				$html = $html.'</tr>';
				$total +=$value["h_precio"];
			}
				$html .="<tr><td></td><td></td><td></td><td></td><td></td><td>Total</td><td>$total</td></tr>";
        		$html = $html.'</table>';

			require_once '../public/tcpdf/tcpdf.php';
        		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        		$pdf->SetCreator(PDF_CREATOR);
        		$pdf->SetAuthor('Carlos Yrigoin');
        		$pdf->SetTitle('Reporte Entradas - Hotel');
        		$pdf->SetSubject('Software');
        		$pdf->SetKeywords('reportes,dioses');

        		$subtitulobebe = "REPORTE DE ENTRADAS";
         		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
       	 	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        		$pdf->setFontSubsetting(true);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->AddPage("A");
			$pdf->writeHTML($html, true, 0, true, 0);

        		$nombre_archivo = utf8_decode("reporte_entradas.pdf");
        		$pdf->Output($nombre_archivo, 'I');
		}
	}
?>