<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductTypeMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddProductTypeRequest;
use Carbon\Carbon;

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
        if(array_key_exists('id', $producttype))
        {
            $PT = ProductTypeMaster::find($producttype['id']);
            $PT->code = $producttype['code'];
            $PT->name = $producttype['name'];
            $PT->category = $producttype['category'];
            if (array_key_exists('description', $producttype))
                $PT->description = $producttype['description'];
            $PT->updated_by = Auth::id();
            $PT->updated_at = Carbon::now();
            $PT->update();

            return response()->json(['data' => $PT, 'status' => 'success', 'message' => 'Product Type Updated Successfully'], 200);
        }
        else
        {
            $PT = ProductTypeMaster::where('code', $producttype['code'])->first();
            if ($PT)
                return response()->json(['status' => 'failure', 'message' => 'Product Type Coded Already Exists'], 200);

            $PT = new ProductTypeMaster();
            $PT->code = $producttype['code'];
            $PT->name = $producttype['name'];
            $PT->category = $producttype['category'];
            $PT->description = (array_key_exists('description', $producttype))?$producttype['description']:'';
            $PT->created_by = Auth::id();
            $PT->updated_by = Auth::id();
            $PT->save();

            return response()->json(['data' => $PT, 'status' => 'success', 'message' => 'Product Type Added Successfully'], 200);
        }
    }

    public function DeleteProductType($id)
    {
        ProductTypeMaster::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Product Type Deleted Successfully'], 200);
    }
}
