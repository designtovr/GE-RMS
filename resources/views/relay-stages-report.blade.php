@extends('layouts.app')
@section('title', 'Relay Stage Report')
@section('content')
<div class="main-content" ng-controller="RelayStagesReportController">
	<div class="section__content section__content--p30" ng-init="GetRelayForStageReport();">
        <div class="container-fluid">
        	<div class="row">
        		<div class="col-md-12">
                    <div class="overview-wrap">
                        <h6 class="pb-4 display-5">Relay Stages Report</h6>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card-header card-title">
                        Search 
                    </div>
                    <div class="col-md-12">
                    	<div class="table-responsive">
	                        <table class="table table-borderless table-data3 table-custom">
	                            <thead>
	                                <tr>
	                                    <th>
	                                        <input id="ridFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="R Id#" ng-change="gridActions.filter()" ng-model="filterRId" filter-by="formatted_pv_id" filter-type="text">
	                                    </th>
                                        <th>
                                            <input id="rmaFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="RMA No#" ng-change="gridActions.filter()" ng-model="filterRMANo" filter-by="formatted_rma_id" filter-type="text">
                                        </th>
                                        <th>
                                            <input id="rcidFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="RC Id#" ng-change="gridActions.filter()" ng-model="filterRCId" filter-by="formatted_receipt_id" filter-type="text">
                                        </th>
	                                    <th>
	                                        <input id="serialnoFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Serial No#" ng-change="gridActions.filter()" ng-model="filterSerialNo" filter-by="serial_no" filter-type="text">
	                                    </th>
                                        <th>
                                            <input type="text"
                                                class="form-control"
                                               placeholder="From Date"

                                               max-date="dateTo"
                                               ng-model = "dateFrom"
                                               filter-by="created_date_unix"

                                               ng-change="gridActions.filter();"
                                               id="dateFromFilter"
                                               filter-type="dateFrom"
                                            />
                                        </th>
                                        <th>
                                            <input type="text"
                                            placeholder="To Date"
                                            filter-by="created_date_unix"
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
	                                        <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="ResetSearch();gridActions.filter()">Reset</button>
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
                            <button type="button" class="btn btn-primary btn-md float-right box m-r-10"  ng-click="exportToExcelSave('#relaystagetable' , 'RelayStageReport.xls')">
                                <i class="fa fa-file-excel-o"></i>&nbsp;Export
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div grid-data grid-options="gridOptions" grid-actions="gridActions">
                        <table class="table table-borderless table-data3" id="relaystagetable" name="relaystagetable">
                            <thead>
                                <tr>
                                	<th>Actions</th>
                                    <th sortable="formatted_pv_id" class="sortable">RId</th>
                                    <th sortable="formatted_rma_id" class="sortable">RMA No</th>
                                    <th sortable="formatted_receipt_id" class="sortable">Receipt Id</th>
                                    <th sortable="serial_no" class="sortable">Serial No</th>
                                    <th sortable="customer_name" class="sortable">Customer Name</th>
                                    <th sortable="created_date_unix" class="sortable">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr grid-item>
                                	<td>
    	                                <div class="table-data-feature float-left">
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Report" ng-click="GenerateReport(item.id)">
    	                                        <i class="zmdi zmdi-file-text"></i>
    	                                    </button>
    	                                </div>
    	                            </td>
    	                            <td ng-bind="item.formatted_pv_id"></td>
    	                            <td ng-bind="item.formatted_rma_id"></td>
    	                            <td ng-bind="item.formatted_receipt_id"></td>
    	                            <td ng-bind="item.serial_no"></td>
                                    <td ng-bind="item.customer_name"></td>
                                    <td ng-bind="item.created_date_unix | date:'dd/MM/yyyy'"></td>
                                </tr>
                            </tbody>
                        </table>
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
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/RelayStagesReportController.js')}}"></script>
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