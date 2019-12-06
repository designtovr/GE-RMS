<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App;
use PDF;
use Excel;
use App\Models\PhysicalVerificationMaster;
use App\Models\JobTicketMaterials;

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

    public function JobTicketForm($pv_id)
    {
        ini_set('max_execution_time', 300);
        $data = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.*, jt.id as jt_id, jt.created_at as podate, cus.name as customer_name, rma.end_customer, pro.part_no as model_no, pv.comment as nature_of_defect, jt.power_on_test, wt.type')
                ->leftJoin('job_tickets as jt', 'jt.pv_id', 'pv.id')
                ->leftJoin('rma_unit_information as rui', 'rui.pv_id', 'pv.id')
                ->leftJoin('rma', 'rma.id', 'rui.rma_id')
                ->leftJoin('ma_customer as cus', 'cus.id', 'rma.customer_address_id')
                ->leftJoin('ma_product as pro', 'pro.id', 'pv.product_id')
                ->leftJoin('warranty as wt', 'wt.pv_id', 'pv.id')
                ->where('pv.id', $pv_id)->first();

        $data['job_materials'] = JobTicketMaterials::where('jt_id', $data['jt_id'])->get();
        $data['title'] = 'Job Ticket';
        return view('pdf.jobticketform', $data);
        $pdf = PDF::loadView('pdf.jobticketform', $data);
        return $pdf->stream();
        return view('pdf.jobticketform', $data);
    }
}
