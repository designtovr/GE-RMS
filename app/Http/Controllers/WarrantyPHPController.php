<?php

namespace App\Http\Controllers;

use App\Models\WarrantyMaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerLocationTransaction;
use App\Models\CustomerSiteTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddWarrantyRequest;
use App\Http\Requests\AddPhysicalVerificationRequest;
use Carbon\Carbon;

class WarrantyPHPController extends Controller
{
    public function Receipts(Request $request)
    {
        $warranty= WarrantyMaster::selectRaw('warranty.*')->get();
        return response()->json(['data' => $warranty, 'status' => 'success']);
    }

    public function AddWarranty(AddWarrantyRequest $request)
    {
        $warranty = $request->get('warranty');
        $pvs = $request->get('pvs');

        foreach ($pvs as $key => $pv) {
            $WM = new WarrantyMaster();

            $WM->pv_id = $pv;
            $WM->smp = $warranty['smp'];
            $WM->pcp = $warranty['pcp'];
            $WM->type = $warranty['type'];
            $WM->move = $warranty['move'];
            $WM->rca = $warranty['rca'];
            $WM->comment = (array_key_exists('comment', $WM))?$warranty['comment']:'';
            if (in_array($pv, $warranty['selectedRID'])) {
                $WM->mail_to = implode(',', $warranty['selectedPeople']);
                $WM->cc = implode(',', $warranty['selectedCCPeople']);
                $WM->message = $warranty['message'];
            }
            $WM->po = (array_key_exists('po', $warranty))?$warranty['po']:'';
            $WM->wbs = (array_key_exists('wbs', $warranty))?$warranty['wbs']:'';

            $WM->created_by = Auth::id();
            $WM->updated_by = Auth::id();
            $WM->created_at = Carbon::now();
            $WM->updated_at = Carbon::now();
            $WM->save();

        }
        $message = 'Warranty Saved Successfully';

        return response()->json(['status' => 'success', 'message' => $message], 200);
    }
}
