var Beer = (function(h) {          // Oggetto 
    function _pushOrSomething () { //public method
        GoogleAnalytics.pushOrSomething.apply(this, arguments);
    }
    
    function anotherOne (key) {   //altro public method
        _pushOrSomething('Lager', 'Weiss', 'Gose', key);
        helperTest();
    }
    
    function helperTest () {
    	h.logMultipleTimes(6);
    }

    return {
    	anotherOne: anotherOne // we've defined what we want to return
    };
})(helperModule);

Beer.anotherOne('Irish Ale');

