@extends('layouts.app')
@section('title', 'Warranty Declaration')
@section('content')
<div class="main-content" ng-controller="WarrantyController">
    <div class="section__content section__content--p30" ng-init="GetPVList();">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h6 class="pb-4 display-5">W/C Declaration</h6>
                    </div>
                </div>
                <div class="col-md-12 ">
                   <div class="card-header card-title">
                         Search 
                     </div>
                     <div >
                        <div class="table-responsive">
                            <table class="table table-borderless table-data3 table-custom">
                                <thead>
                                    <tr>
                                        <th>
                                            <input id="ridFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="RID #" ng-change="gridActions.filter();" ng-model="filterID" filter-by="formatted_pv_id" filter-type="text">
                                        </th>
                                        <th>
                                            <input id="rmaidFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="RMA ID #" ng-change="gridActions.filter();" ng-model="filterRMAID" filter-by="formatted_rma_id" filter-type="text">
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

                                            <input id="productFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Model No" ng-change="gridActions.filter();" ng-model="productFilter" filter-by="part_no" filter-type="text">
                                        </th>
                                        <th>

                                            <input id="serialFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Serial No" ng-change="gridActions.filter();" ng-model="serialFilter" filter-by="serial_no" filter-type="text">
                                        </th>
                                        <th>
                                           <input id="customerFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Customer Name" ng-change="gridActions.filter()" ng-model="filterCustomer" filter-by="customer_name" filter-type="text">
                                       </th>
                                       <th>
                                           <input id="endcustomerFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="End Customer" ng-change="gridActions.filter()" ng-model="filterendCustomer" filter-by="end_customer" filter-type="text">
                                       </th>
                                       <th>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="Reset();gridActions.filter()">Reset</button>
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

                <div class="col-md-12 p-b-20">
                    <div class=" card w-100">
                        <!-- <div class="card-header">
                            <h4>Warranty List</h4>
                        </div> -->
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="manager-tab" ng-click="GetPVList('managerapproval')" data-toggle="tab" href="#manager" role="tab" aria-controls="manager" aria-selected="true">Waiting For Manager Approval</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="customer-tab" ng-click="GetPVList('customerapproval')" data-toggle="tab" href="#customer" role="tab" aria-controls="customer" aria-selected="false">Waiting For Customer Approval</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="jobticket-tab" ng-click="GetPVList('jobticketopen')" data-toggle="tab" href="#jobticket" role="tab" aria-controls="jobticket" aria-selected="false">In Job Ticket</a>
                                </li>
                            </ul>
                            <div class="tab-content pl-3 p-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="manager" role="tabpanel" aria-labelledby="manager-tab">
                                    <div class="row">
                                        <div class="col-md-12 m-b-10">
                                            <ul class="list-inline">
                                                <li>
                                                    <button type="button" class="btn btn-primary btn-md float-right"
                                                    ng-click="OpenWarrantyModal();">
                                                        <i class="fa fa-check-circle"></i>&nbsp;W/C
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="btn btn-primary btn-md float-right m-r-10"  ng-click="exportToExcelSave('#managerapprovaltable' , 'WaitingForManagerApproval.xls')">
                                                        <i class="fa fa-file-excel-o"></i>&nbsp;Export
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12">
                                        <!-- DATA TABLE-->
                                            <div grid-data grid-options="gridOptions" grid-actions="gridActions"  >
                                                <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                                <div class = "overflow-auto">
                                                    <table class="table table-borderless table-data3  " id="managerapprovaltable" name="managerapprovaltable">
                                                        <thead>
                                                            <tr>
                                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                                <th>
                                                                    Select
                                                                </th>
                                                                @endif
                                                                <th sortable="formatted_pv_id" class="sortable">
                                                                    RID
                                                                </th>
                                                                <th sortable="formatted_rma_id" class="sortable">
                                                                    RMA Id
                                                                </th>
                                                                <th  sortable="date_unix" class="sortable">
                                                                    Date
                                                                </th>
                                                                <th sortable="part_no" class="sortable">
                                                                    Model No
                                                                </th>
                                                                <th  sortable="serial_no" class="sortable">
                                                                    Serial
                                                                </th>
                                                                <th  sortable="customer_name" class="sortable">
                                                                    Customer Name
                                                                </th>
                                                                <th  sortable="end_customer" class="sortable">
                                                                    End Customer
                                                                </th>
                                                                <th  sortable="comment" class="sortable">
                                                                    Physical Verification Comment
                                                                </th>
                                                                <th  sortable="customer_comment" class="sortable">
                                                                    Defect by Customer
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr grid-item>
                                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                                <td>
                                                                    <label class="au-checkbox">
                                                                        <input type="checkbox" ng-model="item.create_wc">
                                                                        <span class="au-checkmark"></span>
                                                                    </label>
                                                                </td>
                                                                @endif
                                                                <td ng-bind="item.formatted_pv_id"></td>
                                                                <td ng-bind="item.formatted_rma_id"></td>
                                                                <td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>
                                                                <td ng-bind="item.part_no"></td>
                                                                <td ng-bind="item.serial_no"></td>
                                                                <td ng-bind="item.customer_name"></td>
                                                                <td ng-bind="item.end_customer"></td>
                                                                <td ng-bind="item.comment"></td>
                                                                <td ng-bind="item.customer_comment"></td>
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
                                                        <option>10000000</option>
                                                    </select>
                                                    </div>
                                                </form>
                                            </div>
                                    <!-- END DATA TABLE-->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                                    <div class="row">
                                        <div class="col-md-12 m-b-10">
                                            <ul class="list-inline">
                                                <li>
                                                    <button type="button" class="btn btn-primary btn-md float-right"
                                                    ng-click="OpenWarrantyModal();">
                                                    <i class="fa fa-check-circle"></i>&nbsp;W/C
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="btn btn-primary btn-md float-right m-r-10"  ng-click="exportToExcelSave('#customerapprovaltable' , 'WaitingForCustomerApproval.xls')">
                                                        <i class="fa fa-file-excel-o"></i>&nbsp;Export
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12">
                                        <!-- DATA TABLE-->
                                            <div grid-data grid-options="gridOptions" grid-actions="gridActions"  >
                                                <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                                <div class = "overflow-auto">
                                                    <table class="table table-borderless table-data3  " id="customerapprovaltable" name="customerapprovaltable">
                                                        <thead>
                                                            <tr>
                                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                                <th>
                                                                    Select
                                                                </th>
                                                                @endif
                                                                <th sortable="formatted_pv_id" class="sortable">
                                                                    RID
                                                                </th>
                                                                <th sortable="formatted_rma_id" class="sortable">
                                                                    RMA Id
                                                                </th>
                                                                <th  sortable="pvdate" class="sortable">
                                                                    Date
                                                                </th>
                                                                <th sortable="part_no" class="sortable">
                                                                    Model No
                                                                </th>
                                                                <th  sortable="serial_no" class="sortable">
                                                                    Serial No
                                                                </th>
                                                                <th  sortable="customer_name" class="sortable">
                                                                    Customer Name
                                                                </th>
                                                                <th  sortable="end_customer" class="sortable">
                                                                    End Customer
                                                                </th>

                                                                <th  sortable="comment" class="sortable">
                                                                    Phy. Verification Comment
                                                                </th>
                                                                <th  sortable="customer_comment" class="sortable">
                                                                    Defect by Customer
                                                                </th>
                                                                <th  sortable="manager_comment" class="sortable">
                                                                    Manager Comment
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr grid-item>
                                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                                <td>
                                                                    <label class="au-checkbox">
                                                                        <input type="checkbox" ng-model="item.create_wc">
                                                                        <span class="au-checkmark"></span>
                                                                    </label>
                                                                </td>
                                                                @endif
                                                                <td ng-bind="item.formatted_pv_id"></td>
                                                                <td ng-bind="item.formatted_rma_id"></td>
                                                                <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                                                                <td ng-bind="item.part_no"></td>
                                                                <td ng-bind="item.serial_no"></td>
                                                                <td ng-bind="item.customer_name"></td>
                                                                <td ng-bind="item.end_customer"></td>
                                                                <td ng-bind="item.comment"></td>
                                                                <td ng-bind="item.customer_comment"></td>
                                                                <td ng-bind="item.manager_comment"></td>
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
                                                        <option>10000000</option>
                                                    </select>
                                                    </div>
                                                </form>
                                            </div>
                                    <!-- END DATA TABLE-->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="jobticket" role="tabpanel" aria-labelledby="jobticket-tab">
                                    <div class="row">
                                        <div class="col-md-12 m-b-10">
                                            <ul class="list-inline">
                                                <li>
                                                    <button type="button" class="btn btn-primary btn-md float-right"
                                                    ng-click="OpenWarrantyModal();">
                                                    <i class="fa fa-check-circle"></i>&nbsp;W/C
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="btn btn-primary btn-md float-right m-r-10"  ng-click="exportToExcelSave('#jobtickettable' , 'JobTicket.xls')">
                                                        <i class="fa fa-file-excel-o"></i>&nbsp;Export
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12">
                                        <!-- DATA TABLE-->
                                            <div grid-data grid-options="gridOptions" grid-actions="gridActions"  >
                                                <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                                <div class = "overflow-auto">
                                                    <table class="table table-borderless table-data3  " id="jobtickettable" name="jobtickettable">
                                                        <thead>
                                                            <tr>
                                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                                <th>
                                                                    Select
                                                                </th>
                                                                @endif
                                                                <th sortable="formatted_pv_id" class="sortable">
                                                                    RID
                                                                </th>
                                                                <th sortable="formatted_rma_id" class="sortable">
                                                                    RMA Id
                                                                </th>
                                                                <th  sortable="pvdate" class="sortable">
                                                                    Date
                                                                </th>
                                                                <th sortable="part_no" class="sortable">
                                                                    Model No
                                                                </th>
                                                                <th  sortable="serial_no" class="sortable">
                                                                    Serial No
                                                                </th>
                                                                <th  sortable="customer_name" class="sortable">
                                                                    Customer Name
                                                                </th>
                                                                <th  sortable="end_customer" class="sortable">
                                                                    End Customer
                                                                </th>

                                                                <th  sortable="comment" class="sortable">
                                                                    Phy. Verification Comment
                                                                </th>
                                                                <th  sortable="customer_comment" class="sortable">
                                                                    Defect by Customer
                                                                </th>
                                                                <th  sortable="manager_comment" class="sortable">
                                                                    Manager Comment
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr grid-item>
                                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                                <td>
                                                                    <label class="au-checkbox">
                                                                        <input type="checkbox" ng-model="item.create_wc">
                                                                        <span class="au-checkmark"></span>
                                                                    </label>
                                                                </td>
                                                                @endif
                                                                <td ng-bind="item.formatted_pv_id"></td>
                                                                <td ng-bind="item.formatted_rma_id"></td>
                                                                <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                                                                <td ng-bind="item.part_no"></td>
                                                                <td ng-bind="item.serial_no"></td>
                                                                <td ng-bind="item.customer_name"></td>
                                                                <td ng-bind="item.end_customer"></td>
                                                                <td ng-bind="item.comment"></td>
                                                                <td ng-bind="item.customer_comment"></td>
                                                                <td ng-bind="item.manager_comment"></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal scroll -->
    <div class="modal fade" id="warrantymodal" tabindex="-1" role="dialog" aria-labelledby="warrantymodalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="warrantymodalLabel">@{{warrantymodal.title}}</h5>
            <button type="button" class="close" ng-click="CloseWarrantyModal();" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="post" class="form-horizontal" name="AddWarrantyForm"
                    id="AddWarrantyForm" novalidate>
                    <div class="row b-b-1">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col col-md-6">
                                    <label class=" form-control-label"><b>SMP</b> <span
                                        class="mandatory">*</span></label>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="form-check">
                                            <div class="radio">
                                                <label for="radio1" class="form-check-label ">
                                                    <input type="radio" id="radio1" name="smp_chargeable"
                                                    value="1" class="form-check-input"
                                                    ng-model = "warrantymodal.smp" ng-change ="ValidateStatus()"
                                                    ng-checked="warrantymodal.smp == 1">Chargable
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio2" class="form-check-label ">
                                                    <input type="radio" id="radio2" name="smp" ng-model = "warrantymodal.smp" 
                                                    value="2" class="form-check-input" ng-change ="ValidateStatus()" ng-checked="warrantymodal.smp == 2">Warranty
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <label class=" form-control-label"><b>PCP</b> <span
                                            class="mandatory">*</span></label>
                                        </div>
                                        <div class="col col-md-6">
                                            <div class="form-check">
                                                <div class="radio">
                                                    <label for="pcp1" class="form-check-label ">
                                                        <input type="radio" id="pcp1" name="pcp"
                                                        value="1" ng-model = "warrantymodal.pcp" class="form-check-input" ng-change ="ValidateStatus()"
                                                        ng-checked="warrantymodal.pcp == 1">Chargable
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label for="pcp2" class="form-check-label ">
                                                        <input type="radio" id="pcp2" name="pcp" ng-model = "warrantymodal.pcp"
                                                        value="2" class="form-check-input" ng-change ="ValidateStatus()" ng-checked="warrantymodal.pcp == 2">Warranty
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row b-b-1 p-t-20">
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6">
                                            <label class=" form-control-label"><b>Type</b> <span
                                                class="mandatory">*</span></label>
                                            </div>
                                            <div class="col col-md-6">
                                                <div class="form-check">
                                                    <div class="radio">
                                                        <label for="type1" class="form-check-label ">
                                                            <input type="radio" id="type1" name="type" ng-model = "warrantymodal.type"
                                                            value="1" class="form-check-input" ng-checked="warrantymodal.type == 1">Repair
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="type2" class="form-check-label ">
                                                            <input type="radio" id="type2" name="type" ng-model = "warrantymodal.type"
                                                            value="2" class="form-check-input" ng-checked="warrantymodal.type == 2">Modification
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="type3" class="form-check-label ">
                                                            <input type="radio" id="type3" name="type" ng-model = "warrantymodal.type"
                                                            value="3" class="form-check-input" ng-checked="warrantymodal.type == 3">Investigation
                                                        </label>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-6">
                                                <label class=" form-control-label"><b>Move To</b> <span
                                                    class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="move1" class="form-check-label ">
                                                                <input type="radio" id="move1" name="move" ng-model = "warrantymodal.move"
                                                                value="1" class="form-check-input" ng-checked="warrantymodal.move == 1">Repair
                                                                Rack
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="move2" class="form-check-label ">
                                                                <input type="radio" id="move2" name="move" ng-model = "warrantymodal.move"
                                                                value="2" class="form-check-input" ng-checked="warrantymodal.move == 2">Customer
                                                                Hold Rack
                                                            </label>
                                                        </div>

                                                        <div ng-show = show_rca_options>
                                                            <div class="radio">
                                                                <label for="move3" class="form-check-label ">
                                                                    <input type="radio" id="move3" name="move" ng-model = "warrantymodal.move"
                                                                    value="3" class="form-check-input" ng-checked="warrantymodal.move == 3">Post Lab

                                                                </label>
                                                            </div>

                                                            <div class="radio">
                                                                <label for="move4" class="form-check-label ">
                                                                    <input type="radio" id="move4" name="move" ng-model = "warrantymodal.move"
                                                                    value="4" class="form-check-input" ng-checked="warrantymodal.move == 4">Application Lab
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-6 offset-md-6">
                                            <div class="row form-group col-md-2">
                                                <label class=" form-control-label"><b>RCA</b></label>

                                            </div>

                                            <div class="checkbox  col-md-2 offset-md-1">
                                                    <label class="au-checkbox">
                                                        <input type="checkbox" id="rca" name="rca" name="rca" ng-model = "warrantymodal.rca" ng-change ="OnRCAChanged()"
                                                    value="1" class="form-check-input">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20" ng-show ="show_po">
                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="po" class="form-control-label"><b>PO</b></label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input 
                                                        type="text" 
                                                        id="po"  
                                                        placeholder="PO" 
                                                        name="po" 
                                                        ng-model="warrantymodal.po"
                                                        class="form-control"
                                                        ng-minlength="3"
                                                        ng-maxlength="100"
                                                        >
                                                        <div ng-show="AddWarrantyForm.po.$touched && AddWarrantyForm.po.$error">
                                                            <span class="help-block"
                                                             ng-show="AddWarrantyForm.po.$error.minlength">
                                                                Minimum 3 Characters Required
                                                            </span>
                                                            <span class="help-block"
                                                             ng-show="AddWarrantyForm.po.$error.maxlength">
                                                                Maximum 100 Characters Allowed
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-t-20" ng-show ="show_wbs">
                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="wbs" class=" form-control-label"><b>WBS / SO</b>
                                                            <span class="mandatory">*</span></label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input 
                                                            type="text" 
                                                            id="wbs"  
                                                            placeholder="WBS" 
                                                            name="wbs" 
                                                            ng-model = "warrantymodal.wbs"
                                                            class="form-control"
                                                            ng-minlength="3"
                                                            ng-maxlength="100"
                                                            required>
                                                            <div ng-show="AddWarrantyForm.wbs.$touched && AddWarrantyForm.wbs.$error">
                                                                <span class="help-block"
                                                                 ng-show="AddWarrantyForm.wbs.$error.required">
                                                                    Please Enter WBS
                                                                </span>
                                                                <span class="help-block"
                                                                 ng-show="AddWarrantyForm.wbs.$error.minlength">
                                                                    Minimum 3 Characters Required
                                                                </span>
                                                                <span class="help-block"
                                                                 ng-show="AddWarrantyForm.wbs.$error.maxlength">
                                                                    Maximum 100 Characters Allowed
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="comment" class=" form-control-label"><b>Comment</b>
                                                            </label>
                                                            </div>
                                                            <div class="col-12 col-md-9">
                                                                <textarea 
                                                                type="text" 
                                                                id="comment" 
                                                                name="comment"
                                                                ng-model="warrantymodal.comment"
                                                                placeholder="Comment" 
                                                                class="form-control"
                                                                rows="4">
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div ng-show = show_rca_options>
                                                    <!-- <div class="row p-t-20">
                                                        <div class="col-md-12">
                                                            <div class="row form-group">
                                                                <div class="col col-md-3">
                                                                    <label for="mail" class=" form-control-label"><b>  RID </b>
                                                                        <span class="mandatory">*</span></label>
                                                                    </div>
                                                                    <div class="col-12 col-md-9">
                                                                        <ui-select multiple ng-model="warrantymodal.selectedRID" theme="bootstrap"  sortable="true" close-on-select="false">
                                                                            <ui-select-match placeholder="Select RID...">@{{$item}}</ui-select-match>
                                                                            <ui-select-choices class = "d-block" repeat=" rid in selectedpvs | filter: $select.search">
                                                                                <div ng-bind-html="rid"></div>
                                                                            </ui-select-choices>
                                                                        </ui-select>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div> -->
                                                    </div>
                                                    <div ng-show = show_rca_options>
                                                        <div class="row p-t-20">
                                                            <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <div class="col col-md-3">
                                                                      <label for="mail" class=" form-control-label"><b>Mail To: </b>
                                                                        <span class="mandatory">*</span></label>
                                                                    </div>
                                                                    <div class="col-12 col-md-9">
                                                                        <ui-select multiple ng-model="warrantymodal.selectedPeople" theme="bootstrap"  sortable="true" close-on-select="false" >
                                                                            <ui-select-match ng-change="Debug()" placeholder="Select person...">@{{$item.email}}</ui-select-match>
                                                                            <ui-select-choices class = "d-block" repeat="person.email as person in people | propsFilter: {name: $select.search}">
                                                                                <div ng-bind-html="person.email | highlight: $select.search"></div>
                                                                            </ui-select-choices>
                                                                    </ui-select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <div class="col col-md-3">
                                                                      <label for="addmail" class=" form-control-label"><b>Add Mail To: </b>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-12 col-md-9">
                                                                        <input 
                                                                        type="text" 
                                                                        id="addmail"  
                                                                        placeholder="Mails..." 
                                                                        name="addmail" 
                                                                        ng-model="warrantymodal.addmail"
                                                                        class="form-control"
                                                                        >
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div ng-show = show_rca_options>
                                                        <div class="row p-t-20">
                                                            <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <div class="col col-md-3">
                                                                      <label for="mail" class=" form-control-label"><b>  Cc: </b>
                                                                        <span class="mandatory">*</span></label>
                                                                    </div>
                                                                    <div class="col-12 col-md-9">
                                                                        <ui-select multiple ng-model="warrantymodal.selectedCCPeople" theme="bootstrap"  sortable="true" close-on-select="false" >
                                                                            <ui-select-match placeholder="Select email...">@{{$item.email}}</ui-select-match>
                                                                            <ui-select-choices class = "d-block" repeat="person.email as person in people | propsFilter: {name: $select.search}">
                                                                              <div ng-bind-html="person.email | highlight: $select.search"></div>
                                                                        </ui-select-choices>
                                                                    </ui-select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <div class="col col-md-3">
                                                                      <label for="addcc" class=" form-control-label"><b>Add Cc: </b>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-12 col-md-9">
                                                                        <input 
                                                                        type="text" 
                                                                        id="addcc"  
                                                                        placeholder="Mails..." 
                                                                        name="addcc" 
                                                                        ng-model="warrantymodal.addcc"
                                                                        class="form-control"
                                                                        >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row p-t-20">
                                                    <div class="col-md-12">
                                                        <div class="row form-group">
                                                            <div class="col col-md-3">
                                                                <label for="subject" class=" form-control-label"><b>Subject</b>
                                                                    <span class="mandatory">*</span></label>
                                                            </div>
                                                                <div class="col-12 col-md-9">
                                                                    <input 
                                                                        type="text" 
                                                                        id="subject"  
                                                                        placeholder="Subject" 
                                                                        name="subject" 
                                                                        ng-model="warrantymodal.subject"
                                                                        class="form-control"
                                                                        required>
                                                                        <div ng-show="AddWarrantyForm.subject.$touched && AddWarrantyForm.subject.$error">
                                                                            <span class="help-block"
                                                                             ng-show="AddWarrantyForm.subject.$error.required">
                                                                                Please Enter Subject
                                                                            </span>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div class="row p-t-20">
                                                    <div class="col-md-12">
                                                        <div class="row form-group">
                                                            <div class="col col-md-3">
                                                                <label for="message" class=" form-control-label"><b>Message</b>
                                                                    <span class="mandatory">*</span></label>
                                                                </div>
                                                                <div class="col-12 col-md-9">
                                                                    <textarea 
                                                                    type="text" 
                                                                    id="message" 
                                                                    name="message"
                                                                    ng-model="warrantymodal.message"
                                                                    placeholder="Message" 
                                                                    class="form-control"
                                                                    rows="5"
                                                                    required>
                                                                    </textarea>
                                                                    <div ng-show="AddWarrantyForm.message.$touched && AddWarrantyForm.message.$error">
                                                                        <span class="help-block"
                                                                         ng-show="AddWarrantyForm.message.$error.required">
                                                                            Please Enter Message
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseWarrantyModal();">
                                        <i class="fa fa-ban"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddUserForm.$invalid"
                                    ng-click="AddWC();" ng-if="tab!='customerapproval'">
                                        <i class="fa fa-dot-circle-o"></i> Save
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddUserForm.$invalid"
                                    ng-click="UpdateWC();" ng-if="tab=='customerapproval'">
                                        <i class="fa fa-dot-circle-o"></i> Update
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal scroll -->
            </div>
            @endsection
            @section('scripts')
            <script type="text/javascript" src="{{url('public/js/controllers/WarrantyController.js')}}"></script>
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

<!--     format: 'dd/mm/yyyy', -->