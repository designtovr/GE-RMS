

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
                                        <input id="rmaidFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="RMA No #" ng-change="gridActions.filter()" ng-model="filterrmaid" filter-by="formatted_receipt_id" filter-type="text">
                                    </th>
                                       <th>
                                        <input id="family" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Family" ng-change="gridActions.filter()" ng-model="filtercode" filter-by="code" filter-type="text">
                                    </th>
                                       <th>
                                        <input id="modelFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Model #" ng-change="gridActions.filter()" ng-model="filtermodelno" filter-by="part_no" filter-type="text">
                                    </th>
                                       <th>
                                        <input id="serial_noFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Serial #" ng-change="gridActions.filter()" ng-model="filterserialno" filter-by="serial_no" filter-type="text">
                                    </th>

                                         <th>
                                        <input id="cusFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Customer" ng-change="gridActions.filter()" ng-model="customerFilter" filter-by="customer" filter-type="text">
                                    </th>
                                
                                    <th>
                                        <input type="text"
                                        class="form-control"
                                        placeholder="From Date"
                                        max-date="dateTo"
                                        ng-model = "dateFrom"
                                        filter-by="receipt_date"
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
                               
                          
                                <th>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="ResetSearch();gridActions.filter()">Reset</button>
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
                                        <th sortable="formatted_receipt_id" class="sortable">RMA No</th>
                                        <th sortable="receipt_date" class="sortable">Receipt Date</th>
                                        <th sortable="customer" class="sortable">Customer</th>
                                        <th sortable="location" class="sortable">Location</th>
                                        <th sortable="end_customer" class="sortable">End   Customer</th>
                                        <th sortable="current_status" class="sortable">Repair Status</th>
                                        <th sortable="code" class="sortable">Family</th>
                                        <th sortable="wch_type" class="sortable">Warranty/Chargeable</th>
                                        <th sortable="part_no" class="sortable">Model No.</th>
                                        <th sortable="serial_no" class="sortable">Serial No.</th>
                                        <th sortable="repair_initiated_date" class="sortable">Repair Initiation</th>
                                        <th sortable="repair_completed_at" class="sortable">Repair Completion</th>
                                        <th sortable="defect_by_customer" class="sortable">Defect Mentioned by Customer</th>
                                        <th sortable="power_on_test" class="sortable">Power ON  / Initial Observation at CRC </th>
                                        <th sortable="download_customer_setting" class="sortable">Customer Setting Extraction</th>
                                        <th sortable="pcb_part_no_1" class="sortable">PCB1 Part No.</th>
                                        <th sortable="pcb_defective_pcb_1" class="sortable">PCB1 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_1" class="sortable">PCB1 Healthy Ser no</th>
                                        <th sortable="pcb_part_no_2" class="sortable">PCB2 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB2 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB2 Healthy Ser no</th>
                                        <th sortable="pcb_part_no_3" class="sortable">PCB3 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB3 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB3 Healthy Ser no</th>
                                        <th sortable="pcb_part_no_4" class="sortable">PCB4 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB4 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB4 Healthy Ser no</th>
                                        <th sortable="pcb_part_no_5" class="sortable">PCB5 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB5 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB5 Healthy Ser no</th>
                                        <th sortable="pcb_part_no_" class="sortable">PCB6 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB6 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB6 Healthy Ser no</th>
                                        <th sortable="pcb_part_no_" class="sortable">PCB7 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB7 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB7 Healthy Ser no</th>
                                        <th sortable="pcb_part_no_" class="sortable">PCB8 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB8 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB8 Healthy Ser no</th>
                                        <th sortable="pcb_part_no_" class="sortable">PCB9 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB9 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB9 Healthy Ser no</th>
                                        <th sortable="pcb_part_no_" class="sortable">PCB9 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB9 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB9 Healthy Ser no</th>    
                                         <th sortable="pcb_part_no_" class="sortable">PCB10 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB10 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB11 Healthy Ser no</th>
                                             <th sortable="pcb_part_no_" class="sortable">PCB11 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB11 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB11 Healthy Ser no</th>
                                             <th sortable="pcb_part_no_" class="sortable">PCB12 Part No.</th>
                                        <th sortable="pcb_defective_pcb_" class="sortable">PCB12 Defective Ser no</th>
                                        <th sortable="pcb_new_pcb_" class="sortable">PCB12 Healthy Ser no</th>
                                        <th sortable="" class="sortable">TRANSFORMER & OTHER COMPONENTS</th>
                                        <th sortable="existing_sw_version" class="sortable">EXISTING SOFTWARE</th>
                                        <th sortable="updated_sw_version" class="sortable">UPGRADED SOFTWARE</th>
                                        <th sortable="download_customer_setting" class="sortable">Customer Setting Loaded</th>
                                        <th sortable="remark_by_verification" class="sortable">REMARKS by Verification</th>
                                        <th sortable="repaired_by" class="sortable">REPAIRED BY</th>
                                        <th sortable="current_status" class="sortable">Repair Status</th>
                                        <th sortable="dc_no" class="sortable">DOCKET No</th>
                                        <th sortable="docket_details" class="sortable">Delivery Challan Detail</th>
                                        <th sortable="dispatched_at" class="sortable">Dispatch date</th>
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
                                        <td ng-bind="item.formatted_rma_id"></td>
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
                                        <td ng-bind="item.download_customer_setting">12</td>
                                        <td ng-bind="item.pcb_part_no_1"></td>
                                        <td ng-bind="item.pcb_defective_pcb_1"></td>
                                        <td ng-bind="item.pcb_new_pcb_1"></td>
                                        <td ng-bind="item.pcb_part_no_2"></td>
                                        <td ng-bind="item.pcb_defective_pcb_2"></td>
                                        <td ng-bind="item.pcb_new_pcb_2"></td>
                                             <td ng-bind="item.pcb_part_no_3"></td>
                                        <td ng-bind="item.pcb_defective_pcb_3"></td>
                                        <td ng-bind="item.pcb_new_pcb_3"></td>
                                             <td ng-bind="item.pcb_part_no_4"></td>
                                              <td ng-bind="item.pcb_defective_pcb_4"></td>
                                        <td ng-bind="item.pcb_new_pcb_4"></td>
                                             <td ng-bind="item.pcb_part_no_5"></td>
                                        <td ng-bind="item.pcb_defective_pcb_5"></td>
                                        <td ng-bind="item.pcb_new_pcb_5"></td>
                                                 <td ng-bind="item.pcb_part_no_6"></td>
                                        <td ng-bind="item.pcb_defective_pcb_6"></td>
                                        <td ng-bind="item.pcb_new_pcb_6"></td>
                                             <td ng-bind="item.pcb_part_no_7"></td>
                                        <td ng-bind="item.pcb_defective_pcb_7"></td>
                                        <td ng-bind="item.pcb_new_pcb_7"></td>
                                              <td ng-bind="item.pcb_part_no_8"></td>
                                        <td ng-bind="item.pcb_defective_pcb_8"></td>
                                        <td ng-bind="item.pcb_new_pcb_8"></td>
                                              <td ng-bind="item.pcb_part_no_9"></td>
                                        <td ng-bind="item.pcb_defective_pcb_9"></td>
                                        <td ng-bind="item.pcb_new_pcb_9"></td>
                                              <td ng-bind="item.pcb_part_no_10"></td>
                                        <td ng-bind="item.pcb_defective_pcb_10"></td>
                                        <td ng-bind="item.pcb_new_pcb_10"></td>
                                              <td ng-bind="item.pcb_part_no_11"></td>
                                        <td ng-bind="item.pcb_defective_pcb_11"></td>
                                        <td ng-bind="item.pcb_new_pcb_11"></td>
                                        <td ng-bind="item.pcb_part_no_12"></td>
                                        <td ng-bind="item.pcb_defective_pcb_12"></td>
                                        <td ng-bind="item.pcb_new_pcb_12"></td>
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