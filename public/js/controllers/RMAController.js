app.controller('RMAController', ['$scope', '$http', '$filter', 'Notification', function($scope, $http, $filter, Notification){
	$scope.showrmaform = true;
	$scope.rmaformdata = {};
	$scope.rmaformdata.unit_information = [];
	$scope.rmaformdata.repair_instruction = {};
	$scope.rmaformdata.invoice_info = {};
	$scope.rmaformdata.delivery_info = {};

	$scope.ShowRMAForm = function()
	{
		$scope.showrmaform = true;
	}

	$scope.HideRMAForm = function()
	{
		$scope.showrmaform = false;
	}

	$("#date").change(function(){
		if ($('#date').val() == '')
		{
			alert('null')
			$scope.RMAForm.date.$error.required = true;
			$scope.RMAForm.date.$error = true;
			return;
		}
	  	$scope.rmaformdata.date = $('#date').val();
	  	$scope.RMAForm.date.$error = false;
	  	$scope.RMAForm.date.$error.required = false;
	});

	$scope.Initiate = function()
	{
		$scope.rmaformdata.date = $filter('date')(new Date(),'dd/MM/yyyy');
		var new_information = new Object();
		new_information.warrenty = 1;
		$scope.rmaformdata.unit_information.push(new_information);
		$scope.rmaformdata.unit_information.equip_failed_on_installation = 0;
		$scope.rmaformdata.unit_information.equip_failed_on_service = 0;
		$scope.rmaformdata.update_version = 0;
		$scope.rmaformdata.return_in_case = 0;
	}

	$scope.test = function()
	{
		console.log($scope.rmaformdata);
	}

	$scope.AddUnitInformation = function()
	{
		if($scope.rmaformdata.unit_information.length == 5)
		{
			Notification.primary('Should Not Be Greater Than 5');
		}
		else
		{
			var new_information = new Object();
			new_information.warrenty = 1;
			$scope.rmaformdata.unit_information.push(new_information);
			console.log($scope.rmaformdata.unit_information)
		}
		
	}

	$scope.RemoveUnitInformation = function($index)
	{
		if($scope.rmaformdata.unit_information.length == 1)
		{
			Notification.primary('At Least One Required');
		}
		else
		{
			$scope.rmaformdata.unit_information.splice($index, 1);
		}
	}

	$scope.GenerateSerialNumberField = function(index, quantity)
	{
		console.log(index)
		console.log(quantity)
		$scope.rmaformdata.unit_information[index].serial_number_length = new Array(quantity);
		console.log($scope.rmaformdata)
		console.log($scope.rmaformdata.unit_information[index].serial_number_length)
	}

}]);