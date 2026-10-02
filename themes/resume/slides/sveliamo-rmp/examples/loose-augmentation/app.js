var Beer = (function(B, h) {          // Oggetto 
    function _pushOrSomething () { //public method
        GoogleAnalytics.pushOrSomething.apply(this, arguments);
    }
    
    function anotherOne (key) {   //altro public method
        _pushOrSomething('Lager', 'Weiss', 'Gose', key);
        helperTest();
    }
    
    function helperTest () {
        //debugger;
        h.logMultipleTimes(6);
    }

    function logPerCiechi () {
        h.message = 'Ciao Mondo';
        h.enhancedLog('60px', h.message);
    }

    return {
    	anotherOne: anotherOne, // we've defined what we want to return
        logPerCiechi: logPerCiechi
    };
})(Beer || {}, helperModule);

Beer.anotherOne('Irish Ale');
Beer.logPerCiechi();

