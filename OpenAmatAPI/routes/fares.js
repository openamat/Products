/**
 * Created by antoninotocco on 17/07/16.
 */
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
var getAllFares = function () {
    var Fare = Parse.Object.extend("Fare");
    var queryAll = new Parse.Query(Fare);
    return queryAll.find();
};
router.get('/', function (req, res, next) {
   getAllFares()
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