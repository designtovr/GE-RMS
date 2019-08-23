<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MaterialMaster;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function Materials(Request $request)
    {
    	$materials = MaterialMaster::all();
    	return response()->json(['data' => $materials, 'status' => 'success']);
    }
}
