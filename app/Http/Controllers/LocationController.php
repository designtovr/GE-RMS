<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LocationMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddlocationRequest;

class LocationController extends Controller
{
    public function Locations(Request $request)
    {
    	$locations = LocationMaster::all();
    	return response()->json(['data' => $locations, 'status' => 'success']);
    }

    public function AddLocation(AddlocationRequest $request)
    {
    	$location = $request->get('location');
    	$LO = new LocationMaster();
    	$LO->code = $location['code'];
    	$LO->name = $location['name'];
    	$LO->created_by = Auth::id();
    	$LO->updated_by = Auth::id();
    	$LO->save();

    	return response()->json(['data' => $LO, 'status' => 'success', 'message' => 'Location Added Successfully'], 200);
    }
}
