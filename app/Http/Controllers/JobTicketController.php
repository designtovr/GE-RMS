<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PhysicalVerificationMaster;
use App\Models\JobTicket;
use App\Models\JobTicketMaterials;
use App\Http\Requests\SaveJobTicketMaterialRequest;
use Carbon\Carbon;

class JobTicketController extends Controller
{
    public function JobTicket($pvid)
    {
    	$jt = DB::table('physical_verification as pv')
    			->selectRaw('jt.id, pv.id as pv_id, jt.nature_of_defect, pv.serial_no, pr.part_no, jt.comment, 
    				jt.power_on_test, w.type, ru.rma_id, pv.pvdate as givendate, 
    				pvst.created_at as po_date, cus.name as customer_name, rma.end_customer')
    			->leftJoin('job_tickets as jt', 'pv.id', 'jt.pv_id')
    			->leftJoin('warranty as w', 'w.pv_id', 'pv.id')
    			->leftJoin('rma_unit_information as ru', 'ru.pv_id', 'pv.id')
    			->leftJoin('rma', 'rma.id', 'ru.rma_id')
    			->leftJoin('ma_customer as cus', 'cus.id', 'rma.customer_address_id')
    			->leftJoin('ma_product as pr', 'pr.id', 'pv.product_id')
    			->leftJoin('pv_status_tracking as pvst', function($join){
	    			$join->on('pvst.pv_id', 'pv.id')->where('pvst.status_id',4);
	    		})->where('pv.id', $pvid)
	    		->first();
	    $date = Carbon::createFromFormat('Y-m-d H:i:s', $jt->po_date);
        $jt->po_date = $date->format('d/m/Y');
        $jt->job_ticket_materials = JobTicketMaterials::where('jt_id', $jt->id)->get();
    	return response()->json(['status' => 'success', 'data' => $jt]);
    }

    public function SaveJobTicketMaterial(SaveJobTicketMaterialRequest $request)
    {
    	$jobticket = $request->get('jobticket');
    	if ($jobticket['id'] == null)
    	{
    		
    	}
    }
}
