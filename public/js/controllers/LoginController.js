app.controller('LoginController', function($scope, $http, $ngConfirm, Notification){
	$scope.logindata = [];
	$scope.logindata.username = '';
	$scope.logindata.password = '';
	$scope.invalid_credentials = false;
	$scope.form = 'login';
	$scope.forgotpass = {};
	$scope.forgotpass.username = '';
	$scope.changepassword = {};

	$scope.login = function()
	{
		$http({
			method: 'POST',
			url: 'dologin',
			data: {
				'username': $scope.logindata.username,
				'password': $scope.logindata.password,
			},
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

	$scope.ChangeTab = function(name)
	{
		$scope.form = name;
	}

	$scope.ForgotPassword = function()
	{
		if ($scope.forgotpass.username == '' || $scope.forgotpass.username == null || $scope.forgotpass.username == undefined)
		{
			Notification.error("Please Enter Username");
		}

		$http({
			method: 'POST',
			url: 'forgotpassword',
			data: {
				'username': $scope.forgotpass.username,
			},
		}).then(function success(response){
			var data = response.data;
			if (data.status == 'success')
			{
				Notification.success(data.message);
			}
			else if (data.status == 'failure')
			{
				Notification.error(data.message);
			}
		}, function failure(response) {
			console.log(response.data)
		});
	}

	$scope.OpenChangePasswordModal = function()
	{
		$('#ChangePasswordModal').modal({
			show: true,
			backdrop: 'static',
		});
	}

	$scope.CloseChangePasswordModal = function()
	{
		$('#ChangePasswordModal').modal('hide');
	}

	$scope.ChangePassword = function()
	{

		console.log($scope.changepassword)
		$http({
			method: 'POST',
			url: 'changepassword',
			data: {
				'changepassword': $scope.changepassword,
			},
		}).then(function success(response){
			var data = response.data;
			if (data.status == 'success')
			{
				Notification.success(data.message);
				$('#ChangePasswordModal').modal('hide');
			}
			else if (data.status == 'failure')
			{
				Notification.error(data.message);
			}
		}, function failure(response) {
			console.log(response)
		});
	}

});