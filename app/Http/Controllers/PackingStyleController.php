<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PackingStyleMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddPackingStyleRequest;

class PackingStyleController extends Controller
{
    public function PackingStyles(Request $request)
    {
    	$packingstyles = PackingStyleMaster::all();
    	return response()->json(['data' => $packingstyles, 'status' => 'success']);
    }

    public function AddPackingStyle(AddPackingStyleRequest $request)
    {
    	$packingstyle = $request->get('packingstyle');
    	$PS = new PackingStyleMaster();
    	$PS->code = $packingstyle['code'];
    	$PS->name = $packingstyle['name'];
    	$PS->created_by = Auth::id();
    	$PS->updated_by = Auth::id();
    	$PS->save();

    	return response()->json(['data' => $PS, 'status' => 'success', 'message' => 'Rack Added Successfully'], 200);
    }
}
