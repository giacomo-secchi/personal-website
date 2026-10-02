var helperModule = (function(h) {
	h.message = 'La funzione logMultipleTimes è stata chiamata ';
    h.logMultipleTimes = function (n) {
        for (i = 0; i < n; i++) {
        	console.log( h.message + n + ' volte dal modulo Beer');
        }
    }
    
    return h;
})(helperModule || {});




