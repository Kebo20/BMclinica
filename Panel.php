<?php
session_start();
//       require_once('CADO/ClaseCaja.php');
if (!isset($_SESSION['S_user'])) {
    header("location:index.php");
    exit;
}
//$tipouser = $_SESSION['S_tipouser'];
$caja = $_SESSION['S_caja'];
$cod_ingreso = $_SESSION['S_cod_ingreso'];
$grupo_nombre = $_SESSION['S_grupo_nombre'];
date_default_timezone_set('America/Lima');
//	   $ocaja=new Cajas();
?>
<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">
    <!-- BEGIN: Head-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
        <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
        <meta name="author" content="PIXINVENT">
        <title>BMCLINICA</title>
        <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
        <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">


        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/loaders/loaders.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-loader.css">
        <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/pages/app-chat.css">





        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <!-- END: Custom CSS-->

        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="plugins/tabla/ui-lightness/jquery-ui-1.8.4.custom.css"/>
        <link rel="stylesheet" type="text/css" href="plugins/tabla/base.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/chosen.css">

        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="plugins/js/sweetalert.min.js"></script>
        <script src="assets/js/jquery-ui.min.js"></script>
        <link  rel="stylesheet" type="text/css"  href="assets/css/select2.min.css" />

        <script src="assets/js/select2.full.min.js"   type="text/javascript"></script>



        <style>
            #IdCarga{
                position: absolute;
                width:30px;
                height:30px;
                background:#900052 !important;
                border-radius:50px;
                animation: preloader_5 1.5s infinite linear;
                top: 0;
                left: 0;
                right: 0;
                bottom: 10px;
                margin: auto;
                z-index: 100;
            }
            #IdCarga:after{
                position:absolute;
                width:70px;
                height:70px;
                border-top:10px solid #900052 !important;
                border-bottom:10px solid #900052 !important;
                border-left:10px solid transparent !important;
                border-right:10px solid transparent !important;
                border-radius:50px;
                content:'';
                top:-20px;
                left:-20px;
                animation: preloader_5_after 1.5s infinite linear;
            }
            @keyframes preloader_5 {
                0% {transform: rotate(0deg);}
                50% {transform: rotate(180deg);background:#900052;}
                100% {transform: rotate(360deg);}
            }
            @keyframes preloader_5_after {
                0% {border-top:10px solid #900052;border-bottom:10px solid #900052;}
                50% {border-top:10px solid #900052;border-bottom:10px solid #900052;}
                100% {border-top:10px solid #900052;border-bottom:10px solid #900052;}
            }


        </style>	





    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body

    <body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">-->


    <body class="vertical-layout vertical-menu content-left-sidebar chat-application  fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="content-left-sidebar">
        <!-- INICIO DE CABECERA-->
        <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
            <div class="navbar-wrapper bg-white">
                <div class="navbar-header">
                    <ul class="nav navbar-nav flex-row">
                        <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                        <li class="nav-item"><a class="navbar-brand" href="index.php"><img class="brand-logo" alt="modern admin logo" src="app-assets/images/logo/log-1.png">
                                <h3 class="brand-text">BMCl&iacute;nica</h3>
                            </a></li>
                        <li class="nav-item d-md-none"><a class="nav-link open-navbar-container danger" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                    </ul>
                </div>
                <div class="navbar-container content">
                    <div class="collapse navbar-collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav mr-auto float-left">
                            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu danger"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize danger"></i></a></li>

                        </ul>
                        <ul class="nav navbar-nav float-right">
                            <!--<li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-gb"></i><span class="selected-language"></span></a>
                                <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a></div>
                            </li>-->
                            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell danger"></i><span class="badge badge-pill badge-danger badge-up badge-glow">5</span></a>
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                    <li class="dropdown-menu-header">
                                        <h6 class="dropdown-header m-0"><span class="grey darken-2">Notificacioness</span></h6><span class="notification-tag badge badge-danger float-right m-0">5 Nuevos</span>
                                    </li>
                                    <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan mr-0"></i></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Tienes nueva orden</h6>
                                                    <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutos ene</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i class="ft-download-cloud icon-bg-circle bg-red bg-darken-1 mr-0"></i></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading red darken-1">Solicitud de amistad</h6>
                                                    <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour ago</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3 mr-0"></i></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading yellow darken-3">3 proyectos en marcha</h6>
                                                    <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i class="ft-check-circle icon-bg-circle bg-cyan mr-0"></i></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Complete the task</h6><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal mr-0"></i></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Generate monthly report</h6><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                                </div>
                                            </div>
                                        </a></li>
                                    <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Leer todas las notificaciones</a></li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail danger"></i></a>
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                    <li class="dropdown-menu-header">
                                        <h6 class="dropdown-header m-0"><span class="grey darken-2">Mensajes</span></h6><span class="notification-tag badge badge-warning float-right m-0">4 Nuevos</span>
                                    </li>
                                    <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Edwin Elias</h6>
                                                    <p class="notification-text font-small-3 text-muted">I like your portfolio, let's start.</p><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Hoy</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left"><span class="avatar avatar-sm avatar-busy rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Bret Lezama</h6>
                                                    <p class="notification-text font-small-3 text-muted">I have seen your work, there is</p><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Martes</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-3.png" alt="avatar"><i></i></span></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Carie Berra</h6>
                                                    <p class="notification-text font-small-3 text-muted">Can we have call in this week ?</p><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Viernes</time></small>
                                                </div>
                                            </div>
                                        </a><a href="javascript:void(0)">
                                            <div class="media">
                                                <div class="media-left"><span class="avatar avatar-sm avatar-away rounded-circle"><img src="app-assets/images/portrait/small/avatar-s-6.png" alt="avatar"><i></i></span></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Eric Alsobrook</h6>
                                                    <p class="notification-text font-small-3 text-muted">We have project party this saturday.</p><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">last month</time></small>
                                                </div>
                                            </div>
                                        </a></li>
                                    <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Leer todos los Mensajes</a></li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-user nav-item bg-vino"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700">
                                        <?= $_SESSION['S_user']; ?></span><span class="avatar avatar-online"><img src="app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></a>
                                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="ft-user"></i> Editar Perfil</a><a class="dropdown-item" href="#"><i class="ft-mail"></i> Bandeja de Entrada</a><a class="dropdown-item" href="#"><i class="ft-check-square"></i> Tarea</a><a class="dropdown-item" href="#" onClick="Chat('LinkChat', 'ChatTab');Aparecer('LiChatTab', 'Chat')"><i class="ft-message-square"></i> Chats</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="index.php"><i class="ft-power"></i> Cerrar Sesi&oacute;n</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- FIN DE CABECERA-->

        <!-- PARA EL CARGANDO -->	
        <div id="IdCarga" style="display: none" ></div>

    </div>

    <!--INICIO DE BARRA LATERAL IZQUIERDA -->
    <?php include("MenuVertical.php"); ?>		
    <!-- FIN DE BARRA LATERAL IZQUIERDA -->


</div>
<!-- INICIO DE PARTE CENTRAL DEL CONTENIDO-->
<div class="app-content content" >
    <!-- <div class="content-overlay"></div>-->
    <!--<div class="chat-sidebar card">-->


    <?php include("tabPanel.php");
//            include("Chat.php"); 
    ?>
</div>

<!--<div class="content-wrapper">
    <div class="content-header row" style="margin: 0px !important"> </div>
    
    <div class="content-body">  </div>
          
    
</div>-->

</div>


<!-- FIN DE PARTE CENTRAL DEL CONTENIDO-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>







<!-- BEGIN: Footer-->
<!--<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a class="text-bold-800 grey darken-2" href="https://1.envato.market/modern_admin" target="_blank">PIXINVENT</a></span><span class="float-md-right d-none d-lg-block">Hand-crafted & Made with<i class="ft-heart pink"></i><span id="scroll-top"></span></span></p>
</footer>-->
<!-- END: Footer-->


<!-- BEGIN: Page JS-->

<!-- END: Page JS-->
<!-- BEGIN: Vendor JS-->
<script src="app-assets/js/scripts/tabs.js"></script>
<script src="app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="app-assets/vendors/js/charts/chart.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="app-assets/js/core/app-menu.js"></script>
<script src="app-assets/js/core/app.js"></script>
<script src="app-assets/js/scripts/pages/app-chat.js"></script>

<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="app-assets/js/scripts/pages/appointment.js"></script>
<script src="app-assets/js/scripts/forms/custom-file-input.js"></script>
<!-- END: Page JS-->

<script type="text/javascript" src="plugins/tabla/jquery.fixheadertable.js"></script>
<script type="text/javascript" src="plugins/js/Tablas.js"></script>
<script src="assets/js/chosen.jquery.js">
</script>







<input type="hidden" id="HiActivo" value="0" >


<div id="IdCargando" class="overlay" style="display:none" >
    <div id="loader">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="lading"></div>
    </div>
</div> 

<input type="hidden" id="BMusuario" value="<?=$_SESSION['S_user'] ?>">
</body>
<!-- END: Body-->

</html>