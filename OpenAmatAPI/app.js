var hapi = require('hapi');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var apiConfig = require('./routes/apiConfig.js');
var app = new hapi.Server();

app.connection(
    {
      host: 'localhost',
      port: 3000
    });
app.route({
  method: 'GET',
  path: '/',
  handler: function (request, reply) {
      reply({
          resultCode: 'OK',
          resultObj: {
              message: 'Server up'
          }
      });
  }
});
app.route(apiConfig.routes.allRoutes);
app.route(apiConfig.stops.routeStops);
app.route(apiConfig.stops.allStops);

app.start(function (err) {
  if (err) {
    throw err;
  }
  console.log('Server running at:', app.info.uri);
});

module.exports = app;
