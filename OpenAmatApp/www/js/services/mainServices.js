/**
 * Created by antoninotocco on 16/07/16.
 */
var ModelModule = angular.module('ModelModule', ['BaseServicesModule'])
  .service('Routes', [ 'QueryEngine', '$q', function (QueryEngine, $q) {
    var module = {};

    module.getAll = function () {
      var deferred = $q.defer();
      QueryEngine.getAllRoutes(function (result) {
        if(result.data.resultCode === 'OK') {
          deferred.resolve(result.data.resultObj);
        } else {
          deferred.reject(result.data.error);
        }
      });
      return deferred.promise;
    };

    module.getDirections = function (routeId) {
      var deferred = $q.defer();
      QueryEngine.getRouteDirections(routeId, function (result) {
        if(result.data.resultCode === 'OK') {
          deferred.resolve(result.data.resultObj);
        } else {
          deferred.reject(result.data.error);
        }
      });
      return deferred.promise;
    };
    return module;
  }])
  .service('Stops', ['QueryEngine', '$q', function (QueryEngine, $q) {
    var module = {};

    module.getAll = function () {
      var deferred = $q.defer();
      QueryEngine.getAllStops(function (result) {
        if(result.data.resultCode === 'OK') {
          deferred.resolve(result.data.resultObj);
        } else {
          deferred.reject(result.data.error);
        }
      });
      return deferred.promise;
    };

    module.getRouteStops = function (routeId, directionId) {
      var deferred = $q.defer();
      QueryEngine.getRouteStops(routeId, directionId,
        function (result) {
         if(result.data.resultCode === 'OK') {
           deferred.resolve(result.data.resultObj);
         } else {
           deferred.reject(result.data.error);
         }
        });
      return deferred.promise;
    };

    return module;
  }]);
