<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LocationMaster;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function Locations(Request $request)
    {
    	$locations = LocationMaster::all();
    	return response()->json(['data' => $locations, 'status' => 'success']);
    }
}
