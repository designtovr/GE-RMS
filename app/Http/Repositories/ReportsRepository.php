<?php

namespace App\Http\Repositories;

use App\Models\PhysicalVerificationMaster;
use App\Models\ReceiptMaster;
use App\Models\RMA;
use App\Models\RMAUnitInformation;
use App\Models\RMADeliveryAddress;
use App\Models\RMAInvoiceAddress;
use App\Models\WarrantyMaster;
use App\Models\JobTicket;
use App\Models\JobTicketMaterials;
use App\Models\AutoTestBench;
use App\Models\AutoTestBenchTracking;
use App\Models\Aging;
use App\Models\AgingTracking;
use App\Models\VerificationCompletion;
use App\Models\PVStatusTracking;
use App\Models\OtherRelayStage;
use App\Models\OtherRelayStageTracking;
use App\Models\DispatchMaster;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


 class ReportsRepository
 {
 	public function DataForRelaysStageReport()
 	{
 		$relays = PhysicalVerificationMaster::selectRaw('physical_verification.*, rda.name as customer_name, ROUND(UNIX_TIMESTAMP(physical_verification.created_at) * 1000) as created_date_unix')
 		->leftJoin('rma_unit_information as rui', 'rui.pv_id', 'physical_verification.id')
 		->leftJoin('rma_delivery_address as rda', 'rda.rma_id', 'rui.rma_id')->get();
 		return $relays;
 	}

 	public function RelayStageReport($id)
 	{
 		$relay = PhysicalVerificationMaster::selectRaw('physical_verification.*, c_user.name as created_by_name, u_user.name as updated_by_name, pro.part_no, pt.name as pro_type, pt.category as product_category, mpvs.status as current_status')
 				->leftJoin('users as c_user', 'c_user.id', 'physical_verification.created_by')
				->leftJoin('users as u_user', 'u_user.id', 'physical_verification.updated_by')
				->leftJoin('ma_product as pro', 'pro.id', 'physical_verification.product_id')
				->leftJoin('ma_product_type as pt', 'pt.id', 'physical_verification.producttype_id')
				->leftJoin('pv_status as pvs', 'pvs.pv_id', 'physical_verification.id')
				->leftJoin('ma_pv_status as mpvs', 'mpvs.id', 'pvs.current_status_id')
 				->find($id);

 		$relay['receipt'] = ReceiptMaster::selectRaw('receipt.*, cus.name as customer_name, c_user.name as created_by_name, u_user.name as updated_by_name')
 							->leftJoin('ma_customer as cus', 'cus.id', 'receipt.customer_id')
 							->leftJoin('users as c_user', 'c_user.id', 'receipt.created_by')
 							->leftJoin('users as u_user', 'u_user.id', 'receipt.updated_by')
 							->find($relay->receipt_id);

		$relay['rma'] = RMAUnitInformation::selectRaw('rma.date, rma.created_at, rma.updated_at, c_user.name as created_by_name, u_user.name as updated_by_name, rma.status as rma_status, rma_unit_information.rma_id, rma_unit_information.desc_of_fault, rma_unit_information.sales_order_no')->leftJoin('rma', 'rma.id', 'rma_unit_information.rma_id')
			->leftJoin('users as c_user', 'c_user.id', 'rma.created_by')
				->leftJoin('users as u_user', 'u_user.id', 'rma.updated_by')->where('pv_id', $relay->id)->first();

		if(!$relay['rma'])
			return $relay;

		$relay['invoice_info'] = RMAInvoiceAddress::selectRaw('*')->where('rma_id', $relay['rma']->rma_id)->first();
		$relay['delivery_info'] = RMADeliveryAddress::selectRaw('*')->where('rma_id', $relay['rma']->rma_id)->first();
		$relay['warranty'] = WarrantyMaster::selectRaw('warranty.*, c_user.name as created_by_name, u_user.name as updated_by_name')->leftJoin('users as c_user', 'c_user.id', 'warranty.created_by')
			->leftJoin('users as u_user', 'u_user.id', 'warranty.updated_by')->where('pv_id', $relay->id)->first();

		$relay['job_ticket'] = JobTicket::selectRaw('job_tickets.*, c_user.name as created_by_name, u_user.name as updated_by_name')
			->leftJoin('users as c_user', 'c_user.id', 'job_tickets.created_by')
			->leftJoin('users as u_user', 'u_user.id', 'job_tickets.updated_by')->where('pv_id', $relay->id)->first();

		$relay['job_ticket_materials'] = (object)[];
		if(!is_null($relay['job_ticket']))
		{
			$relay['job_ticket_materials'] = JobTicketMaterials::selectRaw('*')->where('jt_id', $relay['job_ticket']->id)->get();
		}
		

		$relay['testing'] = AutoTestBenchTracking::selectRaw('auto_test_bench_tracking.*, c_user.name as created_by_name')
								->leftJoin('users as c_user', 'c_user.id', 'auto_test_bench_tracking.created_by')
								->where('pv_id', $relay->id)->get();

		$relay['aging'] = AgingTracking::selectRaw('aging_tracking.*, c_user.name as created_by_name')->leftJoin('users as c_user', 'c_user.id', 'aging_tracking.created_by')->where('pv_id', $relay->id)->get();

		$relay['verification_completion'] = VerificationCompletion::selectRaw('verification_completion.*, c_user.name as created_by_name')
			->leftJoin('users as c_user', 'c_user.id', 'verification_completion.created_by')->where('pv_id', $relay->id)->first();

		$relay['dispatch_approval'] = PVStatusTracking::selectRaw('pv_status_tracking.*, c_user.name as created_by_name')->leftJoin('users as c_user', 'c_user.id', 'pv_status_tracking.created_by')->where('pv_id', $relay->id)->where('status_id', 14)->first();

		$relay['dispatch'] = DispatchMaster::selectRaw('dispatch.*, c_user.name as created_by_name')->where('pv_id', $relay->id)->leftJoin('users as c_user', 'c_user.id', 'dispatch.created_by')->first();

		$relay['other_relay_stage_tracking'] = OtherRelayStageTracking::selectRaw('stage_id, comments, c_user.name as created_by_name, other_relay_stage_tracking.created_at')->leftJoin('users as c_user', 'c_user.id', 'other_relay_stage_tracking.created_by')->where('pv_id', $relay->id)->get();

 		return $relay;
 	}

 	public function ListForRMAReport()
 	{
 		$rmas = RMA::selectRaw('rma.*, ROUND(UNIX_TIMESTAMP(rma.created_at) * 1000) as created_date_unix')->get();

 		return $rmas;
 	}

 	public function RMAReport($id)
 	{
 		$rma = RMA::selectRaw('rma.*, c_user.name as created_by_name, u_user.name as updated_by_name, cus.name as customer_name')
 				->leftJoin('users as c_user', 'c_user.id', 'rma.created_by')
 				->leftJoin('users as u_user', 'u_user.id', 'rma.updated_by')
 				->leftJoin('ma_customer as cus', 'rma.customer_address_id', 'cus.id')
 				->where('rma.id', $id)->first();

 		$rma['receipt'] = ReceiptMaster::where('id', $rma->receipt_id)->first();

 		$rma['invoice_info'] = RMAInvoiceAddress::selectRaw('*')->where('rma_id', $rma->id)->first();
		$rma['delivery_info'] = RMADeliveryAddress::selectRaw('*')->where('rma_id', $rma->id)->first();

 		$rma['physical_verification'] = PhysicalVerificationMaster::from('physical_verification as pv')
 					->selectRaw('pv.*, rui.desc_of_fault, pro.part_no, u_user.name as updated_by_name, msta.status as current_status')
 					->leftJoin('rma_unit_information as rui', 'rui.pv_id', 'pv.id')
 					->leftJoin('ma_product as pro', 'pv.product_id', 'pro.id')
 					->leftJoin('users as c_user', 'c_user.id', 'pv.created_by')
					->leftJoin('users as u_user', 'u_user.id', 'pv.updated_by')
					->leftJoin('pv_status as sta', 'sta.pv_id', 'pv.id')
					->leftJoin('ma_pv_status as msta', 'msta.id', 'sta.current_status_id')
 					->where('rui.rma_id', $rma->id)->get();

 		return $rma;
 	}

 	public function ListForDispatchReport()
 	{
 		$dispatches = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.*, pro.part_no, pt.category, rc_customer.name as customer, (UNIX_TIMESTAMP(dis.dispatch_completed_at) * 1000) as created_date_unix')
 						->join('dispatch as dis', 'dis.pv_id', 'pv.id')
 						->leftJoin('ma_product as pro', 'pv.product_id', 'pro.id')
 						->leftJoin('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
 						->leftJoin('receipt as rc', 'rc.id', 'pv.receipt_id')
 						->leftJoin('ma_customer as rc_customer', 'rc_customer.id', 'rc.customer_id')
 						->get();

		return $dispatches;
 	}

 	public function DispatchReport($id)
 	{
 		$dispatch = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.*, dis.dc_no, dis.docket_details, dis.courier_name, dis.person_name, dis.concern_name , dis.dispatch_completed_at as dispatched_date, dis.contact, c_user.name as dispatched_by')
 						->join('dispatch as dis', 'dis.pv_id', 'pv.id')
 						->leftJoin('users as c_user', 'c_user.id', 'dis.created_by')
 						->where('pv.id', $id)->first();

 		return $dispatch;
 	}

 	public function RepairReportData()
 	{
 		$pvs = PhysicalVerificationMaster::
 				with('jobticket.materials')->selectRaw('physical_verification.id,ROUND(UNIX_TIMESTAMP(rc.receipt_date) * 1000) as receipt_date, rc_customer.name as customer, rma.end_customer , rc.site as location, pt.code, pt.category, wt.smp, wt.pcp, wt.type as wch_type, pro.part_no, physical_verification.serial_no
 					, repair_start_pst.created_at as repair_initiated_date, repair_end_pst.created_at as repair_completed_at, rui.desc_of_fault as defect_by_customer, IF(jt.download_customer_setting=1, "Yes", "No") as download_customer_setting, rui.sw_version as existing_sw_version, vc.updated_sw_version, IF(vc.restored_customer_setting=1, "Yes", "No") as restored_customer_setting, physical_verification.comment as remark_by_verification, repaired_us.username as repaired_by, mps.status as current_status, dis.dc_no, dis.docket_details, dis.dispatch_completed_at as dispatched_at, rma.service_type as rma_type')
 				->leftJoin('receipt as rc', 'rc.id', 'physical_verification.receipt_id')
 				->leftJoin('ma_customer as rc_customer', 'rc_customer.id', 'rc.customer_id')
 				->leftJoin('ma_product_type as pt', 'pt.id', 'physical_verification.producttype_id')
 				->leftJoin('warranty as wt', 'wt.pv_id', 'physical_verification.id')
 				->leftJoin('ma_product as pro', 'pro.id', 'physical_verification.product_id')
 				->leftJoin('pv_status_tracking as repair_start_pst', function($join){
 					$join->on('repair_start_pst.pv_id', 'physical_verification.id')->where('repair_start_pst.status_id', 5);
 				})->leftJoin('pv_status_tracking as repair_end_pst', function($join){
 					$join->on('repair_end_pst.pv_id', 'physical_verification.id')->where('repair_end_pst.status_id', 6);
 				})->leftJoin('rma_unit_information as rui', 'rui.pv_id', 'physical_verification.id')
 				->leftJoin('rma', 'rma.id', 'rui.rma_id')
 				->leftJoin('job_tickets as jt', 'jt.pv_id', 'physical_verification.id')
 				->leftJoin('job_ticket_materials as jtm', 'jt.id', 'jtm.jt_id')
 				->leftJoin('verification_completion as vc', 'vc.pv_id', 'physical_verification.id')
 				->leftJoin('users as repaired_us', 'repaired_us.id', 'repair_end_pst.created_by')
 				->leftJoin('pv_status as sta', 'sta.pv_id', 'physical_verification.id')
 				->leftJoin('ma_pv_status as mps', 'mps.id', 'sta.current_status_id')
 				->leftJoin('dispatch as dis', 'dis.pv_id', 'physical_verification.id')->groupBy('physical_verification.id')->get();

		foreach ($pvs as $key => $pv) {

			if(is_null($pv['smp']) || is_null($pv['pcp']))
				$pv['wch'] = "Not Declared";
			else if($pv['smp'] == 2 && $pv['pcp'] == 2)
				$pv['wch'] = "Warranty";
			else
				$pv['wch'] = "Chargeable";

			if($pv['wch_type'] == 1)
				$pv['wch_type'] = "Repair";
			else if($pv['wch_type'] == 2)
				$pv['wch_type'] = "Modification";
			else if($pv['wch_type'] == 3)
				$pv['wch_type'] = "Investigation";

			$pv['dispatch_status'] = (is_null($pv['dispatched_at']))?"No":"Yes";

			for ($i=0; $i < 12; $i++) {
				$var_name = 'pcb';
				if(isset($pv['jobticket']['materials'][$i]))
				{
					$pv[$var_name.'_part_no_'.($i+1)] = $pv['jobticket']['materials'][$i]['part_no'];
					$pv[$var_name.'_defective_pcb_'.($i+1)] = $pv['jobticket']['materials'][$i]['old_pcp'];
					$pv[$var_name.'_new_pcb_'.($i+1)] = $pv['jobticket']['materials'][$i]['new_pcp'];
				}
				else
				{
					$pv[$var_name.'_part_no_'.($i+1)] = '';
					$pv[$var_name.'_defective_pcb_'.($i+1)] = '';
					$pv[$var_name.'_new_pcb_'.($i+1)] = '';
				}
			}
			unset($pv['jobticket']);
		}

		return $pvs;

 	}
 } 