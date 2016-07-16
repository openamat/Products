/**
 * Created by antoninotocco on 16/07/16.
 */
var exporter = require('pg-json-data-export');
var _ = require('lodash');
var fs = require('fs');
var path = require('path');
var mkdirp = require('mkdirp');
var dataPath = path.join(process.cwd(), 'data');
var connection = {
    host: 'localhost',
    username: 'entony',
    database: 'openamat'
};
var schema = 'public';
exporter.toJSON(connection, schema)
    .then(function (dump) {
        var database = dump;
        _.each(database, function (value, key) {
            mkdirp(dataPath, function (err) {
                if(err) {
                    return;
                }
                fs.writeFile(path.join(dataPath, key + '.json'), JSON.stringify(value.rows), 'utf-8');
            });
        });
    });
