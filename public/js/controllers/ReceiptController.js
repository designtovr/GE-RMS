app.controller('ReceiptController', ['$scope', '$http', '$filter', function($scope, $http, $filter){
	$scope.receiptform = false;
	$scope.receipt = {};
	$scope.gridOptions = {data : []};
	$scope.AddReceipt= function()
	{
		$http({
			method: 'post',
			url: '/ge/addreceipt',
			data: {
				'receipt': $scope.receipt,
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.messagae)
				$scope.HideReceiptForm();
				/*$('#customermodal').modal('hide');*/
				$scope.getReceipts();
			}
		}, function failure(response){
			if (response.status == 422)
			{

				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.getReceipts = function()
	{
		$http({
			method: 'GET',
			url: '/ge/receipts'
		}).then(function success(response) {
			$scope.receipt = response.data.data;
			$scope.gridOptions.data =  response.data.data;
		}, function error(response) {

		});
	}

	$scope.ShowReceiptForm = function()
	{
		$scope.receiptform = true;
		console.log("HELLO");
	}

	$scope.HideReceiptForm = function()
	{
		$scope.receiptform = false;
	}

	$scope.Initiate = function()
	{
		$scope.receipt.re_date = $filter('date')(new Date(),'dd/MM/yyyy');
		$scope.receiptform = false;
	}



}]);