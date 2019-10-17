<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RMA;
use App\Models\RMADeliveryAddress;
use App\Models\RMAUnitInformation;
use App\Models\RMAUnitSerialNumber;
use App\Models\PhysicalVerificationMaster;
use App\Models\CustomerMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ADDRMARequest;
use App\Http\Requests\AddRmaUnitRequest;
use App\Http\Requests\AddSCRMARequest;
use App\Http\Repositories\PVStatusRepositories;
use App\Http\Repositories\PVListingRepository;
use Carbon\Carbon;

class RMAController extends Controller
{

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
		$rma = RMA::where('rma.id', $id)->first();
		$rma['unit_information'] = RMAUnitInformation::selectRaw('rma_unit_information.*,pv.id as id,pv.serial_no, pr.part_no,pt.category')->where('rma_id',$id)->leftJoin('physical_verification as pv', 'pv.id', 'rma_unit_information.pv_id')->leftJoin('ma_product as pr', 'pr.id', 'pv.product_id')->leftJoin('ma_product_type as pt', 'pt.id', 'pr.type')->get();
		$rma['invoice_info'] = CustomerMaster::where('id', $rma['customer_address_id'])->first();
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
        if (!array_key_exists('id', $requestdata))
        {
            $RMA = new RMA();
            $RMA->gs_no = $requestdata['gs_no'];
            $RMA->act_reference = (array_key_exists('act_reference', $requestdata))?$requestdata['act_reference']:'';
            $date = Carbon::createFromFormat('d/m/Y',$requestdata['date']);
            $RMA->date = $date->format('Y-m-d');
            $RMA->customer_address_id = $requestdata['customer_address_id'];
            $RMA->end_customer = $requestdata['invoice_info']['end_customer'];
            $RMA->status = 3;
            $RMA->created_by = Auth::id();
            $RMA->updated_by = Auth::id();
            $RMA->updated_at = Carbon::now();
            $RMA->save();

            $delivery_info = $requestdata['delivery_info'];
            $RMADelivery = new RMADeliveryAddress();
            $RMADelivery->rma_id = $RMA->id;
            $RMADelivery->address = $delivery_info['address'];
            $RMADelivery->contact_person = $delivery_info['contact_person'];
            $RMADelivery->tel_no = $delivery_info['tel_no'];
            $RMADelivery->email = $delivery_info['email'];
            $RMADelivery->gst = $delivery_info['gst'];
            $RMADelivery->created_by = Auth::id();
            $RMADelivery->updated_by = Auth::id();
            $RMADelivery->updated_at = Carbon::now();
            $RMADelivery->save();

            foreach ($pvdata as $key => $unit) {
                $RMAUnitInformation = new RMAUnitInformation();
                $RMAUnitInformation->rma_id = $RMA->id;
                $RMAUnitInformation->pv_id = $unit['id'];
                $RMAUnitInformation->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
                $RMAUnitInformation->service_type = (array_key_exists('service_type', $unit))?$unit['service_type']:1;
                $RMAUnitInformation->warrenty = $unit['warrenty'];
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

                $PV = PhysicalVerificationMaster::where('id', $RMAUnitInformation->pv_id)->first();
                $PV->is_rma_available = 1;
                $PV->update();

                PVStatusRepositories::ChangeStatusToManagerApproval($RMAUnitInformation->pv_id);
            }

            return response()->json(['data' => $RMA, 'status' => 'success', 'message' => 'RMA Created Successfully'], 200);
        }
        else
        {
            $RMA = RMA::where('id', $requestdata['id'])->first();
            $RMA->gs_no = $requestdata['gs_no'];
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
            $RMADelivery->updated_by = Auth::id();
            $RMADelivery->updated_at = Carbon::now();
            if ($dexists)                
                $RMADelivery->update();
            else
                $RMADelivery->save();

            foreach ($pvdata as $key => $unit) {
                $RMAUnitInformation = RMAUnitInformation::where('pv_id', $unit['id'])->where('rma_id', $unit['rma_id'])->first();
                if ($RMAUnitInformation)
                {
                    if (array_key_exists('sw_version', $unit))
                        $RMAUnitInformation->sw_version = $unit['sw_version'];
                    if (array_key_exists('service_type', $unit))
                        $RMAUnitInformation->service_type = $unit['service_type'];
                    if (array_key_exists('warrenty', $unit))
                        $RMAUnitInformation->warrenty = $unit['warrenty'];
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
                    $RMAUnitInformation->service_type = (array_key_exists('service_type', $unit))?$unit['service_type']:1;
                    $RMAUnitInformation->warrenty = $unit['warrenty'];
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

                PVStatusRepositories::ChangeStatusToManagerApproval($RMAUnitInformation->pv_id);
            }

            return response()->json(['data' => $RMA, 'status' => 'success', 'message' => 'RMA Updated Successfully'], 200);
        }
    	
    }

    public function SaveRMA(Request $request)
    {
        $rmadata = $request->get('rma');
        $pvdata = $request->get('pvs');
        if (!array_key_exists('id', $rmadata))
        {
            $RMA = new RMA();
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
            $RMA->created_by = Auth::id();
            $RMA->updated_by = Auth::id();
            $RMA->updated_at = Carbon::now();
            $RMA->save();

            if (isset($rmadata['delivery_info']))
            {
                $delivery_info = $rmadata['delivery_info'];
                $RMAD = new RMADeliveryAddress();
                $RMAD->rma_id = $RMA->id;
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

            foreach ($pvdata as $key => $unit) {
                $RMAUnitInformation = new RMAUnitInformation();
                $RMAUnitInformation->rma_id = $RMA->id;
                $RMAUnitInformation->pv_id = $unit['id'];
                $RMAUnitInformation->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
                $RMAUnitInformation->service_type = (array_key_exists('service_type', $unit))?$unit['service_type']:1;
                $RMAUnitInformation->warrenty = (array_key_exists('warrenty', $unit))?$unit['warrenty']:-1;
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

            foreach ($pvdata as $key => $unit) {
                $RMAUnitInformation = RMAUnitInformation::where('pv_id', $unit['id'])->where('rma_id', $unit['rma_id'])->first();
                $RMAUnitInformation->sw_version = (array_key_exists('sw_version', $unit))?$unit['sw_version']:'';
                $RMAUnitInformation->service_type = (array_key_exists('service_type', $unit))?$unit['service_type']:1;
                $RMAUnitInformation->warrenty = (array_key_exists('warrenty', $unit))?$unit['warrenty']:-1;
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
        $RMAT->customer_address_id = $rma['customer_address_id'];
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
            $RMAUT->warrenty = (array_key_exists('warrenty', $unit))?$unit['warrenty']:0;
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

            PVStatusRepositories::ChangeStatusToManagerApproval($RMAUT->pv_id);
        }

        return response()->json(['data' => $RMAT, 'status' => 'success', 'message' => 'RMA Created Successfully'], 200);
    }
}
