<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RMA;
use App\Models\RMADeliveryAddress;
use App\Models\RMAUnitInformation;
use App\Models\RMAUnitSerialNumber;
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
		$ref_no = 0;
		if (RMA::max('rma_reference_no') == 0)
			$ref_no = config('numberseries.rma_ref_no');
		else
			$ref_no = RMA::max('rma_reference_no') + 1;
        return response()->json(['data' => $ref_no, 'status' => 'success']);
	}

    public function AddRMA(ADDRMARequest $request)
    {
    	$requestdata = $request->get('rma');
    	$RMA = new RMA();
    	$RMA->rma_reference_no = $requestdata['ref_no'];
    	$RMA->gs_no = $requestdata['gs_no'];
    	$RMA->act_reference = $requestdata['act_reference'];
    	$date = Carbon::createFromFormat('d/m/Y',$requestdata['date']);
    	$RMA->date = $date->format('Y-m-d');
    	$RMA->desc_of_fault = $requestdata['desc_of_fault'];
    	$RMA->sales_order_no = $requestdata['wbs'];
    	$RMA->field_volts_used = $requestdata['field_volts_used'];
    	$RMA->equip_failed_on_installation = $requestdata['equip_failed_on_installation'];
    	$RMA->equip_failed_on_service = $requestdata['equip_failed_on_service'];
    	$RMA->update_version = $requestdata['update_version'];
    	$RMA->return_in_case = $requestdata['return_in_case'];
    	$RMA->how_long = $requestdata['how_long'];
    	$RMA->customer_address_id = $requestdata['customer_address_id'];
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

    	$unit_information = $requestdata['unit_information'];
    	foreach ($unit_information as $key => $unit) {
    		$RMAUnitInformation = new RMAUnitInformation();
    		$RMAUnitInformation->rma_id = $RMA->id;
    		$RMAUnitInformation->quantity = $unit['quantity'];
    		$RMAUnitInformation->model_no = $unit['model_id'];
    		$RMAUnitInformation->sw_version = $unit['sw_version'];
    		$RMAUnitInformation->service_type = $unit['service_type'];
    		$RMAUnitInformation->warrenty = $unit['warrenty'];
    		$RMAUnitInformation->created_by = Auth::id();
    		$RMAUnitInformation->updated_by = Auth::id();
    		$RMAUnitInformation->updated_at = Carbon::now();
    		$RMAUnitInformation->save();
    		for ($i=0; $i < sizeof($unit['serial_no']); $i++) { 
    			$RMAUnitSerialNumber = new RMAUnitSerialNumber();
    			$RMAUnitSerialNumber->rma_unit_information_id = $RMAUnitInformation->id;
    			$RMAUnitSerialNumber->serial_number = $unit['serial_no'][$i];
    			$RMAUnitSerialNumber->created_by = Auth::id();
    			$RMAUnitSerialNumber->updated_by = Auth::id();
    			$RMAUnitSerialNumber->updated_at = Carbon::now();
    			$RMAUnitSerialNumber->save();
    		}
    	}

    	return response()->json(['data' => $RMA, 'status' => 'success', 'messagae' => 'RMA Added Successfully'], 200);
    	
    }
}
