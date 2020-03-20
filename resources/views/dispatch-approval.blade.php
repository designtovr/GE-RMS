@extends('layouts.app')
@section('title', 'Dispatch Approval List')
@section('content')
<div class="main-content" ng-controller="DispatchApprovalController">
	<div class="section__content section__content--p30" ng-init = "Initiate();getDispatches();Start()">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!showdpform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="display-5">Dispatch Approval List</h6>
			        </div>
			    </div>
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
                     {{--Tab Start--}}
         <div class="row  col-lg-12">
            <div class=" card w-100">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 p-b-20">
                            <ul class="list-inline">
                                <li>
                                    <button type="button" class="btn btn-primary btn-md float-right"
                                            ng-click="ShowDPForm();">
                                        <i class="fa fa-plus"></i>&nbsp;Approve Dispatch
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-primary btn-md float-right box m-r-10"  ng-click="exportToExcelSave('#dispatchapprovaltable' , 'DispatchApproval.xls')">
                                        <i class="fa fa-file-excel-o"></i>&nbsp;Export
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{--Tab Ends--}}
             
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" ng-click="GetPV('verificationcompleted')">
                                <a class="nav-link active" id="approval-tab" data-toggle="tab" href="#approval" role="tab" aria-controls="approval" aria-selected="true">Waiting For Approval</a>
                            </li>
                            <li class="nav-item" ng-click="GetPV('dispatchapproved')">
                                <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved</a>
                            </li>
                        </ul>
                        <!-- DATA TABLE-->
                        <div grid-data grid-options="gridOptions" grid-actions="gridActions">
                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                            <div class="overflow-auto">
                                <table class="table table-borderless table-data3  " id="dispatchapprovaltable" name="dispatchapprovaltable">
                                    <thead>
                                    <tr>
                                        <th>
                                            Select
                                        </th>
                                        <th ng-if="status == 'dispatchapproved'">
                                            Actions
                                        </th>
                                        <th sortable="formatted_pv_id" class="sortable">
                                            RID
                                        </th>
                                        <th sortable="formatted_rma_id" class="sortable">
                                            RMA Id
                                        </th>
                                        <th sortable="pvdate" class="sortable">
                                            Date
                                        </th>
                                        <th sortable="part_no" class="sortable">
                                            Model
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
                                        <th sortable="manager_comment" class="sortable">
                                            Comment
                                        </th>
                                        <th ng-if="status == 'dispatchapproved'" sortable="pvl_priority_for_display" class="sortable">
                                            Priority
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
                                        <td ng-if="status == 'dispatchapproved'">
                                            <div class="btn-group float-left">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-success" >Priority</button>
                                                <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu scrollable-menu">
                                                    <button ng-if="item.pvl_priority == 999999" type="button" tabindex="0" class="dropdown-item" ng-click="SetPVPriority(item.id, pvprioritylistmax)">Set New: @{{pvprioritylistmax}}</button>
                                                    <div ng-if="item.pvl_priority == 999999" tabindex="-1" class="dropdown-divider"></div>
                                                    <button ng-if="item.pvl_priority != pr.priority" type="button" tabindex="0" class="dropdown-item" ng-repeat="pr in pvprioritylist" ng-click="SetPVPriority(item.id, pr.priority)">@{{pr.priority}}</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td ng-bind="item.formatted_pv_id"></td>
                                        <td ng-bind="item.formatted_rma_id"></td>
                                        <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                                        <td ng-bind="item.part_no"></td>
                                        <td ng-bind="item.serial_no"></td>
                                        <td ng-bind="item.customer_name"></td>
                                        <td ng-bind="item.end_customer"></td>
                                        <td ng-bind="item.manager_comment"></td>
                                        <td ng-if="status == 'dispatchapproved'" ng-bind="item.pvl_priority_for_display"></td>
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
                                         items-per-page="paginationOptions.itemsPerPage">
                                    </grid-pagination>
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
                </div>
            </div>
         </div>
            </div>
	        <div class="row" ng-show="showdpform">
        		<div class="col-lg-12">
        			<div class="card">
        				<div class="card-header">
                            <strong>Dispatch</strong> Form
                        </div>
                        <div class="card-body card-block">
    	                	<form name="DispatchForm" id="DispatchForm" action="" method="post" class="form-horizontal">
    	                        <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="date" class=" form-control-label">Date<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="formdate" name="date" placeholder="Date" class="form-control"
											   ng-model="dispatch.date"
											   ng-minlength="3"
											   ng-maxlength="10"
											   required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="dc-no" class=" form-control-label">DC No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="dc-no" name="dc-no" placeholder="DC No" class="form-control"
											   ng-model="dispatch.dc_no"
											   required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Dispatch Method <span
                                        class="mandatory">*</span></label>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="form-check-inline form-check">
                                            <label for="method1" class="form-check-label ">
                                                <input type="radio" id="method1" name="method"
                                                ng-model="dispatch.method" ng-value="1"
                                                class="form-check-input">By Courier
                                            </label>
                                            <label for="method2" class="form-check-label ">
                                                <input type="radio" id="method2" name="method"
                                                ng-model="dispatch.method" ng-value="2"
                                                class="form-check-input">By Hand
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group" ng-if="dispatch.method == 1">
                                    <div class="col col-md-3">
                                        <label for="docket-details" class=" form-control-label">Docket Details <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="docket-details" name="docket-details" placeholder="Docket Details" class="form-control"
											   ng-model="dispatch.docket_details"
											   required>
                                    </div>
                                </div>
                                <div class="row form-group" ng-if="dispatch.method == 1">
                                    <div class="col col-md-3">
                                        <label for="courier-name" class=" form-control-label">Courier Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="courier-name" name="courier-name" placeholder="Courier Name" class="form-control"
											   ng-model="dispatch.courier_name"
											   required>
                                    </div>
                                </div>
                                <div class="row form-group" ng-if="dispatch.method == 2">
                                    <div class="col col-md-3">
                                        <label for="person_name" class=" form-control-label">Person Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="person_name" name="person_name" placeholder="Person Name" class="form-control"
											   ng-model="dispatch.person_name"
											   required>
                                    </div>
                                </div>
                                <div class="row form-group" ng-if="dispatch.method == 2">
                                    <div class="col col-md-3">
                                        <label for="concern_name" class=" form-control-label">Concern Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="concern_name" name="concern_name" placeholder="Concern Name" class="form-control"
                                               ng-model="dispatch.concern_name"
                                               required>
                                    </div>
                                </div>
                                <div class="row form-group" ng-if="dispatch.method == 2">
                                    <div class="col col-md-3">
                                        <label for="contact" class=" form-control-label">Contact No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                        type="text" 
                                        id="contact" 
                                        name="contact" 
                                        ng-model="dispatch.contact" 
                                        placeholder="Contact No" 
                                        class="form-control"
                                        ng-minlength="7" 
                                        ng-maxlength="15"
                                        ng-pattern="/^[0-9]*$/" 
                                        required>
                                    </div>
                                </div>
    	                	</form>
    	                </div>
    	                <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" ng-click = "AddDispatch()" ng-disabled="DispatchForm.$invalid">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-secondary btn-sm" ng-click="HideDPForm();">
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
	<script type="text/javascript" src="{{url('public/js/controllers/DispatchApprovalController.js')}}">
    </script>

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

             $(document).ready(function () {
            $("#formdate").datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });
        });
    </script>   
@endsection