<?php

class UsuariosControlador{

    static public function MostrarUsuario($tabla,$item,$valor){

        $resultado = UsuariosModelo::MostrarUsuario($tabla,$item,$valor);
    
        return $resultado;

    }

    static public function IngresarUsuario($usuario, $password){

                $tabla = "users";
                $item = "documento";
                $valor = $usuario;

                $resultado = UsuariosModelo::MostrarUsuario($tabla,$item,$valor);
    
    
                if(is_array($resultado) && $resultado["documento"] == $usuario && $resultado["password"] == $password){
    
                    if($resultado["estado"]== "1"){
                        
                        $_SESSION["Sesion"] = "ok";
                        $_SESSION["id"] = $resultado["id_user"];
                        $_SESSION["nombres"] = $resultado["nombres"];
                        $_SESSION["apellidos"] = $resultado["apellidos"];
                        $_SESSION["documento"] = $resultado["documento"];
                        $_SESSION["tipo_usuario"] = $resultado["tipo_usuario"];
                        $_SESSION["establecimiento"] = $resultado["establecimiento"];

                        return "correcto";

                    }else{
                        return "desactivado"; 
                    }
    
    
                }else{
    
                    return "incorrecto";
                }
            }



    
    static public function EditarEstado($valor1,$valor2){

        $resultado = UsuariosModelo::EditarEstado($valor1, $valor2);
        return $resultado;
    }

    static public function EliminarUsuario($id){
        $resultado = UsuariosModelo::EliminarUsuario($id);
        return $resultado;
    }

    
    static public function GuardarUsuario($datos){

            $tabla = "users";
            $item = "documento";
            $valor = $datos["usuario"];

            $comparar = UsuariosModelo::MostrarUsuario($tabla, $item, $valor);
    
            if(is_array($comparar)){
                return "duplicado";
            }else{
                $insertar = UsuariosModelo::GuardarUsuario($tabla,$datos);
                return $insertar;
            }
    }




    static public function EditarUsuario($datos){
        $resultado = UsuariosModelo::EditarUsuario($datos);
        return $resultado;
    }
    
    static public function UsuariosEspecificos($tipo){
        $resultado = UsuariosModelo::UsuariosEspecificos($tipo);
        return $resultado;
    }


    static public function mostrarTipoUsuarioActivo($opcion,$tipo_usuario){
        $resultado = UsuariosModelo::mostrarTipoUsuarioActivo($opcion,$tipo_usuario);
        return $resultado;

    }

}

?>