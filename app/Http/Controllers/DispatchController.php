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
use App\Http\Repositories\PVPriorityRepositories;
use App\Http\Repositories\PVStatusRepositories;
use Carbon\Carbon;
use App\Http\Repositories\RMSRepositories;

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
        $DM->pv_id = $dispatch['id'];
        $DM->dc_no = $dispatch['dc_no'];
        $DM->docket_details = $dispatch['docket_details'];
        $DM->rma_id = $dispatch['rma_id'];
        $DM->courier_name = $dispatch['courier_name'];
        $DM->person_name = $dispatch['person_name'];
        $DM->created_by = Auth::id();
        $DM->save();

        //change pv status
        PVStatusRepositories::ChangeStatusToDispatchced($DM->pv_id);
        //re-order the priority
        PVPriorityRepositories::ChangingPriorityAfterDispatching($DM->pv_id);
        //delete from RMS
        RMSRepositories::DeleteRMS($DM->pv_id);

        return response()->json(['data' => $DM, 'status' => 'success', 'message' => 'Dispatch Added Successfully'], 200);
    }
}
