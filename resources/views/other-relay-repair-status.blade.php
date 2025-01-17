@extends('layouts.app')
@section('title', 'Other Relay Repair Status')
@section('content')
<div class="main-content" ng-controller="OtherRelayController">
	<div class="section__content section__content--p30" ng-init="OtherRelays();">
	    <div class="container-fluid">
	    	<div class="row">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">Other Relay Repair Status</h6>
			        </div>
			    </div>
			    <div class="col-md-12">
			    	<div class="card-header card-title">
						Search
					</div>
					<div>

						<div class="table-responsive">
							<table class="table table-borderless table-data3 table-custom">
								<thead>
								<tr>
									<th>
										<input id="ridFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Enter RID #" ng-change="gridActions.filter();"
											   ng-model="filterID" filter-by="formatted_pv_id" filter-type="text">
									</th>
									<th>
										<input id="rmaidFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="RMA Id#" ng-change="gridActions.filter()"
											   ng-model="filterrmaID" filter-by="formatted_rma_id" filter-type="text">
									</th>
									<th>
										<input id="productFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Model No" ng-change="gridActions.filter()"
											   ng-model="filterpartno" filter-by="part_no"
											   filter-type="text">
									</th>
									<th>
										<input id="serialFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Serial No" ng-change="gridActions.filter()"
											   ng-model="filterserialno" filter-by="serial_no"
											   filter-type="text">
									</th>
									<th>
										<input type="text"
											   class="form-control"
											   placeholder="From Date"

											   max-date="dateTo"
											   ng-model = "dateFrom"
											   filter-by="date_unix"

											   ng-change="gridActions.filter()"
											   id="dateFromFilter"
											   filter-type="dateFrom"
										/>
									</th>
									<th>
										<input type="text"
											   placeholder="To Date"
											   filter-by="date_unix"
											   ng-change="gridActions.filter();"
											   id="dateToFilter"
											   class="form-control"
											   min-date="dateFrom"
											   close-text="Close"
											   ng-model="dateTo"
											   filter-type="dateTo"
											   close-text="Close">
									</th>
									<th>
										<input id="customerFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Customer" ng-change="gridActions.filter();"
											   ng-model="filterCustomer" filter-by="customer_name"
											   filter-type="text">
									</th>
									<th>
										<input id="endcustomerFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="End Customer" ng-change="gridActions.filter();"
											   ng-model="filterendCustomer" filter-by="end_customer"
											   filter-type="text">
									</th>
									<th>
										<button type="button" class="btn btn-outline-secondary btn-sm"
												ng-click="Reset();gridActions.filter();">Reset
										</button>
									</th>
									<th>
										<input id="userrole" name="userrole" type="hidden" ng-value="{{Auth::user()->Role()}}" ng-model="userrole">
									</th>
								</tr>
								</thead>
							</table>

						</div>
					</div>
			    </div>
			            <div class="col-md-12 p-b-20">
                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-primary btn-md float-right box m-r-10"  ng-click="exportToExcelSave('#otherrelayrepaittable' , 'OtherRelayRepairStatusReport.xls')">
                                <i class="fa fa-file-excel-o"></i>&nbsp;Export
                            </button>
                        </li>
                    </ul>
                </div>
	            <div class="col-md-12">
	                <div grid-data grid-options="gridOptions" grid-actions="gridActions">
						<!-- sample table layout goes below, but remember that you can you any mark-up here. -->
						<div class="overflow-auto">
							<table class="table table-borderless table-data3  " id="otherrelayrepaittable">
								<thead>
								<tr>

									<th>
										Actions
									</th>
									<th sortable="formatted_pv_id" class="sortable">
										RID
									</th>
									<th sortable="ort_current_stage" class="sortable">
										Current Stage
									</th>
									<th sortable="formatted_rma_id" class="sortable">
										RMA Id
									</th>
									<th sortable="date_unix" class="sortable">
										Date
									</th>
									<th sortable="part_no" class="sortable">
										Model No
									</th>
									<th sortable="serial_no" class="sortable">
										Serial No
									</th>
									<th sortable="customer_name" class="sortable">
										Customer
									</th>
									<th sortable="end_customer" class="sortable">
										End Customer
									</th>
									<th sortable="repair_comment" class="sortable" ng-show="completedTab">
										Repair Comment
									</th>
								</tr>
								</thead>
								<tbody>
								<tr grid-item>
									<td>
                                        <div class="table-data-feature float-left">
			                                <div class="btn-group">
	                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-info">Action</button>
	                                            <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
	                                                <button type="button" tabindex="0" class="dropdown-item" ng-click="OpenOtherRelayModal(item.formatted_pv_id,item.id, 1)">Intimated to Procurement</button>
	                                                <button type="button" tabindex="0" class="dropdown-item" ng-click="OpenOtherRelayModal(item.formatted_pv_id,item.id, 2)">To be reworked by Supplier – In house</button>
	                                                <button type="button" tabindex="0" class="dropdown-item" ng-click="OpenOtherRelayModal(item.formatted_pv_id,item.id, 3)">Send to Supplier</button>
	                                                <button type="button" tabindex="0" class="dropdown-item" ng-click="OpenOtherRelayModal(item.formatted_pv_id,item.id, 4)">Return to customer</button>
	                                            </div>
	                                        </div>
	                                    </div>
									</td>
									<td ng-bind="item.formatted_pv_id"></td>
									<td ng-if="item.ort_current_stage == 0">Not Initiated</td>
									<td ng-if="item.ort_current_stage == 1">Intimated to Procurement</td>
									<td ng-if="item.ort_current_stage == 2">To be reworked by Supplier – In house</td>
									<td ng-if="item.ort_current_stage == 3">Send to Supplier</td>
									<td ng-if="item.ort_current_stage == 4">Return to customer</td>
									<td ng-bind="item.formatted_rma_id"></td>
									<td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>
									<td ng-bind="item.part_no"></td>
									<td ng-bind="item.serial_no"></td>
									<td ng-bind="item.customer_name"></td>
									<td ng-bind="item.end_customer"></td>
									<td ng-show="completedTab" ng-bind="item.repair_comment"></td>
								</tr>
								</tbody>
							</table>
						</div>
						<form class="form-inline pull-right margin-bottom-basic">
							<div class="form-group">
								<grid-pagination max-size="5"
												 boundary-links="true"
												 class="pagination-sm"
												 total-items="paginationOptions.totalItems"
												 ng-model="paginationOptions.currentPage"
												 ng-change="reloadGrid()"
												 items-per-page="paginationOptions.itemsPerPage"></grid-pagination>
							</div>
							<div class="form-group items-per-page">
								<label for="itemsOnPageSelect2">Items per page:</label>
								<select id="itemsOnPageSelect2" class="form-control input-sm"
										ng-init="paginationOptions.itemsPerPage = '10'"
										ng-model="paginationOptions.itemsPerPage" ng-change="reloadGrid()">
									<option>10</option>
									<option>25</option>
									<option>50</option>
									<option>75</option>
									<option>10000000</option>
								</select>
							</div>
						</form>

					</div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- modal scroll -->
    <div class="modal fade" id="otherrelaymodal" tabindex="-1" role="dialog" aria-labelledby="otherrelayLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rmsmodalLabel">Change Status</h5>
                    <button type="button" class="close" ng-click="CloseOtherRelayModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddUserForm" id="AddUserForm" novalidate>
		                		<div class="row">
		                			<div class="col-md-12">
		                				<div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="rid" class=" form-control-label"><b>RID</b></label>
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <input type="text" id="rid" name="rid" ng-model = "otherrelaymodal.formatted_pv_id" placeholder="RID" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-12">
		                				<div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="comment" class=" form-control-label"><b>Comments</b></label>
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <textarea rows="4" id="comment" name="comment" ng-model = "otherrelaymodal.comments" placeholder="Comments" class="form-control"></textarea>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseOtherRelayModal();">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm"  ng-click="ChangeOtherRelayStatus();">
                        <i class="fa fa-dot-circle-o"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal scroll -->
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/OtherRelayController.js')}}"></script>

	<script>
    $(document).ready(function () {
        $("#dateFromFilter").datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });

        $("#dateToFilter").datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });

    });
</script>
@endsection