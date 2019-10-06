@extends('layouts.app')
@section('title', 'Auto Test Bench List')
@section('content')
<div class="main-content" ng-controller="AutoTestBenchController">
	<div class="section__content section__content--p30" ng-init="Start()">
	    <div class="container-fluid">
	    	<div class="row">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">Auto Test Bench List</h6>
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
		{{--	    <div class="col-md-12 p-b-20">

			    </div>--}}
				{{-- Table Start--}}
				{{--Tab Start--}}
				<div class="row  col-lg-12">
					<div class=" card w-100">

						<div class="card-body">
							<div class="row col-md-12 p-0">

								<div class="col-md-9">
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item" ng-click="LoadData('1');GetPV('atbopen');">
											<a class="nav-link active" id="all-tab" data-toggle="tab" href="#open" role="tab" aria-controls="all" aria-selected="true">Open</a>
										</li>
										<li class="nav-item" ng-click="LoadData('2');GetPV('atbstarted');">
											<a class="nav-link" id="withrma-tab" data-toggle="tab" href="#started" role="tab" aria-controls="withrma" aria-selected="false">Started</a>
										</li>
										<li class="nav-item" ng-click="LoadData('3');GetPV('atbcompleted');">
											<a class="nav-link" id="withoutrma-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="withoutrma" aria-selected="false">Completed</a>
										</li>


									</ul>
								</div>
								<div class="col-md-3 col-md-offset-3  p-0 m-r-0" >
									<div class = "pull-right">
									<button type="button" class="btn btn-primary btn-sm" ng-show="openTab" ng-click="ChangeStatus('atbstarted')">
										<i class="fa fa-check"></i>&nbsp; Started
									</button>

									<!-- <button type="button" class="btn btn-primary btn-sm" ng-show="startTab" ng-click="ChangeStatus('atbcompleted')">
										<i class="fa fa-check"></i>&nbsp; Completed
									</button> -->
									<button type="button" class="btn btn-primary btn-sm" ng-click="OpenTestBenchModal();" ng-show="openTab || startTab">
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
									<!-- <th>
										Actions
									</th> -->
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
									<!-- <td>
										<div class="table-data-feature">
											<div class="btn-group p-r-10">
												<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-info">Action</button>
												<div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
													<button type="button" tabindex="0" class="dropdown-item">Started</button>
													<button type="button" tabindex="0" class="dropdown-item">Completed</button>

												</div>
											</div>
										</div>
									</td> -->
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
		</div>
	</div>



	<!-- modal scroll -->
    <div class="modal fade" id="testbenchmodal" tabindex="-1" role="dialog" aria-labelledby="testbenchmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testbenchmodalLabel">@{{testbenchmodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseTestBenchModal();" aria-label="Close">
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
			                                    <label class=" form-control-label"><b>Test Process</b> <span class="mandatory">*</span></label>
			                                </div>
		                                	<div class="col col-md-6">
                                                <div class="form-check form-check-inline">
                                                    <div class="radio">
                                                        <label for="result1" class="form-check-label ">
                                                            <input type="radio" id="result1" name="result" ng-model="testbenchmodal.result" value="1" class="form-check-input">Pass
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="result2" class="form-check-label ">
                                                            <input type="radio" id="result2" name="result" value="0" class="form-check-input" ng-model="testbenchmodal.result">Fail
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
			                            </div>
		                				<div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="comment" class=" form-control-label"><b>Comments</b></label>
			                                </div>
			                                <div class="col-12 col-md-6">
			                                    <textarea name="comment" id="comment" rows="3" placeholder="Comment" class="form-control" ng-model="testbenchmodal.comment"></textarea>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseTestBenchModal();">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddUserForm.$invalid" ng-click="SaveTestResult();">
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
	<script type="text/javascript" src="{{url('public/js/controllers/AutoTestBenchController.js')}}"></script>
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