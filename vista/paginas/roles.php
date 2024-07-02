    <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>Roles</h4>
                                           
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="home"> <i class="feather icon-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Roles</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                
                                                    <button class="btn hor-grd btn-grd-info waves-effect" data-toggle="modal" data-target="#rol-Modal"><i class="fa fa-user-plus"></i>Agregar Rol</button>
                                                    
                                                    <div class="modal fade" id="rol-Modal" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"><i class="feather icon-user"></i> Agregar Rol</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                
                                                                    <form id="formCrearRol" method="post" action="/" novalidate="">
                                                                
                                                                        <div class="row">
                            
                                                                            <div class="col-12">
                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" name="txtNombreRol" placeholder="Ingrese el Rol" id="txtNombreRol">
                                                                                </div>
                                                                                <span class="d-block" id="msjTxtRol" style="color: red;"></span>
                                                                            </div>

                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Cerrar</button>
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnCrearRol">Guardar</button>
                                                                        </div>

                                                                    </form>
                         
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!--
                                                    <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li><i class="feather icon-maximize full-card"></i></li>
                                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                                        </ul>
                                                    </div>-->

                                                </div>

                                                        <div class="card-block">
                                                            <div class="table-responsive dt-responsive">
                                                                <table id="tbl_rol" class="table table-striped table-bordered nowrap" style="width: 100%;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Id</th>
                                                                            <th>Rol</th>
                                                                            <th style="width: 100px;">Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    <!--
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>Elmer Nino</td>
                                                                            <td>72837457</td>
                                                                            <td><a href="#" class="btn btn-grd-success btnActivar" idUsuario="" estadoUsuario="0">activo</a></td>
                                                                            <td>Administrador</td>
                                                                            <td>EL CARMEN</td>
                                                                            <td class="dropdown">
                                                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                                                                <div class="dropdown-menu dropdown-menu-right b-none contact-menu">
                                                                                    <a class="dropdown-item" href="#!"><i class="icofont icofont-edit"></i>Editar</a>
                                                                                    <a class="dropdown-item" href="#!"><i class="icofont icofont-ui-delete"></i>Eliminar</a>
                                                                                    <a class="dropdown-item" href="#!"><i class="icofont icofont-eye-alt"></i>Ver</a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>-->


                                                                    </tbody>

                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>Id</th>
                                                                            <th>Rol</th>
                                                                            <th>Acciones</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- editar modal -->

                                <div class="modal fade" id="rol-edit-Modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><i class="feather icon-user"></i> Editar Rol</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                                                    
                                                    <div class="row">
                        
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="Ingrese el Rol" id="txtNombreRolEdit">
                                                                <input type="hidden"  id="txtIdRolEdit">
                                                                <input type="hidden"  id="txtNombreRolAnterior">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" id="btnActualizarRol">Guardar</button>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                </div>


                                <!-- asignar modulos -->
                                <div class="modal fade" id="asignar_modulo_rol_modal" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"><i class="feather icon-user"></i>Asignar Modulos Según Rol</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>

                                                                </div>
                                                                <form method="POST" id="formAsignarModulos">

                                                                    <div class="modal-body">

                                                                            <div class="caja_rol_modulo">

                                                                            </div>

                                                                            <!-- guardar valor del rol en input-->
                                                                            <input type="hidden" id="nombreRolActualizarModulos">
                                                                            

                                                                    </div>
  

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnGuardarModulos">Guardar</button>
                                                                    </div>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    



                            </div>
                        </div>
                        <div id="styleSelector">

                        </div>
                    </div>
                </div>