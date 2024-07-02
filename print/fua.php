
<?php

use setasign\Fpdi\Fpdi;

require_once('fpdf/fpdf.php');
require_once('fpdi2/src/autoload.php');

/*
// initiate FPDI
$pdf = new Fpdi();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile('fua.pdf');
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, 0, 0, 210);

//creando numeracion
$renipress = '00005790';
$lote = 22;    
$numeracion = '00033001'; 

// now write some text above the imported page
$pdf->SetFont('Helvetica','',15);
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(63, 26);
$pdf->Write(0, $renipress);
$pdf->SetXY(101, 26);
$pdf->Write(0, $lote);
$pdf->SetXY(120, 26);
$pdf->Write(0, $numeracion);

$pdf->SetXY(20, 43);
$pdf->Write(0, $renipress);

///////////////////////////////////REVERSO

$pdf->Output('I', 'generated.pdf');
*/

    $datos = explode(',', $_GET['datos']);

    $cantidad = $datos[0];
    $nroInicial = $datos[1];
    $renipressGet = $datos[2];
    $loteGet = $datos[3];


class ConcatPdf extends Fpdi
{
    public $files = array();

    public function setFiles($files)
    {
        $this->files = $files;
    }

    public function concat($renipress, $lote, $numeracionInicial)

    {
        foreach($this->files AS $file) {

            $pageCount = $this->setSourceFile($file);

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

                if (($pageNo % 2) == 0) {

                    if(strlen($numeracionInicial) == 1){
                        $ceros = '0000000';
                    }elseif(strlen($numeracionInicial) == 2){
                        $ceros = '000000';
                    }elseif(strlen($numeracionInicial) == 3){
                        $ceros = '00000';
                    }elseif(strlen($numeracionInicial) == 4){
                        $ceros = '0000';
                    }elseif(strlen($numeracionInicial) == 5){
                        $ceros = '000';
                    }elseif(strlen($numeracionInicial) == 6){
                        $ceros = '00';
                    }elseif(strlen($numeracionInicial) == 7){
                        $ceros = '0';
                    }elseif(strlen($numeracionInicial) == 8){
                        $ceros = '';
                    }

                    $pageId = $this->ImportPage($pageNo);     
                    $s = $this->getTemplatesize($pageId);
                    $this->AddPage($s['orientation'], $s);
                    $this->useImportedPage($pageId);

                    $this->SetFont('Helvetica','',15);
                    $this->SetTextColor(255, 0, 0);
                    $this->SetXY(107, 13);
                    $this->Write(0, $renipress);
                    $this->SetXY(147, 13);
                    $this->Write(0, $lote);
                    $this->SetXY(166, 13);
                    $this->Write(0, $ceros.$numeracionInicial);

                    $numeracionInicial = $numeracionInicial + 1;

                } else {

                    if(strlen($numeracionInicial) == 1){
                        $ceros = '0000000';
                    }elseif(strlen($numeracionInicial) == 2){
                        $ceros = '000000';
                    }elseif(strlen($numeracionInicial) == 3){
                        $ceros = '00000';
                    }elseif(strlen($numeracionInicial) == 4){
                        $ceros = '0000';
                    }elseif(strlen($numeracionInicial) == 5){
                        $ceros = '000';
                    }elseif(strlen($numeracionInicial) == 6){
                        $ceros = '00';
                    }elseif(strlen($numeracionInicial) == 7){
                        $ceros = '0';
                    }elseif(strlen($numeracionInicial) == 8){
                        $ceros = '';
                    }


                    $pageId = $this->ImportPage($pageNo);     
                    $s = $this->getTemplatesize($pageId);
                    $this->AddPage($s['orientation'], $s);
                    $this->useImportedPage($pageId);
    
                    $this->SetFont('Helvetica','',15);
                    $this->SetTextColor(255, 0, 0);
                    $this->SetXY(62, 26);
                    $this->Write(0, $renipress);
                    $this->SetXY(101, 26);
                    $this->Write(0, $lote);
                    $this->SetXY(119, 26);
                    $this->Write(0, $ceros.$numeracionInicial);
                }

            }
        }
    }
}

$pdf = new ConcatPdf();

$cantidad_imprimir = $cantidad;
$modelo_fua = array();

for($paginaInicio = 1; $paginaInicio <= $cantidad_imprimir; $paginaInicio++){
    $ruta_modelo_fua = 'fua.pdf';
    array_push($modelo_fua,$ruta_modelo_fua);
}


$pdf->setFiles($modelo_fua);

//datos numeracion
$renipress = $renipressGet;
$lote = $loteGet;    
$numeracionInicial = $nroInicial; 

$pdf->concat($renipress, $lote, $numeracionInicial);

$pdf->Output('I', 'Fua-Impresa.pdf');


?>