

app.filter('propsFilter', function() {
	return function(items, props) {
		var out = [];

		if (angular.isArray(items)) {
			var keys = Object.keys(props);

			items.forEach(function(item) {
				var itemMatches = false;

				for (var i = 0; i < keys.length; i++) {
					var prop = keys[i];
					var text = props[prop].toLowerCase();
					if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
						itemMatches = true;
						break;
					}
				}

				if (itemMatches) {
					out.push(item);
				}
			});
		} else {
      // Let the output be the input untouched
      out = items;
  }

  return out;
};
});


app.controller('WarrantyController' ,['$scope', '$http','Notification' , 'DataShareService', function($scope, $http , Notification , DataShareService) {

	wc = this;
	$scope.warrantymodal = {};
	$scope.show_po = false;
	$scope.show_wbs = false;
	$scope.show_rca_options = false;
	$scope.tab = 'managerapproval';
	$scope.people = [
	{ name: 'GokulaKrishnan',      email: 'gokulakrishnan.a@ge.com'},
	{ name: 'Paramasivam',    email: 'ravi.kolasi-paramasivam@ge.com'},
	{ name: 'Jayakumaran', email: 'jayakumaran.s-r@ge.com'},
	{ name: 'Jovin',    email: 'jovin.tp@ge.com'},
	{ name: 'Naresh',  email: 'naresh.devaraj@ge.com'},
	{ name: 'Raman',  email: 'raman.aravind@ge.com'},
	{ name: 'Stanley',    email: 'stanley.p.geoffrey@ge.com'},
	{ name: 'Jyothi',   email: 'jyothi.seetharaman@ge.com'},
	{ name: 'Balaji',   email: 'kannan.balaji1@ge.com'},
	];

	$scope.loadedRIDs = [1234 , 54321 , 6578];
	
	$scope.warrantymodal.selectedPeople =[$scope.people[0] ];
	$scope.warrantymodal.selectedCCPeople =[ $scope.people [4]];
	$scope.warrantymodal.selectedRID=[];
	$scope.selectedpvs=[123];
	$scope.controller = {};
	$scope.warrantymodal.title = 'Warranty Form';
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

	$scope.OpenWarrantyModal = function()
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
		else if ($scope.selectedpvs.length > 1 && $scope.tab == 'customerapproval')
		{
			Notification.error("Select One Relay");
			return;
		}
		console.log($scope.selectedpvs);
		if ($scope.tab == 'customerapproval')
		{
			$scope.warrantymodal = {};
			$http({
				method: 'GET',
				url: '/ge/getwarranty/'+$scope.selectedpvs[0]
			}).then(function success(response) {
				$scope.warrantymodal = {};
				$scope.warrantymodal = response.data.data;
				$scope.warrantymodal.title = 'Edit Warranty';
				console.log($scope.warrantymodal)
				$scope.OnRCAChanged();
				$scope.ValidateStatus();
			}, function error(response) {
			});
		}
		else
		{
			$scope.warrantymodal = {};
			$scope.warrantymodal.title = 'Warranty Form';
			$scope.warrantymodal.rca = false;
			$scope.warrantymodal.smp = 0;
			$scope.warrantymodal.pcp = 0;
			$scope.warrantymodal.type = 0;
			$scope.warrantymodal.move = 0;
			$scope.OnRCAChanged();
		}
		$('#warrantymodal').modal({
			show: true,
			backdrop: 'static',
		});

	}



	$scope.CloseWarrantyModal = function()
	{
		$('#warrantymodal').modal('hide');
	}


	$scope.GetPVList = function(cat = 'managerapproval')
	{
		$scope.tab = cat;
		$http({
			method: 'GET',
			url: '/ge/physicalverification?cat='+cat
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.physicalverification;
		}, function error(response) {
		});
	}


	$scope.Reset = function()
	{
		$scope.filterID = '';
		$scope.filterRMAID = '';
		$scope.productFilter = '';
		$scope.serialFilter = '';
		$scope.filterendCustomer = '';
		$scope.filterpvdate = '';
		$scope.filterCustomer = '';
		$scope.dateTo = '';
		$scope.dateFrom = '';
	}


	$scope.ValidateStatus = function() {

		console.log($scope.show_po);
		console.log($scope.warrantymodal.pcp);

		if(($scope.warrantymodal.smp == "1" || $scope.warrantymodal.smp == "2")  && $scope.warrantymodal.pcp == "1")
		{
			$scope.show_po = true;
			$scope.show_wbs = false;
		}

		else if($scope.warrantymodal.smp == "1" && $scope.warrantymodal.pcp == "2")
		{
			$scope.show_po = false;
			$scope.show_wbs = true;
		}

		else
		{
			$scope.show_po = false;
			$scope.show_wbs = false;
		}
	}

	$scope.OnRCAChanged = function() {

		if($scope.warrantymodal.rca)
			$scope.show_rca_options = true;

		else
			$scope.show_rca_options = false;

	}
	$scope.Debug = function()
	{
		console.log($scope.selectedRID);
		console.log($scope.selectedpvs);
	}

	$scope.AddWC= function()
	{
		console.log($scope.warrantymodal);
		if (!$scope.warrantymodal.smp)
		{
			Notification.error("Select SMP");
			return;
		}
		if (!$scope.warrantymodal.pcp)
		{
			Notification.error("Select PCP");
			return;
		}
		if (!$scope.warrantymodal.type)
		{
			Notification.error("Select Type");
			return;
		}
		if (!$scope.warrantymodal.move)
		{
			Notification.error("Select Move");
			return;
		}
		if(($scope.warrantymodal.smp == 1 && $scope.warrantymodal.pcp == 2) && ($scope.warrantymodal.wbs == undefined || $scope.warrantymodal.wbs == ""))
		{
			Notification.error("Enter WBS");
			return;
		}
		if ($scope.warrantymodal.rca)
		{
			if ($scope.warrantymodal.selectedRID.length == 0)
			{
				Notification.error("Select Mail To");
				return;
			}

			if($scope.warrantymodal.addmail != null && $scope.warrantymodal.addmail != "" && $scope.warrantymodal.addmail != undefined)
			{
				var emails = $scope.warrantymodal.addmail.split(" ");
				$scope.warrantymodal.temp = [];
				console.log(emails)
				for (var i = 0; i < emails.length; i++) {
					console.log(emails[i]);
					if(!/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/.test(emails[i]))
					{
						Notification.error("Enter Valid Mail Ids Seperated by <b>Space</b> in <b>Add Mail To Field</b>");
						return;
					}
					else
					{
						$scope.warrantymodal.temp.push(emails[i]);
					}
				}
				$scope.warrantymodal.addmailarray = $scope.warrantymodal.temp;
				console.log($scope.warrantymodal.addmailarray)
			}

			if($scope.warrantymodal.addcc != null && $scope.warrantymodal.addcc != "" && $scope.warrantymodal.addcc != undefined)
			{
				var emails = $scope.warrantymodal.addcc.split(" ");
				$scope.warrantymodal.temp = [];
				console.log(emails)
				for (var i = 0; i < emails.length; i++) {
					console.log(emails[i]);
					if(!/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/.test(emails[i]))
					{
						Notification.error("Enter Valid Mail Ids Seperated by <b>Space</b> in <b>Add CC Field</b>");
						return;
					}
					else
					{
						$scope.warrantymodal.temp.push(emails[i]);
					}
				}
				$scope.warrantymodal.addccarray = $scope.warrantymodal.temp;
				console.log($scope.warrantymodal.addccarray)
			}

			if ($scope.warrantymodal.selectedPeople.length == 0)
			{
				Notification.error("Select CC");
				return;
			}

			if ($scope.warrantymodal.selectedCCPeople.length == 0)
			{
				Notification.error("Select CC");
				return;
			}

			if ($scope.warrantymodal.message == "" || $scope.warrantymodal.message == undefined)
			{
				Notification.error("Enter Message");
				return;
			}
		}

		$http({
			method: 'post',
			url: '/ge/addwc',
			data: {
				'warranty': $scope.warrantymodal,
				'pvs': $scope.selectedpvs,
			},
		}).then(function success(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.CloseWarrantyModal();
				$scope.GetPVList();
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

	$scope.UpdateWC = function()
	{
		$http({
			method: 'post',
			url: '/ge/updatewc',
			data: {
				'warranty': $scope.warrantymodal,
			},
		}).then(function success(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.CloseWarrantyModal();
				$scope.GetPVList('customerapproval');
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

}]);