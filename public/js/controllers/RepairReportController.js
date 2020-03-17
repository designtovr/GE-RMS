app.controller('RepairReportController', ['$scope', '$http', '$window', function($scope, $http, $windows){

	$scope.gridOptions = {

		pagination: {
			itemsPerPage: '10'
		},

		data:[],

	   	sort: {

	   	},

	   urlSync: true
	};

	$scope.rid = '';

	$scope.GetRepairReport = function()
	{
		$http({
			method: 'get',
			url: '/ge/repair-report-data',
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

	$scope.ResetSearch = function()
	{
		$scope.filterRId = '';
		$scope.rmaFilter = '';
		$scope.rcidFilter = '';
		$scope.filterSerialNo = '';
		$scope.dateTo = '';
		$scope.dateFrom = '';
	}

}]);