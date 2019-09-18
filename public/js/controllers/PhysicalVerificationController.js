app.controller('PhysicalVerificationController', ['$scope', '$http', function($scope, $http) {

	$scope.pvform = false;
	// $scope.gridOptions = {
	//    data: [
	//    		/*{
	// 		   'receipt_no': '001',
	// 		   'receipt_date': 'One',
	//
	// 		   'customer_name': 'AS',
	// 		   'end_customer': 'SA',
	// 		   'courier_name': 'Fedx',
	// 		   'docket_details': 'AS',
	// 		   'num_of_boxes' : '2'
	// 	   },
	// 	   {
	// 		   'receipt_no': '001',
	// 		   'receipt_date': 'One',
	// 		   'customer_name': 'AS',
	// 		   'end_customer': 'SA',
	// 		   'courier_name': 'Fedx',
	// 		   'docket_details': 'AS',
	// 		   'num_of_boxes' : '2'
	// 	   },
	// 	   {
	// 		   'receipt_no': '001',
	// 		   'receipt_date': 'One',
	// 		   'customer_name': 'AS',
	// 		   'end_customer': 'SA',
	// 		   'courier_name': 'Fedx',
	// 		   'docket_details': 'AS',
	// 		   'num_of_boxes' : '2'
	// 	   }*/
	//    ], //required parameter - array with data
	//    //optional parameter - start sort options
	//    sort: {
	//        predicate: 'companyName',
	//        direction: 'asc'
	//    }
   	// };

	$scope.receipt = {};
	$scope.physicalVerification = {};
	$scope.gridOptions = {data : []};
	$scope.AddPV= function()
	{
		$http({
			method: 'post',
			url: '/ge/addphysicalverification',
			data: {
				'physicalverification': $scope.physicalVerification,
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.messagae)
				$scope.ClosePVForm();
				/*$('#customermodal').modal('hide');*/
				$scope.getReceipts();
			}
		}, function failure(response){
			if (response.status == 422)
			{

				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.getReceipts = function()
	{
		$http({
			method: 'GET',
			url: '/ge/receipts'
		}).then(function success(response) {
			$scope.receipt = response.data.data;
			$scope.gridOptions.data =  response.data.data;
		}, function error(response) {

		});
	}



	$scope.OpenPVForm = function(id=0)
   	{
   		$scope.pvform = true;
   	}

   	$scope.ClosePVForm = function()
   	{
   		$scope.pvform = false;
   	}

}]);