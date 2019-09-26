app.controller('ReceiptController', ['$scope', '$http', 'Notification' ,'$filter','$ngConfirm', function($scope, $http,Notification, $filter , $ngConfirm){
	$scope.receiptform = false;
	$scope.receipt = {};
	$scope.gridOptions = {data : []};
	$scope.EditReceipt = false;
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
				alert(response.data.message)
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
		$scope.receipt = {};
		$scope.receiptform = true;
		EditReceipt = false;
		console.log("HELLO");
	}

	$scope.HideReceiptForm = function()
	{
		$scope.receiptform = false;
		EditReceipt = false;
	}

	$scope.EditReceipt= function(receipt)
	{
		$scope.receipt = receipt;
		$scope.receipt.receipt_date = $filter('date')(new Date(),'dd/MM/yyyy');
		EditReceipt = true;
		$scope.receiptform = true;
	}

	$scope.DeleteReceipt = function(id)
	{
		$ngConfirm({
			title: 'Warning!',
			content: 'Are you sure want to delete?',
			type: 'red',
			typeAnimated: true,
			buttons: {
				tryAgain: {
					text: 'Delete',
					btnClass: 'btn-red',
					action: function(){
						$http({
							method: 'DELETE',
							url: './receipt/'+id,
						}).then(function success(response) {
							if (response.data.status == 'success')
							{
								Notification.success(response.data.message);
								$scope.getReceipts();
							}
						}, function error(response) {

						});
					}
				},
				close: function () {
				}
			}
		});
	}

	$scope.Initiate = function()
	{
		$scope.receipt.re_date = $filter('date')(new Date(),'dd/MM/yyyy');
		$scope.receiptform = false;
	}
}]);