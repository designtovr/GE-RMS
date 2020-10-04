@extends('layouts.app')
@section('title', 'Relay Stage Report')
@section('content')
<div class="main-content" ng-controller="RelayStagesReportController">
	<div class="section__content section__content--p30" ng-init="GetRelayForStageReport();">
        <div class="container-fluid">
        	<div class="row">
				<div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Receipt</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <p><b>Receipt Id: </b>{{$receipt['formatted_receipt_id']}}</p>
							<p><b>Receipt Date: </b>{{$receipt['receipt_date']}}</p>
							<p><b>Customer Name: </b>{{$receipt['customer_name']}}</p>
							<p><b>Site: </b>{{$receipt['site']}}</p>
							<p><b>Email: </b>{{$receipt['email']}}</p>
							<p><b>Courier Name: </b>{{$receipt['courier_name']}}</p>
							<p><b>Docket Details: </b>{{$receipt['docket_details']}}</p>
							<p><b>Total Boxes: </b>{{$receipt['total_boxes']}}</p>
							<p><b>Status: </b>
								@if($receipt['status'] == 1)
									Open
								@elseif($receipt['status'] == 2)
									Started
								@elseif($receipt['status'] == 3)
									Completed
								@else
									NA
								@endif
							</p>
							<p><b>Created by: </b>{{$receipt['created_by_name']}}</p>
							<p><b>Created at: </b>{{$receipt['created_at']}}</p>
							<p><b>Last Updated by: </b>{{$receipt['updated_by_name']}}</p>
							<p><b>Last Updated at: </b>{{$receipt['updated_at']}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Physicalverification</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col-6">
                                    <p><b>R ID: </b>{{$formatted_pv_id}}</p>
                                </div>
                            </div>
                        	<div class="row form-group">
                                <div class="col-6">
                                    <p><b>Model No: </b>{{$part_no}}</p>
                                </div>
                                <div class="col-6">
                                    <p><b>Product Type: </b>{{$pro_type}}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <p><b>Date: </b>{{$pvdate}}</p>
                                </div>
                                <div class="col-6">
                                    <p><b>Serial No.: </b>{{$serial_no}}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-4">
                                    <p><b>Case: </b>
                                    	@if($case == 1)
                                    		Yes
                                		@elseif($case == 2)
                                			No
                            			@else
                            				NA
                                    	@endif
                                    </p>
                                </div>
                                <div class="col-8">
                                    <p><b>Case Condition: </b>
                                    	@if($case == 1 && $case_condition == 1)
                                    		Damaged
                                    	@elseif($case == 1 && $case_condition == 2)
                                    		Undamaged
                                		@else
                                			NA
                                    	@endif
                                    </p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-4">
                                    <p><b>Battery: </b>
                                    	@if($battery == 1)
                                    		Yes
                                		@elseif($battery == 2)
                                			No
                            			@else
                            				NA
                                    	@endif
                                    </p>
                                </div>
                                <div class="col-8">
                                    <p><b>Battery Condition: </b>
                                    	@if($battery == 1 && $battery_condition == 1)
                                    		Damaged
                                    	@elseif($battery == 1 && $battery_condition == 2)
                                    		Undamaged
                                		@else
                                			NA
                                    	@endif
                                    </p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <p><b>Top/Bottom Flops Cover: </b>
                                    	@if($top_bottom_cover == 1)
                                    		Yes
                                		@elseif($top_bottom_cover == 2)
                                			No
                            			@else
                            				NA
                                    	@endif
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p><b>Cover Condition: </b>
                                    	@if($top_bottom_cover == 1 && $top_bottom_cover_condition == 1)
                                    		Damaged
                                    	@elseif($top_bottom_cover == 1 && $top_bottom_cover_condition == 2)
                                    		Undamaged
                                		@else
                                			NA
                                    	@endif
                                    </p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-4">
                                    <p><b>TB: </b>
                                    	@if($terminal_blocks == 1)
                                    		Yes
                                		@elseif($terminal_blocks == 2)
                                			No
                            			@else
                            				NA
                                    	@endif
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p><b>TB Condition: </b>
                                    	@if($terminal_blocks == 1 && $terminal_blocks_condition == 1)
                                    		Damaged
                                    	@elseif($terminal_blocks == 1 && $terminal_blocks_condition == 2)
                                    		Undamaged
                                		@else
                                			NA
                                    	@endif
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p><b>No. Of TB: </b>
                                    	@if($no_of_terminal_blocks == 0)
											0
										@else
											{{substr($no_of_terminal_blocks, 0, 2)}} + {{substr($no_of_terminal_blocks, 2, 2)}}
										@endif
                                    </p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-3">
                                    <p><b>Short Links: </b>
                                    	@if($short_links == 1)
                                    		Yes
                                		@elseif($short_links == 2)
                                			No
                            			@else
                            				NA
                                    	@endif
                                    </p>
                                </div>
                                <div class="col-5">
                                    <p><b>SL Condition: </b>
                                    	@if($short_links == 1 && $short_links_condition == 1)
                                    		Damaged
                                    	@elseif($short_links == 1 && $short_links_condition == 2)
                                    		Undamaged
                                		@else
                                			NA
                                    	@endif
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p><b>No. Of SL: </b>{{$no_of_short_links}}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-4">
                                    <p><b>Screws: </b>
                                    	@if($screws == 1)
                                    		Yes
                                		@elseif($screws == 2)
                                			No
                            			@else
                            				NA
                                    	@endif
                                    </p>
                                </div>
                                <div class="col-8">
                                    <p><b>WBS: </b>{{$sales_order_no}}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12">
                                    <p><b>Current Status: </b>{{$current_status}}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12">
                                    <p><b>Comment: </b>{{$comment}}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <p><b>Created by: </b>{{$created_by_name}}</p>
                                </div>
                                <div class="col-6">
                                    <p><b>Created at: </b>{{$created_at}}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <p><b>Last Updated by: </b>{{$updated_by_name}}</p>
                                </div>
                                <div class="col-6">
                                    <p><b>Last Updated at: </b>{{$updated_at}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            @if(!is_null($rma))
			<div class="row">
				<div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>RMA</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                            	<div class="row form-group">
                                    <div class="col-6">
                                        <p><b>Date: </b>{{$rma['date']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-6">
                                        <p><b>WBS: </b>{{$rma['sales_order_no']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12">
                                        <p><b>Desc of Fault: </b>{{$rma['desc_of_fault']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12">
                                        <p><b>Invoice Info: </b><br><b>Customer Name: </b>{{$invoice_info['name']}},<br> <b>Address:</b>{{$invoice_info['address']}},<br> <b>GST:</b>{{$invoice_info['gst']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-12">
                                        <p><b>Delivery Info: </b><br><b>Customer Name: </b>{{$delivery_info['name']}},<br> <b>Address: </b>{{$delivery_info['address']}}, <br><b>GST: </b>{{$delivery_info['gst']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-5">
                                        <p><b>Status:</b>
                                        	@if($rma['rma_status'] == 1)
                                        		Open
                                    		@elseif($rma['rma_status'] == 2)
                                    			Saved
                                			@elseif($rma['rma_status'] == 3)
                                				Completed
                            				@else
                            					NA
                                        	@endif
                                        </p>
                                    </div>
                                </div>
                                <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Created by: </b>{{$rma['created_by_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Created at: </b>{{$rma['created_at']}}</p>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Last Updated by: </b>{{$rma['updated_by_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Last Updated at: </b>{{$rma['updated_at']}}</p>
	                                </div>
	                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if(strcasecmp('SMP', $product_category) == 0 || strcasecmp('OMU', $product_category) == 0)
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>W/C</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col-6">
                                        <p><b>SMP: </b>
                                        	@if($warranty['smp'] == 1)
                                        		Chargable
                                    		@else
                                    			Warranty
                                        	@endif
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>PCP: </b>
                                        	@if($warranty['pcp'] == 1)
                                        		Chargable
                                    		@else
                                    			Warranty
                                        	@endif
                                        </p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                	<div class="col-6">
                                        <p><b>Type: </b>
                                        	@if($warranty['type'] == 1)
                                        		Repair
                                    		@elseif($warranty['type'] == 2)
                                    			Modification
                                			@elseif($warranty['type'] == 3)
                                    			Investigation
                                			@else
                                				NA
                                        	@endif
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>Move To: </b>
                                        	@if($warranty['move'] == 1)
                                        		Repair Rack
                                    		@elseif($warranty['move'] == 2)
                                    			Customer Hold Rack
                                			@else
                                				NA
                            				@endif
                                        </p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                	<div class="col-6">
                                        <p><b>WBS: </b>{{$warranty['wbs']}}</p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>PO: </b>{{$warranty['po']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                	<div class="col-12">
                                        <p><b>Comment: </b>{{$warranty['comment']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Created by: </b>{{$warranty['created_by_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Created at: </b>{{$warranty['created_at']}}</p>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Last Updated by: </b>{{$warranty['updated_by_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Last Updated at: </b>{{$warranty['updated_at']}}</p>
	                                </div>
	                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
			</div>
            @if(strcasecmp('SMP', $product_category) == 0 || strcasecmp('OMU', $product_category) == 0)
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
                        <div class="card-header">
                            <strong>Job Ticket</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col-6">
                                        <p><b>Power On Test: </b>{{$job_ticket['power_on_test']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                	<div class="col-12">
                                        <p><b>Comment: </b>{{$job_ticket['comment']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Created by: </b>{{$job_ticket['created_by_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Created at: </b>{{$job_ticket['created_at']}}</p>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Last Updated by: </b>{{$job_ticket['updated_by_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Last Updated at: </b>{{$job_ticket['updated_at']}}</p>
	                                </div>
	                            </div>
	                            <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Material</th>
                                                <th>Quantity</th>
                                                <th>Defective PCB</th>
                                                <th>Healthy PCB</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($job_ticket_materials as $key => $material)
                                            <tr>
                                                <td>{{$material['part_no']}}</td>
                                                <td>{{$material['quantity']}}</td>
                                                <td>{{$material['old_pcp']}}</td>
                                                <td>{{$material['new_pcp']}}</td>
                                                <td>{{$material['comment']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-sm" ng-click="PrintJobTicketForm({{$id}});">Print</button>
                        </div>
                    </div>
				</div>
			</div>
            @endif
            @if(strcasecmp('SMP', $product_category) == 0 || strcasecmp('OMU', $product_category) == 0)
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
                        <div class="card-header">
                            <strong>Testing</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
	                            <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Result</th>
                                                <th>Comment</th>
                                                <th>Tested at</th>
                                                <th>Tested by</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($testing as $key => $tes)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                	@if($tes['result'] == 1)
                                                		Pass
                                                	@else
                                                		Fail
                                                	@endif
                                                </td>
                                                <td>{{$tes['comment']}}</td>
                                                <td>{{$tes['created_at']}}</td>
                                                <td>{{$tes['created_by_name']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </form>
                        </div>
                    </div>
				</div>
			</div>
            @endif
            @if(strcasecmp('SMP', $product_category) == 0 || strcasecmp('OMU', $product_category) == 0)
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
                        <div class="card-header">
                            <strong>Aging</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
	                            <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Result</th>
                                                <th>Comment</th>
                                                <th>Tested at</th>
                                                <th>Tested by</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($aging as $key => $age)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                	@if($age['result'] == 1)
                                                		Pass
                                                	@else
                                                		Fail
                                                	@endif
                                                </td>
                                                <td>{{$age['comment']}}</td>
                                                <td>{{$age['created_at']}}</td>
                                                <td>{{$age['created_by_name']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </form>
                        </div>
                    </div>
				</div>
			</div>
            @endif
            @if(strcasecmp('SMP', $product_category) == 0 || strcasecmp('OMU', $product_category) == 0)
			<div class="row">
				<div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Verification Completion</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col-6">
                                        <p><b>Updated TB: </b>
                                        	@if($verification_completion['updated_no_of_terminal_blocks'] == 0)
												0
											@else
												{{substr($verification_completion['updated_no_of_terminal_blocks'], 0, 2)}} + {{substr($verification_completion['updated_no_of_terminal_blocks'], 2, 2)}}
											@endif
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>Updated SL: </b>{{$verification_completion['updated_no_of_short_links']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-6">
                                    	<p><b>Updated Soft. Ref: </b>{{$verification_completion['updated_sw_version']}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>CLIO Test: </b>
	                                    	@if($verification_completion['clio_test'] == 1)
	                                    		Pass
                                    		@elseif($verification_completion['clio_test'] == 0)
                                    			Fail
                                			@else
                                    			NA	
	                                    	@endif
	                                	</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>RTD Test: </b>
	                                    	@if($verification_completion['rtd_test'] == 1)
	                                    		Pass
                                    		@elseif($verification_completion['rtd_test'] == 0)
                                    			Fail
                                			@else
                                    			NA
	                                    	@endif
	                                    </p>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>NIC Test: </b>
	                                    	@if($verification_completion['nic_test'] == 1)
	                                    		Pass
                                    		@else
                                    			Fail
	                                    	@endif
	                                	</p>
	                                </div>
	                            </div>
                                <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Created by: </b>{{$verification_completion['created_by_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Created at: </b>{{$verification_completion['created_at']}}</p>
	                                </div>
	                            </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-sm" ng-click="TestReportForm({{$id}});">Print</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Dispatch Approval</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                                <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Approved by: </b>{{$dispatch_approval['created_by_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Approved at: </b>{{$dispatch_approval['created_at']}}</p>
	                                </div>
	                            </div>
                            </form>
                        </div>
                    </div>
                </div>
			</div>
            @endif
            @if(strcasecmp('SMP', $product_category) != 0 && strcasecmp('OMU', $product_category) != 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Other Relay Stage Track</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Stage</th>
                                                <th>Comment</th>
                                                <th>Created by</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($other_relay_stage_tracking as $key => $orst)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    @if($orst['stage_id'] == 0)
                                                        Not Initiated
                                                    @elseif($orst['stage_id'] == 1)
                                                        Intimated to Procurement
                                                    @elseif($orst['stage_id'] == 2)
                                                        To be reworked by Supplier – In house
                                                    @elseif($orst['stage_id'] == 3)
                                                        Send to supplier
                                                    @elseif($orst['stage_id'] == 4)
                                                        Return to customer
                                                    @endif
                                                </td>
                                                <td>{{$orst['comments']}}</td>
                                                <td>{{$orst['created_at']}}</td>
                                                <td>{{$orst['created_by_name']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
			<div class="row">
				<div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Dispatch</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                                <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Date: </b>{{$dispatch['date']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>DC No: </b>{{$dispatch['dc_no']}}</p>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Docket Details: </b>{{$dispatch['docket_details']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Courier Name: </b>{{$dispatch['courier_name']}}</p>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Person Name: </b>{{$dispatch['person_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Concern Name: </b>{{$dispatch['concern_name']}}</p>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Contact: </b>{{$dispatch['contact']}}</p>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col-6">
	                                    <p><b>Dispatched by: </b>{{$dispatch['created_by_name']}}</p>
	                                </div>
	                                <div class="col-6">
	                                    <p><b>Dispatched at: </b>{{$dispatch['created_at']}}</p>
	                                </div>
	                            </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" ng-click="Back();">Back</button>
                        </div>
                    </div>
                </div>
			</div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/RelayStagesReportController.js')}}"></script>
@endsection