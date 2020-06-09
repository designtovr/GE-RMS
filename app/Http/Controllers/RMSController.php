<?php

namespace App\Http\Controllers;

use App\Models\PhysicalVerificationMaster;
use App\Models\RMSMaster;
use App\Models\PVRmsTracking;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddRMSRequest;
use Carbon\Carbon;
use App\Http\Repositories\RMSRepositories;
use App\Traits\FormatType;

class RMSController extends Controller
{
    public function RMS(Request $request)
    {
        $rms = RMSMaster::selectRaw('rms.*  , ROUND(UNIX_TIMESTAMP(rms.moved_date) * 1000) as date_unix')->get();
        return response()->json(['data' => $rms, 'status' => 'success']);
    }

    /*public function GetReceipt($id)
    {
        $receipt = ReceiptMaster::selectRaw('receipt.*')->where('receipt.id', $id)->first();
        return response()->json(['receipt' => $receipt], 200);
    }*/

    public function AddRMS(AddRMSRequest $request)
    {
        $rms = $request->get('rms');
        $pos = strpos($rms['pv_id'], FormatType::R);
        if(!is_numeric($pos))
        {
            return response()->json(['status' => 'failure', 'message' => 'Invalid RId Format'], 200);
        }
        if(!ctype_digit(substr($rms['pv_id'], $pos+1, strlen($rms['pv_id'])-1)))
        {
            return response()->json(['status' => 'failure', 'message' => 'Invalid RID'], 200);
        }
        $rms['pv_id'] = substr($rms['pv_id'], $pos+1, strlen($rms['pv_id'])-1);
        if (!isset($rms['rack_type']))
            $rms['rack_type'] = '';
            
        RMSRepositories::MoveRelayToId($rms['pv_id'], $rms['rack_id'], $rms['rack_type']);

        return response()->json(['status' => 'success', 'message' => 'Relay Updated Successfully'], 200);
    }
}
