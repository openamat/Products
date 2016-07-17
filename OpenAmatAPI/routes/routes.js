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
    return queryAll.find();
};
router.get('/', function (req, res, next) {
    getAllRoutes()
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
//region ROUTE CONFIG

module.exports = router;
//endregion