/**
 * Created by antoninotocco on 16/07/16.
 */
var fs = require('fs');
var path = require('path');
var _ = require('lodash');
var find = require('lodash.find');
var dataPath = path.join(process.cwd(), 'data');
_.find = find;
//region HELPER METHODS
var getAllStops = function (successCallback, errorCallback) {
    fs.readFile(path.join(dataPath, 'stops.json'), 'utf-8', function (err, data) {
        if(err) {
            console.log(err);
            errorCallback(err);
        }
        var stops = JSON.parse(data);
        successCallback(stops);
    });
};
var getRouteStops = function (routeId, directionId, successCallback, errorCallback) {
    fs.readFile(path.join(dataPath, 'route_stops.json'), 'utf-8', function (err, data) {
       if(err) {
           console.log(err);
           errorCallback(err);
       }
       var allRouteStops = JSON.parse(data);
       var routeStops = _.filter(allRouteStops, function (routeStop) {
            return routeStop.route_id === routeId && routeStop.direction_id === directionId;
       });
       routeStops = _.sortBy(routeStops, ['order']);
        fs.readFile(path.join(dataPath, 'stops.json'), 'utf-8', function (err, data) {
           if(err) {
               console.log(err);
               errorCallback(err);
           }
            var allStops = JSON.parse(data);
            _.each(routeStops, function (routeStop) {
                var stop = _.find(allStops, {stop_id: routeStop.stop_id});
                if(stop) {
                    routeStop.stop_code = stop.stop_code;
                    routeStop.stop_name = stop.stop_name;
                    routeStop.stop_lat = stop.stop_lat;
                    routeStop.stop_lon = stop.stop_lon;
                }
            });
            successCallback(routeStops);
        });
    });
};
//endregion
//region ROUTE CONFIG
var allStops = {
    method: 'GET',
    path: '/stops',
    handler: function (request, reply) {
        getAllStops(function (data) {
            reply({
                resultCode: 'OK',
                resultObj: data
            });
        },function (err) {
            reply({
                resultCode: 'KO',
                error: err
            })
        });
    }
};
var routeStops = {
    method: 'GET',
    path: '/stops/{routeId}/{directionId}',
    handler: function (request, reply) {
        var routeId = request.params.routeId;
        var directionId = request.params.directionId !== undefined ? parseInt(request.params.directionId) : 0;
        getRouteStops(
            routeId,
            directionId,
            function (data) {
                reply({
                    resultCode: 'OK',
                    resultObj: data
                });
            }, function (err) {
                reply({
                    resultCode: 'KO',
                    error: err
                })
            });
    }
};
var stops = {
    allStops: allStops,
    routeStops: routeStops
};

module.exports = stops;