<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveVCRequest;
use App\Http\Repositories\PVStatusRepositories;
use Carbon\Carbon;
use App\Models\VerificationCompletion;

class VerificationCompletionController extends Controller
{
    public function SaveVerification(SaveVCRequest $request)
    {
    	$vc = $request->get('vc');
    	$VC = new VerificationCompletion();
    	$VC->pv_id = $vc['id'];
        $VC->updated_no_of_terminal_blocks = (array_key_exists('updated_no_of_terminal_blocks', $vc))?$vc['updated_no_of_terminal_blocks']:'';
        $VC->updated_sw_version = (array_key_exists('updated_sw_version', $vc))?$vc['updated_sw_version']:'';
        $VC->updated_no_of_short_links = (array_key_exists('updated_no_of_short_links', $vc))?$vc['updated_no_of_short_links']:'';
    	$VC->clio_test = $vc['clio_test'];
    	$VC->rtd_test = $vc['rtd_test'];
    	$VC->nic_test = $vc['nic_test'];
    	$VC->received_with_screws = $vc['received_with_screws'];
    	$VC->received_with_terminal = $vc['received_with_terminal'];
        $VC->case = $vc['case'];
        $VC->battery = $vc['battery'];
        $VC->flops = $vc['flops'];
        $VC->restored_customer_setting = (array_key_exists('restored_customer_setting', $vc))?$vc['restored_customer_setting']:2;
    	$VC->created_by = Auth::id();
    	$VC->updated_by = Auth::id();
    	$VC->created_at = Carbon::now();
    	$VC->updated_at = Carbon::now();
    	$VC->save();
    	PVStatusRepositories::ChangeStatusToVerificationCompleted($VC->pv_id);
    	return response()->json(['status' => 'success', 'vc' => $VC, 'message' => 'Verification Completed']);
    }
}
