<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="ge">
<head>
	<!-- Required meta tags-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="au theme template">
	<meta name="author" content="Hau Nguyen">
	<meta name="keywords" content="au theme template">

	<!-- Title Page-->
	<title>GE-RMS - @yield('title')</title>

	<!-- Fontfaces CSS-->
	<link rel="stylesheet" type="text/css" href="{{url('public/css/theme.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/css/animate.css')}}">
	<link href="{{url('public/css/font-face.css')}}" rel="stylesheet" media="all">
	<link rel="stylesheet" href="{{url('public/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" media="all">
	<link href="{{url('public/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

	<!-- Bootstrap CSS-->
	<link href="{{url('public/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

	<!-- Vendor CSS-->
	<link href="{{url('public/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
	<link rel="stylesheet" type="text/css" href="{{url('public/bower_components/nprogress/nprogress.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/bower_components/jquery-ui/themes/ui-lightness/jquery-ui.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.standalone.min.css')}}">
	<link rel="stylesheet/less" type="text/css" href="{{'public/js/bootstrap-less/bootstrap/dropdowns.less'}}" />
	<link rel="stylesheet/less" type="text/css" href="{{'public/js/bootstrap-less/bootstrap/sprites.less'}}" />
	<link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-ui-notification/dist/angular-ui-notification.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-confirm/dist/angular-confirm.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-ui-select/dist/select.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-bootstrap/ui-bootstrap-csp.css')}}">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.default.css"> -->
	<link rel="stylesheet" type="text/css" href="{{url('public/bower_components/selectize/dist/css/selectize.default.css')}}">
	<!-- Main CSS-->
	<!-- <link href="css/theme.css" rel="stylesheet" media="all"> -->

</head>
@section('title', 'Job Ticket List')
<body class="text-right" style="height: 1196px;padding-left: 30px;padding-right: 30px; font-family: 'Oswald', sans-serif !important;">
<div class="main-content" ng-controller="JobTicketFormController">
	<div class="section__content section__content--p30" ng-init="Start();">
	    <div class="container-fluid ">
	   {{-- 	<div class="row" ng-show="!showjtform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">Job Ticket List</h6>
			        </div>
			    </div>

				--}}{{-- Search Start--}}{{--
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
											   ng-model="filterID" filter-by="formatted_pv_id" filter-type="text">
									</th>
									<th>
										<input id="rmaidFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="RMA Id#" ng-change="gridActions.filter();"
											   ng-model="filterrmaID" filter-by="formatted_rma_id" filter-type="text">
									</th>
									<th>
										<input id="productFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Model No" ng-change="gridActions.filter();"
											   ng-model="filterpartno" filter-by="part_no"
											   filter-type="text">
									</th>
									<th>
										<input id="serialFilter" type="text"
											   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
											   placeholder="Serial No" ng-change="gridActions.filter();"
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
				--}}{{--Search End--}}{{--
				--}}{{--Filter--}}{{--


				--}}{{-- Table Start--}}{{--
					--}}{{--Tab Start--}}{{--
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
					--}}{{--Tab Ends--}}{{--
					<!-- DATA TABLE-->
					<div grid-data grid-options="gridOptions" grid-actions="gridActions">
						<!-- sample table layout goes below, but remember that you can you any mark-up here. -->
						<div class="overflow-auto">
							<table class="table table-borderless table-data3  ">
								<thead>
								<tr>

									<!-- <th ng-show="openTab">
										Select
									</th> -->
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
									<th>
										Actions
									</th>
								</tr>
								</thead>
								<tbody>
								<tr grid-item>
									<!-- <td ng-show="openTab">
										<label class="au-checkbox">
											<input type="checkbox" ng-model="item.create_jc">
											<span class="au-checkmark"></span>
										</label>
									</td> -->
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
									<td>
                                        <div class="table-data-feature">
                                        	<div class="btn-group" ng-if="page != 'sitecardafterjobticketcompleted'">
	                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-success" >Priority</button>
	                                            <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu scrollable-menu">
	                                            	<button ng-if="item.pvl_priority == 999999" type="button" tabindex="0" class="dropdown-item" ng-click="SetPVPriority(item.id, pvprioritylistmax)">Set New: @{{pvprioritylistmax}}</button>
	                                            	<div ng-if="item.pvl_priority == 999999" tabindex="-1" class="dropdown-divider"></div>
	                                                <button ng-if="item.pvl_priority != pr.priority" type="button" tabindex="0" class="dropdown-item" ng-repeat="pr in pvprioritylist" ng-click="SetPVPriority(item.id, pr.priority)">@{{pr.priority}}</button>
	                                            </div>
	                                        </div>
                                        	<button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenJTForm(item);">
												<i class="zmdi zmdi-edit"></i>
											</button>
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
				--}}{{--Table Ends--}}{{--
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
			                                    <label for="comment" class=" form-control-label">Repair Comment </label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <textarea 
			                                    name="comment" 
			                                    ng-model = "jobticket.comment" 
			                                    id="comment" 
			                                    rows="4" 
			                                    placeholder="" 
			                                    class="form-control"
			                                    >
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
		                                    <label for="new_pcp_@{{$index}}" class=" form-control-label">New PCB</label>
		                                </div>
		                                <div class="col-12 col-md-6">
		                                    <input 
		                                    type="text" 
		                                    id="new_pcp_@{{$index}}" 
		                                    ng-model="job_ticket_material.new_pcp"
		                                    name="new_pcp_@{{$index}}" 
		                                    placeholder="New PCB" 
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
	                        <button ng-if="page != 'sitecardafterjobticketcompleted'" type="submit" class="btn btn-primary btn-sm" ng-click="CompleteJTForm();">
	                            <i class="fa fa-dot-circle-o"></i> Complete
	                        </button>
	                        <button ng-if="page == 'sitecardafterjobticketcompleted'" type="submit" class="btn btn-primary btn-sm" ng-click="UpdateSiteJTForm();">
	                            <i class="fa fa-dot-circle-o"></i> Update Site Card
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
	        </div>--}}
<div class = "front">
<div class="text-uppercase">
			<div class="row">
				<div class="col" style="padding: 0;">
					<h1 class="text-right float-left d-md-flex justify-content-md-end" style="color: #000000;margin-top: 89px;margin-left: 350px;"><strong>Job Ticket</strong></h1><img src="./public/images/240px-ge-logo.png" class="img-fluid float-right d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px;margin-bottom: 0;"
					/></div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col">
					<h2 class="text-left float-left" style="font-size: 26px; color: #000000"><strong>Type Of Work : </strong></h2>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000"><strong>Repair </strong></h1>
				</div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000;height:  ;">P.O Date      : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">RMA<strong></strong>No    <strong>: </strong></h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair<strong></strong></h1>
				</div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Given Date<strong>  : </strong></h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Customer  <strong>: </strong></h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Taken Date  : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">End Customer  : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair<strong></strong></h1>
				</div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Model No   : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Serial No : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="row" style="margin-top: 45px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;height:  ;color: #000000">NATURE OF DEFECT : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="row" style="margin-top: -1px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;height:  ;color: #000000">POWER ON TEST      : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="row" style="margin-top: -1px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;height:  ;color: #000000">FIRMWARE               : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table tableStyle table-bordered">
					<thead>
					<tr>
						<th>SL No.</th>
						<th>Description</th>
						<th>Material Part No</th>
						<th>Qty</th>
						<th>Value (Rs)</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Text</td>
						<td>Text</td>
						<td>Text</td>
						<td>Cell 1</td>
						<td>Cell 2</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class="row" style="margin-top: 30px">
				<div class="col-5 float-left">
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top:0px;">Test Results Documented :</h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;"></h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;">Tested:</h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;">Sign:</h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;">Completed Date :</h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;">Category      :</h1>
				</div>

				<div class="col-7 float-right">
					<h1 class="text-left border border-dark" style="font-size: 26px;color:#000000;height:250px;padding :10px">Remarks :</h1>

				</div>

			</div>
</div>
<div class ="Footer" style="margin-top:100px;">
			<div class="row ">
		<div class="col" style="padding: 0;">
			<img src="./public/images/240px-ge-logo.png" class="img-fluid float-left d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px 0px;margin-bottom: 0;"
			/></div>
	</div>

	<div class = "row footerText">
		<h6> ALSTOM T&D India LTD , 19/1 , G.S.T Road ,Pallavaram,Chennai - 600 043</h6>
		<br>
		<h6 class ="font-weight-bold "> Tel: +91 44 22648000 FAX: +91 442264 0040.<u>www.alstom.com</u> </h6>
	</div>

	<div class ="row border-bottom border-dark">
	</div>
			<div class ="row">
			<div>
				<h6 style="color:#000000;margin-top:10px;">REGISTERED OFFICE: A18 - 1st floor, Okhla Industrial Area , Phase - II , New Delhi - 110 020</h6>
			</div>
			</div>
</div>
		</div>
	<div class = "back">

		<div class = "row m-t-70">
			<div class="col-md-12 m-t-70">
				<h1 class="text-center font-weight-bold" style="font-size:24px;color:#000000;" > <u>Details of Changed Components</u></h1>
	    </div>


		</div>
		<div class = "row ">
			<div class="col-12 border-top border-bottom border-dark">
				<div class="col-6 float-left">
					<h1 class="text-center" style="font-size:24px;color:#000000;" > <u>OLD COMPONENT</u></h1>
				</div>
				<div class="col-6 float-right ">
					<h1 class="text-center" style="font-size:24px;color:#000000;" > <u>NEW COMPONENT</u></h1>
				</div>
			</div>
	</div>

		<div class = "row ">
			<div class="col-12 border-bottom border-dark">
				<div class="col-6 float-left border-right border-dark h-250" style="height:600px">
				</div>
				<div class="col-6 float-right ">
				</div>
			</div>
		</div>


	</div>
	</div>
</div>
</body>
	<script src="{{url('public/bower_components/jquery/dist/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular/angular.min.js')}}"></script>
	<!-- Jquery JS-->
	<!-- Bootstrap JS-->
	<script src="{{url('public/vendor/bootstrap-4.1/popper.min.js')}}"></script>
	<script src="{{url('public/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
	<!-- Vendor JS       -->
	<script src="{{url('public/vendor/slick/slick.min.js')}}">
	</script>
	<script src="{{url('public/vendor/wow/wow.min.js')}}"></script>
	<script src="{{url('public/vendor/animsition/animsition.min.js')}}"></script>
	<script src="{{url('public/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
	</script>
	<script src="{{url('public/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
	<script src="{{url('public/vendor/counter-up/jquery.counterup.min.js')}}">
	</script>
	<script src="{{url('public/vendor/circle-progress/circle-progress.min.js')}}"></script>
	<script src="{{url('public/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
	<script src="{{url('public/vendor/chartjs/Chart.bundle.min.js')}}"></script>
	<script src="{{url('public/vendor/select2/select2.min.js')}}">
	</script>
	<script src="{{url('public/bower_components/nprogress/nprogress.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular-data-grid/src/js/dataGrid.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular-data-grid/src/js/pagination.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular-bootstrap/ui-bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular-animate/angular-animate.min.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular-sanitize/angular-sanitize.min.js')}}"></script>
	<!-- <script type="text/javascript" src="{{url('public/bower_components/jquery-ui/jquery-ui.js')}}"></script> -->
	<script type="text/javascript" src="{{url('public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular-ui-notification/dist/angular-ui-notification.min.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular-confirm/dist/angular-confirm.min.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular-ui-select/dist/select.min.js')}}"></script>
	<script type="text/javascript" src="{{url('public/bower_components/angular-ui-mask/dist/mask.min.js')}}"></script>

	<!-- Main JS-->
	<script src="{{url('public/js/main.js')}}"></script>
	<script type="text/javascript" src="{{url('public/js/app.js')}}"></script>
	<script type="text/javascript" src="{{url('public/js/services/datashareservice.js')}}"></script>
	<script type="text/javascript" src="{{url('public/js/services/ChangePVStatusService.js')}}"></script>
	<script type="text/javascript" src="{{url('public/js/services/PVPriorityService.js')}}"></script>
	<script>
		function openNav() {
			document.getElementById("mySidebar").style.width = "300px";
		}

		function closeNav() {
		}


	</script>
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
