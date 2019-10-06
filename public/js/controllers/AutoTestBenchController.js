app.controller('AutoTestBenchController', ['$scope', '$http','Notification','ChangePVStatusService', function($scope, $http , Notification,ChangePVStatusService)
{

	$scope.testbenchmodal = {};
	$scope.testbenchmodal.title = 'Test Process';
	$scope.OpenTestBenchModal = function()
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
		$('#testbenchmodal').modal('show');
	}

	$scope.SaveTestResult = function()
	{
		console.log($scope.selectedpvs)
		console.log($scope.testbenchmodal)
		if ($scope.testbenchmodal.result == undefined || $scope.testbenchmodal.result == null)
		{
			Notification.error("Please Select Result");
			return;
		}
		$http({
			method: 'POST',
			url: '/ge/savetestresult',
			data: {
				'test': $scope.testbenchmodal,
				'pvids': $scope.selectedpvs
			}
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$('#withrma-tab').addClass('active');
				$scope.LoadData('2');
				$scope.GetPV('atbstarted');
				$scope.CloseTestBenchModal();
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

	$scope.CloseTestBenchModal = function()
	{
		$('#testbenchmodal').modal('hide');
	}


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
					url: '/ge/physicalverification?cat=atbopen'
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
				$('#all-tab').addClass('active');
				$('#withrma-tab').removeClass('active');
				$scope.LoadData('1');
				$scope.GetPV('atbopen');
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