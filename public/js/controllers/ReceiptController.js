app.controller('ReceiptController', ['$scope', '$http', 'Notification' ,'$filter','$ngConfirm', function($scope, $http,Notification, $filter , $ngConfirm){
	$scope.receiptform = false;
	$scope.receipts = [];
	$scope.receipt = {};
	$scope.customers = [];
	$scope.end_customers = [];
	$scope.sites = [];
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
	$scope.states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Dakota', 'North Carolina', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'];
	$scope.AddReceipt= function()
	{
		/*if ($scope.receipt.customer_name == 'Add New')
		{
			$scope.receipt.customer_name = $scope.receipt.customer_name_new;
		}*/
		/*if ($scope.receipt.selected_end_customer.end_customer == 'Add New')
		{
			$scope.receipt.end_customer = $scope.receipt.end_customer_new;
		}*/
		console.log($scope.receipt);
		$http({
			method: 'post',
			url: '/ge/addreceipt',
			data: {
				'receipt': $scope.receipt,
			},
		}).then(function success(response){
			if (response.data.status == 'success')
			{
				//Notification.success(response.data.message + 'with Id: ' + response.data.data.id);
				var content = response.data.message + ' With Id:<b>'+ response.data.data.id + '</b>, Are You Want to Print?';
				$ngConfirm({
					title: '<b>Print!!</b>',
					content: content,
					type: 'blue',
					typeAnimated: true,
					buttons: {
						print: {
							text: 'Print',
							btnClass: 'btn-blue',
							action: function(){
								$scope.PrintReceipts(response.data.data);
								$scope.HideReceiptForm();
							}
						},
						close: function () {
							$scope.HideReceiptForm();
						}
					}
				});
				$scope.GetSiteList();
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
		$scope.filterpvtodate = '';
		$scope.filterpvfromdate = '';
		$scope.filterCustomer = '';
		$scope.filterendCustomer = '';
		$scope.filterdocketdetails = '';
		$scope.filterrmaid = '';
	}

	$scope.checkDate = function()
	{
		console.log($scope.filterpvfromdate);
		console.log($scope.filterpvtodate);
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


	$scope.PrintReceipts = function($data)
	{
		$http({
			method: 'post',
			url: '/ge/printreceipt',
			data: {
				'receipt': $data,
			},
		}).then(function success(response) {
			console.log("12311");
			if (response.data.status == 'success') {
				console.log("123");
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


	$scope.HideReceiptForm = function()
	{
		$scope.receiptform = false;
		$scope.editReceipt = false;
		$scope.getReceipts();
	}

	$scope.EditReceipt= function(receipt)
	{
		$scope.receipt = receipt;
		$scope.receipt.receipt_date = $filter('date')($scope.receipt.receipt_date,'dd/MM/yyyy');
		for (var i = 0; i < $scope.customers.length; i++) {
			console.log($scope.customers[i].name)
			if ($scope.customers[i].name == $scope.receipt.customer_name)
			{
				$scope.receipt.selected_customer_name = $scope.customers[i];
				break;
			}
		}
		$scope.receipt.selected_end_customer = {'end_customer': $scope.receipt.end_customer};
		console.log(receipt);
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

	$scope.GetCustomerList = function()
	{
		$http({
			method: 'GET',
			url: '/ge/customers'
		}).then(function success(response) {
			$scope.customers = response.data.data;
			/*var cus = {'id': -1, 'name': 'Add New'};
			$scope.customers.push(cus);*/
		}, function error(response) {

		});
	}

	$scope.GetEndCustomerList = function()
	{
		$http({
			method: 'GET',
			url: '/ge/endcustomers'
		}).then(function success(response) {
			$scope.end_customers = response.data.data;
			var cus = {'end_customer': 'Add New'};
			$scope.end_customers.push(cus);
		}, function error(response) {

		});
	}

	$scope.GetSiteList = function()
	{
		$http({
			method: 'GET',
			url: '/ge/sitesforreceipt'
		}).then(function success(response) {
			$scope.sites = response.data.data;
		}, function error(response) {

		});
	}

	$scope.AssignCutomerName = function()
	{
		$scope.receipt.customer_name = $scope.receipt.selected_customer_name.name;
	}

	$scope.AssignEndCutomer = function()
	{
		$scope.receipt.end_customer = $scope.receipt.selected_end_customer.end_customer;
	}

}]);