<?php

session_start();

require_once "../controlador/UsuariosControlador.php";
require_once "../modelo/UsuariosModelo.php";


class UsuariosAjax{


    public $activarUsuario;
    public $activarId;
    public $tipo;

     public function ActivarUsuario(){

        $valor1 = $this->activarUsuario;
        $valor2 = $this->activarId;
        $respuesta = UsuariosControlador::EditarEstado($valor1,$valor2);

     }

    public function MostrarUsuario(){

        $tabla = "users";
        $item = "id_user";
        $valor = $this->id;

        $resultado = UsuariosControlador::MostrarUsuario($tabla,$item,$valor);
        echo json_encode($resultado);

    }

    public $id = null;

    public function EliminarUsuario(){

        $id = $this->id;
        $resultado = UsuariosControlador::EliminarUsuario($id);
        echo json_encode($resultado);
    }

    public $documento;
    public $establecimiento;
    public $nombre;
    public $apellido;
    public $usuario;
    public $password;
    public $rol;
    public $estado;

    public function GuardarUsuario(){

        $datos = array("nombres" => $this->nombre,
                        "apellidos" => $this->apellido,
                        "usuario" => $this->usuario,
                        "password" => $this->password,
                        "estado" => $this->estado,
                        "tipo_usuario" => $this->rol,
                        "eess" => $this->establecimiento);

        $resultado = UsuariosControlador::GuardarUsuario($datos);
        
        echo json_encode($resultado);
                
    }

    public function EditarUsuario(){

        $datos = array("nombre" => $this->nombre,
                        "apellido" => $this->apellido,
                        "usuario" => $this->usuario,
                        "password" => $this->password,
                        "tipo_usuario" => $this->rol,
                        "id" => $this->id,
                        "eess" => $this->establecimiento);

        $resultado = UsuariosControlador::EditarUsuario($datos);

        echo json_encode($resultado);

    }

    public function Login(){

        $usuario = $this->usuario;
        $password = $this->password;
        $resultado = UsuariosControlador::IngresarUsuario($usuario, $password);
        echo json_encode($resultado);
    }

    public function UsuariosEspecificos(){
        $tipo = $this->tipo;
        $resultado = UsuariosControlador::UsuariosEspecificos($tipo);
        echo json_encode($resultado);
    }

    public $tipo_usuario;

    public function MostrarTipoUsuarioActivo(){

        $opcion = "mostrar_tipo_usuario_activo";
        $tipo_usuario = $this->tipo_usuario;

        $resultado = UsuariosControlador::MostrarTipoUsuarioActivo($opcion, $tipo_usuario);
        echo json_encode($resultado);

    }



}

 /*ACTIVAR USUARIOS */

 if(isset($_POST["activarId"])){

    $activarUsuario = new UsuariosAjax();
    $activarUsuario -> activarUsuario = $_POST["activarUsuario"];
    $activarUsuario -> activarId = $_POST["activarId"];
    $activarUsuario -> ActivarUsuario();

}else if(isset($_POST['tipo']) && $_POST['tipo'] =='eliminar'){

    $resultado = new UsuariosAjax;
    $resultado->id = $_POST['id'];
    $resultado->EliminarUsuario();

}else if(isset($_POST['tipo']) && $_POST['tipo'] == 'crear'){
    $resultado = new UsuariosAjax;
    $resultado->establecimiento = $_POST['establecimiento'];
    $resultado->nombre = $_POST['nombre'];
    $resultado->apellido = $_POST['apellido'];
    $resultado->usuario = $_POST['usuario'];
    $resultado->password = $_POST['password'];
    $resultado->rol = $_POST['rol'];
    $resultado->estado = $_POST['estado'];
    $resultado->GuardarUsuario();

}else if(isset($_POST['tipo']) && $_POST['tipo'] == 'editar'){
    $resultado = new UsuariosAjax;
    $resultado->establecimiento = $_POST['establecimiento'];
    $resultado->nombre = $_POST['nombre'];
    $resultado->apellido = $_POST['apellido'];
    $resultado->usuario = $_POST['usuario'];
    $resultado->password = $_POST['password'];
    $resultado->rol = $_POST['rol'];
    $resultado->id = $_POST['id'];
    $resultado->EditarUsuario();

}else if(isset($_POST['tipo']) && $_POST['tipo'] == 'mostrar'){

    $usuarios = new UsuariosAjax;
    $usuarios->id = $_POST['id'];
    $usuarios->MostrarUsuario();

}else if(isset($_POST['tipo']) && $_POST['tipo'] == 'login'){

    $usuarios = new UsuariosAjax;
    $usuarios->usuario = $_POST['usuario'];
    $usuarios->password = $_POST['password'];
    $usuarios->Login();

}else if(isset($_POST['tipo']) && $_POST['tipo'] == 'digitadores'){

    $usuarios = new UsuariosAjax;
    $usuarios->tipo = $_POST['tipo'];
    $usuarios->UsuariosEspecificos();

}else if(isset($_POST['tipo']) && $_POST['tipo'] == 'mostrar_tipo_usuario_activo'){

    $usuarios = new UsuariosAjax;
    $usuarios->tipo_usuario = $_POST['tipo_usuario'];
    $usuarios->MostrarTipoUsuarioActivo();

}else{

 $usuarios = new UsuariosAjax;
 $usuarios->MostrarUsuario();

}






?>