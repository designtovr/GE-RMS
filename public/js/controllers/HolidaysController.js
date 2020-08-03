app.controller('HolidaysController', ['$scope', '$http', 'Notification', '$filter' , function($scope, $http , Notification, $filter){
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
   	$scope.OpenHolidaysModal = function(item = '')
   	{
   		console.log(item)
   		if(!item)
   		{
   			$scope.Holidaysmodal.holiday_date = '';
   			$scope.Holidaysmodal.title = 'Add Holiday';
   			$scope.Holidaysmodal.description = item.description;
   		}
   		else
   		{
   			$scope.Holidaysmodal.title = 'Edit Holiday';
   			$scope.Holidaysmodal.id = item.id;
   			$scope.Holidaysmodal.holiday_date = $filter('date')(item.holiday_date, "yyyy-MM-dd");
   			$scope.Holidaysmodal.description = item.description;
   		}
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
		$scope.Holidaysmodal.holiday_date = $filter('date')($scope.Holidaysmodal.holiday_date, "yyyy-MM-dd");
		$http({
			method: 'post',
			url: '/ge/addHolidays',
			data: {
				'Holidays': $scope.Holidaysmodal,
			},
		}).then(function success(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.CloseHolidaysModal();
				$scope.getHolidays();
				$scope.Holidaysmodal = {};
			}
			else if (response.data.status == 'failure')
			{
				Notification.error(response.data.message)
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
			if (response.data.status == 'success')
			{
				$scope.gridOptions.data =  response.data.data;
			}
		}, function error(response) {

		});
	}

	$scope.DeleteHoliday = function(id)
	{
		$http({
			method: 'DELETE',
			url: '/ge/deleteHoliday/'+ id,
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message)
			}
			else if (response.data.status == 'failure')
			{
				Notification.error(response.data.message)
			}
			$scope.getHolidays();
		}, function error(response) {

		});
	}

}]);