var Beer = {          // Oggetto 
    pushOrSomething: function () { //public method
        GoogleAnalytics.pushOrSomething.apply(this, arguments);
    },
    anotherOne: function (key) {   //altro public method
        this.pushOrSomething('Lager', 'Weiss', 'Gose', key);
    }
};
Beer.anotherOne('Irish Ale');