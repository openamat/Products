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
    host: 'localhost', //PG DB HOST
    username: 'entony',// PG DB USER
    database: 'openamat'//PG DB NAME
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
var StopTime = Parse.Object.extend('StopTime');
//endregion

//region Array
var routesObject = [];
var stopsObject = [];
var tripsObject = [];
var faresObject = [];
var stopTimesObject = [];
//region CREATE COLLECTIONS
var createRoutes = function () {
    var createRoute = function (route) {
        var newRoute = new Route();
        _.each(route, function (value, key) {
            newRoute.set(key, value);
        });
        routesObject.push(newRoute);
    };
    var data = fs.readFileSync(path.join(dataPath, 'routes.json'), 'utf-8');
    var routes = JSON.parse(data);
    console.log("Start create routes");
    routes.forEach(function (route) {
        createRoute(route);
    });
    return Parse.Object.saveAll(routesObject);
};
var createRouteDirections = function () {
    var promise = Parse.Promise.as();
    var createDirection = function (promise, direction) {
        return promise.then(function () {
            var newDirection = new Direction();
            _.each(direction, function (value, key) {
                newDirection.set(key, value);
            });
            var queryRoute = new Parse.Query(Route);
            queryRoute.equalTo('route_id', direction.route_id);
            return queryRoute.find()
                .then(function (route) {
                    newDirection.set('route', route);
                    console.log("Directions with direction_id -> " + newDirection.get('direction_id'));
                    var data = fs.readFileSync(path.join(dataPath, 'route_stops.json'), 'utf-8');
                    var allRouteStops = JSON.parse(data);
                    var routeStops = _.filter(allRouteStops, {
                        route_id: direction.route_id,
                        direction_id: direction.direction_id
                    });
                    var routeStopsId = _.map(routeStops, function (stop) {
                       return stop.stop_id;
                    });
                    var queryStop = new Parse.Query(Stop);
                    queryStop.containedIn("stop_id", routeStopsId);
                    return queryStop.find().then(function (stops) {
                        var relation = newDirection.relation("stops");
                        relation.add(stops);
                        return newDirection.save();
                    });
                });
        });
    };
    var data = fs.readFileSync(path.join(dataPath, 'route_directions.json'), 'utf-8');
    var directions = JSON.parse(data);
    console.log("Directions length -> " + directions.length);
    directions.forEach(function (direction) {
        promise = createDirection(promise, direction);
    });
    return promise;
};
var createStops = function () {
    var createStop = function (stop) {
        var newStop = new Stop();
        _.each(stop, function (value, key) {
            newStop.set(key, value);
        });
        stopsObject.push(newStop);
    };
    console.log('Start create stops');
    var data = fs.readFileSync(path.join(dataPath, 'stops.json'), 'utf-8');
    var stops = JSON.parse(data);
    console.log("Stops length -> " + stops.length);
    stops.forEach(function (stop) {
        createStop(stop);
    });
    return Parse.Object.saveAll(stopsObject);
};
var createTrips = function () {
    var createTrip = function (trip) {
        var newTrip = new Trip();
        _.each(trip, function (value, key) {
            newTrip.set(key, value);
        });
        tripsObject.push(newTrip);
    };
    var data = fs.readFileSync(path.join(dataPath, 'trips.json'), 'utf-8');
    var trips = JSON.parse(data);
    console.log("Start create trips");
    trips.forEach(function (trip) {
        createTrip(trip);
    });
    return Parse.Object.saveAll(tripsObject);
};
var createStopTimes = function () {
    var createStopTime = function (stopTime) {
        var newStopTime = new StopTime();
        _.each(stopTime, function  (value, key) {
            newStopTime.set(key, value);
        });
        stopTimesObject.push(newStopTime);
    };
    var data = fs.readFileSync(path.join(dataPath, 'stop_times.json'), 'utf-8');
    var stopTimes = JSON.parse(data);
    console.log("Start create stopTimes");
    console.log(stopTimes.length);
    stopTimes.forEach(function (stopTime) {
        createStopTime(stopTime);
    });
    console.log("Setting up stopTimes promises");
    return Parse.Object.saveAll(stopTimesObject);
};
var createFares = function () {
    var createFare = function (fare) {
        var newFare = new Fare();
        _.each(fare, function (value, key) {
            newFare.set(key, value);
        });
        console.log("Fare with fare_id -> " + newFare.get('fare_id'));
        faresObject.push(newFare);
    };
    var data = fs.readFileSync(path.join(dataPath, 'fare_attributes.json'), 'utf-8');
    var fares = JSON.parse(data);
    fares.forEach(function (fare) {
        createFare(fare);
    });
    return  Parse.Object.saveAll(faresObject);
};
var resetTables = function () {
    var resetTable = function(promise, tableName) {
        return promise.then(function () {
            var Table = Parse.Object.extend(tableName);
            var query = new Parse.Query(Table);
            query.limit(100000);
            return query.find().then(function (items) {
                console.log('Eliminazione ' + tableName + ": " + items.length + " oggetti");
                var promise = Parse.Promise.as();
                items.forEach(function (item) {
                    promise = promise.then(function () {
                        return item.destroy();
                    });
                });
                return promise;
            });
        });
    };
    var promise = Parse.Promise.as();
    var tables = ["Stop", "Route", "Trip", "Fare", "StopTime"];
    tables.forEach(function (table) {
       promise = resetTable(promise, table);
    });
    return promise;
};


var storeObjects = function () {
    console.log('Start store object');
    resetTables()
        .then(function () {
            return createStops();
        })
        .then(function () {
            return createRoutes();
        })
        // .then(function () {
        //     return createRouteDirections();
        // })
        .then(function () {
            return createTrips();
        })
        .then(function () {
            return createStopTimes();
        })
        .then(function () {
            return createFares();
        })
        .then(function () {
            console.log("All done!");
            return;
        })
        .catch(function (err) {
            console.log(err);
        });
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
                fs.writeFile(
                    path.join(dataPath, key + '.json'),
                    JSON.stringify(value.rows),
                    'utf-8',
                    function (err) {
                        if(err) {
                            console.log(err);
                            return;
                        }
                        last = index === keys - 1;
                        if(last) {
                            storeObjects();
                        } else {
                            index++;
                        }
                });
            });
        });
    });