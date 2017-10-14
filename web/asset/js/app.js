angular
.module('AuthApp', ['ngMaterial', 'ngMessages'])
.config(function($interpolateProvider) {
$interpolateProvider.startSymbol('{[{').endSymbol('}]}');
})
.controller('LoginCtrl', function($scope, $http) {
})
.controller('RegCtrl', function($scope) {
})
.controller('EmailCtrl', function($scope, $http, $timeout) {
    $scope.user = {
      email: ""
    };
    $scope.show_success = false;
    $scope.initial = function(){
        $http({
            url: '/api/email',
            method: "GET",
        }).success(function (data) {
            $scope.user.email = data.email
        });
    }
    $scope.initial();
    
    $scope.updateEmail = function(){
        $http({
            url: '/api/email',
            method: "POST",
//            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data:{
                email: $scope.user.email,
            }
        }).success(function (data) {
            $scope.user.email = data.email;
            $scope.show_success = true;
            $timeout(function(){
                $scope.show_success = false;
            }, 5000)
        });
    }
});
  