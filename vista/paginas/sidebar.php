
                <nav class="pcoded-navbar" id="panel_lateral_id">

                    <div class="pcoded-inner-navbar main-menu">
                        <div class="pcoded-navigatio-lavel">Navegación</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                    <span class="pcoded-mtext">Dashboard</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="home">
                                            <span class="pcoded-mtext">Inicio</span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="tablero">
                                            <span class="pcoded-mtext">Tablero</span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="tablero_detallado">
                                            <span class="pcoded-mtext">Tablero Detallado</span>
                                        </a>
                                    </li>


                                    <!-- 
                                    <li class="">
                                        <a href="historico">
                                            <span class="pcoded-mtext">Datos Historicos</span>
                                            <span class="pcoded-badge label label-success">New</span>
                                        </a>
                                    </li>-->
                                </ul>
                            </li>

                        </ul>


                        <?php

                        $modulos = RolesControlador::MostrarPaginasRol($_SESSION['tipo_usuario']);

                        //modulo usuarios
                        $usuarios = false;
                        $registro_usuarios = false;

                         //modulo categorias
                         $categorias = false;
                         $roles = false;


                         //modulo reportes
                         $reportes = false;
                         $reporte_temperatura = false;

                      
                        //permitir modulos
                        foreach ($modulos as $key => $value) {

                            if($value['modulo'] == 'usuarios'){
                                $usuarios = true;

                                if($value['opcion'] == 'registro_usuarios'){
                                    $registro_usuarios = true;
                                }
                               
                            }


                            if($value['modulo'] == 'reportes'){
                                $reportes = true;
    
                                if($value['opcion'] == 'reportes'){
                                    $reporte_temperatura = true;
                                }
                                
                            }
    
    
    
                            if($value['modulo'] == 'categorias'){
                                $categorias = true;
    
                                if($value['opcion'] == 'roles'){
                                    $roles = true;
                                }
                                
                                
                            }


                        }


                        //modulo categorias

                        
                        if($categorias){
                            echo '<div class="pcoded-navigatio-lavel">Tablas</div>';
                            echo '<ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                                                <span class="pcoded-mtext">Categorias</span>
                                            </a>
                                            <ul class="pcoded-submenu">';

                            if($roles){
                                        echo '<li class="">
                                                <a href="roles">
                                                    <span class="pcoded-mtext">Roles</span>
                                                </a>
                                            </li>';
                            }

                                                
                            echo '       </ul>
                                    </li>
                              </ul>';
                                          
                        }




                        //modulo reportes
                        if($reportes){
                            echo '<div class="pcoded-navigatio-lavel">Reportes</div>';
                            echo '<ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="feather icon-bar-chart"></i></span>
                                                <span class="pcoded-mtext">Reportes</span>
                                            </a>
                                            <ul class="pcoded-submenu">';

                            if($reporte_temperatura){
                                        echo '<li class="">
                                                <a href="reportes_temperatura">
                                                    <span class="pcoded-mtext">Registros Temperatura</span>
                                                </a>
                                            </li>';
                            }


                                                
                            echo '       </ul>
                                    </li>
                                </ul>';
                                            
                        }








                        //modulo usuarios
                        if($usuarios){
                            echo '<div class="pcoded-navigatio-lavel">Mantenimiento</div>';
                            echo '<ul class="pcoded-item pcoded-left-item">
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                                                <span class="pcoded-mtext">Usuarios</span>
                                            </a>
                                            <ul class="pcoded-submenu">';

                            if($registro_usuarios){
                                        echo '<li class="">
                                                <a href="usuarios">
                                                    <span class="pcoded-mtext">Registrar</span>
                                                </a>
                                            </li>';
                            }

                                                
                            echo '       </ul>
                                    </li>
                                </ul>';
                                            
                        }
                        

                        ?>      

                    </div>


                </nav>