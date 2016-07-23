var scrapeit = require('scrape-it');
var restify = require('restify');
require('dotenv').config();

var server = restify.createServer();
server.get('/', function(req,res,next) {
  var BaseUrl = process.env.AMAT_BASE_URL;

  scrapeit("http://www.amat.pa.it/", {
  news: {
    listItem: "div.art-Post",
    data: {
      news_title: {
        selector: "h2.art-PostHeader",
        how: "text"
      },
      news_body: {
        selector: ".art-PostContent>.art-article",
        how: "html"
      },
      news_readmore: {
        selector: "a.readon.art-button",
        attr: "href",
        convert: x => {
          if(typeof x !== "undefined")
            return BaseUrl + x
        }
      }
    }
  }

  }).then(page => {
    res.send(page);
    next();
  })
});


server.listen(process.env.RESTIFY_PORT, function() {
  console.log('%s listening at %s', server.name, server.url);
});
