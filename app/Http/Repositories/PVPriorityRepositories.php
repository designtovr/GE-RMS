<?php

namespace App\Http\Repositories;

use App\Models\PhysicalVerificationMaster;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PVPriority;

class PVPriorityRepositories
{

	public static function PriorityList()
	{
		$data['list'] = PVPriority::all();
		$data['max'] = PVPriority::max('priority') + 1;
		return $data;
	}

	public static function SetPvPriority($pv_id, $priority)
	{
		//check priority already exists, 
		//if not exists directly insert
		$result = '';
		$priority_exists = PVPriority::where('priority', $priority)->first();
		if (!$priority_exists)
		{
			//we can directly save, because we only allow new priority value for pv not having priority
			$PV  = new PVPriority();
			$PV->pv_id = $pv_id;
			$PV->priority = $priority;
			$PV->created_by = Auth::id();
			$PV->created_at = Carbon::now();
			$PV->save();

			$result = 'Priority Set Successfully';
		}
		else
		{
			$old_data = PVPriority::where('pv_id', $pv_id)->first();
			//if pv does exists arrange based on value
			if ($old_data)
			{
				$old_priority = $old_data->priority;
				//if old is less than new
				if ($old_priority < $priority)
				{
					//updated time
					PVPriority::where('priority', '>', $old_priority)->where('priority', '<=' , $priority)->update(['updated_at' => Carbon::now(), 'updated_by' => Auth::id()]);
					//arranging others pvs
					PVPriority::where('priority', '>', $old_priority)->decrement('priority');
					//set priorty for given pv
					PVPriority::where('pv_id', $pv_id)->update(['priority' => $priority, 'updated_at' => Carbon::now(), 'updated_by' => Auth::id()]);
				}
				//if old is greater than old
				else if ($old_priority > $priority)
				{
					//updating time
					PVPriority::where('priority', '>=', $priority)->where('priority', '<' , $old_priority)->update(['updated_at' => Carbon::now(), 'updated_by' => Auth::id()]);
					//arranging others pvs
					PVPriority::where('priority', '>=', $priority)->where('priority', '<' , $old_priority)->increment('priority');
					//set priorty for given pv
					PVPriority::where('pv_id', $pv_id)->update(['priority' => $priority, 'updated_at' => Carbon::now(), 'updated_by' => Auth::id()]);
				}
				$result = 'Priority Updated Successfully';
			}
			//if pv doesn't exists
			//directly increment priority
			//and set priority for given pv
			else
			{
				//updating values
				PVPriority::where('priority', '>=', $priority)->update(['updated_at' => Carbon::now(), 'updated_by' => Auth::id()]);
				//assigning others pvs
				PVPriority::where('priority', '>=', $priority)->increment('priority');
				//set priorty for given pv
				$PV = new PVPriority();
				$PV->pv_id = $pv_id;
				$PV->priority = $priority;
				$PV->created_by = Auth::id();
				$PV->created_at = Carbon::now();
				$PV->save();

				$result = 'Priority Set Successfully';
			}
		}

		return $result;
		
	}

}