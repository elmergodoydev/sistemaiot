<nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">

                <!-- LOGO -->
                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu"></i>
                    </a>
                    <a href="#">
                        <img class="img-fluid" src="vista\files\assets\images\velocimetro.png" alt="Theme-Logo" width="100px">
                    </a>
                    
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>

                <!-- LOGO END -->


                <div class="navbar-container container-fluid">


                 <!-- caja busqueda -->
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="feather icon-maximize full-screen"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- final caja busqueda -->

                    <ul class="nav-right">

                    <!-- 
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-bell"></i>
                                    <span class="badge bg-c-pink">5</span>
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="vista\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>-->

                        <!-- 
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-message-square"></i>
                                    <span class="badge bg-c-green">3</span>
                                </div>
                            </div>
                        </li>-->


                        <!-- datos cuenta -->
                        <li class="header-notification mr-3">
                            ROL ASIGNADO: <span><?=$_SESSION['tipo_usuario']?></span>
                        </li>

                         <!-- datos cuenta -->
                        <li class="header-notification mr-3">
                            ESTABLECIMIENTO: <span><?=$_SESSION['establecimiento']?></span>
                        </li>

                            
                        <!-- opciones sesion -->
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="vista\files\assets\images\avatar-4.png" class="img-radius" alt="User-Profile-Image">
                                    <span><?= $_SESSION['nombres'].' '.$_SESSION['apellidos']?></span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="#">
                                            <i class="feather icon-settings"></i> Ajustes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="feather icon-user"></i> Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="vista/paginas/logout.php">
                                            <i class="feather icon-log-out"></i> Cerrar Sesión
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </li>
                         <!-- opciones sesion end -->

                    </ul>
                </div>
            </div>
        </nav>
