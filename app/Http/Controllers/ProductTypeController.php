<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductTypeMaster;
use Illuminate\Support\Facades\Auth;

class ProductTypeController extends Controller
{
    public function ProductTypes(Request $request)
    {
    	$producttypes = ProductTypeMaster::all();
    	return response()->json(['data' => $producttypes, 'status' => 'success']);
    }
}
