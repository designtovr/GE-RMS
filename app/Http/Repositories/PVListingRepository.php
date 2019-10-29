<?php

namespace App\Http\Repositories;

use App\Models\PhysicalVerificationMaster;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PVListingRepository
{

	private function PVList($status_id)
	{
		$pv = PhysicalVerificationMaster::
				selectRaw('physical_verification.*,receipt.gs_no, receipt.customer_id, cus.name as customer_name,receipt.end_customer,pr.part_no,pt.category,ma_pv_status.status, ma_pv_status.close_status, rmu.sw_version, rmu.rma_id, rmu.desc_of_fault as customer_comment, warranty.comment as manager_comment, tes.comment as testing_comment, jt.comment as repair_comment, aging.comment as aging_comment')
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
				->whereNotIn('pt.category', ["'omu'","'boj'"])
				->whereIn('pv_status.current_status_id', $status_id)->get();
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

}