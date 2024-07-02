<?php
//============================================================+

require_once '../../../controllers/ActaMedicoController.php';
require_once '../../../controllers/EstablecimientoController.php';

require_once '../../../models/ActaMedicoModel.php';
require_once '../../../models/EstablecimientoModel.php';


date_default_timezone_set('America/Lima'); 
$DateAndTime = date('d-m-Y h:i:s a', time());


//encabezado
$docMedico = $_GET["docMedico"];
$acta = $_GET["acta"];
$encabezadoActa = ActaMedicoController::ctrMostrarActaMedicoUnico($acta, $docMedico);
$acta = '00'.$encabezadoActa['NUMERACION_ACTA'];
$nombreMedico = $encabezadoActa['NOMBRE_MEDICO'];
$eess_supervisado = $encabezadoActa['EESS_SUPERVISADO'];
$supervisor_informatico = $encabezadoActa['SUPERVISOR_INFORMATICO'];
$digitador = $encabezadoActa['DIGITADOR'];
$fecha_supervision = $encabezadoActa['FECHA_SUPERVISION'];

//COMENTARIOS

$resultados_comentarios = ActaMedicoController::ctrMostrarComentariosActa($docMedico,$acta);
$conclusiones = $resultados_comentarios['CONCLUSION'];
$recomendaciones = $resultados_comentarios['RECOMENDACION'];

//IMAGEN ACTA

$result_imagen_sup = ActaMedicoController::ctrMostrarImagenSupervision($docMedico, $acta);
if(is_array($result_imagen_sup)){
    $ruta_imagen = $result_imagen_sup['RUTA'];

}else{
    $ruta_imagen = 'views/img_supervision/advertencia_imagen.jpg';
}


//RESPONSABLES SECTOR

$respuesta_responsables = ActaMedicoController::ctrMostrarResponsablesSector($docMedico);
$nombre_sector = $respuesta_responsables['SECTOR'];
$numero_equipo = $respuesta_responsables['EQUIPO'];

//AFILIADOS CANTIDADES

$respuesta_afiliados = ActaMedicoController::ctrMostrarAfiliadosCantidades($eess_supervisado);
$cantidad_afi = $respuesta_afiliados['CANTIDAD'];
$mes_actualizacion_afi = $respuesta_afiliados['MES_ACTUALIZACION'];

//ITEMS OBSERVADOS

$respuesta_observados = ActaMedicoController::ctrMostrarActaMedicoGeneralObservados($docMedico, $acta);

//PORCENTAJE APROBACION
$resultado_observados_cantidad = ActaMedicoController::ctrMostrarActaMedicoGeneralObservadosCantidad($docMedico, $acta);

$preguntasTotales = 36;
$cantidad_observados = $resultado_observados_cantidad['CANTIDAD_OBS'];
$preguntas_correctas = 36-$cantidad_observados;
$cumplimiento_sf = ($preguntas_correctas/$preguntasTotales)*100;
$cumplimiento = number_format($cumplimiento_sf,2);


//numero informe
$resultado_numero_informe= ActaMedicoController::ctrMostrarNumeroInforme($docMedico, $acta);
$numero_informe = $resultado_numero_informe['NRO_INFORME'];
$anio_informe = $resultado_numero_informe['ANIO_INFORME'];

//FECHA LARGA

$dia = substr($fecha_supervision,8,2);
$mes = substr($fecha_supervision,5,2);

if($mes == '01'){
    $nombre_mes = 'ENERO';
}elseif($mes == '02'){
    $nombre_mes = 'FEBRERO';
}elseif($mes == '03'){
    $nombre_mes = 'MARZO';
}elseif($mes == '04'){
    $nombre_mes = 'ABRIL';
}elseif($mes == '05'){
    $nombre_mes = 'MAYO';
}elseif($mes == '06'){
    $nombre_mes = 'JUNIO';
}elseif($mes == '07'){
    $nombre_mes = 'JULIO';
}elseif($mes == '08'){
    $nombre_mes = 'AGOSTO';
}elseif($mes == '09'){
    $nombre_mes = 'SEPTIEMBRE';
}elseif($mes == '10'){
    $nombre_mes = 'OCTUBRE';
}elseif($mes == '11'){
    $nombre_mes = 'NOVIEMBRE';
}elseif($mes == '12'){
    $nombre_mes = 'DICIEMBRE';
}

$anio = substr($fecha_supervision,0,4);

if($encabezadoActa['FECHA_SUPERVISION_ANTERIOR'] == '1900-01-01'){
    $fecha_supervision_ant = "";
}else{
    $fecha_supervision_ant = $encabezadoActa['FECHA_SUPERVISION_ANTERIOR'];
}

//INFORMACION EESS

$resultado_eess = EstablecimientoController::ctrMostrarEessSeleccionado('CAT_ESTABLECIMIENTO','EESS',$eess_supervisado);
$distrito_eess = $resultado_eess['DISTRITO'];
$codigo_renipress = $resultado_eess['RENAES'];
$categoria_eess = $resultado_eess['ABREVIATURA'];


// A
$resp_1a = "1A"; 
$resultado1a = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_1a);
$selec_1a = $resultado1a['RESPUESTA_SELECCION'];
$obs_1a = $resultado1a['OBSERVACION'];

$resp_2a = "2A"; 
$resultado2a = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_2a);
$selec_2a = $resultado2a['RESPUESTA_SELECCION'];
$obs_2a = $resultado2a['OBSERVACION'];

//B

$resp_1b = "1B"; 
$resultado1b = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_1b);
$selec_1b = $resultado1b['RESPUESTA_SELECCION'];
$obs_1b = $resultado1b['OBSERVACION'];

$resp_2b = "2B"; 
$resultado2b = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_2b);
$selec_2b = $resultado2b['RESPUESTA_SELECCION'];
$obs_2b = $resultado2b['OBSERVACION'];

$resp_3b = "3B"; 
$resultado3b = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_3b);
$selec_3b = $resultado3b['RESPUESTA_SELECCION'];
$obs_3b = $resultado3b['OBSERVACION'];

$resp_4b = "4B"; 
$resultado4b = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_4b);
$selec_4b = $resultado4b['RESPUESTA_SELECCION'];
$obs_4b = $resultado4b['OBSERVACION'];

//C

$resp_1c = "1C"; 
$resultado1c = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_1c);
$selec_1c = $resultado1c['RESPUESTA_SELECCION'];
$obs_1c = $resultado1c['OBSERVACION'];

//D

$resp_1d = "1D"; 
$resultado1d = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_1d);
$selec_1d = $resultado1d['RESPUESTA_SELECCION'];
$obs_1d = $resultado1d['OBSERVACION'];

$resp_2d = "2D"; 
$resultado2d = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_2d);
$selec_2d = $resultado2d['RESPUESTA_SELECCION'];
$obs_2d = $resultado2d['OBSERVACION'];

$resp_3d = "3D"; 
$resultado3d = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_3d);
$selec_3d = $resultado3d['RESPUESTA_SELECCION'];
$obs_3d = $resultado3d['OBSERVACION'];

$resp_4d = "4D"; 
$resultado4d = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_4d);
$selec_4d = $resultado4d['RESPUESTA_SELECCION'];
$obs_4d = $resultado4d['OBSERVACION'];

$resp_5d = "5D"; 
$resultado5d = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_5d);
$selec_5d = $resultado5d['RESPUESTA_SELECCION'];
$obs_5d = $resultado5d['OBSERVACION'];

$resp_6d = "6D"; 
$resultado6d = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_6d);
$selec_6d = $resultado6d['RESPUESTA_SELECCION'];
$obs_6d = $resultado6d['OBSERVACION'];

$resp_7d = "7D"; 
$resultado7d = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_7d);
$selec_7d = $resultado7d['RESPUESTA_SELECCION'];
$obs_7d = $resultado7d['OBSERVACION'];

$resp_8d = "8D"; 
$resultado8d = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_8d);
$selec_8d = $resultado8d['RESPUESTA_SELECCION'];
$obs_8d = $resultado8d['OBSERVACION'];

//E

$resp_1e = "1E"; 
$resultado1e = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_1e);
$selec_1e = $resultado1e['RESPUESTA_SELECCION'];
$obs_1e = $resultado1e['OBSERVACION'];

$resp_2e = "2E"; 
$resultado2e = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_2e);
$selec_2e = $resultado2e['RESPUESTA_SELECCION'];
$obs_2e = $resultado2e['OBSERVACION'];

$resp_3e = "3E"; 
$resultado3e = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_3e);
$selec_3e = $resultado3e['RESPUESTA_SELECCION'];
$obs_3e = $resultado3e['OBSERVACION'];

$resp_4e = "4E"; 
$resultado4e = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_4e);
$selec_4e = $resultado4e['RESPUESTA_SELECCION'];
$obs_4e = $resultado4e['OBSERVACION'];

//F

$resp_1f = "1F"; 
$resultado1f = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_1f);
$selec_1f = $resultado1f['RESPUESTA_SELECCION'];
$obs_1f = $resultado1f['OBSERVACION'];

$resp_2f = "2F"; 
$resultado2f = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_2f);
$selec_2f = $resultado2f['RESPUESTA_SELECCION'];
$obs_2f = $resultado2f['OBSERVACION'];

$resp_3f = "3F"; 
$resultado3f = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_3f);
$selec_3f = $resultado3f['RESPUESTA_SELECCION'];
$obs_3f = $resultado3f['OBSERVACION'];

$resp_4f = "4F"; 
$resultado4f = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_4f);
$selec_4f = $resultado4f['RESPUESTA_SELECCION'];
$obs_4f = $resultado4f['OBSERVACION'];

$resp_5f = "5F"; 
$resultado5f = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_5f);
$selec_5f = $resultado5f['RESPUESTA_SELECCION'];
$obs_5f = $resultado5f['OBSERVACION'];

$resp_6f = "6F"; 
$resultado6f = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_6f);
$selec_6f = $resultado6f['RESPUESTA_SELECCION'];
$obs_6f = $resultado6f['OBSERVACION'];

$resp_7f = "7F"; 
$resultado7f = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_7f);
$selec_7f = $resultado7f['RESPUESTA_SELECCION'];
$obs_7f = $resultado7f['OBSERVACION'];


//G

$resp_1g = "1G"; 
$resultado1g = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_1g);
$selec_1g = $resultado1g['RESPUESTA_SELECCION'];
$obs_1g = $resultado1g['OBSERVACION'];

$resp_2g = "2G"; 
$resultado2g = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_2g);
$selec_2g = $resultado2g['RESPUESTA_SELECCION'];
$obs_2g = $resultado2g['OBSERVACION'];

$resp_3g = "3G"; 
$resultado3g = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_3g);
$selec_3g = $resultado3g['RESPUESTA_SELECCION'];
$obs_3g = $resultado3g['OBSERVACION'];

$resp_4g = "4G"; 
$resultado4g = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_4g);
$selec_4g = $resultado4g['RESPUESTA_SELECCION'];
$obs_4g = $resultado4g['OBSERVACION'];

//H

$resp_1h = "1H"; 
$resultado1h = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_1h);
$selec_1h = $resultado1h['RESPUESTA_SELECCION'];
$obs_1h = $resultado1h['OBSERVACION'];

$resp_2h = "2H"; 
$resultado2h = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_2h);
$selec_2h = $resultado2h['RESPUESTA_SELECCION'];
$obs_2h = $resultado2h['OBSERVACION'];

$resp_3h = "3H"; 
$resultado3h = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_3h);
$selec_3h = $resultado3h['RESPUESTA_SELECCION'];
$obs_3h = $resultado3h['OBSERVACION'];

$resp_4h = "4H"; 
$resultado4h = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_4h);
$selec_4h = $resultado4h['RESPUESTA_SELECCION'];
$obs_4h = $resultado4h['OBSERVACION'];

$resp_5h = "5H"; 
$resultado5h = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_5h);
$selec_5h = $resultado5h['RESPUESTA_SELECCION'];
$obs_5h = $resultado5h['OBSERVACION'];

$resp_6h = "6H"; 
$resultado6h = ActaMedicoController::ctrMostrarActaMedicoItem($acta, $docMedico, $resp_6h);
$selec_6h = $resultado6h['RESPUESTA_SELECCION'];
$obs_6h = $resultado6h['OBSERVACION'];


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
$pdf->SetMargins(PDF_MARGIN_TOP,PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
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

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
// ---------------------------------------------------------

$bloque31 = <<<EOD

    <table>

    <tr>
        <td style="background-color:white; width:315px;">
            <img src="images/logodiris.jfif">
        </td>
    </tr>


        <tr>
            <td style="text-align:center;font-size: 10px; background-color:white; width:560px;">“Año del Bicentenario del Perú:  200 años de Independencia”</td>
        </tr>

        <tr>
        <td style="text-align:center;font-size: 10px; background-color:white; width:560px;">“Decenio de la Igualdad de Oportunidades para Mujeres y Hombres”</td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px;"></td>
        </tr>

        <tr>
        <td style="text-align:left;font-size: 11px; background-color:white; width:560px;">INFORME Nº 0$numero_informe-$anio_informe-EQT0<small style="font-size: 11px;">$numero_equipo</small>-OFSEG-DIRIS/LN</td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px;"></td>
        </tr>

        <tr>
        <td style="text-align:left;font-size: 10px; background-color:white; width:100px;">A</td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:50px;">:</td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:410px;">M.C. MONICA EDITH ZUÑIGA CONDOR</td>
        </tr>

        <tr>
        <td style="text-align:left;font-size: 10px; background-color:white; width:150px;"></td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:410px;">JEFE DE LA OFICINA DE SEGUROS DIRIS LIMA NORTE</td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px;"></td>
        </tr>


        <tr>
        <td style="text-align:left;font-size: 10px; background-color:white; width:100px;">DE</td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:50px;">:</td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:410px;">M.C. $nombreMedico</td>
        </tr>

        <tr>
        <td style="text-align:left;font-size: 10px; background-color:white; width:150px;"></td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:410px;">MÉDICO AUDITOR</td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px;"></td>
        </tr>

        <tr>
        <td style="text-align:left;font-size: 10px; background-color:white; width:100px;">ASUNTO</td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:50px;">:</td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:410px;">SUPERVISIÓN Y AUDITORÍA A LA IPRESS $eess_supervisado</td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px;"></td>
        </tr>

        <tr>
        <td style="text-align:left;font-size: 10px; background-color:white; width:100px;">FECHA</td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:50px;">:</td>
        <td style="text-align:left;font-size: 10px; background-color:white; width:410px;">LIMA, $dia DE $nombre_mes DEL $anio</td>
        </tr>


        <tr>
            <td style="background-color:white; width:560px; border-bottom:1px solid #666"></td>
        </tr>

    </table>


EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque31, 0, 1, 0, true, '', true);
// ---------------------------------------------------------


$bloque32 = <<<EOD

    <table>

        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
            <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:150%;">
            Tengo el agrado de dirigirme a usted para saludarlo cordialmente y a su vez informarle los resultados de la Supervisión y Auditoría realizada a la IPRESS <small style="font-weight: bold; font-size:11px;">$eess_supervisado</small>  el día <small style="font-weight: bold; font-size:11px;">$dia</small> de <small style="font-weight: bold; font-size:11px;">$nombre_mes</small> del <small style="font-weight: bold; font-size:11px;">$anio</small>, a cargo de la Médica/o  Auditor <small style="font-weight: bold; font-size:11px;">M.C. $nombreMedico</small> responsable del Sector <small style="font-weight: bold; font-size:11px;">$nombre_sector</small> equipo <small style="font-weight: bold; font-size:11px;">$numero_equipo</small>.
            </td>
         </tr


    </table>


EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque32, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

$bloque33 = <<<EOD

    <table>

        <tr>
            <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">
            I. ANTECEDENTES:
            </td>
         </tr>

         
        <tr><td style="background-color:white; width:560px; "></td></tr>


         <tr>
            <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">•
                Ley N°26842, “Ley General de Salud”; determina como una de las funciones de las Instituciones Administradoras de Fondos de Aseguramiento en Salud, el establecer y realizar procedimientos para controlar para controlar las prestaciones de salud, en forma eficiente, oportuna y de calidad en los servicios prestados por las Instituciones Prestadoras de Servicios de Salud (IPRESS).
            </td>
         </tr>

         <tr>
             <td style="background-color:white; width:560px; "></td>
         </tr>


         <tr>
            <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">•
                 Decreto Legislativo N° 1163, que aprueba disposiciones para el fortalecimiento del Seguro Integral de Salud, la cual establece que todas las acciones realizadas con los recursos del Seguro Integral de Salud (SIS) constituyen materia de control. Las entidades públicas y privadas que reciban reembolsos, pagos y/o transferencias financieras son sujeto de supervisión, monitoreo y control por parte del Seguro Integral de Salud (SIS) respecto de los servicios que contrate o convenga.
            </td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">•
            Resolución Ministerial N° 214-2018/MINSA, que aprueba la NTS N° 139-MINSA/2018/DGAIN: “Norma Técnica de Salud para la Gestión de la Historia Clínica”.
        </td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>
        
        <tr>
        <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">•
            Resolución Ministerial N° 695-2006/MINSA, que aprueba la Guía Técnica “Guías de Practica Clínica para la Atención de Emergencias Obstétricas según nivel de Capacidad Resolutiva y sus 10 Anexos”.
        </td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">•
            Resolución Ministerial N°827-2013/MINSA, que aprueba la Norma Técnica de salud para la Atención Integral de Salud Materna.
        </td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">•
            Resolución Ministerial N°537-2017/MINSA, que aprueba la Norma Técnica de salud para el Control de Crecimiento y Desarrollo de la Niña y el Niño Menor de Cinco Años.
        </td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">•
            Resolución Ministerial N°719-2018/MINSA, que aprueba la Norma Técnica de salud que establece el Esquema Nacional de Vacunación.
        </td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">•
            Directiva Administrativa N° 001-2016-SIS-GREP- V.03 “Directiva que establece el Proceso de Control Presencial Posterior de las Prestaciones de Salud Financiadas por el Seguro Integral de Salud” y sus Anexos.
        </td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">•
            Resolución Directoral N° 144-2021-MINSADIRIS.LN1_FUNCIONES-DIRISLN.
        </td>
        </tr>










        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>


    </table>


EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque33, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

$bloque34 = <<<EOD

    <table>

        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
            <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">
            II. ANÁLISIS:
            </td>
        </tr>
            
        <tr><td style="background-color:white; width:560px; "></td></tr>

        <tr>
        <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">Se realiza la Supervisión del Establecimiento de Salud <small style="font-weight: bold; font-size:11px;">$eess_supervisado</small>, ubicado en el distrito de <small style="font-weight: bold; font-size:11px;">$distrito_eess</small>  con código RENIPRESS <small style="font-weight: bold; font-size:11px;">$codigo_renipress</small> y categoría <small style="font-weight: bold; font-size:11px;">$categoria_eess</small>, con una población de <small style="font-weight: bold; font-size:11px;">$cantidad_afi</small> afiliados al SIS actualizado al mes de <small style="font-weight: bold; font-size:11px;">$mes_actualizacion_afi</small> del presente año, asimismo, tras la verificación del Acta de Supervisión que se adjunta al presente informe  <small style="font-weight: bold; font-size:11px;">(ANEXO 1)</small> se encontraron las siguientes observaciones:
        </td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
            <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">
            TABLA 01 - OBSERVACIONES HALLADAS:
            </td>
        </tr>
            
        <tr><td style="background-color:white; width:560px; "></td></tr>


    </table>

EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque34, 0, 1, 0, true, '', true);
// ---------------------------------------------------------


$bloque50 = '';

$bloque50 .='<table>
            <tr><th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:120px; font-size: 10px;">SECCION</th>
                <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:200px; font-size: 10px;">ITEM</th>
                <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:70px; font-size: 10px;">RESPUESTA</th>
                <th style="background-color:#bde0fe; text-align:center; border:1px solid #666; width:170px; font-size: 10px;">OBSERVACION</th>
                </tr>';

    foreach($respuesta_observados as $key => $value){

        $bloque50 .= '<tr><td style="background-color:white; border:1px solid #666; width:120px; font-size: 9px;">'.$value['DESCRIPCION_SECCION'].'</td>
                          <td style="background-color:white; border:1px solid #666; width:200px; font-size: 9px;">'.$value['DETALLE_ITEM'].'</td>
                          <td style="background-color:white; text-align:center; border:1px solid #666; width:70px; font-size: 9px;">'.$value['RESPUESTA_SELECCION'].'</td>
                          <td style="background-color:white; border:1px solid #666; width:170px; font-size: 9px;">'.$value['OBSERVACION'].'</td>
                          </tr>';

    }


   $bloque50 .= '<tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

    </table>';


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque50, 0, 1, 0, true, '', true);
// ---------------------------------------------------------



$bloque51 = <<<EOD

    <table>

        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">Se verifica que el Establecimiento de Salud <small style="font-weight: bold; font-size:11px;">$eess_supervisado</small> presenta un cumplimiento del <small style="font-weight: bold; font-size:12px;">$cumplimiento %</small> según lo evaluado.</td>
        </tr>

        <tr><td style="background-color:white; width:560px; "></td></tr>

    </table>

EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque51, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

$bloque35 = <<<EOD

    <table>

        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
            <td style="background-color:white; width:560px; font-size: 11px; text-align:justify; line-height:140%;">
            III. CONCLUSIONES:
            </td>
        </tr>

        <tr>
         <td style="background-color:white; width:560px; "></td>
        </tr>

    </table>

EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque35, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

$bloque36 = <<<EOD

    <table>

        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
            <td style="font-size: 11px; text-align:justify;">$conclusiones</td>
        </tr>
        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

    </table>

EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque36, 0, 1, 0, true, '', true);
// ---------------------------------------------------------


$bloque37 = <<<EOD

    <table>
        <tr><td style="background-color:white; width:560px; "></td></tr>
    </table>

    <table>

        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
            <td style="width:560px; font-size: 11px;">IV. RECOMENDACIONES:</td>
        </tr>


    </table>

EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque37, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

$bloque38 = <<<EOD

    <table>
       
        <tr><td style="background-color:white; width:560px; "></td></tr>

        <tr>
            <td style="background-color:white; width:560px; font-size: 11px; text-align:justify;">$recomendaciones</td>
        </tr>

        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>

    </table>

EOD;



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque38, 0, 1, 0, true, '', true);
// ---------------------------------------------------------



$bloque1 = <<<EOD



    <table>

        <tr>
         <td style="text-align:center;font-size: 10px; background-color:white; width:560px; text-align:center;"><small style="font-weight: bold; font-size:12px;">ANEXO 01 - ACTA DE SUPERVISIÓN</small></td>
        </tr>

    
        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
            <td style="text-align:center;font-size: 10px; border:1px solid #666; background-color:white; width:560px;">ACTA DE SUPERVISION - MEDICO AUDITOR</td>
        </tr>

        <tr>

            <td style="border:1px solid #666; background-color:white; width: 130px;">

                     <img src="images/logo_diris.png">
            
            </td>

            <td style="border:1px solid #666; background-color:white; width: 150px; font-size: 8.5px; text-align:left; line-height: 13px;">

                    <br>
                    Direccion: Asoc. Víctor Raúl Haya De La Torre. Independencia - Lima

            </td>


            <td style="border:1px solid #666; background-color:white; width: 150px; font-size: 8.5px; text-align:left; line-height: 13px;">

                    <br>
                    Teléfono: 201-1348 (Anexo 136)

                    <br>
                    oficina.segurosdirisln@gmail.com

            </td>

            <td style="border:1px solid #666; background-color:white; width: 130px; font-size: 8.5px; text-align:center;">

                    <br>
                    Sistema Integrado de la Oficina de Seguros
                    <br>
                    Versión 01

             </td>
        </tr>

        <tr>
            <td style="background-color:white; width:560px;"></td>
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
            <td style="border:1px solid #666; background-color:white; width:100px">Nro Acta: $acta </td>

            <td style="border:1px solid #666; background-color:white; width:300px; text-align:left;">Medico Auditor: $nombreMedico</td>

            <td style="border:1px solid #666; background-color:white; width:160px; text-align:left;">Documento: $docMedico </td>

        </tr>


        <tr>
             <td style="border:1px solid #666; background-color:white; width:300px;">EESS Supervisado: $eess_supervisado </td>
             <td style="border:1px solid #666; background-color:white; width:260px;">Supervidor Informatico: $supervisor_informatico </td>
             
        </tr>

        <tr>

            <td style="border:1px solid #666; background-color:white; width:300px;">Digitador Supervisado: $digitador </td>
            <td style="border:1px solid #666; background-color:white; width:260px;">Fecha de Supervision: $fecha_supervision </td>
         
        </tr>

        <tr>

            <td style="border:1px solid #666; background-color:white; width:300px;">Fecha de Supervision Anterior: $fecha_supervision_ant</td>
            <td style="border:1px solid #666; background-color:white; width:260px;">Fecha de impresion Acta: $DateAndTime</td>
     
         </tr>


    </table>


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque2, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

/*
$bloque3 = <<<EOD

    <table style="font-size:12px; padding:5px 10px;">

        <tr>
         <td style="background-color:white; width:630px;text-align:center; ">

         </td>
        </tr>

    </table>


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque3, 0, 1, 0, true, '', true);*/

// ---------------------------------------------------------


// ---------------------------------------------------------
$bloque4 = <<<EOD

    <table style="font-size:10px; padding:5px 10px;>
    
        <tr>
            <td style="background-color:white; width:560px;"></td>
        </tr>
    
    </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque4, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

// ---------------------------------------------------------

//SECCION A

$bloque5 = <<<EOD

            <table style="font-size:10px; padding:5px 10px;">
            <tr>
                <td style="border:1px solid #666; background-color:#bde0fe; width:560px">Sección A: Oficina de Seguros</td>

            </tr>

                <tr>
                    <td style="border:1px solid #666; background-color:white; width:280px">1. La Oficina de Seguros cuenta con infraestructura adecuada, periódico mural, horario de Atención y rol de turnos.</td>

                    <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_1a</td>

                    <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_1a</td>

                </tr>

            <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">2. Cuentan con útiles de escritorio.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_2a</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_2a</td>

            </tr>

            </table>

EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque5, 0, 1, 0, true, '', true);


// ---------------------------------------------------------

//SECCION B
$bloque6 = <<<EOD

            <table style="font-size:10px; padding:5px 10px;">

                <tr>
                     <td style="border:1px solid #666; background-color:#bde0fe; width:560px">Sección B: Análisis de la Información de Of. de Seguros</td>
                </tr>

                <tr>
                    <td style="border:1px solid #666; background-color:white; width:280px">1. Cuenta con Normativa del SIS físico o virtual.</td>

                    <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_1b</td>

                    <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_1b</td>

                </tr>

                    <tr>
                        <td style="border:1px solid #666; background-color:white; width:280px">2. Cuenta con cuaderno de cargo y Libro de Actas (informar sobre última actividad registrada).</td>

                        <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_2b</td>

                        <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_2b</td>

                    </tr>

                <tr>
                    <td style="border:1px solid #666; background-color:white; width:280px">3. Se evidencia seguimiento de Formato de Control y Seguimiento de Formatos Único de Atención (FUA).</td>

                    <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_3b</td>

                    <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_3b</td>

                </tr>

            <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">4. Tiene sepelios por entregar/observados por UDR por subsanar (indicar fecha de recepción).</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_4b</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_4b</td>

            </tr>


            </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque6, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

//SECCION C
$bloque7 = <<<EOD

            <table style="font-size:10px; padding:5px 10px;">

                <tr>
                     <td style="border:1px solid #666; background-color:#bde0fe; width:560px">Sección C: Digitación</td>
                </tr>

                <tr>
                    <td style="border:1px solid #666; background-color:white; width:280px">1. Digitación de FUAS anuladas al día en el aplicativo de la oficina de seguros (especificación de motivo y % respectivo).</td>

                    <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_1c</td>

                    <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_1c</td>

                </tr>



            </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque7, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

//SECCION D
$bloque8 = <<<EOD

            <table style="font-size:10px; padding:5px 10px;">

                <tr>
                     <td style="border:1px solid #666; background-color:#bde0fe; width:560px">Sección D: Abastecimiento de Medicamentos</td>
                </tr>

                <tr>
                    <td style="border:1px solid #666; background-color:white; width:280px">1. Hay stock para suplementación de gestantes.</td>

                    <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_1d</td>

                    <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_1d</td>

                </tr>
                <tr>

                <td style="border:1px solid #666; background-color:white; width:280px">2. Hay stock de medicamentos para tratamiento COVID.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_2d</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_2d</td>

                 </tr>

                 <tr>
                 <td style="border:1px solid #666; background-color:white; width:280px">3. Hay stock para tratamiento de enfermedades no transmisibles.</td>

                 <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_3d</td>

                 <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_3d</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">4. Hay stock para Medicamentos de anemia.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_4d</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_4d</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">5. Hay stock de dispositivos médicos.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_5d</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_5d</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">6. Hay stock de EPP (evidenciar en cuaderno de entregas de EPP).</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_6d</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_6d</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">7. Otros medicamentos y/o insumos mencionados como faltante o abastecimiento parcial.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_7d</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_7d</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">8. ¿existe alteraciones en la infraestructura, recurso humano o hay alguna otra observación en el área de farmacia?.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_8d</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_8d</td>

                 </tr>

            </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque8, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

//SECCION E
$bloque9 = <<<EOD

            <table style="font-size:10px; padding:5px 10px;">

                <tr>
                     <td style="border:1px solid #666; background-color:#bde0fe; width:560px">Sección E: Abastecimiento de Insumos - Laboratorio</td>
                </tr>

                <tr>
                    <td style="border:1px solid #666; background-color:white; width:280px">1. Se reporta reactivos y/o insumos faltantes.</td>

                    <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_1e</td>

                    <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_1e</td>

                </tr>
                <tr>

                <td style="border:1px solid #666; background-color:white; width:280px">2. Se reporta reactivos y/o insumos vencidos.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_2e</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_2e</td>

                 </tr>

                 <tr>
                 <td style="border:1px solid #666; background-color:white; width:280px">3. Se reporta equipos no operativos.</td>

                 <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_3e</td>

                 <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_3e</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">4. .-¿Existe alteraciones en la infraestructura, recurso humano o hay alguna otra observación?.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_4e</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_4e</td>

                </tr>


            </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque9, 0, 1, 0, true, '', true);

// ---------------------------------------------------------


//SECCION F
$bloque10 = <<<EOD

            <table style="font-size:10px; padding:5px 10px;">

                <tr>
                     <td style="border:1px solid #666; background-color:#bde0fe; width:560px">Sección F: Inmunizaciones</td>
                </tr>

                <tr>
                    <td style="border:1px solid #666; background-color:white; width:280px">1. Ambiente limpio, ordenado, iluminado, y con buena ventilación.</td>

                    <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_1f</td>

                    <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_1f</td>

                </tr>
                <tr>

                <td style="border:1px solid #666; background-color:white; width:280px">2. Cadena de frio (ambiente, congeladora Ice Lined, termos porta vacuna) en lugar adecuado dentro del vacunatorio. Verifica registros de temperatura.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_2f</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_2f</td>

                 </tr>

                 <tr>
                 <td style="border:1px solid #666; background-color:white; width:280px">3. Insumos médicos, y registros necesarios, para el procedimiento de vacunación.</td>

                 <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_3f</td>

                 <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_3f</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">4. Cuenta con Kit ESAVI completo y con fecha vigente.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_4f</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_4f</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">5. Se dispone de vacunas suficientes para cubrir a la demanda.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_5f</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_5f</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">6. Se realiza monitoreo para inmunizaciones según padrón nominal.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_6f</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_6f</td>

                </tr>


                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">7. ¿Existe alteraciones en la infraestructura, recurso humano o hay alguna otra observación en el área de Inmunizaciones?.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_7f</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_7f</td>

                </tr>

            </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque10, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

//SECCION G
$bloque11 = <<<EOD

            <table style="font-size:10px; padding:5px 10px;">

                <tr>
                     <td style="border:1px solid #666; background-color:#bde0fe; width:560px">Sección G: Crecimiento y Desarrollo</td>
                </tr>

                <tr>
                    <td style="border:1px solid #666; background-color:white; width:280px">1. Se verifica equipamiento adecuado para realizar CRED.</td>

                    <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_1g</td>

                    <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_1g</td>

                </tr>
                <tr>

                <td style="border:1px solid #666; background-color:white; width:280px">2. Hay RRHH suficiente para realizar CRED.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_2g</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_2g</td>

                 </tr>


                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">3. Se realiza monitoreo según Padrón Nominal.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_3g</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_3g</td>

                </tr>

                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">4. ¿Existe alteraciones en la infraestructura, recurso humano o hay alguna otra observación en el área de CRED?.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_4g</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_4g</td>

                </tr>

            </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque11, 0, 1, 0, true, '', true);

// ---------------------------------------------------------


//SECCION H
$bloque12 = <<<EOD

            <table style="font-size:10px; padding:5px 10px; margin-bottom: 600px;">

                <tr>
                     <td style="border:1px solid #666; background-color:#bde0fe; width:560px">Sección H: Salud Materna</td>
                </tr>

                <tr>
                    <td style="border:1px solid #666; background-color:white; width:280px">1. Clave Obstétricas Azul (abastecida y check list mensual de farmacia).</td>

                    <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_1h</td>

                    <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_1h</td>

                </tr>
                <tr>

                <td style="border:1px solid #666; background-color:white; width:280px">2. Clave Obstétricas Roja (abastecida y check list mensual de farmacia).</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_2h</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_2h</td>

                 </tr>

                 <tr>
                 <td style="border:1px solid #666; background-color:white; width:280px">3. Clave Obstétricas Amarilla (abastecida y check list mensual de farmacia).</td>

                 <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_3h</td>

                 <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_3h</td>

                </tr>


                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">4. Se realiza exámenes de laboratorio I (011) y III trimestre y vacunación (registrar reactivos).</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_4h</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_4h</td>

                </tr>


                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">5. Se conoce el flujo para aseguramiento SIS-cambio de estado (SIS GRATUITO para asegurar cobertura).</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_5h</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_5h</td>

                </tr>


                <tr>
                <td style="border:1px solid #666; background-color:white; width:280px">6. Se realiza seguimiento según padrón nominal.</td>

                <td style="border:1px solid #666; background-color:white; width:50px; text-align:left;"> $selec_6h</td>

                <td style="border:1px solid #666; background-color:white; width:230px; text-align:left;"> $obs_6h</td>

                </tr>

            </table>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque12, 0, 1, 0, true, '', true);

// ---------------------------------------------------------



$bloque20 = <<<EOD


    <table style="font-size:10px; padding:5px 10px; margin: 50px 0px 0px 0px;>
    
        <tr>
            <td style="background-color:white; width:560px;"></td>
        </tr>

    </table>


EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque20, 0, 1, 0, true, '', true);



$bloque22 = <<<EOD

    <table>



        <tr>
            <td style="background-color:white; width:560px; "></td>
        </tr>

        <tr>
        <td style="text-align:center;font-size: 10px; background-color:white; width:560px; text-align:center;"><small style="font-size:12px;">IMAGEN 01 - FOTO DE SUPERVISIÓN REALIZADA</small></td>
       </tr>
        
       
       <tr>
       <td style="background-color:white; width:560px; "></td>
       </tr>


       <tr>
            <td style="background-color:white; width:560px; text-align:center;">

                 <img src="../../../$ruta_imagen" width="500" height="400">

            </td>
        </tr>



        <tr>
        <td style="background-color:white; width:560px; "></td>
        </tr>


    </table>

EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque22, 0, 1, 0, true, '', true);
// ---------------------------------------------------------


$bloque21 = '
            <table style="font-size:10px; padding:5px 10px;">
                <br><br>

                <tr>
                    <td style="border:1px solid #666; background-color:#bde0fe; width:140px;text-align:left;">Firma Jefe del EESS</td>

                    <td style="border:1px solid #666; background-color:#bde0fe; width:140px; text-align:left;">Firma Medico Auditor</td>

                    <td style="border:1px solid #666; background-color:#bde0fe; width:140px; text-align:left;">Firma Supervisor Informático</td>

                    <td style="border:1px solid #666; background-color:#bde0fe; width:140px; text-align:left;">Firma Digitador</td>

                </tr>


                <tr>
                    <td style="border:1px solid #666; background-color:white; width:140px;text-align:left;"><br><br><br><br><br><br></td>

                    <td style="border:1px solid #666; background-color:white; width:140px; text-align:left;"><br><br><br><br><br><br></td>

                    <td style="border:1px solid #666; background-color:white; width:140px; text-align:left;"><br><br><br><br><br><br></td>

                    <td style="border:1px solid #666; background-color:white; width:140px; text-align:left;"><br><br><br><br><br><br></td>

                 </tr>

                 <tr>
                    <td style="border:1px solid #666; background-color:#bde0fe; width:140px;text-align:left;">Nombre:</td>

                    <td style="border:1px solid #666; background-color:#bde0fe; width:140px; text-align:left;">Nombre: '.$nombreMedico.'</td>

                    <td style="border:1px solid #666; background-color:#bde0fe; width:140px; text-align:left;">Nombre: '.$supervisor_informatico.'</td>

                    <td style="border:1px solid #666; background-color:#bde0fe; width:140px; text-align:left;">Nombre: '.$digitador.'</td>

                </tr>

            </table>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque21, 0, 1, 0, true, '', true);


// ---------------------------------------------------------


// ---------------------------------------------------------

ob_end_clean();


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('reporte.pdf', 'I');


