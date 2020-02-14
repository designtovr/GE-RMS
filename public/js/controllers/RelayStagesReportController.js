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

	$scope.rid = '';

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
		$scope.rid = id;
		window.location.href = '/ge/relaystagereport/' + id;
	}

	$scope.PrintJobTicketForm = function(id)
	{
		window.location.href = '/ge/job-ticket-form/' + id;
	}

	$scope.TestReportForm = function(id)
	{
		window.location.href = '/ge/test-report-form/' + id;
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

	$scope.Back = function()
	{
		window.location.href = '/ge/relay-stages-report/';
	}

}]);