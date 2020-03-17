app.controller('DispatchReportController', ['$scope', '$http', '$window', 'ExcelSave', function($scope, $http, $windows, ExcelSave){

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
		$scope.dateFrom = '';
		$scope.dateTo = '';
		$scope.filterRId = '';
		$scope.filterReceiptNo = '';
	}

	$scope.Back = function()
	{
		window.location.href = '/ge/dispatch-report/';
	}

	$scope.exportToExcelSave=function(tableId , filename){
        ExcelSave.tableToExcel(tableId,filename);

        $timeout(function(){

        },100); // trigger download
    }

}]);