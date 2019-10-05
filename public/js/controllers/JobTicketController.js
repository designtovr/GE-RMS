app.controller('JobTicketController', ['$scope', '$http', 'Notification', 'ChangePVStatusService', function($scope, $http, Notification, ChangePVStatusService){
	$scope.showjtform = false;
	$scope.startTab = false;
	$scope.openTab = false;
	$scope.jobticket = {};
	$scope.tab = 'jobticketopen';

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
		$scope.tab = page;
		if(page == 'jobticketopen')
			$scope.openTab = true;

		if(page == 'jobticketstarted')
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
		$http({
			method: 'GET',
			url: '/ge/jobticket/'+item.id,
		}).then(function success(response) {
			$scope.jobticket =  response.data.data;
			if ($scope.jobticket.job_ticket_materials.length == 0)
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
		}, function error(response) {
		});
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
		if ($scope.jobticket.job_ticket_materials.length == 1)
		{
			Notification.error("Atleast One Required");
			return;
		}
		$scope.jobticket.job_ticket_materials.splice(index);
	}

	$scope.SaveMaterial = function()
	{
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