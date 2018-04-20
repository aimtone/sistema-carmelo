<!DOCTYPE html>
<html lang="en" ng-app="siccas" oncontextmenu="return false;">
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
    <link href="../css/please-wait.css" rel="stylesheet">


    <style>
        body {
            margin:0 auto;
            padding:0 auto;
            width: 100%;
            height: 100%;
            -webkit-user-select: none;
            -moz-user-select: none;
            -khtml-user-select: none;
            -ms-user-select:none;
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

  <body class="login container-fluid" ng-cloak ng-controller="MainController">
  
    <div class="wrapper">
        <div ng-show="proceso_finalizado" class="row text-center">
         <h4>República Bolivariana de Venezuela</h4>
            <h4>[[data.eleccion.descripcion]]</h4>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h1>EL PROCESO HA FINALIZADO CORRECTAMENTE, GRACIAS POR PARTICIPAR</h1>
            <h2>Está ventana sera bloqueada en 5 segundos de manera automática</h2>
        </div>

        <div ng-show="!proceso_finalizado" class="row text-center comite" ng-repeat="x in data.comite | limitTo: limit:begin">
            <h4>República Bolivariana de Venezuela</h4>
            <h4>[[data.eleccion.descripcion]]</h4>
            <div class="col-sm-12">
                <h1>[[x.comite.descripcion]]</h1>
                <h3><b>Selecciona [[x.comite.seleccionable]] <span ng-show="x.comite.seleccionable!=1">candidatos</span><span ng-show="x.comite.seleccionable==1">candidato</span></b></h3>
            <h4>Seleccione el candidato de su preferencia, tenga en cuenta que luego de seleccionado el candidato y presionado el botón "votar" no se podrá retroceder</h4> 
            </div>

            <div class="card" ng-repeat="candidato in x.candidatos">
                <img ng-click="cargarVoto($event, x.comite.seleccionable)" id="[[candidato.id]]-[[x.id_comite]]" src="../images/user.png" alt="Avatar" style="width:100%">
                <div>
                    <h4><b>[[candidato.habitante.nombre]]<br>[[candidato.habitante.apellido]]</b></h4> 
                    <p>Cedula: [[candidato.habitante.nacionalidad]]-[[candidato.habitante.cedula]]</p>
                </div>
            </div>
            
            <div class="row text-center">
                    <button ng-click="pasarPagina()" ng-disabled="button_disabled" style="margin-top: 20px;font-size: 3em;" type="button" class="btn btn-lg btn-primary btn-block">VOTAR</button>
            </div>
        </div>
    </div>
    
     <script src="../js/please-wait.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/angular.min.js"></script>
    <script src="../js/angular-cookies.js"></script>
    <script src="../js/fancywebsocket.js"></script>

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

            window.loading_screen = window.pleaseWait({
                logo: "https://cdn1.iconfinder.com/data/icons/hawcons/32/698959-icon-114-lock-128.png",
                backgroundColor: '#ffffff',
                loadingHtml: "<h1>PANTALLA BLOQUEADA</h1><br><p>Para desbloquear la pantalla, por favor, dirijase al operador</p>"
              });

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

            $rootScope.Server = null;
        
            $rootScope.send= function ( text ) {
                $rootScope.Server.send( 'message', text );
            };

            angular.element(document).ready(function() {
                $rootScope.Server = new FancyWebSocket('ws://127.0.0.1:9000');
                
                $rootScope.Server.bind('open', function() {
                    console.log( "Conectado." );
                });
                //OH NOES! Disconnection occurred.
                $rootScope.Server.bind('close', function( data ) {
                    console.log( "Disconnected." );
                });
                //Log any messages sent from server
                $rootScope.Server.bind('message', function( payload ) {
                    console.log( payload );
                    if(payload=="desbloquear") {
                        window.loading_screen.finish();
                        $rootScope.send("desbloqueada");
                        
                    }
                });
                $rootScope.Server.connect();

            });


            $rootScope.cargarVoto = function(event, cant) {
                if($('#' + event.target.id).hasClass("checked")) {
                    $('#' + event.target.id).removeClass("checked");
                    $rootScope.button_disabled = true;
                    $rootScope.contador--;
                } else {
                    if($rootScope.contador<cant) {
                        $('#' + event.target.id).addClass("checked");
                        $rootScope.contador++;
                        if($rootScope.contador==cant) {
                            $rootScope.button_disabled = false;
                        }
                    } 
                }
            };

            $rootScope.pasarPagina = function() {
                if($rootScope.begin + 1 == $rootScope.data.comite.length) {
                    $rootScope.proceso_finalizado = true;
                    $( ".checked" ).each(function( index ) {
                        $rootScope.votos.push(this.id);
                    });
                    $rootScope.guardarVotacion();
                } else {
                    $rootScope.begin++;
                    $rootScope.contador = 0;
                    $rootScope.button_disabled = true;
                    $( ".checked" ).each(function( index ) {
                        $rootScope.votos.push(this.id);
                    });
                }
            };

            $rootScope.guardarVotacion = function() {
                setTimeout(function() {
                    $rootScope.send("bloqueada");
                    window.location.reload();
                }, 5000);
                
                

                for (var i = 0; i < $rootScope.votos.length; i++) {
                    var data = $rootScope.votos[i].split("-");   
                    var id_candidato = data[0];
                    var id_comite = data[1];
                    var data = {
                        id_candidato: id_candidato,
                        id_comite: id_comite,
                        id_periodo: $rootScope.proceso_activo
                    };

                    $rootScope.post('voto', data, $rootScope.token).then(function(response) {
                        console.log(response);
                    });
                }
            };

            $rootScope.get('boletin/' + $rootScope.id_eleccion).then(function(response) {
                if(response.status==200) {
                    $rootScope.data = response.data;
                    $rootScope.proceso_activo = $rootScope.data.id;
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