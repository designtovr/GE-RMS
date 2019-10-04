<?php

namespace App\Http\Controllers;

use App\Models\PhysicalVerificationMaster;
use App\Models\ReceiptMaster;
use App\Models\ProductMaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerLocationTransaction;
use App\Models\CustomerSiteTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddReceiptRequest;
use App\Http\Requests\AddPhysicalVerificationRequest;
use App\Http\Repositories\PVStatusRepositories;
use App\Http\Repositories\PVListingRepository;
use Carbon\Carbon;

class PhysicalVerificationController extends Controller
{
	public function PhysicalVerificationList(Request $request)
	{
		$cat = $request->get('cat');
        $pv;
		if ($cat == 'withrma')
		{
            $pv = PVListingRepository::WithRma();
		}
		else if ($cat == 'withoutrma')
		{
            $pv = PVListingRepository::WithoutRma();
		}
        else if($cat == 'managerapproval')
        {
            $pv = PVListingRepository::WaitingForManagerApproval();
        }
        else if ($cat == 'customerapproval')
        {
            $pv = PVListingRepository::WaitingForCustomerApproval();
        }
        else if ($cat == 'managerapproved' || $cat == 'jobticketopen')
        {
            $pv = PVListingRepository::ManagerApproved();
        }
        else if($cat == 'jobticketstarted')
        {
            $pv = PVListingRepository::JobTicketStarted();
        }
        else if($cat == 'jobticketcompleted' || $cat == 'atbopen')
        {
            $pv = PVListingRepository::JobTicketCompleted();
        }
        else if($cat == 'atbstarted')
        {
            $pv = PVListingRepository::AutoTestBenchStarted();
        }
        else if($cat == 'atbcompleted')
        {
            $pv = PVListingRepository::AutoTestBenchCompleted();
        }
        else if($cat == 'agingstarted')
        {
            $pv = PVListingRepository::AgingStarted();
        }
        else if($cat == 'agingcompleted' || $cat == 'waitingforverification')
        {
            $pv = PVListingRepository::AgingCompleted();
        }
        else if($cat == 'verificationcompleted' || $cat == 'waitingfordispatchapproval')
        {
            $pv = PVListingRepository::VerificationCompleted();
        }
        else if($cat == 'dispatched')
        {
            $pv = PVListingRepository::Dispatched();
        }

		return response()->json(['physicalverification' => $pv , 'status' => 'success'], 200);
	}

	public function GetPhysicalVerification($id)
    {

        $physicalverification = PhysicalVerificationMaster::selectRaw('physical_verification.*')->where('id', $id)->get();

        if($physicalverification) {
            return response()->json(['physicalverification' => $physicalverification , 'status' => 'success'], 200);
        }

        else
        {
            return response()->json(['physicalverification' => $physicalverification , 'status' => 'failure'],200);
        }
    }

    public function GetPhysicalVerificationForReceiptId($receipt_id)
    {
    	$physicalverification = PhysicalVerificationMaster::selectRaw('physical_verification.*')->where('receipt_id', $receipt_id)->get();
    	if($physicalverification) {
            return response()->json(['physicalverification' => $physicalverification , 'status' => 'success'], 200);
        }

        else
        {
            return response()->json(['physicalverification' => $physicalverification , 'status' => 'failure'],200);
        }
    }

    public function DeletePV($id)
    {
    	PhysicalVerificationMaster::destroy($id);
    	$message = 'Receipt Deleted Successfully';
        return response()->json(['status' => 'success', 'message' => $message], 200);
    }

    public function AddPhysicalVerification(AddPhysicalVerificationRequest $request)
    {
        $pvstatusRepositories = new PVStatusRepositories;
        $physical = $request->get('physicalverification');
        $exists = true;

        if(array_key_exists('id', $physical)) {
            $PVM = PhysicalVerificationMaster::where('id', $physical['id'])->first();
        }

        else
        {
            $PVM = new PhysicalVerificationMaster();
            $exists = false;
        }

        $PVM->receipt_id = $physical ['receipt_id'];
        $PVM->docket_details = $physical ['docket_details'];
        $PVM->courier_name = $physical ['courier_name'];
        $date = Carbon::createFromFormat('d/m/Y', $physical ['pvdate']);
        $PVM->pvdate = $date->format('Y-m-d');
        $PVM->product_id = $physical['product']['id'];
        $PVM->producttype_id = $physical ['producttype_id'];
        if (array_key_exists('manual_part_no', $physical))
        {
        	$newproduct = new ProductMaster();
        	$newproduct->part_no = $physical['manual_part_no'];
        	$newproduct->type = $physical ['producttype_id'];
        	$newproduct->created_by = Auth::id();
        	$newproduct->updated_by = Auth::id();
        	$newproduct->created_at = Carbon::now();
        	$newproduct->updated_at = Carbon::now();
        	$newproduct->save();

        	$PVM->product_id = $newproduct->id;
        }
        else
        {
        	$PVM->product_id = $physical['product']['id'];
        }
        $PVM->serial_no = $physical ['serial_no'];
        $PVM->comment = (array_key_exists('comment', $physical))?$physical ['comment']:'';
        $PVM->case = $physical ['case'];
        $PVM->case_condition = $physical ['case_condition'];
        $PVM->battery = $physical ['battery'];
        $PVM->battery_condition = $physical ['battery_condition'];
        $PVM->top_bottom_cover = $physical ['top_bottom_cover'];
        $PVM->terminal_blocks = $physical ['terminal_blocks'];
        $PVM->terminal_blocks_condition = (array_key_exists('terminal_blocks_condition', $physical))?$physical ['terminal_blocks_condition']:0;
        $PVM->no_of_terminal_blocks = (array_key_exists('no_of_terminal_blocks', $physical))?$physical['no_of_terminal_blocks']:0;
        $PVM->top_bottom_cover = $physical ['top_bottom_cover'];
        $PVM->top_bottom_cover_condition = $physical ['top_bottom_cover_condition'];
        $PVM->short_links = $physical ['short_links'];
        $PVM->short_links_condition = (array_key_exists('short_links_condition', $physical))?$physical ['short_links_condition']:0;
        $PVM->no_of_short_links = (array_key_exists('no_of_short_links', $physical))?$physical['no_of_short_links']:0;
        $PVM->sales_order_no = (array_key_exists('sales_order_no', $physical))?$physical ['sales_order_no']:'';
        
        if (array_key_exists('is_rma_available', $physical) && $physical['is_rma_available'])
        	$PVM->is_rma_available = 1;
        else
        	$PVM->is_rma_available = 0;

        if ($exists) {
            $PVM->updated_by = Auth::id();
            $PVM->updated_at = Carbon::now();
            $PVM->update();
            if ($PVM->is_rma_available)
            {
                $pvstatusRepositories->ChangeStatusToRelayWithRMA($PVM->id);
            }
            else
            {
                $pvstatusRepositories->ChangeStatusToRelayWithOutRMA($PVM->id);
            }
            $message = 'Relay Updated Successfully';
        } else {
            $PVM->created_by = Auth::id();
            $PVM->updated_by = Auth::id();
            $PVM->created_at = Carbon::now();
            $PVM->updated_at = Carbon::now();
            $PVM->save();
            if ($PVM->is_rma_available)
            {
                $pvstatusRepositories->ChangeStatusToRelayWithRMA($PVM->id);
            }
            else
            {
                $pvstatusRepositories->ChangeStatusToRelayWithOutRMA($PVM->id);
            }
            $message = 'Relay Added Successfully';
        }


        return response()->json(['data' => $PVM, 'status' => 'success', 'message' => $message], 200);
    }
}
