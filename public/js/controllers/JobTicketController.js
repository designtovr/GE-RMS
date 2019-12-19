app.controller('JobTicketController', ['$scope', '$http', 'Notification', 'ChangePVStatusService', '$ngConfirm', 'PVPriorityService', '$window', '$timeout', function($scope, $http, Notification, ChangePVStatusService, $ngConfirm, PVPriorityService, $window, $timeout){
	$scope.showjtform = false;
	$scope.startTab = false;
	$scope.openTab = false;
	$scope.jobticket = {};
	$scope.tab = 'jobticketopen';
	$scope.page = 'jobticketopen';
	$scope.pvprioritylist = [];
	$scope.pvprioritylistmax = 0;
	$scope.jtmaterialspartnos = [];

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

	$scope.type_of_work =[
		{ 'id': 1, 'value': 'Repair'},
		{ 'id': 2, 'value': 'Modification'},
		{ 'id': 3, 'value': 'Investigation'}
	];

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
		$scope.filterrmaID = '';
		$scope.dateTo = '';
		$scope.dateFrom = '';
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
		$scope.LoadData($scope.page);
	}

	$scope.startTab = false;
	$scope.openTab = false;

	$scope.ChangePVStatus = function(pvids, status)
	{
		ChangePVStatusService.ChangePVStatus(pvids, status, function(response){
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
		console.log(page);
		$scope.openTab = false;
		$scope.startTab = false;
		$scope.completedTab = false;
		$scope.page = page;
		if(page == 'jobticketopen')
			$scope.openTab = true;

		if(page == 'jobticketstarted')
			$scope.startTab = true;

		//we're using page value for category
		//so change page value to inrepair
		//according to new flow
		if (page == 'jobticketcompleted')
		{
			page = 'inrepair';
			$scope.completedTab = true;
		}

		$http({
			method: 'GET',
			url: '/ge/physicalverification?cat='+page
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.physicalverification;
			$scope.GetPVPriorityList();
		}, function error(response) {
		});
	}

	$scope.OpenJTForm = function(item)
	{
		console.log(item)
		$scope.GetJTMaterialsPartNos();
		$scope.showjtform = true;
		var exists = false;
		if (item.status != "Job Ticket Open")
			exists = true;
		$http({
			method: 'GET',
			url: '/ge/jobticket/'+item.id,
		}).then(function success(response) {
			$scope.jobticket =  response.data.data;
			console.log($scope.jobticket);
			$scope.jobticket.service_type = item.service_type;
			if ($scope.jobticket.job_ticket_materials.length == 0 && $scope.page != 'jobticketcompleted')
			{
				$scope.jobticket.job_ticket_materials = [];
				var jobmaterial = {}
				jobmaterial.part_no = '';
				jobmaterial.value = '';
				jobmaterial.old_pcp = '';
				jobmaterial.new_pcp = '';
				jobmaterial.comment = '';
				$scope.jobticket.job_ticket_materials.push(jobmaterial);
			}
			console.log($scope.jobticket)
			if (!exists)
				$scope.ChangePVStatus([$scope.jobticket.pv_id], 'jobticketstarted');
		}, function error(response) {
		});
	}

	$scope.ChangePVStatusToStarted = function()
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
		$scope.ChangePVStatus($scope.selectedpvs, 'jobticketstarted');
		$scope.LoadData($scope.page);
		$scope.showjtform = false;
	}

	$scope.UpdateSiteJTForm = function()
	{
		console.log($scope.jobticket);
		for (var i = 0; i < $scope.jobticket.job_ticket_materials.length; i++) {
			if ($scope.jobticket.job_ticket_materials[i].new_pcp == '' || $scope.jobticket.job_ticket_materials[i].new_pcp == null)
			{
				Notification.error("Fill Every New PCB");
					return;
			}
		}
		$http({
			method: 'POST',
			url: '/ge/updatesitecardjobticket',
			data: {
				'jobticket': $scope.jobticket
			}
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.LoadData($scope.page);
				$scope.showjtform = false;
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

	$scope.CompleteJTForm = function()
	{
		console.log($scope.jobticket)
		for (var i = 0; i < $scope.jobticket.job_ticket_materials.length; i++) {
			if ($scope.jobticket.job_ticket_materials[i].part_no == '' || $scope.jobticket.job_ticket_materials[i].part_no == null)
			{
 				Notification.error("Fill Every Part No");
 				return;
			}
			if ($scope.jobticket.job_ticket_materials[i].old_pcp == '' || $scope.jobticket.job_ticket_materials[i].old_pcp == null)
			{
				Notification.error("Fill Every Defective PCB");
 				return;
			}
			//If the service type is Serivce Card
			//Allow the Job ticket without New PCB
			if ($scope.jobticket.service_type != 2)
			{
				if ($scope.jobticket.job_ticket_materials[i].new_pcp == '' || $scope.jobticket.job_ticket_materials[i].new_pcp == null)
				{
					Notification.error("Fill Every New PCB");
	 				return;
				}
			}
		}

		$http({
			method: 'POST',
			url: '/ge/completejobticket',
			data: {
				'jobticket': $scope.jobticket
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
								$scope.LoadData($scope.page);
								$scope.showjtform = false;
								$timeout(function(){
									$scope.PrintForm(response.data.job_ticket.pv_id);
								}, 500);
							}
						},
						close: function () {
							$scope.LoadData($scope.page);
							$scope.showjtform = false;
						}
					}
				});
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

	$scope.PrintForm = function(pv_id)
	{
		$window.open('/ge/job-ticket-form/'+pv_id, '_blank');
	}

	$scope.AddMaterial = function()
	{
		var jobmaterial = {}
		jobmaterial.part_no = '';
		jobmaterial.value = '';
		jobmaterial.old_pcp = '';
		jobmaterial.new_pcp = '';
		jobmaterial.comment = '';
		$scope.jobticket.job_ticket_materials.push(jobmaterial);
	}

	$scope.RemoveMaterial = function(index)
	{
		$scope.jobticket.job_ticket_materials.splice(index, 1);
	}

	$scope.GetJTMaterialsPartNos = function()
	{
		$http({
			method: 'GET',
			url: '/ge/jtmaterialspartnos',
		}).then(function success(response){
			if (response.data.status == 'success')
			{
				$scope.jtmaterialspartnos = response.data.data;
				console.log($scope.jtmaterialspartnos)
			}
		}).then(function error(response){

		});
	}

	$scope.SaveMaterial = function()
	{
		for (var i = 0; i < $scope.jobticket.job_ticket_materials.length; i++) {
			if ($scope.jobticket.job_ticket_materials[i].part_no == '' 
				&& $scope.jobticket.job_ticket_materials[i].quantity == ''
				&& $scope.jobticket.job_ticket_materials[i].old_pcp == '' 
				&& $scope.jobticket.job_ticket_materials[i].new_pcp == ''
				)
			{
 				Notification.error("Fill Atleast One Field");
 				return;
			}
		}
		$http({
			method: 'POST',
			url: '/ge/savejobticketmaterial',
			data: {
				'jobticket': $scope.jobticket
			}
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.LoadData($scope.page);
				$scope.showjtform = false;
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

}]);