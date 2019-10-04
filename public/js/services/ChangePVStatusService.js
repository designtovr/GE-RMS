app.service('ChangePVStatusService', function($http,Notification){

	ChangePVStatus = function(pvids, status, callback)
	{
		$http({
			method: 'POST',
			url: '/ge/changepvstatus',
			data: {
				'pvids': pvids,
				'status': status
			}
		}).then(function success(response) {
			
			callback(response);
		}, function error(response) {
			
			callback(response);
		});
	}

	return {
		ChangePVStatus: ChangePVStatus,
	};

});