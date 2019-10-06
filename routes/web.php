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

Route::get('/forms', function() {
	return view('forms');
});

Route::get('/usercheck', 'UserController@UserCheck');

Route::post('/dologin', 'UserController@DoLogin');

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
});

Route::group(['middleware' => ['auth', 'admin']], function(){
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
	Route::get('masters-page/material-type', function(){
		return view('masters.material-type');
	});
	Route::get('masters-page/manufacture', function(){
		return view('masters.manufacture');
	});
	Route::get('masters-page/user', function(){
		return view('masters.user');
	});
	Route::get('/customers','CustomerController@Customers');
	Route::get('/endcustomers','CustomerController@EndCustomers');
	Route::get('/products','ProductController@Products');
	Route::get('/productsoftype/{producttype_id}', 'ProductController@ProductsOfType');
	Route::get('/locations','LocationController@Locations');
	Route::get('/sites','SiteController@Sites');
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

	Route::get('/getrmalist', 'RMAController@GetRMAList');
	Route::post('/getrma/{id}', 'RMAController@GetRma');
	Route::post('/addrma', 'RMAController@AddRMA');
	Route::post('/addrmaunit', 'RMAController@AddRmaUnit');

	/*Receipt Get and Post ,Delete*/
    Route::get('/receipts','ReceiptController@Receipts');

    Route::post('/addreceipt', 'ReceiptController@AddReceipt');
    Route::get('/getreceipt/{id}', 'ReceiptController@GetReceipt');

    Route::delete('/receipt/{id}', 'ReceiptController@DeleteReceipt');
    /*End Receipt*/


    /*Dispatch Get and Post*/
    Route::get('/dispatches','DispatchController@Dispatches');

    Route::post('/adddispatch', 'DispatchController@AddDispatch');
    Route::get('/getdispatch/{id}', 'DispatchController@GetDispatch');

    /*End Dispatch*/

    Route::post('/addwc', 'WarrantyPHPController@AddWarranty');

 Route::get('/rms','RMSController@RMS');

    Route::post('/addrms', 'RMSController@AddRMS');
  
    Route::post('/addphysicalverification' , 'PhysicalVerificationController@AddPhysicalVerification');
    Route::get('/GetPhysicalVerification/{id}', 'PhysicalVerificationController@GetPhysicalVerification');
    Route::get('/GetPhysicalVerificationForReceiptId/{receipt_id}', 'PhysicalVerificationController@GetPhysicalVerificationForReceiptId');
    Route::delete('/physicalverification/{id}', 'PhysicalVerificationController@DeletePV');
    Route::get('/physicalverification/{cat?}', 'PhysicalVerificationController@PhysicalVerificationList');
    Route::post('/changepvstatus','PhysicalVerificationController@ChangePVStatus');
	Route::post('/addproducttype', 'ProductTypeController@AddProductType');
	Route::get('/jobticket/{pvid}','JobTicketController@JobTicket');
	Route::post('/savejobticketmaterial', 'JobTicketController@SaveJobTicketMaterial');
	Route::post('/completejobticket', 'JobTicketController@CompleteJobTicket');
	Route::post('/savetestresult', 'AutoTestBenchController@SaveTestResult');
	Route::post('/saveverification','VerificationCompletionController@SaveVerification');

	Route::post('/addproduct', 'ProductController@AddProduct');

	Route::post('/addlocation', 'LocationController@AddLocation');

	Route::post('/addracktype', 'RackTypeController@AddRackType');

	Route::post('/addrack', 'RackController@AddRack');

	Route::post('/addpackingstyle', 'PackingStyleController@AddPackingStyle');

	Route::post('/addmaterialtype', 'MaterialTypeController@AddMaterialType');

	Route::post('/addmanufacture', 'ManufactureController@AddManufacture');

	Route::post('/adduser', 'UserController@AddUser');

	Route::post('/addmaterial', 'MaterialController@AddMaterial');

	Route::post('/addsite', 'SiteController@AddSite');

	Route::delete('/site/{id}', 'SiteController@DeleteSite');
});