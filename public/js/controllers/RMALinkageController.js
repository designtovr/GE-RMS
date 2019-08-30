app.controller('RMALinkageController', ['$scope', '$http', function($scope, $http){
	
	$scope.linkagemodal = {};
	$scope.linkagemodal.title = "Link";
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
   	$scope.OpenLinkageModal = function()
   	{
   		$('#linkagemodal').modal('show');
   	}
   	$scope.CloseLinkageModal = function()
   	{
   		$('#linkagemodal').modal('hide');
   	}
}]);