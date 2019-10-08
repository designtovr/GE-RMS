<?php

namespace App\Http\Controllers;

use App\Models\RMSMaster;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddRMSRequest;
use Carbon\Carbon;

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
        $exists = true;
        $RM = null;
        if (array_key_exists('rid', $rms))
            $RM = RMSMaster::where('rid', $rms['rid'])->first();

        if (!$RM) {
            $RM = new RMSMaster();
            $exists = false;
        }

        $RM->rid = $rms['rid'];
        $RM->rack = $rms['rack'];
        $dt = Carbon::now();
        $RM->moved_date = $dt->toDateString(); 

        if ($exists) {
            $RM->updated_by = Auth::id();
            $RM->updated_at = Carbon::now();
            $RM->update();
            $message = 'Relay Updated Successfully';
        } else {
            $RM->created_by = Auth::id();
            $RM->updated_by = Auth::id();
            $RM->created_at = Carbon::now();
            $RM->updated_at = Carbon::now();
            $RM->save();
            $message = 'Relay Added Successfully';
        }


        return response()->json(['status' => 'success', 'message' => $message], 200);
    }
}
