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
											   placeholder="Enter RID #" ng-change="gridActions.filter();"
											   ng-model="filterID" filter-by="id" filter-type="text">
									</th>
									<th>

										<input id="productFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Enter Product ID" ng-change="gridActions.filter();"
											   ng-model="filterreceipt_id" filter-by="product_id"
											   filter-type="text">
									</th>
									<th>
										<input type="text"
											   id="dateFilter"
											   class="form-control"
											   placeholder="Date"
											   max-date="dateTo"
											   close-text="Close"
											   ng-model="filterpvdate"
											   show-weeks="true"
											   is-open="dateFromOpened"
											   ng-click="dateFromOpened = true"
											   filter-by="pvdate"
											   filter-type="text"
											   ng-change="gridActions.filter()"
											   close-text="Close"/>

									</th>
									<!--          <th>
                                                 <select name="field-volts-used" id="field-volts-used"
                                                 class="form-control-sm form-control">
                                                 <option value="0">From</option>
                                                 <option value="1">Yes</option>
                                                 <option value="2">No</option>
                                                 <option value="2">Customer</option>
                                             </select>
                                         </th>
                                         <th>
                                             <select name="field-volts-used" id="field-volts-used"
                                             class="form-control-sm form-control">
                                             <option value="0">To</option>
                                             <option value="1">Yes</option>
                                             <option value="2">No</option>
                                             <option value="2">Customer</option>
                                         </select>
                                     </th> -->
									<th>
										<input id="customerFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Enter Customer Name" ng-change="gridActions.filter()"
											   ng-model="filterCustomer" filter-by="customer_name"
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


								</ul>
								</div>
									<div class="col-md-3 col-md-offset-3  p-0 m-r-0">
										<div class = "pull-right">
											<button type="button" class="btn btn-primary btn-sm" ng-show="openTab" ng-click="ChangePVStatusToStarted()">
												<i class="fa fa-check"></i>&nbsp; Started
											</button>

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

									<th ng-show="openTab">
										Select
									</th>
									<th sortable="id" class="sortable">
										RID
									</th>
									<th sortable="pvdate" class="sortable">
										Date
									</th>
									<th sortable="product_id" class="sortable">
										Product Id
									</th>
									<th sortable="serial_no" class="sortable">
										Serial
									</th>
									<th sortable="part_no" class="sortable">
										Model
									</th>
									<th sortable="customer_name" class="sortable">
										Customer
									</th>
									<th sortable="end_customer" class="sortable">
										End Customer
									</th>

									<th sortable="comment" class="sortable">
										Comment
									</th>
									<th ng-show="tab!='jobticketcompleted'">
										Actions
									</th>
								</tr>
								</thead>
								<tbody>
								<tr grid-item>
									<td ng-show="openTab">
										<label class="au-checkbox">
											<input type="checkbox" ng-model="item.create_wc">
											<span class="au-checkmark"></span>
										</label>
									</td>
									<td ng-bind="item.id"></td>
									<td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
									<td ng-bind="item.product_id"></td>
									<td ng-bind="item.serial_no"></td>
									<td ng-bind="item.part_no"></td>
									<td ng-bind="item.customer_name"></td>
									<td ng-bind="item.end_customer"></td>
									<td ng-bind="item.comment"></td>
									<td ng-show="tab!='jobticketcompleted'">
										<div class="table-data-feature">
											<div class="btn-group p-r-10" ng-show="tab!='jobticketcompleted'">
												<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-info">Action</button>
												<div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
													<button type="button" tabindex="0" class="dropdown-item" ng-show="tab=='jobticketopen'">Started</button>
													<button type="button" tabindex="0" class="dropdown-item" ng-show="tab=='jobticketstarted'">Completed</button>
												</div>
											</div>
											<button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenJTForm(item);">
												<i class="zmdi zmdi-edit"></i>
											</button>
									{{--		<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
												<i class="zmdi zmdi-delete"></i>
											</button>--}}
										</div>
									</td>
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
			                                    <label for="type" class=" form-control-label">Type Of Work <span class="mandatory">*</span></label>
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
			                                    <label for="rid" class=" form-control-label">RID <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" ng-model = "jobticket.pv_id" id="pv_id" name="pv_id" placeholder="RID" class="form-control" disabled>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="rma-no" class=" form-control-label">RMA Id <span class="mandatory">*</span></label>
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
			                                    <label for="end_customer" class=" form-control-label">End Customer <span class="mandatory">*</span></label>
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
			                                    ng-model = "jobticket.nature_of_defect" 
			                                    id="nature_of_defect" 
			                                    rows="3" 
			                                    placeholder="Nature Of Defect..." 
			                                    class="form-control"
			                                    >
			                                    </textarea>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc_comment" class=" form-control-label">CRC Comment </label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <textarea 
			                                    name="crc_comment" 
			                                    ng-model = "jobticket.crc_comment" 
			                                    id="crc_comment" 
			                                    rows="2" 
			                                    placeholder="Comment..." 
			                                    class="form-control">
			                                    </textarea>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
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
	                    			<div class="row">
		                            	<div class="col col-md-12">
		                            		<button type="button" class="btn btn-danger btn-sm float-right" ng-click="RemoveMaterial($index);">
	                                    	Remove</button>
		                            	</div>
		                            </div>
		                            <div class="row form-group">
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
		                            </div>
		                            <div class="row form-group">
		                                <div class="col col-md-3">
		                                    <label for="value_@{{$index}}" class=" form-control-label">Value</label>
		                                </div>
		                                <div class="col-12 col-md-6">
		                                    <input 
		                                    type="text" 
		                                    id="value_@{{$index}}" 
		                                    name="value_@{{$index}}" 
		                                    ng-model = "job_ticket_material.value" 
		                                    placeholder="Value" 
		                                    class="form-control">
		                                </div>
		                            </div>
		                            <div class="row form-group">
		                                <div class="col col-md-3">
		                                    <label for="old_pcp_@{{$index}}" class=" form-control-label">Old PCP</label>
		                                </div>
		                                <div class="col-12 col-md-6">
		                                    <input 
		                                    type="text" 
		                                    id="old_pcp_@{{$index}}" 
		                                    name="old_pcp_@{{$index}}" 
		                                    ng-model="job_ticket_material.old_pcp" 
		                                    placeholder="Old PCP" 
		                                    class="form-control">
		                                </div>
		                            </div>
		                            <div class="row form-group">
		                                <div class="col col-md-3">
		                                    <label for="new_pcp_@{{$index}}" class=" form-control-label">New PCP</label>
		                                </div>
		                                <div class="col-12 col-md-6">
		                                    <input 
		                                    type="text" 
		                                    id="new_pcp_@{{$index}}" 
		                                    ng-model="job_ticket_material.new_pcp"
		                                    name="new_pcp_@{{$index}}" 
		                                    placeholder="New PCP" 
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
		                                    rows="2" 
		                                    placeholder="Comment" 
		                                    class="form-control">
		                                    </textarea>
		                                </div>
		                            </div>
	                            </div>
	                            <div class="row">
	                            	<div class="col col-md-12">
	                            		<button type="button" class="btn btn-success btn-md" ng-click="AddMaterial();">
                                    	Add</button>
	                            	</div>
	                            </div>
	                            <div class="row">
	                            	<div class="col col-md-12">
	                            		<button type="button" class="btn btn-primary btn-md float-right" ng-click="SaveMaterial();" ng-disabled="MaterialForm.$invalid">
                                    	Save</button>
	                            	</div>
	                            </div>
	                    	</form>
	                    </div>
	                    <div class="card-footer">
	                        <button type="submit" class="btn btn-primary btn-sm" ng-click="CompleteJTForm();">
	                            <i class="fa fa-dot-circle-o"></i> Complete
	                        </button>
	                        <!-- <button type="reset" class="btn btn-danger btn-sm">
	                            <i class="fa fa-ban"></i> Reset
	                        </button> -->
	                        <button type="reset" class="btn btn-secondary btn-sm" ng-click="CloseJTForm();">
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
            </script>
@endsection