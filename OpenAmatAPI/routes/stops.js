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
//region HELPER METHODS
var getAllStops = function () {
    var Stop = Parse.Object.extend("Stop");
    var queryAll = new Parse.Query(Stop);
    return queryAll.find();
};
var getRouteStops = function (routeId, directionId) {
    var Route = Parse.Object.extend("Route");
    var Direction = Parse.Object.extend("Direction");
    var Stop = Parse.Object.extend("Stop");
    var queryDirection = new Parse.Query(Direction);
    queryDirection
        .equalTo('route_id', routeId)
        .equalTo('direction_id', parseInt(directionId));
    return queryDirection.find()
        .then(function (directions) {
            var direction = directions[0];
            var relation = direction.relation("stops");
            var query = relation.query();
            return query.find();
        });
};
//endregion
//region ROUTE CONFIG
router.get('/', function (req, res, next) {
   getAllStops()
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
    getRouteStops(routeId, directionId)
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