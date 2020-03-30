<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RMA;
use App\Models\RMADeliveryAddress;
use App\Models\RMAInvoiceAddress;
use App\Models\RMAUnitInformation;
use App\Models\RMAUnitSerialNumber;
use App\Models\PhysicalVerificationMaster;
use App\Models\CustomerMaster;
use App\Models\PVStatus;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ADDRMARequest;
use App\Http\Requests\AddRmaUnitRequest;
use App\Http\Requests\AddSCRMARequest;
use App\Http\Repositories\PVStatusRepositories;
use App\Http\Repositories\PVListingRepository;
use Carbon\Carbon;
use App\Http\Repositories\MailRepository;

class RMAController extends Controller
{

    protected $mailRepository;

    function __construct(MailRepository $mailRepository)
    {
        $this->mailRepository = $mailRepository;
    }

	public function GetRMAList($cat = 'all', $type = 'all')
	{
        $rmalist = RMA::selectRaw('rma.*, cus.name as customer_name')->leftJoin('ma_customer as cus', 'cus.id', 'rma.customer_address_id');
        if ($cat == 'open')
        {
            $rmalist = $rmalist->where('status', 1);
        }
        else if ($cat == 'saved')
        {
            $rmalist = $rmalist->where('status', 2);
        }
        else if ($cat == 'completed')
        {
            $rmalist = $rmalist->where('status', 3);
        }

        if ($type == 'physical')
        {
            $rmalist = $rmalist->where('service_type', 1);
        }
        else if ($type == 'sitecard')
        {
            $rmalist = $rmalist->where('service_type', 2);
        }

        $rmalist = $rmalist->get();
		return response()->json(['data' => $rmalist, 'status' => 'success']);
	}

	public function GetRma($id)
	{
		$rma = RMA::selectRaw('rma.*, rma.status as rma_status')->where('rma.id', $id)->first();
		$rma['unit_information'] = RMAUnitInformation::selectRaw('rma_unit_information.*,rma_unit_information.pv_id as id,pv.serial_no, pr.part_no,pt.category')->where('rma_id',$id)->leftJoin('physical_verification as pv', 'pv.id', 'rma_unit_information.pv_id')->leftJoin('ma_product as pr', 'pr.id', 'pv.product_id')->leftJoin('ma_product_type as pt', 'pt.id', 'pr.type')->get();
		$rma['invoice_info'] = RMAInvoiceAddress::where('rma_id', $id)->first();
		$rma['delivery_info'] = RMADeliveryAddress::where('rma_id', $id)->first();
		return response()->json(['data' => $rma, 'status' => 'success']);
	}

	public function GetRMARefNo(Request $request)
	{
		$ref_no = RMA::max('id') + 1;
        return response()->json(['data' => $ref_no, 'status' => 'success']);
	}

    public function AddRmaUnit(AddRmaUnitRequest $request)
    {
        $rma = $request->get('rma');
        $pvs = $request->get('pvs');
        foreach ($pvs as $key => $pv) {
            $RmaUnit = new RMAUnitInformation();
            $RmaUnit->rma_id = $rma['id'];
            $RmaUnit->pv_id = $pv['id'];
            $RmaUnit->sw_version = (array_key_exists('sw_version', $pv))?$pv['sw_version']:'';
            $RmaUnit->service_type = 1;
            $RmaUnit->warrenty = (array_key_exists('warrenty', $pv))?$pv['warrenty']:0;
            $RmaUnit->desc_of_fault = (array_key_exists('desc_of_fault', $pv))?$pv['desc_of_fault']:'';
            $RmaUnit->sales_order_no = (array_key_exists('sales_order_no', $pv))?$pv['sales_order_no']:'';
            $RmaUnit->field_volts_used = (array_key_exists('field_volts_used', $pv))?$pv['field_volts_used']:0;
            $RmaUnit->equip_failed_on_installation = (array_key_exists('equip_failed_on_installation', $pv))?$pv['equip_failed_on_installation']:0;
            $RmaUnit->equip_failed_on_service = (array_key_exists('equip_failed_on_service', $pv))?$pv['equip_failed_on_service']:0;
            $RmaUnit->how_long = (array_key_exists('how_long', $pv))?$pv['how_long']:'';
            $RmaUnit->created_by = Auth::id();
            $RmaUnit->updated_by = Auth::id();
            $RmaUnit->created_at = Carbon::now();
            $RmaUnit->updated_at = Carbon::now();
            $RmaUnit->save();

            $PhysicalVerification = PhysicalVerificationMaster::find($pv['id']);
            $PhysicalVerification->is_rma_available = 1;
            $PhysicalVerification->updated_by = Auth::id();
            $PhysicalVerification->updated_at = Carbon::now();
            $PhysicalVerification->update();

            PVStatusRepositories::ChangeStatusToManagerApproval($pv['id']);
        }

        return response()->json(['status' => 'success', 'message' => 'Relay Added Successfully'], 200);
    }

    public function AddRMA(ADDRMARequest $request)
    {
    	$requestdata = $request->get('rma');
        $pvdata = $request->get('pvs');
        //checking for id not exists and edit is false
        //so the entry is new 
        //we need to get rma id from receipt and update
        if (!array_key_exists('id', $requestdata) && !$requestdata['edit'])
        {
            $pv_to_get_receipt_id = PhysicalVerificationMaster::find($pvdata[0]['id']);
            $RMA = RMA::where('receipt_id', $pv_to_get_receipt_id->receipt_id)->first();
            if (!$RMA)
                return response()->json(['status' => 'failure', 'message' => 'No RMA Found'], 200);
            $RMA->gs_no = (array_key_exists('gs_no', $requestdata))?$requestdata['gs_no']:'';
            $RMA->act_reference = (array_key_exists('act_reference', $requestdata))?$requestdata['act_reference']:'';
            $date = Carbon::createFromFormat('d/m/Y',$requestdata['date']);
            $RMA->date = $date->format('Y-m-d');
            //$RMA->customer_address_id = $requestdata['customer_address_id'];
            $RMA->end_customer = $requestdata['invoice_info']['end_customer'];
            $RMA->status = 3;
            $RMA->created_by = Auth::id();
            $RMA->updated_by = Auth::id();
            $RMA->updated_at = Carbon::now();
            $RMA->update();

            $delivery_info = $requestdata['delivery_info'];
            $RMADelivery = RMADeliveryAddress::where('rma_id', $RMA->id)->first();
            if($RMADelivery)
            {
                $RMADelivery->rma_id = $RMA->id;
                $RMADelivery->name = $delivery_info['name'];
                $RMADelivery->address = $delivery_info['address'];
                $RMADelivery->contact_person = $delivery_info['contact_person'];
                $RMADelivery->tel_no = $delivery_info['tel_no'];
                $RMADelivery->email = $delivery_info['email'];
                $RMADelivery->gst = $delivery_info['gst'];
                $RMADelivery->updated_by = Auth::id();
                $RMADelivery->updated_at = Carbon::now();
                $RMADelivery->update();
            }
            else
            {
                $RMADelivery = new RMADeliveryAddress();
                $RMADelivery->rma_id = $RMA->id;
                $RMADelivery->name = $delivery_info['name'];
                $RMADelivery->address = $delivery_info['address'];
                $RMADelivery->contact_person = $delivery_info['contact_person'];
                $RMADelivery->tel_no = $delivery_info['tel_no'];
                $RMADelivery->email = $delivery_info['email'];
                $RMADelivery->gst = $delivery_info['gst'];
                $RMADelivery->created_by = Auth::id();
                $RMADelivery->save();
            }

            $invoice_info = $requestdata['invoice_info'];
            $RMAInvoice = RMAInvoiceAddress::where('rma_id', $RMA->id)->first();
            if ($RMAInvoice)
            {
                $RMAInvoice->rma_id = $RMA->id;
                $RMAInvoice->name = $invoice_info['name'];
                $RMAInvoice->address = $invoice_info['address'];
                $RMAInvoice->contact_person = $invoice_info['contact_person'];
                $RMAInvoice->tel_no = $invoice_info['tel_no'];
                $RMAInvoice->email = $invoice_info['email'];
                $RMAInvoice->gst = $invoice_info['gst'];
                $RMAInvoice->updated_by = Auth::id();
                $RMAInvoice->updated_at = Carbon::now();
                $RMAInvoice->update();
            }
            else
            {
                $RMAInvoice = new RMAInvoiceAddress();
                $RMAInvoice->rma_id = $RMA->id;
                $RMAInvoice->name = $invoice_info['name'];
                $RMAInvoice->address = $invoice_info['address'];
                $RMAInvoice->contact_person = $invoice_info['contact_person'];
                $RMAInvoice->tel_no = $invoice_info['tel_no'];
                $RMAInvoice->email = $invoice_info['email'];
                $RMAInvoice->gst = $invoice_info['gst'];
                $RMAInvoice->created_by = Auth::id();
                $RMAInvoice->save();
            }

            foreach ($pvdata as $key => $unit) {
                $RMAUnitInformation = new RMAUnitInformation();
                $RMAUnitInformation->rma_id = $RMA->id;
                $RMAUnitInformation->pv_id = $unit['id'];
                $RMAUnitInformation->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
                $RMAUnitInformation->service_type = (array_key_exists('service_type', $unit) && !is_null($unit['service_type']))?$unit['service_type']:1;
                //$RMAUnitInformation->warrenty = $unit['warrenty'];
                $RMAUnitInformation->desc_of_fault = (array_key_exists('desc_of_fault', $unit))?$unit['desc_of_fault']:'';
                $RMAUnitInformation->sales_order_no = (array_key_exists('wbs', $unit))?$unit['wbs']:'';
                $RMAUnitInformation->field_volts_used = $unit['field_volts_used'];
                $RMAUnitInformation->equip_failed_on_installation = $unit['equip_failed_on_installation'];
                $RMAUnitInformation->equip_failed_on_service = $unit['equip_failed_on_service'];
                $RMAUnitInformation->how_long = (array_key_exists('how_long', $unit))?$unit['how_long']:'';
                $RMAUnitInformation->created_by = Auth::id();
                $RMAUnitInformation->updated_by = Auth::id();
                $RMAUnitInformation->updated_at = Carbon::now();
                $RMAUnitInformation->save();

                $PV = PhysicalVerificationMaster::selectRaw('physical_verification.*, pt.category')->where('physical_verification.id', $RMAUnitInformation->pv_id)->join('ma_product_type as pt', 'pt.id', 'physical_verification.producttype_id')->first();
                $PV->is_rma_available = 1;
                $PV->update();

                if(strcasecmp($PV->category, 'BOJ') == 0)
                {
                    PVStatusRepositories::ChangeStatusToManagerApproved($RMAUnitInformation->pv_id);
                }
                else
                {
                    PVStatusRepositories::ChangeStatusToManagerApproval($RMAUnitInformation->pv_id);
                }
            }

            //Sending mail
            $mail_result = '';
            if($RMA->service_type == 1)
                $mail_result = $this->mailRepository->PhysicalVerificationCompletion($RMA, $delivery_info['cc']);
            else if($RMA->service_type == 2)
                $mail_result = $this->mailRepository->SCPhysicalVerificationCompletion($RMA, $delivery_info['cc']);

            return response()->json(['data' => $RMA, 'status' => 'success', 'message' => 'RMA Updated Successfully', 'mail_result' => $mail_result], 200);
        }
        else
        {
            $RMA = RMA::where('id', $requestdata['id'])->first();
            $RMA->gs_no = (array_key_exists('gs_no', $requestdata))?$requestdata['gs_no']:'';
            if (array_key_exists('act_reference', $requestdata))
                $RMA->act_reference = $requestdata['act_reference'];
            /*$date = Carbon::createFromFormat('d/m/Y',$requestdata['date']);
            $RMA->date = $date->format('Y-m-d');*/
            $RMA->customer_address_id = $requestdata['customer_address_id'];
            $RMA->end_customer = $requestdata['invoice_info']['end_customer'];
            $RMA->status = 3;
            $RMA->created_by = Auth::id();
            $RMA->updated_by = Auth::id();
            $RMA->updated_at = Carbon::now();
            $RMA->save();

            $delivery_info = $requestdata['delivery_info'];
            $RMADelivery = RMADeliveryAddress::where('rma_id', $requestdata['id'])->first();
            $dexists = true;
            if (!$RMADelivery)
            {
                $RMADelivery = new RMADeliveryAddress();
                $RMADelivery->rma_id = $RMA->id;
                $RMADelivery->created_by = Auth::id();
                $dexists = false;
            }
            if (array_key_exists('address', $delivery_info))
                $RMADelivery->address = $delivery_info['address'];
            if (array_key_exists('contact_person', $delivery_info))
                $RMADelivery->contact_person = $delivery_info['contact_person'];
            if (array_key_exists('tel_no', $delivery_info))
                $RMADelivery->tel_no = $delivery_info['tel_no'];
            if (array_key_exists('email', $delivery_info))
                $RMADelivery->email = $delivery_info['email'];
            if (array_key_exists('gst', $delivery_info))
                $RMADelivery->gst = $delivery_info['gst'];
            if (array_key_exists('name', $delivery_info))
                $RMADelivery->name = $delivery_info['name'];
            $RMADelivery->updated_by = Auth::id();
            $RMADelivery->updated_at = Carbon::now();
            if ($dexists)                
                $RMADelivery->update();
            else
                $RMADelivery->save();

            $invoice_info = $requestdata['invoice_info'];
            $RMAInvoice = RMAInvoiceAddress::where('rma_id', $requestdata['id'])->first();
            if($RMAInvoice)
            {
                if (array_key_exists('address', $invoice_info))
                    $RMAInvoice->address = $invoice_info['address'];
                if (array_key_exists('contact_person', $invoice_info))
                    $RMAInvoice->contact_person = $invoice_info['contact_person'];
                if (array_key_exists('tel_no', $invoice_info))
                    $RMAInvoice->tel_no = $invoice_info['tel_no'];
                if (array_key_exists('email', $invoice_info))
                    $RMAInvoice->email = $invoice_info['email'];
                if (array_key_exists('gst', $invoice_info))
                    $RMAInvoice->gst = $invoice_info['gst'];
                if (array_key_exists('name', $invoice_info))
                    $RMAInvoice->name = $invoice_info['name'];

                $RMAInvoice->updated_by = Auth::id();
                $RMAInvoice->updated_at = Carbon::now();
                $RMAInvoice->update();
            }
            else
            {
                $RMAInvoice = new RMAInvoiceAddress();
                $RMAInvoice->address = $invoice_info['address'];
                $RMAInvoice->contact_person = $invoice_info['contact_person'];
                $RMAInvoice->tel_no = $invoice_info['tel_no'];
                $RMAInvoice->email = $invoice_info['email'];
                $RMAInvoice->gst = $invoice_info['gst'];
                $RMAInvoice->name = $invoice_info['name'];

                $RMAInvoice->created_by = Auth::id();
                $RMAInvoice->created_at = Carbon::now();
                $RMAInvoice->save();
            }

            foreach ($pvdata as $key => $unit) {
                $RMAUnitInformation = RMAUnitInformation::where('pv_id', $unit['id'])->where('rma_id', $unit['rma_id'])->first();
                if ($RMAUnitInformation)
                {
                    if (array_key_exists('sw_version', $unit))
                        $RMAUnitInformation->sw_version = $unit['sw_version'];
                    if (array_key_exists('service_type', $unit) && !is_null($unit['service_type']))
                        $RMAUnitInformation->service_type = $unit['service_type'];
                    if (array_key_exists('desc_of_fault', $unit))
                        $RMAUnitInformation->desc_of_fault = $unit['desc_of_fault'];
                    if (array_key_exists('sales_order_no', $unit))
                        $RMAUnitInformation->sales_order_no = $unit['sales_order_no'];
                    if (array_key_exists('field_volts_used', $unit))
                        $RMAUnitInformation->field_volts_used = $unit['field_volts_used'];
                    if (array_key_exists('equip_failed_on_installation', $unit))
                        $RMAUnitInformation->equip_failed_on_installation = $unit['equip_failed_on_installation'];
                    if (array_key_exists('equip_failed_on_service', $unit))
                        $RMAUnitInformation->equip_failed_on_service = $unit['equip_failed_on_service'];
                    if (array_key_exists('how_long', $unit))
                        $RMAUnitInformation->how_long = $unit['how_long'];
                    $RMAUnitInformation->updated_by = Auth::id();
                    $RMAUnitInformation->updated_at = Carbon::now();
                    $RMAUnitInformation->update();

                    $PV = PhysicalVerificationMaster::where('id', $RMAUnitInformation->pv_id)->first();
                    $PV->is_rma_available = 1;
                    $PV->update();
                }
                else
                {
                    $RMAUnitInformation = new RMAUnitInformation();
                    $RMAUnitInformation->rma_id = $RMA->id();
                    $RMAUnitInformation->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
                    $RMAUnitInformation->service_type = (array_key_exists('service_type', $unit) && !is_null($unit['service_type']))?$unit['service_type']:1;
                    //$RMAUnitInformation->warrenty = $unit['warrenty'];
                    $RMAUnitInformation->desc_of_fault = (array_key_exists('desc_of_fault', $unit))?$unit['desc_of_fault']:'';
                    $RMAUnitInformation->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
                    $RMAUnitInformation->field_volts_used = $unit['field_volts_used'];
                    $RMAUnitInformation->equip_failed_on_installation = $unit['equip_failed_on_installation'];
                    $RMAUnitInformation->equip_failed_on_service = $unit['equip_failed_on_service'];
                    $RMAUnitInformation->how_long = (array_key_exists('how_long', $unit))?$unit['how_long']:'';
                    $RMAUnitInformation->updated_by = Auth::id();
                    $RMAUnitInformation->updated_at = Carbon::now();
                    $RMAUnitInformation->save();

                    $PV = PhysicalVerificationMaster::where('id', $RMAUnitInformation->pv_id)->first();
                    $PV->is_rma_available = 1;
                    $PV->update();
                }
                $need_to_update = PVStatus::where('pv_id', $RMAUnitInformation->pv_id)->where('current_status_id', 15)->first();
                if($need_to_update)
                {
                    $pv = PhysicalVerificationMaster::selectRaw('physical_verification.*, pt.category')->join('ma_product_type as pt', 'pt.id', 'physical_verification.producttype_id')->where('physical_verification.id', $RMAUnitInformation->pv_id)->first();

                    if(strcasecmp($pv->category, 'BOJ') == 0)
                    {
                        PVStatusRepositories::ChangeStatusToManagerApproved($RMAUnitInformation->pv_id);
                    }
                    else
                    {
                        PVStatusRepositories::ChangeStatusToManagerApproval($RMAUnitInformation->pv_id);
                    }

                }
            }

            //Sending mail
            $mail_result = '';
            if($RMA->service_type == 1)
                $mail_result = $this->mailRepository->PhysicalVerificationCompletion($RMA, $delivery_info['cc']);
            else if($RMA->service_type == 2)
                $mail_result = $this->mailRepository->SCPhysicalVerificationCompletion($RMA, $delivery_info['cc']);

            return response()->json(['data' => $RMA, 'status' => 'success', 'message' => 'RMA Updated Successfully', 'mail_result' => $mail_result], 200);
        }
    	
    }

    public function SaveRMA(Request $request)
    {
        $rmadata = $request->get('rma');
        $pvdata = $request->get('pvs');
        if (!array_key_exists('id', $rmadata))
        {
            $pv_to_get_receipt_id = PhysicalVerificationMaster::find($pvdata[0]['id']);
            $RMA = RMA::where('receipt_id', $pv_to_get_receipt_id->receipt_id)->first();
            if (!$RMA)
                return response()->json(['status' => 'failure', 'message' => 'No RMA Found'], 200);
            $RMA->gs_no = (array_key_exists('gs_no', $rmadata))?$rmadata['gs_no']:'';
            $RMA->act_reference = (array_key_exists('act_reference', $rmadata))?$rmadata['act_reference']:'';
            if (!array_key_exists('date', $rmadata))
            {
                $RMA->date = Carbon::today()->format('Y-m-d');
            }
            else
            {
               $date = Carbon::createFromFormat('d/m/Y',$rmadata['date']);
                $RMA->date = $date->format('Y-m-d'); 
            }
            if (isset($rmadata['invoice_info']['end_customer']))
                $RMA->end_customer = $rmadata['invoice_info']['end_customer'];
            else
                $RMA->end_customer = '';
            $RMA->status = 2;
            $RMA->created_by = Auth::id();
            $RMA->updated_by = Auth::id();
            $RMA->updated_at = Carbon::now();
            $RMA->save();

            if (isset($rmadata['delivery_info']))
            {
                $delivery_info = $rmadata['delivery_info'];
                $RMAD = RMADeliveryAddress::where('rma_id', $RMA->id)->first();
                if ($RMAD)
                {
                    $RMAD->rma_id = $RMA->id;
                    if(array_key_exists('name', $delivery_info) && !is_null($delivery_info['name']))
                        $RMAD->name = $delivery_info['name'];
                    if(array_key_exists('address', $delivery_info) && !is_null($delivery_info['address']))
                        $RMAD->address = $delivery_info['address'];
                    if(array_key_exists('contact_person', $delivery_info) && !is_null($delivery_info['contact_person']))
                        $RMAD->contact_person = $delivery_info['contact_person'];
                    if(array_key_exists('tel_no', $delivery_info) && !is_null($delivery_info['tel_no']))
                        $RMAD->tel_no = $delivery_info['tel_no'];
                    if(array_key_exists('email', $delivery_info) && !is_null($delivery_info['email']))
                        $RMAD->email = $delivery_info['email'];
                    if(array_key_exists('gst', $delivery_info) && !is_null($delivery_info['gst']))
                        $RMAD->gst = $delivery_info['gst'];
                    $RMAD->updated_by = Auth::id();
                    $RMAD->updated_at = Carbon::now();
                    $RMAD->update();
                }
                else
                {
                    $RMAD = new RMADeliveryAddress();
                    $RMAD->rma_id = $RMA->id;
                    $RMAD->name = (array_key_exists('name', $delivery_info))?$delivery_info['name']:'';
                    $RMAD->address = (array_key_exists('address', $delivery_info))?$delivery_info['address']:'';
                    $RMAD->contact_person = (array_key_exists('contact_person', $delivery_info))?$delivery_info['contact_person']:'';
                    $RMAD->tel_no = (array_key_exists('tel_no', $delivery_info))?$delivery_info['tel_no']:'';
                    $RMAD->email = (array_key_exists('email', $delivery_info))?$delivery_info['email']:'';
                    $RMAD->gst = (array_key_exists('gst', $delivery_info))?$delivery_info['gst']:'';
                    $RMAD->created_by = Auth::id();
                    $RMAD->updated_by = Auth::id();
                    $RMAD->created_at = Carbon::now();
                    $RMAD->updated_at = Carbon::now();
                    $RMAD->save();
                }
            }

            if (isset($rmadata['invoice_info']))
            {
                $invoice_info = $rmadata['invoice_info'];
                $RMAI = RMAInvoiceAddress::where('rma_id', $RMA->id)->first();
                if($RMAI)
                {
                    $RMAI->rma_id = $RMA->id;
                    if(array_key_exists('name', $invoice_info))
                        $RMAI->name = $invoice_info['name'];
                    if(array_key_exists('address', $invoice_info))
                        $RMAI->address = $invoice_info['address'];
                    if(array_key_exists('contact_person', $invoice_info))
                        $RMAI->contact_person = $invoice_info['contact_person'];
                    if(array_key_exists('tel_no', $invoice_info))
                        $RMAI->tel_no = $invoice_info['tel_no'];
                    if(array_key_exists('email', $invoice_info))
                        $RMAI->email = $invoice_info['email'];
                    if(array_key_exists('gst', $invoice_info))
                        $RMAI->gst = $invoice_info['gst'];
                    $RMAI->created_by = Auth::id();
                    $RMAI->created_at = Carbon::now();
                    $RMAI->update();
                }
                else
                {
                    $RMAI = new RMAInvoiceAddress();
                    $RMAI->rma_id = $RMA->id;
                    $RMAI->name = (array_key_exists('name', $invoice_info))?$invoice_info['name']:'';
                    $RMAI->address = (array_key_exists('address', $invoice_info))?$invoice_info['address']:'';
                    $RMAI->contact_person = (array_key_exists('contact_person', $invoice_info))?$invoice_info['contact_person']:'';
                    $RMAI->tel_no = (array_key_exists('tel_no', $invoice_info))?$invoice_info['tel_no']:'';
                    $RMAI->email = (array_key_exists('email', $invoice_info))?$invoice_info['email']:'';
                    $RMAI->gst = (array_key_exists('gst', $invoice_info))?$invoice_info['gst']:'';
                    $RMAI->created_by = Auth::id();
                    $RMAI->updated_by = Auth::id();
                    $RMAI->created_at = Carbon::now();
                    $RMAI->updated_at = Carbon::now();
                    $RMAI->save();
                }
            }

            foreach ($pvdata as $key => $unit) {
                $RMAUnitInformation = new RMAUnitInformation();
                $RMAUnitInformation->rma_id = $RMA->id;
                $RMAUnitInformation->pv_id = $unit['id'];
                $RMAUnitInformation->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
                $RMAUnitInformation->service_type = (array_key_exists('service_type', $unit) && !is_null($unit['service_type']))?$unit['service_type']:1;
                $RMAUnitInformation->desc_of_fault = (array_key_exists('desc_of_fault', $unit))?$unit['desc_of_fault']:'';
                $RMAUnitInformation->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
                $RMAUnitInformation->field_volts_used = (array_key_exists('field_volts_used', $unit))?$unit['field_volts_used']:-1;
                $RMAUnitInformation->equip_failed_on_installation = (array_key_exists('equip_failed_on_installation', $unit))?$unit['equip_failed_on_installation']:-1;
                $RMAUnitInformation->equip_failed_on_service = (array_key_exists('equip_failed_on_service', $unit))?$unit['equip_failed_on_service']:-1;
                $RMAUnitInformation->how_long = (array_key_exists('how_long', $unit))?$unit['how_long']:'';
                $RMAUnitInformation->created_by = Auth::id();
                $RMAUnitInformation->updated_by = Auth::id();
                $RMAUnitInformation->updated_at = Carbon::now();
                $RMAUnitInformation->save();

                $PV = PhysicalVerificationMaster::where('id', $RMAUnitInformation->pv_id)->first();
                $PV->is_rma_available = 1;
                $PV->update();

                PVStatusRepositories::ChangeStatusToSaved($RMAUnitInformation->pv_id);
            }

            return response()->json(['data' => $RMA, 'status' => 'success', 'message' => 'RMA Saved Successfully'], 200);
        }
        else
        {
            $RMA = RMA::where('id', $rmadata['id'])->first();
            $RMA->gs_no = (array_key_exists('gs_no', $rmadata))?$rmadata['gs_no']:'';
            $RMA->act_reference = (array_key_exists('act_reference', $rmadata))?$rmadata['act_reference']:'';
            if (!array_key_exists('date', $rmadata))
            {
                $RMA->date = Carbon::today()->format('Y-m-d');
            }
            else
            {
               $date = Carbon::createFromFormat('d/m/Y',$rmadata['date']);
                $RMA->date = $date->format('Y-m-d'); 
            }
            $RMA->customer_address_id = (array_key_exists('customer_address_id', $rmadata))?$rmadata['customer_address_id']:0;
            if (isset($rmadata['invoice_info']['end_customer']))
                $RMA->end_customer = $rmadata['invoice_info']['end_customer'];
            else
                $RMA->end_customer = '';
            $RMA->status = 2;
            $RMA->updated_by = Auth::id();
            $RMA->updated_at = Carbon::now();
            $RMA->update();

            $RMAD = RMADeliveryAddress::where('rma_id', $rmadata['id'])->first();
            if ($RMAD)
            {
                $delivery_info = $rmadata['delivery_info'];
                if (array_key_exists('name', $delivery_info))
                    $RMAD->name = $delivery_info['name'];
                if (array_key_exists('address', $delivery_info))
                    $RMAD->address = $delivery_info['address'];
                if (array_key_exists('contact_person', $delivery_info))
                    $RMAD->contact_person = $delivery_info['contact_person'];
                if (array_key_exists('tel_no', $delivery_info))
                    $RMAD->tel_no = $delivery_info['tel_no'];
                if (array_key_exists('email', $delivery_info))
                    $RMAD->email = $delivery_info['email'];
                if (array_key_exists('gst', $delivery_info))
                    $RMAD->gst = $delivery_info['gst'];
                $RMAD->updated_by = Auth::id();
                $RMAD->updated_at = Carbon::now();
                $RMAD->update();
            }
            else
            {
                if (isset($rmadata['delivery_info']))
                {
                    $delivery_info = $rmadata['delivery_info'];
                    $RMAD = new RMADeliveryAddress();
                    $RMAD->rma_id = $rmadata['id'];
                    $RMAD->name = (array_key_exists('name', $delivery_info))?$delivery_info['name']:'';
                    $RMAD->address = (array_key_exists('address', $delivery_info))?$delivery_info['address']:'';
                    $RMAD->contact_person = (array_key_exists('contact_person', $delivery_info))?$delivery_info['contact_person']:'';
                    $RMAD->tel_no = (array_key_exists('tel_no', $delivery_info))?$delivery_info['tel_no']:'';
                    $RMAD->email = (array_key_exists('email', $delivery_info))?$delivery_info['email']:'';
                    $RMAD->gst = (array_key_exists('gst', $delivery_info))?$delivery_info['gst']:'';
                    $RMAD->created_by = Auth::id();
                    $RMAD->updated_by = Auth::id();
                    $RMAD->created_at = Carbon::now();
                    $RMAD->updated_at = Carbon::now();
                    $RMAD->save();
                }
            }

            $RMAI = RMAInvoiceAddress::where('rma_id', $rmadata['id'])->first();
            if ($RMAI)
            {
                $invoice_info = $rmadata['invoice_info'];
                if (array_key_exists('name', $invoice_info))
                    $RMAI->name = $invoice_info['name'];
                if (array_key_exists('address', $invoice_info))
                    $RMAI->address = $invoice_info['address'];
                if (array_key_exists('contact_person', $invoice_info))
                    $RMAI->contact_person = $invoice_info['contact_person'];
                if (array_key_exists('tel_no', $invoice_info))
                    $RMAI->tel_no = $invoice_info['tel_no'];
                if (array_key_exists('email', $invoice_info))
                    $RMAI->email = $invoice_info['email'];
                if (array_key_exists('gst', $invoice_info))
                    $RMAI->gst = $invoice_info['gst'];
                $RMAI->updated_by = Auth::id();
                $RMAI->updated_at = Carbon::now();
                $RMAI->update();
            }
            else
            {
                if (isset($rmadata['invoice_info']))
                {
                    $invoice_info = $rmadata['invoice_info'];
                    $RMAI = new RMAInvoiceAddress();
                    $RMAI->rma_id = $rmadata['id'];
                    $RMAI->tel_no = (array_key_exists('tel_no', $invoice_info))?$invoice_info['tel_no']:'';
                    $RMAI->name = (array_key_exists('name', $invoice_info))?$invoice_info['name']:'';
                    $RMAI->address = (array_key_exists('address', $invoice_info))?$invoice_info['address']:'';
                    $RMAI->contact_person = (array_key_exists('contact_person', $invoice_info))?$invoice_info['contact_person']:'';
                    $RMAI->tel_no = (array_key_exists('tel_no', $invoice_info))?$invoice_info['tel_no']:'';
                    $RMAI->email = (array_key_exists('email', $invoice_info))?$invoice_info['email']:'';
                    $RMAI->gst = (array_key_exists('gst', $invoice_info))?$invoice_info['gst']:'';
                    $RMAI->created_by = Auth::id();
                    $RMAI->updated_by = Auth::id();
                    $RMAI->created_at = Carbon::now();
                    $RMAI->updated_at = Carbon::now();
                    $RMAI->save();
                }
            }

            foreach ($pvdata as $key => $unit) {
                $RMAUnitInformation = RMAUnitInformation::where('pv_id', $unit['id'])->where('rma_id', $unit['rma_id'])->first();
                $RMAUnitInformation->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
                $RMAUnitInformation->service_type = (array_key_exists('service_type', $unit) && !is_null($unit['service_type']))?$unit['service_type']:1;
                //$RMAUnitInformation->warrenty = (array_key_exists('warrenty', $unit))?$unit['warrenty']:-1;
                $RMAUnitInformation->desc_of_fault = (array_key_exists('desc_of_fault', $unit))?$unit['desc_of_fault']:'';
                $RMAUnitInformation->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
                $RMAUnitInformation->field_volts_used = (array_key_exists('field_volts_used', $unit))?$unit['field_volts_used']:-1;
                $RMAUnitInformation->equip_failed_on_installation = (array_key_exists('equip_failed_on_installation', $unit))?$unit['equip_failed_on_installation']:-1;
                $RMAUnitInformation->equip_failed_on_service = (array_key_exists('equip_failed_on_service', $unit))?$unit['equip_failed_on_service']:-1;
                $RMAUnitInformation->how_long = (array_key_exists('how_long', $unit))?$unit['how_long']:'';
                $RMAUnitInformation->created_by = Auth::id();
                $RMAUnitInformation->updated_by = Auth::id();
                $RMAUnitInformation->updated_at = Carbon::now();
                $RMAUnitInformation->update();

                $PV = PhysicalVerificationMaster::where('id', $RMAUnitInformation->pv_id)->first();
                $PV->is_rma_available = 1;
                $PV->update();

                PVStatusRepositories::ChangeStatusToSaved($RMAUnitInformation->pv_id);
            }

            return response()->json(['data' => $RMA, 'status' => 'success', 'message' => 'RMA Updated Successfully'], 200);
        }
    }

    public function AddSCRMA(AddSCRMARequest $request)
    {
        $rma = $request->get('rma');
        //Saving RMA
        $RMAT = new RMA();
        $RMAT->gs_no = (array_key_exists('gs_no', $rma))?$rma['gs_no']:'';
        $RMAT->act_reference = (array_key_exists('act_reference', $rma))?$rma['act_reference']:'';
        $date = Carbon::createFromFormat('d/m/Y',$rma['date']);
        $RMAT->date = $date->format('Y-m-d');
        $RMAT->end_customer = $rma['end_customer'];
        $RMAT->status = 3;
        $RMAT->service_type = 2;
        $RMAT->created_by = Auth::id();
        $RMAT->created_at = Carbon::now();
        $RMAT->updated_by = Auth::id();
        $RMAT->updated_at = Carbon::now();
        $RMAT->save();

        $delivery_info = $rma['delivery_info'];
        $RMADT = new RMADeliveryAddress();
        $RMADT->rma_id = $RMAT->id;
        $RMADT->name = $delivery_info['name'];
        $RMADT->address = $delivery_info['address'];
        $RMADT->contact_person = $delivery_info['contact_person'];
        $RMADT->tel_no = $delivery_info['tel_no'];
        $RMADT->email = $delivery_info['email'];
        $RMADT->gst = $delivery_info['gst'];
        $RMADT->created_by = Auth::id();
        $RMADT->created_at = Carbon::now();
        $RMADT->updated_by = Auth::id();
        $RMADT->updated_at = Carbon::now();
        $RMADT->save();

        $invoice_info = $rma['invoice_info'];
        $RMAIT = new RMAInvoiceAddress();
        $RMAIT->rma_id = $RMAT->id;
        $RMAIT->name = $invoice_info['name'];
        $RMAIT->address = $invoice_info['address'];
        $RMAIT->contact_person = $invoice_info['contact_person'];
        $RMAIT->tel_no = $invoice_info['tel_no'];
        $RMAIT->email = $invoice_info['email'];
        $RMAIT->gst = $invoice_info['gst'];
        $RMAIT->created_by = Auth::id();
        $RMAIT->created_at = Carbon::now();
        $RMAIT->updated_by = Auth::id();
        $RMAIT->updated_at = Carbon::now();
        $RMAIT->save();

        //Save PV
        foreach ($rma['unit_information'] as $key => $unit) {
            $PVT = new PhysicalVerificationMaster();
            $PVT->receipt_id = -1;
            $PVT->docket_details = '';
            $PVT->courier_name = '';
            $PVT->pvdate = $RMAT->date;
            $PVT->producttype_id = $unit['producttype_id'];
            $PVT->product_id = $unit['product_id'];
            $PVT->serial_no  = $unit['serial_no'];
            $PVT->is_rma_available = 1;
            $PVT->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
            $PVT->created_by = Auth::id();
            $PVT->created_at = Carbon::now();
            $PVT->updated_by = Auth::id();
            $PVT->updated_at = Carbon::now();
            $PVT->save();

            $RMAUT = new RMAUnitInformation();
            $RMAUT->rma_id = $RMAT->id;
            $RMAUT->pv_id = $PVT->id;
            $RMAUT->service_type = 2;
            $RMAUT->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
            //$RMAUT->warrenty = (array_key_exists('warrenty', $unit))?$unit['warrenty']:0;
            $RMAUT->desc_of_fault = (array_key_exists('desc_of_fault', $unit))?$unit['desc_of_fault']:'';
            $RMAUT->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
            $RMAUT->field_volts_used = (array_key_exists('field_volts_used', $unit))?$unit['field_volts_used']:0;
            $RMAUT->equip_failed_on_installation = (array_key_exists('equip_failed_on_installation', $unit))?$unit['equip_failed_on_installation']:0;
            $RMAUT->equip_failed_on_service = (array_key_exists('equip_failed_on_service', $unit))?$unit['equip_failed_on_service']:0;
            $RMAUT->how_long = (array_key_exists('how_long', $unit))?$unit['how_long']:'';
            $RMAUT->created_by = Auth::id();
            $RMAUT->created_at = Carbon::now();
            $RMAUT->updated_by = Auth::id();
            $RMAUT->updated_at = Carbon::now();
            $RMAUT->save();

            $PV = PhysicalVerificationMaster::selectRaw('physical_verification.*, pt.category')->join('ma_product_type as pt', 'pt.id', 'physical_verification.producttype_id')->where('physical_verification.id', $RMAUT->pv_id)->first();

            if(strcasecmp($PV->category, 'BOJ') == 0)
            {
                PVStatusRepositories::ChangeStatusToManagerApproved($RMAUT->pv_id);
            }
            else
            {
                PVStatusRepositories::ChangeStatusToManagerApproval($RMAUT->pv_id);
            }
        }

        $mail_result = $this->mailRepository->SCPhysicalVerificationCompletion($RMAT, $delivery_info['cc']);

        return response()->json(['data' => $RMAT, 'status' => 'success', 'message' => 'RMA Created Successfully', 'mail_result' => $mail_result], 200);
    }

    public function SaveSiteCardRMA(Request $request)
    {
        $sitecardrma = $request->get('sitecardrma');
        //if id exists update else save
        if (array_key_exists('id', $sitecardrma))
        {
            //update all rma table field
            $RMA = RMA::find($sitecardrma['id']);
            if (array_key_exists('gs_no', $sitecardrma))
                $RMA->gs_no = $sitecardrma['gs_no'];
            if (array_key_exists('act_reference', $sitecardrma))
                $RMA->act_reference = $sitecardrma['act_reference'];
            if (array_key_exists('date', $sitecardrma))
            {
                $date = Carbon::createFromFormat('d/m/Y',$sitecardrma['date']);
                $RMA->date = $date->format('Y-m-d');
            }
            else
            {
                $RMA->date = '';
            }
            if (array_key_exists('customer_address_id', $sitecardrma))
                $RMA->customer_address_id = $sitecardrma['customer_address_id'];
            if (array_key_exists('end_customer', $sitecardrma['invoice_info']))
                $RMA->end_customer = $sitecardrma['invoice_info']['end_customer'];
            $RMA->updated_by = Auth::id();
            $RMA->updated_at = Carbon::now();
            $RMA->update();

            //we have already created delivery detais in first save
            //so directly update using id
            $delivery_info = $sitecardrma['delivery_info'];
            $RMADT = RMADeliveryAddress::where('rma_id', $sitecardrma['id'])->first();
            if (array_key_exists('name', $delivery_info))
                $RMADT->name = $delivery_info['name'];
            if (array_key_exists('address', $delivery_info))
                $RMADT->address = $delivery_info['address'];
            if (array_key_exists('contact_person', $delivery_info))
                $RMADT->contact_person = $delivery_info['contact_person'];
            if (array_key_exists('tel_no', $delivery_info))
                $RMADT->tel_no = $delivery_info['tel_no'];
            if (array_key_exists('email', $delivery_info))
                $RMADT->email = $delivery_info['email'];
            if (array_key_exists('gst', $delivery_info))
                $RMADT->gst = $delivery_info['gst'];
            $RMADT->updated_by = Auth::id();
            $RMADT->updated_at = Carbon::now();
            $RMADT->update();

            //same as delivery_info
            $invoice_info = $sitecardrma['invoice_info'];
            $RMAIT = RMAInvoiceAddress::where('rma_id', $sitecardrma['id'])->first();
            if (array_key_exists('name', $invoice_info))
                $RMAIT->name = $invoice_info['name'];
            if (array_key_exists('address', $invoice_info))
                $RMAIT->address = $invoice_info['address'];
            if (array_key_exists('contact_person', $invoice_info))
                $RMAIT->contact_person = $invoice_info['contact_person'];
            if (array_key_exists('tel_no', $invoice_info))
                $RMAIT->tel_no = $invoice_info['tel_no'];
            if (array_key_exists('email', $invoice_info))
                $RMAIT->email = $invoice_info['email'];
            if (array_key_exists('gst', $invoice_info))
                $RMAIT->gst = $invoice_info['gst'];
            $RMAIT->updated_by = Auth::id();
            $RMAIT->updated_at = Carbon::now();
            $RMAIT->update();

            $unit_information = $sitecardrma['unit_information'];
            foreach ($unit_information as $key => $unit) {
                if (array_key_exists('id', $unit))
                {
                    $PVT = PhysicalVerificationMaster::find($unit['id']);
                    if ($PVT)
                    {
                        /*$PVT->producttype_id = $unit['producttype_id'];
                        $PVT->product_id = $unit['product_id'];
                        $PVT->serial_no  = $unit['serial_no'];*/
                        $PVT->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:$PVT->sales_order_no;
                        $PVT->updated_by = Auth::id();
                        $PVT->updated_at = Carbon::now();
                        $PVT->update();
                    }
                    
                    $RMAUT = RMAUnitInformation::where('pv_id', $unit['id'])->first();
                    if ($RMAUT)
                    {
                        if (array_key_exists('sw_version', $unit))
                        $RMAUT->sw_version = $unit['sw_version'];
                        /*if (array_key_exists('warrenty', $unit))
                            $RMAUT->warrenty = $unit['warrenty'];*/
                        if (array_key_exists('desc_of_fault', $unit))
                            $RMAUT->desc_of_fault = $unit['desc_of_fault'];
                        if (array_key_exists('sales_order_no', $unit))
                            $RMAUT->sales_order_no = $unit['sales_order_no'];
                        if (array_key_exists('field_volts_used', $unit))
                            $RMAUT->field_volts_used = $unit['field_volts_used'];
                        if (array_key_exists('equip_failed_on_installation', $unit))
                            $RMAUT->equip_failed_on_installation = $unit['equip_failed_on_installation'];
                        if (array_key_exists('equip_failed_on_service', $unit))
                            $RMAUT->equip_failed_on_service = $unit['equip_failed_on_service'];
                        if (array_key_exists('how_long', $unit))
                            $RMAUT->how_long = $unit['how_long'];
                        $RMAUT->updated_by = Auth::id();
                        $RMAUT->updated_at = Carbon::now();
                        $RMAUT->update();
                        PVStatusRepositories::ChangeStatusToSaved($RMAUT->pv_id);
                    }

                }
                else
                {
                    $PVT = new PhysicalVerificationMaster();
                    $PVT->receipt_id = -1;
                    $PVT->docket_details = '';
                    $PVT->courier_name = '';
                    $PVT->pvdate = $RMA->date;
                    $PVT->producttype_id = $unit['producttype_id'];
                    $PVT->product_id = $unit['product_id'];
                    $PVT->serial_no  = $unit['serial_no'];
                    $PVT->is_rma_available = 1;
                    $PVT->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
                    $PVT->created_by = Auth::id();
                    $PVT->created_at = Carbon::now();
                    $PVT->updated_by = Auth::id();
                    $PVT->updated_at = Carbon::now();
                    $PVT->save();

                    $RMAUT = new RMAUnitInformation();
                    $RMAUT->rma_id = $RMA->id;
                    $RMAUT->pv_id = $PVT->id;
                    $RMAUT->service_type = 2;
                    $RMAUT->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
                    //$RMAUT->warrenty = (array_key_exists('warrenty', $unit))?$unit['warrenty']:0;
                    $RMAUT->desc_of_fault = (array_key_exists('desc_of_fault', $unit))?$unit['desc_of_fault']:'';
                    $RMAUT->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
                    $RMAUT->field_volts_used = (array_key_exists('field_volts_used', $unit))?$unit['field_volts_used']:0;
                    $RMAUT->equip_failed_on_installation = (array_key_exists('equip_failed_on_installation', $unit))?$unit['equip_failed_on_installation']:0;
                    $RMAUT->equip_failed_on_service = (array_key_exists('equip_failed_on_service', $unit))?$unit['equip_failed_on_service']:0;
                    $RMAUT->how_long = (array_key_exists('how_long', $unit))?$unit['how_long']:'';
                    $RMAUT->created_by = Auth::id();
                    $RMAUT->created_at = Carbon::now();
                    $RMAUT->updated_by = Auth::id();
                    $RMAUT->updated_at = Carbon::now();
                    $RMAUT->save();

                    PVStatusRepositories::ChangeStatusToSaved($RMAUT->pv_id);
                }
            }

            return response()->json(['data' => $RMA, 'status' => 'success', 'message' => 'SiteCard RMA Saved Successfully'], 200);
        }
        else
        {
            //save rma table
            $RMA = new RMA();
            $RMA->receipt_id = -1;
            $RMA->gs_no = (array_key_exists('gs_no', $sitecardrma))?$sitecardrma['gs_no']:'';
            $RMA->act_reference = (array_key_exists('act_reference', $sitecardrma))?$sitecardrma['act_reference']:'';
            if (array_key_exists('date', $sitecardrma))
            {
                $date = Carbon::createFromFormat('d/m/Y',$sitecardrma['date']);
                $RMA->date = $date->format('Y-m-d');
            }
            else
            {
                $RMA->date = '';
            }
            $RMA->customer_address_id = (array_key_exists('customer_address_id', $sitecardrma))?$sitecardrma['customer_address_id']:0;
            $RMA->end_customer = (array_key_exists('end_customer', $sitecardrma['invoice_info']))?$sitecardrma['invoice_info']['end_customer']:'';
            $RMA->status = 2;
            $RMA->service_type = 2;
            $RMA->created_by = Auth::id();
            $RMA->created_at = Carbon::now();
            $RMA->save();

            $delivery_info = $sitecardrma['delivery_info'];
            $RMADT = new RMADeliveryAddress();
            $RMADT->rma_id = $RMA->id;
            $RMADT->name = (array_key_exists('name', $delivery_info))?$delivery_info['name']:'';
            $RMADT->address = (array_key_exists('address', $delivery_info))?$delivery_info['address']:'';
            $RMADT->contact_person = (array_key_exists('contact_person', $delivery_info))?$delivery_info['contact_person']:'';
            $RMADT->tel_no = (array_key_exists('tel_no', $delivery_info))?$delivery_info['tel_no']:'';
            $RMADT->email = (array_key_exists('email', $delivery_info))?$delivery_info['email']:'';
            $RMADT->gst = (array_key_exists('gst', $delivery_info))?$delivery_info['gst']:'';
            $RMADT->created_by = Auth::id();
            $RMADT->created_at = Carbon::now();
            $RMADT->updated_by = Auth::id();
            $RMADT->updated_at = Carbon::now();
            $RMADT->save();

            $invoice_info = $sitecardrma['invoice_info'];
            $RMAIT = new RMAInvoiceAddress();
            $RMAIT->rma_id = $RMA->id;
            $RMAIT->name = (array_key_exists('name', $invoice_info))?$invoice_info['name']:'';
            $RMAIT->address = (array_key_exists('address', $invoice_info))?$invoice_info['address']:'';
            $RMAIT->contact_person = (array_key_exists('contact_person', $invoice_info))?$invoice_info['contact_person']:'';
            $RMAIT->tel_no = (array_key_exists('tel_no', $invoice_info))?$invoice_info['tel_no']:'';
            $RMAIT->email = (array_key_exists('email', $invoice_info))?$invoice_info['email']:'';
            $RMAIT->gst = (array_key_exists('gst', $invoice_info))?$invoice_info['gst']:'';
            $RMAIT->created_by = Auth::id();
            $RMAIT->created_at = Carbon::now();
            $RMAIT->updated_by = Auth::id();
            $RMAIT->updated_at = Carbon::now();
            $RMAIT->save();

            $unit_information = $sitecardrma['unit_information'];
            foreach ($unit_information as $key => $unit) {

                $PVT = new PhysicalVerificationMaster();
                $PVT->receipt_id = -1;
                $PVT->docket_details = '';
                $PVT->courier_name = '';
                $PVT->pvdate = $RMA->date;
                $PVT->producttype_id = $unit['producttype_id'];
                $PVT->product_id = $unit['product_id'];
                $PVT->serial_no  = $unit['serial_no'];
                $PVT->is_rma_available = 1;
                $PVT->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
                $PVT->created_by = Auth::id();
                $PVT->created_at = Carbon::now();
                $PVT->updated_by = Auth::id();
                $PVT->updated_at = Carbon::now();
                $PVT->save();

                $RMAUT = new RMAUnitInformation();
                $RMAUT->rma_id = $RMA->id;
                $RMAUT->pv_id = $PVT->id;
                $RMAUT->service_type = 2;
                $RMAUT->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
                //$RMAUT->warrenty = (array_key_exists('warrenty', $unit))?$unit['warrenty']:0;
                $RMAUT->desc_of_fault = (array_key_exists('desc_of_fault', $unit))?$unit['desc_of_fault']:'';
                $RMAUT->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
                $RMAUT->field_volts_used = (array_key_exists('field_volts_used', $unit))?$unit['field_volts_used']:0;
                $RMAUT->equip_failed_on_installation = (array_key_exists('equip_failed_on_installation', $unit))?$unit['equip_failed_on_installation']:0;
                $RMAUT->equip_failed_on_service = (array_key_exists('equip_failed_on_service', $unit))?$unit['equip_failed_on_service']:0;
                $RMAUT->how_long = (array_key_exists('how_long', $unit))?$unit['how_long']:'';
                $RMAUT->created_by = Auth::id();
                $RMAUT->created_at = Carbon::now();
                $RMAUT->updated_by = Auth::id();
                $RMAUT->updated_at = Carbon::now();
                $RMAUT->save();

                PVStatusRepositories::ChangeStatusToSaved($RMAUT->pv_id);
            }
        }

        return response()->json(['data' => $RMA, 'status' => 'success', 'message' => 'SiteCard RMA Saved Successfully'], 200);
    }
}
