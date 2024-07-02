
<?php

require_once "Conexion.php";

class UsuariosModelo{

    static public function MostrarUsuario($tabla,$item,$valor){
        
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


    static public function UsuariosEspecificos($tipo){

        if($tipo == 'digitadores'){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM CAT_USUARIO WHERE TIPO_USUARIO = 'Digitador'");
            $stmt ->execute();
            return $stmt->fetchAll();
            $stmt = null;
        }
    }


    static public function EditarEstado($valor1,$valor2){

        $stmt = Conexion::conectar()->prepare("UPDATE users SET estado = ? WHERE id_user = ?");
        
            $stmt->bindParam(1,$valor1);
            $stmt->bindParam(2,$valor2);
            $stmt->execute();     
            $stmt = null;
        
        }

    static public function EliminarUsuario($id){
        $stmt = Conexion::conectar()->prepare("DELETE FROM users WHERE id_user = ?");
        $stmt->bindParam(1,$id);

        if($stmt->execute()){
            return "ok";
        }

        $stmt = null;
    }


        static public function GuardarUsuario($tabla,$datos){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombres, apellidos, documento, password, tipo_usuario, estado, establecimiento) VALUES (?,?,?,?,?,?,?)");
            $stmt->bindParam(1,$datos["nombres"]);
            $stmt->bindParam(2,$datos["apellidos"]);
            $stmt->bindParam(3,$datos["usuario"]);
            $stmt->bindParam(4,$datos["password"]);
            $stmt->bindParam(5,$datos["tipo_usuario"]);
            $stmt->bindParam(6,$datos["estado"]);
            $stmt->bindParam(7,$datos["eess"]);
        
            if($stmt->execute()){
                return "ok";
            }else{
                return "error";
            }
            
            $stmt = null;
        
        }

        static public function EditarUsuario($datos){

            $stmt = Conexion::conectar()->prepare("UPDATE users SET nombres = ?, apellidos = ?, password = ?, tipo_usuario = ?, documento = ?, establecimiento = ? WHERE id_user = ?");
                $stmt->bindParam(1,$datos["nombre"]);
                $stmt->bindParam(2,$datos["apellido"]);
                $stmt->bindParam(3,$datos["password"]);
                $stmt->bindParam(4,$datos["tipo_usuario"]);
                $stmt->bindParam(5,$datos["usuario"]);
                $stmt->bindParam(6,$datos["eess"]);
                $stmt->bindParam(7,$datos["id"]);
            
                if($stmt->execute()){
                    return "ok";
                }else{
                    return "error";
                }

                $stmt = null;
            
            }
        
        static public function mostrarTipoUsuarioActivo($opcion,$tipo_usuario){

            if($opcion == 'mostrar_tipo_usuario_activo'){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM CAT_USUARIO
                                                    WHERE TIPO_USUARIO = ?
                                                    AND ESTADO = 1");

                $stmt->bindParam(1,$tipo_usuario);
                $stmt ->execute();
                return $stmt->fetchAll();
                $stmt = null;
            }

        }



}

?>