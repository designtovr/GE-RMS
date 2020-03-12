var app = angular.module("ge", ['dataGrid', 'pagination', 'ui-notification', 'cp.ngConfirm', 'ui.select', 'ngSanitize', 'ui.bootstrap', 'ui.mask', 'ngFileUpload'], function($interpolateProvider){
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
			NProgress.done();
	      return $q.reject(rejection);
	    },
    	'response': function(response) {
    		NProgress.done();
	      return response;
	    },
	   'responseError': function(rejection) {
	   		NProgress.done();
	      return $q.reject(rejection);
	    }
	};
});

app.factory('Excel',function($window){
	var e = this;
	var uri='data:application/vnd.ms-excel;base64,',
		template='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
		base64=function(s){return $window.btoa(unescape(encodeURIComponent(s)));},
		format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p];})};
	return {
		tableToExcel:function(tableId,worksheetName){
			var table=$(tableId);
			/*$(tableId).attr("download","Receipt.xlxs");*/
			var	ctx={worksheet:worksheetName , table:table.html()}, href=uri+base64(format(template,ctx));
			return href;
		}
	};
})

app.config(['$httpProvider', 'NotificationProvider', 'uiMask.ConfigProvider', function($httpProvider, NotificationProvider, uiMaskConfigProvider) {
  
	$httpProvider.defaults.headers.post = { 'Content-Type': "application/json; charset=utf-8" };
	$httpProvider.interceptors.push('HttpInterceptor');

	NotificationProvider.setOptions({
	    delay: 2000,
	    startTop: 20,
	    startRight: 10,
	    verticalSpacing: 20,
	    horizontalSpacing: 20,
	    positionX: 'center',
	    positionY: 'top'
	});

	uiMaskConfigProvider.maskDefinitions(
		{
			'A': /[a-z]/, 
			'*': /[a-zA-Z0-9]/,
			'D': /[0-9]/
		}
	);
	
}]);