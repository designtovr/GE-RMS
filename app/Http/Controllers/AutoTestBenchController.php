<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveTestResultRequest;
use App\Http\Repositories\PVStatusRepositories;
use Carbon\Carbon;
use App\Models\AutoTestBench;

class AutoTestBenchController extends Controller
{
    public function SaveTestResult(SaveTestResultRequest $request)
    {
    	$pvids = $request->get('pvids');
    	$test = $request->get('test');
    	foreach ($pvids as $key => $pv_id) {
    		$ATB = new AutoTestBench();
    		$ATB->pv_id = $pv_id;
    		$ATB->result = $test['result'];
    		$ATB->comment = (array_key_exists('comment', $test))?$test['comment']:'';
    		$ATB->created_by = Auth::id();
    		$ATB->created_at = Carbon::now();
    		$ATB->save();

    		if ($test['result'] == 1)
    		{
    			PVStatusRepositories::ChangeStatusToAutoTestBenchCompleted($ATB->pv_id);
    		}
    	}

    	return response()->json(['status' => 'success', 'message' => 'Test Result Saved Successfully'], 200);
    }
}
