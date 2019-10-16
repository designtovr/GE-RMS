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

class RMSController extends Controller
{
    public function RMS(Request $request)
    {
        $rms = RMSMaster::selectRaw('rms.*')->get();
        return response()->json(['data' => $rms, 'status' => 'success']);
    }

/*    public function GetReceipt($id)
    {
        $receipt = ReceiptMaster::selectRaw('receipt.*')->where('receipt.id', $id)->first();
        return response()->json(['receipt' => $receipt], 200);
    }*/

    public function AddRMS(AddRMSRequest $request)
    {
        $rms = $request->get('rms');
        if (!isset($rms['rack_type']))
            $rms['rack_type'] = '';
            
        RMSRepositories::MoveRelayToId($rms['pv_id'], $rms['rack_id'], $rms['rack_type']);

        return response()->json(['status' => 'success', 'message' => 'Relay Updated Successfully'], 200);
    }
}
