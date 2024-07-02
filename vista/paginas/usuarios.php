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
                                                    <h4>Usuarios</h4>
                                           
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="home"> <i class="feather icon-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Usuarios</a> </li>
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
                                                
                                                    <button class="btn hor-grd btn-grd-info waves-effect" data-toggle="modal" data-target="#usuario-Modal"><i class="fa fa-user-plus"></i>Agregar Usuario</button>
                                                    
                                                    <div class="modal fade" id="usuario-Modal" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"><i class="feather icon-user"></i> Agregar Usuario</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" id="formUsuario">

                                                                    <div class="modal-body">
                                                                        
                                                                
                                                                        <div class="row mb-5">
                                            
                                                                            <div class="col-sm-12 col-lg-6 d-flex">
                                                                                <div class="col-10 p-0">
                                                                                    <div class="input-group">
                                                                                        <input type="number" class="form-control" placeholder="Ingrese el Documento" id="txtDocumentoUsuario">                                                                        
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-2 px-2">
                                                                                    <button class="btn btn-sm btn-info" id="btnBuscarUsuario">API
        
                                                                                    </button>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6 mb-sm-3">

                                                                                <select id="select_eess_usuario" required>
                                                                                        <option value="">Seleccione el Establecimiento</option>
                                                                                        <option value="RICARDO PALMA">RICARDO PALMA</option>
                                                                                        <option value="BUENOS AIRES">BUENOS AIRES</option>
                                                                                        <option value="SANTA EULALIA">SANTA EULALIA</option>
                                                                                        <option value="HUAYARINGA ALTA">HUAYARINGA ALTA</option>
                                                                                        <option value="COCACHACRA">COCACHACRA</option>
                                                                                        <option value="SAGRADO CORAZON DE JESUS">SAGRADO CORAZON DE JESUS</option>
                                                                                        <option value="EL VALLE">EL VALLE</option>
                                                                                        <option value="SAN ANTONIO">SAN ANTONIO</option>
                                                                                        <option value="PEDRO A. LOPEZ GUILLEN">PEDRO A. LOPEZ GUILLEN</option>
                                                                                        <option value="EL PARAISO">EL PARAISO</option>

                                                                                </select>
                                                                                
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6">

                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" placeholder="Nombres..." id="txtNombreUsuario" required>
                                                                                </div>
                                                                                
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6">
                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" placeholder="Apellido..." id="txtApellidoUsuario" required>
                                                                                </div>
                                                                    
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6">
                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" placeholder="Documento..." id="txtUsuario" required>
                                                                                </div>
                                                                            
                                                                            </div>


                                                                            <div class="col-sm-12 col-lg-6">
                                                                                <div class="input-group">
                                                                                    <input type="password" class="form-control" placeholder="Password..." id="txtPasswordUsuario" required>
                                                                                </div>
                                                                        
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6 mb-sm-3">

                                                                                <select name="select" class="form-control" id="selectRolUsuario" required>
                                                                                    <option value="">Seleccione el Rol</option>
                                                                                </select>

                                                                            </div>
                                                                        
                                                                        </div>

                                                                        <div class="loader animation-start d-none" id="loader-usuario">
                                                                            <span class="circle delay-1 size-2"></span>
                                                                            <span class="circle delay-2 size-4"></span>
                                                                            <span class="circle delay-3 size-6"></span>
                                                                            <span class="circle delay-4 size-7"></span>
                                                                            <span class="circle delay-5 size-7"></span>
                                                                            <span class="circle delay-6 size-6"></span>
                                                                            <span class="circle delay-7 size-4"></span>
                                                                            <span class="circle delay-8 size-2"></span>
                                                                        </div>

                                                                        <div class="d-none" style="height: 111px;" id="caja-espacio"></div>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnGuardarUsuario">Guardar</button>
                                                                    </div>

                                                                </form>

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

                                                    <div class="modal fade" id="usuario-edit-Modal" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"><i class="feather icon-user"></i> Editar Usuario</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" id="formEditUsuario">

                                                                    <div class="modal-body">
                                                                        
                                                                
                                                                        <div class="row mb-3">
                                            
                                                                            <div class="col-sm-12 col-lg-6 d-flex">
                                                                                <div class="col-10 p-0">
                                                                                    <div class="input-group">
                                                                                        <input type="number" class="form-control" placeholder="Ingrese el Documento" id="txtEditDocumentoUsuario">                                                                        
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-2 px-2">
                                                                                    <button class="btn btn-sm btn-info" id="btnEditBuscarUsuario">API
        
                                                                                    </button>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6 mb-sm-3">

                                                                                <select id="select_edit_eess_usuario" required>
                                                                                        <option value="">Seleccione el Establecimiento</option>
                                                                                        <option value="RICARDO PALMA">RICARDO PALMA</option>
                                                                                        <option value="BUENOS AIRES">BUENOS AIRES</option>
                                                                                        <option value="SANTA EULALIA">SANTA EULALIA</option>
                                                                                        <option value="HUAYARINGA ALTA">HUAYARINGA ALTA</option>
                                                                                        <option value="OCACHACRA">COCACHACRA</option>
                                                                                        <option value="SAGRADO CORAZON DE JESUS">SAGRADO CORAZON DE JESUS</option>
                                                                                        <option value="EL VALLE">EL VALLE</option>
                                                                                        <option value="SAN ANTONIO">SAN ANTONIO</option>
                                                                                        <option value="PEDRO A. LOPEZ GUILLEN">PEDRO A. LOPEZ GUILLEN</option>
                                                                                        <option value="EL PARAISO">EL PARAISO</option>
                                                                                       
                                                                                </select>
                                                                                
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6">

                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" placeholder="Ingrese el Nombre" id="txtEditNombreUsuario" required>
                                                                                </div>
                                                                                
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6">
                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" placeholder="Ingrese el Apellido" id="txtEditApellidoUsuario" required>
                                                                                </div>
                                                                    
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6">
                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" placeholder="Ingrese el Usuario (DNI)" id="txtEditUsuario" required>
                                                                                </div>
                                                                            
                                                                            </div>


                                                                            <div class="col-sm-12 col-lg-6">
                                                                                <div class="input-group">
                                                                                    <input type="password" class="form-control" placeholder="Ingrese el Password" id="txtEditPasswordUsuario">
                                                                                    <input type="hidden" id="txtClaveAnterior">
                                                                                    <input type="hidden" id="txtIdUsuario">
                                                                                </div>
                                                                        
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-6 mb-sm-3">

                                                                                <select name="select" class="form-control" id="selectEditRolUsuario" required>
                                                                                    <option value="">Seleccione el Rol</option>
                                                                                </select>

                                                                            </div>
                                                            
                                                                        </div>

                                                                        <div class="loader animation-start d-none" id="loader-edit-usuario">
                                                                            <span class="circle delay-1 size-2"></span>
                                                                            <span class="circle delay-2 size-4"></span>
                                                                            <span class="circle delay-3 size-6"></span>
                                                                            <span class="circle delay-4 size-7"></span>
                                                                            <span class="circle delay-5 size-7"></span>
                                                                            <span class="circle delay-6 size-6"></span>
                                                                            <span class="circle delay-7 size-4"></span>
                                                                            <span class="circle delay-8 size-2"></span>
                                                                        </div>

                                                                        
                                                                        <div class="d-none" style="height: 112px;" id="caja-edit-espacio"></div>

                                                                        <div><p class="text-left text-primary">*Si no ingresa una contraseña se guardará la clave anterior</p></div>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnEditGuardarUsuario">Guardar</button>
                                                                    </div>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                        <div class="card-block">
                                                            <div class="table-responsive dt-responsive">
                                                                <table id="tbl_usuario" class="table table-striped table-bordered nowrap" style="width: 100%;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>N°</th>
                                                                            <th>Nombres</th>
                                                                            <th>Usuario</th>
                                                                            <th>Estado</th>
                                                                            <th>Rol</th>
                                                                            <th>Establecimiento</th>
                                                                            <th>Acciones</th>
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
                                                                             <th>N°</th>
                                                                            <th>Nombres</th>
                                                                            <th>Usuario</th>
                                                                            <th>Estado</th>
                                                                            <th>Rol</th>
                                                                            <th>Establecimiento</th>
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


                            </div>
                        </div>
                        <div id="styleSelector">

                        </div>
                    </div>
                </div>