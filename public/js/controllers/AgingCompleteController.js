app.controller('AgingCompleteController', ['$scope', '$http','Notification','ChangePVStatusService', function($scope, $http , Notification,ChangePVStatusService)
{
	$scope.agingmodal = {};
	$scope.agingmodal.title = 'Aging Modal';
	$scope.status='';
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

	$scope.selectedpvs = [];
	$scope.Start = function()
	{
		console.log("Start");
		$scope.openTab = true;
		$http({
			method: 'GET',
			url: '/ge/physicalverification?cat=atbcompleted'
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.physicalverification;
		}, function error(response) {
		});
	}


	$scope.Reset = function()
	{
		$scope.filterrmaID = '';
		$scope.filterID = '';
		$scope.filterpart_no = '';
		$scope.filterserial_no = '';
		$scope.filterendCustomer = '';
		$scope.filterpvdate = '';
		$scope.filterCustomer = '';
	}

	$scope.ChangeStatus = function(status)
	{
		console.log($scope.gridOptions.data);
		$scope.selectedpvs = [];
		for (var i = 0; i < $scope.gridOptions.data.length; i++) {
			if ($scope.gridOptions.data[i].create_wc != undefined && $scope.gridOptions.data[i].create_wc)
			{
				$scope.selectedpvs.push($scope.gridOptions.data[i].id);
			}
		}
		if ($scope.selectedpvs.length == 0)
		{
			Notification.error("No Relay Selected");
			return;
		}
		console.log($scope.selectedpvs);


		$scope.ChangePVStatus($scope.selectedpvs ,status);
		if (status == 'agingcompleted')
		{
			$scope.LoadData('3');
			$scope.GetPV('agingcompleted')
			$('#withoutrma-tab').addClass('active');
			$('#withrma-tab').removeClass('active');
		}
		else if(status == 'agingstarted')
		{
			$scope.LoadData('2');
			$scope.GetPV('agingstarted');
			$('#withrma-tab').addClass('active');
			$('#all-tab').removeClass('active');
		}
	}

	$scope.OpenAgingModal = function()
	{
		console.log($scope.gridOptions.data);
		$scope.agingmodal = {};
		$scope.agingmodal.title = 'Aging Modal';
		$scope.selectedpvs = [];
		for (var i = 0; i < $scope.gridOptions.data.length; i++) {
			if ($scope.gridOptions.data[i].create_wc != undefined && $scope.gridOptions.data[i].create_wc)
			{
				$scope.selectedpvs.push($scope.gridOptions.data[i].id);
			}
		}
		if ($scope.selectedpvs.length == 0)
		{
			Notification.error("No Relay Selected");
			return;
		}
		console.log($scope.selectedpvs);
		$('#agingmodal').modal('show');
	}

	$scope.CloseAgingModal = function()
	{
		$('#agingmodal').modal('hide');
	}

	$scope.ChangePVStatus = function(pvids, status)
	{
		ChangePVStatusService.ChangePVStatus(pvids, status, function(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.GetPV($scope.status);
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

	$scope.SaveAgingResult = function()
	{
		console.log($scope.selectedpvs)
		console.log($scope.agingmodal)
		if ($scope.agingmodal.result == undefined || $scope.agingmodal.result == null)
		{
			Notification.error("Please Select Result");
			return;
		}
		$http({
			method: 'POST',
			url: '/ge/saveagingresult',
			data: {
				'test': $scope.agingmodal,
				'pvids': $scope.selectedpvs
			}
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$('#withrma-tab').addClass('active');
				$scope.LoadData('2');
				$scope.GetPV('agingstarted');
				$scope.CloseAgingModal();
			}
		}, function error(response) {
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


	$scope.startTab = false;
	$scope.openTab = false;

	$scope.LoadData = function(page)
	{
		console.log(page);
		$scope.openTab = false;
		$scope.startTab = false;
		if(page == '1')
			$scope.openTab = true;
		
		if(page == '2')
			$scope.startTab = true;

	}	


	$scope.GetPV = function(status)
	{
		$scope.status = status;
		$http({
			method: 'GET',
			url: '/ge/physicalverification?cat='+status
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.physicalverification;
		}, function error(response) {
		});
	}

}]);