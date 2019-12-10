app.controller('DispatchController', ['$scope', '$http','$filter','Notification', 'ChangePVStatusService', '$ngConfirm', 'PVPriorityService', function($scope, $http,$filter ,Notification , ChangePVStatusService, $ngConfirm, PVPriorityService){
	
	$scope.showdpform = false;
	$scope.dispatch = {};
	$scope.status = 'dispatchapproved';
	$scope.page = 1;

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
					url: '/ge/physicalverification?cat=dispatchapproved'
				}).then(function success(response) {
					$scope.gridOptions.data =  response.data.physicalverification;
				}, function error(response) {
				});
			}


			$scope.Reset = function()
			{
				$scope.filterrmaID = '';
				$scope.filterID = '';
				$scope.filterreceipt_id = '';
				$scope.filterpart_no = '';
				$scope.filterserial_no = '';
				$scope.filterpvdate = '';
				$scope.filterCustomer = '';
				$scope.filterendCustomer = '';
				$scope.dateTo = '';
				$scope.dateFrom = '';
			}

	
			$scope.ChangeStatus = function(status)
			{
				console.log($scope.gridOptions.data);
				$scope.selectedpvs = [];
				for (var i = 0; i < $scope.gridOptions.data.length; i++) {
					if ($scope.gridOptions.data[i].create_wc != undefined && $scope.gridOptions.data[i].create_wc)
					{
						$scope.selectedpvs.push($scope.gridOptions.data[i].id);
						$scope.dispatch= $scope.gridOptions.data[i];
						$scope.dispatch.docket_details = '';
						$scope.dispatch.courier_name = '';
						$scope.dispatch.method = 1;
						$scope.dispatch.date = $filter('date')(new Date(),'dd/MM/yyyy');
					}
				}
				if ($scope.selectedpvs.length == 0)
				{
					Notification.error("No Relay Selected");
					return;
				}
				/*if ($scope.selectedpvs.length > 1)
				{
					Notification.error("Select One Relay");
					return;
				}*/
				console.log($scope.selectedpvs);

				/*$scope.ChangePVStatus($scope.selectedpvs ,status);
				$('#all-tab').addClass('active');
				$('#withrma-tab').removeClass('active');
				$scope.LoadData('1');
				$scope.GetPV('atbopen');*/
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

		$scope.ChangePVStatus = function(pvids, status)
		{
			ChangePVStatusService.ChangePVStatus(pvids, status, function(response){
				if (response.data.status == 'success')
				{
					Notification.success(response.data.message);
					$scope.GetPV(status);
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
			
		$scope.AddDispatch= function()
		{
			$http({
				method: 'post',
				url: '/ge/adddispatch',
				data: {
					'dispatch': $scope.dispatch,
					'selectedpvs': $scope.selectedpvs
				},
			}).then(function success(response){
				if (response.status == 200)
				{
					var content = response.data.message + ', Are You Want to Print?';
					$ngConfirm({
						title: '<b>Print!!</b>',
						content: content,
						type: 'blue',
						typeAnimated: true,
						buttons: {
							print: {
								text: 'Print',
								btnClass: 'btn-blue',
								action: function(){
									$scope.HideDPForm();
									$scope.GetPV('dispatchapproved');
								}
							},
							close: function () {
								$scope.HideDPForm();
								$scope.GetPV('dispatchapproved');
							}
						}
					});
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
		$scope.ChangeStatus('dispatched');

		if($scope.selectedpvs.length == 0)
			return;

		$scope.showdpform = true;
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
		$scope.GetPVPriorityList();
	}

	}]);