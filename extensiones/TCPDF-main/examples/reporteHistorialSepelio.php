<?php
//============================================================+

require_once '../../../controlador/UsuariosControlador.php';
require_once '../../../controlador/SepelioControlador.php';

require_once '../../../modelo/UsuariosModelo.php';
require_once '../../../modelo/SepelioModelo.php';

/*
$user = $_GET["user"];
$fechaInicio = $_GET["inicio"];
$fechaFin = $_GET["fin"];
$year = $_GET["year"];*/

$datos = explode(',', $_GET['datos']);

$id_hash = $datos[0];
$usuario = $datos[1];


date_default_timezone_set('America/Lima'); 
$DateAndTime = date('d-m-Y h:i:s a', time());

//DATOS SEPELIO

$sepelio = SepelioControlador::MostrarSepelio('','sepelio_unico','',$id_hash,'');
$fallecido = $sepelio['DOC_FALLECIDO'].' - '.$sepelio['NOMBRES_FALLECIDO'];
$expediente = $sepelio['ID'];
$estado = $sepelio['ESTADOS'];
$fecha_digitacion = substr($sepelio['FECHA_CREACION'],8,2).'-'.substr($sepelio['FECHA_CREACION'],5,2).'-'.substr($sepelio['FECHA_CREACION'],0,4).' '.substr($sepelio['FECHA_CREACION'],11,8);

//DATOS USUARIO IMPRIME
$dato_usuario = UsuariosControlador::MostrarUsuario('CAT_USUARIO','DOCUMENTO',$usuario);
$usuario_imprime = $usuario.' - '.$dato_usuario['NOMBRES'].' '.$dato_usuario['APELLIDOS'];

//DATOS HISTORIAL

$historial = SepelioControlador::mostrarHistorialSepelio($id_hash);


// Include the main TCPDF library (search for installation path).

require_once('tcpdf_include.php');

// extend TCPF with custom functions
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// extend TCPF with custom functions

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
$pdf->AddPage('L');


// Set some content to print
// ---------------------------------------------------------
$bloque1 = <<<EOD

    <table style="padding:5px 10px;" >
        <tr>
            <td style="text-align:center;font-size: 12px; border:1px solid #666; background-color:white; width:870px;">HISTORIAL EXPEDIENTE - MÓDULO SEPELIOS</td>
        </tr>

        <tr>

            <td style="border:1px solid #666; background-color:white; width: 290px; font-size: 8.5px; text-align:left; line-height: 13px;">Direccion: Asoc. Víctor Raúl Haya De La Torre. Independencia - Lima
            </td>

            <td style="border:1px solid #666; background-color:white; width: 290px; font-size: 8.5px; text-align:left; line-height: 13px;">

                    <br>
                    Teléfono: 201-1348 (Anexo 136)
                    <br>
                    oficina.segurosdirisln@gmail.com

            </td>

            <td style="border:1px solid #666; background-color:white; width: 290px; font-size: 8.5px; text-align:center;">

                    <br>
                    Sistema Integrado de la Oficina de Seguros
                    <br>
                    Versión 02

             </td>
        </tr>

        <tr>
            <td style="background-color:white; width:870px;"></td>
        </tr>

        <tr>
            <td style="background-color:white; width:870px; text-align:center; font-size: 12px;">
                FALLECIDO: $fallecido
            </td>
        </tr>

        <tr>
            <td style="background-color:white; width:870px; text-align:center; font-size: 13px;">
                N° EXPEDIENTE: $expediente
            </td>
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
            <td style="border:1px solid #666; background-color:white; width:870px; text-align:left;">FECHA IMPRESIÓN: $DateAndTime</td>

        </tr>

        <tr>
            <td style="border:1px solid #666; background-color:white; width:870px; text-align:left;">USUARIO IMPRIME: $usuario_imprime</td>
        </tr>

        <tr>
        <td style="border:1px solid #666; background-color:white; width:870px; text-align:left;">ESTADO ACTUAL EXPEDIENTE: $estado</td>
        </tr>

        <tr>
        <td style="border:1px solid #666; background-color:white; width:870px; text-align:left;">FECHA DIGITACION SEPELIO: $fecha_digitacion</td>
        </tr>


        <tr>
         <td style="background-color:white; width:870px;"></td>
        </tr>

    </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque2, 0, 1, 0, true, '', true);
// ---------------------------------------------------------


$bloque3 = <<<EOD

    <table style="font-size:12px; padding:5px 10px;">

        <tr>
         <td style="background-color:white; width:870px; text-align:center;">

            HISTORIAL DE EXPEDIENTE DE SEPELIO

         </td>
        </tr>

        <tr><td style="background-color:white; width:870px; "></td></tr>

    </table>


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque3, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

$tabla_ruta = '';

$tabla_ruta .='<table>
                 <tr>
                    <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:200px; font-size: 10px; padding: 4px;">USUARIO REALIZA<br></th>
                    <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:200px; font-size: 10px; padding: 4px;">CARGO<br></th>
                    <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:150px; font-size: 10px; padding: 4px;">FECHA ACCION<br></th>
                    <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:150px; font-size: 10px; padding: 4px;">ESTADO EXPEDIENTE<br></th>
                    <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:170px; font-size: 10px; padding: 4px;">OBSERVACIONES<br></th>

                </tr>';

    foreach($historial as $key => $value){

        $tabla_ruta .= '<tr>

                         <td style="background-color:white; border:1px solid #666; width:200px; font-size: 10px;">'.$value['ACTOR'].'-'.$value['NOMBRES'].'<br></td>
                         <td style="background-color:white; border:1px solid #666; width:200px; font-size: 10px;">'.$value['CARGO_ACTOR'].'<br></td>
                         <td style="background-color:white; border:1px solid #666; width:150px; font-size: 10px;">'.substr($value['FECHA_ACCION_REALIZADA'],0,19).'<br></td>
                         <td style="background-color:white; border:1px solid #666; width:150px; font-size: 10px;">'.$value['ESTADOS'].'<br></td>
                         <td style="background-color:white; border:1px solid #666; width:170px;  font-size: 10px;">'.$value['OBSERVACIONES'].'<br></td>
                         
                        </tr>';
    }



   $tabla_ruta .= '<tr>
        <td style="background-color:white; width:870px; "></td>
        </tr>

    </table>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '',$tabla_ruta, 0, 1, 0, true, '', true);

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

ob_end_clean();


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('reporte.pdf', 'I');


