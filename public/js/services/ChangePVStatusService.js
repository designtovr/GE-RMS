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

	ChangeOtherRelayStatus = function(pv_id, status, callback)
	{
		$http({
			method: 'POST',
			url: '/ge/changeotherrelaystatus',
			data: {
				'pv_id': pv_id,
				'stage': status
			}
		}).then(function success(response) {
			callback(response);
		}, function error(response) {
			callback(response);
		});
	}

	return {
		ChangePVStatus: ChangePVStatus,
		ChangeOtherRelayStatus: ChangeOtherRelayStatus
	};

});