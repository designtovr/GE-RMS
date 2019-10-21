<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LocationMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddlocationRequest;
use Carbon\Carbon;

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
        if (array_key_exists('id', $location) && $location['id'])
        {
            $LO = LocationMaster::find($location['id']);
            $LO->code = $location['code'];
            $LO->name = $location['name'];
            $LO->updated_at = Carbon::now();
            $LO->updated_by = Auth::id();
            $LO->update();

            return response()->json(['data' => $LO, 'status' => 'success', 'message' => 'Location Updated Successfully'], 200);
        }
        else
        {
            $LO = LocationMaster::where('code', $location['code'])->first();
            if ($LO)
                return response()->json(['status' => 'failure', 'message' => 'Location Code Already Exists'], 200);
            $LO = new LocationMaster();
            $LO->code = $location['code'];
            $LO->name = $location['name'];
            $LO->created_by = Auth::id();
            $LO->updated_by = Auth::id();
            $LO->save();

            return response()->json(['data' => $LO, 'status' => 'success', 'message' => 'Location Added Successfully'], 200);
        }
    	
    }

    public function DeleteLocation($id)
    {
        LocationMaster::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Location Deleted Successfully'], 200);
    }
}
