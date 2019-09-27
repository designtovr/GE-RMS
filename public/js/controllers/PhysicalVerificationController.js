app.controller('PhysicalVerificationController', ['$scope', '$http', 'Notification' ,'$filter' , '$ngConfirm' , function($scope, $http, Notification , $filter , $ngConfirm) {

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
				alert(response.data.message)
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



	$scope.OpenPVForm = function(receipt)
   	{
		$http({
			method: 'GET',
			url: '/ge/GetPhysicalVerification/' + receipt.receipt_no
		}).then(function success(response) {

			if(response.data.status == 'Edit') {
				$scope.physicalVerification = response.data.physicalverification;
				$scope.physicalVerification.pvdate = $filter('date')(new Date(),'dd/MM/yyyy');
				console.log($scope.physicalVerification);
			}

			else
			{
				$scope.physicalVerification = receipt;
				$scope.physicalVerification.case_condition = 0;
				$scope.physicalVerification.battery_condition = 0;
				$scope.physicalVerification.terminal_blocks_condition = 0;
				$scope.physicalVerification.top_bottom_cover_condition = 0;
				$scope.physicalVerification.short_links_condition = 0;
			}
		}, function error(response) {
		});


   		$scope.pvform = true;
		console.log(	$scope.physicalVerification);
	}

	$scope.DeletePV = function(id)
	{
		$ngConfirm({
			title: 'Warning!',
			content: 'Are you sure want to delete?',
			type: 'red',
			typeAnimated: true,
			buttons: {
				tryAgain: {
					text: 'Delete',
					btnClass: 'btn-red',
					action: function(){
						$http({
							method: 'DELETE',
							url: './physicalverification/'+id,
						}).then(function success(response) {
							if (response.data.status == 'success')
							{
								Notification.success(response.data.message);
								$scope.getReceipts();
							}
						}, function error(response) {

						});
					}
				},
				close: function () {
				}
			}
		});
	}

   	$scope.ClosePVForm = function()
   	{
   		$scope.pvform = false;
   	}

}]);