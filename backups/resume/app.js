const createError = require('http-errors');
const express = require('express');
const path = require('path');
const middleware = require('i18next-http-middleware');
const initializeI18n = require('./i18n');
const compression = require('compression');


const port = process.env.PORT || 3000;

let indexRouter = require('./routes/index');
 

var app = express();

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

app.use(express.static(path.join(__dirname, 'public')));
app.use(express.static(path.join(__dirname, 'dist')));

app.use(compression());

initializeI18n((err, i18next) => {
  if (err) {
    console.error('Error initializing i18next:', err);
    return;
  }
  
  app.use(middleware.handle(i18next, {
    removeLngFromUrl: false
  }));
  
  app.use('/', indexRouter);
 
  // catch 404 and forward to error handler
  app.use(function(req, res, next) {
    next(createError(404));
  });

  // Middleware to handle HttpError and render template
  app.use(function(err, req, res, next) {
    if (err instanceof createError.HttpError) {
      if(err.statusCode == 404) {
        res.status(err.statusCode).render('error', { error: err, message: req.t('404_message') });
      }
    } else {
      next(err);
    }
  });

  // error handler
  app.use(function(err, req, res, next) {
    // set locals, only providing error in development
    res.locals.message = err.message;
    res.locals.error = req.app.get('env') == 'development' ? err : {};

    // render the error page
    res.status(err.status || 500);
    res.render('error');
  });
});


module.exports = app;
