app.controller('PhysicalVerificationController', ['$scope', '$http', 'Notification' ,'$filter' , '$ngConfirm' , function($scope, $http, Notification , $filter , $ngConfirm) {

	$scope.pvform = false;
	$scope.receipt = {};
	$scope.physicalVerification = {};
	$scope.gridOptions = {data : []};
	$scope.rids = [];
	$scope.products = {};
	$scope.selected = {};
	$scope.conditions = [
		{ name: 'Damaged', value: 1 },
		{ name: 'Undamaged', value: 2},
	];
	$scope.physicalVerification.case_condition = $scope.conditions[1].value;
	$scope.physicalVerification.battery_condition = $scope.conditions[1].value;
	$scope.physicalVerification.terminal_blocks_condition = $scope.conditions[1].value;
	$scope.physicalVerification.top_bottom_cover_condition = $scope.conditions[1].value;
	$scope.physicalVerification.short_links_condition = $scope.conditions[1].value;
	$scope.physicalVerification.short_links = 1;
	$scope.physicalVerification.top_bottom_cover = 1;
	$scope.physicalVerification.terminal_blocks = 1;
	$scope.physicalVerification.battery = 1;
	$scope.physicalVerification.case = 1;
	$scope.ridoptions = [];
	$scope.AddPV= function()
	{
		$http({
			method: 'post',
			url: '/ge/addphysicalverification',
			data: {
				'physicalverification': $scope.physicalVerification,
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$scope.ClosePVForm();
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



	$scope.OpenPVForm = function(receipt, edit = false)
   	{
   		var url = '';
   		if (edit)
   		{
   			url = '/ge/GetPhysicalVerification/';
   		}
   		else
   		{
   			url = '/ge/getreceiptbyreceiptno/';
   		}
		$http({
			method: 'GET',
			url: url + receipt.receipt_no
		}).then(function success(response) {
			if(response.data.status == 'success') {
				$scope.physicalVerification.edit = true;
				$scope.ridoptions = response.data.physicalverification;
				$scope.selected = $scope.ridoptions[1];
				$scope.AssignValuesInEditForms();
			}

			else
			{
				$scope.physicalVerification = response.data.receipt;
				$scope.physicalVerification.edit = false;
				$scope.physicalVerification.case_condition = $scope.conditions[1].value;
				$scope.physicalVerification.battery_condition = $scope.conditions[1].value;
				$scope.physicalVerification.terminal_blocks_condition = $scope.conditions[1].value;
				$scope.physicalVerification.top_bottom_cover_condition = $scope.conditions[1].value;
				$scope.physicalVerification.short_links_condition = $scope.conditions[1].value;
				$scope.physicalVerification.short_links = 1;
				$scope.physicalVerification.top_bottom_cover = 1;
				$scope.physicalVerification.terminal_blocks = 1;
				$scope.physicalVerification.battery = 1;
				$scope.physicalVerification.case = 1;
			}
		}, function error(response) {
		});


   		$scope.pvform = true;
	}

	$scope.AssignValuesInEditForms = function()
	{
		$scope.physicalVerification.receipt_no = $scope.selected.receipt_no;
		$scope.physicalVerification.courier_name = $scope.selected.courier_name;
		$scope.physicalVerification.docket_details = $scope.selected.docket_details;
		$scope.physicalVerification.rid = $scope.selected.rid;
		for (var i = 0; i < $scope.products.length; i++) {
			if ($scope.products[i].id == $scope.selected.product_id)
			{
				$scope.physicalVerification.product = $scope.products[i];
				$scope.physicalVerification.product_category = $scope.products[i].category;
				$scope.physicalVerification.model_no = $scope.products[i].part_no;
				break;
			}
		}
		$scope.physicalVerification.serial_no = $scope.selected.serial_no;
		$scope.physicalVerification.defect = $scope.selected.defect;
		$scope.physicalVerification.sales_order_no = $scope.selected.sales_order_no;
		$scope.physicalVerification.pvdate = $filter('date')($scope.selected.pvdate,'dd/MM/yyyy');
		$scope.physicalVerification.case_condition = $scope.selected.case_condition;
		$scope.physicalVerification.battery_condition = $scope.selected.battery_condition;
		$scope.physicalVerification.terminal_blocks_condition = $scope.selected.terminal_blocks_condition;
		$scope.physicalVerification.top_bottom_cover_condition = $scope.selected.top_bottom_cover_condition;
		$scope.physicalVerification.short_links_condition = $scope.selected.short_links_condition;
		$scope.physicalVerification.short_links = $scope.selected.short_links;
		$scope.physicalVerification.top_bottom_cover = $scope.selected.top_bottom_cover;
		$scope.physicalVerification.terminal_blocks = $scope.selected.terminal_blocks;
		$scope.physicalVerification.battery = $scope.selected.battery;
		$scope.physicalVerification.case = $scope.selected.case;
	}

	$scope.GetProductList = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/products'
		}).then(function success(response) {
		    $scope.products = response.data.data;
		}, function error(response) {
		});
	}

	$scope.ChangeProductType = function()
	{
		$scope.physicalVerification.product_id = $scope.physicalVerification.product.id;
		$scope.physicalVerification.product_category = $scope.physicalVerification.product.category;
		$scope.physicalVerification.model_no = $scope.physicalVerification.product.part_no;
	}

    $scope.AddPVForm = function(receipt) {

        $scope.physicalVerification = receipt;
        $scope.physicalVerification.case_condition = 0;
        $scope.physicalVerification.rid = '';
        $scope.physicalVerification.battery_condition = 0;
        $scope.physicalVerification.terminal_blocks_condition = 0;
        $scope.physicalVerification.top_bottom_cover_condition = 0;
        $scope.physicalVerification.short_links_condition = 0;

        $scope.pvform = true;
    }

	$scope.DeletePV = function(id)
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
							url: './physicalverification/'+id,
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

   	$scope.ClosePVForm = function()
   	{
   		$scope.pvform = false;
   	}

}]);