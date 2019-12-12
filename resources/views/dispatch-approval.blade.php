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
                    </div>
                    <div class="col-md-12 p-b-20">
                        <button type="button" class="btn btn-primary btn-md float-right"
                                ng-click="ChangeStatus('dispatchapproved');">
                            <i class="fa fa-plus"></i>&nbsp;Approve
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
                                        <th>
                                            Actions
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
                                        <th sortable="pvl_priority_for_display" class="sortable">
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
                                        <td>
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
                                        <td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>
                                        <td ng-bind="item.serial_no"></td>
                                        <td ng-bind="item.part_no"></td>
                                        <td ng-bind="item.customer_name"></td>
                                        <td ng-bind="item.end_customer"></td>
                                        <td ng-bind="item.manager_comment"></td>
                                        <td ng-bind="item.pvl_priority_for_display"></td>
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