app.controller('DispatchReportController', ['$scope', '$http', '$window', 'ExcelSave', function($scope, $http, $windows, ExcelSave){

	$scope.productoverdueage = [];
	$scope.getproductoverdueage = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/productoverdueage'
		}).then(function success(response) {
		    $scope.productoverdueage = response.data.data;
		}, function error(response) {
		});
	}

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
		$scope.filterRId = '';
		$scope.filterserialno = '';
		$scope.partNoFilter = '';
		$scope.filterCategory = '';
		$scope.customerFilter = '';
		$scope.dateFrom = '';
		$scope.dateTo = '';
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