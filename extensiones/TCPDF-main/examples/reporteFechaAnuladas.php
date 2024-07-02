<?php
//============================================================+


require_once '../../../controlador/EstablecimientoControlador.php';
require_once '../../../controlador/UsuariosControlador.php';
require_once '../../../controlador/EstadisticaControlador.php';

require_once '../../../modelo/EstablecimientoModelo.php';
require_once '../../../modelo/EstadisticaModelo.php';
require_once '../../../modelo/UsuariosModelo.php';


/*
$user = $_GET["user"];
$fechaInicio = $_GET["inicio"];
$fechaFin = $_GET["fin"];
$year = $_GET["year"];*/

$datos = explode(',', $_GET['datos']);
$fechaInicio = $datos[0];
$fechaFin = $datos[1];
$item = $datos[2];
$valor = $datos[3];


date_default_timezone_set('America/Lima'); 
$DateAndTime = date('d-m-Y h:i:s a', time());

$tipo_reporte =  'RANGO DE FECHA';

//datos para tabla
$respuesta_anuladas_total = EstadisticaControlador::FuasAnuladasRango('fuas_anulados_rango_total',$fechaInicio, $fechaFin, $item, $valor);
$respuesta_anuladas_dia = EstadisticaControlador::FuasAnuladasRango('fuas_anulados_rango_dia',$fechaInicio, $fechaFin, $item, $valor);


if($item == 'DOCUMENTO_DIGITADOR'){
    $titulo_nombre = 'Personal';
    $titulo_codigo = 'Documento';

    $respuesta = UsuariosControlador::MostrarUsuario("CAT_USUARIO","DOCUMENTO",$valor);
    $nombre = $respuesta['NOMBRES'].' '.$respuesta['APELLIDOS'];
    $codigo = $respuesta['DOCUMENTO'];

}else if($item == 'RENIPRESS_FUA'){
    $titulo_nombre = 'Establecimiento';
    $titulo_codigo = 'Renipress';

    $respuesta = EstablecimientoControlador::mostrarIpressGeneral('eess_unico','RENAES',$valor);
    $nombre = $respuesta['EESS'];
    $codigo = $respuesta['RENAES'];

    if($valor == '%'){
        $nombre = 'DIRIS LIMA NORTE';
        $codigo = '-';
    }
}

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
$pdf->AddPage();


// Set some content to print
// ---------------------------------------------------------
$bloque1 = <<<EOD

    <table>

        <tr>
            <td style="text-align:center;font-size: 10px; border:1px solid #666; background-color:white; width:560px;">REPORTE DE FUAS ANULADAS - OFICINA DE SEGUROS</td>
        </tr>

        <tr>

            <td style="border:1px solid #666; background-color:white; width: 260px; font-size: 8.5px; text-align:left; line-height: 13px;">Direccion: Asoc. Víctor Raúl Haya De La Torre. Independencia - Lima
            </td>

            <td style="border:1px solid #666; background-color:white; width: 150px; font-size: 8.5px; text-align:left; line-height: 13px;">

                    <br>
                    Teléfono: 201-1348 (Anexo 136)

                    <br>
                    oficina.segurosdirisln@gmail.com

            </td>

            <td style="border:1px solid #666; background-color:white; width: 150px; font-size: 8.5px; text-align:center;">

                    <br>
                    Sistema Integrado de la Oficina de Seguros
                    <br>
                    Versión 02

             </td>
        </tr>

        <tr>
            <td style="background-color:white; width:580px;"></td>
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
            <td style="border:1px solid #666; background-color:white; width:330px">$titulo_nombre: $nombre</td>

            <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;">$titulo_codigo: $codigo</td>

        </tr>


        <tr>
             <td style="border:1px solid #666; background-color:white; width:230px;">Tipo Reporte: $tipo_reporte </td>
             <td style="border:1px solid #666; background-color:white; width:165px;">Fecha Inicio: $fechaInicio </td>
             <td style="border:1px solid #666; background-color:white; width:165px;">Fecha Final: $fechaFin </td>
        </tr>

        <tr>
         <td style="border:1px solid #666; background-color:white; width:560px;">Fecha de Impresión: $DateAndTime </td>
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
         <td style="background-color:white; width:500px;">

            Cuadro N° 1 - Fuas Anuladas Registradas por Tipo de Error

         </td>
        </tr>

        <tr><td style="background-color:white; width:560px; "></td></tr>

    </table>


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque3, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

$tabla_anuladas_total = '';

$tabla_anuladas_total .='<table>
            <tr><th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:200px; font-size: 10px; padding: 4px;">TIPO ERROR<br></th>
                <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:200px; font-size: 10px; padding: 4px;">TOTAL<br></th>
                </tr>';

     $array_sumar = array(); 
              
    foreach($respuesta_anuladas_total as $key => $value){

        array_push($array_sumar, $value['Cantidad']);

        $tabla_anuladas_total .= '<tr><td style="background-color:white; border:1px solid #666; width:200px; font-size: 10px; padding: 4px;">'.$value['TIPO_ERROR'].'<br></td>
                          <td style="background-color:white; text-align:center; border:1px solid #666; width:200px; font-size: 10px; padding: 4px;">'.$value['Cantidad'].'<br></td>
                          </tr>';
    }


    $tabla_anuladas_total.= '<tr>
        <td style="background-color:white; text-align:center; border:1px solid #666; width:200px; font-size: 10px; padding: 4px;">Total<br></td>
        <td style="background-color:white; text-align:center; border:1px solid #666; width:200px; font-size: 10px; padding: 4px;">'.array_sum($array_sumar).'<br></td>
    </tr>';


   $tabla_anuladas_total .= '<tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

    </table>';


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '',$tabla_anuladas_total, 0, 1, 0, true, '', true);

// ---------------------------------------------------------
$bloque4 = <<<EOD

    <table style="font-size:10px; padding:5px 10px;>
    
        <tr>
            <td style="background-color:white; width:580px;"></td>
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
         <td style="background-color:white; width:400px;">Cuadro N° 2 - Registros de Fuas Anuladas por Dia</td>
        </tr>
        <tr><td style="background-color:white; width:560px; "></td></tr>

    </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque7, 0, 1, 0, true, '', true);

$tabla_anuladas_dia = '';

$tabla_anuladas_dia .='<table>
            <tr><th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:150px; font-size: 10px; padding: 4px;">Fecha Registro<br></th>
                <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:150px; font-size: 10px; padding: 4px;">Cantidad<br></th>
                </tr>';

    $array_sumar_dias = array();  

    foreach($respuesta_anuladas_dia as $key => $value){

        array_push($array_sumar_dias, $value['Cantidad']);
        
        $tabla_anuladas_dia .= '<tr><td style="background-color:white; text-align:center; border:1px solid #666; width:150px; font-size: 10px; padding: 4px;">'.$value['Fecha_registro'].'</td>';
        
        if($value['Cantidad'] == '0'){
            $tabla_anuladas_dia .= '<td style="background-color:white; text-align:center; border:1px solid #666; width:150px; font-size: 10px; padding: 4px;">'.$value['Cantidad'].'</td>';  
        }else{
            $tabla_anuladas_dia .= '<td style="background-color: #92FFE6; text-align:center; border:1px solid #666; width:150px; font-size: 10px; padding: 4px;">'.$value['Cantidad'].'</td>';     
        }

        $tabla_anuladas_dia .= '</tr>';


    }

    $tabla_anuladas_dia.= '<tr>
        <td style="background-color:white; text-align:center; border:1px solid #666; width:150px; font-size: 10px; padding: 1px;">Total<br></td>
        <td style="background-color:white; text-align:center; border:1px solid #666; width:150px; font-size: 10px; padding: 1px;">'.array_sum($array_sumar_dias).'<br></td>
    </tr>';


   $tabla_anuladas_dia .= '<tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

    </table>';


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '',$tabla_anuladas_dia, 0, 1, 0, true, '', true);

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


// ---------------------------------------------------------



// ---------------------------------------------------------

ob_end_clean();


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('reporte.pdf', 'I');


