<?php

namespace App\Http\Controllers;

use App\Models\ReceiptMaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerLocationTransaction;
use App\Models\CustomerSiteTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddReceiptRequest;
use Carbon\Carbon;

class ReceiptController extends Controller
{
    public function Receipts(Request $request)
    {
        $receipt = ReceiptMaster::selectRaw('receipt.*,receipt_no , gs_no ,receipt_date,customer_name,end_customer,courier_name,docket_details,total_boxes ')->get();
        return response()->json(['data' => $receipt, 'status' => 'success']);
    }

    public function GetReceipt($id)
    {
        $receipt = ReceiptMaster::selectRaw('receipt.*, receipt_no, st.name as site_name, loc.id as location_id, loc.name as location_name')->leftJoin('ma_customer_site_trans as cst', 'ma_customer.id', '=', 'cst.customer_id')->leftJoin('ma_site as st', 'st.id','=', 'cst.site_id')->leftJoin('ma_customer_location_trans as clt','clt.customer_id', 'ma_customer.id')->leftJoin('ma_location as loc', 'clt.location_id', '=', 'loc.id')->where('ma_customer.id', $id)->first();
        return response()->json(['receipt' => $receipt], 200);
    }

    public function AddReceipt(AddReceiptRequest $request)
    {
        $receipt = $request->get('receipt');
        $RM = new ReceiptMaster();
        $RM->receipt_no = $receipt['receipt_no'];
        $RM->gs_no = $receipt['gs_no'];
        $date = Carbon::createFromFormat('d/m/Y',$receipt['re_date']);
        $RM->receipt_date = $date->format('Y-m-d');
        $RM->customer_name = $receipt['cu_name'];
        $RM->end_customer = $receipt['end_cusname'];
        $RM->courier_name = $receipt['courier_name'];
        $RM->docket_details = $receipt['docket_details'];
        $RM->total_boxes = $receipt['no_of_boxes'];
      /*  $RM->created_by = Auth::id();
        $RM->updated_by = Auth::id();
        $RM->created_at = Carbon::now();
        $RM->updated_at = Carbon::now();*/
        $RM->save();

      /*  $CST = new CustomerSiteTransaction();
        $CST->customer_id = $CM->id;
        $CST->site_id = $customer['site_id'];
        $CST->created_by = Auth::id();
        $CST->updated_at = Auth::id();
        $CST->save();

        $CLT = new CustomerLocationTransaction();
        $CLT->customer_id = $CM->id;
        $CLT->location_id = $customer['location_id'];
        $CLT->created_by = Auth::id();
        $CLT->updated_by = Auth::id();
        $CLT->save();*/

        return response()->json(['data' => $RM, 'status' => 'success', 'messagae' => 'Receipt Added Successfully'], 200);
    }
}
