/**
 * Created by antoninotocco on 16/07/16.
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
//region Helper Method
var getAllRoutes = function (successCallback, errorCallback) {
    var Route = Parse.Object.extend("Route");
    var queryAll = new Parse.Query(Route);
    queryAll.find().then(function (routes) {
        var route = routes[0];
        successCallback(route);
    });
};
var getRouteDirections = function (routeId, successCallback, errorCallback) {
    var Route = Parse.Object.extend("Route");
    var query = new Parse.Query(Route);
    query.equalTo('route_id', routeId);
    query.find().then(function (route) {
       successCallback(route[0]);
    });
};
router.get('/', function (req, res, next) {
    getAllRoutes(function (data) {
        res.send({
            status: 'success',
            data: data
        })
    }, function (err) {
       res.send({
           status: 'failed',
           message: err.message
       })
    });
});
router.get('/directions/:routeId', function (req, res, next) {
    var routeId = req.params.routeId;
    getRouteDirections(routeId, function (data) {
        res.send({
            status: 'success',
            data: data
        });
    }, function (err) {
        res.send({
            status: 'failed',
            message: err.message
        });
    });
});
//endregion
//region ROUTE CONFIG

module.exports = router;
//endregion