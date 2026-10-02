var Beer = (function($, _) {          // Oggetto 
    function _pushOrSomething () { //public method
        GoogleAnalytics.pushOrSomething.apply(this, arguments);
    }
    
    function anotherOne (key) {   //altro public method
        _pushOrSomething('Lager', 'Weiss', 'Gose', key);
    }

    function format (el, content) {
		$(el).html(anotherOne(content));

    }

    function beerNumber () {
    	console.log(_.min([10, 5, 100, 2, 1000]));
    }
    
    return {
    	anotherOne: anotherOne, // we've defined what we want to return
    	ui: format
    };
})( jQuery, _ );


$( document ).ready(function(){
	Beer.ui('.container', 'Irish Ale' );
});