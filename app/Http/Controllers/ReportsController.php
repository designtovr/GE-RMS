<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ReportsRepository;
use App\Models\PhysicalVerificationMaster;

class ReportsController extends Controller
{

	protected $reportsRepository;

	function __construct(ReportsRepository $reportsRepository)
	{
		$this->reportsRepository = $reportsRepository;
	}

    public function DataForRelaysStageReport(Request $request)
    {
    	$data = $this->reportsRepository->DataForRelaysStageReport();
    	return response()->json(
		[
			'status' => 'success', 
			'data' => $data,
			'message' => 'Reports Fetched Successfully'
		]);
    }

    public function RelayStageReport($id)
    {
    	$data = $this->reportsRepository->RelayStageReport($id);

    	return view('reports.relaystagereport', $data);
    }

    public function ListForRMAReport(Request $request)
    {
        $data = $this->reportsRepository->ListForRMAReport();

        return response()->json(
        [
            'status' => 'success',
            'data' => $data,
            'message' => 'Reports Fetched Successfully'
        ]);
    }

    public function RMAReport($id)
    {
        $data = $this->reportsRepository->RMAReport($id);
        return view('reports.rmareport', $data);
    }

    public function ListForDispatchReport(Request $request)
    {
        $data = $this->reportsRepository->ListForDispatchReport();

        return response()->json(
        [
            'status' => 'success',
            'data' => $data,
            'message' => 'Reports Fetched Successfully'
        ]);
    }

    public function DispatchReport($id)
    {
        $data = $this->reportsRepository->DispatchReport($id);
        return view('reports.dispatchreport', $data);
    }

    public function RepairReportData(Request $request)
    {
        $data = $this->reportsRepository->RepairReportData();
        return response()->json(
        [
            'status' => 'success',
            'data' => $data,
            'message' => 'Reports Fetched Successfully'
        ]);
    }

    public function RepairReportExport(Request $request)
    {
        $data = $this->reportsRepository->RepairReportData();
        return $data;
    }
}
