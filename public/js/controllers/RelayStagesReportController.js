app.controller('RelayStagesReportController', ['$scope', '$http', '$window', function($scope, $http, $windows){

	$scope.gridOptions = {

		pagination: {
			itemsPerPage: '10'
		},

		data:[],

	   	sort: {

	   	},

	   urlSync: true
	};

	$scope.GetRelayForStageReport = function()
	{
		$http({
			method: 'get',
			url: '/ge/dataforrelaysstagereport',
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
		window.location.href = '/ge/relaystagereport/' + id;
	}

}]);