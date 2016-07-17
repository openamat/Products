/**
 * Created by antoninotocco on 16/07/16.
 */
var _ = require('lodash');
var fs = require('fs');
var path = require('path');
var mkdirp = require('mkdirp');
var Parse = require('parse/node');
var Moment = require('moment');
Parse.initialize('openamat');
Parse.serverURL = 'http://localhost:1337/parse';
var resetTable = function(tableName) {
    var Table = Parse.Object.extend(tableName);
    var query = new Parse.Query(Table);
    query.limit(100000);
    return query.find().then(function(items) {
        console.log('Eliminazione' + tableName + ": " + items.length + " oggetti");
        var promise = Parse.Promise.as();
        items.forEach(function(item) {
            promise = promise.then(function() {
                return item.destroy();
            });
        });
        return promise;
    });
};

var tables = ["Stop", "Direction", "Route", "Trip", "Fare"];

for (var i = 0; i < tables.length; i++) {
    resetTable(tables[i])
}