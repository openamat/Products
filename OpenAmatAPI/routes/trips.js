/**
 * Created by antoninotocco on 17/07/16.
 */
var fs = require('fs');
var path = require('path');
var _ = require('lodash');
var find = require('lodash.find');
var dataPath = path.join(process.cwd(), 'data');
var express = require('express');
var router = express.Router();
var Parse = require('parse/node');
var Moment = require('moment');
Parse.initialize('openamat');
Parse.serverURL = 'http://localhost:1337/parse';
_.find = find;
var getAllTrips = function () {
    var Trip = Parse.Object.extend("Trip");
    var queryAll = new Parse.Query(Trip);
    queryAll.include("direction");
    return queryAll.find();
};
var getTripsFromRoute = function (routeId) {
    var Trip = Parse.Object.extend("Trip");
    var query = new Parse.Query(Trip);
    query.include("direction");
    query.equalTo('route_id', routeId);
    return query.find();
};
var getTripsFromRouteAndDirection = function (routeId, directionId) {
    var Trip = Parse.Object.extend("Trip");
    var query = new Parse.Query(Trip);
    query.include("direction");
    query.equalTo('route_id', routeId)
        .equalTo('direction_id', directionId);
    return query.find();
};

router.get('/', function (req, res, next) {
    getAllTrips()
        .then(function (data) {
            res.send({
                status: 'success',
                data: data
            });
        }, function (err) {
            res.send({
                status: 'error',
                message: err.message
            });
        });
});
router.get('/:routeId', function (req, res, next) {
    var routeId = req.params.routeId;
    getTripsFromRoute(routeId)
        .then(function (data) {
            res.send({
                status: 'success',
                data: data
            });
        }, function (err) {
            res.send({
                status: 'error',
                message: err.message
            });
        });
});
router.get('/:routeId/:directionId', function (req, res, next) {
    var routeId = req.params.routeId;
    var directionId = req.params.directionId;
    getTripsFromRouteAndDirection(routeId, directionId)
        .then(function (data) {
            res.send({
                status: 'success',
                data: data
            });
        }, function (err) {
            res.send({
                status: 'error',
                message: err.message
            });
        });
});

module.exports = router;