
var connect = require('./node_modules/connect')
  , http = require('http');

var form = '<!doctype html>\n\
<html>\n\
<head>\n\
<meta charset="UTF-8">\n\
</head>\n\
<body>\n\
  <form action="/" method="post">\n\
    Hidden CSRF token -&gt; <input type="text" name="_csrf" value="{token}" readonly style="width: 300px" /><br>\n\
    <input type="text" name="user[name]" value="{user}" placeholder="Username" />\n\
    <input type="submit" value="Action" />\n\
  </form>\n\
</body>\n\
</html>\n\
'; 

var app = connect()
  .use(connect.cookieParser())
  .use(connect.session({ secret: 'keyboard dog' }))
  .use(connect.bodyParser())
  .use(connect.csrf())
  .use(function(req, res, next){
    if ('POST' != req.method) return next();
    req.session.user = req.body.user;
    next();
  })
  .use(function(req, res){
    res.setHeader('Content-Type', 'text/html');
    var body = form
      .replace('{token}', req.csrfToken())
      .replace('{user}', req.session.user && req.session.user.name || '');
    res.end(body);
  });

http.createServer(app).listen(3000);
console.log('Server listening on port 3000');
