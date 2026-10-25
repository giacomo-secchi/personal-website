const express = require('express');
const i18next = require('i18next');
const ISO6391 = require('iso-639-1');
const middleware = require('i18next-http-middleware');
var router = express.Router();



/* GET users listing. */
router.get('/', function(req, res, next) {
  let lng = req.language // 'de-CH'
  let lngs = req.languages // ['de-CH', 'de', 'en']
  let template = 'index';
  let languageNames = {};
  // req.i18n.changeLanguage('en') // will not load that!!! assert it was preloaded

  if (lng) {
    i18next.changeLanguage(lng, (err, t) => {
      if (err) {
        return res.status(500).send(err);
      }

      let languages =  Object.keys(i18next.services.resourceStore.data);
      let sections = i18next.t('sections', { returnObjects: true });

      languages.forEach(lng => {
        languageNames[lng] = ISO6391.getName(lng);
      });

      res.render(template, {sections, languageNames, t, ...process.env});
    });
  } else {
    res.render(template, {t: i18next.t, ...process.env });
  }

  // var exists = req.i18n.exists('myKey')
  // var translation = req.t('myKey')
});

module.exports = router;
