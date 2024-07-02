
<?php

require_once "Conexion.php";

class DatosModelo{

    static public function MostrarDatos($valor,$controlador){

        if($valor == 'ultimo_registro'){
            
            $stmt = Conexion::conectar()->prepare("SELECT * FROM dht22 
                                                WHERE (temperatura >-5 and temperatura < 100) and
                                                (humedad > 0 and humedad < 150) and controlador = $controlador
                                                order BY fecha_registro DESC
                                                LIMIT 1;");
            $stmt ->execute();
            return $stmt->fetch();
            $stmt = null;
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM `dht22` 
                                                WHERE (temperatura >-5 and temperatura < 100) and
                                                (humedad > 0 and humedad < 150) and controlador = $controlador
                                                order BY fecha_registro DESC;");
            $stmt ->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }


    static public function MostrarDatosLive($tipoDato,$controlador){

        if($tipoDato == 'ultimo_dato_live'){
            
            $stmt = Conexion::conectar()->prepare("SELECT UNIX_TIMESTAMP(fecha_registro) AS 'fecha',temperatura FROM dht22 
                                                   WHERE (temperatura >-5 and temperatura < 100) and
                                                   (humedad > 0 and humedad < 150) and controlador = $controlador
                                                   order BY fecha_registro DESC
                                                   LIMIT 1;");
            $stmt ->execute();
            return $stmt->fetch();
            $stmt = null;

        }else if($tipoDato == "datos_carga_inicial"){
            $stmt = Conexion::conectar()->prepare("SELECT UNIX_TIMESTAMP(fecha_registro) AS 'fecha',temperatura FROM dht22 
                                                WHERE (temperatura >-5 and temperatura < 100) and
                                                (humedad > 0 and humedad < 150) and controlador = $controlador
                                                order BY fecha_registro DESC
                                                LIMIT 20;");
            $stmt ->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }


    static public function MostrarDatosArea($tipoDato,$controlador,$fechaInicio,$fechaFinal){

        if($tipoDato == "graficoAreaFechas" ){

            $stmt = Conexion::conectar()->prepare("SELECT (UNIX_TIMESTAMP(DATE(fecha_registro))*1000) AS 'Fecha', MIN(temperatura) as Tmin, MAX(temperatura) AS Tmax FROM dht22
                                                WHERE (temperatura >-5 and temperatura < 100)
                                                AND (humedad > 0 and humedad < 150)
                                                AND (fecha_registro >= '$fechaInicio 00:00:00' AND fecha_registro <= '$fechaFinal 23:59:59')
                                                AND controlador like '%$controlador' 
                                                GROUP by (UNIX_TIMESTAMP(DATE(fecha_registro))*1000)
                                                order by 1 DESC
                                                ");

            $stmt ->execute();
            return $stmt->fetchAll();
            $stmt = null;


        }


    }

    static public function MostrarDatosRupturasDia($fechaInicio,$fechaFinal){
            $stmt = Conexion::conectar()->prepare("SELECT DATE(fecha_registro) AS 'fecha',
            MAX(case when (temperatura < 2 or temperatura > 8) and controlador = 1 then 1 else 0 end) as 'ricardo_palma',
            MAX(case when (temperatura < 2 or temperatura > 8) and controlador = 2 then 1 else 0 end) as 'santa_eulalia',
            MAX(case when (temperatura < 2 or temperatura > 8) and controlador = 3 then 1 else 0 end) as 'buenos_aires',
            MAX(case when (temperatura < 2 or temperatura > 8) and controlador = 4 then 1 else 0 end) as 'huayaringa_alta',
            MAX(case when (temperatura < 2 or temperatura > 8) and controlador = 5 then 1 else 0 end) as 'cocachacra',
            MAX(case when (temperatura < 2 or temperatura > 8) and controlador = 6 then 1 else 0 end) as 'sagrado_corazon'
            FROM `dht22`
            WHERE (fecha_registro >= '$fechaInicio 00:00:00' AND fecha_registro <= '$fechaFinal 23:59:59')
            group by DATE(fecha_registro)
            order by fecha ASC
            ");
            $stmt ->execute();
            return $stmt->fetchAll();
            $stmt = null;

    }


    static public function MostrarDatosRupturasDiaEess($fechaInicio,$fechaFinal){
        $stmt = Conexion::conectar()->prepare("SELECT b.nombre_ipress, COUNT(*) as 'cantidad'
                                            FROM (
                                                SELECT DISTINCT DATE(fecha_registro) as fecha, a.controlador
                                                FROM `dht22` a 
                                                WHERE temperatura < 2 OR temperatura > 8
                                                AND fecha_registro >= '$fechaInicio 00:00:00'
                                                AND fecha_registro <= '$fechaFinal 23:59:59'
                                            ) AS registros
                                            INNER JOIN `establecimientos` b ON registros.controlador = b.id_ipress
                                            GROUP BY b.nombre_ipress
                                            ");
        $stmt ->execute();
        return $stmt->fetchAll();
        $stmt = null;

}

static public function IndicadorEessConRCF($fechaInicio,$fechaFinal){
    $stmt = Conexion::conectar()->prepare("SELECT fecha,
                                            6 AS 'eess_evaluados',
                                            COUNT(DISTINCT controlador) AS eess,
                                            ROUND((COUNT(DISTINCT controlador) / 6) * 100, 2) AS porcentaje
                                        FROM (
                                            SELECT DATE(fecha_registro) AS fecha,
                                                controlador
                                            FROM dht22
                                            WHERE (fecha_registro >= '$fechaInicio 00:00:00' AND fecha_registro <= '$fechaFinal 23:59:59')
                                            AND (temperatura < 2 OR temperatura > 8)
                                            GROUP BY DATE(fecha_registro), controlador
                                        ) AS subquery
                                        GROUP BY fecha
                                        ORDER BY fecha ASC;
                                        ");
    $stmt ->execute();
    return $stmt->fetchAll();
    $stmt = null;

}


static public function indicadorRangosHora($fecha, $controlador) {
    try {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("CALL sp_rangos_temperatura_horas(:fecha, :controlador)");
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':controlador', $controlador, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    } catch (PDOException $e) {
        // Capturar y mostrar el mensaje de error completo
        die("Error al ejecutar el procedimiento almacenado: " . $e->getMessage() . " " . $e->getTraceAsString());
    }
}


}


?>