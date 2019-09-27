app.controller('RMAController', ['$scope', '$http', '$filter', 'Notification', '$timeout', function($scope, $http, $filter, Notification, $timeout){
	$scope.showrmaform = false;
	$scope.rmaformdata = {};
	$scope.rmaformdata.unit_information = [];
	$scope.rmaformdata.repair_instruction = {};
	$scope.rmaformdata.invoice_info = {};
	$scope.rmaformdata.delivery_info = {};
	$scope.rmaformdata.field_volts_used = 1;
	$scope.products = [];
	$scope.customers = [];
	$scope.gridOptions = {data : []};

	$scope.ShowRMAForm = function()
	{
		$scope.InitiateForm();
		$scope.showrmaform = true;
	}

	$scope.HideRMAForm = function()
	{
		$scope.showrmaform = false;
	}

	$scope.InitiateForm = function()
	{
		$scope.rmaformdata = {};
		$scope.rmaformdata.unit_information = [];
		$scope.rmaformdata.repair_instruction = {};
		$scope.rmaformdata.invoice_info = {};
		$scope.rmaformdata.delivery_info = {};
		$scope.rmaformdata.date = $filter('date')(new Date(),'dd/MM/yyyy');
		$scope.rmaformdata.field_volts_used = 1;
		var new_information = new Object();
		new_information.warrenty = 0;
		$scope.rmaformdata.unit_information.push(new_information);
		$scope.rmaformdata.equip_failed_on_installation = 0;
		$scope.rmaformdata.equip_failed_on_service = 0;
		$scope.rmaformdata.update_version = 0;
		$scope.rmaformdata.return_in_case = 0;
		$scope.GetProductList();
		$scope.GetCustomerList();
		$scope.GetRmaRefNumber();
	}

	$scope.EditRMAForm = function(id)
	{
		$scope.showrmaform = true;
		$scope.GetRMA(id);
	}

	$scope.GetRMAList = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/getrmalist'
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
	    		console.log($scope.rmaformdata);
	    		$scope.rmaformdata.ref_no = $scope.rmaformdata.rma_reference_no;
	    		$scope.rmaformdata.date =   $filter('date')($scope.rmaformdata.date, "dd/MM/yyyy");
	    		$scope.rmaformdata.wbs = $scope.rmaformdata.sales_order_no;
	    		$scope.rmaformdata.field_volts_used = $scope.rmaformdata.field_volts_used;
	    		$scope.rmaformdata.invoice_info.customer_name = $scope.rmaformdata.invoice_info.id;
	    		/*for (var i = 0; i < $scope.rmaformdata.unit_information.length; i++) {
	    			$scope.rmaformdata.unit_information[i].model_no = 
	    		}*/
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

	$scope.ChangeModelCategory = function(model)
	{
		model.model_id = model.model_no.id;
		model.type_of_material = model.model_no.category;
	}

	$scope.ChangeInvoiceAddress = function(customer)
	{
		$scope.rmaformdata.invoice_info.id = customer.id;
		//$scope.rmaformdata.invoice_info.customer_name = customer.name;
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

	$scope.AddUnitInformation = function()
	{
		if($scope.rmaformdata.unit_information.length == 5)
		{
			Notification.error('Should Not Be Greater Than 5');
		}
		else
		{
			var new_information = new Object();
			new_information.warrenty = 0;
			$scope.rmaformdata.unit_information.push(new_information);
			console.log($scope.rmaformdata.unit_information)
		}
		
	}

	$scope.RemoveUnitInformation = function($index)
	{
		if($scope.rmaformdata.unit_information.length == 1)
		{
			Notification.error('At Least One Required');
		}
		else
		{
			$scope.rmaformdata.unit_information.splice($index, 1);
		}
	}

	$scope.GenerateSerialNumberField = function(index, quantity)
	{
		$scope.rmaformdata.unit_information[index].serial_number_length = new Array(quantity);
	}

	$scope.SubmitRMAForm = function()
	{
		console.log($scope.rmaformdata)
		var dateformatregex = new RegExp(/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/i);
		var datestr = $scope.rmaformdata.date;
		var result = dateformatregex.test(datestr);
		if (!result)
		{
			Notification.error("Invalid Date Format");
			return;
		}
		$scope.rmaformdata.customer_address_id = $scope.rmaformdata.invoice_info.customer_name.id;
		console.log($scope.rmaformdata)

		$http({
			url: '/ge/addrma',
			method: 'POST',
			data: {
				'rma': $scope.rmaformdata
			}
		}).then(function(response){
			if (response.data.status == 'success')
			{
				$scope.rmaformdata = {};
				$scope.rmaformdata.unit_information = [];
				$scope.rmaformdata.repair_instruction = {};
				$scope.rmaformdata.invoice_info = {};
				$scope.rmaformdata.delivery_info = {};
			}
		}, function(response){

		});

	}

}]);