var app = angular.module("ge", [], function($interpolateProvider){
	/*$interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');*/
});

app.factory('HttpInterceptor', function($q){
	return {
		'request': function(config) {
			return config;
		},
		'requestError': function(rejection) {
	      return $q.reject(rejection);
	    },
    	'response': function(response) {
	      return response;
	    },
	   'responseError': function(rejection) {
	      return $q.reject(rejection);
	    }
	};
});

app.config(function ($httpProvider) {
	$httpProvider.defaults.headers.post = { 'Content-Type': "application/json; charset=utf-8" };
	$httpProvider.interceptors.push('HttpInterceptor');
});