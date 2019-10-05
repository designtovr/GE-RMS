<?php

namespace App\Http\Repositories;

use App\Models\PhysicalVerificationMaster;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PVListingRepository
{

	private function PVList($status_id)
	{
		$pv = PhysicalVerificationMaster::selectRaw('physical_verification.*,receipt.gs_no, receipt.customer_name,receipt.end_customer,pr.part_no,pt.category,ma_pv_status.status, ma_pv_status.close_status')->leftJoin('receipt', 'physical_verification.receipt_id', 'receipt.id')->leftJoin('ma_product as pr', 'pr.id', 'physical_verification.product_id')->leftJoin('ma_product_type as pt', 'pt.id', 'physical_verification.producttype_id')->leftJoin('pv_status', 'pv_status.pv_id', 'physical_verification.id')->leftJoin('ma_pv_status', 'ma_pv_status.id', 'pv_status.current_status_id')->whereNotIn('pt.category', ["'omu'","'boj'"])->where('pv_status.current_status_id', $status_id)->get();
		return $pv;
	}

	public static function WithoutRma()
	{
		$status_id = 1;
		return (new self)->PVList($status_id);
	}

	public static function WithRma()
	{
		$status_id = 2;
		return (new self)->PVList($status_id);
	}

	public static function WaitingForManagerApproval()
	{
		$status_id = 13;
		return (new self)->PVList($status_id);
	}

	public static function WaitingForCustomerApproval()
	{
		$status_id = 3;
		return (new self)->PVList($status_id);
	}

	public static function ManagerApproved()
	{
		$status_id = 4;
		return (new self)->PVList($status_id);
	}

	public static function JobTicketOpen()
	{
		return (new self)->ManagerApproved();
	}

	public static function JobTicketStarted()
	{
		$status_id = 5;
		return (new self)->PVList($status_id);
	}

	public static function JobTicketCompleted()
	{
		$status_id = 6;
		return (new self)->PVList($status_id);
	}

	public static function AutoTestBenchOpen()
	{
		return (new self)->JobTicketCompleted();
	}

	public static function AutoTestBenchStarted()
	{
		$status_id = 7;
		return (new self)->PVList($status_id);
	}

	public static function AutoTestBenchCompleted()
	{
		$status_id = 8;
		return (new self)->PVList($status_id);
	}

	public static function AgingStarted()
	{
		$status_id = 9;
		return (new self)->PVList($status_id);
	}

	public static function AgingCompleted()
	{
		$status_id = 10;
		return (new self)->PVList($status_id);
	}

	public static function WaitingForVerification()
	{
		return (new self)->AgingCompleted();
	}

	public static function VerificationCompleted()
	{
		$status_id = 11;
		return (new self)->PVList($status_id);
	}

	public static function WaitingFOrDispatchApproval()
	{
		return (new self)->VerificationCompleted();
	}

	public static function Dispatched()
	{
		$status_id = 12;
		return (new self)->PVList($status_id);
	}

}