<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerMaster;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function Customers(Request $request)
    {
    	$customers = CustomerMaster::all();
    	return response()->json(['data' => $customers, 'status' => 'success']);
    }
}
