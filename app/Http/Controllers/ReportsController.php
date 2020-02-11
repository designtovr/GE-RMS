<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ReportsRepository;

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
        return $data;

    	return view('reports.relaystagereport', $data);
    }
}
