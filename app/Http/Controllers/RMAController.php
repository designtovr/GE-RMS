<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RMA;
use App\Models\RMADeliveryAddress;
use App\Models\RMAUnitInformation;
use App\Models\RMAUnitSerialNumber;
use App\Models\PhysicalVerificationMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ADDRMARequest;
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
		$rma['unit_information'] = RMAUnitInformation::where('rma_id',$id)->get();
		$rma['invoice_info'] = RMAUnitInformation::where('rma_id', $id)->first();
		$rma['delivery_info'] = RMADeliveryAddress::where('rma_id', $id)->first();
		foreach ($rma['unit_information'] as $key => $unit) {
			$serial_no = array();
			$UnitSerialNumbers = RMAUnitSerialNumber::where('rma_unit_information_id',$unit['id'])->get();
			foreach ($UnitSerialNumbers as $key => $usn) {
				array_push($serial_no, $usn['serial_number']);
			}
			$unit['serial_no'] = $serial_no;
		}
		return response()->json(['data' => $rma, 'status' => 'success']);
	}

	public function GetRMARefNo(Request $request)
	{
		$ref_no = RMA::max('id') + 1;
        return response()->json(['data' => $ref_no, 'status' => 'success']);
	}

    public function AddRMA(ADDRMARequest $request)
    {
    	$requestdata = $request->get('rma');
        $pvdata = $request->get('pvs');
    	$RMA = new RMA();
    	$RMA->gs_no = $requestdata['gs_no'];
    	$RMA->act_reference = $requestdata['act_reference'];
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
    		$RMAUnitInformation->sw_version = $unit['sw_version'];
    		$RMAUnitInformation->service_type = $unit['service_type'];
    		$RMAUnitInformation->warrenty = $unit['warrenty'];
            $RMAUnitInformation->desc_of_fault = $unit['desc_of_fault'];
            $RMAUnitInformation->sales_order_no = (array_key_exists('sales_order_no', $unit))?$unit['sales_order_no']:'';
            $RMAUnitInformation->field_volts_used = $unit['field_volts_used'];
            $RMAUnitInformation->equip_failed_on_installation = $unit['equip_failed_on_installation'];
            $RMAUnitInformation->equip_failed_on_service = $unit['equip_failed_on_service'];
            $RMAUnitInformation->how_long = $unit['how_long'];
    		$RMAUnitInformation->created_by = Auth::id();
    		$RMAUnitInformation->updated_by = Auth::id();
    		$RMAUnitInformation->updated_at = Carbon::now();
    		$RMAUnitInformation->save();

            $PV = PhysicalVerificationMaster::where('id', $RMAUnitInformation->pv_id)->first();
            $PV->is_rma_available = 1;
            $PV->update();
    	}

    	return response()->json(['data' => $RMA, 'status' => 'success', 'message' => 'RMA Created Successfully'], 200);
    	
    }
}
