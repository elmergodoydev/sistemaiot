<?php 
    session_start();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SISTEMA IOT</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="seguros, sistema de seguros, diris norte, app seguros, elmer godoy angeles">
    <meta name="author" content="elmer godoy angeles">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="vista\files\assets\css\estilos_prop.css">
    <!-- Favicon icon -->
    <link rel="icon" href="vista\files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="vista\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- sweet alert framework
    <link rel="stylesheet" type="text/css" href="vista\files\bower_components\sweetalert\css\sweetalert.css">-->
    <!-- themify-icons line icon -->


    <link rel="stylesheet" type="text/css" href="vista\files\assets\icon\themify-icons\themify-icons.css">
    <!-- Font Awesome -->

    <link rel="stylesheet" type="text/css" href="vista\files\assets\icon\font-awesome\css\font-awesome.min.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="vista\files\assets\icon\icofont\css\icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="vista\files\assets\icon\feather\css\feather.css">

    <!-- Switch component css -->
    <link rel="stylesheet" type="text/css" href="vista\files\bower_components\switchery\css\switchery.min.css">


    <!-- Select 2 css 
    <link rel="stylesheet" href="vista\files\bower_components\select2\css\select2.min.css">-->

    <!-- radial chart.css -->
    <link rel="stylesheet" href="vista\files\assets\pages\chart\radial\css\radial.css" type="text/css" media="all">
    <!-- feather Awesome -->

     <!-- SELECT2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">


    <!-- hover-effect.css -->
    <link rel="stylesheet" type="text/css" href="vista\files\assets\pages\hover-effect\normalize.css">
    <link rel="stylesheet" type="text/css" href="vista\files\assets\pages\hover-effect\set2.css">
    

    <!-- Multi Select css 
    <link rel="stylesheet" type="text/css" href="vista\files\bower_components\bootstrap-multiselect\css\bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="vista\files\bower_components\multiselect\css\multi-select.css">-->

        
    <link rel="stylesheet" type="text/css" href="vista\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="vista\files\assets\css\jquery.mCustomScrollbar.css">

    <!-- animation nifty modal window effects css 
    <link rel="stylesheet" type="text/css" href="vista\files\assets\css\component.css">-->

    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="vista\files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vista\files\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="vista\files\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vista\files\assets\pages\data-table\extensions\buttons\css\buttons.dataTables.min.css">

    <!--
    <link rel="stylesheet" type="text/css" href="vista\files\assets\pages\data-table\extensions\responsive\css\responsive.dataTables.css">-->
    
    <!--<link rel="stylesheet" href="vista\files\assets\scss\partials\menu\_pcmenu.htm">-->



</head>

<body class="fix-menu">

<!-- Highcharts -->
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>



<!-- Pre-loader start -->
<?php require_once 'vista/paginas/loader.php';  ?>
<!-- Pre-loader end -->

<?php

if(isset($_SESSION["Sesion"]) && $_SESSION["Sesion"] == "ok"){

   echo "<div id='pcoded' class='pcoded'>";
    echo "<div class='pcoded-overlay-box'></div>";
     echo "<div class='pcoded-container navbar-wrapper'>";

        //navbar

        require_once 'vista/paginas/navbar.php';

        //navbar end 

        //INICIO SIDE BAR

        echo "<div class='pcoded-main-container'>";
           echo "<div class='pcoded-wrapper'>";
                 require_once 'vista/paginas/sidebar.php';

            //TERMINA SIDE BAR

            //

            //======== PAGINAS SELECCIONADAS==========
                if(isset($_GET['page'])){
                    
                    $pagina = $_GET['page'];

                    $flat = false;
                    $paginas_rol = RolesControlador::MostrarPaginasRol($_SESSION['tipo_usuario']);

                    if(is_array($paginas_rol)){
                        foreach($paginas_rol as $key => $value){
                        
                            if($pagina == $value['pagina']){
                                $flat = true;
                            }  
                            
                        }
                    }

                    if($flat){
                        require_once 'vista/paginas/'.$pagina.'.php';
                    }else if($pagina == 'home'){
                        require_once 'vista/paginas/home.php';                    
                    }else if($pagina == 'tablero'){
                        require_once 'vista/paginas/tablero.php';  
                    }else if($pagina == 'tablero_detallado'){
                        require_once 'vista/paginas/tablero_detallado.php';  
                    }else{
                        //AQUI DEBERIA SER PAGINA DE ERROR
                        require_once 'vista/paginas/error.php';  
                    }
                    
                    /*
                    if(file_exists('vista/paginas/'.$pagina.'.php')){
                        
                        require_once 'vista/paginas/'.$pagina.'.php';

                    }else{

                        require_once 'vista/paginas/home.php'; 

                    }*/

                }

           echo "</div>";
        echo "</div>";
    echo "</div>";
echo "</div>";

}else{

    include "vista/paginas/login.php";

}

?>



<!-- Warning Section Ends -->
<!-- Required Jquery -->

<script type="text/javascript" src="vista\files\bower_components\jquery\js\jquery.min.js"></script>
<script type="text/javascript" src="vista\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
<script type="text/javascript" src="vista\files\bower_components\popper.js\js\popper.min.js"></script>
<script type="text/javascript" src="vista\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
<script type="text/javascript" src="vista\files\assets\pages\widget\excanvas.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="vista\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="vista\files\bower_components\modernizr\js\modernizr.js"></script>
<script type="text/javascript" src="vista\files\assets\js\SmoothScroll.js"></script>
<script type="text/javascript" src="vista\files\bower_components\modernizr\js\css-scrollbars.js"></script>
<script src="vista\files\assets\js\jquery.mousewheel.min.js"></script>

<!-- Chart js -->
<script type="text/javascript" src="vista\files\bower_components\chart.js\js\Chart.js"></script>

<!-- Switch component js -->
<script type="text/javascript" src="vista\files\bower_components\switchery\js\switchery.min.js"></script>

<!-- sweet alert js
<script type="text/javascript" src="vista\files\bower_components\sweetalert\js\sweetalert.min.js"></script>-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--<script type="text/javascript" src="vista\files\assets\js\modal.js"></script>-->

<!-- modalEffects js nifty modal window effects 
<script type="text/javascript" src="vista\files\assets\js\modalEffects.js"></script>
<script type="text/javascript" src="vista\files\assets\js\classie.js"></script>-->

<!-- fechas -->
<script type="text/javascript" src="vista\files\bower_components\moment\js\moment.min.js"></script>

<!-- data-table js -->
<script src="vista\files\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
<script src="vista\files\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
<script src="vista\files\assets\pages\data-table\js\jszip.min.js"></script>
<script src="vista\files\assets\pages\data-table\js\pdfmake.min.js"></script>
<script src="vista\files\assets\pages\data-table\js\vfs_fonts.js"></script>

<script src="vista\files\assets\pages\data-table\extensions\buttons\js\dataTables.buttons.min.js"></script>
<script src="vista\files\assets\pages\data-table\extensions\buttons\js\buttons.flash.min.js"></script>
<script src="vista\files\assets\pages\data-table\extensions\buttons\js\jszip.min.js"></script>
<script src="vista\files\assets\pages\data-table\extensions\buttons\js\vfs_fonts.js"></script>
<script src="vista\files\assets\pages\data-table\extensions\buttons\js\buttons.colVis.min.js"></script>

<script src="vista\files\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
<script src="vista\files\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>
<script src="vista\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="vista\files\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="vista\files\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>


<!-- ck editor 
<script src="vista\files\assets\pages\ckeditor\ckeditor.js"></script>-->

<!-- echart js
<script src="vista\files\assets\pages\chart\echarts\js\echarts-all.js" type="text/javascript"></script>-->

<!-- i18next.min.js -->
<script type="text/javascript" src="vista\files\bower_components\i18next\js\i18next.min.js"></script>
<script type="text/javascript" src="vista\files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="vista\files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="vista\files\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
<script type="text/javascript" src="vista\files\assets\js\common-pages.js"></script>

<!-- Select 2 js 
<script type="text/javascript" src="vista\files\bower_components\select2\js\select2.full.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script src="vista\files\assets\js\pcoded.min.js"></script>
<script src="vista\files\assets\js\vartical-layout.min.js"></script>
<script src="vista\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
<!--<script type="text/javascript" src="vista\files\assets\pages\dashboard\crm-dashboard.min.js"></script>-->
<script type="text/javascript" src="vista\files\assets\js\script.js"></script>



<!-- otros -->
<script type="text/javascript" src="vista\files\assets\new_js\usuarios.js"></script>

<script type="text/javascript" src="vista\files\assets\new_js\apiPersonas.js"></script>
<script defer type="text/javascript" src="vista\files\assets\new_js\rol.js"></script>
<script type="text/javascript" src="vista\files\assets\new_js\reportes.js"></script>

<?php
    if($_GET['page'] == "home"){
        echo '<script defer type="text/javascript" src="vista\files\assets\new_js\gauge.js"></script>';
        echo '<script defer type="text/javascript" src="vista\files\assets\new_js\graficoLive.js"></script>';
    }else if($_GET['page'] == "reportes_temperatura"){
        echo '<script defer type="text/javascript" src="vista\files\assets\new_js\graficoTemperaturaAgrupado.js"></script>';
    }else if($_GET['page'] == "tablero"){
        echo '<script defer type="text/javascript" src="vista\files\assets\new_js\tablero.js"></script>';
        echo '<script defer type="text/javascript" src="vista\files\assets\new_js\graficoBarras.js"></script>';
    }else if($_GET['page'] == "tablero_detallado"){
        echo '<script defer type="text/javascript" src="vista\files\assets\new_js\tablero_detallado.js"></script>';
    }
?>


<!-- <script type="text/javascript" src="vista\files\assets\pages\advance-elements\swithces.js"></script>-->


<script src="vista\files\assets\js\particles.min.js"></script>

<?php
if(!isset($_SESSION["Sesion"])){
    echo "<script>
            particlesJS.load('particles-js', 'vista/files/assets/js/particlesjs-config.json', function() {
            console.log('callback - particles.js config loaded');
            });
        </script>";
}
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
</body>

</html>

