<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RackTypeMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddRackTypeRequest;

class RackTypeController extends Controller
{
    public function RackTypes(Request $request)
    {
    	$rack_types = RackTypeMaster::all();
    	return response()->json(['data' => $rack_types, 'status' => 'success']);
    }

    public function AddRackType(AddRackTypeRequest $request)
    {
    	$racktype = $request->get('racktype');
    	$RT = new RackTypeMaster();
    	$RT->name = $racktype['name'];
    	$RT->created_by = Auth::id();
    	$RT->updated_by = Auth::id();
    	$RT->save();

    	return response()->json(['data' => $RT, 'status' => 'success', 'messagae' => 'Rack Type Added Successfully'], 200);
    }
}
