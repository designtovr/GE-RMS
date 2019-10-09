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
use App\Http\Repositories\PVStatusRepositories;
use App\Http\Repositories\PVListingRepository;
use Carbon\Carbon;

class RMAController extends Controller
{

	public function GetRMAList(Request $request)
	{
		$rmalist = RMA::get();
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
        $pv = $request->get('pv');
        $RmaUnit = new RMAUnitInformation();
        $RmaUnit->rma_id = $rma['id'];
        $RmaUnit->pv_id = $pv['id'];
        $RmaUnit->sw_version = $pv['sw_version'];
        $RmaUnit->service_type = (array_key_exists('service_type', $pv))?$pv['service_type']:1;
        $RmaUnit->warrenty = $pv['warrenty'];
        $RmaUnit->desc_of_fault = $pv['desc_of_fault'];
        $RmaUnit->sales_order_no = $pv['sales_order_no'];
        $RmaUnit->field_volts_used = $pv['field_volts_used'];
        $RmaUnit->equip_failed_on_installation = $pv['equip_failed_on_installation'];
        $RmaUnit->equip_failed_on_service = $pv['equip_failed_on_service'];
        $RmaUnit->how_long = $pv['how_long'];
        $RmaUnit->created_by = Auth::id();
        $RmaUnit->updated_by = Auth::id();
        $RmaUnit->created_at = Carbon::now();
        $RmaUnit->updated_at = Carbon::now();
        $RmaUnit->save();
        $PhysicalVerification = PhysicalVerificationMaster::find($pv['id']);
        $PhysicalVerification->is_rma_available = 1;
        $PhysicalVerification->updated_by = Auth::id();
        $PhysicalVerification->updated_at = Carbon::now();
        $PhysicalVerification->save();

        return response()->json(['status' => 'success', 'message' => 'Relay Added Successfully'], 200);
    }

    public function AddRMA(ADDRMARequest $request)
    {
    	$requestdata = $request->get('rma');
        $pvdata = $request->get('pvs');
    	$RMA = new RMA();
    	$RMA->gs_no = $requestdata['gs_no'];
    	$RMA->act_reference = (array_key_exists('act_reference', $requestdata))?$requestdata['act_reference']:'';
    	$date = Carbon::createFromFormat('d/m/Y',$requestdata['date']);
    	$RMA->date = $date->format('Y-m-d');
    	$RMA->customer_address_id = $requestdata['customer_address_id'];
        $RMA->end_customer = $requestdata['invoice_info']['end_customer']['end_customer'];
    	$RMA->created_by = Auth::id();
    	$RMA->updated_by = Auth::id();
    	$RMA->updated_at = Carbon::now();
    	$RMA->save();

    	$delivery_info = $requestdata['delivery_info'];
    	$RMADelivery = new RMADeliveryAddress();
    	$RMADelivery->rma_id = $RMA->id;
    	$RMADelivery->address = $delivery_info['delivery_address'];
    	$RMADelivery->contact_person = $delivery_info['contact_name'];
    	$RMADelivery->tel_no = $delivery_info['tel_no'];
    	$RMADelivery->email = $delivery_info['delivery_email'];
    	$RMADelivery->gst = $delivery_info['gst_number'];
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
            $RMAUnitInformation->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
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
}
