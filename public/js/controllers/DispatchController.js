app.controller('DispatchController', ['$scope', '$http', function($scope, $http){
	
	$scope.showdpform = false;
	
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

}]);