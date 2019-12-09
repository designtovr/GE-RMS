app.controller('RMAController', ['$scope', '$http', '$filter', 'Notification', '$timeout' , 'DataShareService', '$ngConfirm', function($scope, $http, $filter, Notification, $timeout, DataShareService, $ngConfirm){
	$scope.showrmaform = false;
	$scope.showsitecardform = false;
	$scope.addpvform = false;
	$scope.hide = false;
	$scope.rmaformdata = {};
	$scope.rmaformdata.unit_information = [];
	$scope.rmaformdata.invoice_info = {};
	$scope.rmaformdata.delivery_info = {};
	$scope.rmaformdata.relay = {};
	$scope.sitecardform = {};
	$scope.sitecardform.unit_information = [];
	$scope.sitecardform.invoice_info = {};
	$scope.sitecardform.delivery_info = {}
	$scope.rmaformdata.field_volts_used = 1;
	$scope.products = [];
	$scope.customers = [];
	$scope.endcustomers = [];
	$scope.tab = 'all';
	$scope.selectedpvs = [];
	$scope.pvformdata = {};
	$scope.pvformdata.addedpvs = [];
	$scope.gridOptions = {

		defaultColDef: {
	        filter: true // set filtering on for all cols
	    },
		pagination: {
			itemsPerPage: '10'
		},
		data:[],
		   sort: {

		   },
	   	urlSync: true
	 };
	 $scope.pvgridOptions = {
	 	pagination: {
			itemsPerPage: '10'
		},
		data:[],
		   sort: {

		   },
	   	urlSync: true
	 }
	$scope.rmaformdata.edit = false;
	$scope.servicetypes = [
		{id: 1, 'name': 'Physical Relay'},
		{id: 2, 'name': 'Site Card'}
	];

	$scope.ShowRMAForm = function()
	{
		$scope.InitiateForm();
		$scope.showrmaform = true;
	}

	$scope.HideRMAForm = function()
	{
		$scope.showrmaform = false;
		$scope.showsitecardform = false;
		$scope.rmaformdata.copy_invoice_address_to_delivery_address = false;
		$scope.ChangeTab($scope.tab);
	}

	$scope.HidePVForm = function()
	{
		$scope.addpvform = false;
		$scope.showrmaform = false;
		$scope.showsitecardform = false;
		$scope.ChangeTab($scope.tab);
	}

	$scope.HideSiteCardForm = function()
	{
		$scope.showrmaform = false;
		$scope.showsitecardform = false;
		$scope.ChangeTab($scope.tab);
	}
	
	$scope.Reset = function()
	{
		$scope.filterdate = '';
		$scope.filtergs_no = '';
		$scope.filterID = '';
		$scope.filterreceiptID = '';
		$scope.filterrmaID = '';
		$scope.filteract = '';
		$scope.filterCustomer = '';
		$scope.filterrID = '';
		$scope.filterrmaID = '';
		$scope.filterendCustomer = '';
		$scope.dateTo = '';
		$scope.dateFrom = '';
	}

	$scope.InitiateForm = function()
	{
		$scope.rmaformdata = {};
		$scope.rmaformdata.unit_information = {};
		$scope.rmaformdata.invoice_info = {};
		$scope.rmaformdata.delivery_info = {};
		$scope.rmaformdata.date = $filter('date')(new Date(),'dd/MM/yyyy');
		$scope.rmaformdata.edit = false;
		if ($scope.selectedpvs.length != 0)
		{
			$scope.rmaformdata.relay =  $scope.selectedpvs[0];
			$scope.rmaformdata.gs_no = $scope.selectedpvs[0].gs_no;
		}
		$scope.GetProductList();
		$scope.GetCustomerList();
		$scope.GetEndCustomerList();
		$scope.GetRmaRefNumber();
	}

	$scope.InitiateSiteCardForm = function()
	{
		$scope.sitecardform = {};
		$scope.sitecardform.unit_information = [];
		var info = {};
		info.model_no = '';
		info.type_of_material = '';
		info.service_type = 2;
		info.serial_no = '';
		info.sw_version = '';
		info.warrenty = 0;
		info.field_volts_used = 0;
		info.equip_failed_on_installation = 0;
		info.equip_failed_on_service = 0;
		$scope.sitecardform.unit_information.push(info);
		console.log($scope.sitecardform.unit_information)
		$scope.sitecardform.invoice_info = {};
		$scope.sitecardform.delivery_info = {};
		$scope.sitecardform.date = $filter('date')(new Date(),'dd/MM/yyyy');
		$scope.sitecardform.edit = false;
	}

	$scope.AddSiteCardUnitInfo = function()
	{
		var info = {};
		info.model_no = '';
		info.type_of_material = '';
		info.serial_no = '';
		info.sw_version = '';
		info.warrenty = 0;
		info.field_volts_used = 0;
		info.service_type = 2;
		info.equip_failed_on_installation = 0;
		info.equip_failed_on_service = 0;
		$scope.sitecardform.unit_information.push(info);
	}

	$scope.RemoveSiteCardUnitInfo = function(index)
	{
		if ($scope.sitecardform.unit_information.length == 1)
		{
			Notification.error('Atleast One Required');
			return;
		}
		else{
			$scope.sitecardform.unit_information.splice(index, 1);
			Notification.success('Product Removed');
		}
	}

	$scope.EditRMAForm = function(id)
	{
		$scope.showrmaform = true;
		$scope.addpvform = false;
		$scope.GetRMA(id);
	}

	$scope.ChangeModelCategory = function(index,info)
	{
		$scope.sitecardform.unit_information[index].model_no = info.model.part_no;
		$scope.sitecardform.unit_information[index].type_of_material = $filter('uppercase')(info.model.category);
		$scope.sitecardform.unit_information[index].product_id = info.model.id;
		$scope.sitecardform.unit_information[index].producttype_id = info.model.type;
	}

	$scope.GetRMAList = function(tab = 'open', type = 'physcial')
	{
		$http({
		  method: 'GET',
		  url: '/ge/getrmalist/'+tab + '/' + type
		}).then(function success(response) {
			if (response.data.status == 'success')
		    	$scope.gridOptions.data = response.data.data;
		}, function error(response) {
		});
	}

	$scope.GetRMA = function(id)
	{
		$http({
		  method: 'POST',
		  url: '/ge/getrma/'+ id
		}).then(function success(response) {
			if (response.data.status == 'success')
	    	{
	    		$scope.rmaformdata = {};
	    		$scope.selectedpvs = {};
	    		$scope.rmaformdata = response.data.data;
	    		$scope.rmaformdata.date =   $filter('date')($scope.rmaformdata.date, "dd/MM/yyyy");
	    		$scope.rmaformdata.edit = true;
	    		if ($scope.rmaformdata.delivery_info == null || $scope.rmaformdata.delivery_info == undefined)
	    			$scope.rmaformdata.delivery_info = {};
	    		if ($scope.rmaformdata.invoice_info != null)
	    		{
	    			for (var i = 0; i < $scope.customers.length; i++) {
		    			if ($scope.customers[i].id == $scope.rmaformdata.invoice_info.id)
		    			{
		    				$scope.rmaformdata.invoice_info.invoice_customer_name = $scope.customers[i];
		    				$scope.ChangeInvoiceAddress($scope.rmaformdata.invoice_info.invoice_customer_name);
		    				break;
		    			}
		    		}
	    		}
	    		if($scope.rmaformdata.unit_information.length > 0)
	    		{
	    			$scope.selectedpvs = $scope.rmaformdata.unit_information;
	    		}
	    		if ($scope.rmaformdata.invoice_info != undefined && $scope.rmaformdata.invoice_info != null)
	    		{
	    			if ($scope.rmaformdata.end_customer != undefined && $scope.rmaformdata.end_customer != null)
	    				$scope.rmaformdata.invoice_info.end_customer = $scope.rmaformdata.end_customer;
	    		}
	    		console.log($scope.rmaformdata)
	    	}
		}, function error(response) {
		});
	}

	$scope.GetRmaRefNumber = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/rmarefno'
		}).then(function success(response) {
		    $scope.rmaformdata.ref_no = response.data.data;
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
		    //var addoption = {'id':-1, 'part_no': 'Add New'};
		    //$scope.products.push(addoption);
		}, function error(response) {
		});
	}

	$scope.GetCustomerList = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/customers'
		}).then(function success(response) {
		    $scope.customers = response.data.data;
		}, function error(response) {
		});
	}

	$scope.GetEndCustomerList = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/endcustomers'
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				$scope.endcustomers = response.data.data;
			}
		}, function error(response) {
		});
	}

	$scope.AddPVForm = function(id)
	{
		//nested ajax called here
		//outer ajax call
		$scope.addpvform = true;
		$http({
		  method: 'POST',
		  url: '/ge/getrma/'+ id
		}).then(function success(response) {
			if (response.data.status == 'success')
	    	{
	    		$scope.pvformdata = {};
	    		$scope.pvformdata = response.data.data;
	    		$scope.pvformdata.date =   $filter('date')($scope.pvformdata.date, "dd/MM/yyyy");
	    		//inner ajax call
	    		$http({
					method: 'GET',
					url: '/ge/pvforrmaid/'+ id
				}).then(function success(response) {
					$scope.selectedpvs =  response.data.physicalverification;
					$scope.pvformdata.addedpvs = [];
					$scope.pvformdata.addedpvs[0] = {};
					$scope.pvformdata.addedpvs[0].relay = $scope.selectedpvs[0];
					$scope.ChangeRelayDetails(0, $scope.pvformdata.addedpvs[0]);
				}, function error(response) {

				});
	    	}
		}, function error(response) {

		});
	}

	$scope.SubmitRMAUnitForm = function()
	{
		$http({
			method: 'POST',
			url: '/ge/addrmaunit',
			data: {
				'rma': $scope.pvformdata,
				'pvs': $scope.pvformdata.addedpvs
			}
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.HidePVForm();
			}
		}, function error(response) {
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

	$scope.PVList = function(cat)
	{
		$http({
			method: 'GET',
			url: '/ge/physicalverification?cat='+ cat
		}).then(function success(response) {
			$scope.pvgridOptions.data =  response.data.physicalverification;

		}, function error(response) {
		});
	}

	$scope.CreateRMA = function()
	{
		$scope.selectedpvs = [];
		for (var i = 0; i < $scope.pvgridOptions.data.length; i++) {
			if ($scope.pvgridOptions.data[i].create_rma != undefined && $scope.pvgridOptions.data[i].create_rma)
			{
				$scope.pvgridOptions.data[i].category = $filter('uppercase')($scope.pvgridOptions.data[i].category);
				$scope.pvgridOptions.data[i].warrenty = 0;
				$scope.pvgridOptions.data[i].field_volts_used = 0;
				$scope.pvgridOptions.data[i].equip_failed_on_installation = 0;
				$scope.pvgridOptions.data[i].equip_failed_on_service = 0;
				$scope.selectedpvs.push($scope.pvgridOptions.data[i]);
			}
		}
		if ($scope.selectedpvs.length == 0)
		{
			Notification.error("No Relay Selected");
			return;
		}
		//checking for receipt ids are same
		var occurence = $scope.selectedpvs.filter(pv => pv.receipt_id == $scope.selectedpvs[0].receipt_id);
		if (occurence.length != $scope.selectedpvs.length)
		{
			Notification.error("You Selected Relay Of Different Receipt");
			return;
		}
		console.log($scope.selectedpvs);
		$http({
		  method: 'GET',
		  url: '/ge/getreceipt/'+$scope.selectedpvs[0].receipt_id
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				var receipt = response.data.receipt;
				$scope.rmaformdata.date = $filter('date')(new Date(), 'dd/MM/yyyy');
		    	$scope.showrmaform = true;
		    	$scope.rmaformdata.invoice_info.invoice_customer_name = receipt.customer;
		    	$scope.ChangeInvoiceAddress(receipt.customer);
			}
		}, function error(response) {
		});
	}

	$scope.ChangeRelayDetails = function(index, info)
	{
		console.log(info)
		$scope.pvformdata.addedpvs[index].part_no = info.relay.part_no;
		$scope.pvformdata.addedpvs[index].id = info.relay.id;
		$scope.pvformdata.addedpvs[index].category = $filter('uppercase')(info.relay.category);
		$scope.pvformdata.addedpvs[index].sales_order_no = info.relay.sales_order_no;
		$scope.pvformdata.addedpvs[index].serial_no = info.relay.serial_no;
		$scope.pvformdata.addedpvs[index].warrenty = 0;
		$scope.pvformdata.addedpvs[index].field_volts_used = 0;
		$scope.pvformdata.addedpvs[index].equip_failed_on_installation = 0;
		$scope.pvformdata.addedpvs[index].equip_failed_on_service = 0;
	}

	$scope.CheckForAlreadeyExists = function(index, info)
	{
		console.log($scope.pvformdata.addedpvs)
		//we need not to check the last added item, because that is the item we need to check for existence
		for (var i = 0; i < $scope.pvformdata.addedpvs.length -1 ; i++) {
			if ($scope.pvformdata.addedpvs[i].relay.id == info.relay.id)
			{
				$scope.pvformdata.addedpvs[index].relay = {};
				$scope.pvformdata.addedpvs[index] = {};
				Notification.error('Already Selected');
				return;
			}
		}
	}

	$scope.AddPVUnit = function()
	{
		var newunit = {};
		$scope.pvformdata.addedpvs.push(newunit);
	}

	$scope.RemovePVUnit = function(index)
	{
		if ($scope.pvformdata.addedpvs.length == 1)
		{
			Notification.error('Atleast One Required');
			return;
		}
		else{
			$scope.pvformdata.addedpvs.splice(index, 1);
			Notification.success('Unit Removed');
		}
	}

	$scope.ChangeInvoiceAddress = function(customer)
	{
		$scope.rmaformdata.invoice_info.id = customer.id;
		$scope.rmaformdata.invoice_info.invoice_address = customer.address;
		$scope.rmaformdata.invoice_info.contact_name = customer.contact_person;
		$scope.rmaformdata.invoice_info.invoice_tel_no = customer.contact;
		$scope.rmaformdata.invoice_info.invoice_email = customer.email;
		$scope.rmaformdata.invoice_info.gst = customer.gst;
		$scope.ChangeDeliveryAddress();
	}

	$scope.ChangeDeliveryAddress = function()
	{
		if ($scope.rmaformdata.copy_invoice_address_to_delivery_address)
		{
			$scope.rmaformdata.delivery_info.address = $scope.rmaformdata.invoice_info.invoice_address;
			$scope.rmaformdata.delivery_info.contact_person = $scope.rmaformdata.invoice_info.contact_name;
			$scope.rmaformdata.delivery_info.tel_no = $scope.rmaformdata.invoice_info.invoice_tel_no;
			$scope.rmaformdata.delivery_info.email = $scope.rmaformdata.invoice_info.invoice_email;
			$scope.rmaformdata.delivery_info.gst = $scope.rmaformdata.invoice_info.gst;
		}
	}

	$scope.ChangeSCInvoiceAddress = function(customer)
	{
		$scope.sitecardform.invoice_info.id = customer.id;
		$scope.sitecardform.invoice_info.invoice_address = customer.address;
		$scope.sitecardform.invoice_info.contact_name = customer.contact_person;
		$scope.sitecardform.invoice_info.invoice_tel_no = customer.contact;
		$scope.sitecardform.invoice_info.invoice_email = customer.email;
		$scope.sitecardform.invoice_info.gst = customer.gst;
		$scope.ChangeSCDeliveryAddress();
	}

	$scope.ChangeSCDeliveryAddress = function()
	{
		if ($scope.sitecardform.copy_invoice_address_to_delivery_address)
		{
			$scope.sitecardform.delivery_info.address = $scope.sitecardform.invoice_info.invoice_address;
			$scope.sitecardform.delivery_info.contact_person = $scope.sitecardform.invoice_info.contact_name;
			$scope.sitecardform.delivery_info.tel_no = $scope.sitecardform.invoice_info.invoice_tel_no;
			$scope.sitecardform.delivery_info.email = $scope.sitecardform.invoice_info.invoice_email;
			$scope.sitecardform.delivery_info.gst = $scope.sitecardform.invoice_info.gst;
		}
		else
		{
			$scope.sitecardform.delivery_info = {};
		}
	}

	$scope.AssignSCEndCustomer = function()
	{
		console.log($scope.sitecardform.invoice_info)
		$scope.sitecardform.end_customer = $scope.sitecardform.invoice_info.end_cus.end_customer;
		console.log($scope.sitecardform.invoice_info)
	}

	$scope.ChangeTab = function(tab)
	{
		$scope.tab = tab;
		if ($scope.tab == 'all' || $scope.tab == 'completed')
		{
			$scope.GetRMAList($scope.tab, '');
		}
		else if ($scope.tab == 'saved')
		{
			$scope.GetRMAList($scope.tab, 'physical');
		}
		else if($scope.tab == 'withrma' || $scope.tab == 'withoutrma')
		{
			$scope.PVList($scope.tab);
		}
		else if ($scope.tab == 'opensitecard')
		{
			$scope.GetRMAList('all', 'sitecard');
		}

	}

	$scope.CreateSiteCard = function()
	{
		console.log('CreateSiteCard')
		$scope.showsitecardform = true;
		$scope.InitiateSiteCardForm();
	}

	$scope.SubmitRMAForm = function()
	{
		console.log($scope.rmaformdata)
		console.log($scope.selectedpvs)
		var dateformatregex = new RegExp(/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/i);
		var datestr = $scope.rmaformdata.date;
		var result = dateformatregex.test(datestr);
		if (!result)
		{
			Notification.error("Invalid Date Format");
			return;
		}
		if ($scope.rmaformdata.invoice_info.invoice_customer_name == undefined || $scope.rmaformdata.invoice_info.invoice_customer_name == null)
		{
			Notification.error("Please Select Customer");
			return;
		}
		if ($scope.rmaformdata.invoice_info.end_customer == undefined || $scope.rmaformdata.invoice_info.end_customer == null)
		{
			Notification.error("Please Enter End Customer");
			return;
		}

		$scope.rmaformdata.customer_address_id = $scope.rmaformdata.invoice_info.invoice_customer_name.id;
		if (($scope.rmaformdata.delivery_info.contact_person == undefined || $scope.rmaformdata.delivery_info.contact_person == null)
			|| ($scope.rmaformdata.delivery_info.address == undefined || $scope.rmaformdata.delivery_info.address == null) 
			|| ($scope.rmaformdata.delivery_info.tel_no == undefined || $scope.rmaformdata.delivery_info.tel_no == null)
			|| ($scope.rmaformdata.delivery_info.email == undefined || $scope.rmaformdata.delivery_info.email == null)
			|| ($scope.rmaformdata.delivery_info.gst == undefined || $scope.rmaformdata.delivery_info.gst == null)
		)
		{
			Notification.error("Please Enter Delivery Information");
			return;
		}

		$http({
			url: '/ge/addrma',
			method: 'POST',
			data: {
				'rma': $scope.rmaformdata,
				'pvs': $scope.selectedpvs
			}
		}).then(function(response){
			if (response.data.status == 'success')
			{
				var content = response.data.message + ' With Id:<b>' + response.data.data.formatted_rma_id + '</b>. Are you want to print?';
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
								$scope.rmaformdata = {};
								$scope.rmaformdata.unit_information = [];
								$scope.rmaformdata.repair_instruction = {};
								$scope.rmaformdata.invoice_info = {};
								$scope.rmaformdata.delivery_info = {};
								$scope.HideRMAForm();
							}
						},
						close: function () {
							$scope.rmaformdata = {};
							$scope.rmaformdata.unit_information = [];
							$scope.rmaformdata.repair_instruction = {};
							$scope.rmaformdata.invoice_info = {};
							$scope.rmaformdata.delivery_info = {};
							$scope.HideRMAForm();
						}
					}
				});
			}
			else if (response.data.status == 'failure')
			{
				Notification.error(response.data.message);
			}
		}, function(response){
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

	$scope.SubmitSiteCardForm = function()
	{
		var dateformatregex = new RegExp(/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/i);
		var datestr = $scope.sitecardform.date;
		var result = dateformatregex.test(datestr);
		if (!result)
		{
			Notification.error("Invalid Date Format");
			return;
		}
		$scope.sitecardform.customer_address_id = $scope.sitecardform.invoice_info.customer_name.id;
		$scope.sitecardform.end_customer = $scope.sitecardform.invoice_info.end_customer;
		$http({
			url: '/ge/addscrma',
			method: 'POST',
			data: {
				'rma': $scope.sitecardform,
			}
		}).then(function(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.rmaformdata = {};
				$scope.rmaformdata.unit_information = [];
				$scope.rmaformdata.repair_instruction = {};
				$scope.rmaformdata.invoice_info = {};
				$scope.rmaformdata.delivery_info = {};
				$scope.HideSiteCardForm();
			}
		}, function(response){
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

	$scope.SaveSiteCatdForm = function()
	{
		console.log($scope.rmaformdata)
		if ($scope.rmaformdata.id != undefined && $scope.rmaformdata.id != null)
			$scope.sitecardform = $scope.rmaformdata;
		console.log($scope.sitecardform)
		for (var i = 0; i < $scope.sitecardform.unit_information.length; i++) {
			//this is for from second save
			if ($scope.sitecardform.unit_information[i].part_no != "" && $scope.sitecardform.unit_information[i].part_no != undefined && $scope.sitecardform.unit_information[i].part_no != null)
			{
				$scope.sitecardform.unit_information[i].model_no = $scope.sitecardform.unit_information[i].part_no;
			}
			if ($scope.sitecardform.unit_information[i].model_no == "" || $scope.sitecardform.unit_information[i].model_no == undefined || $scope.sitecardform.unit_information[i].model_no == null)
			{
				Notification.error("Please Select All Model No");
				return;
			}
			if ($scope.sitecardform.unit_information[i].serial_no == "" || $scope.sitecardform.unit_information[i].serial_no == undefined || $scope.sitecardform.unit_information[i].serial_no == null)
			{
				Notification.error("Please Enter All Serial No");
				return;
			}
			if ($scope.sitecardform.unit_information[i].sw_version == "" || $scope.sitecardform.unit_information[i].sw_version == undefined || $scope.sitecardform.unit_information[i].sw_version == null)
			{
				Notification.error("Please Enter All Software Version");
				return;
			}
		}

		//after the first save invoice_info set null from backend
		//so we checking invoice_info
		if ($scope.sitecardform.invoice_info != undefined && $scope.sitecardform.invoice_info != null)
		{
			if ($scope.sitecardform.invoice_info.invoice_customer_name != undefined && $scope.sitecardform.invoice_info.invoice_customer_name != null)
			{
				$scope.sitecardform.customer_address_id = $scope.sitecardform.invoice_info.invoice_customer_name.id;
			}
		}

		//this is worst part of my code
		///i need to change this part
		if ($scope.sitecardform.invoice_info != undefined && $scope.sitecardform.invoice_info != null)
		{
			$scope.sitecardform.end_customer = $scope.sitecardform.invoice_info.end_customer;
		}

		console.log($scope.sitecardform)

		$http({
			url: '/ge/savesitecardrma',
			method: 'POST',
			data: {
				'sitecardrma': $scope.sitecardform,
			}
		}).then(function(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message + ' With Id:' +response.data.data.id);
				$scope.ChangeTab($scope.tab);
				$scope.showsitecardform = false;
				$scope.showrmaform = false;
			}
		}, function(response){
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

	$scope.SaveRMAForm = function()
	{
		var dateformatregex = new RegExp(/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/i);
		var datestr = $scope.rmaformdata.date;
		var result = dateformatregex.test(datestr);
		if (!result)
		{
			Notification.error("Invalid Date Format");
			return;
		}
		if ($scope.rmaformdata.invoice_info.invoice_customer_name == undefined || $scope.rmaformdata.invoice_info.invoice_customer_name == null)
		{
			Notification.error("Please Select Customer");
			return;
		}
		if ($scope.rmaformdata.invoice_info.end_customer == undefined || $scope.rmaformdata.invoice_info.end_customer == null)
		{
			Notification.error("Please Enter End Customer");
			return;
		}

		$scope.rmaformdata.customer_address_id = $scope.rmaformdata.invoice_info.invoice_customer_name.id;
		$http({
			url: '/ge/saverma',
			method: 'POST',
			data: {
				'rma': $scope.rmaformdata,
				'pvs': $scope.selectedpvs
			}
		}).then(function(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message + ' with Id:' +response.data.data.id);
				$scope.ChangeTab($scope.tab);
				$scope.showsitecardform = false;
				$scope.showrmaform = false;
			}
		}, function(response){
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

}]);