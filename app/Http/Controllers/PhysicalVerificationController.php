<?php

namespace App\Http\Controllers;

use App\Models\PhysicalVerificationMaster;
use App\Models\ReceiptMaster;
use App\Models\ProductMaster;
use App\Models\RMA;
use App\Models\RMSMaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerLocationTransaction;
use App\Models\CustomerSiteTransaction;
use App\Models\PVStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddReceiptRequest;
use App\Http\Requests\AddPhysicalVerificationRequest;
use App\Http\Requests\ChangePVStatusRequest;
use App\Http\Repositories\PVStatusRepositories;
use App\Http\Repositories\PVListingRepository;
use App\Http\Repositories\RMSRepositories;
use Carbon\Carbon;

class PhysicalVerificationController extends Controller
{
	public function PhysicalVerificationList(Request $request)
	{
		$cat = $request->get('cat');
        $pv = array();
		if ($cat == 'withrma')
		{
            $pv = PVListingRepository::WithRma();
		}
		else if ($cat == 'withoutrma')
		{
            $pv = PVListingRepository::WithoutRma();
		}
        else if ($cat == 'withwithoutrma')
        {
            $pv = PVListingRepository::WithAndWithOutRma();
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
        
        else if($cat == 'dispatchapproved')
        {
            $pv = PVListingRepository::DispatchApproved();
        }

        else if($cat == 'dispatched')
        {
            $pv = PVListingRepository::Dispatched();
        }

        else if($cat == 'inrepair')
        {
            $pv = PVListingRepository::InRepair();
        }

        else if ($cat == 'sitecardafterjobticketcompleted')
        {
            $pv = PVListingRepository::SiteCardAfterJobTicketCompleted();
        }

        else if ($cat == 'all')
        {
            $pv = PVListingRepository::All();
        }

		return response()->json(['physicalverification' => $pv , 'status' => 'success'], 200);
	}

    public function ChangePVStatus(ChangePVStatusRequest $request)
    {
        $pvids  = $request->get('pvids');
        $status = $request->get('status');
        foreach ($pvids as $key => $pvid) {
            if ($status == 'withrma')
            {
                PVStatusRepositories::ChangeStatusToRelayWithRMA($pvid);
            }
            else if ($status == 'withoutrma')
            {
                PVStatusRepositories::ChangeStatusToRelayWithOutRMA($pvid);
            }
            else if($status == 'managerapproval')
            {
                PVStatusRepositories::ChangeStatusToManagerApproval($pvid);
            }
            else if ($status == 'customerapproval')
            {
                PVStatusRepositories::ChangeStatusToCustomerApproval($pvid);
            }
            else if ($status == 'managerapproved' || $status == 'jobticketopen')
            {
                PVStatusRepositories::ChangeStatusToManagerApproved($pvid);
            }
            else if($status == 'jobticketstarted')
            {
                PVStatusRepositories::ChangeStatusToJobTicketStarted($pvid);
            }
            else if($status == 'jobticketcompleted' || $status == 'atbopen')
            {
                PVStatusRepositories::ChangeStatusToJobTicketCompleted($pvid);
            }
            else if($status == 'atbstarted')
            {
                PVStatusRepositories::ChangeStatusToAutoTestBenchStarted($pvid);
            }
            else if($status == 'atbcompleted')
            {
                PVStatusRepositories::ChangeStatusToAutoTestBenchCompleted($pvid);
            }
            else if($status == 'agingstarted')
            {
                PVStatusRepositories::ChangeStatusToAgingStarted($pvid);
            }
            else if($status == 'agingcompleted' || $status == 'waitingforverification')
            {
                PVStatusRepositories::ChangeStatusToAgingCompleted($pvid);
            }
            else if($status == 'verificationcompleted' || $status == 'waitingfordispatchapproval')
            {
                PVStatusRepositories::ChangeStatusToVerificationCompleted($pvid);
            }

            else if($status == 'dispatchapproved')
            {
                PVStatusRepositories::ChangeStatusToDispatchApproved($pvid);
            }

            else if($status == 'dispatched')
            {
                PVStatusRepositories::ChangeStatusToDispatchced($pvid);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Status Changed Successfully'], 200);
    }

	public function GetPhysicalVerification($id)
    {
        //$RMA = RMA::where('receipt_id', $physical ['receipt_id'])->first();
        $physicalverification = PhysicalVerificationMaster::selectRaw('physical_verification.* , rma.id as rma_id , cus.name as customer_name , rc.site as location')->leftJoin('receipt as rc' , 'rc.id' , 'physical_verification.receipt_id' )->leftJoin('ma_customer as cus' ,'cus.id' , 'rc.customer_id') ->leftJoin('rma' , 'rma.receipt_id' , 'rc.id')->where('physical_verification.id', $id)->first();

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
    	$physicalverification = PhysicalVerificationMaster::selectRaw('physical_verification.*')->leftJoin('receipt as rc' , 'rc.id' , 'physical_verification.receipt_id' )->where('receipt_id', $receipt_id)->get();
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
    	$message = 'Relay Deleted Successfully';
        return response()->json(['status' => 'success', 'message' => $message], 200);
    }

    public function AddPhysicalVerification(AddPhysicalVerificationRequest $request)
    {
        $pvstatusRepositories = new PVStatusRepositories;
        $physical = $request->get('physicalverification');
        $exists = true;

        if(array_key_exists('id', $physical) && $physical['id']) {
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
        $PVM->screws = $physical['screws'];
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
            //only change status if it is in starting stage
            if(PVStatus::where('pv_id', $PVM->id)->whereIn('current_status_id', [1,2])->first())
            {
                if ($PVM->is_rma_available)
                {
                    $pvstatusRepositories->ChangeStatusToRelayWithRMA($PVM->id);
                }
                else
                {
                    $pvstatusRepositories->ChangeStatusToRelayWithOutRMA($PVM->id);
                }
            }
            $message = 'Relay Updated Successfully';
        } else {
            $PVM->created_by = Auth::id();
            $PVM->updated_by = Auth::id();
            $PVM->created_at = Carbon::now();
            $PVM->updated_at = Carbon::now();
            $PVM->save();
            ReceiptMaster::where('id', $PVM->receipt_id)->update(['status' => 2]);
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
        //entering into RMS table
        //if rms data already exists dont alter else enter into rms table
        $PVExistsInRMS = RMSMaster::where('pv_id', $PVM->id)->first();
        if (!$PVExistsInRMS)
            RMSRepositories::MoveRelayToPhysicalVerificationRack($PVM->id);
        $rma_and_cus = PhysicalVerificationMaster::selectRaw('rma.id as rma_id, cus.name as customer_name')
                        ->leftJoin('receipt as rc', 'rc.id', 'physical_verification.receipt_id')
                        ->leftJoin('rma', 'rma.receipt_id', 'rc.id')
                        ->leftJoin('ma_customer as cus', 'cus.id', 'rc.customer_id')
                        ->where('physical_verification.id', $PVM->id)->first();
        $PVM->rma_id = $rma_and_cus->rma_id;
        $PVM->customer_name = $rma_and_cus->customer_name;
        $PVM->location = $physical ['location'];

        return response()->json(['data' => $PVM, 'status' => 'success', 'message' => $message], 200);
    }

    public function PVWithReceipts($cat)
    {
        $pvs = PhysicalVerificationMaster::selectRaw('physical_verification.id as pv_id,ROUND(UNIX_TIMESTAMP(receipt.receipt_date) * 1000 +50000000) as date_unix, physical_verification.serial_no, pt.part_no, receipt.id as receipt_id, receipt_date, total_boxes, end_customer, receipt.courier_name, receipt.docket_details,receipt.site as location, cus.name as customer_name')
                ->Join('receipt', 'receipt.id', 'physical_verification.receipt_id')->leftJoin('ma_product as pt', 'pt.id', 'physical_verification.product_id')->leftJoin('ma_customer as cus', 'cus.id', 'receipt.customer_id');
        if ($cat == 'open')
            $pvs = $pvs->where('receipt.status', 1);
        if ($cat == 'started')
            $pvs = $pvs->where('receipt.status', 2);
        if ($cat == 'closed')
            $pvs = $pvs->where('receipt.status', 3);

        $pvs = $pvs->orderBy('physical_verification.id')->get();

        return response()->json(['data' => $pvs, 'status' => 'success'], 200);
    }

    public function PVForRmaId($id)
    {
        $pvs = PVListingRepository::PVForRmaId($id);

        return response()->json(['physicalverification' => $pvs, 'status' => 'success'], 200);
    }

    public function CheckSerialNumberExistence($serial_no, $exclude_id)
    {
        $pv = PhysicalVerificationMaster::where('serial_no', $serial_no)->where('id', '!=', $exclude_id)->first();
        if ($pv)
        {
            return response()->json(['status' => 'success', 'message' => 'Serial No Already Exists', 'exists' => true], 200);
        }
        else
        {
            return response()->json(['status' => 'success', 'message' => 'Serial Not Exists', 'exists' => false], 200);
        }
    }
}
