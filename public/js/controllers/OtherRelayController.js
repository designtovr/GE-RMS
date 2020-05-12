app.controller('OtherRelayController', ['$scope', '$http', 'Notification', 'ChangePVStatusService' , function($scope, $http , Notification, ChangePVStatusService){
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

	$scope.OtherRelays = function()
	{
		$http({
			method: 'GET',
			url: '/ge/physicalverification?cat=others'
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.physicalverification;
		}, function error(response) {
		});
	}

	$scope.ChangeOtherRelayStatus = function(pv_id, status)
	{
		ChangePVStatusService.ChangeOtherRelayStatus(pv_id, status, function(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.OtherRelays();
			}
			else if (response.data.status == 'failure')
			{
				Notification.success(response.data.message);
			}
			else if (response.status == 422)
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

}]);