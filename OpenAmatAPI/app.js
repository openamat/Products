var express = require('express');
var cors = require('cors');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var ipaddress = require('./utils/ipaddress')();
var ParseServer = require('parse-server').ParseServer;
var routes = require('./routes/routes');
var stops = require('./routes/stops');
var directions = require('./routes/directions');
var trips = require('./routes/trips');
var fares = require('./routes/fares');
var app = express();
var api = new ParseServer({
    databaseURI: 'mongodb://localhost:27017/dev',
    //cloud: '/home/myApp/cloud/main.js', // Absolute path to your Cloud Code
    appId: 'openamat',
    masterKey: 'uJBb7N4uq45nZjNM',
    serverURL: 'http://' + ipaddress + ':1337/parse'
});
app.use(cors());
app.use('/parse', api);
app.use('/api/routes', routes);
app.use('/api/directions', directions);
app.use('/api/stops', stops);
app.use('/api/trips', trips);
app.use('/api/fares', fares);
app.listen(1337, function() {
    console.log('parse-server running on port 1337.');
});
module.exports = app;
