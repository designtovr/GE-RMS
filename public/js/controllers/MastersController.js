app.controller('MastersController', function($scope, $http){
	$scope.customers = [];
	$scope.products = [];
	$scope.locations = [];
	$scope.sites = [];
	$scope.racktypes = [];
	$scope.racks = [];
	$scope.materials = [];
	$scope.packingstyles = [];
	$scope.producttypes = [];
	$scope.materialtypes = [];
	$scope.manufactures = [];
	$scope.users = [];

	$scope.customermodal = [];

	$scope.customers = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/customers'
		}).then(function success(response) {
		    console.log(response)
		    $scope.customers = response.data.data;
		  }, function error(response) {
		    console.log(response)
		  });
	}

	$scope.products = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/products'
		}).then(function success(response) {
		    console.log(response)
		    $scope.products = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.locations = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/locations'
		}).then(function success(response) {
		    console.log(response)
		    $scope.locations = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.sites = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/sites'
		}).then(function success(response) {
		    console.log(response)
		    $scope.sites = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.racktypes = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/rack-types'
		}).then(function success(response) {
		    console.log(response)
		    $scope.racktypes = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.racks = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/racks'
		}).then(function success(response) {
		    console.log(response)
		    $scope.racks = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.materials = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/materials'
		}).then(function success(response) {
		    console.log(response)
		    $scope.sites = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.packingstyles = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/packing-styles'
		}).then(function success(response) {
		    console.log(response)
		    $scope.packingstyles = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.producttypes = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/product-types'
		}).then(function success(response) {
		    console.log(response)
		    $scope.packingstyles = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.materialtypes = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/material-types'
		}).then(function success(response) {
		    console.log(response)
		    $scope.packingstyles = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.manufactures = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/manufactures'
		}).then(function success(response) {
		    console.log(response)
		    $scope.manufactures = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.users = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/users'
		}).then(function success(response) {
		    console.log(response)
		    $scope.users = response.data.data;
		}, function error(response) {
		    console.log(response)
		});
	}

	$scope.OpenCustomerModal = function(id = null)
	{
		if (id == null)
		{
			$scope.customermodal = [];
			$scope.customermodal.title = 'Add Customer';
		}
		else
		{
			$scope.customermodal = customer;
			$scope.customermodal.title = 'Edit Customer';
		}
		$('#customermodal').modal('show');
	}

});