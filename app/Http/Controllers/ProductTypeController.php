<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductTypeMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddProductTypeRequest;

class ProductTypeController extends Controller
{
    public function ProductTypes(Request $request)
    {
    	$producttypes = ProductTypeMaster::all();
    	return response()->json(['data' => $producttypes, 'status' => 'success']);
    }

    public function AddProductType(AddProductTypeRequest $request)
    {
    	$producttype = $request->get('producttype');
    	$PT = new ProductTypeMaster();
    	$PT->code = $producttype['code'];
    	$PT->name = $producttype['name'];
    	$PT->created_by = Auth::id();
    	$PT->updated_by = Auth::id();
    	$PT->save();

    	return response()->json(['data' => $PT, 'status' => 'success', 'messagae' => 'Product Type Added Successfully'], 200);
    }
}
