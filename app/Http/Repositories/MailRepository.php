<?php

namespace App\Http\Repositories;

use App\Models\PhysicalVerificationMaster;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mail;

class MailRepository
{
	private function GetToAddress($mail)
	{
		return (!is_null(config('mail.mail_override')))?config('mail.mail_override'):$mail;

	}

	public function ReceiptMail()
	{
		$data = array();
		$data['to'] = $this->GetToAddress('srinivas@designtovr.com');

		Mail::send('mails.receiptcompletion',$data, function ($message) use ($data) {
			$message->to($data['to']);
			$message->subject('Receipt Completed');
 		});

 		return $data;
	}
}