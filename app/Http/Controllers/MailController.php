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
use Carbon\Carbon;

class MailController extends Controller {

   public function phpmailer_email()
   {
      $mail = new PHPMailer(true);

      try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
          $mail->isSMTP();                                            // Send using SMTP
          $mail->Host       = 'sg2plcpnl0170.prod.sin2.secureserver.net';                    // Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->Username   = 'srinivas.s@designtovr.com';                     // SMTP username
          $mail->Password   = 'Admin@123';                               // SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
          $mail->Port       = 465;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('srinivas.s@designtovr.com', 'Srinivas');
          $mail->addAddress('illango007@gmail.com');     // Add a recipient

          // Attachments
          /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
          $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Here is the subject';
          $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
   }

   public function basic_email() {
   	try {
   		ini_set('max_execution_time', 300);
   		$data = array('name'=>"Virat Gandhi");
   		Mail::send(['text'=>'mail'], $data, function($message) {
	         $message->to('srinivasktss@gmail.com', 'Tutorials Point')->subject
	            ('Laravel Basic Testing Mail');
	      });
      	echo "Basic Email Sent. Check your inbox.";
   	} catch (Exception $e) {
   		echo $e->Message;
   	}
      
   }
   public function html_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
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
}