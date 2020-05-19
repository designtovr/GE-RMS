app.controller('RepairReportController', ['$scope', '$http', '$window', 'ExcelSave', function($scope, $http, $windows, ExcelSave){

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
  		$scope.register.Dispatched = "";
  		$scope.register.wch = "";
		 
	}

	  $scope.register = {};

	$scope.register.dispatchStatus = [{
          id: "Yes",
          name: "Dispatched"
        }, {
          id: "No",
          name: "NotDispatched"
        }];
     
     	$scope.register.wchStatus = [{
          id: "Warranty",
          name: "Warranty"
        }, {
          id: "Chargeable",
          name: "Chargeable"
        }];
}]);