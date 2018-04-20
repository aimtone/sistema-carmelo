var app = angular.module('siccas', ['ngRoute', 'ngCookies', 'ngResource'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});
app.directive('ngEnter', function() {
    return function(scope, element, attrs) {
        element.bind("keydown keypress", function(event) {
            if (event.which === 13) {
                scope.$apply(function() {
                    scope.$eval(attrs.ngEnter);
                });

                event.preventDefault();
            }
        });
    };
});
app.directive('ngRightClick', function($parse) {
    return function(scope, element, attrs) {
        var fn = $parse(attrs.ngRightClick);
        element.bind('contextmenu', function(event) {
            scope.$apply(function() {
                event.preventDefault();
                fn(scope, { $event: event });
            });
        });
    };
});
app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'templates/inicio.html?ver=1.0',
            controller: 'Inicio'
        })
        .when('/habitante', {
            templateUrl: 'templates/habitante.html?ver=1.0',
            controller: 'Habitante'
        })
        .when('/comite', {
            templateUrl: 'templates/comite.html?ver=1.0',
            controller: 'Comite'
        })
        .when('/eleccion', {
            templateUrl: 'templates/eleccion.html?ver=1.0',
            controller: 'Eleccion'
        })
        .when('/cargo', {
            templateUrl: 'templates/cargo.html?ver=1.0',
            controller: 'Cargo'
        })
        .when('/candidato', {
            templateUrl: 'templates/candidato.html?ver=1.0',
            controller: 'Candidato'
        })
        .when('/periodo', {
            templateUrl: 'templates/periodo.html?ver=1.0',
            controller: 'Periodo'
        })
        .when('/proceso/:guid', {
            templateUrl: 'templates/proceso.html?ver=1.0',
            controller: 'Proceso'
        })
        .otherwise({
            redirectTo: '/'
        });

    // $locationProvider.html5Mode(true);
});


app.factory("auth", function($cookies, $cookieStore, $location, $rootScope) {
    return {
        login: function(data) {},
        logout: function() {},
        checkStatus: function() {},
        valid: function() {

        }
    }
});

app.run(function($rootScope, auth, $cookieStore) {
    $rootScope.$on('$routeChangeStart', function() {
        $rootScope.current_user = $cookieStore.get('current_user');
        console.log($rootScope.current_user);
        auth.checkStatus();
        auth.valid();
    })
});

app.controller('MainController', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $rootScope.host_uri = 'http://localhost:8080/api/';
    $rootScope.proceso_activo = null;

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

    $rootScope.put = function(url, data, token = "") {
        var defered = $q.defer();
        var promise = defered.promise;
        $http.put($rootScope.host_uri + url, data, {
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

    $rootScope.delete = function(url, token = "") {
        var defered = $q.defer();
        var promise = defered.promise;
        $http.delete($rootScope.host_uri + url, {
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

    $rootScope.send = function(text) {
        $rootScope.Server.send('message', text);
    };

    angular.element(document).ready(function() {
        $rootScope.Server = new FancyWebSocket('ws://127.0.0.1:9000');

        $rootScope.Server.bind('open', function() {
            console.log("Conectado.");
        });
        //OH NOES! Disconnection occurred.
        $rootScope.Server.bind('close', function(data) {
            console.log("Disconnected.");
        });
        //Log any messages sent from server
        $rootScope.Server.bind('message', function(payload) {
            console.log(payload);
            if(payload=="desbloqueada") {
                $('#mensaje').html("Pantalla desbloqueada");
            }
            if(payload=="bloqueada") {
                $('#mensaje').html("Pantalla bloqueada");
            }



        });
        $rootScope.Server.connect();

    });

    $rootScope.datepicker = function(minDate = null, maxDate = null) {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: false,
            changeMonth: false,
            changeYear: false,
            minDate: minDate,
            maxDate: maxDate,
            inline: true
        });

        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
    };

    $rootScope.openModal = function(accion, data) {
        $('#basicModal').modal('toggle');

        if (typeof data === "undefined") {
            // agregera
            $rootScope.data = {};
            $rootScope.agregar = true;
        } else {
            // modificar
            $rootScope.data = data;
            $rootScope.agregar = false;
        }
    };

    $rootScope.closeModal = function() {
        $('#basicModal').modal('toggle');
        $rootScope.data = {};
        $rootScope.agregar = true;
    };


    $rootScope.limit = 10;
    $rootScope.cantPaginador = 10;
    $rootScope.current_page = 1;
    $rootScope.begin = 0;
    $rootScope.numPages = [];
    $rootScope.allPages = true;

    $rootScope.seleccionarTodos = function(tabla) {
        $rootScope.get(tabla, $cookieStore.get('token')).then(function(response) {
            if (response.status == 200) {
                $rootScope.datas = response.data.data;
                $rootScope.foreign = response.data.foreign;
                $rootScope.cantPages = $rootScope.datas.length / $rootScope.limit;

                if ($rootScope.cantPages <= $rootScope.cantPaginador) {
                    $rootScope.allPages = true;
                    for (var i = 0; i < $rootScope.cantPages; i++) {
                        $rootScope.numPages.push(i + 1);
                    }
                } else {
                    $rootScope.allPages = false;
                    for (var i = 0; i < $rootScope.cantPaginador; i++) {
                        $rootScope.numPages.push(i + 1);
                    }
                }


                console.log($rootScope.foreign);
            } else {
                $rootScope.datas = null;
            }
        }, function(error) {
            console.error(error);
        });
    };

    $rootScope.cambiarPagina = function(numPage) {


        $rootScope.current_page = numPage;
        $rootScope.diferencia = numPage - $rootScope.cantPages;


        if (numPage < 6) {

            if ($rootScope.cantPages > $rootScope.cantPaginador) {
                $rootScope.numPages = [];
                for (var i = 0; i < $rootScope.cantPaginador; i++) {
                    $rootScope.numPages.push(i + 1);
                }
            }


        }

        if (numPage >= 6) {

            if (numPage + 5 >= $rootScope.cantPages) {

                $rootScope.numPages = [];
                for (var i = numPage - 5; i < $rootScope.cantPages; i++) {
                    $rootScope.numPages.push(i + 1);
                }

            } else {
                $rootScope.numPages = [];
                for (var i = numPage - 5; i < numPage + 5; i++) {
                    $rootScope.numPages.push(i + 1);
                }
            }



        }
        $rootScope.begin = (numPage - 1) * $rootScope.limit;
    };

    $rootScope.guardarCambios = function(tabla, data) {
        console.log($rootScope.agregar);
        if ($rootScope.agregar) {
            $rootScope.post(tabla, data, $cookieStore.get('token')).then(function(response) {
                if (response.status == 200) {
                    $rootScope.seleccionarTodos(tabla);
                    $rootScope.closeModal();
                }
            }, function(error) {
                console.error(error);
            });
        } else {
            $rootScope.put(tabla + '/' + data.id, data, $cookieStore.get('token')).then(function(response) {
                if (response.status == 200) {
                    $rootScope.seleccionarTodos(tabla);
                    $rootScope.closeModal();
                }
            }, function(error) {
                console.error(error);
            });
        }
    };

    $rootScope.eliminar = function(tabla, id) {
        swal({
                title: "¿Estás seguro de que deseas suprimir este registro?",
                text: "Una vez eliminado, no podrás ver mas el registro en la tabla",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                cancelButtonText: "Cancelar"
            })
            .then((willDelete) => {
                if (willDelete) {
                    $rootScope.delete(tabla + '/' + id, $cookieStore.get('token')).then(function(response) {
                        if (response.status == 200) {
                            $rootScope.seleccionarTodos(tabla);
                        } else {
                            swal("Ocurrio un error y el registro no fue eliminado", {
                                icon: "success",
                            });
                        }
                    }, function(error) {
                        console.error(error);
                        swal("Ocurrio un error y el registro no fue eliminado", {
                            icon: "success",
                        });
                    });
                } else {
                    //
                }
            });
    };

    $rootScope.verificarProcesos = function() {
        $rootScope.get('periodo', $cookieStore.get('token')).then(function(response) {
            if (response.status == 200) {
                for (var i = 0; i < response.data.data.length; i++) {
                    if (response.data.data[i]['activo'] == "1") {
                        $rootScope.proceso_activo = response.data.data[i];
                        break;
                    } else {
                        $rootScope.proceso_activo = null;
                    }
                }
            } else {
                $rootScope.proceso_activo = null;
            }
        });
    };

    $rootScope.verificarProcesos();


});

app.controller('Inicio', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {

});

app.controller('Proceso', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth, $routeParams) {
    $scope.guid = $routeParams.guid;
    $rootScope.seleccionarTodos('participacion');
    $scope.button_desbloquear_pantalla = true;
    $rootScope.mesa_bloqueada = true;
    //$rootScope.foreign
    $scope.desbloquearPantalla = function() {
        var votado = false;
        for (var i = 0; i < $rootScope.datas.length; i++) {
            if ($rootScope.datas[i].id_habitante.toString() == $rootScope.data.id_habitante.toString() && $rootScope.datas[i].id_periodo.toString() == $rootScope.proceso_activo.id.toString()) {
                swal({ title: "Alerta", text: "Este habitante ya ha votado", icon: "warning" });
                $rootScope.closeModal();
                votado = true;
                break;
            } else {
                votado = false;
            }
        }

        if (!votado) {
            $rootScope.post('participacion', { id_habitante: $rootScope.data.id_habitante, id_periodo: $rootScope.proceso_activo.id }, $cookieStore.get('token')).then(function(response) {
                if (response.status == 200) {
                    $rootScope.send("desbloquear");
                    $rootScope.closeModal();
                    $rootScope.seleccionarTodos('participacion');
                    swal({ title: "Mesa abierta", text: "El habitante esta votando ahora, por favor, espera", icon: "success" });
                } else {
                    swal({ title: "Alerta", text: "No se ha realizado la accion", icon: "warning" });
                }
            }, function(error) {
                swal({ title: "Alerta", text: "Ha ocurrido un error desconocido", icon: "warning" });
            });;
        }
    };

    $scope.buscarHabitantePorCedula = function() {
        $rootScope.data.cedula = $rootScope.data.cedula.split("-");
        var encontrado = false;
        for (var i = 0; i < $rootScope.foreign.habitante.length; i++) {
            if ($rootScope.foreign.habitante[i].nacionalidad == $rootScope.data.cedula[0] && $rootScope.foreign.habitante[i].cedula == $rootScope.data.cedula[1]) {
                $rootScope.data.id_habitante = $rootScope.foreign.habitante[i].id;
                $scope.nombres = $rootScope.foreign.habitante[i].nombre;
                $scope.apellidos = $rootScope.foreign.habitante[i].apellido;
                $rootScope.data.cedula = $rootScope.data.cedula.join("-");
                encontrado = true;
                $scope.button_desbloquear_pantalla = false;
                break;
            }
        }

        if (!encontrado) {
            $rootScope.data.cedula = $rootScope.data.cedula.join("-");
            $rootScope.data.id_habitante = null;
            $scope.nombres = null;
            $scope.apellidos = null;
            $scope.button_desbloquear_pantalla = false;
            $rootScope.closeModal();
            swal({ title: "Alerta", text: "Este habitante no esta registrado", icon: "warning" });
        }
    };
});
app.controller('Candidato', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'candidato';
    $rootScope.numPages = [];
    $rootScope.seleccionarTodos($scope.tabla);

    $scope.obtenerPeriodos = function() {
        $rootScope.periodo_filtrado = [];
        $rootScope.data.id_eleccion = $rootScope.data.id_eleccion.id;
        var contador = 0;
        for (var i = 0; i < $rootScope.foreign.periodo.length; i++) {
            if ($rootScope.foreign.periodo[i].id == $rootScope.data.id_eleccion) {
                $rootScope.periodo_filtrado[contador] = $rootScope.foreign.periodo[i];
                contador++;
            }
        }
    };
    $scope.obtenerComites = function() {
        $rootScope.comite_filtrado = [];
        console.log($rootScope.foreign.comite);
        var contador = 0;
        for (var i = 0; i < $rootScope.foreign.comite.length; i++) {
            if ($rootScope.foreign.comite[i].id_eleccion == $rootScope.data.id_eleccion) {
                $rootScope.comite_filtrado[contador] = $rootScope.foreign.comite[i];
                contador++;
            }
        }

    };

    $scope.inscribirCandidato = function(tabla, data) {
        console.log($rootScope.agregar);
        if ($rootScope.agregar) {
            $rootScope.post(tabla, data, $cookieStore.get('token')).then(function(response) {
                if (response.status == 200) {
                    $rootScope.seleccionarTodos(tabla);
                    $rootScope.comite_filtrado = [];
                    $rootScope.periodo_filtrado = [];
                    $scope.nombres = null;
                    $scope.apellidos = null;
                    $rootScope.closeModal();
                }
            }, function(error) {
                console.error(error);
            });
        } else {
            $rootScope.put(tabla + '/' + data.id, data, $cookieStore.get('token')).then(function(response) {
                if (response.status == 200) {
                    $rootScope.seleccionarTodos(tabla);
                    $rootScope.comite_filtrado = [];
                    $rootScope.periodo_filtrado = [];
                    $scope.nombres = null;
                    $scope.apellidos = null;
                    $rootScope.closeModal();
                }
            }, function(error) {
                console.error(error);
            });
        }
    };

    $scope.buscarHabitantePorCedula = function() {
        $rootScope.data.cedula = $rootScope.data.cedula.split("-");
        var encontrado = false;
        for (var i = 0; i < $rootScope.foreign.habitante.length; i++) {
            if ($rootScope.foreign.habitante[i].nacionalidad == $rootScope.data.cedula[0] && $rootScope.foreign.habitante[i].cedula == $rootScope.data.cedula[1]) {
                $rootScope.data.id_habitante = $rootScope.foreign.habitante[i].id;
                $scope.nombres = $rootScope.foreign.habitante[i].nombre;
                $scope.apellidos = $rootScope.foreign.habitante[i].apellido;
                $rootScope.data.cedula = $rootScope.data.cedula.join("-");
                encontrado = true;
                break;
            }
        }

        if (!encontrado) {
            $rootScope.data.cedula = $rootScope.data.cedula.join("-");
            $rootScope.data.id_habitante = null;
            $scope.nombres = null;
            $scope.apellidos = null

            ;
        }
    };
});
app.controller('Habitante', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'habitante';
    $rootScope.numPages = [];
    $rootScope.datepicker(null, '-1D');
    $rootScope.seleccionarTodos($scope.tabla);
});
app.controller('Comite', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'comite';
    $rootScope.numPages = [];
    $rootScope.seleccionarTodos($scope.tabla);
});
app.controller('Eleccion', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'eleccion';
    $rootScope.numPages = [];
    $rootScope.seleccionarTodos($scope.tabla);
});
app.controller('Cargo', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'cargo';
    $rootScope.numPages = [];
    $rootScope.seleccionarTodos($scope.tabla);

});
app.controller('Periodo', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'periodo';
    $rootScope.numPages = [];
    $rootScope.datepicker('+1D');
    $rootScope.seleccionarTodos($scope.tabla);

    $scope.iniciarProceso = function(id) {
        swal({
                title: '¿Estás seguro que deseas iniciar este proceso?',
                text: "Una vez iniciado el proceso de elección, no se podrá revertir la acción hasta la hora de cierre, ¿Desea continuar?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                cancelButtonText: "Cancelar"
            })
            .then((willDelete) => {
                if (willDelete) {
                    $rootScope.put($scope.tabla + "/" + id, { activo: 1 }, $cookieStore.get('token')).then(function(response) {
                        if (response.status == 200) {
                            $rootScope.verificarProcesos();
                            $rootScope.seleccionarTodos($scope.tabla);
                        }

                    });
                }
            });

    };

    $scope.cerrarProceso = function(id) {
        swal({
                title: '¿Estás seguro que deseas cerrar este proceso?',
                text: "Una vez cerrado el proceso de elección, no se podrá revertir la acción hasta, por lo tanto, no se permitirá nuevos votantes y la elección se considerará terminada, ¿Desea continuar?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                cancelButtonText: "Cancelar"
            })
            .then((willDelete) => {
                if (willDelete) {
                    $rootScope.put($scope.tabla + "/" + id, { activo: 0, realizado: 1 }, $cookieStore.get('token')).then(function(response) {
                        if (response.status == 200) {
                            $rootScope.seleccionarTodos($scope.tabla);
                            $rootScope.proceso_activo = null;
                        }

                    });
                }
            });

    };

    $scope.verResultados = function(id) {
        $rootScope.get('resultados/' + id, $cookieStore.get('token')).then(function(response) {
            console.log(response);
        });
    };


});