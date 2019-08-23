<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SiteMaster;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function Sites(Request $request)
    {
    	$sites = SiteMaster::all();
    	return response()->json(['data' => $sites, 'status' => 'success']);
    }
}
