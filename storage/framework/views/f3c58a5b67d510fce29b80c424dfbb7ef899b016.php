<!DOCTYPE html>
<html lang="en" ng-app="siccas">
<head>
    <meta charset="UTF-8">
    <title>SICCAS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body ng-controller="MainController">
    <form ng-submit="login()">
        <table>
            <tr>
                <td>Usuario:</td>
                <td><input type="text" ng-model="data_login.email"></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type="password" ng-model="data_login.password"></td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Ingresar</button>
                </td>
            </tr>
        </table>
    </form>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/angular-cookies.js"></script>
    <script src="js/angular-resource.js"></script>
    <script src="js/angular-route.js"></script>
    <script src="js/app.js"></script>
</body>
</html>