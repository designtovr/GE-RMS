<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App;
use mysql_xdevapi\Exception;
use PDF;
use Excel;
use App\Models\PhysicalVerificationMaster;
use App\Models\JobTicketMaterials;
use App\Models\RMA;
use App\Models\ReceiptMaster;
use App\Models\RMAUnitInformation;
use App\Models\RMADeliveryAddress;
use App\Models\RMAInvoiceAddress;

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

        try {
            $receipt = $request->get('receipt');
            $file = 'public\ReceiptPrintFile.prn';

            $template = file_get_contents($file);
            $receiptID = $receipt['formatted_receipt_id'];
  
            if(strlen($receipt['customer'])>25)
            {
    $cush = 56 - (strlen($receipt['customer']) - 25);
}
else{
    $cush = 56;
}

            if(strlen($receipt['site'])>16){
    $loch = 56 - (strlen($receipt['site']) - 16);
}else{
    $loch = 56;
}
          //return $cush;
            $template = str_replace("receiptid",$receiptID,$template);
            $template = str_replace("cusname",$receipt['customer'],$template);
            $template = str_replace("cush",$cush,$template);
            $template = str_replace("loch",$loch,$template);
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

            $daneDoDruku = $template;
//return          $template ;
            for($i = 1 ; $i<= $receipt['total_boxes'] ; $i++)
            {
                $poloczenie = pfsockopen("$ip", 9100);
                $templateModified = str_replace("currentbox",$i,$template);
                fputs($poloczenie, $templateModified);
                fclose($poloczenie);

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'failure', 'message' => $e->getMessage()]);
        }
        return response()->json(['status' => 'success', 'message' => 'Print Successfully']);
    }

    public function PrintLabel(Request $request)
    {
        try {
            $label = $request->get('receipt');
            $file = 'public\LabelPrintFile.prn';


            if(strlen($label['customer_name'])>10)
            {
    $cush = 23 - (strlen($label['customer_name']) - 10);
}

else{
    $cush = 23;
}

            if(strlen($label['location'])>10){
    $loch = 23 - (strlen($label['location']) - 10);
}else{
    $loch = 23;
}

            $template = file_get_contents($file);
            $template = str_replace("riddata",$label['formatted_pv_id'],$template);
            $template = str_replace("qrcode",$label['formatted_pv_id'],$template);
            $template = str_replace("rmadata",$label['formatted_rma_id'], $template);
            $template = str_replace("customer",$label['customer_name'], $template);
            $template = str_replace("cush",$cush, $template);
            $template = str_replace("loch",$loch, $template);
            $template = str_replace("location",$label['location'], $template);
            $jsonfile = 'public\printerconfiguration.json';

            $strJsonFileContents = file_get_contents($jsonfile);
            $array = json_decode($strJsonFileContents, true);
            $ip =  $array['LabelPrinterIP'];

            $daneDoDruku = $template;
return $template;
            $poloczenie = pfsockopen("$ip", 9100);
            fputs($poloczenie, $daneDoDruku);
            fclose($poloczenie);

        } catch (\Exception $e) {
            return response()->json(['status' => 'failure', 'message' => $e->getMessage()]);
        }
        return response()->json(['status' => 'success', 'message' => 'Print Successfully']);
        
    }

    public function JobTicketForm($pv_id)
    {
        $data = PhysicalVerificationMaster::from('physical_verification as pv')->selectRaw('pv.*, jt.id as jt_id, jt.created_at as podate, wt.pcp, wt.smp, rda.name as customer_name, rma.end_customer, pro.part_no as model_no, rui.desc_of_fault as nature_of_defect, jt.power_on_test, wt.type, jt.comment as remarks, rui.sw_version')
                ->leftJoin('job_tickets as jt', 'jt.pv_id', 'pv.id')
                ->leftJoin('rma_unit_information as rui', 'rui.pv_id', 'pv.id')
                ->leftJoin('rma', 'rma.id', 'rui.rma_id')
                ->leftJoin('ma_customer as cus', 'cus.id', 'rma.customer_address_id')
                ->leftJoin('ma_product as pro', 'pro.id', 'pv.product_id')
                ->leftJoin('warranty as wt', 'wt.pv_id', 'pv.id')
                ->leftJoin('rma_delivery_address as rda', 'rda.rma_id', 'rma.id')
                ->where('pv.id', $pv_id)->first();

        $data['job_materials'] = JobTicketMaterials::where('jt_id', $data['jt_id'])->get();
        $data['title'] = 'Job Ticket';
        return view('pdf.jobticketform-new', $data);
        $pdf = PDF::loadView('pdf.jobticketform', $data);
        return $pdf->stream();
        return view('pdf.jobticketform', $data);
    }

    public function TestReportForm($pv_id)
    {
        $data = PhysicalVerificationMaster::from('physical_verification as pv')
                ->selectRaw('pv.*, rda.name as customer_name, pro.part_no as model_no, rui.sw_version, vc.updated_no_of_terminal_blocks, vc.updated_sw_version, vc.updated_no_of_short_links,
                    vc.clio_test, vc.rtd_test, vc.nic_test, vc.received_with_screws,
                    vc.received_with_terminal, vc.case as vc_case, vc.battery as vc_battery, vc.flops as vc_flops, vc.updated_at as vc_updated_at')
                ->leftJoin('verification_completion as vc', 'vc.pv_id', 'pv.id')
                ->leftJoin('rma_unit_information as rui', 'rui.pv_id', 'pv.id')
                ->leftJoin('rma', 'rma.id', 'rui.rma_id')
                ->leftJoin('ma_customer as cus', 'cus.id', 'rma.customer_address_id')
                ->leftJoin('ma_product as pro', 'pro.id', 'pv.product_id')
                ->leftJoin('rma_delivery_address as rda', 'rda.rma_id', 'rma.id')
                ->where('pv.id', $pv_id)
                ->first();

        return view('pdf.test-report-form', $data);
    }

    public function PhysicalVerificationForm($rma_id)
    {
        $data = RMA::selectRaw('rma.*, rda.name as customer_name')
                ->where('rma.id', $rma_id)
                ->leftJoin('rma_delivery_address as rda', 'rda.rma_id', 'rma.id')
                ->first()->toArray();

        $receipt = ReceiptMaster::where('id', $data['receipt_id'])->first();
        if(!is_null($receipt))
        {
            $data['location'] = $receipt->site;
        }
        else
        {
            $data['location'] = 'NA';
        }

        //this functionality is added because PV form needed before RMA Completion
        //first we'll check the rma type
        //if rma type is site card we'll take pv number directly from rma_unit_information table
        //else we join receipt table, rma table, pv table
        $data['unit_information'] = (object)[];
        if ($data['service_type'] == 2)
        {
            $data['unit_information'] = PhysicalVerificationMaster::selectRaw('physical_verification.id, serial_no, pro.part_no, battery, terminal_blocks, screws, no_of_terminal_blocks, physical_verification.comment as remark, top_bottom_cover')
                    ->leftJoin('ma_product as pro', 'pro.id', 'physical_verification.product_id')
                    ->leftJoin('rma_unit_information as rui', 'rui.pv_id', 'physical_verification.id')
                    ->where('rui.rma_id', $rma_id)->get();
        }
        else if ($data['service_type'] == 1)
        {
            $data['unit_information'] = PhysicalVerificationMaster::selectRaw('physical_verification.id, physical_verification.created_at, serial_no, pro.part_no, battery, terminal_blocks, screws, no_of_terminal_blocks, physical_verification.comment as remark, top_bottom_cover')
                    ->join('ma_product as pro', 'pro.id', 'physical_verification.product_id')
                    ->join('receipt as rc', 'rc.id', 'physical_verification.receipt_id')
                    ->join('rma', 'rma.receipt_id', 'rc.id')
                    ->where('rma.id', $rma_id)->get();
        }
        

        return view('pdf.physical-verification-form', $data);
    }

    public function RMAForm($rma_id)
    {
        $data = RMA::find($rma_id);
        if(!$data)
            return "RMA Not Found";
        $data['delivery_info'] = RMADeliveryAddress::where('rma_id', $data->id)->first();
        $data['invoice_info'] = RMAInvoiceAddress::where('rma_id', $data->id)->first();
        $data['unit_information'] = RMAUnitInformation::from('rma_unit_information as rui')->selectRaw('rui.sw_version, rui.desc_of_fault, rui.field_volts_used, pv.serial_no, pro.part_no')
            ->leftJoin('physical_verification as pv', 'pv.id', 'rui.pv_id')
            ->leftJoin('ma_product as pro', 'pro.id', 'pv.product_id')->where('rui.rma_id', $data->id)->get();
        return view('pdf/RMAform', $data);
    }

    public function LablePrintersIP(Request $request)
    {
        try 
        {
            $path = 'public\printerconfiguration.json';
            $content = file_get_contents($path);
            $data = json_decode($content, true);

            return response()->json(['status' => 'success', 'message' => 'IP Fetched Successfully', 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failure', 'message' => $e->getMessage()]);
        }
    }

    public function ChangePrinterIP(Request $request)
    {
        try {
            $requestData = $request->get('printer');
            $path = 'public\printerconfiguration.json';
            $content = file_get_contents($path);
            $data = json_decode($content, true);
            $data[$requestData['code']] = $requestData['ip'];
            $new_content = json_encode($data);
            file_put_contents("public\printerconfiguration.json", $new_content);

        return response()->json(['status' => 'success', 'message' => 'IP Changed']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'failure', 'message' => $e->getMessage()]);
        }
    }

}
