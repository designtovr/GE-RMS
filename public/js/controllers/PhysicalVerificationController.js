app.controller('PhysicalVerificationController', ['$scope', '$http', function($scope, $http) {

	$scope.pvform = false;
	$scope.gridOptions = {
	   data: [
	   		{
	   			'receipt_no': '001',
	   			'receipt_date': 'One',
	   			'from': '245',
	   			'to': 'A',
	   			'customer_name': 'AS',
	   			'end_customer': 'SA',
	   			'courier_name': 'Fedx',
	   			'docket_details': 'ASE'
	   		},
	   		{
	   			'receipt_no': '001',
	   			'receipt_date': 'One',
	   			'from': '245',
	   			'to': 'A',
	   			'customer_name': 'AS',
	   			'end_customer': 'SA',
	   			'courier_name': 'Fedx',
	   			'docket_details': 'ASE'
	   		},
	   		{
	   			'receipt_no': '001',
	   			'receipt_date': 'One',
	   			'from': '245',
	   			'to': 'A',
	   			'customer_name': 'AS',
	   			'end_customer': 'SA',
	   			'courier_name': 'Fedx',
	   			'docket_details': 'ASE'
	   		}
	   ], //required parameter - array with data
	   //optional parameter - start sort options
	   sort: {
	       predicate: 'companyName',
	       direction: 'asc'
	   }
   	};

   	$scope.OpenPVForm = function(id=0)
   	{
   		$scope.pvform = true;
   	}

   	$scope.ClosePVForm = function()
   	{
   		$scope.pvform = false;
   	}

}]);