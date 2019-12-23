<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App;
use PDF;
use Excel;
use App\Models\PhysicalVerificationMaster;
use App\Models\ProductMaster;
use App\Models\RMA;
use Carbon\Carbon;
use App\Http\Repositories\MailRepository;
use App\Models\WarrantyMaster;
use App\Models\DispatchMaster;

class MailController extends Controller 
{

  protected $mailRepository;

  function __construct(MailRepository $mailRepository)
  {
    $this->mailRepository = $mailRepository;
  }

   public function basic_email() {
   	try 
    {
   		ini_set('max_execution_time', 300);
   		$data = array('name'=>"Srinivas");
   		Mail::send(['text'=>'mail'], $data, function($message) {
	         $message->to('krishnan.sudhakar@ge.com', 'GE-CRC')->subject
	            ('Test Mail From CRCRMS');
	      });
      	echo "Basic Email Sent. Check your inbox.";
   	} catch (Exception $e) {
   		echo $e->Message;
   	}
      
   }

   public function StoredProcedure()
   {
      $status = DB::select('call displaypvstatus()');
      return $status;
   }

   public function SamplePdf()
   {
      $data = PhysicalVerificationMaster::find(105)->toArray();
      $data['title'] = 'invoice';
      $pdf = PDF::loadView('pdf.invoice', $data);
      return $pdf->stream();
   }

   public function ImportProduct(Request $request)
   {
      ini_set('max_execution_time', '0');
      Excel::load('ProductDatabase.xlsx', function($reader) {
          $firstsheet = $reader->first();
          $firstsheet->each(function($row){
              if (!empty($row['product']))
              {
                  $PR = new ProductMaster();
                  $PR->part_no = $row['product'];
                  $PR->created_by = 1;
                  $PR->updated_by = 1;
                  $PR->created_at = Carbon::now();
                  if (strcasecmp($row['platform'], "C264") == 0)
                  {
                    $PR->type = 1;
                  }
                  else if (strcasecmp($row['platform'], "STATIC") == 0)
                  {
                    $PR->type = 2;
                  }
                  else if (strcasecmp($row['platform'], "Agile") == 0)
                  {
                    $PR->type = 3;
                  }
                  else if (strcasecmp($row['platform'], "H49") == 0)
                  {
                    $PR->type = 4;
                  }
                  else if (strcasecmp($row['platform'], "M870D") == 0)
                  {
                    $PR->type = 5;
                  }
                  else if (strcasecmp($row['platform'], "M87x") == 0)
                  {
                    $PR->type = 6;
                  }
                  else if (strcasecmp($row['platform'], "HA") == 0)
                  {
                    $PR->type = 7;
                  }
                  else if (strcasecmp($row['platform'], "HAMIDOS-Export") == 0)
                  {
                    $PR->type = 8;
                  }
                  else if (strcasecmp($row['platform'], "RPV") == 0)
                  {
                    $PR->type = 9;
                  }
                  else if (strcasecmp($row['platform'], "RT430") == 0)
                  {
                    $PR->type = 10;
                  }
                  else if (strcasecmp($row['platform'], "DISC") == 0)
                  {
                    $PR->type = 11;
                  }
                  else if (strcasecmp($row['platform'], "HAMIDOS-Local") == 0)
                  {
                    $PR->type = 12;
                  }
                  else if (strcasecmp($row['platform'], "Px40") == 0)
                  {
                    $PR->type = 13;
                  }

                  $PR->save();
              }
          });
      });
      echo "success";
   }

   public function ReceiptMail(Request $request)
   {
      $result = $this->mailRepository->ReceiptMail(); 
      return $result;
   }

   public function PVCompletionMail($rma_id)
   {
      $RMA = RMA::find($rma_id);
      if(!$RMA)
        return "No RMA Found";

      $result = $this->mailRepository->PhysicalVerificationCompletion($RMA); 
      return $result;
   }

   public function WCCompletionMail($pv_id)
   {
      $wr = WarrantyMaster::where('pv_id', $pv_id)->first();

      if (!$wr)
        return "Warranty Not Found";

      $result = $this->mailRepository->WCCompletionMail($wr); 
      return $result;
   }

   public function DispatchCompletionMail($pv_id)
   {
      $dis = DispatchMaster::whereIn('id', [6,7,8])->get();
      $result = $this->mailRepository->DispatchCompletionMail($dis); 
      return $result;
   }

}