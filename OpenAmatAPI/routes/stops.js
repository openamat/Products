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
var stops = {
    allStops: allStops
};

module.exports = stops;