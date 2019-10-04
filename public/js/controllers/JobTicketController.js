app.controller('JobTicketController', ['$scope', '$http', 'Notification', 'ChangePVStatusService', function($scope, $http, Notification, ChangePVStatusService){
	$scope.showjtform = false;
	$scope.startTab = false;
	$scope.openTab = false;
	$scope.jobticket = {};

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
		$scope.openTab = true;
		$scope.jobticket = {};
		$http({
			method: 'GET',
			url: '/ge/physicalverification?cat=jobticketopen'
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.physicalverification;
		}, function error(response) {
		});
	}

	$scope.getList = function()
	{
		$scope.pvlist = ChangePVStatusService.getList('jobticketopen');
		console.log($scope.pvlist);
	}


	$scope.Reset = function()
	{
		$scope.filterID = '';
		$scope.filterreceipt_id = '';
		$scope.filterpvdate = '';
		$scope.filterCustomer = '';
	}

	$scope.Initiate = function()
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
		DataShareService.setRIdList($scope.selectedpvs);
		console.log($scope.selectedpvs);
	}
	$scope.CloseJTForm = function()
	{
		$scope.showjtform = false;
		$scope.jobticket = {};
	}

	$scope.startTab = false;
	$scope.openTab = false;

	$scope.ChangePVStatus = function(pvids, status)
	{
		$scope.pvlist = ChangePVStatusService.ChangePVStatus(pvids, status, function(response){
			if (response.data.status == 'success')
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

	$scope.LoadData = function(page)
	{
		
		console.log($scope.pvlist);
		console.log(page);
		$scope.openTab = false;
		$scope.startTab = false;
		if(page == '1')
			$scope.openTab = true;

		if(page == '2')
			$scope.startTab = true;

		$http({
			method: 'GET',
			url: '/ge/physicalverification?cat='+page
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.physicalverification;
		}, function error(response) {
		});
	}

	$scope.OpenJTForm = function(item)
	{
		$scope.showjtform = true;
		$scope.jobticket = item;
	}

}]);