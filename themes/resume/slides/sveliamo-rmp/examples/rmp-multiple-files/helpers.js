var helperModule = (function() {
    function logMultipleTimes (n) {
        for (i = 0; i < n; i++) {
        	console.log('La funzione logMultipleTimes è stata chiamata ' + n + ' volte dal modulo Beer');
        }
    }
    
    return {
    	logMultipleTimes: logMultipleTimes
    };
})();


