<div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->

                                <div class="page-header">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="text-secondary">REPORTE DE CADENA DE FRÍO</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-4 mr-3 py-1 text-center" style="background-color: #f2f2f2;">
                                            <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="txtDesdeReporte">Desde</label>
                                                        <input type="date" class="form-control" id="txtDesdeReporte">
                                                    </div>

                                                    <div class="col-lg-6">
                                                         <label for="txtHastaReporte">Hasta</label>
                                                         <input type="date" class="form-control" id="txtHastaReporte">
                                                    </div>                                                   
                                                </div>
                                        </div>

                                       

                                        <div class="col-lg-3 text-center p-2" style="background-color: #f2f2f2;" id="div_eess_reporte_act">                   
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!--input tipo de usuario-->
                                                    <input type="hidden" value="<?= $_SESSION['tipo_usuario']?>" id="tipoUsuarioReporte">
                                                    <!--input renaes-->
                                                    <input type="hidden" value="" id="renaesUsuarioReporte">


                                                    <label for="select_eess_reporte">Seleccione la Ipress:</label>
                                                    <select id="select_eess_reporte">                                                       
                                                       
                                                        <option value="%">Todos</option>
                                                        <option value="1">RICARDO PALMA</option>
                                                        <option value="2">SANTA EULALIA</option>
                                                        <option value="3">BUENOS AIRES</option>
                                                        <option value="4">HUAYARINGA ALTA</option>
                                                        <option value="5">COCACHACRA</option>
                                                        <option value="6">SAGRADO CORAZON DE JESUS</option>
                                                         
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>



                                        <div class="col-lg-3">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="home"> <i class="feather icon-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#"></a>Reportes</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="page-body my-5">
                                    <div class="row d-flex justify-content-center">
                                        <button class="btn hor-grd btn-grd-success waves-effect" id="btn-excel-reporte"><i class="fa fa-file-excel-o"></i>Descargar Excel</button>
                                        <!--<button class="btn hor-grd btn-grd-danger waves-effect" id="btn-pdf-reporte"><i class="fa fa-file-excel-o"></i>Descargar PDF</button>-->
                                    </div>
                                </div>

                                <!-- Page-header end -->

                                <!-- statustic-card start -->

                                <div class="page-body">
                                        <div class="row">
                                            <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-header-left ">
                                                                <h5 class="label label-primary">REGISTROS TEMPERATURA POR MES</h5> <p class="d-inline titulo_chart_reporte_act"></p>
                                                                <!--<span class="text-muted">Atenciones brindadas a los asegurados SIS - Mensual</span>-->
                                                            </div>
                                                        </div>
                                                        <div class="card-block-big" id="ChartReporteActividadMeses">
                                                            <figure class="highcharts-figure">

                                                                <div id="container"></div>
                                                            
                                                            </figure>
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