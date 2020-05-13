app.controller('OtherRelayController', ['$scope', '$http', 'Notification', 'ChangePVStatusService' , 'ExcelSave', function($scope, $http , Notification, ChangePVStatusService,ExcelSave){
	$scope.otherrelaymodal = {};
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

	$scope.OtherRelays = function()
	{
		$http({
			method: 'GET',
			url: '/ge/physicalverification?cat=others'
		}).then(function success(response) {
			$scope.gridOptions.data =  response.data.physicalverification;
		}, function error(response) {
		});
	}

	$scope.OpenOtherRelayModal = function(formatted_pv_id, pv_id, status)
	{
		$scope.otherrelaymodal.formatted_pv_id = formatted_pv_id;
		$scope.otherrelaymodal.pv_id = pv_id;
		$scope.otherrelaymodal.status = status;
		$scope.otherrelaymodal.comments = "";
		$('#otherrelaymodal').modal({
			show: true,
			backdrop: 'static',
		});
	}

	$scope.CloseOtherRelayModal = function()
	{
		$('#otherrelaymodal').modal('hide');
	}

	$scope.ChangeOtherRelayStatus = function()
	{
		ChangePVStatusService.ChangeOtherRelayStatus($scope.otherrelaymodal.pv_id, $scope.otherrelaymodal.status, $scope.otherrelaymodal.comments, function(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.CloseOtherRelayModal();
				$scope.OtherRelays();
				$scope.otherrelaymodal = {};
			}
			else if (response.data.status == 'failure')
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

	$scope.exportToExcelSave=function(tableId , filename)
	{
        ExcelSave.tableToExcel(tableId,filename);

        $timeout(function(){

        },100); // trigger download
    }

           $scope.Reset = function()
            {
            	$scope.filterid = '';
            	$scope.filterrmaID = '';
            	$scope.filterID = '';
            	$scope.filterpartno = '';
            	$scope.filterserialno = '';
            	$scope.filterpvtodate = '';
            	$scope.filterpvfromdate = '';
            	$scope.filterCustomer = '';
            	$scope.filterendCustomer = '';
            	$scope.filterdocketdetails = '';
            	$scope.filterrmaid = '';
            	$scope.dateTo = '';
            	$scope.dateFrom = '';
            }


}]);