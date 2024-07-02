<?php
//============================================================+

require_once '../../../controllers/ReporteActaMedicoController.php';
require_once '../../../controllers/ActaMedicoController.php';
require_once '../../../controllers/UsuarioController.php';


require_once '../../../models/ReporteActaMedicoModel.php';
require_once '../../../models/ActaMedicoModel.php';
require_once '../../../models/UsuarioModel.php';



$user = $_GET["user"];
$fechaInicio = $_GET["inicio"];
$fechaFin = $_GET["fin"];
$year = $_GET["year"];

date_default_timezone_set('America/Lima'); 
$DateAndTime = date('d-m-Y h:i:s a', time());


$tipo_reporte =  'FECHA PERSONALIZADA';


$resultado_tabla_usuario = UsuarioController::ctrMostrarUsuario('CAT_USUARIO','DOCUMENTO',$user);
$nombre_usuario = $resultado_tabla_usuario['APELLIDOS'].' '.$resultado_tabla_usuario['NOMBRES'];



// Include the main TCPDF library (search for installation path).

require_once('tcpdf_include.php');

// extend TCPF with custom functions
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// extend TCPF with custom functions

class MYPDF extends TCPDF {

	// Load table data from file
	public function LoadDataTotalActas($fechaInicio, $fechaFin, $year, $user) {
		// Read file lines
        $TotalActasRegistradas = ReporteActaMedicoController::mostrarReporteActaMedicoListaCtr($fechaInicio, $fechaFin, $year, $user);
        
		$data = array();

		foreach($TotalActasRegistradas as $row) {

            if($row["FECHA_SUPERVISION_ANTERIOR"] == "1900-01-01"){
               $supervision_anterior = "Sin Registro";
            }else{
                $supervision_anterior = $row["FECHA_SUPERVISION_ANTERIOR"];
            }

			$data[] = array(
                $row["NUMERACION_ACTA"],
                $row["NOMBRE_MEDICO"],
                $row["EESS_SUPERVISADO"],
                $row["SUPERVISOR_INFORMATICO"],
                $row["FECHA_SUPERVISION"],
                $supervision_anterior,

            );
            
		}

		return $data;
	}

    /*public function LoadDataEstablecimiento($fechaInicio, $fechaFin, $year, $user) {
		// Read file lines
       // $resultado = ReporteActividadAfiliacionController::mostrarReporteEessUbicacionCtr($fechaInicio, $fechaFin, $year, $user);
        //$totalUsuario = ReporteActividadAfiliacionController::mostrarReporteDigitadorCtr($fechaInicio, $fechaFin, $year, $user);

		$data = array();

		foreach($resultado as $row) {

			$data[] = array(
                $row["EESS_DIGITADOR"],
                $row["CANTIDAD"],
            );

		}

        foreach($totalUsuario as $fila) {
            array_push($data,['TOTAL', $fila['CANTIDAD']]);
		}


		return $data;
	}*/

	// Colored table
	public function ColoredTable($header,$data) {
		// Colors, line width and bold font
		$this->SetFillColor(194, 221, 255);
		$this->SetTextColor(0);
		$this->SetDrawColor(51, 116, 167);
		$this->SetLineWidth(0.1);
		$this->SetFont('', 'B');
		// Header
		$w = array(15,72,75,44,20,20);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;
		foreach($data as $row) {
            $this->Cell($w[0], 6, number_format($row[0]), 'LR', 0, 'R', $fill);
			$this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row[4], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row[5], 'LR', 0, 'L', $fill);


			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information


// set default header data


//$pdf->SetHeaderData('logo_manjau.png', PDF_HEADER_LOGO_WIDTH, 'MANJAU Pastelería', 'LIMA-LIMA-LURIGANCHO', array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------


// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage('L', 'A4');

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
// ---------------------------------------------------------
$bloque1 = <<<EOD

    <table>

        <tr>
            <td style="text-align:center;font-size: 10px; border:1px solid #666; background-color:white; width:870px;">REPORTE DE PRODUCCION DEL PERSONAL - OFICINA DE SEGUROS</td>
        </tr>

        <tr>

            <td style="border:1px solid #666; background-color:white; width: 250px;">

                     <img src="images/logo_diris.png">
            
            </td>

            <td style="border:1px solid #666; background-color:white; width: 200px; font-size: 8.5px; text-align:left; line-height: 13px;">

                    <br>
                    Direccion: Asoc. Víctor Raúl Haya De La Torre. Independencia - Lima

            </td>


            <td style="border:1px solid #666; background-color:white; width: 200px; font-size: 8.5px; text-align:left; line-height: 13px;">

                    <br>
                    Teléfono: 201-1348 (Anexo 136)

                    <br>
                    oficina.segurosdirisln@gmail.com

            </td>

            <td style="border:1px solid #666; background-color:white; width: 220px; font-size: 8.5px; text-align:center;">

                    <br>
                    Sistema Integrado de la Oficina de Seguros
                    <br>
                    Versión 01

             </td>
        </tr>

        <tr>
            <td style="background-color:white; width:870px;"></td>
        </tr>

    </table>


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque1, 0, 1, 0, true, '', true);
// ---------------------------------------------------------


// ---------------------------------------------------------
$bloque2 = <<<EOD

    <table style="font-size:10px; padding:5px 10px;">
        <tr>
            <td style="border:1px solid #666; background-color:white; width:350px">Usuario: $nombre_usuario</td>

            <td style="border:1px solid #666; background-color:white; width:220px; text-align:left;">Documento: $user</td>

            <td style="border:1px solid #666; background-color:white; width:300px;">Tipo Reporte: $tipo_reporte </td>

        </tr>


        <tr>

             <td style="border:1px solid #666; background-color:white; width:300px;">Fecha Inicio: $fechaInicio </td>
             <td style="border:1px solid #666; background-color:white; width:300px;">Fecha Final: $fechaFin </td>
             <td style="border:1px solid #666; background-color:white; width:270px;">Fecha Impresión: $DateAndTime </td>
        </tr>


        <tr>
         <td style="background-color:white; width:580px;"></td>
        </tr>


    </table>


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque2, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

$bloque3 = <<<EOD

    <table style="font-size:12px; padding:5px 10px;">

        <tr>
         <td style="background-color:white; width:870px;">

            Cuadro N° 1 - Actas de Supervision registradas por el Profesional

         </td>
        </tr>

    </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque3, 0, 1, 0, true, '', true);
// ---------------------------------------------------------


$pdf->SetFont('helvetica', '', 6);

// column titles
$header = array('Num. Acta', 'Medico Auditor', 'Establecimiento','Supervisor Informatico','Fecha Supervision','Superv. Anterior');

// data loading
$data = $pdf->LoadDataTotalActas($fechaInicio, $fechaFin, $year, $user);

// print colored table
$pdf->ColoredTable($header, $data);


// ---------------------------------------------------------
$bloque4 = <<<EOD

    <table style="font-size:10px; padding:5px 10px;>
    
        <tr>
            <td style="background-color:white; width:870px;"></td>
        </tr>
    
    </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque4, 0, 1, 0, true, '', true);
// ---------------------------------------------------------


// ---------------------------------------------------------


$bloque7 = <<<EOD

    <table style="font-size:12px; padding:5px 10px;">

        <tr>
         <td style="background-color:white; width:400px;">Cuadro N° 2 - Registros por Establecimiento que realiza la Atención</td>
        </tr>

    </table>

EOD;

// Print text using writeHTMLCell()
/*$pdf->writeHTMLCell(0, 0, '', '', $bloque7, 0, 1, 0, true, '', true);


$pdf->SetFont('helvetica', '', 9);

// column titles
$header = array('Establecimiento Atención', 'Cantidad');

// data loading
$data = $pdf->LoadDataEstablecimiento($fechaInicio, $fechaFin, $year, $user);

// print colored table
$pdf->ColoredTable($header, $data);*/



// ---------------------------------------------------------

$bloque8 = <<<EOD


    <table style="font-size:10px; padding:5px 10px; margin: 50px 0px 0px 0px;>
    
        <tr>
            <td style="background-color:white; width:580px;"></td>
        </tr>

    </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque8, 0, 1, 0, true, '', true);



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque9, 0, 1, 0, true, '', true);



// ---------------------------------------------------------



// ---------------------------------------------------------

ob_end_clean();


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('reporte.pdf', 'I');


