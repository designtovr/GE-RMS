app.controller('RepairReportController', ['$scope', '$http', '$window', 'ExcelSave', function($scope, $http, $windows, ExcelSave){

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

	$scope.exportToExcelSave=function(tableId , filename){
        ExcelSave.tableToExcel(tableId,filename);

        $timeout(function(){

        },100); // trigger download
    }

	$scope.ResetSearch = function()
	{
		$scope.filterrid = '';
		$scope.filterrmaid = '';
		$scope.filtermodelno = '';
		$scope.filterserialno = '';
		$scope.filtercode = '';
		$scope.filterSerialNo = '';
		$scope.customerFilter = ''; 
		$scope.dateFrom = '';
		$scope.dateTo = '';
		$scope.current_status = "";
  		$scope.filterDispatch = "";
  		$scope.filterwch = "";
  		$scope.filterCategory = "";
		 
	}

	  $scope.register = {};

	$scope.dispatchStatus = [{
          id: "Dispatched",
          name: "Dispatched"
        }, {
          id: "NotDispatched",
          name: "NotDispatched"
        }];
     
     	$scope.wchStatus = [{
          id: "Warranty",
          name: "Warranty"
        }, {
          id: "Chargeable",
          name: "Chargeable"
        }];
}]);