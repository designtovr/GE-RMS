<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ManufactureMaster;
use Illuminate\Support\Facades\Auth;

class ManufactureController extends Controller
{
    public function Manufactures(Request $request)
    {
    	$manufactures = ManufactureMaster::all();
    	return response()->json(['data' => $manufactures, 'status' => 'success']);
    }
}
