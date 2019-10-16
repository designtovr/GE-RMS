<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PhysicalVerificationMaster;
use App\Models\JobTicket;
use App\Models\JobTicketMaterials;
use App\Http\Requests\SaveJobTicketMaterialRequest;
use App\Http\Requests\CompleteJobTicketRequest;
use App\Http\Repositories\PVStatusRepositories;
use Carbon\Carbon;

class JobTicketController extends Controller
{
    public function JobTicket($pvid)
    {
    	$jt = DB::table('physical_verification as pv')
    			->selectRaw('jt.id, pv.id as pv_id, ru.desc_of_fault as customer_comment, pv.serial_no, pr.part_no, jt.comment, 
    				jt.power_on_test, w.type, w.comment as repair_comment, ru.rma_id, pv.pvdate as givendate, 
    				pvst.created_at as po_date, cus.name as customer_name, rma.end_customer')
    			->leftJoin('job_tickets as jt', 'pv.id', 'jt.pv_id')
    			->leftJoin('warranty as w', 'w.pv_id', 'pv.id')
    			->leftJoin('rma_unit_information as ru', 'ru.pv_id', 'pv.id')
    			->leftJoin('rma', 'rma.id', 'ru.rma_id')
    			->leftJoin('ma_customer as cus', 'cus.id', 'rma.customer_address_id')
    			->leftJoin('ma_product as pr', 'pr.id', 'pv.product_id')
    			->leftJoin('pv_status_tracking as pvst', function($join){
	    			$join->on('pvst.pv_id', 'pv.id');
	    		})->orderBy('pvst.created_at','desc')->where('pv.id', $pvid)
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
    		$JT = new JobTicket();
    		$JT->pv_id = $jobticket['pv_id'];
    		$JT->nature_of_defect = (array_key_exists('nature_of_defect', $jobticket))?$jobticket['nature_of_defect']: '';
    		$JT->comment = (array_key_exists('comment', $jobticket))?$jobticket['comment']:'';
    		$JT->power_on_test = (array_key_exists('power_on_test', $jobticket))?$jobticket['power_on_test']:'';
    		$JT->created_by = Auth::id();
    		$JT->updated_by = Auth::id();
    		$JT->created_at = Carbon::now();
    		$JT->updated_at = Carbon::now();
    		$JT->save();

    		$materials = $jobticket['job_ticket_materials'];
    		foreach ($materials as $key => $material) {
    			$JTM = new JobTicketMaterials();
    			$JTM->jt_id = $JT->id;
    			$JTM->part_no = (array_key_exists('part_no', $material))?$material['part_no']:'';
    			$JTM->value = (array_key_exists('value', $material))?$material['value']:'';
    			$JTM->old_pcp = (array_key_exists('old_pcp', $material))?$material['old_pcp']:'';
    			$JTM->new_pcp = (array_key_exists('new_pcp', $material))?$material['new_pcp']:'';
    			$JTM->comment = (array_key_exists('comment', $material))?$material['comment']:'';
    			$JTM->created_by = Auth::id();
	    		$JTM->updated_by = Auth::id();
	    		$JTM->created_at = Carbon::now();
	    		$JTM->updated_at = Carbon::now();
    			$JTM->save();
    		}

    		return response()->json(['status' => 'success', 'message' => 'Material Added Successfully']);
    	}
    	else
    	{
    		$JT = JobTicket::where('id', $jobticket['id'])->first();
    		$JT->pv_id = $jobticket['pv_id'];
    		$JT->nature_of_defect = (array_key_exists('nature_of_defect', $jobticket))?$jobticket['nature_of_defect']: '';
    		$JT->comment = (array_key_exists('comment', $jobticket))?$jobticket['comment']:'';
    		$JT->power_on_test = (array_key_exists('power_on_test', $jobticket))?$jobticket['power_on_test']:'';
    		$JT->updated_by = Auth::id();
    		$JT->updated_at = Carbon::now();
    		$JT->update();

    		$materials = $jobticket['job_ticket_materials'];
    		foreach ($materials as $key => $material) {
    				JobTicketMaterials::destroy($material['id']);
    				$JTM = new JobTicketMaterials();
    				$JTM->jt_id = $JT->id;
	    			$JTM->part_no = (array_key_exists('part_no', $material))?$material['part_no']:'';
	    			$JTM->value = (array_key_exists('value', $material))?$material['value']:'';
	    			$JTM->old_pcp = (array_key_exists('old_pcp', $material))?$material['old_pcp']:'';
	    			$JTM->new_pcp = (array_key_exists('new_pcp', $material))?$material['new_pcp']:'';
	    			$JTM->comment = (array_key_exists('comment', $material))?$material['comment']:'';
	    			$JTM->created_by = Auth::id();
		    		$JTM->updated_by = Auth::id();
		    		$JTM->created_at = Carbon::now();
		    		$JTM->updated_at = Carbon::now();
	    			$JTM->save();
    		}

    		return response()->json(['status' => 'success', 'message' => 'Material Updated Successfully']);
    	}
    }

    public function CompleteJobTicket(CompleteJobTicketRequest $request)
    {
    	$jobticket = $request->get('jobticket');
    	if ($jobticket['id'] == null)
    	{
    		$JT = new JobTicket();
    		$JT->pv_id = $jobticket['pv_id'];
    		$JT->nature_of_defect = (array_key_exists('nature_of_defect', $jobticket))?$jobticket['nature_of_defect']: '';
    		$JT->comment = (array_key_exists('comment', $jobticket))?$jobticket['comment']:'';
    		$JT->power_on_test = (array_key_exists('power_on_test', $jobticket))?$jobticket['power_on_test']:'';
    		$JT->created_by = Auth::id();
    		$JT->updated_by = Auth::id();
    		$JT->created_at = Carbon::now();
    		$JT->updated_at = Carbon::now();
    		$JT->save();

    		$materials = $jobticket['job_ticket_materials'];
    		foreach ($materials as $key => $material) {
    			$JTM = new JobTicketMaterials();
    			$JTM->jt_id = $JT->id;
    			$JTM->part_no = (array_key_exists('part_no', $material))?$material['part_no']:'';
    			$JTM->value = (array_key_exists('value', $material))?$material['value']:'';
    			$JTM->old_pcp = (array_key_exists('old_pcp', $material))?$material['old_pcp']:'';
    			$JTM->new_pcp = (array_key_exists('new_pcp', $material))?$material['new_pcp']:'';
    			$JTM->comment = (array_key_exists('comment', $material))?$material['comment']:'';
    			$JTM->created_by = Auth::id();
	    		$JTM->updated_by = Auth::id();
	    		$JTM->created_at = Carbon::now();
	    		$JTM->updated_at = Carbon::now();
    			$JTM->save();
    		}
    		PVStatusRepositories::ChangeStatusToJobTicketCompleted($JT->pv_id);

    	}
    	else
    	{
    		$JT = JobTicket::where('id', $jobticket['id'])->first();
    		$JT->pv_id = $jobticket['pv_id'];
    		$JT->nature_of_defect = (array_key_exists('nature_of_defect', $jobticket))?$jobticket['nature_of_defect']: '';
    		$JT->comment = (array_key_exists('comment', $jobticket))?$jobticket['comment']:'';
    		$JT->power_on_test = (array_key_exists('power_on_test', $jobticket))?$jobticket['power_on_test']:'';
    		$JT->updated_by = Auth::id();
    		$JT->updated_at = Carbon::now();
    		$JT->update();

    		$materials = $jobticket['job_ticket_materials'];
    		foreach ($materials as $key => $material) {
	    			if (array_key_exists('id', $material))
	    				JobTicketMaterials::destroy($material['id']);
    			
    				$JTM = new JobTicketMaterials();
    				$JTM->jt_id = $JT->id;
	    			$JTM->part_no = (array_key_exists('part_no', $material))?$material['part_no']:'';
	    			$JTM->value = (array_key_exists('value', $material))?$material['value']:'';
	    			$JTM->old_pcp = (array_key_exists('old_pcp', $material))?$material['old_pcp']:'';
	    			$JTM->new_pcp = (array_key_exists('new_pcp', $material))?$material['new_pcp']:'';
	    			$JTM->comment = (array_key_exists('comment', $material))?$material['comment']:'';
	    			$JTM->created_by = Auth::id();
		    		$JTM->updated_by = Auth::id();
		    		$JTM->created_at = Carbon::now();
		    		$JTM->updated_at = Carbon::now();
	    			$JTM->save();
    		}
    		PVStatusRepositories::ChangeStatusToJobTicketCompleted($JT->pv_id);
    	}

    	return response()->json(['status' => 'success', 'message' => 'Ticket Completed Successfully']);
    }
}
