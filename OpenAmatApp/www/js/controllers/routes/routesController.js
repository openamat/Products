/**
 * Created by antoninotocco on 16/07/16.
 */
ControllersModule.controller('RoutesController', ['$scope', '$controller', 'Routes', function ($scope, $controller, Routes) {
  angular.extend(this, $controller('baseController', {$scope: $scope}));

  var loadContent = function () {
    Routes.getAll()
      .then(function (routes) {
        $scope.routes = routes;
      });
  };

  $scope.$on('$ionicView.enter', function () {
    loadContent();
  });
}]);
