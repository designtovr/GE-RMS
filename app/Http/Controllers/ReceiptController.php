<?php

namespace App\Http\Controllers;

use App\Models\PhysicalVerificationMaster;
use App\Models\ReceiptMaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerLocationTransaction;
use App\Models\CustomerSiteTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddReceiptRequest;
use App\Http\Requests\AddPhysicalVerificationRequest;
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
        $receipt = ReceiptMaster::selectRaw('receipt.*, receipt_no, st.name as site_name, loc.id as location_id, loc.name as location_name')->leftJoin('ma_customer_site_trans as cst', 'ma_customer.id', '=', 'cst.customer_id')->leftJoin('ma_site as st', 'st.id', '=', 'cst.site_id')->leftJoin('ma_customer_location_trans as clt', 'clt.customer_id', 'ma_customer.id')->leftJoin('ma_location as loc', 'clt.location_id', '=', 'loc.id')->where('ma_customer.id', $id)->first();
        return response()->json(['receipt' => $receipt], 200);
    }

    public function GetPhysicalVerification($id)
    {

        $physicalverification = PhysicalVerificationMaster::selectRaw('physical_verification.*')->where('receipt_no', $id)->first();

        if($physicalverification) {
            return response()->json(['physicalverification' => $physicalverification , 'status' => 'Edit'], 200);
        }

        else
        {
            return response()->json(['physicalverification' => $physicalverification , 'status' => 'New'],200);
        }
    }

    public function AddReceipt(AddReceiptRequest $request)
    {
        $receipt = $request->get('receipt');
        $exists = true;
        $RM = ReceiptMaster::where('receipt_no', $receipt['receipt_no'])->first();

        if (!$RM) {
            $RM = new ReceiptMaster();
            $exists = false;
        }


        $RM->receipt_no = $receipt['receipt_no'];
        $RM->gs_no = $receipt['gs_no'];
        $date = Carbon::createFromFormat('d/m/Y', $receipt['receipt_date']);
        $RM->receipt_date = $date->format('Y-m-d');
        $RM->customer_name = $receipt['customer_name'];
        $RM->end_customer = $receipt['end_customer'];
        $RM->courier_name = $receipt['courier_name'];
        $RM->docket_details = $receipt['docket_details'];
        $RM->total_boxes = $receipt['total_boxes'];

        if ($exists) {
            $RM->updated_by = Auth::id();
            $RM->updated_at = Carbon::now();
            $RM->update();
            $message = 'Receipt Updated Successfully';
        } else {
            $RM->created_by = Auth::id();
            $RM->updated_by = Auth::id();
            $RM->created_at = Carbon::now();
            $RM->updated_at = Carbon::now();
            $RM->save();
            $message = 'Receipt Added Successfully';
        }


        return response()->json(['data' => $RM, 'status' => 'success', $message], 200);
    }

    public function DeleteReceipt($id)
    {
        ReceiptMaster::destroy($id);
        $message = 'Receipt Deleted Successfully';
        return response()->json(['status' => 'success', 'message' => $message], 200);
    }

    public function DeletePhysicalVerification($id)
    {
        PhysicalVerificationMaster::where('receipt_no',$id)->destroy();
        $message = 'Physical Verification Data Deleted Successfully';
        return response()->json(['status' => 'success', 'message' => $message], 200);
    }

    public function AddPhysicalVerification(AddPhysicalVerificationRequest $request)
    {

        $physical = $request->get('physicalverification');
        $exists = true;

        if($physical['rid']) {
            $PVM = PhysicalVerificationMaster::where('rid', $physical['rid'])->first();
        }

        else
        {
            $PVM = new PhysicalVerificationMaster();
            $exists = false;
        }

        $PVM->receipt_no = $physical ['receipt_no'];
        $PVM->rid = $physical['rid'];
        $PVM->docket_details = $physical ['docket_details'];
        $PVM->courier_name = $physical ['courier_name'];
        $date = Carbon::createFromFormat('d/m/Y', $physical ['pvdate']);
        $PVM->pvdate = $date->format('Y-m-d');
        $PVM->product = $physical ['product'];
        $PVM->product_type = $physical ['product_type'];
        $PVM->model_no = $physical['model_no'];
        $PVM->serial_no = $physical ['serial_no'];
        $PVM->defect = $physical ['defect'];
        $PVM->case = $physical ['case'];
        $PVM->case_condition = $physical ['case_condition'];
        $PVM->battery = $physical ['battery'];
        $PVM->battery_condition = $physical ['battery_condition'];
        $PVM->top_bottom_cover = $physical ['top_bottom_cover'];
        $PVM->terminal_blocks = $physical ['terminal_blocks'];
        $PVM->terminal_blocks_condition = $physical ['terminal_blocks_condition'];
        $PVM->top_bottom_cover = $physical ['top_bottom_cover'];
        $PVM->top_bottom_cover_condition = $physical ['top_bottom_cover_condition'];
        $PVM->short_links = $physical ['short_links'];
        $PVM->short_links_condition = $physical ['short_links_condition'];
        $PVM->sales_order_no = $physical ['sales_order_no'];
        $PVM->created_at = Carbon::now();
        $PVM->updated_at = Carbon::now();


        if ($exists) {
            $PVM->updated_by = Auth::id();
            $PVM->updated_at = Carbon::now();
            $PVM->update();
            $message = 'Receipt Updated Successfully';
        } else {
            $PVM->created_by = Auth::id();
            $PVM->updated_by = Auth::id();
            $PVM->created_at = Carbon::now();
            $PVM->updated_at = Carbon::now();
            $PVM->save();
            $message = 'Receipt Added Successfully';
        }


        return response()->json(['data' => $PVM, 'status' => 'success', $message], 200);
    }
}
