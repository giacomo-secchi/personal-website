var helperModule = (function(h) {
	h.enhancedLog = function (fontSize, logMessage) {
		console.log('%c'+ logMessage, 'font-size:'+ fontSize );
	}
	
	return h;
})(helperModule || {});