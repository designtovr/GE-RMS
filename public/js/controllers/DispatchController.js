app.controller('DispatchController', ['$scope', '$http','$filter', function($scope, $http,$filter){
	
	$scope.showdpform = false;
	$scope.dispatch = {};

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
			
	$scope.AddDispatch= function()
	{
		$http({
			method: 'post',
			url: '/ge/adddispatch',
			data: {
				'dispatch': $scope.dispatch,
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.messagae)
				$scope.HideDPForm();
				/*$('#customermodal').modal('hide');*/
				$scope.getDispatches();
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

	$scope.getDispatches = function()
	{
/*		$http({
			method: 'GET',
			url: '/ge/dispatches'
		}).then(function success(response) {
			$scope.dispatch = response.data.data;
			$scope.gridOptions.data =  response.data.data;
		}, function error(response) {

		});*/
	}

	$scope.ShowDPForm = function()
	{
		$scope.showdpform = true;
		console.log("ihi")
	}

	$scope.HideDPForm = function()
	{
		$scope.showdpform = false;
		console.log("hide")
	}

	$scope.Initiate = function()
	{
		console.log("Dispatch")
		$scope.dispatch.date = $filter('date')(new Date(),'dd/MM/yyyy');
		$scope.showdpform = false;
	}

	}]);