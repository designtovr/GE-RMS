@extends('layouts.app')
@section('title', 'Dispatch List')
@section('content')
<div class="main-content" ng-controller="DispatchController">
	<div class="section__content section__content--p30">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!showdpform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="display-5">Dispatch List</h6>
			        </div>
			    </div>
			    <div class="col-md-12">
			    	<div class="table-responsive">
	                    <table class="table table-borderless table-data3 table-custom m-b-0">
	                    	<thead>
	                            <tr>
	                                <th>
		                                <input type="text" id="se-from-date" name="se-from-date" placeholder="From Date" class="form-control-sm form-control">
	                            	</th>
	                                <th>
	                                	<input type="text" id="se-to-date" name="se-to-date" placeholder="To Date" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                	<select name="field-volts-used" id="field-volts-used" class="form-control-sm form-control">
	                                        <option value="0">From</option>
	                                        <option value="1">Yes</option>
	                                        <option value="2">No</option>
	                                        <option value="2">Customer</option>
	                                    </select>
	                                </th>
	                                <th>
	                                	<select name="field-volts-used" id="field-volts-used" class="form-control-sm form-control">
	                                        <option value="0">To</option>
	                                        <option value="1">Yes</option>
	                                        <option value="2">No</option>
	                                        <option value="2">Customer</option>
	                                    </select>
	                                </th>
	                                <th>
	                                	<input type="text" id="se-cus" name="se-cus" placeholder="Customer" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                	<button type="button" class="btn btn-outline-secondary btn-sm">Reset</button>
	                                </th>
	                                <th>
	                                	<button type="button" class="btn btn-outline-primary btn-sm">
	                                            <i class="fa fa-search"></i>&nbsp; Search</button>
	                                </th>
	                            </tr>
	                        </thead>
	                    </table>
	                </div>
			    </div>
			    <div class="col-md-12 p-b-20">
			    	<button type="button" class="btn btn-primary btn-md float-right" ng-click="ShowDPForm();">
	                        <i class="fa fa-plus"></i>&nbsp;Add Item
	                </button>
			    </div>
				<div class="col-md-12">
					<!-- DATA TABLE-->
					<div {{--grid-data --}}grid-options="gridOptions" grid-actions="gridActions" class="table-responsive">
						<!-- sample table layout goes below, but remember that you can you any mark-up here. -->
						<table class="table table-borderless table-data3">
							<thead>
							<tr>
								<th>

								</th>
								<th sortable="placed" class="sortable">
									RID No
								</th>
								<th sortable="purchaseOrderNumber" class="sortable">
									Product
								</th>
								<th sortable='total.value' class="sortable">
									Customer Name
								</th>
								<th sortable='total.value' class="sortable">
									End Customer
								</th>
								<th sortable='total.value' class="sortable">
									Serial No
								</th>
								<th sortable='total.value' class="sortable">
									Model No
								</th>
								<th sortable='total.value' class="sortable">
									Courier
								</th>
								<th sortable='total.value' class="sortable">
									Docket No
								</th>
								<th sortable='total.value' class="sortable">
									Customer Comment
								</th>
								<th>
									Actions
								</th>
							</tr>
							</thead>
							<tbody>
							<tr grid-item>
								<td>
									<label class="au-checkbox">
										<input type="checkbox">
										<span class="au-checkmark"></span>
									</label>
								</td>
								<td ng-bind="item.rid_no"></td>
								<td ng-bind="item.product"></td>
								<td ng-bind="item.customer_name"></td>
								<td ng-bind="item.end_customer"></td>
								<td ng-bind="item.serial_no"></td>
								<td ng-bind="item.model_no"></td>
								<td ng-bind="item.courier_name"></td>
								<td ng-bind="item.docket_details"></td>
								<td ng-bind="item.customer_comment"></td>
								<td>

								</td>
							</tr>
							</tbody>
						</table>
					</div>
					<!-- END DATA TABLE-->
				</div>
	        </div>
	        <div class="row" ng-show="showdpform">
        		<div class="col-lg-12">
        			<div class="card">
        				<div class="card-header">
                            <strong>Dispatch</strong> Form
                        </div>
                        <div class="card-body card-block">
    	                	<form action="" method="post" class="form-horizontal">
    	                		<div class="row form-group">
    	                            <div class="col col-md-3">
    	                                <label for="dispatch-no" class=" form-control-label">Dispatch No <span class="mandatory">*</span></label>
    	                            </div>
    	                            <div class="col-12 col-md-6">
    	                                <input type="text" id="dispatch-no" name="dispatch-no" placeholder="Dispatch No" class="form-control">
    	                                <span class="help-block">Please Enter Dispatch No</span>
    	                            </div>
    	                        </div>
    	                        <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="date" class=" form-control-label">Date<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="date" name="date" placeholder="Date" class="form-control">
                                        <span class="help-block">Please Select Date</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="rid" class=" form-control-label">RID No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="rid" name="rid" placeholder="RID No" class="form-control">
                                        <span class="help-block">Please Enter RID No</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="dc-no" class=" form-control-label">DC No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="dc-no" name="dc-no" placeholder="DC No" class="form-control">
                                        <span class="help-block">Please Enter DC No</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="docket-details" class=" form-control-label">Docket Details <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="docket-details" name="docket-details" placeholder="Docket Details" class="form-control">
                                        <span class="help-block">Please Enter Docket Details</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="rma" class=" form-control-label">RMA No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="rma" name="rma" placeholder="RMA" class="form-control">
                                        <span class="help-block">Please Enter RMA No </span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="courier-name" class=" form-control-label">Courier Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="courier-name" name="courier-name" placeholder="Courier Name" class="form-control">
                                        <span class="help-block">Please Enter Courier Name </span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="person-name" class=" form-control-label">Person  Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="person-name" name="person-name" placeholder="Person Name" class="form-control">
                                        <span class="help-block">Please Enter Person Name </span>
                                    </div>
                                </div>
    	                	</form>
    	                </div>
    	                <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                            <button type="reset" class="btn btn-secondary btn-sm" ng-click="HideDPForm();">
	                            <i class="fa fa-ban"></i> Close
	                        </button>
                        </div>
                    </div>
                </div>
            </div>
	    </div>
	</div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/DispatchController.js')}}"></script>
@endsection