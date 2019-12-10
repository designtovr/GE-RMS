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
		$scope.producttypes = [];
		$scope.selected = {};
		$scope.conditions = [
		{ name: 'Damaged', value: 1 },
		{ name: 'Undamaged', value: 2},
		{ name: 'Not Applicable', value: 3}
		];
		$scope.ridoptions = [];
		$scope.tab = 'open';
		$scope.showcreatermaform = false;
		$scope.selectedpvs = [];
		$scope.selectedrcs = [];

		$scope.AddPV= function()
		{
			if ($scope.physicalVerification.serial_no_exists)
			{
				Notification.error("Serial No Already Exists");
				return;
			}
			$http({
				method: 'post',
				url: '/ge/addphysicalverification',
				data: {
					'physicalverification': $scope.physicalVerification,
				},
			}).then(function success(response){
				if (response.data.status == 'success')
				{
					//Notification.success(response.data.message + 'with Id: ' + response.data.data.id);
			console.log('HI : ' + $scope.physicalVerification.customer_name);

					$ngConfirm({
						title: '<b>Print!!</b>',
						contentUrl: './resources/views/form.html',
						type: 'blue',
						typeAnimated: true,
						buttons: {
							print: {
								text: 'Print',
								btnClass: 'btn-blue',
								action: function(scope){
									console.log(scope.customer_name);
									console.log(scope.location);
									$scope.physicalVerification.cus_name = scope.customer_name;
									$scope.physicalVerification.location = scope.location;
									$data = $scope.physicalVerification;
									$scope.PrintLabels($data);
									$scope.ClosePVForm();
									$scope.ChangeTab($scope.tab);
									$scope.Loader = {
										"display": "block"
									}
								}
							},
							close: function () {
								$scope.ClosePVForm();
								$scope.ChangeTab($scope.tab);
							}
						}

						,
						onScopeReady: function (scope) {
							scope.customer_name = $scope.physicalVerification.customer_name;
							scope.location = $scope.physicalVerification.location;
					var self = this;
					scope.textChange = function () {
						console.log (scope.customer_name);
					}
				}}
				);
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

	$scope.PrintLabels = function($data)
	{
		$http({
			method: 'post',
			url: '/ge/printlabel',
			data: {
				'receipt': $data,
			},
		}).then(function success(response) {
			console.log("12311");
			if (response.data.status == 'success') {
				Notification.success("Printed Successfully");
				$scope.Loader = {
					"display": "none"
				}
				console.log("123");
			}
		}, function failure(response){
			if (response.status == 'failure')
			{

				var errors = response.data.errors;
				for(var error in errors)
				{
					Notification.error("Print Unsuccessful");

					$scope.Loader = {
						"display": "none"
					};
					break;
				}
			}
		});


	}


	$scope.CheckSerialNoExistence = function()
		{
			if ($scope.physicalVerification.serial_no)
			{
				var id = $scope.physicalVerification.id;
				if ($scope.physicalVerification.id == undefined || $scope.physicalVerification.id == null)
					id = 0;
				var serial_no = $scope.physicalVerification.serial_no;
				$http({
					method: 'GET',
					url: '/ge/checkserialnumberexistence/'+serial_no+'/'+id,
				}).then(function success(response) {
					if (response.data.status == 'success')
					{
						if (response.data.exists)
						{
							$scope.physicalVerification.serial_no_exists = true;
							Notification.error(response.data.message);
						}
						else
						{
							$scope.physicalVerification.serial_no_exists = false;
						}
					}
					else if (response.data.status == 'failure')
					{
						Notification.error(response.data.message);
					}
				}, function error(response) {
				});
			}
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
			$scope.filterEndCustomerothers = '';
			$scope.dateTo = '';
			$scope.dateFrom = '';
		}


		$scope.OpenPVForm = function(receipt, edit = false)
		{
			console.log(receipt)
			$scope.physicalVerification = {};
			if (edit)
			{
				$http({
					method: 'GET',
					url: '/ge/GetPhysicalVerification/' + receipt.pv_id
				}).then(function success(response) {
					if(response.data.status == 'success') {
						$scope.physicalVerification = response.data.physicalverification;
						console.log($scope.physicalVerification)
						$scope.physicalVerification.edit = true;
						$scope.physicalVerification.pvdate = $filter('date')(new Date(),'dd/MM/yyyy');
						if ($scope.physicalVerification.is_rma_available)
							$scope.physicalVerification.is_rma_available = true;
						else
							$scope.physicalVerification.is_rma_available = false;
						for (var i = 0; i < $scope.producttypes.length; i++) {
							if ($scope.producttypes[i].id == $scope.physicalVerification.producttype_id)
							{
								$scope.physicalVerification.producttype = $scope.producttypes[i];
								$scope.physicalVerification.product_category = $scope.producttypes[i].category;
								$scope.ChangeProductType();
								break;
							}
						}
						console.log($scope.products)
						for (var i = 0; i < $scope.products.length; i++) {
							if($scope.products[i].id == $scope.physicalVerification.product_id)
							{
								$scope.physicalVerification.product = $scope.products[i];
								break;
							}
						}
						console.log($scope.physicalVerification);
					}
				}, function error(response) {

				});
			}
			else
			{
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
				$scope.physicalVerification.is_rma_available = false;
				$scope.physicalVerification.receipt_id = receipt.receipt_id;
				$scope.physicalVerification.docket_details = receipt.docket_details;
				$scope.physicalVerification.courier_name = receipt.courier_name;
				$scope.physicalVerification.serial_no = '';
				$scope.physicalVerification.part_no = '';
				$scope.physicalVerification.location = receipt.location;
				$scope.physicalVerification.formatted_receipt_id = receipt.formatted_receipt_id;
				$scope.physicalVerification.formatted_rma_id = receipt.formatted_rma_id;
				delete $scope.physicalVerification.id;
				console.log($scope.physicalVerification)
			}
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
				/*var addoption = {'id':-1, 'part_no': 'Add New'};
				$scope.products.push(addoption);*/
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
			$scope.selectedformattedrcs = [];
			for (var i = 0; i < $scope.gridOptions.data.length; i++) {
				if ($scope.gridOptions.data[i].close != undefined && $scope.gridOptions.data[i].close)
				{
					$scope.selectedrcs.push($scope.gridOptions.data[i].receipt_id);
					$scope.selectedformattedrcs.push($scope.gridOptions.data[i].formatted_receipt_id);
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
			$scope.formattedtrimedselectedrcs = [];
			for (var i = 0; i < $scope.selectedformattedrcs.length; i++) {
				var result = $scope.formattedtrimedselectedrcs.filter(rc => rc == $scope.selectedformattedrcs[i]);
				if (result.length == 0)
				{
					$scope.formattedtrimedselectedrcs.push($scope.selectedformattedrcs[i]);
				}
			}
			$ngConfirm({
				title: 'Warning!',
				content: 'Are you sure want to close Receipt Id: <b>'+ $scope.formattedtrimedselectedrcs.join() +'</b>?',
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
			$scope.ChangeTab($scope.tab);
			$scope.GetProductTypeList();
			$scope.GetProductList();
		}

		$scope.ChangeTab = function(name)
		{
			$scope.tab = name;
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