app.controller('WarrantyController', ['$scope', '$http', function($scope, $http) {

	$scope.warrantymodal = {};
	$scope.warrantymodal.title = 'Warranty Form';
	$scope.gridOptions = {
	   data: [
	   		{
	   			'rid_no': '001',
	   			'product': 'One',
	   			'customer_name': 'AS',
	   			'end_customer': 'SA',
	   			'serial_no': 'Fedx',
	   			'model_no': 'ASE',
	   			'courier_name': 'Fed',
	   			'docket_details': '123',
	   			'customer_comment': 'Sample'
	   		},
	   		{
	   			'rid_no': '001',
	   			'product': 'One',
	   			'customer_name': 'AS',
	   			'end_customer': 'SA',
	   			'serial_no': 'Fedx',
	   			'model_no': 'ASE',
	   			'courier_name': 'Fed',
	   			'docket_details': '123',
	   			'customer_comment': 'Sample'
	   		},
	   		{
	   			'rid_no': '001',
	   			'product': 'One',
	   			'customer_name': 'AS',
	   			'end_customer': 'SA',
	   			'serial_no': 'Fedx',
	   			'model_no': 'ASE',
	   			'courier_name': 'Fed',
	   			'docket_details': '123',
	   			'customer_comment': 'Sample'
	   		}
	   ], //required parameter - array with data
	   //optional parameter - start sort options
	   sort: {
	       predicate: 'companyName',
	       direction: 'asc'
	   }
   	};

   	$scope.OpenWarrantyModal = function()
   	{
   		$('#warrantymodal').modal('show');
   	}

   	$scope.CloseWarrantyModal = function()
   	{
   		$('#warrantymodal').modal('hide');
   	}

}]);