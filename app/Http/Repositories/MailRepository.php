<?php

namespace App\Http\Repositories;

use App\Models\PhysicalVerificationMaster;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\ReceiptMaster;
use App\Models\RMA;
use App\Models\RMAUnitInformation;
use App\Models\WarrantyMaster;
use App\Models\DispatchMaster;
use App\Models\RMADeliveryAddress;

class MailRepository
{
	private function GetToAddress($mail)
	{
		return (!is_null(config('mail.mail_override')))?config('mail.mail_override'):$mail;
	}

	public function ReceiptMail(ReceiptMaster $receipt)
	{
		$receipt = $receipt->toArray();
		$receipt['email'] = $this->GetToAddress($receipt['email']);

		if (is_null($receipt['email']))
			return "No Mail Address";

		try {
			Mail::send('mails.receiptcompletion',$receipt, function ($message) use ($receipt) {
				$message->to($receipt['email']);
				$message->subject('Receipt Completion');
	 		});
		} catch (\Exception $e) {
			return $e->getMessage();
		}

 		return "Sent";
	}

	public function PhysicalVerificationCompletion(RMA $rma)
	{
		$receipt = ReceiptMaster::find($rma->receipt_id);
		if(!$receipt)
			return "No Receipt Found";

		$data = RMA::selectRaw('rma.*')
					->leftJoin('receipt as rc', 'rc.id', 'rma.receipt_id')
					->where('rma.id', $rma->id)->first();

		$data['unit_information'] = RMAUnitInformation::selectRaw('pv.serial_no, pro.part_no, rma_unit_information.pv_id, pv.case, pv.case_condition, pv.battery, pv.battery_condition, pv.terminal_blocks, pv.terminal_blocks_condition, pv.no_of_terminal_blocks, pv.top_bottom_cover, pv.top_bottom_cover_condition, pv.short_links, pv.short_links_condition, pv.no_of_short_links, screws')
				->leftJoin('physical_verification as pv', 'pv.id', 'rma_unit_information.pv_id')
				->leftJoin('ma_product as pro', 'pro.id', 'pv.product_id')
				->where('rma_unit_information.rma_id', $data->id)->get();

		$rma_delivery = RMADeliveryAddress::where('rma_id', $rma->id)->first();
		$data['email'] = $this->GetToAddress($rma_delivery->email);
		$data = $data->toArray();

		try {
			Mail::send('mails.pvcompletion',$data, function ($message) use ($data, $receipt) {
				$message->to($data['email']);
				$message->subject('Physical Verification Completion');
	 		});
		} catch (\Exception $e) {
			return $e->getMessage();
		}

 		return "Sent";
	}

	public function SCPhysicalVerificationCompletion(RMA $rma)
	{
		$receipt = ReceiptMaster::find($rma->receipt_id);

		$data = RMA::selectRaw('rma.*')->where('rma.id', $rma->id)->first();
		$data['unit_information'] = RMAUnitInformation::selectRaw('pv.serial_no, pro.part_no, rma_unit_information.pv_id, pv.case, pv.case_condition, pv.battery, pv.battery_condition, pv.terminal_blocks, pv.terminal_blocks_condition, pv.no_of_terminal_blocks, pv.top_bottom_cover, pv.top_bottom_cover_condition, pv.short_links, pv.short_links_condition, pv.no_of_short_links, screws')
				->leftJoin('physical_verification as pv', 'pv.id', 'rma_unit_information.pv_id')
				->leftJoin('ma_product as pro', 'pro.id', 'pv.product_id')
				->where('rma_unit_information.rma_id', $data->id)->get();

		$rma_delivery = RMADeliveryAddress::where('rma_id', $rma->id)->first();
		$data['email'] = $this->GetToAddress($rma_delivery->email);
		$data = $data->toArray();

		try {
			Mail::send('mails.scpvcompletion',$data, function ($message) use ($data, $receipt) {
				$message->to($data['email']);
				$message->subject('Physical Verification Completion');
	 		});
		} catch (\Exception $e) {
			return $e->getMessage();
		}

 		return "Sent";
	}

	public function WCCompletionMail(WarrantyMaster $warranty)
	{
		$data = PhysicalVerificationMaster::selectRaw('physical_verification.id, physical_verification.receipt_id,physical_verification.serial_no, physical_verification.comment, pro.part_no, wc.smp,
			wc.pcp, wc.type, wc.created_at as created_date, rui.rma_id')
				->join('warranty as wc', 'wc.pv_id', 'physical_verification.id')
				->leftJoin('ma_product as pro', 'pro.id', 'physical_verification.product_id')
				->leftJoin('rma_unit_information as rui', 'rui.pv_id', 'physical_verification.id')
				->where('wc.pv_id', $warranty->pv_id)->first();

		if(!$data)
			return "No Warranty Found";

		$receipt = ReceiptMaster::find($data->receipt_id);
		$rma_delivery = RMADeliveryAddress::where('rma_id', $data->rma_id)->first();

		if(!$receipt)
			return "No Receipt Found";
		if(!is_null($receipt->email))
			return "No Mail Id";

		$data['email'] = $this->GetToAddress($rma_delivery->email);
		$time = strtotime($data['created_date']. ' + 3 days');
		$data['created_date'] = date('d/m/Y',$time);
		$data = $data->toArray();

		try {
			Mail::send('mails.wccompletion',$data, function ($message) use ($data, $receipt) {
				$message->to($data['email']);
				$message->subject('W/C Declaration');
	 		});
		} catch (\Exception $e) {
			return $e->getMessage();
		}
 		return "Sent";
	}

	public function DispatchCompletionMail($dispatches)
	{
		$dispatch_list = array();

		foreach ($dispatches as $key => $dispatch) {
			$dis = PhysicalVerificationMaster::selectRaw('physical_verification.id, physical_verification.receipt_id,physical_verification.serial_no, pro.part_no, rui.rma_id, dis.dc_no, dis.courier_name, dis.docket_details, rui.rma_id')
					->leftJoin('dispatch as dis', 'dis.pv_id', 'physical_verification.id')
					->leftJoin('ma_product as pro', 'pro.id', 'physical_verification.product_id')
					->leftJoin('rma_unit_information as rui', 'rui.pv_id', 'physical_verification.id')
					->where('dis.id', $dispatch->id)->first();

			if($dis)
				array_push($dispatch_list, $dis);			
		}

		if (sizeof($dispatch_list) <= 0)
			return "Dispatch Not Found";

		$data['dispatches'] = $dispatch_list;

		$rma = RMA::where('id', $dispatch_list[0]->rma_id)->first();
		if (!$rma)
			return "RMA Not Found";
		$rma_delivery = RMADeliveryAddress::where('rma_id', $rma->id)->first();
		$data['email'] = $this->GetToAddress($rma_delivery->email);

		try {
			Mail::send('mails.dispatchcompletion',$data, function ($message) use ($data) {
				$message->to($data['email']);
				$message->subject('Dispatch Completion');
	 		});
		} catch (\Exception $e) {
			return $e->getMessage();
		}

 		return "sent";
	}

}