<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MaterialMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddMaterialRequest;

class MaterialController extends Controller
{
    public function Materials(Request $request)
    {
    	$materials = MaterialMaster::selectRaw('ma_material.id, ma_material.part_no, ma_material.description, mt.name as type')->leftJoin('ma_material_type as mt', 'mt.id', 'ma_material.type')->orderBy('ma_material.id')->get();
    	return response()->json(['data' => $materials, 'status' => 'success']);
    }

    public function AddMaterial(AddMaterialRequest $request)
    {
    	$material = $request->get('material');
    	$MAT = new MaterialMaster();
    	$MAT->part_no = $material['part_no'];
    	$MAT->description = $material['description'];
    	$MAT->type = $material['type'];
    	$MAT->created_by = Auth::id();
    	$MAT->updated_by = Auth::id();
    	$MAT->save();

    	return response()->json(['data' => $MAT, 'status' => 'success', 'message' => 'Material Added Successfully'], 200);
    }
}
