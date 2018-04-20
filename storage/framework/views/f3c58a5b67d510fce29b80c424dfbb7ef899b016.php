<!DOCTYPE html>
<html lang="en" ng-app="siccas">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SICCAS</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login" ng-controller="MainController">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form ng-submit="login()">
              <h1>Iniciar Sesión</h1>
              <div>
                <input type="text" ng-model="data_login.email" class="form-control" placeholder="Nombre de Usuario" required="" />
              </div>
              <div>
                <input type="password" ng-model="data_login.password" class="form-control" placeholder="Contraseña" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" href="index.html">Ingresar</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

         
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <script src="js/angular.min.js"></script>
    <script src="js/angular-cookies.js"></script>

    <script>
        var app = angular.module('siccas', ['ngCookies'], function($interpolateProvider) {
            $interpolateProvider.startSymbol('[[');
            $interpolateProvider.endSymbol(']]');
        });

        app.controller('MainController', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore) {

        $rootScope.data_login = {
            email: null,
            password: null
        };

        $rootScope.login = function() {
            console.log($rootScope.data_login);
            $http.post('http://localhost:8080/api/login', $rootScope.data_login).then(function(response) {
                console.log(response);
                if (typeof response.data.token != "undefined" && response.data.token != null) {
                    $cookieStore.put('token', response.data.token);
                    $cookieStore.put('current_user', response.data);
                    window.location.href = "app";
                }
            }, function(error) {
                console.error(error);
            });


        }
    });
    </script>
  </body>
</html>