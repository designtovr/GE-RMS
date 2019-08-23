app.controller('LoginController', function($scope, $http){
	$scope.logindata = [];
	$scope.logindata.email = '';
	$scope.logindata.password = '';
	$scope.invalid_credentials = false;

	$scope.login = function()
	{
		$http({
			method: 'POST',
			url: 'dologin',
			data: {
				'email': $scope.logindata.email,
				'password': $scope.logindata.password,
			},
			contentType:"application/json; charset=utf-8",
		}).then(function success(response){
			var data = response.data;
			if (data.status == 'success')
			{
				window.location.replace('dashboard'); 
			}
			else if (data.status == 'failure')
			{
				$scope.invalid_credentials = true;
			}
		}, function failure(response) {
			console.log(response.data)
		});
	}

});