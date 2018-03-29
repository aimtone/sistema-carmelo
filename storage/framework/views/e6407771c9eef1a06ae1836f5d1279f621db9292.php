<!DOCTYPE html>
<html lang="es" ng-app="Clienbot">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clienbot | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/template.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="stylesheet" href="css/please-wait.css">
    <link rel="stylesheet" href="css/star-rating.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/toastr.css">
    <link rel="stylesheet" href="css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script type="text/javascript" src="js/please-wait.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini" ng-controller="MainController">
    <script type="text/javascript">
    window.loading_screen = window.pleaseWait({
        logo: "assets/images/logo.png",
        backgroundColor: '#222d32',
        loadingHtml: "<div class='spinner'><div class='double-bounce1'></div><div class='double-bounce2'></div></div>"
    });
    </script>
    <div class="wrapper">
        <header class="main-header">
            <a href="#!/" style="background: #222d32;" class="logo">
                <span class="logo-mini"><b>C</b>B</span>
                <span class="logo-lg"><b>Clien</b>Bot</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="images/user.png" class="user-image" alt="User Image">
                        <span ng-show="current_user.name != '' || current_user.name != null" class="hidden-xs">[[current_user.name]]</span>
                        <span ng-show="current_user.name == '' || current_user.name == null" class="hidden-xs">[[current_user.email]]</span>

                        </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="images/user.png" class="img-circle" alt="User Image">
                                    <p>
                                        <span ng-show="current_user.name != '' || current_user.name != null" >[[current_user.name]]</span>
                                        <span ng-show="current_user.name == '' || current_user.name == null" >[[current_user.email]]</span>
                                        <small>Miembro desde [[memberFromDate]]</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a ng-click="logout()" class="btn btn-default btn-flat">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <!--                 <div class="user-panel">
                    <div class="pull-left image">
                        <img src="https://0.academia-photos.com/4818925/6458459/7304721/s200_juan.p_rez_andr_s.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>[[current_user.name]]</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
                    </div>
                </div> -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="active">
                        <a href="#!/">
                           <i class="fa fa-th"></i> <span>Inicio</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                     <i class="fa fa-files-o"></i>
                     <span>Gestión de Clientes</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                        <ul class="treeview-menu">
                            <li><a href="#!/gestion-de-clientes/todos-los-clientes"><i class="fa fa-circle-o"></i> Todos los clientes</a></li>
                            <li><a href="#!/gestion-de-clientes/autorespuesta"><i class="fa fa-circle-o"></i> Autorespuesta</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                     <i class="fa fa-files-o"></i>
                     <span>Chatbots</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                        <ul class="treeview-menu">
                            <li><a href="#!/chatbots/configuracion"><i class="fa fa-circle-o"></i> Configuración</a></li>
                            <li><a href="#!/chatbots/conversacion"><i class="fa fa-circle-o"></i> Conversación</a></li>
                            <li><a href="#!/chatbots/instalacion"><i class="fa fa-circle-o"></i> Instalación</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                     <i class="fa fa-files-o"></i>
                     <span>Cuenta</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                        <ul class="treeview-menu">
                            <li><a href="#!/cuenta/perfil-de-usuario"><i class="fa fa-circle-o"></i> Perfil de Usuario</a></li>
                            <li><a href="#!/cuenta/facturacion-y-pagos"><i class="fa fa-circle-o"></i> Facturación y Pagos</a></li>
                            <li><a href="#!/cuenta/planes"><i class="fa fa-circle-o"></i> Planes</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="help.html">
                           <i class="fa fa-th"></i> <span>Ayuda</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                                  <span class="logo-lg"><b>Clien</b>Bot</span>

                  <small>[[seccion_actual]]</small>
               </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active">[[seccion_actual]]</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content" ng-view>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2014-2018 <a href="https://clienbot.com">ClienBot</a>.</strong> Todos los derechos reservados.
        </footer>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/star-raiting.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-colorpicker.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/template.min.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/fancywebsocket.js"></script>
    <script src="js/md5.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/sha1.min.js"></script>
    <script src="js/Chart.js"></script>
    <script src="js/base64.min.js"></script>
    <script src="js/sprintf.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/angular-route.js"></script>
    <script src="js/angular-cookies.js"></script>
    <script src="js/angular-resource.js"></script>
    <script src="js/app.js"></script>
    <script src="js/directives/ng-enter.js"></script>
    <script src="js/directives/ng-right-click.js"></script>
</body>

</html>

