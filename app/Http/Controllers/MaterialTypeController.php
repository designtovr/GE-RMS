<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MaterialTypeMaster;
use Illuminate\Support\Facades\Auth;

class MaterialTypeController extends Controller
{
    public function MaterialTypes(Request $request)
    {
    	$materialtypes = MaterialTypeMaster::all();
    	return response()->json(['data' => $materialtypes, 'status' => 'success']);
    }
}
