<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RackMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddRackRequest;

class RackController extends Controller
{
    public function Racks(Request $request)
    {
    	$racks = RackMaster::selectRaw('ma_rack.*, rt.name as type_name')->leftJoin('ma_rack_type as rt', 'ma_rack.type', 'rt.id')->orderBy('ma_rack.id')->get();
    	return response()->json(['data' => $racks, 'status' => 'success']);
    }

    public function AddRack(Request $request)
    {
    	$rack = $request->get('rack');
    	$RK = new RackMaster();
    	$RK->code = $rack['code'];
    	$RK->name = $rack['name'];
    	$RK->type = $rack['type'];
    	$RK->created_by = Auth::id();
    	$RK->updated_by = Auth::id();
    	$RK->save();

    	return response()->json(['data' => $RK, 'status' => 'success', 'message' => 'Rack Added Successfully'], 200);
    }
}
