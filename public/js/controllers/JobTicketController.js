app.controller('JobTicketController', ['$scope', '$http', function($scope, $http){
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
			url: '/ge/physicalverification?cat=withrma'
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.physicalverification;
		}, function error(response) {
		});
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

	$scope.LoadData = function(page)
	{
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