app.controller('RelayMovementController', ['$scope', '$http', 'Notification' , function($scope, $http , Notification){
	$scope.rmsmodal = {};
	$scope.rmsmodal.title = "RMS";
	$scope.selectedpvs = [];
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
   		console.log($scope.gridOptions.data);
		$scope.selectedpvs = [];
		for (var i = 0; i < $scope.gridOptions.data.length; i++) {
			if ($scope.gridOptions.data[i].selected != undefined && $scope.gridOptions.data[i].selected)
			{
				$scope.selectedpvs.push($scope.gridOptions.data[i]);
			}
		}
		if ($scope.selectedpvs.length == 0)
		{
			Notification.error("No Relay Selected");
			return;
		}
		else if ($scope.selectedpvs.length > 1)
		{
			Notification.error("Select One Relay");
			return;
		}
		$scope.rmsmodal = $scope.selectedpvs[0];
		console.log($scope.selectedpvs);
   		$('#rmsmodal').modal({
			show: true,
			backdrop: 'static',
		});
   	}
   	$scope.CloseRMSModal = function()
   	{
   		$('#rmsmodal').modal('hide');
   	}

   	$scope.AddRMS= function()
	{
		$scope.rmsmodal.pv_id = $scope.rmsmodal.formatted_pv_id;
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
		$scope.filterID = '';
		$scope.filterreceipt_id = '';
		$scope.dateFrom = '';
		$scope.dateTo = '';
	}

	$scope.getRMS = function()
	{
		$http({
			method: 'GET',
			url: '/ge/getrms'
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.data;
		}, function error(response) {

		});
	}
}]);