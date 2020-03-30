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
use App\Http\Repositories\MailRepository;

class DispatchController extends Controller
{

    protected $mailRepository;

      function __construct(MailRepository $mailRepository)
      {
        $this->mailRepository = $mailRepository;
      }

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
        $pvs = $request->get('selectedpvs');
        foreach ($pvs as $key => $pv) {
            $DM = new DispatchMaster();
            $date = Carbon::createFromFormat('d/m/Y',$dispatch['date']);
            $DM->date = $date->format('Y-m-d');
            $DM->pv_id = $pv;
            $DM->dc_no = $dispatch['dc_no'];
            $DM->method = $dispatch['method'];
            if ($dispatch['method'] == 1)
            {
                $DM->docket_details = array_key_exists('docket_details', $dispatch)?$dispatch['docket_details']:'';
                $DM->courier_name = array_key_exists('courier_name', $dispatch)?$dispatch['courier_name']:'';
            }
            else if ($dispatch['method'] == 2)
            {
                $DM->person_name = array_key_exists('person_name', $dispatch)?$dispatch['person_name']:'';
                $DM->concern_name = array_key_exists('concern_name', $dispatch)?$dispatch['concern_name']:'';
                $DM->contact = array_key_exists('contact', $dispatch)?$dispatch['contact']:'';
            }
            $DM->cc = $dispatch['cc'];
            $DM->created_by = Auth::id();
            $DM->save();

            //change pv status
            PVStatusRepositories::ChangeStatusToDispatchApproved($DM->pv_id);
        }


        return response()->json(['data' => $pvs, 'status' => 'success', 'message' => 'Dispatch Approved Successfully'], 200);
    }

    public function CompleteDispatch(Request $request)
    {
        $pvs = $request->get('selectedpvs');
        $dispatch_list = array();

        $all_cc = array();
        foreach ($pvs as $key => $pv) {
            $DM = DispatchMaster::where('pv_id', $pv)->first();
            if($DM)
            {
                //update completion date
                $DM->dispatch_completed_at = Carbon::now();
                $DM->updated_at = Carbon::now();
                $DM->created_by = Auth::id();
                $DM->update();

                //update pv status
                PVStatusRepositories::ChangeStatusToDispatchced($DM->pv_id);
                //re-order the priority
                PVPriorityRepositories::ChangingPriorityAfterDispatching($DM->pv_id);
                //delete from RMS
                RMSRepositories::DeleteRMS($DM->pv_id);

                array_push($dispatch_list, $DM);

                array_push($all_cc, $DM->cc);
            }
        }

        $mail_result = $this->mailRepository->DispatchCompletionMail($dispatch_list, implode(',', $all_cc)); 

        return response()->json(['data' => $pvs, 'status' => 'success', 'message' => 'Dispatched Successfully', 'mail_result' => $mail_result], 200);
    }
}
