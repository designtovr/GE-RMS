app.controller('ReceiptController', ['$scope', '$http', 'Notification' ,'$filter','$ngConfirm', function($scope, $http,Notification, $filter , $ngConfirm){
	$scope.receiptform = false;
	$scope.receipts = [];
	$scope.receipt = {};
	$scope.gridOptions = {pagination: {
			itemsPerPage: '10'
		},
		data:[]
	  , //required parameter - array with data
	   //optional parameter - start sort options
	   sort: {

	   },
	   urlSync: true};
	$scope.editReceipt = false;
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
				Notification.success(response.data.message);
				$scope.HideReceiptForm();
				$scope.getReceipts();
			}
		}, function failure(response){
			if (response.status == 422)
			{

				var errors = response.data.errors;
				for(var error in errors)
				{
					Notification.error(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.Reset = function()
	{
		$scope.filterid = '';
		$scope.filterpvdate = '';
		$scope.filterCustomer = '';
	}

	$scope.getReceipts = function()
	{
		$http({
			method: 'GET',
			url: '/ge/receipts'
		}).then(function success(response) {
			$scope.receipts = response.data.data;
			$scope.gridOptions.data =  response.data.data;
		}, function error(response) {

		});
	}

	$scope.ShowReceiptForm = function()
	{
		$scope.receipt = {};
		$scope.receipt.receipt_date = $filter('date')(new Date(),'dd/MM/yyyy');
		$scope.receiptform = true;
		$scope.editReceipt = false;
	}

	$scope.HideReceiptForm = function()
	{
		$scope.receiptform = false;
		$scope.editReceipt = false;
	}

	$scope.EditReceipt= function(receipt)
	{
		$scope.receipt = receipt;
		$scope.receipt.receipt_date = $filter('date')(new Date(),'dd/MM/yyyy');
		$scope.editReceipt = true;
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
		$scope.receipt.receipt_date = $filter('date')(new Date(),'dd/MM/yyyy');
		$scope.receiptform = false;
	}
}]);