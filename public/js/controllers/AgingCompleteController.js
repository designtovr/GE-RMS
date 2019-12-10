app.controller('AgingCompleteController', ['$scope', '$http','Notification','ChangePVStatusService', 'PVPriorityService', function($scope, $http , Notification,ChangePVStatusService, PVPriorityService)
{
	$scope.agingmodal = {};
	$scope.agingmodal.title = 'Aging Process';
	$scope.status='atbcompleted';
	$scope.page = 1;
	$scope.pvprioritylist = [];
	$scope.pvprioritylistmax = 0;
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
		$scope.GetPVPriorityList();
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
		$scope.dateTo = '';
		$scope.dateFrom = '';
	}

	$scope.GetPVPriorityList = function()
	{
		$scope.pvprioritylist = PVPriorityService.GetPVPriorityList(function(list, max)
		{
			$scope.pvprioritylist = list;
			$scope.pvprioritylistmax = max;
			console.log($scope.pvprioritylist);
		});
	}

	$scope.SetPVPriority = function(pv_id, priority)
	{
		PVPriorityService.SetPVPriority(pv_id, priority, function(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.LoadData($scope.page);
				$scope.GetPV($scope.status);
				$scope.GetPVPriorityList();
			}
			else if (response.data.status == 'failure')
			{
				Notification.error(response.data.message);
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
		$scope.LoadData($scope.page);
		$scope.GetPV($scope.status);
	}

	$scope.OpenAgingModal = function()
	{
		console.log($scope.gridOptions.data);
		$scope.agingmodal = {};
		$scope.agingmodal.title = 'Aging Process';
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
				$scope.LoadData($scope.page);
				$scope.GetPV($scope.status);
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
		$scope.page = page;
		$scope.openTab = false;
		$scope.startTab = false;
		$scope.completedTab = false;
		if(page == '1')
			$scope.openTab = true;
		
		if(page == '2')
			$scope.startTab = true;

		if(page == '3')
			$scope.completedTab = true;

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