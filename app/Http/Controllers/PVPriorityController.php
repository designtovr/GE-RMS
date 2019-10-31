<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\PVPriorityRepositories;

class PVPriorityController extends Controller
{
    public function PriorityList(Request $request)
    {
    	$data = PVPriorityRepositories::PriorityList();
    	return response()->json(['status' => 'success', 'data' => $data['list'], 'max' => $data['max']], 200);
    }

    public function SetPvPriority(Request $request)
    {
    	$pv_id = $request->get('pv_id');
    	$priority = $request->get('priority');
    	$result = PVPriorityRepositories::SetPvPriority($pv_id, $priority);
    	return response()->json(['status' => 'success', 'message' => $result], 200);
    }
}
