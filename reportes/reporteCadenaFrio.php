<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

\PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder());

$datos = explode(',', $_GET['datos']);

$fechaInicio = $datos[0];
$fechaFin = $datos[1];
$ipress = $datos[2];

 $host = "209.45.91.30";
 $username = "root";
 $password = "seguros2021";
 $dbname = "sensor_db";

// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "sensor_db";

$con = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);

$sql = $con->query("SELECT a.controlador, b.nombre_ipress,a.temperatura,a.humedad,a.fecha_registro FROM dht22 a 
inner join establecimientos b on a.controlador = b.id_ipress
WHERE (temperatura >-5 and temperatura < 100) and (humedad > 0 and humedad < 150)
AND (fecha_registro >= '$fechaInicio 00:00:00' AND fecha_registro <= '$fechaFin 23:59:59')
AND controlador like '%$ipress' 
order BY fecha_registro DESC;");


$resultado = $sql->fetchAll();
$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("reporte_cadena_frio");

$hojaActiva->getColumnDimension('A')->setWidth(15);
$hojaActiva->setCellValue('A1', 'Controlador');
$hojaActiva->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('83D2FC');

$hojaActiva->getColumnDimension('B')->setWidth(25);
$hojaActiva->setCellValue('B1', 'Establecimiento');
$hojaActiva->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('83D2FC');

$hojaActiva->getColumnDimension('C')->setWidth(20);
$hojaActiva->setCellValue('C1', 'Temperatura (C°)');
$hojaActiva->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('83D2FC');

$hojaActiva->getColumnDimension('D')->setWidth(20);
$hojaActiva->setCellValue('D1', 'Humedad (%)');
$hojaActiva->getStyle('D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('83D2FC');

$hojaActiva->getColumnDimension('E')->setWidth(20);
$hojaActiva->setCellValue('E1', 'Fecha_Registro');
$hojaActiva->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('83D2FC');

$hojaActiva->getColumnDimension('F')->setWidth(35);
$hojaActiva->setCellValue('F1', 'Evaluacion');
$hojaActiva->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('83D2FC');


$fila = 2;

foreach($resultado as $row => $item){


    $hojaActiva->setCellValue('A'. $fila, $item['controlador']);
    $hojaActiva->getStyle('A'. $fila)->getAlignment()->setHorizontal('center');
    $hojaActiva->setCellValue('B'. $fila, $item['nombre_ipress']);

    $temperatura = intval($item['temperatura']);

    if($temperatura > 8 || $temperatura < 2){
        $hojaActiva->setCellValue('C'. $fila, $item['temperatura']);
        $hojaActiva->getStyle('C'.$fila)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FC9997');
    }else{
        $hojaActiva->setCellValue('C'. $fila, $item['temperatura']);
        $hojaActiva->getStyle('C'.$fila)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('60F099');
    }
    


    $hojaActiva->getStyle('C'. $fila)->getAlignment()->setHorizontal('center');
    $hojaActiva->setCellValue('D'. $fila, $item['humedad']);
    $hojaActiva->getStyle('D'. $fila)->getAlignment()->setHorizontal('center');
    $hojaActiva->setCellValue('E'. $fila, $item['fecha_registro']);
    $hojaActiva->getStyle('E'. $fila)->getAlignment()->setHorizontal('center');
    $hojaActiva->getStyle('E'. $fila)->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME);

    if($temperatura > 8 || $temperatura < 2){
        $hojaActiva->setCellValue('F'. $fila, "Ruptura de cadena de frio : verificar");
        $hojaActiva->getStyle('F'.$fila)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FC9997');
    }else{
        $hojaActiva->setCellValue('F'. $fila, "Rangos normales de Temperatura");
        $hojaActiva->getStyle('F'.$fila)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('60F099');
    }

    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte_cadena_frio.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;

?>
