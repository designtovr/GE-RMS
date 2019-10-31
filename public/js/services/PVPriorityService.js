//serive to get and set pv priority
app.service('PVPriorityService', function($http){

	GetPVPriorityList = function(callback)
	{
		$http({
			method: 'GET',
			url: '/ge/pvprioritylist'
		}).then(function success(response) {
			console.log(response.data)
			list =  response.data.data;
			max = response.data.max;
			callback(list, max);
		}, function error(response) {

		});
	}

	SetPVPriority = function(pv_id,priority,callback)
	{
		$http({
			method: 'POST',
			url: '/ge/setpvpriority',
			data: {
				'pv_id': pv_id,
				'priority': priority
			}
		}).then(function success(response) {
			
			callback(response);
		}, function error(response) {
			
			callback(response);
		});
	}

	return {
		GetPVPriorityList: GetPVPriorityList,
		SetPVPriority: SetPVPriority,
	};

});