<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\PhysicalVerificationMaster;
use App\Models\RMSMaster;
use App\Models\PVRmsTracking;


class RMSRepositories
{
	private function SaveRMS($pv_id, $rack_id, $rack_type)
	{
		//saving RMS
		$rack_type = 0;
		$RM = RMSMaster::where('pv_id', $pv_id)->first();
		if ($RM)
		{
			$rack_type = $RM->rack_type;
			RMSMaster::where('pv_id', $pv_id)->update(['rack_id' => $rack_id, 'rack_type' => $RM->rack_type, 'moved_date' => Carbon::today(), 'updated_at' => Carbon::now(), 'updated_by' => Auth::id()]);
		}
		else
		{
			$RM = new RMSMaster();
			$RM->pv_id = $pv_id;
			$RM->rack_id = $rack_id;
			$RM->rack_type = $rack_type;
			$RM->moved_date = Carbon::today();
			$RM->created_at = Carbon::now();
			$RM->created_by = Auth::id();
			$RM->updated_at = Carbon::now();
			$RM->updated_by = Auth::id();
			$RM->save();
		}

		//Saving RMS Tracking
		$RMT = new PVRmsTracking();
		$RMT->pv_id = $pv_id;
		$RMT->rack_id = $rack_id;
		$RMT->rack_type = $rack_type;
		$RMT->created_by = Auth::id();
		$RMT->created_at = Carbon::now();
		$RMT->save();
	}

	public static function MoveRelayToPhysicalVerificationRack($pv_id, $rack_id='')
	{
		(new self)->SaveRMS($pv_id, '', 5);
	}

	public static function MoveRelayToRepairRack($pv_id, $rack_id='')
	{
		(new self)->SaveRMS($pv_id, '', 1);
	}

	public static function MoveRelayToCustomerHoldRack($pv_id, $rack_id='')
	{
		(new self)->SaveRMS($pv_id, '', 2);
	}

	public static function MoveRelayToPostLab($pv_id, $rack_id='')
	{
		(new self)->SaveRMS($pv_id, '', 3);
	}

	public static function MoveRelayToApplicationLab($pv_id, $rack_id='')
	{
		(new self)->SaveRMS($pv_id, '', 4);
	}

	public static function MoveRelayToId($pv_id, $rack_id, $rack_type='')
	{
		(new self)->SaveRMS($pv_id, $rack_id, $rack_type);
	}
}