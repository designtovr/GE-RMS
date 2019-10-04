

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
	$scope.people = [
	{ name: 'Sudhakar',      email: 'Sudhakar@email.com',      age: 12, country: 'United States' },
	{ name: 'Krishnan',    email: 'Krishnan@email.com',    age: 12, country: 'Argentina' },
	{ name: 'Balaji', email: 'Balaji@email.com', age: 21, country: 'Argentina' },
	{ name: 'Srinivas',    email: 'Srinivas@email.com',    age: 21, country: 'Ecuador' },
	{ name: 'Arun',  email: 'Arun@email.com',  age: 30, country: 'Ecuador' },
	{ name: 'Samantha',  email: 'samantha@email.com',  age: 30, country: 'United States' },
	{ name: 'Nicole',    email: 'nicole@email.com',    age: 43, country: 'Colombia' },
	{ name: 'Natasha',   email: 'natasha@email.com',   age: 54, country: 'Ecuador' },
	{ name: 'Michael',   email: 'michael@email.com',   age: 15, country: 'Colombia' },
	{ name: 'Nicolás',   email: 'nicolas@email.com',    age: 43, country: 'Colombia' }
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
		DataShareService.setRIdList($scope.selectedpvs);
		console.log($scope.selectedpvs);
		$scope.warrantymodal = {};
		$scope.warrantymodal.title = 'Warranty Form';
		$scope.warrantymodal.rca = false;
		$scope.warrantymodal.smp = 0;
		$scope.warrantymodal.pcp = 0;
		$scope.warrantymodal.type = 0;
		$scope.warrantymodal.move = 0;
		$scope.OnRCAChanged();
		$('#warrantymodal').modal('show');

	}



	$scope.CloseWarrantyModal = function()
	{
		$('#warrantymodal').modal('hide');
	}


	$scope.Start = function()
	{
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
		if(($scope.warrantymodal.smp == 1 && $scope.warrantymodal.pcp == 1) && ($scope.warrantymodal.po == undefined || $scope.warrantymodal.po == ""))
		{
			Notification.error("Enter PO");
			return;
		}
		if(($scope.warrantymodal.smp == 1 && $scope.warrantymodal.pcp == 2) && ($scope.warrantymodal.wbs == undefined || $scope.warrantymodal.wbs == ""))
		{
			Notification.error("Enter WBS");
			return;
		}
		if(($scope.warrantymodal.smp == 2 && $scope.warrantymodal.pcp == 1) && ($scope.warrantymodal.po == undefined || $scope.warrantymodal.po == ""))
		{
			Notification.error("Enter PO");
			return;
		}
		if ($scope.warrantymodal.rca)
		{
			if ($scope.warrantymodal.selectedRID.length == 0)
			{
				Notification.error("Select Mail To");
				return;
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
				$scope.Start();
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