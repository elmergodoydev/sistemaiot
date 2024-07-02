

<?php

class RolesControlador{

    static public function MostrarRoles($tabla,$item,$valor){

        $resultado = RolesModelo::MostrarRoles($tabla,$item,$valor);
        return $resultado;
    }

    static public function GuardarRol($rol){
        $resultado = RolesModelo::GuardarRol($rol);
        return $resultado;
    }

    static public function  EliminarRol($id)
    {
        $resultado = RolesModelo::EliminarRol($id);
        return $resultado;
    }

    static public function ActualizarRol($rol,$id)
    {
        $resultado = RolesModelo::ActualizarRol($rol, $id);
        return $resultado;
    }


    static public function RelacionarModulosRol($rol)
    {
        $resultado = RolesModelo::RelacionarModulosRol($rol);
        return $resultado;
    }

    static public function EliminarModulosRol($rol){
        $resultado = RolesModelo::EliminarModulosRol($rol);
        return $resultado;
    }

    static public function ActualizarModulosRol($rol_anterior, $rol_actual){
        $resultado = RolesModelo::ActualizarModulosRol($rol_anterior, $rol_actual);
        return $resultado;
    }

    static public function MostrarModulosRol($rol){
        $resultado = RolesModelo::MostrarModulosRol($rol);
        return $resultado;
    }

    static public function ActualizarEstadoModulosRol($estado_actual, $opcion, $rol){
        $resultado = RolesModelo::ActualizarEstadoModulosRol($estado_actual, $opcion, $rol);
        return $resultado;
    }

    static public function MostrarPaginasRol($rol){
        $resultado = RolesModelo::MostrarPaginasRol($rol);
        return $resultado;
    }

}



?>