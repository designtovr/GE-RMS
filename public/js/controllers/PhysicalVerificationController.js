app.controller('PhysicalVerificationController', ['$scope', '$http', 'Notification' ,'$filter' , '$ngConfirm' , 'DataShareService' , function($scope, $http, Notification , $filter , $ngConfirm, DataShareService) {

	$scope.pvform = false;
	$scope.ShowAll = true;
	$scope.ShowOthers = false;
	$scope.receipt = {};
	$scope.physicalVerification = {};
	$scope.gridOptions = {	
		pagination: {
			itemsPerPage: '10'
		}, 
		data :[],
		sort: {},
		urlSync: true};
		$scope.pvgridOptions = {pagination: {
			itemsPerPage: '10'
		}, 
		data :[],
		sort: {},
		urlSync: true};
		$scope.rids = [];
		$scope.products = [];
		$scope.producttypes = {};
		$scope.selected = {};
		$scope.conditions = [
		{ name: 'Damaged', value: 1 },
		{ name: 'Undamaged', value: 2},
		];
		$scope.ridoptions = [];
		$scope.tab = 'all';
		$scope.showcreatermaform = false;
		$scope.selectedpvs = [];
		$scope.selectedrcs = [];

		$scope.AddPV= function()
		{
			$http({
				method: 'post',
				url: '/ge/addphysicalverification',
				data: {
					'physicalverification': $scope.physicalVerification,
				},
			}).then(function success(response){
				if (response.data.status == 'success')
				{
					Notification.success(response.data.message + 'with Id: ' + response.data.data.id);
					$scope.ClosePVForm();
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

		$scope.Reset = function()
		{
			$scope.filterid = '';
			$scope.filterpvdate = '';
			$scope.filterCustomer = '';

			$scope.filterothersid = '';
			$scope.filterreceiptid='';
			$scope.filterpvdateothers = '';
			$scope.filterCustomerothers = '';
		}


		$scope.OpenPVForm = function(receipt, edit = false)
		{
			//checking for receipt_id presents
			if (receipt.receipt_id != undefined && receipt.receipt_id != null)
				receipt.id = receipt.receipt_id;
			var url = '';
			if (edit)
			{
				url = '/ge/GetPhysicalVerificationForReceiptId/';
			}
			else
			{
				url = '/ge/getreceipt/';
			}
			$http({
				method: 'GET',
				url: url + receipt.id
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
					$scope.physicalVerification.screws = 1;
					$scope.physicalVerification.top_bottom_cover = 1;
					$scope.physicalVerification.terminal_blocks = 1;
					$scope.physicalVerification.battery = 1;
					$scope.physicalVerification.case = 1;
					$scope.physicalVerification.pvdate = $filter('date')(new Date(),'dd/MM/yyyy');
					$scope.physicalVerification.receipt_id = $scope.physicalVerification.id;
					$scope.physicalVerification.is_rma_available = false;
					delete $scope.physicalVerification.id;
				}
			}, function error(response) {
			});


			$scope.pvform = true;
		}

		$scope.AssignValuesInEditForms = function()
		{
			$scope.physicalVerification.receipt_id = $scope.selected.receipt_id;
			$scope.physicalVerification.courier_name = $scope.selected.courier_name;
			$scope.physicalVerification.docket_details = $scope.selected.docket_details;
			for (var i = 0; i < $scope.producttypes.length; i++) {
				if ($scope.producttypes[i].id == $scope.selected.producttype_id)
				{
					$scope.physicalVerification.producttype = $scope.producttypes[i];
					$scope.physicalVerification.product_category = $scope.producttypes[i].category;
					$scope.ChangeProductType();
					break;
				}
			}

			for (var i = 0; i < $scope.products.length; i++) {
				if($scope.products[i].id == $scope.selected.product_id)
				{
					$scope.physicalVerification.product = $scope.products[i];
					break;
				}
			}
			$scope.physicalVerification.id = $scope.selected.id;
			$scope.physicalVerification.serial_no = $scope.selected.serial_no;
			$scope.physicalVerification.sales_order_no = $scope.selected.sales_order_no;
			$scope.physicalVerification.pvdate = $filter('date')($scope.selected.pvdate,'dd/MM/yyyy');
			$scope.physicalVerification.case_condition = $scope.selected.case_condition;
			$scope.physicalVerification.battery_condition = $scope.selected.battery_condition;
			$scope.physicalVerification.terminal_blocks_condition = $scope.selected.terminal_blocks_condition;
			$scope.physicalVerification.no_of_terminal_blocks = $scope.selected.no_of_terminal_blocks;
			$scope.physicalVerification.top_bottom_cover_condition = $scope.selected.top_bottom_cover_condition;
			$scope.physicalVerification.short_links_condition = $scope.selected.short_links_condition;
			$scope.physicalVerification.short_links = $scope.selected.short_links;
			$scope.physicalVerification.no_of_short_links = $scope.selected.no_of_short_links;
			$scope.physicalVerification.screws = $scope.selected.screws;
			$scope.physicalVerification.top_bottom_cover = $scope.selected.top_bottom_cover;
			$scope.physicalVerification.terminal_blocks = $scope.selected.terminal_blocks;
			$scope.physicalVerification.battery = $scope.selected.battery;
			$scope.physicalVerification.case = $scope.selected.case;
			if ($scope.selected.is_rma_available)
				$scope.physicalVerification.is_rma_available = true;
			else
				$scope.physicalVerification.is_rma_available = false;
		}

		$scope.GetProductTypeList = function()
		{
			$http({
				method: 'GET',
				url: '/ge/product-types'
			}).then(function success(response) {
				$scope.producttypes = response.data.data;
			}, function error(response) {
			});
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
			$scope.physicalVerification.producttype_id = $scope.physicalVerification.producttype.id;
			$scope.physicalVerification.product_category = $filter('uppercase')($scope.physicalVerification.producttype.category);
			$scope.physicalVerification.product = {};
			$scope.GetProductsForTypeId($scope.physicalVerification.producttype_id);
		}

		$scope.GetProductsForTypeId = function(id)
		{
			$http({
				method: 'GET',
				url: '/ge/productsoftype/'+ id,
			}).then(function success(response) {
				$scope.products = response.data.data;
				var addoption = {'id':-1, 'part_no': 'Add New'};
				$scope.products.push(addoption);
			}, function error(response) {
			});
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

		$scope.CloseReceipts = function()
		{
			$scope.selectedrcs = [];
			for (var i = 0; i < $scope.gridOptions.data.length; i++) {
				if ($scope.gridOptions.data[i].close != undefined && $scope.gridOptions.data[i].close)
				{
					$scope.selectedrcs.push($scope.gridOptions.data[i].receipt_id);
				}
			}
			if ($scope.selectedrcs.length == 0)
			{
				Notification.error("No Receipt Selected");
				return;
			}
			$scope.trimedselectedrcs = [];
			for (var i = 0; i < $scope.selectedrcs.length; i++) {
				var result = $scope.trimedselectedrcs.filter(rc => rc == $scope.selectedrcs[i]);
				if (result.length == 0)
				{
					$scope.trimedselectedrcs.push($scope.selectedrcs[i]);
				}
			}
			console.log($scope.trimedselectedrcs)
			$ngConfirm({
				title: 'Warning!',
				content: 'Are you sure want to close Receipt Id:'+ $scope.trimedselectedrcs.join() +'?',
				type: 'red',
				typeAnimated: true,
				buttons: {
					delete: {
						text: 'Close',
						btnClass: 'btn-red',
						action: function(){
							$http({
								method: 'post',
								url: '/ge/changereceiptstatus',
								data: {
									'list': $scope.trimedselectedrcs,
									'status': 'close'
								}
							}).then(function success(response){
								if (response.data.status == 'success')
								{
									$scope.ChangeTab('started');
								}
							}, function error(response){

							});
						}
					},
					cancel: {
						text: 'Cancel',
						action: function(){

						}
					}
				}
			});
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

		$scope.ChangeTab = function(name)
		{
			$scope.tab = name;
			if(name == 'all')
			{
				$scope.ShowAll = true;
				$scope.ShowOthers = false;
			}

			else
			{
				$scope.ShowAll = false;
				$scope.ShowOthers = true;
			}

			$scope.Reset();

			if ($scope.tab == 'started')
			{
				$http({
					method: 'GET',
					url: '/ge/pvwithreceipts/'+name
				}).then(function success(response) {
					$scope.gridOptions.data =  response.data.data;
				}, function error(response) {
					
				});
			}
			else
			{
				$http({
					method: 'GET',
					url: '/ge/receipts/'+name
				}).then(function success(response) {
					$scope.gridOptions.data =  response.data.data;
				}, function error(response) {
					
				});
			}

			/*$http({
				method: 'GET',
				url: '/ge/physicalverification?cat='+name
			}).then(function success(response) {
				$scope.pvgridOptions.data =  response.data.physicalverification;
			}, function error(response) {
			});*/
		}

		$scope.CreateRMA = function()
		{
			$scope.selectedpvs = [];
			for (var i = 0; i < $scope.pvgridOptions.data.length; i++) {
				if ($scope.pvgridOptions.data[i].create_rma != undefined && $scope.pvgridOptions.data[i].create_rma)
				{
					$scope.selectedpvs.push($scope.pvgridOptions.data[i]);
				}
			}
			if ($scope.selectedpvs.length == 0)
			{
				Notification.error("No Relay Selected");
				return;
			}
			DataShareService.setRIdList($scope.selectedpvs);
			$scope.showcreatermaform = true;
			$scope.pvform = false;
		}

		$scope.CloseCreateRMA = function()
		{
			$scope.showcreatermaform = false;
			$scope.pvform = false;
			if ($scope.tab == 'withrma')
			{
				$scope.ChangeTab('withrma');
			}
			else if($scope.tab == 'withoutrma')
			{
				$scope.ChangeTab('withoutrma');
			}
			else 
			{
				$scope.ChangeTab('all');
			}
		}

	}]);