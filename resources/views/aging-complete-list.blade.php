@extends('layouts.app')
@section('title', 'Aging List')
@section('content')
<div class="main-content" ng-controller="AgingCompleteController">
	<div class="section__content section__content--p30" ng-init ="Start();">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="overview-wrap">
						<h6 class="pb-4 display-5">Aging List</h6>
					</div>
				</div>
				{{-- Search Start--}}
				<div class="col-md-12 ">
					<div class="card-header card-title">
						Search
					</div>
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
                 {{--Search End--}}
                 {{-- Table Start--}}
                 {{--Tab Start--}}
                 <div class="row  col-lg-12">
                 	<div class=" card w-100">
                 		<div class="card-body">
                 			<div class="row col-md-12 p-0">
                 				<div class="col-md-9">
                 					<ul class="nav nav-tabs" id="myTab" role="tablist">
                 						<li class="nav-item" ng-click="LoadData('1');GetPV('atbcompleted')">
                 							<a class="nav-link active" id="all-tab" data-toggle="tab" href="#open" role="tab" aria-controls="all" aria-selected="true">Open</a>
                 						</li>
                 						<li class="nav-item" ng-click="LoadData('2');GetPV('agingstarted')">
                 							<a class="nav-link" id="withrma-tab" data-toggle="tab" href="#started" role="tab" aria-controls="withrma" aria-selected="false">Started</a>
                 						</li>
                 						<li class="nav-item" ng-click="LoadData('3');GetPV('inrepair')">
                 							<a class="nav-link" id="withoutrma-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="withoutrma" aria-selected="false">Completed</a>
                 						</li>
                 					</ul>
                 				</div>
                 				<div class="col-md-3 col-md-offset-3  p-0 m-r-0" >
                 					<div class = "pull-right">
                 						<button type="button" class="btn btn-primary btn-sm" ng-show="openTab" ng-click="ChangeStatus('agingstarted')">
                 							<i class="fa fa-check"></i>&nbsp; Started
                 						</button>

                 						<button type="button" class="btn btn-primary btn-sm" ng-show="startTab || completedTab" ng-click="OpenAgingModal()">
                 							<i class="fa fa-check"></i>&nbsp; Result
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
                 									Serial
                 								</th>
                 								<th sortable="customer_name" class="sortable">
                 									Customer
                 								</th>
                 								<th sortable="end_customer" class="sortable">
                 									End Customer
                 								</th>

                 								<th sortable="testing_comment" class="sortable">
                 									Testing Comment
                 								</th>

                                                <th ng-show="startTab || !openTab" sortable="aging_comment" class="sortable">
                                                    Aging Comment
                                                </th>
                                                <th sortable="pvl_priority_for_display" class="sortable">
                                                    Priority
                                                </th>
                                                <th>
                                                    Actions
                                                </th>
                 								<!-- <th ng-if="openTab || startTab">
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
                 								<td ng-bind="item.formatted_pv_id"></td>
                                                <td ng-bind="item.formatted_rma_id"></td>
                 								<td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                 								<td ng-bind="item.part_no"></td>
                 								<td ng-bind="item.serial_no"></td>
                 								<td ng-bind="item.customer_name"></td>
                 								<td ng-bind="item.end_customer"></td>
                 								<td ng-bind="item.testing_comment"></td>
                                                <td ng-show="startTab || !openTab" ng-bind="item.aging_comment"></td>
                 								<td ng-bind="item.pvl_priority_for_display"></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-success" >Priority</button>
                                                        <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu scrollable-menu">
                                                            <button ng-if="item.pvl_priority == 999999" type="button" tabindex="0" class="dropdown-item" ng-click="SetPVPriority(item.id, pvprioritylistmax)">Set New: @{{pvprioritylistmax}}</button>
                                                            <div ng-if="item.pvl_priority == 999999" tabindex="-1" class="dropdown-divider"></div>
                                                            <button ng-if="item.pvl_priority != pr.priority" type="button" tabindex="0" class="dropdown-item" ng-repeat="pr in pvprioritylist" ng-click="SetPVPriority(item.id, pr.priority)">@{{pr.priority}}</button>
                                                        </div>
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
        </div>
    </div>
 <!-- modal scroll -->
    <div class="modal fade" id="agingmodal" tabindex="-1" role="dialog" aria-labelledby="agingmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agingmodalLabel">@{{agingmodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseAgingModal();" aria-label="Close">
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
                                                            <input type="radio" id="result1" name="result" ng-model="agingmodal.result" value="1" class="form-check-input">Pass
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="result2" class="form-check-label ">
                                                            <input type="radio" id="result2" name="result" value="0" class="form-check-input" ng-model="agingmodal.result">Fail
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
                                                <textarea name="comment" id="comment" rows="3" placeholder="Comment" class="form-control" ng-model="agingmodal.comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseAgingModal();">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddUserForm.$invalid" ng-click="SaveAgingResult();">
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
<script type="text/javascript" src="{{url('public/js/controllers/AgingCompleteController.js')}}"></script>
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