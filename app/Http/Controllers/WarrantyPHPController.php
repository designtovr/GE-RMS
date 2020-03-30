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
use App\Http\Requests\UpdateWarrantyRequest;
use App\Http\Requests\AddPhysicalVerificationRequest;
use Carbon\Carbon;
use App\Http\Repositories\PVStatusRepositories;
use App\Http\Repositories\RMSRepositories;
use App\Http\Repositories\MailRepository;

class WarrantyPHPController extends Controller
{

    protected $mailRepository;

    function __construct(MailRepository $mailRepository)
    {
        $this->mailRepository = $mailRepository;
    }


    public function Receipts(Request $request)
    {
        $warranty= WarrantyMaster::selectRaw('warranty.*')->get();
        return response()->json(['data' => $warranty, 'status' => 'success']);
    }

    public function AddWarranty(AddWarrantyRequest $request)
    {
        $warranty = $request->get('warranty');
        $pvs = $request->get('pvs');
        $mail_result = 'Mail Not Initiated';

        foreach ($pvs as $key => $pv) {

            $WM = WarrantyMaster::where('pv_id', $pv)->first();
            $exists = false;
            if($WM)
            {
                $exists = true;
            }
            else
            {
                $WM = new WarrantyMaster();
            }

            $WM->pv_id = $pv;
            $WM->smp = $warranty['smp'];
            $WM->pcp = $warranty['pcp'];
            $WM->type = $warranty['type'];
            $WM->move = $warranty['move'];
            $WM->rca = $warranty['rca'];
            $WM->comment = (array_key_exists('comment', $warranty))?$warranty['comment']:'';
            if (array_key_exists('selectedRID', $warranty) && in_array($pv, $warranty['selectedRID'])) {
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
            if($exists)
            {
                $WM->update();
            }
            else
            {
                $WM->save();
            }

            if ($WM->move == 1)
            {
                PVStatusRepositories::ChangeStatusToManagerApproved($pv);
            }
            else if ($WM->move == 2) {
                PVStatusRepositories::ChangeStatusToCustomerApproval($pv);
            }
            $mail_result = $this->mailRepository->WCCompletionMail($WM, $warranty['addcc']);

            $rms_response = RMSRepositories::MoveRelayToId($pv, '', $WM->move);

        }
        $message = 'Warranty Saved Successfully';
        $rca_mail_result = 'Not Required';
        if(array_key_exists('rca', $warranty) && $warranty['rca'])
        {
            $rca_mail_to = array_merge($warranty['selectedPeople'], $warranty['addmailarray']);
            $rca_mail_cc = array_merge($warranty['selectedCCPeople'], $warranty['addccarray']);
            $rca_mail_result = $this->mailRepository->RCAMail($rca_mail_to, $rca_mail_cc, $warranty['subject'], $warranty['message']);
        }

        return response()->json(['status' => 'success', 'message' => $message, 'mail_result' => $mail_result, 'rca_mail_result' => $rca_mail_result], 200);
    }

    public function UpdateWarranty(UpdateWarrantyRequest $request)
    {
        $warranty = $request->get('warranty');
        $rca_mail_result = 'Not Required';
        if(array_key_exists('rca', $warranty) && $warranty['rca'])
        {
            $rca_mail_to = array_merge($warranty['selectedPeople'], $warranty['addmailarray']);
            $rca_mail_cc = array_merge($warranty['selectedCCPeople'], $warranty['addccarray']);
            $rca_mail_result = $this->mailRepository->RCAMail($rca_mail_to, $rca_mail_cc, $warranty['subject'], $warranty['message']);
        }

        $WM = WarrantyMaster::where('id', $warranty['id'])->first();
        $WM->pv_id = $warranty['pv_id'];
        $WM->smp = $warranty['smp'];
        $WM->pcp = $warranty['pcp'];
        $WM->type = $warranty['type'];
        $WM->move = $warranty['move'];
        $WM->rca = $warranty['rca'];
        $WM->comment = (array_key_exists('comment', $WM))?$warranty['comment']:'';
        if (array_key_exists('selectedRID', $warranty) && in_array($pv, $warranty['selectedRID'])) {
            $WM->mail_to = implode(',', $warranty['selectedPeople']);
            $WM->cc = implode(',', $warranty['selectedCCPeople']);
            $WM->message = $warranty['message'];
        }
        $WM->po = (array_key_exists('po', $warranty))?$warranty['po']:'';
        $WM->wbs = (array_key_exists('wbs', $warranty))?$warranty['wbs']:'';
        $WM->updated_by = Auth::id();
        $WM->updated_at = Carbon::now();
        $WM->update();

        if ($WM->move == 1)
        {
            PVStatusRepositories::ChangeStatusToManagerApproved($WM->pv_id);
        }
        else if ($WM->move == 2) {
            PVStatusRepositories::ChangeStatusToCustomerApproval($WM->pv_id);
        }

        $mail_result = $this->mailRepository->WCCompletionMail($WM, $warranty['addcc']);

        $rca_mail_result = 'Not Required';
        if(array_key_exists('rca', $warranty) && $warranty['rca'])
        {
            $rca_mail_to = array_merge($warranty['selectedPeople'], $warranty['addmailarray']);
            $rca_mail_cc = array_merge($warranty['selectedCCPeople'], $warranty['addccarray']);
            $rca_mail_result = $this->mailRepository->RCAMail($rca_mail_to, $rca_mail_cc, $warranty['subject'], $warranty['message']);
        }

        return response()->json(['status' => 'success', 'message' => 'Warranty Updated Successfully', 'mail_result' => $mail_result, 'rca_mail_result' => $rca_mail_result], 200);
    }

    public function GetWarranty($pv_id)
    {
        $wr = WarrantyMaster::where('pv_id', $pv_id)->first();

        return response()->json(['status' => 'success', 'data' => $wr], 200);
    }
}
