var Beer = (function() {          // Oggetto 
    function _pushOrSomething () { //public method
        GoogleAnalytics.pushOrSomething.apply(this, arguments);
    }
    
    function anotherOne (key) {   //altro public method
        _pushOrSomething('Lager', 'Weiss', 'Gose', key);
    }
    
    return {
    	anotherOne: anotherOne // we've defined what we want to return
    };
})();

Beer.anotherOne('Irish Ale');

