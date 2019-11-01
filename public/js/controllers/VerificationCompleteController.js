app.controller('VerificationCompleteController', ['$scope', '$http', 'Notification','ChangePVStatusService', '$filter', '$ngConfirm', 'PVPriorityService', function($scope, $http ,Notification,ChangePVStatusService, $filter , $ngConfirm, PVPriorityService){
	$scope.vcform = false;
	$scope.vcformdata = {};
	$scope.status='agingcompleted';
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
				$scope.status = 'agingcompleted';
				$scope.openTab = true;
				$http({
					method: 'GET',
					url: '/ge/physicalverification?cat=agingcompleted'
				}).then(function success(response) {
					$scope.gridOptions.data =  response.data.physicalverification;
				}, function error(response) {
				});
				$scope.GetPVPriorityList();
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


			$scope.Reset = function()
			{
				$scope.filterrmaID = '';
				$scope.filterID = '';
				$scope.filterpart_no = '';
				$scope.filterpvdate = '';
				$scope.filterCustomer = '';
				$scope.filterserial_no = '';
				$scope.filterCustomer = '';
				$scope.filterendCustomer = '';
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
				$scope.page = page;
				$scope.openTab = false;
				$scope.startTab = false;
				$scope.completedTab = false;
				if(page == '1')
					$scope.openTab = true;
				if(page == '2')
					$scope.startTab = true;
				if (page == '3')
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

   	$scope.ShowVCForm = function(item)
   	{
   		console.log(item);
   		$scope.vcformdata = item;
   		$scope.vcformdata.clio_test = false;
   		$scope.vcformdata.rtd_test = false;
   		$scope.vcformdata.nic_test = false;
   		$scope.vcformdata.received_with_screws = false;
   		$scope.vcformdata.received_with_terminal = false;
   		$scope.vcformdata.date = $filter('date')(new Date(),'dd/MM/yyyy');
   		$scope.vcform = true;

   	}

   	$scope.CloseVCForm = function()
   	{
   		$scope.vcform = false;
   	}

   	$scope.SaveVerification = function()
   	{
   		console.log($scope.vcformdata);
   		$http({
			method: 'POST',
			url: '/ge/saveverification',
			data: {
				'vc': $scope.vcformdata
			}
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$ngConfirm({
					title: 'Print',
					content: 'Are you want to print?',
					type: 'blue',
					typeAnimated: true,
					buttons: {
						print: {
							text: 'Print',
							btnClass: 'btn-blue',
							action: function(){
								$scope.CloseVCForm();
								$scope.GetPV('agingcompleted');
							}
						},
						close: function () {
							$scope.CloseVCForm();
							$scope.GetPV('agingcompleted');
						}
					}
				});
			}
		}, function error(response) {
		});
   	}

}]);