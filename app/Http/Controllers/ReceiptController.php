<?php

namespace App\Http\Controllers;

use App\Models\CustomerMaster;
use App\Models\PhysicalVerificationMaster;
use App\Models\ReceiptMaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerLocationTransaction;
use App\Models\CustomerSiteTransaction;
use App\Models\RMADeliveryAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddReceiptRequest;
use App\Http\Requests\AddPhysicalVerificationRequest;
use App\Models\RMA;
use Carbon\Carbon;
use App\Http\Repositories\MailRepository;

class ReceiptController extends Controller
{

    protected $mailRepository;

      function __construct(MailRepository $mailRepository)
      {
        $this->mailRepository = $mailRepository;
      }

    public function Receipts($cat='all')
    {
        $receipt = ReceiptMaster::selectRaw('receipt.*,ROUND(UNIX_TIMESTAMP(receipt.receipt_date) * 1000 +50000000) as date_unix , receipt.id as receipt_id, rma.id as rma_id, receipt.site as site_name,receipt.site as location, cus.name as customer_name')->leftJoin('ma_customer as cus', 'cus.id', 'receipt.customer_id')/*->leftJoin('ma_site as site', 'site.id', 'receipt.site_id')*/->leftJoin('rma', 'rma.receipt_id', 'receipt.id');
        if ($cat == 'open')
        {
            $receipt = $receipt->where('receipt.status', 1)->orderBy('receipt.id')->get();
        }
        else if ($cat == 'closed')
        {
            $receipt = $receipt->where('receipt.status', 3)->orderBy('receipt.id')->get();
        }
        else if ($cat == 'all')
        {
            $receipt = $receipt->orderBy('receipt.id')->get();
        }
        else if ($cat == 'started') {
            $receipt = $receipt->where('receipt.status', 2)->orderBy('receipt.id')->get();
        }

        return response()->json(['data' => $receipt, 'status' => 'success']);
    }

    public function GetReceipt($id)
    {
        $receipt = ReceiptMaster::with('Customer')->selectRaw('receipt.*, cus.name as customer_name, rma.id as rma_id, receipt.site as site_name, cus.name as customer_name, rma.end_customer as end_customer, rma.date as rma_date')->leftJoin('ma_customer as cus', 'cus.id', 'receipt.customer_id')->where('receipt.id', $id)->leftJoin('rma', 'rma.receipt_id', 'receipt.id')->first();

        $receipt['delivery_info'] = null;
        if(!is_null($receipt->rma_id))
        {
            $receipt['delivery_info'] = RMADeliveryAddress::where('rma_id', $receipt->rma_id)->first();
        }

        return response()->json(['receipt' => $receipt, 'status' => 'success'], 200);
    }

    public function ChangeStatus(Request $request)
    {
        $lists = $request->get('list');
        $status = $request->get('status');
        if ($status == 'open')
        {
            $status = 1;
        }
        else if ($status == 'started')
        {
            $status = 2;
        }
        else if ($status == 'close')
        {
            $status = 3;
        }
        foreach ($lists as $key => $list) {
            ReceiptMaster::where('id', $list)->update(['status' => $status]);
        }
        
        return response()->json(['status' => 'success', 'message' => 'Receipt Closed Successfully']);
    }

    public function AddReceipt(AddReceiptRequest $request)
    {
        $receipt = $request->get('receipt');
        $exists = true;
        $RM = null;
        if (array_key_exists('id', $receipt))
            $RM = ReceiptMaster::where('id', $receipt['id'])->first();

        if (!$RM) {
            $RM = new ReceiptMaster();
            $exists = false;
        }
        $date = Carbon::createFromFormat('d/m/Y', $receipt['receipt_date']);
        $RM->receipt_date = $date->format('Y-m-d');
        $RM->customer_id = $receipt['customer_id'];
        $RM->site = $receipt['site'];
        $RM->courier_name = (array_key_exists('courier_name', $receipt))?$receipt['courier_name']:'';
        $RM->docket_details = (array_key_exists('docket_details', $receipt))?$receipt['docket_details']:'';
        $RM->total_boxes = $receipt['total_boxes'];
        if(isset($receipt['email']) && !is_null($receipt['email']))
            $RM->email = $receipt['email'];

        if ($exists) {
            $RM->updated_by = Auth::id();
            $RM->updated_at = Carbon::now();
            $RM->update();
            $message = 'Receipt Updated Successfully';
        } else {
            $RM->status = 1;
            $RM->created_by = Auth::id();
            $RM->updated_by = Auth::id();
            $RM->created_at = Carbon::now();
            $RM->updated_at = Carbon::now();
            $RM->save();

            $message = 'Receipt Added Successfully';
        }
        $name = CustomerMaster::select('name')->find($RM->customer_id);
        //Creating Empty RMA Entry for print
        $RMA = RMA::where('receipt_id', $RM->id)->first();
        if ($RMA)
        {
            $RMA->customer_address_id = $receipt['customer_id'];
            $RMA->updated_by = Auth::id();
            $RMA->updated_at = Carbon::now();
            $RMA->update();
        }
        else
        {
            $RMA = new RMA();
            $RMA->receipt_id = $RM->id;
            $RMA->customer_address_id = $receipt['customer_id'];
            $RMA->status = 1;
            $RMA->service_type = 1;
            $RMA->created_by = Auth::id();
            $RMA->created_at = Carbon::now();
            $RMA->save();
        }
        $mail_result = 'No Mail Id';
        if(isset($receipt['email']) && !is_null($receipt['email']))
            $mail_result = $this->mailRepository->ReceiptMail($RM); 
        $RM['customer'] = $name->name;

        return response()->json(['data' => $RM, 'status' => 'success', 'message' => $message, 'mail_result' => $mail_result], 200);
    }

    private function GetNextRMANo()
    {
        $num = ReceiptMaster::max('rma_no');
        if ($num == 0)
            $num = config('numberseries.rma_no');
        else
            $num += 1;
        return $num;
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
        $PVM->docket_details = $physical ['docket_details'];
        $PVM->courier_name = $physical ['courier_name'];
        $PVM->rid = 23;
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
