<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveAgingResultRequest;
use App\Http\Repositories\PVStatusRepositories;
use Carbon\Carbon;
use App\Models\Aging;

class AgingController extends Controller
{
    public function SaveAgingResult(SaveAgingResultRequest $request)
    {
    	$pvids = $request->get('pvids');
    	$test = $request->get('test');
    	foreach ($pvids as $key => $pv_id) {
    		$AG = new Aging();
    		$AG->pv_id = $pv_id;
    		$AG->result = $test['result'];
    		$AG->comment = (array_key_exists('comment', $test))?$test['comment']:'';
    		$AG->created_by = Auth::id();
    		$AG->created_at = Carbon::now();
    		$AG->save();

    		if ($test['result'] == 1)
    		{
    			PVStatusRepositories::ChangeStatusToAgingCompleted($AG->pv_id);
    		}
    	}

    	return response()->json(['status' => 'success', 'message' => 'Aging Saved Successfully'], 200);
    }
}
