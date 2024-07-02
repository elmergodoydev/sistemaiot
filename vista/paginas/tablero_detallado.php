<div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="row">
                                        <div class="col-lg-12 d-flex justify-content-center">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4 class="label label-success">TABLERO DETALLADO - CONTROL DE LA CADENA DE FRÍO</h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-6 mr-3 py-1 text-center" style="background-color: #f2f2f2;">
                                            <div class="row">
                                                    <div class="col-lg-4">
                                                        <label for="txtFechaTableroDet">FECHA</label>
                                                        <input type="date" class="form-control" id="txtFechaTableroDet">
                                                    </div>

                                                    <div class="col-lg-4">
                                                        
                                                        <label for="select_eess_reporte">Seleccione la Ipress:</label>
                                                        <select id="select_eess_reporte">                                                       
                                                        
                                                            <option value="1">RICARDO PALMA</option>
                                                            <option value="2">SANTA EULALIA</option>
                                                            <option value="3">BUENOS AIRES</option>
                                                            <option value="4">HUAYARINGA ALTA</option>
                                                            <option value="5">COCACHACRA</option>
                                                            <option value="6">SAGRADO CORAZON DE JESUS</option>
                                                            
                                                        </select>

                                                    </div>

                                                    
                                                    <div class="col-lg-4 align-self-end">
                                                        <button class="btn hor-grd btn-grd-primary" id="btnMostrarDatosTableroDet">Mostrar Datos</button>
                                                    </div>  
                                                </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Page-header end -->

                                <!-- statustic-card start -->
   
                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>VALORES MINIMOS Y MAXIMOS DE TEMPERATURA EN RANGOS DE 60 MINUTOS</h5>
                                                    <span style="font-size: 14px;" class="subtitulo_rangos_hora">Fecha de Evaluación: ____________</span>

                                                </div>
                                                <div class="card-block">
                                                    <div style="height: 400px; overflow-y: scroll;">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                <thead class="sticky-top">
                                                                <tr>
                                                                    <th>Tiempo Inicio</th>
                                                                    <th>Tiempo Fín</th>
                                                                    <th>Temperatura Mínima</th>
                                                                    <th>Temperatura Máxima</th>
                                                                    <th>Evaluación</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tablaDatosBody">
                
                                                                </tbody>
    
                                                            </table>
                                                        </div>
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