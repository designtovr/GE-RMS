<?php

namespace App\Http\Repositories;

use App\Models\PVStatusMaster;
use App\Models\PVStatus;
use App\Models\PVStatusTracking;
use App\Models\OtherRelayStage;
use App\Models\OtherRelayStageTracking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PVStatusRepositories
{

	private function SavePVStatus($pv_id, $status_id)
	{
		if ($pv_id == '' && $status_id == '')
		{
			$message = 'Invalid Data';
			return $message;
		}
		//Storing Data For Tracking
		$PVST = new PVStatusTracking();
		$PVST->pv_id = $pv_id;
		$PVST->status_id = $status_id;
		$PVST->created_at = Carbon::now();
		$PVST->created_by = Auth::id();
		$PVST->save();

		//Storing Current Status
		$PVS = PVStatus::where('pv_id', $pv_id)->first();
		if (!$PVS)
		{
			$PVS = new PVStatus();
			$PVS->pv_id = $pv_id;
			$PVS->current_status_id = $status_id;
			$PVS->created_at = Carbon::now();
			$PVS->created_by = Auth::id();
			$PVS->save();
		}
		else
		{
			$PVS  = array();
			$PVS['current_status_id'] = $status_id;
			$PVS['created_at'] = Carbon::now();
			$PVS['created_by'] = Auth::id();
			PVStatus::where('pv_id', $pv_id)->update($PVS);
		}

		$message = 'Status Saved';

	}

	public static function ChangeStatusToRelayWithOutRMA($pv_id)
	{
		$status_id = 1;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToRelayWithRMA($pv_id)
	{
		$status_id = 2;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToSaved($pv_id)
	{
		$status_id = 15;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToManagerApproval($pv_id)
	{
		$status_id = 13;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToCustomerApproval($pv_id)
	{
		$status_id = 3;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToManagerApproved($pv_id)
	{
		$status_id = 4;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToJobTicketStarted($pv_id)
	{
		$status_id = 5;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToJobTicketCompleted($pv_id)
	{
		$status_id = 6;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToAutoTestBenchStarted($pv_id)
	{
		$status_id = 7;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToAutoTestBenchCompleted($pv_id)
	{
		$status_id = 8;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToAgingStarted($pv_id)
	{
		$status_id = 9;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToAgingCompleted($pv_id)
	{
		$status_id = 10;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToVerificationCompleted($pv_id)
	{
		$status_id = 11;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToDispatchApproved($pv_id)
	{
		$status_id = 14;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToDispatchced($pv_id)
	{
		$status_id = 12;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function ChangeStatusToOtherRelay($pv_id)
	{
		$status_id = 16;
		(new self)->SavePVStatus($pv_id, $status_id);
	}

	public static function SetOtherRelayStageValues($pv_id, $current_stage, $comments='')
	{
		$exists = OtherRelayStage::where('pv_id', $pv_id)->first();
		if($exists)
		{
			$ORS = OtherRelayStage::where('pv_id', $pv_id)->update([
				'current_stage' => $current_stage,
				'comments' => $comments,
				'updated_by' => Auth::id(),
				'updated_at' => Carbon::now()
			]);
		}
		else
		{
			$ORS = new OtherRelayStage();
			$ORS->pv_id = $pv_id;
			$ORS->current_stage = $current_stage;
			$ORS->comments = $comments;
			$ORS->created_by = Auth::id();
			$ORS->created_at = Carbon::now();
			$ORS->save();
		}

		if($current_stage == 3 || $current_stage == 4)
		{
			(new self)->ChangeStatusToVerificationCompleted($pv_id);
		}

		$ORST = new OtherRelayStageTracking();
		$ORST->pv_id = $pv_id;
		$ORST->stage_id = $current_stage;
		$ORST->comments = $comments;
		$ORST->created_by = Auth::id();
		$ORST->created_at = Carbon::now();
		$ORST->save();
	}

}