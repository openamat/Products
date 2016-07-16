/**
 * Created by antoninotocco on 16/07/16.
 */
var fs = require('fs');
var path = require('path');
var _ = require('lodash');
var find = require('lodash.find');
var dataPath = path.join(process.cwd(), 'data');
_.find = find;
//region Helper Method
var getAllRoutes = function (successCallback, errorCallback) {
    fs.readFile(path.join(dataPath, 'routes.json'), 'utf-8', function (err, data) {
        if(err) {
            console.log(err);
            errorCallback(err);
        }
        var routes = JSON.parse(data);
        fs.readFile(path.join(dataPath, 'route_type.json'), 'utf-8', function (err, data) {
            if(err) {
                console.log(err);
                errorCallback(err);
            }
            var routeTypes = JSON.parse(data);
            _.each(routes, function (route) {
                var routeType = _.find(routeTypes, function (routeType) {
                    return routeType.route_type === route.route_type;
                });
                route.route_type_name = routeType.route_type_name;
                route.route_type_desc = routeType.route_type_desc;
            });
            successCallback(routes);
        });

    });
};
//endregion
//region ROUTE CONFIG
var allRoutes = {
    method: 'GET',
    path: '/routes',
    handler: function (request, reply) {
        getAllRoutes(function (data) {
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

var routes = {
    allRoutes: allRoutes
};

module.exports = routes;
//endregion