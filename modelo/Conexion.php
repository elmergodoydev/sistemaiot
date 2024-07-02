<?php

class Conexion {

    static public function conectar() {
         $host = "209.45.91.30";
         $username = "root";
         $password = "seguros2021";
         $dbname = "sensor_db";

        // $host = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "sensor_db";

        try {
            $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // Establecer el modo de error PDO para lanzar excepciones
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            // Capturar cualquier excepción de PDO y mostrar un mensaje de error
            die("¡Error de conexión!: " . $e->getMessage());
        }
    }

}
?>