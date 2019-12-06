<?php

namespace App\Http\Repositories;

use App\Models\PhysicalVerificationMaster;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


 class ReportsRepository
 {
 	public function DataForRelaysStageReport()
 	{
 		$relays = PhysicalVerificationMaster::all();
 		return $relays;
 	}

 	public function RelayStageReport($id)
 	{
 		$relay = PhysicalVerificationMaster::find($id);
 		return $relay;
 	}
 } 