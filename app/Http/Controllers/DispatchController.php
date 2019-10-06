<?php

namespace App\Http\Controllers;

use App\Models\DispatchMaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerLocationTransaction;
use App\Models\CustomerSiteTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddDispatchRequest;
use Carbon\Carbon;

class DispatchController extends Controller
{
    public function Dispatches(Request $request)
    {
        $dispatch = DispatchMaster::selectRaw('dispatch.*,dispatch_no,date, rid_no ,dc_no,docket_details,rma_no,courier_name,person_name')->get();
        return response()->json(['data' => $dispatch, 'status' => 'success']);
    }

    public function GetDispatch($id)
    {
        $dispatch = DispatchMaster::selectRaw('dispatch.*,dispatch_no.*,date, rid_no ,dc_no,docket_details,rma_no,courier_name,person_name')->first();
        return response()->json(['receipt' => $dispatch], 200);
    }

    public function AddDispatch(AddDispatchRequest $request)
    {
        $dispatch = $request->get('dispatch');
        $DM = new DispatchMaster();
        $date = Carbon::createFromFormat('d/m/Y',$dispatch['date']);
        $DM->date = $date->format('Y-m-d');
        $DM->rid_no = $dispatch['id'];
        $DM->dc_no = $dispatch['dc_no'];
        $DM->docket_details = $dispatch['docket_details'];
        $DM->rma_no = $dispatch['rma_id'];
        $DM->courier_name = $dispatch['courier_name'];
        $DM->person_name = $dispatch['person_name'];

        /* $DM->created_by = Auth::id();
          $DM->updated_by = Auth::id();
          $DM->created_at = Carbon::now();
          $DM->updated_at = Carbon::now();*/
        $DM->save();

        /*  $CST = new CustomerSiteTransaction();
          $CST->customer_id = $CM->id;
          $CST->site_id = $customer['site_id'];
          $CST->created_by = Auth::id();
          $CST->updated_at = Auth::id();
          $CST->save();
  
          $CLT = new CustomerLocationTransaction();
          $CLT->customer_id = $CM->id;
          $CLT->location_id = $customer['location_id'];
          $CLT->created_by = Auth::id();
          $CLT->updated_by = Auth::id();
          $CLT->save();*/

        return response()->json(['data' => $DM, 'status' => 'success', 'messagae' => 'Dispatch Added Successfully'], 200);
    }
}
