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


    $rootScope.seleccionarTodos = function(tabla) {
        $rootScope.get(tabla, $cookieStore.get('token')).then(function(response) {
            if (response.status == 200) {
                $rootScope.datas = response.data.data;
                $rootScope.foreign = response.data.foreign;

                console.log($rootScope.foreign);
            } else {
                $rootScope.datas = null;
            }
        }, function(error) {
            console.error(error);
        });
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
                confirmButtonText: "Cancelar",
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
                    swal("Ocurrio un error y el registro no fue eliminado", {
                        icon: "success",
                    });
                }
            });
    }


});

app.controller('Inicio', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {

});
app.controller('Candidato', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'candidato';
    $rootScope.seleccionarTodos($scope.tabla);

    $scope.obtenerPeriodos = function() {
        $rootScope.periodo_filtrado = [];
        $rootScope.data.id_eleccion = $rootScope.data.id_eleccion.id;
        var contador = 0;
        for (var i = 0; i < $rootScope.foreign.periodo.length; i++){
          if ($rootScope.foreign.periodo[i].id == $rootScope.data.id_eleccion){
            $rootScope.periodo_filtrado[contador] = $rootScope.foreign.periodo[i];
            contador++;
          }
        }
    };

     $scope.buscarHabitantePorCedula = function() {
        $rootScope.data.cedula = $rootScope.data.cedula.split("-");
        var encontrado = false;
        for (var i = 0; i < $rootScope.foreign.habitante.length; i++){
          if ($rootScope.foreign.habitante[i].nacionalidad == $rootScope.data.cedula[0] && $rootScope.foreign.habitante[i].cedula == $rootScope.data.cedula[1] ){
            $rootScope.data.id_habitante = $rootScope.foreign.habitante[i].id;
            $scope.nombres = $rootScope.foreign.habitante[i].nombre;
            $scope.apellidos = $rootScope.foreign.habitante[i].apellido;
            $rootScope.data.cedula = $rootScope.data.cedula.join("-");
            encontrado = true;
            break;
          } 
        }

        if(!encontrado) {
            $rootScope.data.cedula = $rootScope.data.cedula.join("-");
            $rootScope.data.id_habitante = null;
            $scope.nombres = null;
            $scope.apellidos = null;
        }
    };
});
app.controller('Habitante', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'habitante';
    $rootScope.seleccionarTodos($scope.tabla);
});
app.controller('Comite', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'comite';
    $rootScope.seleccionarTodos($scope.tabla);
});
app.controller('Eleccion', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'eleccion';
    $rootScope.seleccionarTodos($scope.tabla);
});
app.controller('Cargo', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'cargo';
    $rootScope.seleccionarTodos($scope.tabla);

});
app.controller('Periodo', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $scope.tabla = 'periodo';
    $rootScope.seleccionarTodos($scope.tabla);

});