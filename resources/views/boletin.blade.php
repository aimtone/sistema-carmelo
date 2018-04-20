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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../css/custom.min.css" rel="stylesheet">
    <style>
        body {
            margin:0 auto;
            padding:0 auto;
            width: 100%;
            height: 100%;
        }
        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            margin-top: 30px;
            margin-left: 30px;
            transition: 0.3s;
            padding-top: 5px;
            width: 200px;
            display: inline-block;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* Add some padding inside the card container */
        .container {
            padding: 2px 16px;
        }
        .comite {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            background: white;
            margin-top: 20px;
            padding:10px 10px 10px 10px;
        }

        .checked {
            border:4px solid green;

        }
    </style>
  </head>

  <body class="login container-fluid" ng-controller="MainController">
    <div ng-show="!proceso_finalizado" class="row text-center comite" ng-repeat="x in data.comite">
        <h4>República Bolivariana de Venezuela</h4>
        <h4>[[data.eleccion.descripcion]]</h4>
        <div class="col-sm-12">
            <h1>[[x.comite.descripcion]]</h1>
            <h3><b>Selecciona [[x.comite.seleccionable]] <span ng-show="x.comite.seleccionable!=1">candidatos</span><span ng-show="x.comite.seleccionable==1">candidato</span></b></h3>
        </div>

        <div class="card" ng-repeat="candidato in x.candidatos">
            <img ng-click="cargarVoto($event, x.comite.seleccionable)" id="[[candidato.id]]-[[x.id_comite]]" src="../images/user.png" alt="Avatar" style="width:100%">
            <div>
                <h4><b>[[candidato.habitante.nombre]]<br>[[candidato.habitante.apellido]]</b></h4> 
                <p>Cedula: [[candidato.habitante.nacionalidad]]-[[candidato.habitante.cedula]]</p>
            </div>
        </div>
    
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/angular.min.js"></script>
    <script src="../js/angular-cookies.js"></script>

    <script>
        var app = angular.module('siccas', ['ngCookies'], function($interpolateProvider) {
            $interpolateProvider.startSymbol('[[');
            $interpolateProvider.endSymbol(']]');
        });

        app.controller('MainController', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore) {
        	$rootScope.id_eleccion = "<?php echo $id ?>";
            $rootScope.host_uri = "http://localhost:8080/api/"
        	$rootScope.token = $cookieStore.get("token");
            $rootScope.begin = 0;
            $rootScope.limit = 1;
            $rootScope.votos = [];
            $rootScope.contador = 0;
            $rootScope.button_disabled = true;
            $rootScope.proceso_finalizado = false;

        	$rootScope.get = function(url, token = "") {
		        var defered = $q.defer();
		        var promise = defered.promise;
		        $http.get($rootScope.host_uri + url, {
		            headers: {
		                'Content-Type': 'application/json',
		                'Authorization': token
		            }
		        }).then(function(response) {
		            defered.resolve(response);
		        }, function(response) {
		            defered.reject(response);
		        });
		        return promise;
		    };

		    $rootScope.post = function(url, data, token = "") {
		        var defered = $q.defer();
		        var promise = defered.promise;
		        $http.post($rootScope.host_uri + url, data, {
		            headers: {
		                'Content-Type': 'application/json',
		                'Authorization': token
		            }
		        }).then(function(response) {
		            defered.resolve(response);
		        }, function(response) {
		            defered.reject(response);
		        });
		        return promise;
		    };

           
            $rootScope.get('boletin/' + $rootScope.id_eleccion).then(function(response) {
                if(response.status==200) {
                    $rootScope.data = response.data;
                } else {
                    window.location.href="/app";
                }
            }, function() {
                window.location.href="/app";
            });


		    
        });
    </script>
  </body>
</html>