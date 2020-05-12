<?php

namespace App\Http\Repositories;

use App\Models\PhysicalVerificationMaster;
use App\Models\ReceiptMaster;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class PVListingRepository
{

	private function PVList($status_id, $service_type = array(), $receipt_status = array(), $cat = ['smp', 'omu'])
	{
		$pv = PhysicalVerificationMaster::
				selectRaw('physical_verification.*, ROUND(UNIX_TIMESTAMP(physical_verification.pvdate) * 1000 +50000000) as date_unix ,receipt.gs_no, receipt.customer_id, rma.end_customer,pr.part_no, rma.service_type,pt.category,ma_pv_status.status, ma_pv_status.close_status, rmu.sw_version, rmu.rma_id, rmu.desc_of_fault as customer_comment, warranty.comment as manager_comment, tes.comment as testing_comment, jt.comment as repair_comment, aging.comment as aging_comment, tes.created_at as tes_created_at, IF(pvl.priority > 0, pvl.priority, 999999) as pvl_priority, IF(pvl.priority > 0, pvl.priority, "NA") as pvl_priority_for_display, ria.name as customer_name, rms.rack_id, ort.current_stage as ort_current_stage')
				->leftJoin('receipt', 'physical_verification.receipt_id', 'receipt.id')
				->leftJoin('ma_product as pr', 'pr.id', 'physical_verification.product_id')
				->leftJoin('ma_product_type as pt', 'pt.id', 'physical_verification.producttype_id')
				->leftJoin('pv_status', 'pv_status.pv_id', 'physical_verification.id')
				->leftJoin('ma_pv_status', 'ma_pv_status.id', 'pv_status.current_status_id')
				->leftJoin('rma_unit_information as rmu', 'rmu.pv_id', 'physical_verification.id')
				->leftJoin('rma', 'rma.id', 'rmu.rma_id')
				->leftJoin('warranty', 'warranty.pv_id', 'physical_verification.id')
				->leftJoin('auto_test_bench as tes', 'tes.pv_id', 'physical_verification.id')
				->leftJoin('job_tickets as jt', 'jt.pv_id', 'physical_verification.id')
				->leftJoin('aging', 'aging.pv_id', 'physical_verification.id')
				->leftJoin('ma_customer as cus', 'cus.id', 'rma.customer_address_id')
				->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'physical_verification.id')
				->leftJoin('rma_delivery_address as rda', 'rda.rma_id', 'rma.id')
				->leftJoin('rma_invoice_address as ria', 'ria.rma_id', 'rma.id')
				->leftJoin('rms', 'rms.pv_id', 'physical_verification.id')
				->leftJoin('other_relay_stage as ort', 'ort.pv_id', 'physical_verification.id')
				->whereIn('pv_status.current_status_id', $status_id)
				->whereIn('pt.category', $cat);
		if(sizeof($receipt_status) > 0)
			$pv = $pv->whereIn('receipt.status', $receipt_status);
		if (sizeof($service_type) > 0)
			$pv = $pv->whereIn('rma.service_type', $service_type);
		if($cat == ['ge', 'boj', 'others'])
			$pv = $pv->where('ort.current_stage', '!=', 5);

		if(in_array(4, $status_id))
		{
			//getting pvs with rack_id entered
			$pv = $pv->where('rms.rack_id', '!=', "");
		}


		$pv = $pv->orderBy('pvl_priority', 'asc')->orderBy('physical_verification.id')->get();

		return $pv;
	}

	public static function PVForRmaId($id)
	{
		$pv = PhysicalVerificationMaster::
				selectRaw('physical_verification.*,receipt.gs_no, receipt.customer_id, cus.name as customer_name,rma.end_customer,pr.part_no,pt.category')
				->leftJoin('receipt', 'physical_verification.receipt_id', 'receipt.id')
				->leftJoin('ma_product as pr', 'pr.id', 'physical_verification.product_id')
				->leftJoin('ma_product_type as pt', 'pt.id', 'physical_verification.producttype_id')
				->leftJoin('pv_status', 'pv_status.pv_id', 'physical_verification.id')
				->leftJoin('ma_pv_status', 'ma_pv_status.id', 'pv_status.current_status_id')
				->leftJoin('rma', 'rma.receipt_id', 'receipt.id')
				->leftJoin('rma_unit_information as rmu', 'rmu.pv_id', 'physical_verification.id')
				->leftJoin('ma_customer as cus', 'cus.id', 'receipt.customer_id')
				->whereIn('pv_status.current_status_id', [1,2])
                ->where('rma.id', $id)->get();
		return $pv;
	}

	public static function WithoutRma()
	{
		$status_id = array (1);
		return (new self)->PVList($status_id);
	}

	public static function WithoutRmaClosedReceipt()
	{
		$status_id = array (1);
		return (new self)->PVList($status_id, [], [3]);
	}

	public static function WithRma()
	{
		$status_id = array (2);
		return (new self)->PVList($status_id, [], []);
	}

	public static function WithRmaClosedReceipt()
	{
		$status_id = array (2);
		return (new self)->PVList($status_id, [], [3]);
	}

	public static function WithAndWithOutRma()
	{
		$status_id = array(1, 2);
		return (new self)->PVList($status_id);
	}

	public static function WithAndWithOutRmaClosedReceipt()
	{
		$status_id = array(1, 2);
		return (new self)->PVList($status_id, [], [3]);
	}

	public static function Saved()
	{
		$status_id = array (15);
		return (new self)->PVList($status_id);
	}

	public static function WaitingForManagerApproval()
	{
		$status_id = array (13);
		return (new self)->PVList($status_id);
	}

	public static function WaitingForCustomerApproval()
	{
		$status_id = array(3);
		return (new self)->PVList($status_id);
	}

	public static function ManagerApproved()
	{
		$status_id = array(4);
		return (new self)->PVList($status_id);
	}

	public static function JobTicketOpen()
	{
		return (new self)->ManagerApproved();
	}

	public static function JobTicketStarted()
	{
		$status_id = array(5);
		return (new self)->PVList($status_id);
	}

	public static function JobTicketCompleted()
	{
		$status_id = array(6);
		return (new self)->PVList($status_id);
	}

	public static function AutoTestBenchOpen()
	{
		return (new self)->JobTicketCompleted();
	}

	public static function AutoTestBenchStarted()
	{
		$status_id = array(7);
		return (new self)->PVList($status_id);
	}

	public static function AutoTestBenchCompleted()
	{
		$status_id = array(8);
		return (new self)->PVList($status_id);
	}

	public static function AgingStarted()
	{
		$status_id = array(9);
		return (new self)->PVList($status_id);
	}

	public static function AgingCompleted()
	{
		$status_id = array(10);
		return (new self)->PVList($status_id);
	}

	public static function WaitingForVerification()
	{
		return (new self)->AgingCompleted();
	}

	public static function VerificationCompleted()
	{
		$status_id = array(11);
		return (new self)->PVList($status_id, [], [], ['smp', 'omu', 'ge', 'boj', 'others']);
	}

	public static function WaitingFOrDispatchApproval()
	{
		return (new self)->VerificationCompleted();
	}

	public static function Dispatched()
	{
		$status_id = array(12);
		return (new self)->PVList($status_id);
	}

	public static function DispatchApproved()
    {
        $status_id = array(14);
        return (new self)->PVList($status_id, [], [], ['smp', 'omu', 'ge', 'boj', 'others']);
    }

    public static function InRepair()
    {
    	$status_id = array(6,7,8,9,10);
    	return (new self)->PVList($status_id);
    }

    public static function SiteCardAfterJobTicketCompleted()
    {
    	$status_id = array(6,7,8,9,10,11,12,14);
    	return (new self)->PVList($status_id, array (2));
    }

    public static function All()
    {
    	$status_id = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15, array(1, 2), [1,2,3], ['smp', 'omu', 'ge', 'boj', 'others']);
    	return (new self)->PVList($status_id);
    }

    public static function OtherRelay()
    {
    	$status_id = array(12, 14, 16);
    	return (new self)->PVList($status_id, [], [], ['ge', 'boj', 'others']);
    }

    public static function DashBoardValues()
    {
    	$start = microtime(true);
    	$pvs = array();
    	//get data for physicalverification
    	$pvs['for_physical_verification'] = DB::table('physical_verification as pv')->selectRaw('pv.receipt_id, rc.customer_id, cus.name as customer_name, COUNT(*) as total')
    			->join('receipt as rc', 'rc.id', 'pv.receipt_id')
    			->join('ma_customer as cus', 'cus.id', 'rc.customer_id')
    			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    			->where('sta.current_status_id', 1)
    			->orWhere('sta.current_status_id', 2)
    			->groupBy('customer_id')
    			->get();
    	//loop and add due count
		$pvs['total_overdue']['for_pv'] = 0;
		$pvs['total_overdue']['for_pv_due_list'] = array();
    	foreach ($pvs['for_physical_verification'] as $key => $for_pv) {
    		$for_pv->overdue_list = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.id, pv.serial_no, poa.pv, DATEDIFF( "'.Carbon::now().'", pv.created_at) as overall_due, pt.code as product_family')
    			->join('receipt as rc', 'rc.id', 'pv.receipt_id')
    			->join('ma_customer as cus', 'cus.id', 'rc.customer_id')
    			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    			->join('ma_product_overdue_age as poa', 'poa.category', 'pt.category')
    			->where('customer_id', $for_pv->customer_id)
    			->where(function($query) use ($for_pv) {
    				$query->where('sta.current_status_id', 1);
    				$query->orWhere('sta.current_status_id', 2);
    			})->whereRaw('DATEDIFF("'. Carbon::now() .'", pv.created_at) > (poa.pv-1)')
    			->get();

			$for_pv->due_list = array();
			foreach ($for_pv->overdue_list as $key => $list) {
				array_push($for_pv->due_list, $list);
				array_push($pvs['total_overdue']['for_pv_due_list'], $list);
			}

			$for_pv->overdue = sizeof($for_pv->overdue_list);
			$pvs['total_overdue']['for_pv'] += $for_pv->overdue;
			unset($for_pv->overdue_list);
    	}
    	//data for for W/C
    	$pvs['wch'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, pt.id as pt_id, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    					->where('sta.current_status_id', 13)
    					->groupBy('pt.id')
    					->get();
    	//loop and add due count
		$pvs['total_overdue']['wch'] = 0;
		$pvs['total_overdue']['wch_due_list'] = array();
    	foreach ($pvs['wch'] as $key => $wc) {
    		$wc->overdue_list = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.id, pv.serial_no, poa.wch, DATEDIFF( "'.Carbon::now().'", pv.created_at) as overall_due, pt.code as product_family')
    			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    			->join('ma_product_overdue_age as poa', 'poa.category', 'pt.category')
    			->where('pt.id', $wc->pt_id)
    			->where('sta.current_status_id', 13)
    			->whereRaw('DATEDIFF("'. Carbon::now() .'", sta.created_at) > (poa.wch-1)')
    			->get();

			$wc->due_list = array();
			foreach ($wc->overdue_list as $key => $list) {
				array_push($wc->due_list, $list);
				array_push($pvs['total_overdue']['wch_due_list'], $list);
			}
			$wc->overdue = sizeof($wc->overdue_list);
    		$pvs['total_overdue']['wch'] += $wc->overdue;
    		unset($wc->overdue_list);
    	}
    	//data for test
    	$pvs['for_test'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, pt.id as pt_id, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    					->whereIn('sta.current_status_id', [6, 7])
    					->groupBy('pt.id')
    					->get();
    	//loop and add due count
		$pvs['total_overdue']['for_test'] = 0;
		$pvs['total_overdue']['for_test_due_list'] = array();
    	foreach ($pvs['for_test'] as $key => $test) {
    		$test->overdue_list = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.id, pv.serial_no, poa.testing, DATEDIFF( "'.Carbon::now().'", pv.created_at) as overall_due, pt.code as product_family')
    			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    			->join('ma_product_overdue_age as poa', 'poa.category', 'pt.category')
    			->where('pt.id', $test->pt_id)
    			->whereIn('sta.current_status_id', [6, 7])
    			->whereRaw('DATEDIFF("'. Carbon::now() .'", sta.created_at) > (poa.testing-1)')
    			->get();

    		$test->due_list = array();
			foreach ($test->overdue_list as $key => $list) {
				array_push($test->due_list, $list);
				array_push($pvs['total_overdue']['for_test_due_list'], $list);
			}
			$test->overdue = sizeof($test->overdue_list);
			$pvs['total_overdue']['for_test'] += $test->overdue;
			unset($test->overdue_list);
    	}

    	//data for packing
    	$pvs['for_pack'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, pt.id as pt_id, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    					->whereIn('sta.current_status_id', [14])
    					->groupBy('pt.id')
    					->get();
    	//loop and add due count
		$pvs['total_overdue']['for_pack'] = 0;
		$pvs['total_overdue']['for_pack_due_list'] = array();
    	foreach ($pvs['for_pack'] as $key => $pack) {
    		$pack->overdue_list = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.id, pv.serial_no, poa.dispatch, DATEDIFF( "'.Carbon::now().'", pv.created_at) as overall_due, pt.code as product_family')
    			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    			->join('ma_product_overdue_age as poa', 'poa.category', 'pt.category')
    			->where('pt.id', $pack->pt_id)
    			->whereIn('sta.current_status_id', [14])
    			->whereRaw('DATEDIFF("'. Carbon::now() .'", sta.created_at) > (poa.dispatch-1)')
    			->get();

			$pack->due_list = array();
			foreach ($pack->overdue_list as $key => $list) {
				array_push($pack->due_list, $list);
				array_push($pvs['total_overdue']['for_pack_due_list'], $list);
			}
			$pack->overdue = sizeof($pack->overdue_list);
    		$pvs['total_overdue']['for_pack'] += $pack->overdue;
    		unset($pack->overdue_list);

			$pvs['total_overdue']['for_pack'] += $pack->overdue;
    	}

    	//data for repair
    	$pvs['for_repair'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, pt.id as pt_id, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    					->whereIn('sta.current_status_id', array(4,5,6,7,8))
    					->groupBy('pt.id')
    					->get();
		//loop and add due count
		$pvs['total_overdue']['for_repair'] = 0;
		foreach ($pvs['for_repair'] as $key => $repair) {
			$repair->overdue_list = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.id, pv.serial_no, poa.jt, DATEDIFF( "'.Carbon::now().'", pv.created_at) as overall_due, pt.code as product_family')
    			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    			->join('ma_product_overdue_age as poa', 'poa.category', 'pt.category')
    			->where('pt.id', $repair->pt_id)
    			->whereIn('sta.current_status_id', array(4,5,6,7,8,9,10))
    			->whereRaw('DATEDIFF("'. Carbon::now() .'", sta.created_at) > (poa.jt-1)')
    			->get();

			$repair->due_list = array();
			foreach ($repair->overdue_list as $key => $list) {
				array_push($repair->due_list, $list);
			}
			$repair->overdue = sizeof($repair->overdue_list);
    		$pvs['total_overdue']['for_repair'] += $repair->overdue;
    		unset($repair->overdue_list);
		}

    	//data for aging
    	$pvs['for_aging'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, pt.id as pt_id, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    					->whereIn('sta.current_status_id', [8, 9])
    					->groupBy('pt.id')
    					->get();
		//loop and add due count
		$pvs['total_overdue']['for_aging'] = 0;
    	foreach ($pvs['for_aging'] as $key => $aging) {
    		$aging->overdue = DB::table('physical_verification as pv')->selectRaw('pv.receipt_id, DATEDIFF(pv.created_at,"'. Carbon::now() .'") AS DateDiff')
    			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    			->where('pt.id', $aging->pt_id)
    			->whereIn('sta.current_status_id', [8, 9])
    			->whereRaw('DATEDIFF("'. Carbon::now() .'", sta.created_at) > 0')
    			->get()->count();
			$pvs['total_overdue']['for_aging'] += $aging->overdue;
    	}

    	//data for verification
    	$pvs['for_verifi'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, pt.id as pt_id, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    					->whereIn('sta.current_status_id', [10])
    					->groupBy('pt.id')
    					->get();
		//loop and add due count
		$pvs['total_overdue']['for_verifi'] = 0;
    	foreach ($pvs['for_verifi'] as $key => $verifi) {
    		$verifi->overdue = DB::table('physical_verification as pv')->selectRaw('pv.receipt_id, DATEDIFF(pv.created_at,"'. Carbon::now() .'") AS DateDiff')
    			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    			->where('pt.id', $verifi->pt_id)
    			->whereIn('sta.current_status_id', [10])
    			->whereRaw('DATEDIFF("'. Carbon::now() .'", sta.created_at) > 0')
    			->get()->count();
			$pvs['total_overdue']['for_verifi'] += $verifi->overdue;
    	}

    	//priority list
    	$pvs['priority'] = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.id, pv.serial_no, pt.code as type_name, IF(pvl.priority > 0, pvl.priority, 999999) as pvl_priority, rms.rack_id, mps.status as current_stage')
    				->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    				->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    				->leftJoin('rms', 'rms.pv_id', 'pv.id')
    				->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
    				->leftJoin('ma_pv_status as mps', 'mps.id', 'sta.current_status_id')
    				->whereIn('sta.current_status_id', [3,4,5,6,7,8,9,10,11])
    				->where('pt.category', '!=', 'boj')
    				->orderBy('pvl_priority')->orderBy('pv.id')->get();

		$pvs['repair_priority'] = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.id, pv.serial_no, pt.code as type_name, IF(pvl.priority > 0, pvl.priority, 999999) as pvl_priority, rms.rack_id, mps.status as current_stage')
    				->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    				->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    				->leftJoin('rms', 'rms.pv_id', 'pv.id')
    				->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
    				->leftJoin('ma_pv_status as mps', 'mps.id', 'sta.current_status_id')
    				->whereIn('sta.current_status_id', [4,5])
    				->where('pt.category', '!=', 'boj')
    				->orderBy('pvl_priority')->orderBy('pv.id')->get();

		//today status
		$pvs['today_status']['numerical']['completed'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
			->whereIn('pt.name', ['Px40', 'C264', 'Agile', 'NUMERICAL'])
			->whereDate('pv.created_at', date('Y-m-d'))
			->where('sta.current_status_id', 12)
			->count();

		$pvs['today_status']['numerical']['pending'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
		->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
		->join('pv_status as sta', 'sta.pv_id', 'pv.id')
		->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
		->whereIn('pt.name', ['Px40', 'C264', 'Agile', 'NUMERICAL'])
		->whereDate('pv.created_at', date('Y-m-d'))
		->where('sta.current_status_id', '<>', 12)
		->count();

		$pvs['today_status']['conventional']['completed'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
			->whereIn('pt.name', ['CONVENTIONAL'])
			->whereDate('pv.created_at', date('Y-m-d'))
			->where('sta.current_status_id', 12)
			->count();

		$pvs['today_status']['conventional']['pending'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
		->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
		->join('pv_status as sta', 'sta.pv_id', 'pv.id')
		->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
		->whereIn('pt.name', ['CONVENTIONAL'])
		->whereDate('pv.created_at', date('Y-m-d'))
		->where('sta.current_status_id', '<>', 12)
		->count();

		//monthly status
		$pvs['monthly_status']['numerical']['completed'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
			->whereIn('pt.name', ['Px40', 'C264', 'Agile', 'NUMERICAL'])
			->whereMonth('pv.created_at', date('m'))
			->where('sta.current_status_id', 12)
			->count();

		$pvs['monthly_status']['numerical']['pending'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
		->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
		->join('pv_status as sta', 'sta.pv_id', 'pv.id')
		->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
		->whereIn('pt.name', ['Px40', 'C264', 'Agile', 'NUMERICAL'])
		->whereMonth('pv.created_at', date('m'))
		->where('sta.current_status_id', '<>', 12)
		->count();

		$pvs['monthly_status']['conventional']['completed'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
			->whereIn('pt.name', ['CONVENTIONAL'])
			->whereMonth('pv.created_at', date('m'))
			->where('sta.current_status_id', 12)
			->count();

		$pvs['monthly_status']['conventional']['pending'] = DB::table('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
		->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
		->join('pv_status as sta', 'sta.pv_id', 'pv.id')
		->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
		->whereIn('pt.name', ['CONVENTIONAL'])
		->whereMonth('pv.created_at', date('m'))
		->where('sta.current_status_id', '<>', 12)
		->count();

		//repair warranty chart
		$pvs['repair_warranty']['px40']['total'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'Px40')
			->where('wa.smp', 2)
			->where('wa.pcp', 2)
			->get()->count();

		$pvs['repair_warranty']['px40']['time_exceeded'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'Px40')
			->where('wa.smp', 2)
			->where('wa.pcp', 2)
			->whereRaw('DATEDIFF("'. Carbon::now() .'", wa.created_at) > 0')
			->get()->count();

		$pvs['repair_warranty']['c264']['total'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'C264')
			->where('wa.smp', 2)
			->where('wa.pcp', 2)
			->get()->count();

		$pvs['repair_warranty']['c264']['time_exceeded'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'C264')
			->where('wa.smp', 2)
			->where('wa.pcp', 2)
			->whereRaw('DATEDIFF("'. Carbon::now() .'", wa.created_at) > 0')
			->get()->count();

		$pvs['repair_warranty']['agile']['total'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'Agile')
			->where('wa.smp', 2)
			->where('wa.pcp', 2)
			->get()->count();

		$pvs['repair_warranty']['agile']['time_exceeded'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'Agile')
			->where('wa.smp', 2)
			->where('wa.pcp', 2)
			->whereRaw('DATEDIFF("'. Carbon::now() .'", wa.created_at) > 0')
			->get()->count();

		$pvs['repair_warranty']['conventional']['total'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.name', 'Conventional')
			->where('wa.smp', 2)
			->where('wa.pcp', 2)
			->get()->count();

		$pvs['repair_warranty']['conventional']['time_exceeded'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.name', 'Conventional')
			->where('wa.smp', 2)
			->where('wa.pcp', 2)
			->whereRaw('DATEDIFF("'. Carbon::now() .'", wa.created_at) > 0')
			->get()->count();

		//repair chargable chart
		$pvs['repair_chargable']['px40']['total'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'Px40')
			->where(function($query)
			{
				$query->where('wa.smp', 1)->orWhere('wa.pcp', 1);
			})
			->get()->count();

		$pvs['repair_chargable']['px40']['time_exceeded'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'Px40')
			->where(function($query)
			{
				$query->where('wa.smp', 1)->orWhere('wa.pcp', 1);
			})
			->whereRaw('DATEDIFF("'. Carbon::now() .'", wa.created_at) > 0')
			->get()->count();

		$pvs['repair_chargable']['c264']['total'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'C264')
			->where(function($query)
			{
				$query->where('wa.smp', 1)->orWhere('wa.pcp', 1);
			})
			->get()->count();

		$pvs['repair_chargable']['c264']['time_exceeded'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'C264')
			->where(function($query)
			{
				$query->where('wa.smp', 1)->orWhere('wa.pcp', 1);
			})
			->whereRaw('DATEDIFF("'. Carbon::now() .'", wa.created_at) > 0')
			->get()->count();

		$pvs['repair_chargable']['agile']['total'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'Agile')
			->where(function($query)
			{
				$query->where('wa.smp', 1)->orWhere('wa.pcp', 1);
			})
			->get()->count();

		$pvs['repair_chargable']['agile']['time_exceeded'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.code', 'Agile')
			->where(function($query)
			{
				$query->where('wa.smp', 1)->orWhere('wa.pcp', 1);
			})
			->whereRaw('DATEDIFF("'. Carbon::now() .'", wa.created_at) > 0')
			->get()->count();

		$pvs['repair_chargable']['conventional']['total'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.name', 'Conventional')
			->where(function($query)
			{
				$query->where('wa.smp', 1)->orWhere('wa.pcp', 1);
			})
			->get()->count();

		$pvs['repair_chargable']['conventional']['time_exceeded'] = DB::table('warranty as wa')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->where('pt.name', 'Conventional')
			->where(function($query)
			{
				$query->where('wa.smp', 1)->orWhere('wa.pcp', 1);
			})
			->whereRaw('DATEDIFF("'. Carbon::now() .'", wa.created_at) > 0')
			->get()->count();

		$pvs['receipt'] = ReceiptMaster::selectRaw('receipt.total_boxes, cus.name as customer_name, IF(receipt.status=1, "Open", "Started") as status, DATEDIFF("'. Carbon::now() .'",receipt.created_at) AS DateDiff')->leftJoin('ma_customer as cus', 'cus.id', 'receipt.customer_id')->whereIn('receipt.status', [1, 2])->orderBy('receipt.created_at', 'DESC')->get();

		$pvs['profiling'] = microtime(true) - $start;
    	return $pvs;
    }

    public static function DataForDailyReport()
    {
    	$data = array();

    	//Received Relays
    	$data['received_relays'] = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->whereDate('pv.created_at', Carbon::today())
    					->groupBy('pt.code')
    					->get();
		//Cumulative Received Relays
		foreach ($data['received_relays'] as $key => $relay) {
			$month = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->whereMonth('pv.created_at', date('m'))
    					->where('pt.code', $relay->type_name)
    					->first();
			$relay->cumulative = $month->total;
		}

		//Total Relays Completed
		$data['total_relays_completed_all']['repair'] = PhysicalVerificationMaster::from('physical_verification as pv')
					->selectRaw('pv.id, pt.code as type_name, COUNT(*) as total')
					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
					->join('pv_status_tracking as pst', 'pv.id', 'pst.pv_id')
					->where('pst.status_id', 6)
					->whereDate('pst.created_at', Carbon::today())
					->groupBy('pt.code')
    				->get();

		$data['total_relays_completed_all']['test'] = PhysicalVerificationMaster::from('physical_verification as pv')
					->selectRaw('pv.id, pt.code as type_name, COUNT(*) as total')
					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
					->join('pv_status_tracking as pst', 'pv.id', 'pst.pv_id')
					->where('pst.status_id', 8)
					->whereDate('pst.created_at', Carbon::today())
					->groupBy('pt.code')
    				->get();

		$data['total_relays_completed_all']['dispatch'] = PhysicalVerificationMaster::from('physical_verification as pv')
					->selectRaw('pv.id, pt.code as type_name, COUNT(*) as total')
					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
					->join('pv_status_tracking as pst', 'pv.id', 'pst.pv_id')
					->where('pst.status_id', 12)
					->whereDate('pst.created_at', Carbon::today())
					->groupBy('pt.code')
    				->get();

		//arranging Completed Relays
		$data['total_relays_completed'] = array();
		foreach ($data['total_relays_completed_all']['repair'] as $key => $relay) {
			$relay['item'] = (object)[];
			$relay['item']->type_name = $relay->type_name;
			$relay['item']->repair = $relay->total;
			$relay['item']->test = 0;
			$relay['item']->dispatch = 0;
			array_push($data['total_relays_completed'], $relay['item']);
			unset($relay['item']);
		}

		foreach ($data['total_relays_completed_all']['test'] as $key => $relay) {
			$exists = false;
			foreach ($data['total_relays_completed'] as $key => $newrelay) {
				if(strcasecmp($newrelay->type_name, $relay->type_name) == 0)
				{
					$exists = true;
					$newrelay->test = $relay->total;
					break;
				}
			}
			if(!$exists)
			{
				$relay['item'] = (object)[];
				$relay['item']->type_name = $relay->type_name;
				$relay['item']->repair = 0;
				$relay['item']->test = $relay->total;
				$relay['item']->dispatch = 0;
				array_push($data['total_relays_completed'], $relay['item']);
				unset($relay['item']);
			}
		}

		foreach ($data['total_relays_completed_all']['dispatch'] as $key => $relay) {
			$exists = false;
			foreach ($data['total_relays_completed'] as $key => $newrelay) {
				if(strcasecmp($newrelay->type_name, $relay->type_name) == 0)
				{
					$exists = true;
					$newrelay->dispatch = $relay->total;
					break;
				}
			}
			if(!$exists)
			{
				$relay['item'] = (object)[];
				$relay['item']->type_name = $relay->type_name;
				$relay['item']->repair = 0;
				$relay['item']->test = 0;
				$relay['item']->dispatch = $relay->total;
				array_push($data['total_relays_completed'], $relay['item']);
				unset($relay['item']);
			}
		}

		$newobj = (object)[];
		$newobj->type_name = 'Total';
		$newobj->repair = 0;
		$newobj->test = 0;
		$newobj->dispatch = 0;
		$newobj->total = 0;
		
		foreach ($data['total_relays_completed'] as $key => $relay) {
			$relay->total = $relay->repair + $relay->test + $relay->dispatch;
			$newobj->repair += $relay->repair;
			$newobj->test += $relay->test;
			$newobj->dispatch += $relay->dispatch;
			$newobj->total += $relay->total;
		}
		array_push($data['total_relays_completed'], $newobj);

		unset($data['total_relays_completed_all']);

		$overdues = PVListingRepository::DashBoardValues();
		$data['total_relays_overdues'] = array();
		foreach ($overdues['for_repair'] as $key => $relay) {
			$relay->item = (object)[];
			$relay->item->type_name = $relay->type_name;
			$relay->item->repair = $relay->total;
			$relay->item->test = 0;
			$relay->item->dispatch = 0;

			array_push($data['total_relays_overdues'], $relay->item);
			unset($relay->item);
		}

		foreach ($overdues['for_test'] as $key => $relay) {
			$exists = false;
			foreach ($data['total_relays_overdues'] as $key => $newrelay) {
				if(strcasecmp($newrelay->type_name, $relay->type_name) == 0)
				{
					$exists = true;
					$newrelay->test = $relay->total;
					break;
				}
			}
			if(!$exists)
			{
				$relay->item = (object)[];
				$relay->item->type_name = $relay->type_name;
				$relay->item->repair = 0;
				$relay->item->test = $relay->total;
				$relay->item->dispatch = 0;
				array_push($data['total_relays_overdues'], $relay->item);
				unset($relay->item);
			}
		}

		foreach ($overdues['for_pack'] as $key => $relay) {
			$exists = false;
			foreach ($data['total_relays_overdues'] as $key => $newrelay) {
				if(strcasecmp($newrelay->type_name, $relay->type_name) == 0)
				{
					$exists = true;
					$newrelay->dispatch = $relay->total;
					break;
				}
			}
			if(!$exists)
			{
				$relay->item = (object)[];
				$relay->item->type_name = $relay->type_name;
				$relay->item->repair = 0;
				$relay->item->test = 0;
				$relay->item->dispatch = $relay->total;
				array_push($data['total_relays_overdues'], $relay->item);
				unset($relay->item);
			}
		}

		$newobj = (object)[];
		$newobj->type_name = 'Total';
		$newobj->repair = 0;
		$newobj->test = 0;
		$newobj->dispatch = 0;
		$newobj->total = 0;
		
		foreach ($data['total_relays_overdues'] as $key => $relay) {
			$relay->total = $relay->repair + $relay->test + $relay->dispatch;
			$newobj->repair += $relay->repair;
			$newobj->test += $relay->test;
			$newobj->dispatch += $relay->dispatch;
			$newobj->total += $relay->total;
		}
		array_push($data['total_relays_overdues'], $newobj);

		$data['total_completed_all'] = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status_tracking as pst', 'pst.pv_id', 'pv.id')
    					->where('pst.status_id', 12)
    					->whereDate('pst.created_at', Carbon::today())
    					->groupBy('pt.name')
    					->get();

		$data['total_completed'] = [];
		$data['total_completed']['total'] = 0;
		foreach ($data['total_completed_all'] as $key => $item) {
			$data['total_completed'][$item['type_name']] = $item['total'];
			$data['total_completed']['total'] += $item->total;
		}

		if(!isset($data['total_completed']['CONVENTIONAL']))
		{
			$data['total_completed']['CONVENTIONAL'] = 0;
		}

		if(!isset($data['total_completed']['NUMERICAL']))
		{
			$data['total_completed']['NUMERICAL'] = 0;
		}

		if(!isset($data['total_completed']['MULTILIN']))
		{
			$data['total_completed']['MULTILIN'] = 0;
		}

		if(!isset($data['total_completed']['REASON']))
		{
			$data['total_completed']['REASON'] = 0;
		}

		$data['total_completed']['BOJ'] = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pt.name as type_name')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status_tracking as pst', 'pst.pv_id', 'pv.id')
    					->where('pst.status_id', 12)
    					->whereDate('pst.created_at', Carbon::today())
    					->where('pt.category', 'boj')
    					->get()->count();

		unset($data['total_completed_all']);

		$data['total_chargeable'] = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status_tracking as pst', 'pst.pv_id', 'pv.id')
    					->join('warranty as wt', 'wt.pv_id', 'pv.id')
    					->join('pv_status as ps', 'ps.pv_id', 'pv.id')
    					->where('ps.current_status_id', 4)
    					->where('wt.smp', 1)
    					->where('wt.pcp', 1)
    					->groupBy('pt.code')
    					->get();

		$data['warranty_overdue'] = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pt.code as type_name, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status_tracking as pst', 'pst.pv_id', 'pv.id')
    					->join('warranty as wt', 'wt.pv_id', 'pv.id')
    					->join('pv_status as ps', 'ps.pv_id', 'pv.id')
    					->join('ma_product_overdue_age as poa', 'poa.category', 'pt.category')
    					->where('ps.current_status_id', 4)
    					->whereRaw('DATEDIFF("'. Carbon::now() .'", ps.created_at) > (poa.wch-1)')
    					->where(function($query){
    						$query->where('wt.smp', 2)->orWhere('wt.pcp', 2);
    					})
    					->groupBy('pt.code')
    					->get();

		$data['repair_lead_time'] = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pt.category as type_name, AVG( datediff( end_pst.created_at, start_pst.created_at )) AS average')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status_tracking as start_pst', function($join){
    						$join->on('start_pst.pv_id', 'pv.id')->where('start_pst.status_id', 5);
    					})
    					->join('pv_status_tracking as end_pst', function($join){
    						$join->on('end_pst.pv_id', 'pv.id')->where('end_pst.status_id', 12);
    					})
    					->groupBy('pt.category')
    					->get();

		return $data;
    }

}