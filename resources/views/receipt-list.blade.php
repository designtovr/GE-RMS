@extends('layouts.app')
@section('title', 'Receipt List')
@section('content')
<div class="main-content" ng-controller="ReceiptController">
    <div class="section__content section__content--p30" ng-init="Initiate();getReceipts();GetCustomerList();GetEndCustomerList();GetSiteList();">
        <div class="container-fluid">
            <div class="row" ng-show="!receiptform">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h6 class="pb-4 display-5">Receipt List</h6>
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
                                    <button type="button" class="btn btn-primary btn-md float-right" ng-click="ShowReceiptForm();">
                                        <i class="fa fa-plus"></i>&nbsp;Create
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-primary btn-md float-right box" onclick="Export()" ng-click="exportToExcel('#receipttable')" 
                                        style="margin-right: 10px;">
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
                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                            <div class="overflow-auto">
                                <table class="table table-borderless table-data3" id="receipttable" name="receipttable">
                                    <thead>
                                        <tr>
                                            @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                            <th>
                                                Actions
                                            </th>
                                            @endif
                                            <th sortable="formatted_receipt_id" class="sortable">
                                                Receipt Id
                                            </th>
                                            <th sortable="formatted_rma_id" class="sortable">
                                                RMA No
                                            </th>
                                            <th sortable="date_unix" class="sortable">
                                                Receipt Date
                                            </th>

                                            <th  sortable="customer_name" class="sortable">
                                                Customer Name
                                            </th>
                                            <th sortable="site_name" class="sortable">
                                                Site
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
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="EditReceipt(item);">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            @endif
                                            <td ng-bind="item.formatted_receipt_id"></td>
                                            <td ng-bind="item.formatted_rma_id"></td>
                                            <td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>
                                            <td ng-bind="item.customer_name"></td>
                                            <td ng-bind="item.site_name"></td>
                                            <td ng-bind="item.courier_name"></td>
                                            <td ng-bind="item.docket_details"></td>
                                            <td ng-bind="item.total_boxes"></td>
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
            <div class="row" ng-show="receiptform">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Receipt</strong> Form
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal" name="AddReceiptForm"
                                  id="AddReceiptForm" novalidate>
                                <div class="row form-group" ng-show="editReceipt">
                                    <div class="col col-md-3">
                                        <label for="id" class=" form-control-label">Receipt Id <span
                                                    class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="id"
                                            name="id"
                                            ng-model="receipt.formatted_receipt_id"
                                            placeholder="Receipt No"
                                            class="form-control"
                                            disabled>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="receipt_date" class=" form-control-label">Receipt Date <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                                type="text"
                                                id="receipt_date"
                                                name="receipt_date"
                                                ng-model="receipt.receipt_date"
                                                placeholder="Receipt Date"
                                                class="form-control"
                                                required>
                                        <div ng-show="AddReceiptForm.receipt_date.$touched && AddReceiptForm.receipt_date.$error">
                                        <span class="help-block"
                                              ng-show="AddReceiptForm.receipt_date.$error.required">
                                            Please Select Receipt Date
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="cu_name" class=" form-control-label">Customer Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <ui-select ng-model="receipt.customer_id" theme="selectize" title="Select Customer"  required>
                                            <ui-select-match placeholder="Select Customer">@{{$select.selected.name}}</ui-select-match>
                                            <ui-select-choices id="customer_id" 
                                                name="customer_id" repeat="customer.id as customer in customers | filter: $select.search">
                                              <span ng-bind-html="customer.name | highlight: $select.search"></span>
                                              <small ng-bind-html="customer.location_name | highlight: $select.search"></small>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="site" class=" form-control-label">Location<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="site" name="site" ng-model="receipt.site" uib-typeahead="site for site in sites | filter:$viewValue | limitTo:8" placeholder="Location" class="form-control" typeahead-popup-template-url="{{url('public/bower_components/angular-bootstrap/template/typeahead/typeahead-popup.html')}}"
                                        typeahead-template-url="{{url('public/bower_components/angular-bootstrap/template/typeahead/typeahead-match.html')}}" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="email" class=" form-control-label">Email</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        ng-model="receipt.email" 
                                        placeholder="Email" 
                                        class="form-control" 
                                        ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/"
                                        >
                                        <div ng-show="AddReceiptForm.email.$touched && AddReceiptForm.email.$error">
                                            <span class="help-block" ng-show="AddReceiptForm.email.$error.pattern">Invalid Email</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="courier_name" class=" form-control-label">Courier Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                                type="text"
                                                id="courier_name"
                                                name="courier_name"
                                                ng-model="receipt.courier_name"
                                                placeholder="Courier Name"
                                                class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="docket_details" class=" form-control-label">Docket Details</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="docket_details"
                                            name="docket_details"
                                            ng-model="receipt.docket_details"
                                            placeholder="Docket Details"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="no_of_boxes" class=" form-control-label">No Of Boxes <span
                                                    class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                                type="text"
                                                id="no_of_boxes"
                                                name="no_of_boxes"
                                                ng-model="receipt.total_boxes"
                                                placeholder="No Of Boxes"
                                                class="form-control"
                                                ng-pattern="/^[0-9]*$/"
                                                required>
                                        <div ng-show="AddReceiptForm.no_of_boxes.$touched && AddReceiptForm.no_of_boxes.$error">
                                        <span class="help-block"
                                              ng-show="AddReceiptForm.no_of_boxes.$error.required">
                                            Please Enter No Of Boxes
                                        </span>
                                            <span class="help-block"
                                                  ng-show="AddReceiptForm.no_of_boxes.$error.pattern">
                                            Only Numbers Allowed
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm"
                                    ng-disabled="AddReceiptForm.$invalid"
                                    ng-click="AddReceipt();"
                                    ng-show="!editReceipt">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm"
                                    ng-disabled="AddReceiptForm.$invalid"
                                    ng-click="AddReceipt();"
                                    ng-show="editReceipt">
                                <i class="fa fa-dot-circle-o"></i> Update
                            </button>
                            <button class="btn btn-danger btn-sm" ng-click="HideReceiptForm();">
                                <i class="fa fa-ban"></i> Cancel
                            </button>

                            <!-- <div class="pull-right">
                                <button type="submit" class="btn btn-primary btn-sm"
                                        ng-disabled="AddReceiptForm.$invalid">
                                    <i class="fa fa-print"></i> Print
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('public/js/controllers/ReceiptController.js')}}"></script>
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