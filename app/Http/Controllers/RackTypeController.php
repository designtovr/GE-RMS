<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RackTypeMaster;
use Illuminate\Support\Facades\Auth;

class RackTypeController extends Controller
{
    public function RackTypes(Request $request)
    {
    	$rack_types = RackTypeMaster::all();
    	return response()->json(['data' => $rack_types, 'status' => 'success']);
    }
}
