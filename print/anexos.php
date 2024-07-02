<?php
ob_start();

use LDAP\Result;
use setasign\Fpdi\Fpdi;

require_once('../controlador/UsuariosControlador.php');
require_once('../modelo/UsuariosModelo.php');

require_once('../controlador/SepelioControlador.php');
require_once('../modelo/SepelioModelo.php');

require_once('fpdf/fpdf.php');
require_once('fpdi2/src/autoload.php');

//DATOS DE BD INGRESADA

if(isset($_GET['id'])){

    $id = $_GET['id'];
    //obtener datos de la bd

    $result = SepelioControlador::MostrarSepelio('','sepelio_anexos','',$id,'');

    $lugar = utf8_decode($result['LUGAR_PRESENTACION']);
    $fecha_presentacion = $result['FECHA_PRESENTACION'];
    $mes_presentacion = substr($fecha_presentacion,5,2);
    //obtener mes en nombre
    
    switch ($mes_presentacion) {
        case '01':
            $mes_presentacion = "ENERO";
            break;
        case '02':
            $mes_presentacion = "FEBRERO";
            break;
        case '03':
            $mes_presentacion = "MARZO";
            break;
        case '04':
            $mes_presentacion = "ABRIL";
            break;
        case '05':
            $mes_presentacion = "MAYO";
            break;
        case '06':
            $mes_presentacion = "JUNIO";
            break;
        case '07':
            $mes_presentacion = "JULIO";
            break;
        case '08':
            $mes_presentacion = "AGOSTO";
            break;
        case '09':
            $mes_presentacion = "SETIEMBRE";
            break;
        case '10':
            $mes_presentacion = "OCTUBRE";
            break;
        case '11':
            $mes_presentacion = "NOVIEMBRE";
            break;
        case '12':
            $mes_presentacion = "DICIEMBRE";
            break;

    }
   
    $documento_digitador = $result['DOCUMENTO_DIGITADOR'];
    $array_digitador = UsuariosControlador::MostrarUsuario('CAT_USUARIO','DOCUMENTO',$documento_digitador);
    $nombre_digitador = $array_digitador['APELLIDOS'].' '.$array_digitador['NOMBRES'];

    $nombre_ipress_abrev = $result['NOMBRE_ABREV'];
    $nombre_ipress_iniciales = $result['SHORT'];

    $dia_presentacion = substr($fecha_presentacion,8,2);
    $anio_presentacion = substr($fecha_presentacion,0,4);
    $fecha = $dia_presentacion.' '.$mes_presentacion.' '.$anio_presentacion;
    $ipressPublica = utf8_decode($result['IPRESS_PRESENTACION']);
    $acreditado = utf8_decode($result['NOMBRES_ACRED']);
    $documentoAcreditado = $result['DOC_ACRED'];
    $domicilioAcreditado = utf8_decode($result['DIRECCION_ACRED']);
    $referenciaDomicilioAcreditado = utf8_decode($result['REF_DOMICILIO_ACRED']);
    $edad_acreditado = $result['EDAD_ACRED'];
    $distrito_acreditado = utf8_decode($result['DISTRITO_DOMICILIO_ACRED']);
    $provincia_acreditado = utf8_decode($result['PROVINCIA_DOMICILIO_ACRED']);
    $departamento_acreditado = utf8_decode($result['DEPARTAMENTO_DOMICILIO_ACRED']);
    $parentesco = utf8_decode($result['PARENTESCO_ACRED']);
    $grado_parentesco = $result['GRADO_PARENTESCO'];
    $tipo_parentesco = $result['TIPO_PARENTESCO'];
    $telefono = $result['TELEFONO_ACRED'];
    $celular = $result['CELULAR_ACRED'];
    $correoElectronico = utf8_decode($result['CORREO_ACRED']); //No transformar a Mayuscula
    
    
    $nombrefallecido = utf8_decode($result['NOMBRES_FALLECIDO']);
    $DocumentoFallecido = $result['DOC_FALLECIDO'];
    $fichaAfiliacion = $result['CONTRATO_SIS_FALLECIDO'];
    $regimen_fallecido = $result['TIPO_SEGURO_FALLECIDO'];
    $edad_fallecido = $result['EDAD_FALLECIDO'];

    $dia_fallecido = substr($result['FECHA_FALLECIMIENTO'],8,2);
    $mes_fallecido = substr($result['FECHA_FALLECIMIENTO'],5,2);
    $anio_fallecido = substr($result['FECHA_FALLECIMIENTO'],0,4);
    $fechaFallecido = $dia_fallecido.' / '.$mes_fallecido.' / '.$anio_fallecido;
    $lugarFallecimiento = utf8_decode($result['LUGAR_FALLECIMIENTO']); //
    $distrito_fallecimiento = utf8_decode($result['DISTRITO_FALLECIMIENTO']);
    $provincia_fallecimiento = utf8_decode($result['PROVINCIA_FALLECIMIENTO']);
    $departamento_fallecimiento = utf8_decode($result['DEPARTAMENTO_FALLECIMIENTO']);
    
    $importe_sepelio = number_format($result['IMPORTE_BOLETA'],2);
    $comprobante_pago = utf8_decode($result['COMPROBANTE_PAGO']);

    
    class ConcatPdf extends Fpdi
    {
        public $files = array();
    
        public function setFiles($files)
        {
            $this->files = $files;
        }
    
        public function concat($lugar, $fecha, $ipressPublica,$acreditado, $documentoAcreditado,
        $domicilioAcreditado, $referenciaDomicilioAcreditado, $telefono, $celular, $correoElectronico,
        $nombrefallecido, $DocumentoFallecido, $fichaAfiliacion, $edad_fallecido, $fechaFallecido, $lugarFallecimiento, 
        $distrito_fallecimiento, $provincia_fallecimiento, $departamento_fallecimiento, $regimen_fallecido, $distrito_acreditado, 
        $provincia_acreditado, $edad_acreditado, $parentesco,$grado_parentesco, $tipo_parentesco, $dia_fallecido, $mes_fallecido,
        $anio_fallecido, $importe_sepelio, $comprobante_pago,$dia_presentacion, $mes_presentacion, $anio_presentacion, $departamento_acreditado,
        $nombre_ipress_abrev,$nombre_ipress_iniciales,$documento_digitador,$nombre_digitador
        )
        {
            foreach($this->files AS $file) {
                $pageCount = $this->setSourceFile($file);

                if($file == 'anexo1.pdf'){
                        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                        $pageId = $this->ImportPage($pageNo);
                        $s = $this->getTemplatesize($pageId);
                        $this->AddPage($s['orientation'], $s);
                        $this->useImportedPage($pageId);
                        $this->SetFont('Helvetica','',8);
                        $this->SetTextColor(0, 0, 0);

                        $this->SetXY(40, 45);
                        $this->Write(0, $lugar);

                        $this->SetXY(140, 45);
                        $this->Write(0, $fecha);

                        $this->SetXY(54, 52);
                        $this->Write(0, $ipressPublica);

                        $this->SetXY(48, 68);
                        $this->Write(0, $acreditado);

                        $this->SetXY(108, 78);
                        $this->Write(0, $documentoAcreditado);

                        $this->SetXY(63, 85);
                        $this->Write(0, $domicilioAcreditado);

                        $this->SetXY(65, 91);
                        $this->Write(0, $referenciaDomicilioAcreditado);

                        $this->SetXY(73, 100);
                        $this->Write(0, $telefono);

                        $this->SetXY(122, 100);
                        $this->Write(0, $celular);

                        $this->SetXY(60, 107); 
                        $this->Write(0, $correoElectronico);

                        $this->SetXY(68, 118);
                        $this->Write(0, $nombrefallecido); 

                        $this->SetXY(76, 124);
                        $this->Write(0, $DocumentoFallecido);

                        $this->SetXY(156, 124);
                        $this->Write(0, $fichaAfiliacion);

                        $this->SetXY(38, 130);
                        $this->Write(0, $edad_fallecido);

                        $this->SetXY(100, 130);
                        $this->Write(0, $fechaFallecido);

                        $this->SetXY(27, 139);
                        $this->Write(0, $lugarFallecimiento);

                        $this->SetXY(133, 139);
                        $this->Write(0, $distrito_fallecimiento);

                        $this->SetXY(48, 146);
                        $this->Write(0, $provincia_fallecimiento);

                        $this->SetXY(140, 146);
                        $this->Write(0, $departamento_fallecimiento);

                        $this->SetXY(106, 154);
                        $this->Write(0, $regimen_fallecido);

                        $this->SetXY(74, 267);
                        $this->Write(0, $acreditado);

                        $this->SetXY(93, 272);
                        $this->Write(0, $documentoAcreditado);

                    }
                }else if($file == 'anexo3.pdf'){
                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                        $pageId = $this->ImportPage($pageNo);
                        $s = $this->getTemplatesize($pageId);
                        $this->AddPage($s['orientation'], $s);
                        $this->useImportedPage($pageId);
                        $this->SetFont('Helvetica','',8);
                        $this->SetTextColor(0, 0, 0);
    
                        $this->SetXY(36, 54);
                        $this->Write(0, $acreditado);
    
                        $this->SetXY(90, 60);
                        $this->Write(0, $documentoAcreditado);
    
                        $this->SetXY(52, 68);
                        $this->Write(0, $domicilioAcreditado);
    
                        $this->SetXY(46, 75 );
                        $this->Write(0, $distrito_acreditado);
    
                        $this->SetXY(135, 75);
                        $this->Write(0, $provincia_acreditado);
    
                        $this->SetXY(56, 84);
                        $this->Write(0, $edad_acreditado);
    
                        $this->SetXY(33, 91);
                        $this->Write(0, $parentesco);
    
                        $this->SetXY(133, 91);
                        $this->Write(0, $grado_parentesco);
    
                        $this->SetXY(35, 98);
                        $this->Write(0, $tipo_parentesco);
    
                        $this->SetXY(102, 98);
                        $this->Write(0, $nombrefallecido);
                        
                        $this->SetXY(39, 105);
                        $this->Write(0, $edad_fallecido);
    
                        $this->SetXY(99, 105);
                        $this->Write(0, $dia_fallecido);
    
                        $this->SetXY(114, 105);
                        $this->Write(0, $mes_fallecido);
    
                        $this->SetXY(129, 105);
                        $this->Write(0, $anio_fallecido);
    
                        $this->SetXY(26, 111);
                        $this->Write(0, $lugarFallecimiento);
    
                        $this->SetXY(133, 112);
                        $this->Write(0, $distrito_fallecimiento);
    
                        $this->SetXY(46, 119);
                        $this->Write(0, $provincia_fallecimiento);
    
                        $this->SetXY(159, 119);
                        $this->Write(0, $departamento_fallecimiento);
    
                        $this->SetXY(84, 128);
                        $this->Write(0, $fichaAfiliacion);
    
                        $this->SetXY(30, 135);
                        $this->Write(0, $regimen_fallecido);
    
                        $this->SetXY(150, 142);
                        $this->Write(0, $importe_sepelio);
    
                        $this->SetXY(112, 149);
                        $this->Write(0, $comprobante_pago);
    
                        $this->SetXY(106, 180);
                        $this->Write(0, $dia_presentacion);
    
                        $this->SetXY(139, 180);
                        $this->Write(0, $mes_presentacion);
    
                        $this->SetXY(173, 180);
                        $this->Write(0, $anio_presentacion);
    
                        $this->SetXY(74, 231);
                        $this->Write(0, $acreditado);
    
                        $this->SetXY(92, 236);
                        $this->Write(0, $documentoAcreditado);
    
    
                    }
                }else if($file == 'anexo4.pdf'){
                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                        $pageId = $this->ImportPage($pageNo);
                        $s = $this->getTemplatesize($pageId);
                        $this->AddPage($s['orientation'], $s);
                        $this->useImportedPage($pageId);
                        $this->SetFont('Helvetica','',8);
                        $this->SetTextColor(0, 0, 0);
                        
                        $this->SetXY(33, 43);
                        $this->Write(0, $acreditado);
    
                        $this->SetXY(30, 50);
                        $this->Write(0, $documentoAcreditado);
    
                        $this->SetXY(78, 50);
                        $this->Write(0, $domicilioAcreditado);
    
                        $this->SetXY(107, 57);
                        $this->Write(0, $distrito_acreditado);
    
                        $this->SetXY(53, 63);
                        $this->Write(0, $provincia_acreditado);
    
                        $this->SetXY(148, 63);
                        $this->Write(0, $departamento_acreditado);
    
                        $this->SetXY(35, 70);
                        $this->Write(0, $edad_acreditado);
    
                        $this->SetXY(62, 78);
                        $this->Write(0, $importe_sepelio);
    
                        $this->SetXY(140, 78);
                        $this->Write(0, $comprobante_pago);
    
                        $this->SetXY(45, 85);
                        $this->Write(0, $nombrefallecido);
    
                        $this->SetXY(154, 85);
                        $this->Write(0, $edad_fallecido);
    
                        
                        $this->SetXY(53, 92);
                        $this->Write(0, $dia_fallecido);
    
                        $this->SetXY(63, 92);
                        $this->Write(0, $mes_fallecido);
    
                        $this->SetXY(72, 92);
                        $this->Write(0, $anio_fallecido);
    
                        $this->SetXY(95, 92);
                        $this->Write(0, $lugarFallecimiento);
    
                        $this->SetXY(41, 99);  
                        $this->Write(0, $distrito_fallecimiento);
    
                        $this->SetXY(128, 99);  
                        $this->Write(0, $provincia_fallecimiento);
    
                        $this->SetXY(52, 106);  
                        $this->Write(0, $departamento_fallecimiento);
    
                        $this->SetXY(142, 106);  
                        $this->Write(0, $fichaAfiliacion);
    
                        $this->SetXY(100, 113);  
                        $this->Write(0, $regimen_fallecido);

    
                        $this->SetXY(101, 142);  
                        $this->Write(0, $dia_presentacion);
    
                        $this->SetXY(136, 142);  
                        $this->Write(0, $mes_presentacion);
    
                        $this->SetXY(174, 142);  
                        $this->Write(0, $anio_presentacion);
    
                        $this->SetXY(74, 195);  
                        $this->Write(0, $acreditado);
    
                        $this->SetXY(92, 200);  
                        $this->Write(0, $documentoAcreditado);
    
                    }
    
                }else if($file == 'solicitud_pes.pdf'){
                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                        $pageId = $this->ImportPage($pageNo);
                        $s = $this->getTemplatesize($pageId);
                        $this->AddPage($s['orientation'], $s);
                        $this->useImportedPage($pageId);
                        $this->SetFont('Helvetica','',8);
                        $this->SetTextColor(0, 0, 0);

                        $this->SetXY(27, 31);
                        $this->SetFont('Helvetica','',9);
                        $this->Write(0, $lugar);

                        $this->SetXY(82, 31);  
                        $this->Write(0, $dia_presentacion);
    
                        $this->SetXY(99, 31);  
                        $this->Write(0, $mes_presentacion);
    
                        $this->SetXY(137, 31);  
                        $this->Write(0, $anio_presentacion);

                        
                        $this->SetXY(85, 148);
                        $this->SetFont('Helvetica','B',9);
                        $this->Write(0, $nombre_ipress_abrev);


                        $this->SetXY(27, 142);
                        $this->SetFont('Helvetica','B',8);
                        $this->Write(0, $nombrefallecido);

                        $this->SetXY(88, 222);
                        $this->SetFont('Helvetica','',8);
                        $this->Write(0, $documento_digitador);

                        $this->SetXY(80, 215);
                        $this->SetFont('Helvetica','',8);
                        $this->Write(0, $nombre_digitador);


                        $this->SetXY(160, 142);
                        $this->SetFont('Helvetica','B',9);   
                        $this->Write(0, $DocumentoFallecido);


                        $this->SetXY(92, 44);
                        $this->SetFont('Helvetica','B',10);   
                        $this->Write(0, $nombre_ipress_iniciales);

                        $this->SetXY(65, 44);  
                        $this->Write(0, $anio_presentacion);



                       
                    }
                }
    
            }
        }
    }
    
    $pdf = new ConcatPdf();
    if($parentesco == 'NINGUNO'){
        $pdf->setFiles(array('solicitud_pes.pdf','anexo1.pdf', 'anexo4.pdf'));
    }else{
       $pdf->setFiles(array('solicitud_pes.pdf','anexo1.pdf', 'anexo3.pdf',));
    }
    
    $pdf->concat($lugar, $fecha, $ipressPublica,$acreditado, $documentoAcreditado,
    $domicilioAcreditado, $referenciaDomicilioAcreditado, $telefono, $celular, $correoElectronico,
    $nombrefallecido, $DocumentoFallecido, $fichaAfiliacion, $edad_fallecido, $fechaFallecido, $lugarFallecimiento, 
    $distrito_fallecimiento, $provincia_fallecimiento, $departamento_fallecimiento, $regimen_fallecido, $distrito_acreditado,
    $provincia_acreditado, $edad_acreditado, $parentesco, $grado_parentesco, $tipo_parentesco, $dia_fallecido, $mes_fallecido,
    $anio_fallecido,$importe_sepelio, $comprobante_pago, $dia_presentacion, $mes_presentacion, $anio_presentacion, $departamento_acreditado,
    $nombre_ipress_abrev,$nombre_ipress_iniciales,$documento_digitador,$nombre_digitador);

    $pdf->Output();
    ob_end_flush(); 

}

?>