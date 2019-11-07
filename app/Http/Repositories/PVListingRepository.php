<?php

namespace App\Http\Repositories;

use App\Models\PhysicalVerificationMaster;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class PVListingRepository
{

	private function PVList($status_id)
	{
		$pv = PhysicalVerificationMaster::
				selectRaw('physical_verification.*,receipt.gs_no, receipt.customer_id, cus.name as customer_name,receipt.end_customer,pr.part_no,pt.category,ma_pv_status.status, ma_pv_status.close_status, rmu.sw_version, rmu.rma_id, rmu.desc_of_fault as customer_comment, warranty.comment as manager_comment, tes.comment as testing_comment, jt.comment as repair_comment, aging.comment as aging_comment, tes.created_at as tes_created_at, IF(pvl.priority > 0, pvl.priority, 999999) as pvl_priority, IF(pvl.priority > 0, pvl.priority, "NA") as pvl_priority_for_display')
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
				->leftJoin('ma_customer as cus', 'cus.id', 'receipt.customer_id')
				->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'physical_verification.id')
				->whereNotIn('pt.category', ["'omu'","'boj'"])
				->whereIn('pv_status.current_status_id', $status_id)->orderBy('pvl_priority', 'asc')->orderBy('physical_verification.id')->get();
		return $pv;
	}

	public static function WithoutRma()
	{
		$status_id = array (1);
		return (new self)->PVList($status_id);
	}

	public static function WithRma()
	{
		$status_id = array (2);
		return (new self)->PVList($status_id);
	}

	public static function WithAndWithOutRma()
	{
		$status_id = array(1, 2);
		return (new self)->PVList($status_id);
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
		return (new self)->PVList($status_id);
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
        return (new self)->PVList($status_id);
    }

    public static function DashBoardValues()
    {
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
    	foreach ($pvs['for_physical_verification'] as $key => $for_pv) {
    		$for_pv->overdue = 5;
    	}
    	//data for for W/C
    	$pvs['wch'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    					->where('sta.current_status_id', 13)
    					->groupBy('pt.id')
    					->get();
    	//loop and add due count
    	foreach ($pvs['wch'] as $key => $wc) {
    		$wc->overdue = 5;
    	}
    	//data for test
    	$pvs['for_test'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    					->where('sta.current_status_id', 6)
    					->groupBy('pt.id')
    					->get();
    	//loop and add due count
    	foreach ($pvs['for_test'] as $key => $test) {
    		$test->overdue = 5;
    	}

    	//data for packing
    	$pvs['for_pack'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
    					->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    					->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    					->where('sta.current_status_id', 14)
    					->groupBy('pt.id')
    					->get();
    	//loop and add due count
    	foreach ($pvs['for_pack'] as $key => $pack) {
    		$pack->overdue = 5;
    	}

    	//priority list
    	$pvs['priority'] = DB::table('physical_verification as pv')->selectRaw('pv.serial_no, pt.name as type_name, IF(pvl.priority > 0, pvl.priority, 999999) as pvl_priority, rms.rack_id')
    				->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
    				->join('pv_status as sta', 'sta.pv_id', 'pv.id')
    				->leftJoin('rms', 'rms.pv_id', 'pv.id')
    				->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
    				->whereIn('sta.current_status_id', [3,4,5,6,7,8,9,10,11,12,15])
    				->orderBy('pvl_priority')->orderBy('pv.id')->get()->take(10);

		//today status
		$pvs['today_status']['numerical']['completed'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
			->whereIn('pt.code', ['Px40', 'C264', 'Agile'])
			->whereDate('pv.created_at', date('Y-m-d'))
			->where('sta.current_status_id', 12)
			->count();

		$pvs['today_status']['numerical']['pending'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
		->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
		->join('pv_status as sta', 'sta.pv_id', 'pv.id')
		->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
		->whereIn('pt.code', ['Px40', 'C264', 'Agile'])
		->whereDate('pv.created_at', date('Y-m-d'))
		->where('sta.current_status_id', '<>', 12)
		->count();

		$pvs['today_status']['conventional']['completed'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
			->whereIn('pt.code', ['Other'])
			->whereDate('pv.created_at', date('Y-m-d'))
			->where('sta.current_status_id', 12)
			->count();

		$pvs['today_status']['conventional']['pending'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
		->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
		->join('pv_status as sta', 'sta.pv_id', 'pv.id')
		->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
		->whereIn('pt.code', ['Other'])
		->whereDate('pv.created_at', date('Y-m-d'))
		->where('sta.current_status_id', '<>', 12)
		->count();

		//monthly status
		$pvs['monthly_status']['numerical']['completed'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
			->whereIn('pt.code', ['Px40', 'C264', 'Agile'])
			->whereMonth('pv.created_at', date('m'))
			->where('sta.current_status_id', 12)
			->count();

		$pvs['monthly_status']['numerical']['pending'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
		->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
		->join('pv_status as sta', 'sta.pv_id', 'pv.id')
		->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
		->whereIn('pt.code', ['Px40', 'C264', 'Agile'])
		->whereMonth('pv.created_at', date('m'))
		->where('sta.current_status_id', '<>', 12)
		->count();

		$pvs['monthly_status']['conventional']['completed'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
			->whereIn('pt.code', ['Other'])
			->whereMonth('pv.created_at', date('m'))
			->where('sta.current_status_id', 12)
			->count();

		$pvs['monthly_status']['conventional']['pending'] = DB::table('physical_verification as pv')->selectRaw('pt.name as type_name, COUNT(*) as total')
		->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
		->join('pv_status as sta', 'sta.pv_id', 'pv.id')
		->leftJoin('pv_priority_list as pvl', 'pvl.pv_id', 'pv.id')
		->whereIn('pt.code', ['Other'])
		->whereMonth('pv.created_at', date('m'))
		->where('sta.current_status_id', '<>', 12)
		->count();

		$pvs['repair_warranty'] = DB::table('warranty as wa')->selectRaw('pt.name as type_name, COUNT(*) as total')
			->join('physical_verification as pv', 'pv.id', 'wa.pv_id')
			->join('ma_product_type as pt', 'pt.id', 'pv.producttype_id')
			->join('pv_status as sta', 'sta.pv_id', 'pv.id')
			->groupBy('pt.code')
			->get();
    	return $pvs;
    }

}