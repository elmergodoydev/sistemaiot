
<?php

require_once "Conexion.php";

class RolesModelo{

    static public function MostrarRoles($tabla,$item,$valor){

        if($valor != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = ?");
            $stmt->bindParam(1,$valor);
            $stmt ->execute();
            return $stmt->fetch();
            $stmt = null;
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt ->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }



    static public function GuardarRol($rol){

        $stmt = Conexion::conectar()->prepare("INSERT INTO roles (descripcion) VALUES (?)");
        $stmt->bindParam(1,$rol);

        if($stmt->execute()){
            return "ok";
        }

        $stmt = null;
    }


    static public function EliminarRol($id){
        $stmt = Conexion::conectar()->prepare("DELETE FROM roles WHERE id_roles = ?");
        $stmt->bindParam(1,$id);

        if($stmt->execute()){
            return "ok";
        }

        $stmt = null;
    }

    static public function ActualizarRol($rol,$id){
        $stmt = Conexion::conectar()->prepare("UPDATE roles SET descripcion = ? WHERE id_roles = ?");
        $stmt->bindParam(1,$rol);
        $stmt->bindParam(2,$id);

        if($stmt->execute()){
            return "ok";
        }

        $stmt = null;
    }


    static public function MostrarModulosRol($rol){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM rol_modulo WHERE rol = '$rol'");
        $stmt ->execute();
        return $stmt->fetchAll();
        $stmt = null;

    }

    static public function RelacionarModulosRol($rol){

        $stmt = Conexion::conectar()->prepare("INSERT INTO rol_modulo (rol, modulo, opcion, estado)
                                              SELECT '$rol',modulo, opcion , 0 FROM modulos ORDER BY modulo asc");
        if($stmt->execute()){
            return "ok";
        }
        $stmt = null;

    }

    static public function EliminarModulosRol($rol){

        $stmt = Conexion::conectar()->prepare("DELETE FROM rol_modulo WHERE rol = '$rol' ");

        if($stmt->execute()){
            return "ok";
        }
        $stmt = null;
    }

    static public function ActualizarModulosRol($rol_anterior, $rol_actual){

        $stmt = Conexion::conectar()->prepare("UPDATE rol_modulo SET rol = '$rol_actual'
                                              WHERE rol = '$rol_anterior' ");
        if($stmt->execute()){
            return "ok";
        }
        $stmt = null;
    }


    static public function ActualizarEstadoModulosRol($estado_actual, $opcion, $rol){

        $stmt = Conexion::conectar()->prepare("UPDATE rol_modulo SET estado = $estado_actual
        WHERE opcion = '$opcion' AND rol = '$rol'");
       
       if($stmt->execute()){
        return "ok";
        }
        $stmt = null;

    }


    static public function MostrarPaginasRol($rol){

        $stmt = Conexion::conectar()->prepare("SELECT b.rol, a.modulo, a.opcion, a.pagina, b.estado
        FROM modulos_pagina a INNER JOIN rol_modulo b ON a.opcion = b.opcion WHERE b.rol = '$rol' AND estado = 1");
       
        $stmt ->execute();
        return $stmt->fetchAll();
        $stmt = null;

    }





}




?>