<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveTestResultRequest;
use App\Http\Repositories\PVStatusRepositories;
use Carbon\Carbon;
use App\Models\AutoTestBench;
use App\Models\AutoTestBenchTracking;

class AutoTestBenchController extends Controller
{
    public function SaveTestResult(SaveTestResultRequest $request)
    {
    	$pvids = $request->get('pvids');
    	$test = $request->get('test');
    	foreach ($pvids as $key => $pv_id) {
            //saving current result to main table
            $ATB = AutoTestBench::where('pv_id', $pv_id)->first();
            if ($ATB)
            {
                AutoTestBench::where('pv_id', $pv_id)->update(['result' => $test['result'], 'comment' => (array_key_exists('comment', $test))?$test['comment']:'', 'updated_at' => Carbon::now(), 'updated_by' => Auth::id()]);
            }
            else
            {
                $ATB = new AutoTestBench();
                $ATB->pv_id = $pv_id;
                $ATB->result = $test['result'];
                $ATB->comment = (array_key_exists('comment', $test))?$test['comment']:'';
                $ATB->created_by = Auth::id();
                $ATB->created_at = Carbon::now();
                $ATB->save();
            }

            //saving data for tracking/report purpose
            $ARBT = new AutoTestBenchTracking();
            $ARBT->pv_id = $pv_id;
            $ARBT->result = $test['result'];
            $ARBT->comment = (array_key_exists('comment', $test))?$test['comment']:'';
            $ARBT->created_at = Carbon::now();
            $ARBT->created_by = Auth::id();
            $ARBT->save();

    		if ($test['result'] == 1)
    		{
    			PVStatusRepositories::ChangeStatusToAutoTestBenchCompleted($ATB->pv_id);
    		}
    	}

    	return response()->json(['status' => 'success', 'message' => 'Test Result Saved Successfully'], 200);
    }
}
