<?php

require_once 'controlador/PlantillaControlador.php';

require_once "controlador/UsuariosControlador.php";
require_once "controlador/RolesControlador.php";

require_once "modelo/UsuariosModelo.php";
require_once "modelo/RolesModelo.php";


$template = new PlantillaControlador;
$template->mostrar();


?>