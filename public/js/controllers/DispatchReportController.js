app.controller('DispatchReportController', ['$scope', '$http', '$window', function($scope, $http, $windows){

	$scope.gridOptions = {

		pagination: {
			itemsPerPage: '10'
		},

		data:[],

	   	sort: {

	   	},

	   urlSync: true
	};

	$scope.GetRelayForReport = function()
	{
		$http({
			method: 'get',
			url: '/ge/listfordispatchreport',
			data: {

			}
		}).then(function(response){
			console.log(response);
			if (response.data.status == "success")
			{
				$scope.gridOptions.data = response.data.data;
			}
		}, function(response){

		});
	}

	$scope.GenerateReport = function(id)
	{
		window.location.href = '/ge/dispatchreport/' + id;
	}

	$scope.ResetSearch = function()
	{
		$scope.filterDate = '';
		$scope.filterRId = '';
		$scope.filterReceiptNo = '';
	}

	$scope.Back = function()
	{
		window.location.href = '/ge/dispatch-report/';
	}

}]);