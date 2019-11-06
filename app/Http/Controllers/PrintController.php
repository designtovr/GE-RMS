<?php

namespace App\Http\Controllers;

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

    public function PrintLabel(Request $request)
    {

        $receipt = $request->get('receipt');
        /*$RM->gs_no = $receipt['gs_no'];*/
        $RM->customer_id = $receipt['customer_id'];
        //$RM->customer_name = $receipt['customer_name'];
        /*$RM->end_customer = $receipt['end_customer'];*/
        $RM->site_id = $receipt['site_id'];
        $RM->courier_name = $receipt['courier_name'];
        $RM->docket_details = $receipt['docket_details'];
        $RM->total_boxes = $receipt['total_boxes'];
        $RM->status = 1;
        $file = 'public\RID Print Variable.prn';

        $template = file_get_contents($file);
        $template = str_replace("riddata","123456",$template);
        $template = str_replace("rmadata","654321", $template);
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

                    $poloczenie = pfsockopen("$ip", 9100);
                    fputs($poloczenie, $daneDoDruku);
                    fclose($poloczenie);

                return 'success';
       // str_replace("world","Peter","Hello world!");
    }

    public function PrintReceipt(Request $request)
    {

        return $request;
        $file = 'public\ReceiptPrintFile.prn';

        $template = file_get_contents($file);
        $template = str_replace("riddata","123456",$template);
        $template = str_replace("rmadata","654321", $template);
        $jsonfile = 'public\printerconfiguration.json';

        $strJsonFileContents = file_get_contents($jsonfile);
    // Convert to array
        $array = json_decode($strJsonFileContents, true);


        $ip =  $array['ReceiptPrinterIP'];
        /* foreach(file('public\RID Print Variable.prn') as $line) {
            $getReceipt += $line;
            // loop with $line for each line of yourfile.txt
        }
        return $getReceipt; */

        $daneDoDruku = $template;

        $poloczenie = pfsockopen("$ip", 9100);
        fputs($poloczenie, $daneDoDruku);
        fclose($poloczenie);

        return 'success';
        // str_replace("world","Peter","Hello world!");
    }
}
