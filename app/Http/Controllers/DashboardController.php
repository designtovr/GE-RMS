<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\PVListingRepository;

class DashboardController extends Controller
{
    public function GetDashboardValues(Request $request)
    {
    	$result = PVListingRepository::DashBoardValues();
    	return response()->json([
    		'status' => 'success', 
    		'data' => $result
    	], 200);
    }

    public function DashboardValuesNew(Request $request)
    {
    	$result = PVListingRepository::DashboardValuesNew();
    	return response()->json([
    		'status' => 'success', 
    		'data' => $result
    	], 200);
    }
}
