<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductMaster;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function Products(Request $request)
    {
    	$products = ProductMaster::all();
    	return response()->json(['data' => $products, 'status' => 'success']);
    }
}
