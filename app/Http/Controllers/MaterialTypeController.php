<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MaterialTypeMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddMaterialTypeRequest;

class MaterialTypeController extends Controller
{
    public function MaterialTypes(Request $request)
    {
    	$materialtypes = MaterialTypeMaster::all();
    	return response()->json(['data' => $materialtypes, 'status' => 'success']);
    }

    public function AddMaterialType(AddMaterialTypeRequest $request)
    {
    	$materialtype = $request->get('materialtype');
    	$MT = new MaterialTypeMaster();
    	$MT->code = $materialtype['code'];
    	$MT->name = $materialtype['name'];
    	$MT->created_by = Auth::id();
    	$MT->updated_by = Auth::id();
    	$MT->save();

    	return response()->json(['data' => $MT, 'status' => 'success', 'message' => 'Material Type Added Successfully'], 200);
    }
}
