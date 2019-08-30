app.controller('RelayMovementController', ['$scope', '$http', function($scope, $http){
	$scope.rmsmodal = {};
	$scope.rmsmodal.title = "RMS";
	$scope.gridOptions = {
	   data: [
	   		{
	   			'rid_no': '001',
	   			'rack': 'One',
	   			'date': '29/08/2019',
	   		},
	   		{
	   			'rid_no': '001',
	   			'rack': 'One',
	   			'date': '29/08/2019',
	   		},
	   		{
	   			'rid_no': '001',
	   			'rack': 'One',
	   			'date': '29/08/2019',
	   		}
	   ], //required parameter - array with data
	   //optional parameter - start sort options
	   sort: {
	       predicate: 'companyName',
	       direction: 'asc'
	   }
   	};
   	$scope.OpenRMSModal = function()
   	{
   		$('#rmsmodal').modal('show');
   	}
   	$scope.CloseRMSModal = function()
   	{
   		$('#rmsmodal').modal('hide');
   	}
}]);