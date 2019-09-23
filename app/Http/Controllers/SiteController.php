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
        if(SiteMaster::where('code', $site['code'])->first())
        {
            $message = 'Site Code Alredy Exists';
            return response()->json(['status' => 'failure', 'message' => $message], 200);
        }
    	$ST = new SiteMaster();
    	$ST->code = $site['code'];
    	$ST->name = $site['name'];
    	$ST->created_by = Auth::id();
    	$ST->updated_by = Auth::id();
        if (array_key_exists('id',$site))
        {
            $ST->id = $site['id'];
            $ST->update();
            $message = 'Site Updated Successfully';
        }
        else
        {
            $ST->save();
            $message = 'Site Added Successfully';
        }

    	return response()->json(['data' => $ST, 'status' => 'success', 'message' => $message], 200);
    }

    public function DeleteSite($id)
    {
        SiteMaster::destroy($id);
        $message = 'Site Deleted Successfully';
        return response()->json([ 'status' => 'success', 'message' => $message], 200);
    }
}
