@extends('layouts.app')
@section('title', 'Job Ticket List')
@section('content')
<div class="main-content" ng-controller="JobTicketController">
	<div class="section__content section__content--p30" ng-init="Start()">
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
									<li class="nav-item" ng-click="LoadData('1')">
										<a class="nav-link active" id="all-tab" data-toggle="tab" href="#open" role="tab" aria-controls="all" aria-selected="true">Open</a>
									</li>
									<li class="nav-item" ng-click="LoadData('2')">
										<a class="nav-link" id="withrma-tab" data-toggle="tab" href="#started" role="tab" aria-controls="withrma" aria-selected="false">Started</a>
									</li>
									<li class="nav-item" ng-click="LoadData('3')">
										<a class="nav-link" id="withoutrma-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="withoutrma" aria-selected="false">Completed</a>
									</li>


								</ul>
								</div>
									<div class="col-md-3 col-md-offset-3  p-0 m-r-0" >
										<div class = "pull-right">
											<button type="button" class="btn btn-primary btn-sm" ng-show="openTab" ng-click="ChangeStatus('Started')">
												<i class="fa fa-check"></i>&nbsp; Started
											</button>

											<button type="button" class="btn btn-primary btn-sm" ng-show="startTab" ng-click="ChangeStatus('Completed')">
												<i class="fa fa-check"></i>&nbsp; Completed
											</button>
											<button type="button" class="btn btn-primary btn-sm" ng-click="OpenTestBenchModal();">
												<i class="fa fa-plus"></i>&nbsp;Test
											</button>
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
									<th>
										Actions
									</th>
								</tr>
								</thead>
								<tbody>
								<tr grid-item>
									<td>
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
									<td>
										<div class="table-data-feature">
											<div class="btn-group p-r-10">
												<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-info">Action</button>
												<div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
													<button type="button" tabindex="0" class="dropdown-item">Open</button>
													<button type="button" tabindex="0" class="dropdown-item">Started</button>
												</div>
											</div>
											<button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenJTForm();">
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
	                    	<form action="" method="post" class="form-horizontal">
	                    		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="case-condition" class=" form-control-label">Type Of Work <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <select name="case-condition" id="case-condition" class="form-control" disabled>
			                                        <option value="1" selected>Repair</option>
			                                        <option value="2">Modification</option>
			                                        <option value="2">Investigation</option>
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
			                                    <input type="text" id="rid" name="rid" placeholder="RID" class="form-control" disabled>
			                                    <span class="help-block">Please Enter RID</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="rma-no" class=" form-control-label">RMA NO <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="rma-no" name="rma-no" placeholder="RMA NO" class="form-control" disabled>
			                                    <span class="help-block">Please Enter RMA NO</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="given-date" class=" form-control-label">PO Date<span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="given-date" name="given-date" placeholder="PO Date" class="form-control" disabled>
			                                    <span class="help-block">Please Select PO Date</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="taken-date" class=" form-control-label">Given Date<span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="taken-date" name="taken-date" placeholder="Taken Date" class="form-control" disabled>
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
			                                    <input type="text" id="nature-of-defect" name="nature-of-defect" placeholder="Taken Date" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Taken Date</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="taken-date" class=" form-control-label">Customer<span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="taken-date" name="taken-date" placeholder="Customer" class="form-control" disabled>
			                                    <span class="help-block">Please Select Customer</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="nature-of-defect" class=" form-control-label">End Customer <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="nature-of-defect" name="nature-of-defect" placeholder="End Customer" class="form-control" disabled>
			                                    <span class="help-block">Please Enter End Customer</span>
			                                </div>
			                            </div>
		                			</div>
		                			
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="nature-of-defect" class=" form-control-label">Model No <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="nature-of-defect" name="nature-of-defect" placeholder="Model No" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Model No</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc-comment" class=" form-control-label">Series No <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="crc-comment" name="crc-comment" placeholder="Series No" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Series No</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="nature-of-defect" class=" form-control-label">Nature Of Defect <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <textarea name="textarea-input" id="textarea-input" rows="2" placeholder="Content..." class="form-control"></textarea>
			                                    <span class="help-block">Please Enter Nature Of Defect</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc-comment" class=" form-control-label">CRC Comment <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <textarea name="textarea-input" id="textarea-input" rows="2" placeholder="Content..." class="form-control"></textarea>
			                                    <span class="help-block">Please Enter CRC Comment</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc-comment" class=" form-control-label">Power On Test <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="crc-comment" name="crc-comment" placeholder="Power On Test" class="form-control">
			                                    <span class="help-block">Please Enter Power On Test</span>
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
	                    	<form action="" method="post" class="form-horizontal">
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="material-part-no" class=" form-control-label">Material Part No <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <input type="text" id="material-part-no" name="material-part-no" placeholder="Material Part No" class="form-control">
	                                    <span class="help-block">Please Enter Material Part No</span>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="value" class=" form-control-label">Value <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <input type="text" id="value" name="value" placeholder="Value" class="form-control">
	                                    <span class="help-block">Please Enter Value</span>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="old-pcp" class=" form-control-label">Old PCP <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <input type="text" id="old-pcp" name="old-pcp" placeholder="Old PCP" class="form-control">
	                                    <span class="help-block">Please Enter Old PCP</span>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="new-pcp" class=" form-control-label">New PCP <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <input type="text" id="new-pcp" name="new-pcp" placeholder="New PCP" class="form-control">
	                                    <span class="help-block">Please Enter New PCP</span>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="new-pcp" class=" form-control-label">Comment <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <textarea name="textarea-input" id="textarea-input" rows="2" placeholder="Content..." class="form-control"></textarea>
	                                    <span class="help-block">Please Enter Comment</span>
	                                </div>
	                            </div>
	                            <div class="row">
	                            	<div class="col col-md-12">
	                            		<button type="button" class="btn btn-primary btn-md">
                                    	Add</button>
		                                <button type="button" class="btn btn-secondary btn-md">
		                                    Cancel</button>
	                            	</div>
	                            </div>
	                    	</form>
	                    	<div class="row p-t-20">
	                    		<div class="col-md-12">
					                <!-- DATA TABLE-->
					                <div class="table-responsive">
						                 <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
						                 <table class="table table-borderless table-data3">
						                     <thead>
						                     <tr>
						                         <th>
						                             
						                         </th>
						                         <th>
						                             Material Part No
						                         </th>
						                         <th>
						                             Value
						                         </th>
						                         <th>
						                             Old PCB
						                         </th>
						                         <th>
						                             New PCB
						                         </th>
						                         <th>
						                             Comment
						                         </th>
						                     </tr>
						                     </thead>
						                     <tbody>
						                     <tr>
						                     	 <td>
						                     	 	<label class="au-checkbox">
				                                        <input type="checkbox">
				                                        <span class="au-checkmark"></span>
				                                    </label>
						                     	 </td>
						                         <td>
						                         	MP001
						                         </td>
						                         <td>
						                         	1000
						                         </td>
						                         <td>
						                         	PCB001
						                         </td>
						                         <td>
						                         	PCB002
						                         </td>
						                         <td>
						                         	Not Good
						                         </td>
						                     </tr>
						                     </tbody>
						                 </table>
									 </div>
					                <!-- END DATA TABLE-->
					            </div>
	                    	</div>
	                    </div>
	                    <div class="card-footer">
	                        <button type="submit" class="btn btn-primary btn-sm">
	                            <i class="fa fa-dot-circle-o"></i> Save
	                        </button>
	                        <button type="reset" class="btn btn-danger btn-sm">
	                            <i class="fa fa-ban"></i> Reset
	                        </button>
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
	<script type="text/javascript" src="{{url('public/js/controllers/JobTicketController.js')}}"></script>
@endsection