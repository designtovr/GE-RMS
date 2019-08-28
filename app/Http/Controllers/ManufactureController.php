<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ManufactureMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddManufactureRequest;

class ManufactureController extends Controller
{
    public function Manufactures(Request $request)
    {
    	$manufactures = ManufactureMaster::all();
    	return response()->json(['data' => $manufactures, 'status' => 'success']);
    }

    public function AddManufacture(AddManufactureRequest $request)
    {
    	$manufacture = $request->get('manufacture');
    	$MU = new ManufactureMaster();
    	$MU->code = $manufacture['code'];
    	$MU->name = $manufacture['name'];
    	$MU->created_by = Auth::id();
    	$MU->updated_by = Auth::id();
    	$MU->save();

    	return response()->json(['data' => $MU, 'status' => 'success', 'messagae' => 'Manufacture Added Successfully'], 200);
    }
}
