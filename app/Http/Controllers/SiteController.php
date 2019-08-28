<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SiteMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddSiteRequest;

class SiteController extends Controller
{
    public function Sites(Request $request)
    {
    	$sites = SiteMaster::all();
    	return response()->json(['data' => $sites, 'status' => 'success']);
    }

    public function AddSite(AddSiteRequest $request)
    {
    	$site = $request->get('site');
    	$ST = new SiteMaster();
    	$ST->code = $site['code'];
    	$ST->name = $site['name'];
    	$ST->created_by = Auth::id();
    	$ST->updated_by = Auth::id();
    	$ST->save();

    	return response()->json(['data' => $ST, 'status' => 'success', 'messagae' => 'Site Added Successfully'], 200);
    }
}
