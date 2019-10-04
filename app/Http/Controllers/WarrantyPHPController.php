<?php

namespace App\Http\Controllers;

use App\Models\WarrantyMaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerLocationTransaction;
use App\Models\CustomerSiteTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddReceiptRequest;
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
        $warranty = $request->get('warrantymodal');

        $WM = new WarrantyMaster();

        $WM->rid =$warranty['rid_no'];
        $WM->smp =$warranty['smp'];
        $WM->pcp =$warranty['pcp'];
        $WM->type =$warranty['type'];
        $WM->move =$warranty['move'];
        $WM->rca =$warranty['rca'];
        $WM->comment =$warranty['comment'];
        $WM->po =$warranty['po'];
        $WM->wbs =$warranty['wbs'];
        $WM->mail_to =$warranty['mail_to'];
        $WM->cc =$warranty['cc'];


        $WM->created_by = Auth::id();
        $WM->updated_by = Auth::id();
        $WM->created_at = Carbon::now();
        $WM->updated_at = Carbon::now();
        $WM->save();
        $message = 'Warranty Saved Successfully';



        return response()->json(['status' => 'success', 'message' => $message], 200);
    }
}
