<?php

require_once "../modelo/DatosModelo.php";

class DatosAjax {

    public $controlador;
    public $tipoDato;
    public $fechaInicio;
    public $fechaFin;
    public $fecha;

    public function MostrarDatos(){
        $valor = "ultimo_registro";
        $controlador = $this->controlador;
        $resultado = DatosModelo::MostrarDatos($valor,$controlador);
        echo json_encode($resultado);
    }

    public function MostrarDatosLive(){
        $tipoDato = $this->tipoDato;
        $controlador = $this->controlador;
        $resultado = DatosModelo::MostrarDatosLive($tipoDato,$controlador);
        echo json_encode($resultado);
    }

    
    public function MostrarGraficoArea(){
        $tipoDato = $this->tipoDato;
        $controlador = $this->controlador;
        $fechaInicio = $this->fechaInicio;
        $fechaFin = $this->fechaFin;

        $resultado = DatosModelo::MostrarDatosArea($tipoDato, $controlador,$fechaInicio, $fechaFin);
        echo json_encode($resultado);

    }

    public function MostrarDatosRupturasDia(){
        $fechaInicio = $this->fechaInicio;
        $fechaFin = $this->fechaFin;
        $resultado = DatosModelo::MostrarDatosRupturasDia($fechaInicio, $fechaFin);
        echo json_encode($resultado);

    }

    public function MostrarDatosRupturasDiaEess(){
        $fechaInicio = $this->fechaInicio;
        $fechaFin = $this->fechaFin;
        $resultado = DatosModelo::MostrarDatosRupturasDiaEess($fechaInicio, $fechaFin);
        echo json_encode($resultado);

    }

    public function IndicadorEessConRCF(){
        $fechaInicio = $this->fechaInicio;
        $fechaFin = $this->fechaFin;
        $resultado = DatosModelo::IndicadorEessConRCF($fechaInicio, $fechaFin);
        echo json_encode($resultado);

    }

    public function IndicadorHora(){
        $fecha = $this->fecha;
        $controlador = $this->controlador;
        $resultado = DatosModelo::indicadorRangosHora($fecha, $controlador);
        echo json_encode($resultado);

    }

}


    if(isset($_POST['tipoDato']) && $_POST['tipoDato'] == "indicadorHora"){
        $resultado = new DatosAjax;
        $resultado->fecha = $_POST["fecha"];
        $resultado->controlador = $_POST["controlador"];
        $resultado->IndicadorHora();

    }else if(isset($_POST["grafico"]) && $_POST["grafico"] == "gauge"){
        $resultado = new DatosAjax;
        $resultado->controlador = $_POST["controlador"];
        $resultado->MostrarDatos();

    }else if(isset($_POST["controlador"]) && isset($_POST["tipoDato"])){
        $resultado = new DatosAjax;
        $resultado->controlador = $_POST["controlador"];
        $resultado->tipoDato = $_POST["tipoDato"];
        $resultado->MostrarDatosLive();

    }else if(isset($_POST['tipoDato']) && $_POST['tipoDato'] == "rupturaPorDia"){
        $resultado = new DatosAjax;
        $resultado->fechaInicio = $_POST["fechaInicio"];
        $resultado->fechaFin = $_POST["fechaFin"];
        $resultado->MostrarDatosRupturasDia();

    }else if(isset($_POST['tipoDato']) && $_POST['tipoDato'] == "rupturaPorDiaEess"){
        $resultado = new DatosAjax;
        $resultado->fechaInicio = $_POST["fechaInicio"];
        $resultado->fechaFin = $_POST["fechaFin"];
        $resultado->MostrarDatosRupturasDiaEess();

    }else if(isset($_POST['tipoDato']) && $_POST['tipoDato'] == "indicadorRCF"){
        $resultado = new DatosAjax;
        $resultado->fechaInicio = $_POST["fechaInicio"];
        $resultado->fechaFin = $_POST["fechaFin"];
        $resultado->IndicadorEessConRCF();

    }else if($_POST["grafico"] == "areas"){
        $resultado = new DatosAjax;
        $resultado->controlador = $_POST["controlador"];
        $resultado->tipoDato = $_POST["tipoDeDato"];
        $resultado->fechaInicio = $_POST["fechaInicio"];
        $resultado->fechaFin = $_POST["fechaFin"];
        $resultado->MostrarGraficoArea();

    }
?>