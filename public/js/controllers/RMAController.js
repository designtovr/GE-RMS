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
	$scope.gridOptions = {

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
		$scope.filteract = '';
		$scope.filterCustomer = '';
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
		$scope.ChangeRelayDetails();
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
	    		$scope.rmaformdata = response.data.data;
	    		$scope.rmaformdata.date =   $filter('date')($scope.rmaformdata.date, "dd/MM/yyyy");
	    		$scope.rmaformdata.edit = true;
	    		if ($scope.rmaformdata.invoice_info != null)
	    		{
	    			$scope.rmaformdata.invoice_info.customer_name = $scope.rmaformdata.invoice_info;
	    			$scope.ChangeInvoiceAddress($scope.rmaformdata.invoice_info.customer_name);
	    		}
	    		if($scope.rmaformdata.unit_information.length > 0)
	    		{
	    			$scope.selectedpvs = $scope.rmaformdata.unit_information;
	    			$scope.rmaformdata.relay = $scope.rmaformdata.unit_information[0];
	    			console.log($scope.rmaformdata.relay)
	    			//$scope.ChangeRelayDetails();
	    		}
	    		if ($scope.rmaformdata.invoice_info != undefined && $scope.rmaformdata.invoice_info != null)
	    		{
	    			if ($scope.rmaformdata.invoice_info.end_customer != undefined && $scope.rmaformdata.invoice_info.end_customer != null)
	    				$scope.rmaformdata.invoice_info.end_customer = {'end_customer': $scope.rmaformdata.end_customer};
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
		    var addoption = {'id':-1, 'part_no': 'Add New'};
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
			    var addoption = {'end_customer': 'Add New'};
			    $scope.endcustomers.push(addoption);
			}
		}, function error(response) {
		});
	}

	$scope.AddPVForm = function(id)
	{
		$scope.GetRMA(id);
		$scope.showrmaform = true;
		$scope.addpvform = true;
		$scope.PVList('withoutrma');
		$scope.GetProductList();
		$scope.GetCustomerList();
		$scope.GetEndCustomerList();
	}

	$scope.SubmitRMAUnitForm = function()
	{
		$http({
			method: 'POST',
			url: '/ge/addrmaunit',
			data: {
				'rma': $scope.rmaformdata,
				'pv': $scope.rmaformdata.relay
			}
		}).then(function success(response) {
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$scope.showrmaform = false;
				$scope.GetRMAList();
			}
		}, function error(response) {
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
				$scope.selectedpvs.push($scope.pvgridOptions.data[i]);
			}
		}
		if ($scope.selectedpvs.length == 0)
		{
			Notification.error("No Relay Selected");
			return;
		}
		$scope.showrmaform = true;
	}

	$scope.ChangeRelayDetails = function()
	{
		console.log($scope.rmaformdata)
		$scope.rmaformdata.relay.model_no = $scope.rmaformdata.relay.part_no;
		$scope.rmaformdata.relay.type_of_material = $filter('uppercase')($scope.rmaformdata.relay.category);
		$scope.rmaformdata.relay.wbs = $scope.rmaformdata.relay.wbs;
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
			$scope.rmaformdata.delivery_info.delivery_address = $scope.rmaformdata.invoice_info.invoice_address;
			$scope.rmaformdata.delivery_info.contact_name = $scope.rmaformdata.invoice_info.contact_name;
			$scope.rmaformdata.delivery_info.tel_no = $scope.rmaformdata.invoice_info.invoice_tel_no;
			$scope.rmaformdata.delivery_info.delivery_email = $scope.rmaformdata.invoice_info.invoice_email;
			$scope.rmaformdata.delivery_info.gst_number = $scope.rmaformdata.invoice_info.gst;
		}
		else
		{
			$scope.rmaformdata.delivery_info = {};
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
		if ($scope.tab == 'all' || $scope.tab == 'saved')
		{
			$scope.GetRMAList($scope.tab, '');
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
		var dateformatregex = new RegExp(/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/i);
		var datestr = $scope.rmaformdata.date;
		var result = dateformatregex.test(datestr);
		if (!result)
		{
			Notification.error("Invalid Date Format");
			return;
		}
		if ($scope.rmaformdata.invoice_info == undefined || $scope.rmaformdata.invoice_info == null)
		{
			Notification.error("Please Select Customer");
			return;
		}
		if ($scope.rmaformdata.invoice_info.customer_name == undefined || $scope.rmaformdata.invoice_info.customer_name == null)
		{
			Notification.error("Please Select Customer");
			return;
		}
		if ($scope.rmaformdata.invoice_info.end_customer == undefined || $scope.rmaformdata.invoice_info.end_customer == null)
		{
			Notification.error("Please Select End Customer");
			return;
		}
		$scope.rmaformdata.customer_address_id = $scope.rmaformdata.invoice_info.customer_name.id;

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
				Notification.success(response.data.message);
				$scope.rmaformdata = {};
				$scope.rmaformdata.unit_information = [];
				$scope.rmaformdata.repair_instruction = {};
				$scope.rmaformdata.invoice_info = {};
				$scope.rmaformdata.delivery_info = {};
				$( "#closermabutton" ).trigger( "click" );
				$( "#myTab" ).trigger( "click" );
				$("#all-tab").addClass("intro");
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
		if ($scope.sitecardform.invoice_info.end_cus.end_customer == 'Add New')
		{
			$scope.sitecardform.end_customer = $scope.sitecardform.manual_end_customer;
		}
		console.log($scope.sitecardform);
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

	$scope.SaveRMAForm = function()
	{
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
				Notification.success(response.data.message);
				$scope.ChangeTab($scope.tab);
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