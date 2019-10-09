@extends('layouts.app')
@section('title', 'Dispatch Approval List')
@section('content')
    <div class="main-content" ng-controller="DispatchApprovalController">
        <div class="section__content section__content--p30" ng-init="Start();">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h6 class="pb-4 display-5">Dispatch Approval List</h6>
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
                    <div class="col-md-12 p-b-20">
                        <button type="button" class="btn btn-primary btn-md float-right"
                                ng-click="ChangeStatus('dispatchapproved');">
                            <i class="fa fa-plus"></i>&nbsp;Approval
                        </button>
                    </div>
                    <div class="col-md-12">
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
                                        <th sortable="rma_id" class="sortable">
                                            RMA NO.
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
                                        <td ng-bind="item.rma_id"></td>
                                        <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                                        <td ng-bind="item.product_id"></td>
                                        <td ng-bind="item.serial_no"></td>
                                        <td ng-bind="item.part_no"></td>
                                        <td ng-bind="item.customer_name"></td>
                                        <td ng-bind="item.end_customer"></td>
                                        <td ng-bind="item.comment"></td>
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
                </div>
            </div>
        </div>

    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('public/js/controllers/DispatchApprovalController.js')}}"></script>

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