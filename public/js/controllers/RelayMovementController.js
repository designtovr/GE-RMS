app.controller('RelayMovementController', ['$scope', '$http', 'Notification' , function($scope, $http , Notification){
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

   	$scope.AddRMS= function()
	{
		$http({
			method: 'post',
			url: '/ge/addrms',
			data: {
				'rms': $scope.rmsmodal,
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				Notification.success(response.data.message);
				$scope.CloseRMSModal();
				$scope.getRMS();
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

	$scope.getRMS = function()
	{
		$http({
			method: 'GET',
			url: '/ge/getrms'
		}).then(function success(response) {
			$scope.receipts = response.data.data;
			$scope.gridOptions.data =  response.data.data;
		}, function error(response) {

		});
	}
}]);