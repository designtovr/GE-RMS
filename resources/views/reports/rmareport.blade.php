@extends('layouts.app')
@section('title', 'RMA Report')
@section('content')
<div class="main-content" ng-controller="RMAReportController">
	<div class="section__content section__content--p30">
        <div class="container-fluid">
        	<div class="row">
				<div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>RMA</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <p><b>RMA Id: </b>{{$formatted_rma_id}}</p>
                            <p><b>Receipt Id: </b>{{$formatted_receipt_id}}</p>
							<p><b>Receipt Date: </b>{{$receipt['receipt_date']}}</p>
                            <p><b>Customer Name: </b>{{$customer_name}}</p>
                            <p><b>End Customer: </b>{{$end_customer}}</p>
							<p><b>Status: </b>
								@if($status == 1)
									Open
								@elseif($status == 2)
									Saved
								@elseif($status == 3)
									Completed
								@else
									NA
								@endif
							</p>
							<p><b>Created by: </b>{{$created_by_name}}</p>
							<p><b>Created at: </b>{{$created_at}}</p>
							<p><b>Last Updated by: </b>{{$updated_by_name}}</p>
							<p><b>Last Updated at: </b>{{$updated_at}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Customer</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
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
                            </form>
                        </div>
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Physical Verification</strong>
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
                                                <th>Model No</th>
                                                <th>Serial No</th>
                                                <th>P.V Comment</th>
                                                <th>Cus. Comment</th>
                                                <th>Current Status</th>
                                                <th>Created by</th>
                                                <th>Created at</th>
                                                <th>Updated by</th>
                                                <th>Updated at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($physical_verification as $key => $pv)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$pv['part_no']}}</td>
                                                <td>{{$pv['serial_no']}}</td>
                                                <td>{{$pv['comment']}}</td>
                                                <td>{{$pv['desc_of_fault']}}</td>
                                                <td>{{$pv['current_status']}}</td>
                                                <td>{{$pv['created_by_name']}}</td>
                                                <td>{{$pv['created_at']}}</td>
                                                <td>{{$pv['updated_by_name']}}</td>
                                                <td>{{$pv['updated_at']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" ng-click="Back();">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/RMAReportController.js')}}"></script>
@endsection