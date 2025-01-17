@extends('layouts.app')
@section('title', 'Physical Verification List')
@section('content')
<div class="main-content" ng-controller="PhysicalVerificationController">
    <div class="loader" id= "Loader" ng-style="Loader">
    </div>
    <div class="section__content section__content--p30" ng-init="ChangeTab('open');GetProductTypeList();GetProductList();">
        <div class="container-fluid">
            <div class="row" ng-show="!pvform && !showcreatermaform">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h6 class="pb-4 display-5">Physical Verification List</h6>
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
                                    <input id="rcidFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Receipt ID #" ng-change="gridActions.filter()" ng-model="filterreceiptid" filter-by="formatted_receipt_id" filter-type="text">
                                </th>
                                <th ng-show="tab == 'started' || tab == 'all'">
                                    <input id="ridFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="RID #" ng-change="gridActions.filter()" ng-model="filterothersid" filter-by="formatted_pv_id" filter-type="text">
                                </th>
                                <th>
                                    <input type="text"
                                    id="dateFromFilter"
                                    class="form-control"
                                    placeholder="From Date"
                                    max-date="dateTo"
                                    close-text="Close"
                                    ng-model="filterreceipt_datefrom"
                                    show-weeks="true"
                                    is-open="dateFromOpened"
                                    ng-click="dateFromOpened = true"
                                    filter-by="date_unix"
                                    filter-type="dateFrom"
                                    ng-change="gridActions.filter()"
                                    close-text="Close"/>
                                </th>

                                    <th>
                                    <input type="text"
                                    id="dateToFilter"
                                    class="form-control"
                                    placeholder="To Date"
                                    max-date="dateTo"
                                    close-text="Close"
                                    ng-model="filterreceipt_dateto"
                                show-weeks="true"
                               is-open="dateToOpened"
                               ng-click="dateToOpened = true"
                               filter-by="date_unix"
                               filter-type="dateTo"
                               ng-blur="gridActions.filter()"
                               ng-focus="gridActions.filter()"
                               show-weeks="false"
                                    ng-change="gridActions.filter()"
                                    close-text="Close"/>
                                </th>
                                <th>
                                    <input id="customerFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Customer Name" ng-change="gridActions.filter()" ng-model="filterCustomerothers" filter-by="customer_name" filter-type="text">
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

        {{--Tab Start--}}
        <div class="row  col-lg-12">
            <div class=" card w-100">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" ng-click="ChangeTab('open')">
                            <a class="nav-link active" id="open-tab" data-toggle="tab" href="#open" role="tab" aria-controls="open" aria-selected="true">Open Receipts</a>
                        </li>
                        <li class="nav-item" ng-click="ChangeTab('started')">
                            <a class="nav-link" id="started-tab" data-toggle="tab" href="#started" role="tab" aria-controls="started" aria-selected="false">Started Receipts</a>
                        </li>
                        <li class="nav-item" ng-click="ChangeTab('closed')">
                            <a class="nav-link" id="closed-tab" data-toggle="tab" href="#closed" role="tab" aria-controls="closed" aria-selected="false">Closed Receipts</a>
                        </li>
                        <li class="nav-item" ng-click="ChangeTab('all')">
                            <a class="nav-link" id="allpv-tab" data-toggle="tab" href="#allpv" role="tab" aria-controls="closed" aria-selected="false">All PV</a>
                        </li>
                    </ul>
                    <div class="tab-content pl-3 p-1" id="myTabContent">
                        <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">
                            <div class="col-md-12 m-b-10">
                                <ul class="list-inline">
                                    <li>
                                        <button type="button" class="btn btn-primary btn-md float-right m-r-10 m-b-10"  ng-click="exportToExcelSave('#openreceipt' , 'OpenReceipt.xls')">
                                            <i class="fa fa-file-excel-o"></i>&nbsp;Export
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <!-- DATA TABLE-->
                            <div grid-data grid-options="gridOptions" grid-actions="gridActions">
                                <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                    <table class="table table-borderless table-data3 table-responsive" id="openreceipt" name="openreceipt">
                                        <thead>
                                            <tr>
                                                @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                <th>
                                                    Actions
                                                </th>
                                                @endif
                                                <th sortable="formatted_receipt_id" class="sortable">
                                                    Receipt No
                                                </th>
                                                <th sortable="date_unix" class="sortable">
                                                    Receipt Date
                                                </th>

                                                <th sortable="customer_name" class="sortable">
                                                    Customer Name
                                                </th>
                                                <th sortable="courier_name" class="sortable">
                                                    Courier Name
                                                </th>
                                                <th sortable="docket_details" class="sortable">
                                                    Docket Details
                                                </th>
                                                <th sortable="total_boxes" class="sortable">
                                                    Number of Boxes
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr grid-item>
                                                @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                <td>
                                                    <div class="table-data-feature float-left">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Add"
                                                    ng-click="OpenPVForm(item, false);">
                                                        <i class="zmdi zmdi-plus-box"></i>
                                                    </button>
                                                    </div>
                                                </td>
                                                @endif
                                                <td ng-bind="item.formatted_receipt_id"></td>
                                                <td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>

                                                <td ng-bind="item.customer_name"></td>
                                                <td ng-bind="item.courier_name"></td>
                                                <td ng-bind="item.docket_details"></td>
                                                <td ng-bind="item.total_boxes"></td>
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
                        <div class="tab-pane fade show" id="started" role="tabpanel" aria-labelledby="started-tab">
                            <div class="col-md-12">
                                <ul class="list-inline">
                                    <li>
                                        <button type="button" class="btn btn-primary btn-md pull-right m-b-10" ng-click="CloseReceipts();">
                                            <i class="fa fa-check-circle"></i>&nbsp;Close Receipt
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-primary btn-md float-right m-r-10"  ng-click="exportToExcelSave('#startedreceipt' , 'StartedReceipt.xls')">
                                            <i class="fa fa-file-excel-o"></i>&nbsp;Export
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <!-- DATA TABLE-->
                            <div grid-data grid-options="gridOptions" grid-actions="gridActions">
                                    <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                        <table class="table table-borderless table-data3 table-responsive" id="startedreceipt" name="startedreceipt">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Select
                                                    </th>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <th>
                                                        Actions
                                                    </th>
                                                    @endif
                                                    <th sortable="formatted_receipt_id" class="sortable">
                                                        Receipt Id
                                                    </th>
                                                    <th sortable="formatted_pv_id" class="sortable">
                                                        R Id
                                                    </th>
                                                    <th sortable="date_unix" class="sortable">
                                                        Receipt Date
                                                    </th>
                                                    <th sortable="part_no" class="sortable">
                                                        Model No
                                                    </th>
                                                    <th sortable="serial_no" class="sortable">
                                                        Serial No
                                                    </th>
                                                    <th sortable="customer_name" class="sortable">
                                                        Customer Name
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr grid-item>
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" ng-model="item.close">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <td>
                                                        <div class="table-data-feature float-left">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                                                ng-click="OpenPVForm(item, true);">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Add"
                                                        ng-click="OpenPVForm(item, false);">
                                                            <i class="zmdi zmdi-plus-box"></i>
                                                        </button>
                                                        </div>
                                                    </td>
                                                    @endif
                                                    <td ng-bind="item.formatted_receipt_id"></td>
                                                    <td ng-bind="item.formatted_pv_id"></td>
                                                    <td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>
                                                    <td ng-bind="item.part_no"></td>
                                                    <td ng-bind="item.serial_no"></td>
                                                    <td ng-bind="item.customer_name"></td>
                                                    <!-- <td ng-bind="item.end_customer"></td> -->
                                                    <!-- <td ng-bind="item.total_boxes"></td> -->
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
                        <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                            <div class="col-md-12 m-b-10">
                                <ul class="list-inline">
                                    <li>
                                        <button type="button" class="btn btn-primary btn-md float-right m-r-10 m-b-10"  ng-click="exportToExcelSave('#closedtable' , 'ClosedReceipts.xls')">
                                            <i class="fa fa-file-excel-o"></i>&nbsp;Export
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <!-- DATA TABLE-->
                            <div grid-data grid-options="gridOptions" grid-actions="gridOptions">
                                <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                    <table class="table table-borderless table-data3" id="closedtable" name="closedtable">
                                        <thead>
                                            <tr>
                                                <th sortable="item.formatted_receipt_id" class="sortable">
                                                    Receipt Id
                                                </th>
                                                <th sortable="item.date_unix" class="sortable">
                                                    Date
                                                </th>
                                                <th sortable="item.customer_name" class="sortable">
                                                    Customer Name
                                                </th>
                                                <!-- <th sortable="item.end_customer" class="sortable">
                                                    End Customer
                                                </th> -->
                                                <th sortable="item.courier_name" class="sortable">
                                                    Courier Name
                                                </th>
                                                <th sortable="item.docket_details" class="sortable">
                                                    Docket Details
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr grid-item>
                                                <td ng-bind="item.formatted_receipt_id"></td>
                                                <td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>
                                                <td ng-bind="item.customer_name"></td>
                                                <!-- <td ng-bind="item.end_customer"></td> -->
                                                <td ng-bind="item.courier_name"></td>
                                                <td ng-bind="item.docket_details"></td>
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
                        <div class="tab-pane fade show" id="allpv" role="tabpanel" aria-labelledby="allpv-tab">
                            <div class="col-md-12 m-b-10">
                                <ul class="list-inline">
                                    <li>
                                        <button type="button" class="btn btn-primary btn-md float-right m-r-10 m-b-10"  ng-click="exportToExcelSave('#allpvtable' , 'AllPV.xls')">
                                            <i class="fa fa-file-excel-o"></i>&nbsp;Export
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <!-- DATA TABLE-->
                            <div grid-data grid-options="gridOptions" grid-actions="gridActions">
                                    <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                        <table class="table table-borderless table-data3 table-responsive" id="allpvtable" name="allpvtable">
                                            <thead>
                                                <tr>
                                                    @if(Auth::user()->isAdmin())
                                                    <th>
                                                        Actions
                                                    </th>
                                                    @endif
                                                    <th sortable="formatted_receipt_id" class="sortable">
                                                        Receipt Id
                                                    </th>
                                                    <th sortable="formatted_pv_id" class="sortable">
                                                        R Id
                                                    </th>
                                                    <th sortable="date_unix" class="sortable">
                                                        Receipt Date
                                                    </th>
                                                    <th sortable="part_no" class="sortable">
                                                        Model No
                                                    </th>
                                                    <th sortable="serial_no" class="sortable">
                                                        Serial No
                                                    </th>
                                                    <th sortable="customer_name" class="sortable">
                                                        Customer Name
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr grid-item>
                                                    @if(Auth::user()->isAdmin())
                                                    <td>
                                                        <div class="table-data-feature float-left">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete"
                                                        ng-click="DeletePV(item);">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                        </div>
                                                    </td>
                                                    @endif
                                                    <td ng-bind="item.formatted_receipt_id"></td>
                                                    <td ng-bind="item.formatted_pv_id"></td>
                                                    <td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>
                                                    <td ng-bind="item.part_no"></td>
                                                    <td ng-bind="item.serial_no"></td>
                                                    <td ng-bind="item.customer_name"></td>
                                                    <!-- <td ng-bind="item.end_customer"></td> -->
                                                    <!-- <td ng-bind="item.total_boxes"></td> -->
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
<div class="row" ng-show="pvform && !showcreatermaform">
    <div class="col-lg-12">
        <div class="col-lg-12 card">
            <div class="card-header">
                <strong>Physical Verification</strong> Form
            </div>
            <div class="card-body card-block">
                <div class="row">
                    <div class="col-md-6" ng-show="physicalVerification.edit">
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="id" class=" form-control-label">RID <span
                                    class="mandatory">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="id" name="id"
                                        placeholder="R Id" class="form-control" disabled
                                        ng-model="physicalVerification.id"
                                        disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" ng-show="!physicalVerification.edit">
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="id" class=" form-control-label">Receipt Id <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="receipt_id" name="receipt_id"
                                placeholder="Receipt No" class="form-control" disabled
                                ng-model="physicalVerification.formatted_receipt_id"
                                disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="" method="post" class="form-horizontal" name="EditPhysicalVerification" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="courier" class=" form-control-label">Courier <span
                                        class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="text" id="courier" name="courier_name"
                                        placeholder="Courier"
                                        class="form-control"
                                        ng-model="physicalVerification.courier_name"
                                        disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="docket_details" class=" form-control-label">Docket
                                            Details <span class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input type="text" id="docket_details" name="docket_details"
                                            placeholder="Docket Details" class="form-control"
                                            ng-model="physicalVerification.docket_details"
                                            disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" ng-show="physicalVerification.edit">
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="receipt_id" class=" form-control-label">Receipt Id <span
                                                class="mandatory">*</span></label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" id="receipt_id" name="receipt_id" placeholder="RID No"
                                                class="form-control"
                                                ng-model="physicalVerification.receipt_id"
                                                disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="pvdate" class=" form-control-label">Date <span
                                                    class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="pvdate" name="pvdate" placeholder="Date"
                                                    class="form-control"
                                                    ng-model="physicalVerification.pvdate"
                                                    ng-minlength="3"
                                                    ng-maxlength="10"
                                                    required>

                                                    <div ng-show="EditPhysicalVerification.pvdate.$touched && EditPhysicalVerification.pvdate.$error">

                                                        <span class="help-block"
                                                        ng-show="EditPhysicalVerification.pvdate.$error.required">Please Select Date</span>

                                                        <span class="help-block"
                                                        ng-show="EditPhysicalVerification.pvdate.$error.minlength">
                                                        Minimum 3 Characters Required
                                                    </span>

                                                    <span class="help-block"
                                                    ng-show="EditPhysicalVerification.pvdate.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="producttype" class=" form-control-label">Product Family <span class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <ui-select id="producttype" name="producttype" ng-model="physicalVerification.producttype" theme="selectize" title="Select Product Family" ng-change="ChangeProductType();" required>
                                                <ui-select-match placeholder="Select Product Family">@{{$select.selected.code}}</ui-select-match>
                                                <ui-select-choices repeat="pt in producttypes | filter: $select.search">
                                                    <span ng-bind-html="pt.code | highlight: $select.search"></span>
                                                </ui-select-choices>
                                            </ui-select>
                                        <div ng-show="EditPhysicalVerification.producttype.$touched && EditPhysicalVerification.producttype.$error">
                                            <span class="help-block form-text"
                                            ng-show="EditPhysicalVerification.producttype.$error.required">Please Select Product Type
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label for="product_category" class=" form-control-label">Product Category
                                        <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="text" id="product_category" name="product_category"
                                        placeholder="Product Category" class="form-control"
                                        ng-model="physicalVerification.product_category"
                                        disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="product" class=" form-control-label">Model No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <ui-select ng-model="physicalVerification.product" theme="selectize" title="Select Model No" ng-change="AssignModelNo();" required>
                                            <ui-select-match placeholder="Select Model No">@{{$select.selected.part_no}}</ui-select-match>
                                            <ui-select-choices id="part_no" 
                                            name="product" repeat="product in products | filter: $select.search">
                                            <span ng-bind-html="product.part_no | highlight: $select.search"></span>
                                        </ui-select-choices>
                                    </ui-select>
                                    <input ng-if="physicalVerification.product.id == -1" type="text" id="manual_part_no" name="manual_part_no"
                                    placeholder="Model No" class="form-control"
                                    ng-model="physicalVerification.manual_part_no"
                                    required>
                                    <div ng-show="EditPhysicalVerification.manual_part_no.$touched && EditPhysicalVerification.manual_part_no.$error">
                                        <span class="help-block"
                                            ng-show="EditPhysicalVerification.manual_part_no.$error.required">Please Enter Model No
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="serial_no" class=" form-control-label">Serial No <span
                                class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="serial_no" name="serial_no"
                                placeholder="Serial No" class="form-control"
                                ng-model="physicalVerification.serial_no"
                                ng-minlength="3"
                                ng-maxlength="50"
                                ng-blur="CheckSerialNoExistence();"
                                required>
                                <div ng-show="EditPhysicalVerification.serial_no.$touched && EditPhysicalVerification.serial_no.$error">
                                    <span class="help-block"
                                    ng-show="EditPhysicalVerification.serial_no.$error.required">Please Enter Serial No</span>
                                    <span class="help-block"
                                    ng-show="EditPhysicalVerification.serial_no.$error.minlength">
                                    Minimum 3 Characters Required
                                </span>
                                <span class="help-block"
                                ng-show="EditPhysicalVerification.serial_no.$error.maxlength">
                                Maximum 50 Characters Allowed
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                                        <!-- <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="defect" class=" form-control-label">Defect Mentioned by
                                                        Customer <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                   <textarea 
                                                    type="text" 
                                                    id="defect" 
                                                    name="defect"
                                                    ng-model="physicalVerification.defect"
                                                    placeholder="Defect Mentioned by Customer" 
                                                    class="form-control"
                                                    ng-minlength="3" 
                                                    ng-maxlength="200"
                                                    rows="4"
                                                    required>
                                                    </textarea>
                                                    <div ng-show="EditPhysicalVerification.defect.$touched && EditPhysicalVerification.defect.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.defect.$error.required">Please Enter Defect Mentioned by Customer</span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.defect.$error.minlength">
                                                                Minimum 3 Characters Required
                                                        </span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.defect.$error.maxlength">
                                                            Maximum 200 Characters Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="comment" class=" form-control-label">Phy. Verfication Comment</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                 <textarea 
                                                 type="text" 
                                                 id="comment" 
                                                 name="comment"
                                                 ng-model="physicalVerification.comment"
                                                 placeholder="Comment" 
                                                 class="form-control"
                                                 rows="4"
                                                 >
                                             </textarea>
                                             <div ng-show="EditPhysicalVerification.comment.$touched && EditPhysicalVerification.comment.$error">
                                                <span class="help-block"
                                                ng-show="EditPhysicalVerification.comment.$error.required">Please Enter Comment</span>
                                                <span class="help-block"
                                                ng-show="EditPhysicalVerification.comment.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                            <span class="help-block"
                                            ng-show="EditPhysicalVerification.comment.$error.maxlength">
                                            Maximum 200 Characters Allowed
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <strong>Relay Received With </strong>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col col-md-4">
                                    <label class=" form-control-label">Case <span
                                        class="mandatory">*</span></label>
                                    </div>
                                    <div class="col col-md-8">
                                        <div class="form-check-inline form-check">
                                            <label for="case1" class="form-check-label ">
                                                <input type="radio" id="case1" name="case"
                                                ng-model="physicalVerification.case" ng-value="1"
                                                class="form-check-input">Yes
                                            </label>
                                            <label for="case2" class="form-check-label ">
                                                <input type="radio" id="case2" name="case"
                                                ng-model="physicalVerification.case" ng-value="2"
                                                class="form-check-input">No
                                            </label>
                                            <label for="case3" class="form-check-label ">
                                                <input type="radio" id="case3" name="case"
                                                ng-model="physicalVerification.case" ng-value="3"
                                                class="form-check-input">Not Applicable
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="case_condition" class=" form-control-label">Case
                                            Condition <span class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <select name="case_condition"
                                            ng-options="condition.value as condition.name for condition in conditions"
                                            ng-model="physicalVerification.case_condition"
                                            id="case_condition" class="form-control" >
                                            <option style="display: none;" value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label class=" form-control-label">Battery <span
                                            class="mandatory">*</span></label>
                                        </div>
                                        <div class="col col-md-8">
                                            <div class="form-check-inline form-check">
                                                <label for="battery1" class="form-check-label ">
                                                    <input type="radio" id="battery1" name="battery"
                                                    ng-model="physicalVerification.battery" ng-value="1"
                                                    class="form-check-input">Yes
                                                </label>
                                                <label for="battery2" class="form-check-label ">
                                                    <input type="radio" id="battery2" name="battery"
                                                    ng-model="physicalVerification.battery" ng-value="2"
                                                    class="form-check-input">No
                                                </label>
                                                <label for="battery3" class="form-check-label ">
                                                    <input type="radio" id="battery3" name="battery"
                                                    ng-model="physicalVerification.battery" ng-value="3"
                                                    class="form-check-input">Not Applicable
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="battery_condition" class=" form-control-label">Battery
                                                Condition <span class="mandatory">*</span></label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="battery_condition"
                                                ng-options="condition.value as condition.name for condition in conditions"
                                                ng-model="physicalVerification.battery_condition"
                                                id="battery_condition" class="form-control" >
                                                <option style="display: none;" value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label class=" form-control-label">Terminal Blocks <span
                                                class="mandatory">*</span></label>
                                            </div>
                                            <div class="col col-md-8">
                                                <div class="form-check-inline form-check">
                                                    <label for="terminal_blocks1" class="form-check-label ">
                                                        <input type="radio" id="terminal_blocks1"
                                                        name="terminal_blocks"
                                                        ng-model="physicalVerification.terminal_blocks"
                                                        ng-value="1"
                                                        class="form-check-input">Yes
                                                    </label>
                                                    <label for="terminal_blocks2" class="form-check-label ">
                                                        <input type="radio" id="terminal_blocks2"
                                                        name="terminal_blocks"
                                                        ng-model="physicalVerification.terminal_blocks"
                                                        ng-value="2" class="form-check-input">No
                                                    </label>
                                                    <label for="terminal_blocks3" class="form-check-label ">
                                                        <input type="radio" id="terminal_blocks3"
                                                        name="terminal_blocks"
                                                        ng-model="physicalVerification.terminal_blocks"
                                                        ng-value="3" class="form-check-input">Not
                                                        Applicable
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="terminal_blocks_condition" class=" form-control-label">Terminal
                                                    Blocks Condition <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="terminal_blocks_condition"
                                                    ng-options="condition.value as condition.name for condition in conditions"
                                                    ng-model="physicalVerification.terminal_blocks_condition"
                                                    id="terminal_blocks_condition" class="form-control" >
                                                    <option style="display: none;" value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" ng-if="physicalVerification.terminal_blocks == 1">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="no_of_terminal_blocks" class=" form-control-label">Number Of Terminal Blocks <span class="mandatory">*</span></label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" id="no_of_terminal_blocks" name="no_of_terminal_blocks"
                                                class="form-control"
                                                ng-model="physicalVerification.no_of_terminal_blocks"
                                                ui-mask="99 + 99" placeholder="N+N" 
                                                add-default-placeholder="99 + 99"
                                                ui-mask-placeholder-char="N"
                                                required>
                                                <div ng-show="EditPhysicalVerification.no_of_terminal_blocks.$touched && EditPhysicalVerification.no_of_terminal_blocks.$error">
                                                    <span class="help-block"
                                                    ng-show="EditPhysicalVerification.no_of_terminal_blocks.$error.required">Please Enter No Of Blocks</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label class=" form-control-label">Top/Bottom Access Cover <span
                                                    class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <div class="form-check-inline form-check">
                                                        <label for="top_bottom_cover1" class="form-check-label ">
                                                            <input type="radio" id="top_bottom_cover1"
                                                            name="top_bottom_cover"
                                                            ng-model="physicalVerification.top_bottom_cover"
                                                            ng-value="1" class="form-check-input">Yes
                                                        </label>
                                                        <label for="top_bottom_cover2" class="form-check-label ">
                                                            <input type="radio" id="top_bottom_cover2"
                                                            name="top_bottom_cover"
                                                            ng-model="physicalVerification.top_bottom_cover"
                                                            ng-value="2" class="form-check-input">No
                                                        </label>
                                                        <label for="top_bottom_cover3" class="form-check-label ">
                                                            <input type="radio" id="top_bottom_cover3"
                                                            name="top_bottom_cover"
                                                            ng-model="physicalVerification.top_bottom_cover"
                                                            ng-value="3" class="form-check-input">Not Applicable
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="top_bottom_cover_condition" class=" form-control-label">Top/Bottom
                                                        Access Cover Condition <span class="mandatory">*</span></label>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <select name="top_bottom_cover_condition"
                                                        ng-options="condition.value as condition.name for condition in conditions"
                                                        ng-model="physicalVerification.top_bottom_cover_condition"
                                                        id="top_bottom_cover_condition" class="form-control" >
                                                        <option style="display: none;" value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Short links <span
                                                        class="mandatory">*</span></label>
                                                    </div>
                                                    <div class="col col-md-8">
                                                        <div class="form-check-inline form-check">
                                                            <label for="short_links1" class="form-check-label ">
                                                                <input type="radio" id="short_links1"
                                                                name="short_links"
                                                                ng-model="physicalVerification.short_links" ng-value="1"
                                                                class="form-check-input">Yes
                                                            </label>
                                                            <label for="short_links2" class="form-check-label ">
                                                                <input type="radio" id="short_links2"
                                                                name="short_links"
                                                                ng-model="physicalVerification.short_links" ng-value="2"
                                                                class="form-check-input">No
                                                            </label>
                                                            <label for="short_links3" class="form-check-label ">
                                                                <input type="radio" id="short_links3"
                                                                name="short_links"
                                                                ng-model="physicalVerification.short_links" ng-value="3"
                                                                class="form-check-input">Not Applicable
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row form-group">
                                                    <div class="col col-md-4">
                                                        <label for="short_links_condition" class=" form-control-label">Short
                                                            Links Condition <span class="mandatory">*</span></label>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <select name="short_links_condition"
                                                            ng-options="condition.value as condition.name for condition in conditions"
                                                            ng-model="physicalVerification.short_links_condition"
                                                            id="short_links_condition" class="form-control" >
                                                            <option style="display: none;" value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" ng-if="physicalVerification.short_links == 1">
                                                <div class="row form-group">
                                                    <div class="col col-md-4">
                                                        <label for="no_of_short_links" class=" form-control-label">No Of Short links <span class="mandatory">*</span></label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <input 
                                                        type="text" 
                                                        id="no_of_short_links" 
                                                        name="no_of_short_links"
                                                        ng-model="physicalVerification.no_of_short_links"
                                                        placeholder="No Of Short Links" 
                                                        class="form-control"
                                                        ng-pattern="/^[0-9]*$/"
                                                        required>
                                                        <div ng-show="EditPhysicalVerification.no_of_short_links.$touched && EditPhysicalVerification.no_of_short_links.$error">
                                                            <span class="help-block"
                                                            ng-show="EditPhysicalVerification.no_of_short_links.$error.required">Please Enter No Of Short Links</span>
                                                            <span class="help-block"
                                                            ng-show="EditPhysicalVerification.no_of_short_links.$error.pattern">
                                                            Only Numbers Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Screws <span
                                                        class="mandatory">*</span></label>
                                                    </div>
                                                    <div class="col col-md-8">
                                                        <div class="form-check-inline form-check">
                                                            <label for="screws1" class="form-check-label ">
                                                                <input type="radio" id="screws1"
                                                                name="screws"
                                                                ng-model="physicalVerification.screws" ng-value="1"
                                                                class="form-check-input">Yes
                                                            </label>
                                                            <label for="screws2" class="form-check-label ">
                                                                <input type="radio" id="screws2"
                                                                name="screws"
                                                                ng-model="physicalVerification.screws" ng-value="2"
                                                                class="form-check-input">No
                                                            </label>
                                                            <label for="screws3" class="form-check-label ">
                                                                <input type="radio" id="screws3"
                                                                name="screws"
                                                                ng-model="physicalVerification.screws" ng-value="3"
                                                                class="form-check-input">Not Applicable
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row form-group">
                                                    <div class="col col-md-4">
                                                        <label for="sales_order_no" class=" form-control-label">Sale
                                                        Order/WBS No</label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <input type="text" id="sales_order_no" name="sales_order_no"
                                                        ng-model="physicalVerification.sales_order_no"
                                                        placeholder="Sale Order/WBS No" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row form-group">
                                                    <div class="col col-md-4">
                                                        <label for="is_rma_available" class=" form-control-label">IS RMA Available? <span class="mandatory">*</span></label>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                            <select name="is_rma_available"
                                                            ng-options="option.value as option.name for option in yesornooptions"
                                                            ng-model="physicalVerification.is_rma_available"
                                                            id="is_rma_available" class="form-control" >
                                                            <option style="display: none;" value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <button ng-if="!physicalVerification.edit" type="submit" class="btn btn-primary btn-sm" ng-click="AddPV();" ng-disabled="EditPhysicalVerification.$invalid">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                    <button ng-if="physicalVerification.edit" type="submit" class="btn btn-primary btn-sm" ng-click="AddPV();" ng-disabled="EditPhysicalVerification.$invalid">
                                        <i class="fa fa-save"></i> Update
                                    </button>
                                <!-- <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-undo"></i> Reset
                                </button> -->
                                <button class="btn btn-danger btn-sm" ng-click="ClosePVForm();">
                                    <i class="fa fa-ban"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" ng-if="!pvform && showcreatermaform" ng-controller="RMAController">
                    @component('forms.creatermaform')
                    
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
    <script type="text/javascript" src="{{url('public/js/controllers/PhysicalVerificationController.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/controllers/RMAController.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#pvdate").datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });
            $("#dateFilter").datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });

            $("#dateFromFilter").datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });

              $("#dateToFilter").datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });
        });

    </script>

    @endsection