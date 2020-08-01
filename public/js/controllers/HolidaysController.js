app.controller('HolidaysController', ['$scope', '$http', 'Notification' , function($scope, $http , Notification){
	$scope.Holidaysmodal = {};
	$scope.Holidaysmodal.title = "Holidays";
	$scope.selectedpvs = [];
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
   	$scope.OpenHolidaysModal = function()
   	{
   		$('#Holidaysmodal').modal({
			show: true,
			backdrop: 'static',
		});
   	}
   	$scope.CloseHolidaysModal = function()
   	{
   		$('#Holidaysmodal').modal('hide');
   	}

   	$scope.AddHolidays= function()
	{
		$http({
			method: 'post',
			url: '/ge/addHolidays',
			data: {
				'Holidays': $scope.Holidaysmodal,
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				Notification.success(response.data.message);
				$scope.CloseHolidaysModal();
				$scope.getHolidays();
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

	$scope.Reset = function()
	{
		$scope.filterID = '';
		$scope.filterreceipt_id = '';
		$scope.dateFrom = '';
		$scope.dateTo = '';
	}

	$scope.getHolidays = function()
	{
		$http({
			method: 'GET',
			url: '/ge/getHolidays'
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.data;
		}, function error(response) {

		});
	}
}]);