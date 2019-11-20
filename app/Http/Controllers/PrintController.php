<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PrintController extends Controller
{

    public function Print()
    {

    }

    public function GetIP()
    {
        return "192.168.1.3";
    }

    public function PrintReceipt(Request $request)
    {

        $receipt = $request->get('receipt');
        /*$RM->gs_no = $receipt['gs_no'];*/
/*        $RM->customer_id = $receipt['customer_id'];
        //$RM->customer_name = $receipt['customer_name'];
        /*$RM->end_customer = $receipt['end_customer'];*/
   /*     $RM->site_id = $receipt['site_id'];
        $RM->courier_name = $receipt['courier_name'];
        $RM->docket_details = $receipt['docket_details'];
        $RM->total_boxes = $receipt['total_boxes'];
        $RM->status = 1;*/
        $file = 'public\ReceiptPrintFile.prn';

        $template = file_get_contents($file);
        $receiptID = 'RC';
        $receiptID .= $receipt['id'];

        $template = str_replace("receiptid",$receiptID,$template);
        $template = str_replace("cusname",$receipt['customer'],$template);
        $template = str_replace("courierData",$receipt['courier_name'],$template);
        $template = str_replace("dcdata",$receipt['docket_details'],$template);
        $template = str_replace("location",$receipt['site'],$template);
        $template = str_replace("qrcode",$receipt['id'],$template);
        $template = str_replace("total",$receipt['total_boxes'],$template);

        $template = str_replace("time",Carbon::now(), $template);


        $jsonfile = 'public\printerconfiguration.json';

        $strJsonFileContents = file_get_contents($jsonfile);
// Convert to array
        $array = json_decode($strJsonFileContents, true);
        $templateModified = "";

        $ip =  $array['ReceiptPrinterIP'];
        /* foreach(file('public\RID Print Variable.prn') as $line) {
            $getReceipt += $line;
            // loop with $line for each line of yourfile.txt
        }
        return $getReceipt; */

        $daneDoDruku = $template;

        for($i = 1 ; $i<= $receipt['total_boxes'] ; $i++)
        {
            $poloczenie = pfsockopen("$ip", 9100);
            $templateModified = str_replace("currentbox",$i,$template);
            fputs($poloczenie, $templateModified);
            fclose($poloczenie);

        }
                    //return $templateModified;

                return 'success';
       // str_replace("world","Peter","Hello world!");
    }

    public function PrintLabel(Request $request)
    {
        $label = $request->get('receipt');
        //return $request;
        $file = 'public\LabelPrintFile.prn';

        $template = file_get_contents($file);
        $template = str_replace("riddata",$label['id'],$template);
        $template = str_replace("qrcode",$label['id'],$template);
        $template = str_replace("rmadata",$label['rma_id'], $template);
        $template = str_replace("customer",$label['customer_name'], $template);
        $template = str_replace("location",$label['location'], $template);
        $jsonfile = 'public\printerconfiguration.json';

        $strJsonFileContents = file_get_contents($jsonfile);
    // Convert to array
        $array = json_decode($strJsonFileContents, true);


        $ip =  $array['LabelPrinterIP'];
        /* foreach(file('public\RID Print Variable.prn') as $line) {
            $getReceipt += $line;
            // loop with $line for each line of yourfile.txt
        }
        return $getReceipt; */

        $daneDoDruku = $template;
//return $template;
        $poloczenie = pfsockopen("$ip", 9100);
        fputs($poloczenie, $daneDoDruku);
        fclose($poloczenie);

        return 'success';
        // str_replace("world","Peter","Hello world!");
    }
}
