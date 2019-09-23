var app = angular.module("ge", ['dataGrid', 'pagination', 'ui-notification', 'cp.ngConfirm'], function($interpolateProvider){
	/*$interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');*/
});

app.factory('HttpInterceptor', function($q){
	return {
		'request': function(config) {
			NProgress.start();
			return config;
		},
		'requestError': function(rejection) {
	      return $q.reject(rejection);
	    },
    	'response': function(response) {
    		NProgress.done();
	      return response;
	    },
	   'responseError': function(rejection) {
	      return $q.reject(rejection);
	    }
	};
});

app.config(function ($httpProvider, NotificationProvider) {
	$httpProvider.defaults.headers.post = { 'Content-Type': "application/json; charset=utf-8" };
	$httpProvider.interceptors.push('HttpInterceptor');

	NotificationProvider.setOptions({
        delay: 1000,
        startTop: 20,
        startRight: 10,
        verticalSpacing: 20,
        horizontalSpacing: 20,
        positionX: 'center',
        positionY: 'top'
    });

});