@extends('layouts.app')
@section('title', 'Job Ticket List')
@section('content')
<div class="main-content" ng-controller="JobTicketController">
	<div class="section__content section__content--p30" ng-init="Start();">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!showjtform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">Job Ticket List</h6>
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
											   placeholder="Enter RID #" ng-change="gridActions.filter();ShowGridData()"
											   ng-model="filterID" filter-by="formatted_pv_id" filter-type="text">
									</th>
									<th>
										<input id="rmaidFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="RMA Id#" ng-change="gridActions.filter();ShowGridData()"
											   ng-model="filterrmaID" filter-by="formatted_rma_id" filter-type="text">
									</th>
									<th>
										<input id="productFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Model No" ng-change="gridActions.filter();ShowGridData()"
											   ng-model="filterpartno" filter-by="part_no"
											   filter-type="text">
									</th>
									<th>
										<input id="serialFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Serial No" ng-change="gridActions.filter();ShowGridData()"
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
											   placeholder="Customer" ng-change="gridActions.filter()"
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
												ng-click="Reset();gridActions.filter();ShowGridData();">Reset
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
				{{--Filter--}}


				{{-- Table Start--}}
					{{--Tab Start--}}
					<div class="row  col-lg-12">
						<div class=" card w-100">

							<div class="card-body">
								<div class="row col-md-12 p-0 ">

								<div class="col-md-9">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item" ng-click="LoadData('jobticketopen')">
										<a class="nav-link active" id="all-tab" data-toggle="tab" href="#open" role="tab" aria-controls="all" aria-selected="true">Open</a>
									</li>
									<li class="nav-item" ng-click="LoadData('jobticketstarted')">
										<a class="nav-link" id="withrma-tab" data-toggle="tab" href="#started" role="tab" aria-controls="withrma" aria-selected="false">Started</a>
									</li>
									<li class="nav-item" ng-click="LoadData('jobticketcompleted')">
										<a class="nav-link" id="withoutrma-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="withoutrma" aria-selected="false">Completed</a>
									</li>
									<li class="nav-item" ng-click="LoadData('sitecardafterjobticketcompleted')">
										<a class="nav-link" id="afterjtcompleted-tab" data-toggle="tab" href="#afterjtcompleted" role="tab" aria-controls="afterjtcompleted" aria-selected="false">Site Card Completed</a>
									</li>


								</ul>
								</div>
									<div class="col-md-3 col-md-offset-3  p-0 m-r-0">
										<div class = "pull-right">
											<!-- <button type="button" class="btn btn-primary btn-sm" ng-show="openTab" ng-click="OpenJTForm()">
												<i class="fa fa-check"></i>&nbsp; Start
											</button> -->

											<!-- <button type="button" class="btn btn-primary btn-sm" ng-click="ChangeStatus('Completed')">
												<i class="fa fa-check"></i>&nbsp; Completed
											</button> -->
										<!-- 	<button type="button" class="btn btn-primary btn-sm" ng-click="OpenTestBenchModal();">
												<i class="fa fa-plus"></i>&nbsp;Test
											</button> -->
										</div>
									</div>
								</div>
					{{--Tab Ends--}}
					<!-- DATA TABLE-->
					<div grid-data grid-options="gridOptions" grid-actions="gridActions">
						<!-- sample table layout goes below, but remember that you can you any mark-up here. -->
						<div class="overflow-auto">
							<table class="table table-borderless table-data3  ">
								<thead>
								<tr>

									<th>
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
										Manager Comment
									</th>
									<th sortable="repair_comment" class="sortable" ng-show="completedTab">
										Repair Comment
									</th>
									<th sortable="pvl_priority_for_display" class="sortable">
										Priority
									</th>
								</tr>
								</thead>
								<tbody>
								<tr grid-item>
									<td>
                                        <div class="table-data-feature float-left">
                                        	@if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                        	<div class="btn-group" ng-if="page != 'sitecardafterjobticketcompleted'">
	                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-success" >Priority</button>
	                                            <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu scrollable-menu">
	                                            	<button ng-if="item.pvl_priority == 999999" type="button" tabindex="0" class="dropdown-item" ng-click="SetPVPriority(item.id, pvprioritylistmax)">Set New: @{{pvprioritylistmax}}</button>
	                                            	<div ng-if="item.pvl_priority == 999999" tabindex="-1" class="dropdown-divider"></div>
	                                                <button ng-if="item.pvl_priority != pr.priority" type="button" tabindex="0" class="dropdown-item" ng-repeat="pr in pvprioritylist" ng-click="SetPVPriority(item.id, pr.priority)">@{{pr.priority}}</button>
	                                            </div>
	                                        </div>
	                                        @endif
	                                        @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                        	<button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenJTForm(item);">
												<i class="zmdi zmdi-edit"></i>
											</button>
											@endif
											<button ng-if="page == 'sitecardafterjobticketcompleted' || page == 'jobticketcompleted'" class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Print"
                                                    ng-click="PrintForm(item.id);">
                                                <i class="zmdi zmdi-print"></i>
                                            </button>
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
									<td ng-show="completedTab" ng-bind="item.repair_comment"></td>
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
	        <div class="row" ng-show="showjtform">
	    		<div class="col-lg-12">
	    			<div class="card">
	    				<div class="card-header">
	                        <strong>Job Ticket</strong> Form
	                    </div>
	                    <div class="card-body card-block">
	                    	<form action="" method="post" class="form-horizontal" name="AddJobTicket">
	                    		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="type" class=" form-control-label">Type Of Work</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <select name="type" ng-model = "jobticket.type"  id="case-condition" ng-options="type.id as type.value for type in type_of_work" class="form-control" disabled>
			                                        <option value="" style="display: none;"></option>
			                                    </select>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="rid" class=" form-control-label">RID</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" ng-model = "jobticket.formatted_pv_id" id="pv_id" name="pv_id" placeholder="RID" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="rma-no" class=" form-control-label">RMA Id</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="rma_id" ng-model = "jobticket.rma_id" name="rma_id" placeholder="RMA NO" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="given-date" class=" form-control-label">PO Date</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="given-date" ng-model = "jobticket.po_date" name="given-date" placeholder="PO Date" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<!-- <div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="taken-date" class=" form-control-label">Given Date<span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="taken-date" ng-model = "jobticket.given_date" name="taken-date" placeholder="Taken Date" class="form-control" disabled>
			                                    <span class="help-block">Please Select Given Date</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="nature-of-defect" class=" form-control-label">Taken Date <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="nature-of-defect"  ng-model = "jobticket.taken_date" name="nature-of-defect" placeholder="Taken Date" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Taken Date</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div> -->
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="customer_name" class=" form-control-label">Customer</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="customer_name" ng-model = "jobticket.customer_name" name="customer_name" placeholder="Customer" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="end_customer" class=" form-control-label">End Customer</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="end_customer" ng-model = "jobticket.end_customer" name="end_customer" placeholder="End Customer" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                			
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="part_no" class=" form-control-label">Model No</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="part_no" ng-model = "jobticket.part_no" name="part_no" placeholder="Model No" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="serial_no" class=" form-control-label">Serial No</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="serial_no" ng-model = "jobticket.serial_no" name="serial_no" placeholder="Series No" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="nature_of_defect" class=" form-control-label">Nature Of Defect </label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <textarea 
			                                    name="nature_of_defect" 
			                                    ng-model = "jobticket.customer_comment" 
			                                    id="nature_of_defect" 
			                                    rows="3" 
			                                    placeholder="" 
			                                    class="form-control"
			                                    disabled="" 
			                                    >
			                                    </textarea>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="sales_order_no" class=" form-control-label">WBS/SO</label>
			                                </div>
			                                <div class="col-12 col-md-8">
		                                        <input type="text" 
			                                    id="sales_order_no" 
			                                    ng-model = "jobticket.sales_order_no" 
			                                    name="sales_order_no" 
			                                    placeholder="WBS" 
			                                    class="form-control"
			                                    disabled>
		                                    </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="wch_status" class=" form-control-label">Warranty/CH Status</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <select name="wch_status" ng-model = "jobticket.wch_status"  id="wch_status" ng-options="type.id as type.value for type in wch_status" class="form-control" disabled>
			                                        <option value="" style="display: none;"></option>
			                                    </select>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
		                                    <div class="col col-md-4">
		                                        <label for="case" class=" form-control-label">Case</label>
		                                    </div>
		                                    <div class="col-12 col-md-8">
		                                        <select name="case" ng-model = "jobticket.case"  id="case" ng-options="type.id as type.value for type in received_with_options" class="form-control" disabled>
			                                        <option value="" style="display: none;"></option>
			                                    </select>
		                                    </div>
		                                </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="battery" class=" form-control-label">Battery</label>
			                                </div>
			                                <div class="col-12 col-md-8">
		                                        <select name="battery" ng-model = "jobticket.battery"  id="battery" ng-options="type.id as type.value for type in received_with_options" class="form-control" disabled>
			                                        <option value="" style="display: none;"></option>
			                                    </select>
		                                    </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
		                                    <div class="col col-md-4">
		                                        <label for="terminal_blocks" class=" form-control-label">Terminal Blocks</label>
		                                    </div>
		                                    <div class="col-12 col-md-8">
		                                        <select name="terminal_blocks" ng-model = "jobticket.terminal_blocks"  id="terminal_blocks" ng-options="type.id as type.value for type in received_with_options" class="form-control" disabled>
			                                        <option value="" style="display: none;"></option>
			                                    </select>
		                                    </div>
		                                </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
		                                    <div class="col col-md-4">
		                                        <label for="no_of_terminal_blocks" class=" form-control-label">No Of Terminal Blocks</label>
		                                    </div>
		                                    <div class="col-12 col-md-8">
		                                        <input type="text" id="no_of_terminal_blocks" name="no_of_terminal_blocks"
                                                class="form-control"
                                                ng-model="jobticket.no_of_terminal_blocks"
                                                disabled>
		                                    </div>
		                                </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="top_bottom_cover" class=" form-control-label">Top/Bottom Access Cover</label>
			                                </div>
			                                <div class="col-12 col-md-8">
		                                        <select name="top_bottom_cover" ng-model = "jobticket.top_bottom_cover"  id="top_bottom_cover" ng-options="type.id as type.value for type in received_with_options" class="form-control" disabled>
			                                        <option value="" style="display: none;"></option>
			                                    </select>
		                                    </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="battery" class=" form-control-label">Battery</label>
			                                </div>
			                                <div class="col-12 col-md-8">
		                                        <select name="battery" ng-model = "jobticket.battery"  id="battery" ng-options="type.id as type.value for type in received_with_options" class="form-control" disabled>
			                                        <option value="" style="display: none;"></option>
			                                    </select>
		                                    </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
		                                    <div class="col col-md-4">
		                                        <label for="short_links" class=" form-control-label">Short links</label>
		                                    </div>
		                                    <div class="col-12 col-md-8">
		                                        <select name="short_links" ng-model = "jobticket.short_links"  id="short_links" ng-options="type.id as type.value for type in received_with_options" class="form-control" disabled>
			                                        <option value="" style="display: none;"></option>
			                                    </select>
		                                    </div>
		                                </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="no_of_short_links" class=" form-control-label">No Of Short links</label>
			                                </div>
			                                <div class="col-12 col-md-8">
		                                        <input type="text" 
			                                    id="no_of_short_links" 
			                                    ng-model = "jobticket.no_of_short_links" 
			                                    name="no_of_short_links" 
			                                    placeholder="No Of Short links" 
			                                    class="form-control"
			                                    disabled>
		                                    </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
		                                    <div class="col col-md-4">
		                                        <label for="screws" class=" form-control-label">Screws</label>
		                                    </div>
		                                    <div class="col-12 col-md-8">
		                                        <select name="screws" ng-model = "jobticket.screws"  id="screws" ng-options="type.id as type.value for type in received_with_options" class="form-control" disabled>
			                                        <option value="" style="display: none;"></option>
			                                    </select>
		                                    </div>
		                                </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="pv_comment" class=" form-control-label">PV Comment <span class="mandatory">*</span> </label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <textarea 
			                                    name="pv_comment" 
			                                    ng-model = "jobticket.pv_comment" 
			                                    id="pv_comment" 
			                                    rows="4" 
			                                    placeholder="" 
			                                    class="form-control"
			                                    disabled>
			                                    </textarea>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="sw_version" class=" form-control-label">Software Reference</label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" 
			                                    id="sw_version" 
			                                    ng-model = "jobticket.sw_version" 
			                                    name="sw_version" 
			                                    placeholder="Software Reference" 
			                                    class="form-control"
			                                    >
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="comment" class=" form-control-label">Repair Comment <span class="mandatory">*</span> </label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <textarea 
			                                    name="comment" 
			                                    ng-model = "jobticket.comment" 
			                                    id="comment" 
			                                    rows="4" 
			                                    placeholder="" 
			                                    class="form-control"
			                                    required>
			                                    </textarea>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="power_on_test" class=" form-control-label">Power On Test </label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" 
			                                    id="power_on_test" 
			                                    ng-model = "jobticket.power_on_test" 
			                                    name="power_on_test" 
			                                    placeholder="Power On Test" 
			                                    class="form-control">
			                                </div>
			                            </div>
		                			</div>
		                		</div>
	                    	</form>
	                    </div>
	                    <div class="card-header">
	                        <strong>Material</strong>
	                    </div>
	                    <div class="card-body card-block">
	                    	<form action="" method="post" class="form-horizontal" name="MaterialForm" id="MaterialForm">
	                    		<div ng-repeat="job_ticket_material in jobticket.job_ticket_materials track by $index" class="m-b-10">
	                    			<div class="row" ng-if="page != 'sitecardafterjobticketcompleted'">
		                            	<div class="col col-md-12">
		                            		<button type="button" class="btn btn-danger btn-sm float-right" ng-click="RemoveMaterial($index);">
	                                    	Remove</button>
		                            	</div>
		                            </div>
		                            <!-- <div class="row form-group">
		                                <div class="col col-md-3">
		                                    <label for="part_no_@{{$index}}" class=" form-control-label">Material Part No </label>
		                                </div>
		                                <div class="col-12 col-md-6">
		                                    <input 
		                                    type="text" 
		                                    id="part_no_@{{$index}}" 
		                                    ng-model = "job_ticket_material.part_no" 
		                                    name="part_no_@{{$index}}" 
		                                    placeholder="Material Part No" 
		                                    class="form-control">
		                                </div>
		                            </div> -->
		                            <div class="row form-group">
	                                    <div class="col col-md-3">
	                                        <label for="part_no_@{{$index}}" class=" form-control-label">Material Part No</label>
	                                    </div>
	                                    <div class="col-12 col-md-6">
	                                        <input 
	                                        type="text" 
	                                        id="part_no_@{{$index}}" 
	                                        name="part_no_@{{$index}}" 
	                                        ng-model="job_ticket_material.part_no" 
	                                        uib-typeahead="part for part in jtmaterialspartnos | filter:$viewValue | limitTo:8" 
	                                        placeholder="Material Part No" 
	                                        class="form-control" 
	                                        typeahead-popup-template-url="{{url('public/bower_components/angular-bootstrap/template/typeahead/typeahead-popup.html')}}"
	                                        typeahead-template-url="{{url('public/bower_components/angular-bootstrap/template/typeahead/typeahead-match.html')}}">
	                                    </div>
	                                </div>
		                            <div class="row form-group">
		                                <div class="col col-md-3">
		                                    <label for="quantity_@{{$index}}" class=" form-control-label">Quantity</label>
		                                </div>
		                                <div class="col-12 col-md-6">
		                                    <input 
		                                    type="text" 
		                                    id="quantity_@{{$index}}" 
		                                    name="quantity_@{{$index}}" 
		                                    ng-model = "job_ticket_material.quantity" 
		                                    placeholder="Quantity" 
		                                    class="form-control">
		                                </div>
		                            </div>
		                            <div class="row form-group">
		                                <div class="col col-md-3">
		                                    <label for="old_pcp_@{{$index}}" class=" form-control-label">Defective PCB</label>
		                                </div>
		                                <div class="col-12 col-md-6">
		                                    <input 
		                                    type="text" 
		                                    id="old_pcp_@{{$index}}" 
		                                    name="old_pcp_@{{$index}}" 
		                                    ng-model="job_ticket_material.old_pcp" 
		                                    placeholder="Defective PCB" 
		                                    class="form-control">
		                                </div>
		                            </div>
		                            <div class="row form-group">
		                                <div class="col col-md-3">
		                                    <label for="new_pcp_@{{$index}}" class=" form-control-label">Healthy PCB</label>
		                                </div>
		                                <div class="col-12 col-md-6">
		                                    <input 
		                                    type="text" 
		                                    id="new_pcp_@{{$index}}" 
		                                    ng-model="job_ticket_material.new_pcp"
		                                    name="new_pcp_@{{$index}}" 
		                                    placeholder="Healthy PCB" 
		                                    class="form-control">
		                                </div>
		                            </div>
		                            <div class="row form-group">
		                                <div class="col col-md-3">
		                                    <label for="comment_@{{$index}}" class=" form-control-label">Comment</label>
		                                </div>
		                                <div class="col-12 col-md-6">
		                                    <textarea 
		                                    name="comment_@{{$index}}" 
		                                    ng-model = "job_ticket_material.comment" 
		                                    id="comment_@{{$index}}" 
		                                    rows="4" 
		                                    placeholder="Comment" 
		                                    class="form-control">
		                                    </textarea>
		                                </div>
		                            </div>
	                            </div>
	                            <div class="row">
	                            	<div class="col col-md-12">
	                            		<button ng-if="page != 'sitecardafterjobticketcompleted'" type="button" class="btn btn-success btn-md" ng-click="AddMaterial();">
                                    	Add</button>
	                            	</div>
	                            </div>
	                            <div class="row">
	                            	<div class="col col-md-12">
	                            		<button ng-if="page != 'sitecardafterjobticketcompleted'" type="button" class="btn btn-primary btn-md float-right" ng-click="SaveMaterial();" ng-disabled="MaterialForm.$invalid">
                                    	Save</button>
	                            	</div>
	                            </div>
	                    	</form>
	                    </div>
	                    <div class="card-footer">
	                        <button ng-if="page != 'sitecardafterjobticketcompleted'" type="submit" class="btn btn-primary btn-sm" ng-click="CompleteJTForm();" ng-disabled="AddJobTicket.$invalid">
	                            <i class="fa fa-dot-circle-o"></i> Complete
	                        </button>
	                        <button ng-if="page == 'sitecardafterjobticketcompleted'" type="submit" class="btn btn-primary btn-sm" ng-click="UpdateSiteJTForm();">
	                            <i class="fa fa-dot-circle-o"></i> Update Site Card
	                        </button>
	                        <!-- <button type="reset" class="btn btn-danger btn-sm">
	                            <i class="fa fa-ban"></i> Reset
	                        </button> -->
	                        <button type="reset" class="btn btn-secondary btn-sm" ng-click="CloseJTForm();">
	                            <i class="fa fa-ban"></i> Cancel
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
	<script type="text/javascript" src="{{url('public/js/services/ChangePVStatusService.js')}}"></script>
	<script type="text/javascript" src="{{url('public/js/controllers/JobTicketController.js')}}"></script>
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