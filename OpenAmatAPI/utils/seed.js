/**
 * Created by antoninotocco on 16/07/16.
 */
var exporter = require('pg-json-data-export');
var _ = require('lodash');
var fs = require('fs');
var path = require('path');
var mkdirp = require('mkdirp');
var Parse = require('parse/node');
var Moment = require('moment');
var dataPath = path.join(process.cwd(), 'data');
var connection = {
    host: 'localhost',
    username: 'entony',
    database: 'openamat'
};
var schema = 'public';
Parse.initialize('openamat');
Parse.serverURL = 'http://localhost:1337/parse';
//region Modelli
var Route = Parse.Object.extend('Route');
var Stop = Parse.Object.extend('Stop');
var Trip = Parse.Object.extend('Trip');
var Fare = Parse.Object.extend('Fare');
var Direction = Parse.Object.extend('Direction');
//endregion

//region CREATE COLLECTIONS
var createRoutes = function () {
    var promise = Parse.Promise.as();
    var createRoute = function (promise, route) {
        return promise.then(function () {
            var newRoute = new Route();
            _.each(route, function (value, key) {
                newRoute.set(key, value);
            });
            var queryDirections = new Parse.Query(Direction);
            queryDirections.equalTo('route_id', route.route_id);
            queryDirections.find().then(function (directions) {
                var relation = newRoute.relation("directions");
                relation.add(directions);
                return newRoute.save();
            });
        });
    };
    fs.readFile(path.join(dataPath, 'routes.json'), 'utf-8', function (err, data) {
        if(err) {
            console.log(err);
        }
        var routes = JSON.parse(data);
        console.log("Routes length -> " + routes.length);
        routes.forEach(function (route) {
           promise =  createRoute(promise, route);
        });
    });
    return promise;
};
var createRouteDirections = function () {
    var promise = Parse.Promise.as();
    var createDirection = function (promise, direction, allRouteStops) {
        return promise.then(function () {
            var routeStops = _.sortBy(_.filter(allRouteStops, {route_id: direction.route_id}), 'order');
            var newDirection = new Direction();
            _.each(direction, function (value, key) {
                newDirection.set(key, value);
            });
            routeStops.forEach(function (stop) {
                var queryStop = new Parse.Query(Stop);
                queryStop.equalTo('stop_id', stop.stop_id);
                queryStop.find().then(function (stop) {
                    var relation = newDirection.relation("stops");
                    console.log(stop);
                    relation.add(stop);
                    console.log("Direction with direction_id " + newDirection.get('direction_id'));
                    return newDirection.save();
                });
            });
        });
    };
    fs.readFile(path.join(dataPath, 'route_directions.json'), 'utf-8', function (err, data) {
        if (err) {
            console.log(err);
        }
        var directions = JSON.parse(data);
        console.log("Directions length -> " + directions.length);
        fs.readFile(path.join(dataPath, 'route_stops.json'), 'utf-8', function (err, data) {
            if (err) {
                console.log(err);
            }
            var allRouteStops = JSON.parse(data);
            directions.forEach(function (direction) {
                promise = createDirection(promise, direction, allRouteStops);
            });
        });
    });
    return promise;
};
var createStops = function () {
    var promise = Parse.Promise.as();
    console.log('Start create stops');
    var createStop = function (promise, stop) {
        return promise.then(function () {
            var newStop = new Stop();
            _.each(stop, function (value, key) {
                newStop.set(key, value);
            });
            console.log("Stop with stop_id " + newStop.get('stop_id'));
            return newStop.save();
        });
    };
    fs.readFile(path.join(dataPath, 'stops.json'), 'utf-8', function (err, data) {
        if(err) {
            console.log(err);
            return;
        }
        var stops = JSON.parse(data);
        console.log("Stops length -> " + stops.length);
        stops.forEach(function (stop) {
            promise = createStop(promise, stop);
        });
    });
    return promise;
};
var createTrip = function () {

};
var createFare = function () {

};
//endregion
var stopPromises = [];
var directionPromises = [];
var routePromises = [];
var storeObjects = function () {
    console.log('Start store object');
    createStops()
        .then(function () {
            return createRouteDirections()
        })
        .then(function () {
            return createRoutes()
        })
        .then(function () {
            console.log("Finish ...");
        })
};

exporter.toJSON(connection, schema)
    .then(function (dump) {
        var database = dump;
        var last = false;
        var keys = Object.keys(database).length;
        var index = 0;
        _.each(database, function (value, key) {
            mkdirp(dataPath, function (err) {
                if(err) {
                    return;
                }
                fs.writeFile(path.join(dataPath, key + '.json'), JSON.stringify(value.rows), 'utf-8');
                last = index === keys - 1;
                if(last) {
                    storeObjects();
                } else {
                    index++;
                }
            });
        });
    });