app.controller('VerificationCompleteController', ['$scope', '$http', function($scope, $http){
	$scope.vcform = false;
	$scope.gridOptions = {
	   data: [
	   		{
	   			'rid_no': '001',
	   			'rma_no': '002',
	   			'product': 'One',
	   			'customer_name': 'AS',
	   			'end_customer': 'SA',
	   			'serial_no': 'Fedx',
	   			'model_no': 'ASE',
	   			'remark': 'Sample',
	   			'wbsno': '003',
	   			'customer_comment': 'Sample'
	   		},
	   		{
	   			'rid_no': '001',
	   			'rma_no': '002',
	   			'product': 'One',
	   			'customer_name': 'AS',
	   			'end_customer': 'SA',
	   			'serial_no': 'Fedx',
	   			'model_no': 'ASE',
	   			'remark': 'Sample',
	   			'wbsno': '003',
	   			'customer_comment': 'Sample'
	   		},
	   		{
	   			'rid_no': '001',
	   			'rma_no': '002',
	   			'product': 'One',
	   			'customer_name': 'AS',
	   			'end_customer': 'SA',
	   			'serial_no': 'Fedx',
	   			'model_no': 'ASE',
	   			'remark': 'Sample',
	   			'wbsno': '003',
	   			'customer_comment': 'Sample'
	   		}
	   ], //required parameter - array with data
	   //optional parameter - start sort options
	   sort: {
	       predicate: 'companyName',
	       direction: 'asc'
	   }
   	};

   	$scope.ShowVCForm = function()
   	{
   		$scope.vcform = true;
   	}

   	$scope.CloseVCForm = function()
   	{
   		$scope.vcform = false;
   	}

}]);