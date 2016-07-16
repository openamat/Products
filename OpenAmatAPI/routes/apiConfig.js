/**
 * Created by antoninotocco on 16/07/16.
 */
var fs = require('fs');
var path = require('path');
var _ = require('lodash');
var find = require('lodash.find');
var routes = require('./routes');
var stops = require('./stops');
var apiConfig = {
    routes: routes,
    stops: stops
};

module.exports = apiConfig;
//endregion