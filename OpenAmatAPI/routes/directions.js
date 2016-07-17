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
var getRouteDirections = function (routeId) {
    var Direction = Parse.Object.extend("Direction");
    var query = new Parse.Query(Direction);
    query.include("route");
    query.equalTo('route_id', routeId);
    return query.find();
};
router.get('/:routeId', function (req, res, next) {
    var routeId = req.params.routeId;
    getRouteDirections(routeId)
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
//endregion
module.exports = router;