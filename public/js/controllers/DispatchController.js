app.controller('DispatchController', ['$scope', '$http','$filter', function($scope, $http,$filter){
	
	$scope.showdpform = false;
	$scope.dispatch = {};

	$scope.gridOptions = {
		data: [
			{
				'rid_no': '001',
				'rma_no': '002',
				'product': 'One',
				'customer_name': 'AS',
				'end_customer': 'SA',
				'serial_no': 'Fedx',
				'model_no': 'ASE',
				'remark': 'Sample',
				'wbsno': '003',
				'customer_comment': 'Sample'
			},
			{
				'rid_no': '001',
				'rma_no': '002',
				'product': 'One',
				'customer_name': 'AS',
				'end_customer': 'SA',
				'serial_no': 'Fedx',
				'model_no': 'ASE',
				'remark': 'Sample',
				'wbsno': '003',
				'customer_comment': 'Sample'
			},
			{
				'rid_no': '001',
				'rma_no': '002',
				'product': 'One',
				'customer_name': 'AS',
				'end_customer': 'SA',
				'serial_no': 'Fedx',
				'model_no': 'ASE',
				'remark': 'Sample',
				'wbsno': '003',
				'customer_comment': 'Sample'
			}
		], //required parameter - array with data
		//optional parameter - start sort options
		sort: {
			predicate: 'companyName',
			direction: 'asc'
		}
	};


	$scope.gridOptions = {data : []};
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
		$http({
			method: 'GET',
			url: '/ge/dispatches'
		}).then(function success(response) {
			$scope.dispatch = response.data.data;
			$scope.gridOptions.data =  response.data.data;
		}, function error(response) {

		});
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