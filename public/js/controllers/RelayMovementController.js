app.controller('RelayMovementController', ['$scope', '$http', function($scope, $http){
	$scope.rmsmodal = {};
	$scope.rmsmodal.title = "RMS";
$scope.gridOptions = {
		pagination: {
			itemsPerPage: '10'
		},
		data:[]
				, //required parameter - array with data
				//optional parameter - start sort options
				sort: {

				},
				urlSync: true
			};
   	$scope.OpenRMSModal = function()
   	{
   		$('#rmsmodal').modal('show');
   	}
   	$scope.CloseRMSModal = function()
   	{
   		$('#rmsmodal').modal('hide');
   	}

   	$scope.AddReceipt= function()
	{
		$http({
			method: 'post',
			url: '/ge/addreceipt',
			data: {
				'receipt': $scope.receipt,
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				Notification.success(response.data.message);
				$scope.HideReceiptForm();
				$scope.getReceipts();
			}
		}, function failure(response){
			if (response.status == 422)
			{

				var errors = response.data.errors;
				for(var error in errors)
				{
					Notification.error(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.Reset = function()
	{
		$scope.filterid = '';
		$scope.filterpvdate = '';
		$scope.filterCustomer = '';
	}

	$scope.getReceipts = function()
	{
		$http({
			method: 'GET',
			url: '/ge/receipts'
		}).then(function success(response) {
			$scope.receipts = response.data.data;
			$scope.gridOptions.data =  response.data.data;
		}, function error(response) {

		});
	}
}]);