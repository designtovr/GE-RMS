

@extends('layouts.app')
@section('title', 'Repair Report')
@section('content')
<div class="main-content" ng-controller="RepairReportController">
    <div class="section__content section__content--p30" ng-init="GetRepairReport()">
        <div class="container-fluid">
            <div class="row" ng-show="!receiptform">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h6 class="pb-4 display-5">Repair Report</h6>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="card-header card-title">
                        Search 
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-data3 table-custom">
                            <thead>
                                <tr>
                                    <th>
                                        <input id="ridFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Receipt ID #" ng-change="gridActions.filter()" ng-model="filterid" filter-by="formatted_receipt_id" filter-type="text">
                                    </th>
                                    <th>
                                        <input id="rmaidFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="RMA No #" ng-change="gridActions.filter()" ng-model="filterrmaid" filter-by="formatted_rma_id" filter-type="text">
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
                                     <input id="customerFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Customer Name" ng-change="gridActions.filter()" ng-model="filterCustomer" filter-by="customer_name" filter-type="text">
                                 </th>
                                 <th>
                                    <input id="docketdetailsFilter"
                                    type="text"
                                    class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
                                    placeholder="Docket Details"
                                    ng-change="gridActions.filter();"
                                    ng-model="filterdocketdetails"
                                    filter-by="docket_details"
                                    filter-type="text">
                                </th>
                                <th>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="Reset();gridActions.filter()">Reset</button>
                                </th>
                                <th>
                                        <!-- <button type="button" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-search"></i>&nbsp; Search
                                        </button> -->
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class = "row">
                        @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                        <div class="col-md-12 p-b-20">
                            <ul class="list-inline">
                                <li>
                                    <button type="button" class="btn btn-primary btn-md float-right box m-r-10"  ng-click="exportToExcelSave('#repairreporttable' , 'RepairReport.xls')">
                                        <i class="fa fa-file-excel-o"></i>&nbsp;Export
                                    </button>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div grid-data grid-options="gridOptions" grid-actions="gridActions">
                            <table class="table table-borderless table-data3 table-responsive" id="repairreporttable" name="repairreporttable">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th sortable="formatted_rma_id" class="sortable">RMA No</th>
                                        <th sortable="receipt_date" class="sortable">Receipt Date</th>
                                        <th sortable="customer_name" class="sortable">Customer</th>
                                        <th sortable="location" class="sortable">Location</th>
                                        <th sortable="serial_no" class="sortable">End   Customer</th>
                                        <th sortable="created_date_unix" class="sortable">Repair Status</th>
                                        <th sortable="" class="sortable">Family</th>
                                        <th sortable="" class="sortable">Warranty/Chargeable</th>
                                        <th sortable="" class="sortable">Model No.</th>
                                        <th sortable="" class="sortable">Serial No.</th>
                                        <th sortable="" class="sortable">Repair Initiation</th>
                                        <th sortable="" class="sortable">Repair Completion</th>
                                        <th sortable="" class="sortable">Defect Mentioned by Customer</th>
                                        <th sortable="" class="sortable">Power ON  / Initial Observation at CRC </th>
                                        <th sortable="" class="sortable">Customer Setting Extraction</th>
                                        <th sortable="" class="sortable">PCB1 Name</th>
                                        <th sortable="" class="sortable">PCB1 Part No.</th>
                                        <th sortable="" class="sortable">PCB1 Defective Ser no</th>
                                        <th sortable="" class="sortable">PCB1 Healthy Ser no</th>
                                        <th sortable="" class="sortable">PCB2 Name</th>
                                        <th sortable="" class="sortable">PCB2 Part No.</th>
                                        <th sortable="" class="sortable">PCB2 Defective Ser no</th>
                                        <th sortable="" class="sortable">PCB2 Healthy Ser no</th>
                                        <th sortable="" class="sortable">PCB3 Name</th>
                                        <th sortable="" class="sortable">PCB3 Part No.</th>
                                        <th sortable="" class="sortable">PCB3 Defective Ser no</th>
                                        <th sortable="" class="sortable">PCB3 Healthy Ser no</th>
                                        <th sortable="" class="sortable">PCB4 Name</th>
                                        <th sortable="" class="sortable">PCB4 Part No.</th>
                                        <th sortable="" class="sortable">PCB4 Defective Ser no</th>
                                        <th sortable="" class="sortable">PCB4 Healthy Ser no</th>
                                        <th sortable="" class="sortable">PCB5 Name</th>
                                        <th sortable="" class="sortable">PCB5 Part No.</th>
                                        <th sortable="" class="sortable">PCB5 Defective Ser no</th>
                                        <th sortable="" class="sortable">PCB5 Healthy Ser no</th>
                                        <th sortable="" class="sortable">PCB6 Name</th>
                                        <th sortable="" class="sortable">PCB6 Part No.</th>
                                        <th sortable="" class="sortable">PCB6 Defective Ser no</th>
                                        <th sortable="" class="sortable">PCB6 Healthy Ser no</th>
                                        <th sortable="" class="sortable">TRANSFORMER & OTHER COMPONENTS</th>
                                        <th sortable="" class="sortable">EXISTING SOFTWARE</th>
                                        <th sortable="" class="sortable">UPGRADED SOFTWARE</th>
                                        <th sortable="" class="sortable">Customer Setting Loaded</th>
                                        <th sortable="" class="sortable">REMARKS by Verification</th>
                                        <th sortable="" class="sortable">REPAIRED BY</th>
                                        <th sortable="" class="sortable">Repair Status</th>
                                        <th sortable="" class="sortable">DOCKET No</th>
                                        <th sortable="" class="sortable">Delivery Challan Detail</th>
                                        <th sortable="" class="sortable">Dispatch date</th>
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
                                        <td ng-bind="item.formatted_receipt_id"></td>
                                        <td ng-bind="item.receipt_date  | date:'dd/MM/yyyy'"></td>
                                        <td ng-bind="item.customer"></td>
                                        <td ng-bind="item.location"></td>
                                        <td ng-bind="item.end_customer"></td>
                                        <td ng-bind="item.current_status"></td>
                                        <td ng-bind="item.code"></td>
                                        <td ng-bind="item.wch_type"></td>
                                        <td ng-bind="item.part_no"></td>
                                        <td ng-bind="item.serial_no"></td>
                                        <td ng-bind="item.repair_initiated_date"></td>
                                        <td ng-bind="item.repair_completed_at"></td>
                                        <td ng-bind="item.defect_by_customer"></td>
                                        <td ng-bind="item.power_on_test"></td>
                                        <td ng-bind="item.download_customer_setting"></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>         
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>
                                        <td ng-bind=""></td>   
                                        <td ng-bind="item.existing_sw_version"></td>
                                        <td ng-bind="item.updated_sw_version"></td>
                                        <td ng-bind="item.download_customer_setting"></td>
                                        <td ng-bind="item.remark_by_verification"></td>
                                        <td ng-bind="item.repaired_by"></td>
                                        <td ng-bind="item.current_status"></td>
                                        <td ng-bind="item.dc_no"></td>
                                        <td ng-bind="item.docket_details"></td>
                                        <td ng-bind="item.dispatched_at"></td>

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
                                <option>100000</option>
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
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{url('public/js/controllers/RepairReportController.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#receipt_date").datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            setDate: new Date(),
            update: new Date()
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

    });
</script>

<script type="text/javascript">
    function Export() {
        $("#receipttable").table2excel({
            filename: "Table.xls"
        });
    }
</script>
@endsection