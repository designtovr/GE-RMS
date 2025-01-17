@extends('layouts.app')
@section('title', 'Verification Completion List')
@section('content')
<div class="main-content" ng-controller="VerificationCompleteController">
	<div class="section__content section__content--p30" ng-init ="Start()">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!vcform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">Verification Completion List</h6>
			        </div>
			    </div>
			   {{-- Search Start--}}
				<div class="col-md-12 ">
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
											placeholder="RID #" ng-change="gridActions.filter();"
											ng-model="filterID" filter-by="formatted_pv_id" filter-type="text">
										</th>
                                        <th>
                                            <input id="rmaidFilter" type="text"
                                            class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
                                            placeholder="RMA Id #" ng-change="gridActions.filter();"
                                            ng-model="filterrmaID" filter-by="formatted_rma_id" filter-type="text">
                                        </th>
										<th>
											<input id="productFilter" type="text"
											class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											placeholder="Model No" ng-change="gridActions.filter();"
											ng-model="filterpart_no" filter-by="part_no"
											filter-type="text">
										</th>
                                        <th>
                                            <input id="serialFilter" type="text"
                                            class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
                                            placeholder="Serial No" ng-change="gridActions.filter();"
                                            ng-model="filterserial_no" filter-by="serial_no"
                                            filter-type="text">
                                        </th>
										<th>
											<input type="text"
												   class="form-control"
												   placeholder="From Date"

												   max-date="dateTo"
												   ng-model = "dateFrom"
												   filter-by="date_unix"

												   ng-change="gridActions.filter();"
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
                                     	placeholder="Customer Name" ng-change="gridActions.filter()"
                                     	ng-model="filterCustomer" filter-by="customer_name"
                                     	filter-type="text">
                                     </th>
                                     <th>
                                        <input id="endcustomerFilter" type="text"
                                        class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
                                        placeholder="End Customer" ng-change="gridActions.filter()"
                                        ng-model="filterendCustomer" filter-by="end_customer"
                                        filter-type="text">
                                     </th>
                                     <th>
                                     	<button type="button" class="btn btn-outline-secondary btn-sm"
                                     	ng-click="Reset();gridActions.filter()">Reset
                                     </button>
                                 </th>
                                 <th>
                                 	<button type="button" class="btn btn-outline-primary btn-sm">
                                 		<i class="fa fa-search"></i>&nbsp; Search
                                 	</button>
                                 </th>
                             </tr>
                         </thead>
                     </table>

                 </div>
             </div>
         </div>
         {{--Search End--}}
	             <div class="row  col-lg-12">
         	<div class=" card w-100">

         		<div class="card-body">
         			<div class="row col-md-12 p-0">

         				<div class="col-md-9">
         					<ul class="nav nav-tabs" id="myTab" role="tablist">
         						<li class="nav-item" ng-click="LoadData('1');GetPV('agingcompleted')">
         							<a class="nav-link active" id="all-tab" data-toggle="tab" href="#open" role="tab" aria-controls="all" aria-selected="true">Open</a>
         						</li>
         					<!-- 	<li class="nav-item" ng-click="LoadData('2')">
         							<a class="nav-link" id="withrma-tab" data-toggle="tab" href="#started" role="tab" aria-controls="withrma" aria-selected="false">Started</a>
         						</li> -->
         						<li class="nav-item" ng-click="LoadData('3');GetPV('verificationcompleted')">
         							<a class="nav-link" id="withoutrma-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="withoutrma" aria-selected="false">Completed</a>
         						</li>


         					</ul>
         				</div>
         				<div class="col-md-3 col-md-offset-3  p-0 m-r-0" >
         					<div class = "pull-right">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="exportToExcelSave('#vctable' , 'Aging.xls')">
                                    <i class="fa fa-file-excel-o"></i>&nbsp; Export
                                </button>
         					</div>
         				</div>
         			</div>
         			{{--Tab Ends--}}
         			<!-- DATA TABLE-->
         			<div grid-data grid-options="gridOptions" grid-actions="gridActions">
         				<!-- sample table layout goes below, but remember that you can you any mark-up here. -->
         				<div class="overflow-auto">
         					<table class="table table-borderless table-data3  " id="vctable" name="vctable">
         						<thead>
         							<tr>
                                        <th ng-if="status == 'agingcompleted'">
                                            Actions
                                        </th>
                                        <th sortable="formatted_pv_id" class="sortable">
                                            RID
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

         								<th sortable="manager_comment" class="sortable">
         									Comment
         								</th>
                                        <th sortable="pvl_priority_for_display" class="sortable">
                                            Priority
                                        </th>
         							</tr>
         						</thead>
         						<tbody>
         							<tr grid-item>
                                        <td ng-if="status == 'agingcompleted'">
                                            <div class="table-data-feature float-left">
                                                @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="ShowVCForm(item);">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                @endif
                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-success" >Priority</button>
                                                    <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu scrollable-menu">
                                                        <button ng-if="item.pvl_priority == 999999" type="button" tabindex="0" class="dropdown-item" ng-click="SetPVPriority(item.id, pvprioritylistmax)">Set New: @{{pvprioritylistmax}}</button>
                                                        <div ng-if="item.pvl_priority == 999999" tabindex="-1" class="dropdown-divider"></div>
                                                        <button ng-if="item.pvl_priority != pr.priority" type="button" tabindex="0" class="dropdown-item" ng-repeat="pr in pvprioritylist" ng-click="SetPVPriority(item.id, pr.priority)">@{{pr.priority}}</button>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                         </td>
                                        <td ng-bind="item.formatted_pv_id"></td>
                                        <td ng-bind="item.formatted_rma_id"></td>
         								<td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>
         								<td ng-bind="item.part_no"></td>
         								<td ng-bind="item.serial_no"></td>
         								<td ng-bind="item.customer_name"></td>
         								<td ng-bind="item.end_customer"></td>
         								<td ng-bind="item.manager_comment"></td>
         						        <td ng-bind="item.pvl_priority_for_display"></td>
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

         		<!-- END DATA TABLE-->
         	</div>
         	{{--Table Ends--}}
         </div>

     </div>

 </div>
</div>
	        </div>
	        <div class="row" ng-show="vcform">
	    		<div class="col-lg-12">
	    			<div class="card">
	    				<div class="card-header">
	                        <strong>Verification Completion</strong> Form
	                    </div>
	                    <div class="card-body card-block">
	                    	<form action="" method="post" class="form-horizontal">
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="rma_id" class=" form-control-label">RMA Id</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="rma_id" name="rma_id" placeholder="RMA Id" ng-model="vcformdata.rma_id" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="date" class=" form-control-label">Date</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="date" name="date" placeholder="Date" class="form-control" ng-model="vcformdata.date" disabled>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="customer_name" class=" form-control-label">Customer</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="customer_name" name="customer_name" placeholder="Customer" class="form-control" ng-model="vcformdata.customer_name" disabled>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="part_no" class=" form-control-label">Model No</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="part_no" name="part_no" placeholder="Model No" class="form-control" ng-model="vcformdata.part_no" disabled>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="serial_no" class=" form-control-label">Series No</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="serial_no" name="serial_no" ng-model="vcformdata.serial_no" placeholder="Series No" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="sw_version" class=" form-control-label">Software Ref.</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="sw_version" name="sw_version" ng-model="vcformdata.sw_version" placeholder="Software Reference" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="no_of_terminal_blocks" class=" form-control-label">Teriminal Block</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="no_of_terminal_blocks" ng-model="vcformdata.no_of_terminal_blocks" name="no_of_terminal_blocks" placeholder="No Of Terminal Block" class="form-control" ui-mask="99 + 99" placeholder="N+N" 
                                                add-default-placeholder="99 + 99"
                                                ui-mask-placeholder-char="N" disabled>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="no_of_short_links" class=" form-control-label">Short Link</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="no_of_short_links" name="no_of_short_links" ng-model="vcformdata.no_of_short_links" placeholder="Short Link" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="updated_no_of_terminal_blocks" class=" form-control-label">Updated Teriminal Block</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" id="updated_no_of_terminal_blocks" ng-model="vcformdata.updated_no_of_terminal_blocks" name="updated_no_of_terminal_blocks"class="form-control" ui-mask="99 + 99" placeholder="N+N" 
                                                add-default-placeholder="99 + 99"
                                                ui-mask-placeholder-char="N">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="updated_no_of_short_links" class=" form-control-label">Updated Short Link</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" id="updated_no_of_short_links" name="updated_no_of_short_links" ng-model="vcformdata.updated_no_of_short_links" placeholder="Updated Short Link" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="updated_sw_version" class=" form-control-label">Updated Software Ref.</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" id="updated_sw_version" name="updated_sw_version" ng-model="vcformdata.updated_sw_version" placeholder="Updated Software Reference" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="restored_customer_setting" class=" form-control-label">Restored Customer Settings</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <select name="restored_customer_setting" ng-model = "vcformdata.restored_customer_setting"  id="restored_customer_setting" ng-options="type.id as type.value for type in yes_no_options" class="form-control">
                                                    <option value="" style="display: none;"></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
	                    	</form>
	                    </div>
	                    <div class="card-header">
	                        <strong></strong>
	                    </div>
	                    <div class="card-body card-block">
	                    	<form action="" method="post" class="form-horizontal">
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="clio_test" class=" form-control-label">CLIO Test <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true" name="cliotest" id="cliotest" ng-model="vcformdata.clio_test">
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="rtd_test" class=" form-control-label">RTD Test <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true" name="rtd_test" id="rtd_test" ng-model="vcformdata.rtd_test">
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="nic_test" class=" form-control-label">NIC Test <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true" name="nic_test" id="nic_test" ng-model="vcformdata.nic_test">
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="received_with_screws" class=" form-control-label">Relay Received With Screw</label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true" name="received_with_screws" id="received_with_screws" ng-model="vcformdata.received_with_screws" disabled>
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="received_with_terminal" class=" form-control-label">Relay Received With Terminal Block</label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true" name="received_with_terminal" id="received_with_terminal" ng-model="vcformdata.received_with_terminal" disabled>
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="case" class=" form-control-label">Case</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="switch switch-text switch-success switch-pill">
                                          <input type="checkbox" class="switch-input" checked="true" name="case" id="case" ng-model="vcformdata.case" disabled>
                                          <span data-on="Yes" data-off="No" class="switch-label"></span>
                                          <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="battery" class=" form-control-label">Battery</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="switch switch-text switch-success switch-pill">
                                          <input type="checkbox" class="switch-input" checked="true" name="battery" id="battery" ng-model="vcformdata.battery" disabled>
                                          <span data-on="Yes" data-off="No" class="switch-label"></span>
                                          <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="flops" class=" form-control-label">Flops</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="switch switch-text switch-success switch-pill">
                                          <input type="checkbox" class="switch-input" checked="true" name="flops" id="flops" ng-model="vcformdata.flops" disabled>
                                          <span data-on="Yes" data-off="No" class="switch-label"></span>
                                          <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>
	                    	</form>
	                    </div>
	                    <div class="card-footer">
	                        <button type="submit" class="btn btn-primary btn-sm" ng-click="SaveVerification();">
	                            <i class="fa fa-dot-circle-o"></i> Save
	                        </button>
	                        <button type="reset" class="btn btn-secondary btn-sm" ng-click="CloseVCForm();">
	                            <i class="fa fa-ban"></i> Cancel
	                        </button>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    </div>
	</div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/VerificationCompleteController.js')}}"></script>
	       <script>
                $(document).ready(function () {
                    $("#dateFilter").datepicker({
                        autoclose: true,
                        format: 'yyyy-mm-dd',
                        todayHighlight: true,
                        setDate: new Date(),
                        update: new Date()
                    });
                });

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
            </script>
@endsection
<!-- 
    <td>
		                         	<div class="table-data-feature">
		                         		<button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="ShowVCForm();">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                </div>
		                         </td> -->