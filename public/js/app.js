var app = angular.module('siccas', ['ngRoute', 'ngCookies', 'ngResource'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
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

app.run(function($rootScope, auth) {
    $rootScope.$on('$routeChangeStart', function() {
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
                window.location.href = "inicio.html";
            }
        }, function(error) {
            console.error(error);
        });


    }
});

app.controller('Inicio', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {

});

app.controller('Candidato', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {
    $rootScope.get('candidato', $cookieStore.get('token')).then(function(response) {
        // aqui va entrar cuadndo te de una respuesta
        if (response.status == 200) {
            $scope.candidatos = response.data;
        } else {
            $rootScope.candidatos = null;
        }
    }, function(error) {
        console.error(error);
    });
});


app.controller('Habitante', function($rootScope, $scope, $http, $location, $window, $q, $cookieStore, auth) {

    $scope.seleccionarTodos = function() {
        $rootScope.get('habitante', $cookieStore.get('token')).then(function(response) {
            if (response.status == 200) {
                $scope.habitantes = response.data;
            } else {
                $scope.habitantes = null;
            }

        }, function(error) {
            console.error(error);
        });
    };

    $scope.seleccionarTodos();


    $scope.habitante = null;
    $scope.accion = "agregar";
    $scope.agregar = function() {
        $rootScope.post('habitante', $scope.habitante, $cookieStore.get('token')).then(function(response) {
            if(response.status==200) {
                $scope.mensaje = "agregado correctamente";
                $scope.seleccionarTodos();
                $scope.habitante = null;

            } else {
                $scope.mensaje = "No se ha agregado";
            }
        }, function(error) {
            console.error(error);
        });
    };

    $scope.seleccionar = function(habitante) {
        $scope.mensaje = "";
        $scope.habitante = habitante;
        $scope.accion = "editar";
    };
    $scope.editar = function() {
        $rootScope.put('habitante/' + $scope.habitante.id, $scope.habitante, $cookieStore.get('token')).then(function(response) {
            if (response.status == 200) {
                $scope.habitante = response.data;
                $scope.mensaje = "Modificado";
            } else {
                $scope.mensaje = "No Modificado";
            }

        }, function(error) {
            console.error(error);
            $scope.mensaje = "Ha ocurrido un error";
        });
    };

    $scope.eliminar = function() {


        if (confirm("Desea eliminar")) {
            $rootScope.delete('habitante/' + $scope.habitante.id, $cookieStore.get('token')).then(function(response) {
                if (response.status == 200) {
                    $scope.habitante = null;
                    $scope.seleccionarTodos();
                } else {
                    $scope.mensaje = "No eliminado";
                }
            }, function(error) {
                console.error(error);
                $scope.mensaje = "Ha ocurrido un error";
            });
        }

    }
});