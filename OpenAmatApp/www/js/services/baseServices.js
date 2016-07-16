/**
 * Created by antoninotocco on 16/07/16.
 */
var BaseServicesModule = angular.module('BaseServicesModule', [])
  .service('Constants', [function () {
    return {

    }
  }])
  .service('HttpService', ['$http', function ($http) {
    var module = {};

    module.get = function (url, success, error) {
      $http({
          method: 'GET',
          url: url
      }).then(success, error);
    };
    module.post = function (url, data, success, error) {
      $http({
        method: 'POST',
        url: url,
        data: data
      }).then(success, error);
    };
    module.put = function (url, data, success, error) {
      $http({
        method: 'PUT',
        url: url,
        data: data
      }).then(success, error);
    };
    module.delete = function (url, success, error) {
      $http({
        method: 'DELETE',
        url: url
      }).then(success, error);
    };
    return module;
  }])
  .service('QueryEngine', ['HttpService', function (HttpService) {
    var baseUrl = 'http://192.168.1.128:3000/';
    var allRoutesUrl = baseUrl + 'routes';
    var allStopsUrl = baseUrl + 'stops';
    var routeDirectionsUrl = allRoutesUrl + '/directions/:ROUTE_ID';
    var routeStopsUrl = allStopsUrl + '/:ROUTE_ID/:DIRECTION_ID';

    var module = {};

    module.getAllRoutes = function (success, error) {
      HttpService.get(allRoutesUrl, success, error);
    };
    module.getRouteDirections = function(routeId, success, error) {
      var url = routeDirectionsUrl
        .replace(':ROUTE_ID', routeId);
      HttpService.get(url, success, error);
    };
    module.getAllStops = function (success, error) {
      HttpService.get(allStopsUrl, success, error);
    };
    module.getRouteStops = function (routeId, directionId, success, error) {
      var url = routeStopsUrl
        .replace(':ROUTE_ID', routeId)
        .replace(':DIRECTION_ID', directionId);
      HttpService.get(url, success, error);
    };
    return module;
  }]);
