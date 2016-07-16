/**
 * Created by antoninotocco on 16/07/16.
 */
ControllersModule.controller('RouteController', ['$scope', '$controller', '$stateParams', 'Routes', 'Stops', function ($scope, $controller, $stateParams, Routes, Stops) {
  angular.extend(this, $controller('baseController', {$scope: $scope}));

  var loadContent = function () {
    var routeId = $stateParams.routeId;
    var routeShortName = $stateParams.routeShortName;
    $scope.routeShortName = routeShortName;
    Routes.getDirections(routeId)
      .then(function (directions) {
        _.each(directions, function (direction) {
          Stops.getRouteStops(routeId, direction.direction_id)
            .then(function (stops) {
              direction.stops = stops;
              $scope.directions.push(direction);
            });
        });
      });
  };
  $scope.toggleGroup = function(group) {
    if ($scope.isGroupShown(group)) {
      $scope.shownGroup = null;
    } else {
      $scope.shownGroup = group;
    }
  };
  $scope.isGroupShown = function(group) {
    return $scope.shownGroup === group;
  };
  $scope.directions = [];
  $scope.$on('$ionicView.enter', function () {
    loadContent();
  })
}]);
