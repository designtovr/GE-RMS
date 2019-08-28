<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function Roles(Request $request)
    {
    	$roles = Role::all();
        return response()->json(['data' => $roles, 'status' => 'success']);
    }
}
