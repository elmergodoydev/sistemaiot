
<?php

require_once "../controlador/RolesControlador.php";
require_once "../modelo/RolesModelo.php";


class RolesAjax{


    public $estado;
    public $opcion;


    public $valor = null;
    public $nombre_rol_anterior;

    public function MostrarRoles(){

        $tabla = "roles";
        $item = 'id_roles';
        $valor = $this-> valor;

        $resultado = RolesControlador::MostrarRoles($tabla,$item,$valor);
        echo json_encode($resultado);
    }

    public $rol;

    public function GuardarRol(){
        $rol = $this->rol;
        $resultado = RolesControlador::GuardarRol($rol);

        if($resultado == 'ok'){
            RolesControlador::RelacionarModulosRol($rol);
        }

        echo json_encode($resultado);
    }

    public $id;

    public function EliminarRol(){

        $id = $this->id;
        $rol = $this->rol;

        $resultado = RolesControlador::EliminarRol($id);
        RolesControlador::EliminarModulosRol($rol);

        echo json_encode($resultado);
    }


    public function ActualizarRol(){
        $rol = $this->rol;
        $id = $this->id;
        $nombre_rol_anterior = $this->nombre_rol_anterior;
        $resultado = RolesControlador::ActualizarRol($rol, $id);
        RolesControlador::ActualizarModulosRol($nombre_rol_anterior,$rol);

        echo json_encode($resultado);
    }

    public function MostrarRolModulo(){
        $rol = $this->rol;
        $resultado = RolesControlador::MostrarModulosRol($rol);
        echo json_encode($resultado);
    }

    public function ActualizarEstadoRolModulo(){
        $estado = $this->estado;
        $opcion = $this->opcion;
        $rol = $this->rol;
        $resultado = RolesControlador::ActualizarEstadoModulosRol($estado, $opcion, $rol);
    }



}

if(isset($_POST['tipo']) && $_POST['tipo'] =='crear'){

    $resultado = new RolesAjax;
    $resultado->rol = $_POST['rol'];
    $resultado->GuardarRol();

}else if(isset($_POST['tipo']) && $_POST['tipo'] =='eliminar'){

    $resultado = new RolesAjax;
    $resultado->id = $_POST['id'];
    $resultado->rol = $_POST['rol'];
    $resultado->EliminarRol();

}else if(isset($_POST['tipo']) && $_POST['tipo'] =='mostrar'){

    $resultado = new RolesAjax;
    $resultado->valor = $_POST['id'];
    $resultado->MostrarRoles();

}else if(isset($_POST['tipo']) && $_POST['tipo'] =='editar'){

    $resultado = new RolesAjax;
    $resultado->rol = $_POST['descripcion'];
    $resultado->id = $_POST['id'];
    $resultado->nombre_rol_anterior = $_POST['nombre_rol_anterior'];

    $resultado->ActualizarRol();

}else if(isset($_POST['tipo']) && $_POST['tipo'] =='mostrar_rol_modulo'){

    $resultado = new RolesAjax;
    $resultado->rol = $_POST['rol'];
    $resultado->MostrarRolModulo();

}else if(isset($_POST['tipo']) && $_POST['tipo'] =='actualizar_estado_modulo_rol'){

    $resultado = new RolesAjax;

    $resultado->estado = $_POST['estado'];
    $resultado->opcion = $_POST['opcion'];
    $resultado->rol = $_POST['rol'];
    $resultado->ActualizarEstadoRolModulo();

}else{

$mostrarRoles =  new RolesAjax;
$mostrarRoles->MostrarRoles();

}




?>