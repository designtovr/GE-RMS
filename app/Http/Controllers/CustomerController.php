<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerMaster;
use App\Models\CustomerLocationTransaction;
use App\Models\CustomerSiteTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddCustomerRequest;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function Customers(Request $request)
    {
    	$customers = CustomerMaster::selectRaw('ma_customer.*, st.name as site_name, loc.name as location_name')->leftJoin('ma_customer_site_trans as cst', 'ma_customer.id', '=', 'cst.customer_id')->leftJoin('ma_site as st', 'st.id','=', 'cst.site_id')->leftJoin('ma_customer_location_trans as clt','clt.customer_id', 'ma_customer.id')->leftJoin('ma_location as loc', 'clt.location_id', '=', 'loc.id')->orderBy('ma_customer.id')->get();
    	
    	return response()->json(['data' => $customers, 'status' => 'success']);
    }

    public function GetCustomer($id)
    {
    	$customer = CustomerMaster::selectRaw('ma_customer.*, st.id as site_id, st.name as site_name, loc.id as location_id, loc.name as location_name')->leftJoin('ma_customer_site_trans as cst', 'ma_customer.id', '=', 'cst.customer_id')->leftJoin('ma_site as st', 'st.id','=', 'cst.site_id')->leftJoin('ma_customer_location_trans as clt','clt.customer_id', 'ma_customer.id')->leftJoin('ma_location as loc', 'clt.location_id', '=', 'loc.id')->where('ma_customer.id', $id)->first();
    	return response()->json(['customer' => $customer], 200);
    }

    public function AddCustomer(AddCustomerRequest $request)
    {
    	$customer = $request->get('customer');
    	$CM = new CustomerMaster();
    	$CM->code = $customer['code'];
    	$CM->name = $customer['name'];
    	$CM->address = $customer['address'];
    	$CM->contact_person = $customer['contact_person'];
    	$CM->email = $customer['email'];
    	$CM->gst = $customer['gst'];
    	$CM->contact = $customer['contact'];
    	$CM->created_by = Auth::id();
    	$CM->updated_by = Auth::id();
    	$CM->created_at = Carbon::now();
    	$CM->updated_at = Carbon::now();
    	$CM->save();

    	$CST = new CustomerSiteTransaction();
    	$CST->customer_id = $CM->id;
    	$CST->site_id = $customer['site_id'];
    	$CST->created_by = Auth::id();
    	$CST->updated_by = Auth::id();
    	$CST->save();

    	$CLT = new CustomerLocationTransaction();
    	$CLT->customer_id = $CM->id;
    	$CLT->location_id = $customer['location_id'];
    	$CLT->created_by = Auth::id();
    	$CLT->updated_by = Auth::id();
    	$CLT->save();

    	return response()->json(['data' => $CM, 'status' => 'success', 'messagae' => 'Customer Added Successfully'], 200);
    }
}
