
app.controller('ReceiptController', ['$scope', '$http', 'Notification' ,'$filter','$ngConfirm', 'Excel', 'ExcelSave', '$timeout', 'Upload' , 'FileSaver', 'Blob', function($scope, $http,Notification, $filter , $ngConfirm, Excel,ExcelSave, $timeout, Upload , FileSaver , Blob){
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
				var content = response.data.message + ' With Id:<b>'+ response.data.data.formatted_receipt_id + '</b>, Are You Want to Print?';
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
								return false;
							}
						},
						close: function () {
							$scope.HideReceiptForm();
							$scope.GetSiteList();
						}
					}
				});
				
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

	   download = function(text) {
	   	var data = new Blob([text], { type: 'text/plain;charset=utf-8' });
	   	FileSaver.saveAs(data, 'text.txt');
	   };

	   $scope.exportToExcelSave=function(tableId , filename){ 

	   	ExcelSave.tableToExcel(tableId,filename);

	   	$timeout(function(){

		},100); // trigger download
	   }

		$scope.SaveExcel=function(tableId){ // ex: '#my-table'
		var uri='data:application/vnd.ms-excel;base64,',
		template='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',

		format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p];})};
		var table=$(tableId);

		var	ctx={worksheet: 'Sheet1' , table:table.html()}, href=uri+base64(format(template,ctx));

		
		var blob = new Blob([format(template,ctx)], { type: "application/vnd.ms-excel" });
		Excel.tableToExcel(tableId,'Sheet1');
/*
		var uri='data:application/vnd.ms-excel;base64,',
		template='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
		format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p];})};
			var	ctx={worksheet:'Sheet1' , table:table.html()}, href=uri+base64(format(template,ctx));
$scope.exportHref=Excel.tableToExcel(tableId,'Sheet1');
var blob = new Blob([e.format(template, ctx)], { type: "application/vnd.ms-excel" });
                blob.name = "gf.xls";
                window.URL = window.URL || window.webkitURL;
                link = window.URL.createObjectURL(blob);*/
                FileSaver.saveAs(blob, 'Receipt.xls');

                $timeout(function(){

                	console.log("123123");

		},100); // trigger download
            }

            function dataURLtoFile(dataurl, filename) {
            	var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
            	bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
            	while(n--){
            		u8arr[n] = bstr.charCodeAt(n);
            	}
            	return new File([u8arr], filename, {type:mime});
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
            	$scope.dateTo = '';
            	$scope.dateFrom = '';
            }

            $scope.checkDate = function()
            {
            	$scope.dateTo =   $filter('date')($scope.dateTo, "yyyy-mm-dd");
            	$scope.dateFrom =   $filter('date')($scope.dateFrom, "yyyy-mm-dd");
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
            			Notification.success(response.data.message);
            			$scope.HideReceiptForm();
            			$scope.GetSiteList();
            		}
            		else if(response.data.status == 'failure')
            		{
            			Notification.error(response.data.message);
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