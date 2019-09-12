app.controller('ReceiptController', ['$scope', '$http', '$filter', function($scope, $http, $filter){
	$scope.receiptform = true;
	$scope.receipt = {};

	$scope.ShowReceiptForm = function()
	{
		$scope.receiptform = true;
	}

	$scope.HideReceiptForm = function()
	{
		$scope.receiptform = false;
	}

	$scope.Initiate = function()
	{
		$scope.receipt.re_date = $filter('date')(new Date(),'dd/MM/yyyy');
	}

}]);