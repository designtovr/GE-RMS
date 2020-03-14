<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/rms', function(){
	return view('rms-list');
});

Route::get('/login', function() {
	return view('login');
})->name('login');

Route::get('/register', function() {
	return view('register');
});

Route::get('/forget', function() {
	return view('forget');
});

Route::get('/test', function() {
	return "test";
});

Route::get('/charts', function() {
	return view('charts');
});

Route::get('/print', function() {
    return view('print');
});

Route::get('/forms', function() {
	return view('forms');
});

Route::get('/storedprocedure','MailController@StoredProcedure');

Route::get('/samplepdf', 'MailController@SamplePdf');
Route::get('/import-product', 'MailController@ImportProduct');
Route::get('sendphpmailer', 'MailController@phpmailer_email');
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');

Route::get('/usercheck', 'UserController@UserCheck');

Route::post('/dologin', 'UserController@DoLogin');
Route::post('/forgotpassword', 'UserController@ForgotPassword');
Route::post('/changepassword', 'UserController@ChangePassword');

Route::group(['middleware' => 'auth'], function(){

	Route::get('/dashboard', function() {
		return view('index');
	})->name('dashboard');
	Route::get('/logout', 'UserController@Logout');
	Route::get('/tables', function() {
		return view('tables');
	});
	Route::get('/receipt', function(){
		return view('receipt-list');
	});
	Route::get('/add-receipt', function(){
		return view('add-receipt');
	});
	Route::get('/rma', function(){
		return view('rma-list');
	});
	Route::get('/add-rma', function(){
		return view('add-rma');
	});
	Route::get('/warranty/{page?}{itemsPerPage?}', function(){
		return view('warranty-list');
	});
	Route::get('/add-warranty', function(){
		return view('add-warranty');
	});
	Route::get('/rma-linkage', function(){
		return view('rma-linkage-list');
	});

    Route::get('/rma-form-linkage', function(){
        return view('rma-form-linkage');
    });


	Route::get('/add-rma-linkage', function(){
		return view('add-rma-linkage');
	});
	
	Route::get('/add-rms', function(){
		return view('add-rms');
	});
	Route::get('/other-relay-repair-status', function(){
		return view('relay-repair-status-list');
	});
	Route::get('/add-relay-repair-status', function(){
		return view('add-relay-repair-status');
	});
	Route::get('/repair-initiation', function(){
		return view('repair-initiation-list');
	});

    Route::get('/repair-initiation', function(){
        return view('repair-initiation-list');
    });

    Route::get('/dispatch-approval', function(){
        return view('dispatch-approval');
    });

	Route::get('/add-repair-initiation', function(){
		return view('add-repair-initiation');
	});
	Route::get('/auto-test-bench', function(){
		return view('auto-test-bench-list');
	});
	Route::get('/add-auto-test-bench', function(){
		return view('add-auto-test-bench');
	});
	Route::get('/aging-complete', function(){
		return view('aging-complete-list');
	});
	Route::get('/add-aging-complete', function(){
		return view('add-aging-complete');
	});
	Route::get('/verification-completion', function(){
		return view('verification-completion-list');
	});

	Route::get('/add-verification-completion', function(){
		return view('add-verification-completion');
	});
	Route::get('/dispatch', function(){
		return view('dispatch-list');
	});
	Route::get('/add-dispatch', function(){
		return view('add-dispatch');
	});
	Route::get('/physical-verification', function(){
		return view('physical-verification');
	});
	Route::get('/add-physical-verification', function(){
		return view('add-physical-verification');
	});
	Route::get('/job-ticket', function(){
		return view('job-ticket-list');
	});

	Route::get('/add-job-ticket', function(){
		return view('add-job-ticket');
	});

	Route::get('masters-page/printerips', function(){
		return view('masters.printerips');
	});

    Route::get('/rma-form/{rma_id}', 'PrintController@RMAForm');

    Route::get('/job-ticket-form/{pv_id}','PrintController@JobTicketForm');

    Route::get('/physical-verification-form/{rma_id}', 'PrintController@PhysicalVerificationForm');

    Route::get('/test-report-form/{pv_id}', 'PrintController@TestReportForm');

    Route::get('/header-footer-print', function(){
    	return view('pdf.header-footer-print');
    });

    Route::get('/qrcode', function(){
        return view('webqrtest');
    });
    Route::get('/qr', function(){
        return view('qr');
    });
    Route::get('/relay-stages-report', function(){
    	return view('relay-stages-report');
    });
    Route::get('/rma-report', function(){
    	return view('rma-report');
    });
    Route::get('/dispatch-report', function(){
    	return view('dispatch-report');
    });

	Route::get('/daily-report', function(){
		return view('daily-report');
    });
	 
      Route::get('/repair-report', function(){
    	return view('repair-report');
    });
	Route::get('/daily-report-mail', 'MailController@DailyReportMail');
	Route::get('/daily-report-data', 'MailController@DailyReportData');
});

Route::group(['middleware' => ['auth']], function(){
	Route::get('masters-page/customer', function(){
		return view('masters.customer');
	});
	Route::get('masters-page/product', function(){
		return view('masters.product');
	});
	Route::get('masters-page/location', function(){
		return view('masters.location');
	});
	Route::get('masters-page/site', function(){
		return view('masters.site');
	});
	Route::get('masters-page/rack-type', function(){
		return view('masters.rack-type');
	});
	Route::get('masters-page/rack', function(){
		return view('masters.rack');
	});
	Route::get('masters-page/material', function(){
		return view('masters.material');
	});
	Route::get('masters-page/packing-style', function(){
		return view('masters.packing-style');
	});
	Route::get('masters-page/product-type', function(){
		return view('masters.product-type');
	});
	Route::get('masters-page/product-overdue-age', function(){
		return view('masters.product-overdue-age');
	});
	Route::get('masters-page/material-type', function(){
		return view('masters.material-type');
	});
	Route::get('masters-page/manufacture', function(){
		return view('masters.manufacture');
	});
	Route::get('masters-page/user', function(){
		return view('masters.user');
	});
	Route::get('getdashboardvalues', 'DashboardController@GetDashboardValues');
	Route::get('/customers','CustomerController@Customers');
	Route::get('/endcustomers','CustomerController@EndCustomers');
	Route::get('/products','ProductController@Products');
	Route::get('/productsoftype/{producttype_id}', 'ProductController@ProductsOfType');
	Route::get('/productoverdueage', 'ProductTypeController@ProductOverdueAge');
	Route::get('/locations','LocationController@Locations');
	Route::delete('/location/{id}', 'LocationController@DeleteLocation');
	Route::get('/sites','SiteController@Sites');
	Route::get('/sitesforreceipt','SiteController@SitesForReceipt');
	Route::get('/rack-types','RackTypeController@RackTypes');
	Route::get('/racks','RackController@Racks');
	Route::get('/materials','MaterialController@Materials');
	Route::get('/packing-styles','PackingStyleController@PackingStyles');
	Route::get('/product-types','ProductTypeController@ProductTypes');
	Route::get('/material-types','MaterialTypeController@MaterialTypes');
	Route::get('/manufactures','ManufactureController@Manufactures');
	Route::get('/users','UserController@Users');
	Route::get('/roles','RoleController@Roles');
	Route::get('/rmarefno', 'RMAController@GetRMARefNo');

	Route::post('/addcustomers', 'CustomerController@AddCustomer');
	Route::get('/getcustomer/{id}', 'CustomerController@GetCustomer');
	Route::delete('/customer/{id}', 'CustomerController@DeleteCustomer');

	Route::get('/getrmalist/{cat?}/{type?}', 'RMAController@GetRMAList');
	Route::post('/getrma/{id}', 'RMAController@GetRma');
	Route::post('/addrma', 'RMAController@AddRMA');
	Route::post('/saverma', 'RMAController@SaveRMA');
	Route::post('/savesitecardrma', 'RMAController@SaveSiteCardRMA');
	Route::post('/addrmaunit', 'RMAController@AddRmaUnit');
	Route::post('/addscrma', 'RMAController@AddSCRMA');

	/*Receipt Get and Post ,Delete*/
    Route::get('/receipts/{cat?}','ReceiptController@Receipts');

    Route::post('/addreceipt', 'ReceiptController@AddReceipt');
    Route::get('/sendreceiptmail', 'MailController@ReceiptMail');
    Route::get('/getreceipt/{id}', 'ReceiptController@GetReceipt');

    Route::delete('/receipt/{id}', 'ReceiptController@DeleteReceipt');

    Route::post('/changereceiptstatus', 'ReceiptController@ChangeStatus');
    /*End Receipt*/


    /*Dispatch Get and Post*/
    Route::get('/dispatches','DispatchController@Dispatches');

    Route::post('/adddispatch', 'DispatchController@AddDispatch');
    Route::get('/getdispatch/{id}', 'DispatchController@GetDispatch');

    /*End Dispatch*/

    Route::post('/addwc', 'WarrantyPHPController@AddWarranty');
    Route::post('/updatewc', 'WarrantyPHPController@UpdateWarranty');

    Route::get('/getwarranty/{pv_id}','WarrantyPHPController@GetWarranty');

 	Route::get('/getrms','RMSController@RMS');

    Route::post('/addrms', 'RMSController@AddRMS');
  
    Route::post('/addphysicalverification' , 'PhysicalVerificationController@AddPhysicalVerification');
    Route::get('/GetPhysicalVerification/{id}', 'PhysicalVerificationController@GetPhysicalVerification');
    Route::get('/GetPhysicalVerificationForReceiptId/{receipt_id}', 'PhysicalVerificationController@GetPhysicalVerificationForReceiptId');
    Route::delete('/physicalverification/{id}', 'PhysicalVerificationController@DeletePV');
    Route::get('/physicalverification/{cat?}', 'PhysicalVerificationController@PhysicalVerificationList');
    Route::get('/pvwithreceipts/{cat?}','PhysicalVerificationController@PVWithReceipts');
    Route::post('/changepvstatus','PhysicalVerificationController@ChangePVStatus');
    Route::get('/checkserialnumberexistence/{serial_no}/{exclude_id}', 'PhysicalVerificationController@CheckSerialNumberExistence');
    Route::get('/pvforrmaid/{id}', 'PhysicalVerificationController@PVForRmaId');
	Route::post('/addproducttype', 'ProductTypeController@AddProductType');
	Route::post('/updateproductoverdueage', 'ProductTypeController@UpdateProductOverdueAge');
	Route::delete('/producttype/{id}', 'ProductTypeController@DeleteProductType');
    Route::get('/jobticket/{pvid}','JobTicketController@JobTicket');
	Route::post('/savejobticketmaterial', 'JobTicketController@SaveJobTicketMaterial');
	Route::post('/completejobticket', 'JobTicketController@CompleteJobTicket');
	Route::post('/updatesitecardjobticket', 'JobTicketController@UpdateSiteCardJobTicket');
	Route::get('/jtmaterialspartnos', 'JobTicketController@JTMaterialsPartNos');
	Route::post('/savetestresult', 'AutoTestBenchController@SaveTestResult');
	Route::post('/saveagingresult', 'AgingController@SaveAgingResult');
	Route::post('/saveverification','VerificationCompletionController@SaveVerification');
	Route::get('/pvprioritylist', 'PVPriorityController@PriorityList');
	Route::post('/setpvpriority', 'PVPriorityController@SetPvPriority');

	Route::post('/addproduct', 'ProductController@AddProduct');
	Route::delete('/product/{id}', 'ProductController@DeleteProduct');

	Route::post('/addlocation', 'LocationController@AddLocation');

	Route::post('/addracktype', 'RackTypeController@AddRackType');

	Route::post('/addrack', 'RackController@AddRack');

	Route::post('/addpackingstyle', 'PackingStyleController@AddPackingStyle');

	Route::post('/addmaterialtype', 'MaterialTypeController@AddMaterialType');

	Route::post('/addmanufacture', 'ManufactureController@AddManufacture');

	Route::post('/adduser', 'UserController@AddUser');

	Route::delete('/user/{id}', 'UserController@DeleteUser');

	Route::post('/addmaterial', 'MaterialController@AddMaterial');

    Route::post('/addsite', 'SiteController@AddSite');
    Route::post('/printlabel', 'PrintController@PrintLabel');
    Route::post('/printreceipt', 'PrintController@PrintReceipt');

	Route::delete('/site/{id}', 'SiteController@DeleteSite');

	Route::get('/dataforrelaysstagereport', 'ReportsController@DataForRelaysStageReport');

	Route::get('/listforrmareport', 'ReportsController@ListForRMAReport');

	Route::get('/listfordispatchreport', 'ReportsController@ListForDispatchReport');

	Route::get('/relaystagereport/{id}', 'ReportsController@RelayStageReport');

	Route::get('/rmareport/{id}', 'ReportsController@RMAReport');

	Route::get('/dispatchreport/{id}', 'ReportsController@DispatchReport');

	Route::get('/receipt-mail', 'MailController@ReceiptMail');

	Route::get('/pvcompletionmail/{rma_id}', 'MailController@PVCompletionMail');

	Route::get('/scpvcompletionmail/{rma_id}', 'MailController@SCPVCompletionMail');

	Route::get('/wcmail/{pv_id}', 'MailController@WCCompletionMail');

	Route::get('/dispatchcompletionmail/{pv_id}', 'MailController@DispatchCompletionMail');

	Route::get('/lableprintersip', 'PrintController@LablePrintersIP');

	Route::post('/changeprinterip', 'PrintController@ChangePrinterIP');

	Route::post('/exportfile', 'FileExportController@ExportExcelFile');

	Route::get('/exportreceiptfile', 'FileExportController@ExportReceiptFile');
});