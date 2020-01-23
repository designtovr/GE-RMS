app.controller('RMAReportController', ['$scope', '$http', '$window', function($scope, $http, $windows){

	$scope.gridOptions = {

		pagination: {
			itemsPerPage: '10'
		},

		data:[],

	   	sort: {

	   	},

	   urlSync: true
	};

	$scope.GetRMAForReport = function()
	{
		$http({
			method: 'get',
			url: '/ge/listforrmareport',
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
		window.location.href = '/ge/rmareport/' + id;
	}

	$scope.ResetSearch = function()
	{
		$scope.filterDate = '';
		$scope.filterRMANo = '';
		$scope.filterReceiptNo = '';
	}

	$scope.Back = function()
	{
		window.location.href = '/ge/rma-report/';
	}

}]);