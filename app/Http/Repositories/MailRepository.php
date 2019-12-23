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

class MailRepository
{
	private function GetToAddress($mail)
	{
		return (!is_null(config('mail.mail_override')))?config('mail.mail_override'):$mail;
	}

	public function ReceiptMail(ReceiptMaster $receipt)
	{
		$receipt = $receipt->toArray();
		$receipt['email'] = $this->GetToAddress('srinivas@designtovr.com');

		if (is_null($receipt['email']))
			return "No Mail Address";

		Mail::send('mails.receiptcompletion',$receipt, function ($message) use ($receipt) {
			$message->to($receipt['email']);
			$message->subject('Receipt Completion');
 		});

 		return "Sent";
	}

	public function PhysicalVerificationCompletion(RMA $rma)
	{
		$receipt = ReceiptMaster::find($rma->receipt_id);
		if(!$receipt)
			return "No Receipt Found";
		if(!is_null($receipt->email))
			return "No Mail Id";

		$data = RMA::selectRaw('rma.*')
					->leftJoin('receipt as rc', 'rc.id', 'rma.receipt_id')
					->where('rma.id', $rma->id)->first();

		$data['unit_information'] = RMAUnitInformation::select('pv.serial_no', 'pro.part_no', 'rma_unit_information.pv_id')
				->leftJoin('physical_verification as pv', 'pv.id', 'rma_unit_information.pv_id')
				->leftJoin('ma_product as pro', 'pro.id', 'pv.product_id')
				->where('rma_unit_information.rma_id', $data->id)->get();

		$data['email'] = $this->GetToAddress('srinivas@designtovr.com');
		$data = $data->toArray();

		Mail::send('mails.pvcompletion',$data, function ($message) use ($data, $receipt) {
			$message->to($data['email']);
			$message->subject('Physical Verification Completion');
 		});

 		return "Sent";
	}

}