<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveAgingResultRequest;
use App\Http\Repositories\PVStatusRepositories;
use Carbon\Carbon;
use App\Models\Aging;
use App\Models\AgingTracking;

class AgingController extends Controller
{
    public function SaveAgingResult(SaveAgingResultRequest $request)
    {
    	$pvids = $request->get('pvids');
    	$test = $request->get('test');
    	foreach ($pvids as $key => $pv_id) {
            //save aging corret result
            $AG = Aging::where('pv_id', $pv_id)->first();
            if ($AG)
            {
                Aging::where('pv_id', $pv_id)->update(['result' => $test['result'], 'comment' => (array_key_exists('comment', $test))?$test['comment']:'', 'updated_by' => Auth::id(), 'updated_at' => Carbon::now()]);
            }
            else
            {
                $AG = new Aging();
                $AG->pv_id = $pv_id;
                $AG->result = $test['result'];
                $AG->comment = (array_key_exists('comment', $test))?$test['comment']:'';
                $AG->created_by = Auth::id();
                $AG->created_at = Carbon::now();
                $AG->save();
            }

            //saving aging result for report/tracking purpose
            $AGT = new AgingTracking();
            $AGT->pv_id = $pv_id;
            $AGT->result = $test['result'];
            $AGT->comment = (array_key_exists('comment', $test))?$test['comment']:'';
            $AGT->created_by = Auth::id();
            $AGT->created_at = Carbon::now();
            $AGT->save();

    		if ($test['result'] == 1)
    		{
    			PVStatusRepositories::ChangeStatusToAgingCompleted($AG->pv_id);
    		}
    	}

    	return response()->json(['status' => 'success', 'message' => 'Aging Saved Successfully'], 200);
    }
}
