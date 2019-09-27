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

class PhysicalVerificationController extends Controller
{

	public function GetPhysicalVerification($id)
    {

        $physicalverification = PhysicalVerificationMaster::selectRaw('physical_verification.*')->where('receipt_no', $id)->get();

        if($physicalverification) {
            return response()->json(['physicalverification' => $physicalverification , 'status' => 'success'], 200);
        }

        else
        {
            return response()->json(['physicalverification' => $physicalverification , 'status' => 'failure'],200);
        }
    }

    public function AddPhysicalVerification(AddPhysicalVerificationRequest $request)
    {

        $physical = $request->get('physicalverification');
        $exists = true;

        if(array_key_exists('rid', $physical)) {
            $PVM = PhysicalVerificationMaster::where('rid', $physical['rid'])->first();
        }

        else
        {
            $PVM = new PhysicalVerificationMaster();
            $exists = false;
            if (PhysicalVerificationMaster::max('rid') == 0)
	        	$PVM->rid = config('numberseries.rid');
	        else
	        	$PVM->rid = PhysicalVerificationMaster::max('rid') + 1;
        }

        $PVM->receipt_no = $physical ['receipt_no'];
        $PVM->docket_details = $physical ['docket_details'];
        $PVM->courier_name = $physical ['courier_name'];
        $date = Carbon::createFromFormat('d/m/Y', $physical ['pvdate']);
        $PVM->pvdate = $date->format('Y-m-d');
        $PVM->product_id = $physical ['product_id'];
        /*$PVM->product = $physical ['product'];
        $PVM->product_type = $physical ['product_type'];
        $PVM->model_no = $physical['model_no'];*/
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
            $message = 'Relay Updated Successfully';
        } else {
            $PVM->created_by = Auth::id();
            $PVM->updated_by = Auth::id();
            $PVM->created_at = Carbon::now();
            $PVM->updated_at = Carbon::now();
            $PVM->save();
            $message = 'Relay Added Successfully';
        }


        return response()->json(['data' => $PVM, 'status' => 'success', 'message' => $message], 200);
    }
}
