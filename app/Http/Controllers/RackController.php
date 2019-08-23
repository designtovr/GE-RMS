<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RackMaster;
use Illuminate\Support\Facades\Auth;

class RackController extends Controller
{
    public function Racks(Request $request)
    {
    	$racks = RackMaster::all();
    	return response()->json(['data' => $racks, 'status' => 'success']);
    }
}
