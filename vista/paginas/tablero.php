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
                                                    <h4 class="label label-success">TABLERO DE CONTROL DE LA CADENA DE FRÍO</h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-4 mr-3 py-1 text-center" style="background-color: #f2f2f2;">
                                            <div class="row">
                                                    <div class="col-lg-4">
                                                        <label for="txtDesdeReporte">Desde</label>
                                                        <input type="date" class="form-control" id="txtDesdeReporteTablero">
                                                    </div>

                                                    <div class="col-lg-4">
                                                         <label for="txtHastaReporte">Hasta</label>
                                                         <input type="date" class="form-control" id="txtHastaReporteTablero">
                                                    </div>  
                                                    
                                                    <div class="col-lg-4 align-self-end">
                                                        <button class="btn hor-grd btn-grd-primary" id="btnMostrarDatosDia">Mostrar Datos</button>
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
                                                    <h5>RUPTURA DE CADENA DE FRIO POR DIA</h5>
                                                    <span style="font-size: 14px;">La tabla muestra si el establecimiento presentó ruptura de cadena de frío en el día</span>

                                                </div>
                                                <div class="card-block">
                                                    <div style="height: 400px; overflow-y: scroll;">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                <thead class="sticky-top">
                                                                <tr>
                                                                    <th>Fecha</th>
                                                                    <th>Ricardo Palma</th>
                                                                    <th>Santa Eulalia</th>
                                                                    <th>Buenos Aires</th>
                                                                    <th>Huayaringa Alta</th>
                                                                    <th>Cocachacra</th>
                                                                    <th>Sagrado Corazon</th>
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

                                        <div class="col-sm-12 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>DIAS DE RUPTURA DE CADENA DE FRIO POR ESTABLECIMIENTO (RCF)</h5>
                                                    <span style="font-size: 14px;" class="subtitulo_ruptura_eess">Desde el día _________ Hasta __________</span>
                                                    
                                                </div>
                                                <div class="card-block">
                                                    <figure class="highcharts-figure">
                                                        <div id="container_grafico_barra"></div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>INDICADOR: ESTABLECIMIENTOS CON RUPTURA DE CADENA DE FRIO POR DIA (RCF)</h5>
                                                    <span style="font-size: 14px;" class="subtitulo_ruptura_eess">Desde el día _________ Hasta __________</span>
                                                    
                                                </div>
                                                <div class="card-block">
                                                        <div style="height: 400px; overflow-y: scroll;">
                                                            <div class="dt-responsive table-responsive">
                                                                <table id="tablaIndicadorRCF" class="table table-striped table-bordered nowrap">
                                                                    <thead class="sticky-top">
                                                                    <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Centros Evaluados</th>
                                                                        <th>Centros con RCF</th>
                                                                        <th>% Porcentaje Indicador</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="tablaDatosBodyIndicadorRCF">
                    
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