<!DOCTYPE html>
<html ng-app="clienbot">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clienbot | Recuperación de Contraseña</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-minimal.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="css/template.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="hold-transition register-page" ng-controller="registerCtrl">
    <div class="register-box">
        <div class="register-logo">
            <a href="https://clienbot.com"><div id="logo"></div></a>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">Por favor, introduce tu direccion de correo registrada</p>
            <form ng-submit="resetpassword()">
              
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" ng-model="data.email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar</button>
                    </div>
                </div>
            </form>
            <!-- <div class="social-auth-links text-center">
                <p>- Ó -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Registrate con Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i>Registrate con Google+</a>
            </div> -->
            <a href="javascript:history.back(-1)" class="text-center">Ir atras</a>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.7/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.7/angular-resource.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.7/angular-route.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.7/angular-cookies.min.js"></script>
    <script src="js/sprintf.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/register.js"></script>
</body>

</html>