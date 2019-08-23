<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PackingStyleMaster;
use Illuminate\Support\Facades\Auth;

class PackingStyleController extends Controller
{
    public function PackingStyles(Request $request)
    {
    	$packingstyles = PackingStyleMaster::all();
    	return response()->json(['data' => $packingstyles, 'status' => 'success']);
    }
}
