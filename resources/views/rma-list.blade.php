@extends('layouts.app')
@section('title', 'RMA List')
@section('content')
<div class="main-content" ng-controller="RMAController">
	<div class="section__content section__content--p30" ng-init="ChangeTab('withrma');InitiateForm();">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!showrmaform && !showsitecardform && !addpvform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">RMA List</h6>
			            <!-- <button type="button" class="btn btn-primary btn-sm" ng-click="ShowRMAForm();">
	                        <i class="fa fa-plus"></i>&nbsp; Create</button> -->
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
                                    <th ng-show="tab =='withrma' || tab == 'withoutrma'">
                                        <input type="text" 
                                        id="receiptidFilter" 
                                        class="form-control" 
                                        placeholder="R Id #" 
                                        close-text="Close"
                                        ng-model="filterrID" 
                                        filter-by="formatted_pv_id" 
                                        filter-type="text"
                                        ng-change="gridActions.filter();" 
                                        />
                                    </th>
                                    <th ng-show="tab =='withrma' || tab == 'withoutrma'">
                                        <input type="text" 
                                        id="ridFilter" 
                                        class="form-control" 
                                        placeholder="Receipt Id #" 
                                        close-text="Close"
                                        ng-model="filterreceiptID" 
                                        filter-by="formatted_receipt_id" 
                                        filter-type="text"
                                        ng-change="gridActions.filter();" 
                                        />
                                    </th>
                                    <th ng-show="tab =='saved' || tab == 'opensitecard' || tab == 'completed'">
                                        <input type="text" 
                                        id="rmaidFilter" 
                                        class="form-control" 
                                        placeholder="RMA #" 
                                        close-text="Close"
                                        ng-model="filterrmaID" 
                                        filter-by="formatted_rma_id" 
                                        filter-type="text"
                                        ng-change="gridActions.filter();" 
                                        />
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
                                    <th ng-show="tab !='withrma' && tab != 'withoutrma'">
                                        <input id="gsFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="GS No" ng-change="gridActions.filter();" ng-model="filtergs_no" filter-by="gs_no" filter-type="text">
                                    </th>
                                    <th>
                                       <input id="customerFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Customer Name" ng-change="gridActions.filter()" ng-model="filterCustomer" filter-by="customer_name" filter-type="text">
                                   </th>
                                   <th ng-show="tab !='withrma' && tab != 'withoutrma'">
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
                    <div class=" card w-100">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" ng-click="ChangeTab('withrma')">
                                    <a class="nav-link active" id="withrma-tab" data-toggle="tab" href="#withrma" role="tab" aria-controls="withrma" aria-selected="false">With Physical RMA</a>
                                </li>
                                <li class="nav-item" ng-click="ChangeTab('withoutrma')">
                                    <a class="nav-link" id="withoutrma-tab" data-toggle="tab" href="#withoutrma" role="tab" aria-controls="withoutrma" aria-selected="false">Without Physical RMA</a>
                                </li>
                                <li class="nav-item" ng-click="ChangeTab('saved')">
                                    <a class="nav-link" id="saved-tab" data-toggle="tab" href="#saved" role="tab" aria-controls="saved" aria-selected="false">Saved RMA</a>
                                </li>
                                <li class="nav-item" ng-click="ChangeTab('opensitecard')">
                                    <a class="nav-link" id="opensitecard-tab" data-toggle="tab" href="#opensitecard" role="tab" aria-controls="opensitecard" aria-selected="false">Site Card RMA</a>
                                </li>
                                <li class="nav-item" ng-click="ChangeTab('completed')">
                                    <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="true">Completed RMA</a>
                                </li>
                                <li class="nav-item" ng-click="ChangeTab('all')">
                                    <a class="nav-link" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All RMA</a>
                                </li>
                            </ul>
                            <div class="tab-content pl-3 p-1" id="myTabContent">
                                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                    <div class="col-md-12">
                                        <!-- DATA TABLE-->
                                        <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="">
                                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                            <table class="table table-borderless table-data3 table-responsive">
                                                <thead>
                                                <tr>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <th>
                                                        Actions
                                                    </th>
                                                    @endif
                                                    <th sortable="formatted_rma_id" class="sortable">
                                                        RMA No
                                                    </th>
                                                    <th sortable="date_unix" class="sortable">
                                                        Date
                                                    </th>

                                                    <th sortable="gs_no" class="sortable">
                                                        GS No
                                                    </th>
                                                    <th sortable="act_reference" class="sortable">
                                                        ACT Reference
                                                    </th>
                                                    <th sortable="customer_name" class="sortable">
                                                        Customer Name
                                                    </th>
                                                    <th sortable="end_customer" class="sortable">
                                                        End Customer
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr grid-item>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <td>
                                                        <div class="table-data-feature float-left">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="EditRMAForm(item.id);">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                                    title="Add"
                                                                    ng-click="AddPVForm(item.id);">
                                                                <i class="zmdi zmdi-plus-box"></i>
                                                            </button>
                                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle item"><span><i class="zmdi zmdi-print"></i></span></button>
                                                            <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
                                                                <button ng-click="PrintRMAForm(item.id)" type="button" tabindex="0" class="dropdown-item">RMA Form</button>
                                                                <button ng-click="PrintPVForm(item.id);" type="button" tabindex="0" class="dropdown-item">PV Form</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @endif
                                                    <td ng-bind="item.formatted_rma_id"></td>
                                                    <td ng-bind="item.date | date:'dd/MM/yyyy'"></td>
                                                    <td ng-bind="item.gs_no"></td>
                                                    <td ng-bind="item.act_reference"></td>
                                                    <td ng-bind="item.customer_name"></td>
                                                    <td ng-bind="item.end_customer"></td>
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
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END DATA TABLE-->
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="withrma" role="tabpanel" aria-labelledby="withrma-tab">
                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-md pull-right m-b-10" ng-click="CreateRMA();">
                                            <i class="fa fa-check-circle"></i>&nbsp;Create RMA
                                        </button>
                                    </div>
                                    @endif
                                    <!-- DATA TABLE-->
                                    <div grid-data grid-options="pvgridOptions" grid-actions="pvgridActions">
                                        <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                        <table class="table table-borderless table-data3 table-responsive">
                                            <thead>
                                                <tr>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <th>
                                                        Select
                                                    </th>
                                                    @endif
                                                    <th sortable="formatted_pv_id" class="sortable">
                                                        R Id
                                                    </th>
                                                    <th sortable="formatted_receipt_id" class="sortable">
                                                        Receipt Id
                                                    </th>
                                                    <th  sortable="pvdate" class="sortable">
                                                        Date
                                                    </th>
                                                    <th  sortable="customer_name" class="sortable">
                                                        Customer Name
                                                    </th>
                                                    <th  sortable="courier_name" class="sortable">
                                                        Courier Name
                                                    </th>
                                                    <th  sortable="docket_details" class="sortable">
                                                        Docket Details
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr grid-item>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" ng-model="item.create_rma">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    @endif
                                                    <td ng-bind="item.formatted_pv_id"></td>
                                                    <td ng-bind="item.formatted_receipt_id"></td>
                                                    <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                                                    <td ng-bind="item.customer_name"></td>
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
                                            </select>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="withoutrma" role="tabpanel" aria-labelledby="withoutrma-tab">
                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-md pull-right m-b-10" ng-click="CreateRMA();">
                                            <i class="fa fa-check-circle"></i>&nbsp;Create RMA
                                        </button>
                                    </div>
                                    @endif
                                    <!-- DATA TABLE-->
                                    <div grid-data grid-options="pvgridOptions" grid-actions="pvgridActions">
                                        <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                        <table class="table table-borderless table-data3 table-responsive">
                                            <thead>
                                                <tr>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <th>
                                                        Select
                                                    </th>
                                                    @endif
                                                    <th>
                                                        R Id
                                                    </th>
                                                    <th>
                                                        Receipt Id
                                                    </th>
                                                    <th>
                                                        Date
                                                    </th>
                                                    <th>
                                                        Customer Name
                                                    </th>
                                                    <th>
                                                        Courier Name
                                                    </th>
                                                    <th>
                                                        Docket Details
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr grid-item>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <td>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" ng-model="item.create_rma">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    @endif
                                                    <td ng-bind="item.formatted_pv_id"></td>
                                                    <td ng-bind="item.formatted_receipt_id"></td>
                                                    <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                                                    <td ng-bind="item.customer_name"></td>
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
                                            </select>
                                            </div>
                                        </form>
                                    </div>
                                <!-- END DATA TABLE-->
                                </div>
                                <div class="tab-pane fade" id="saved" role="tabpanel" aria-labelledby="saved-tab">
                                    <div class="col-md-12">
                                        <!-- DATA TABLE-->
                                        <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="">
                                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                            <table class="table table-borderless table-data3 table-responsive">
                                                <thead>
                                                <tr>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <th>
                                                        Actions
                                                    </th>
                                                    @endif
                                                    <th sortable="formatted_rma_id" class="sortable">
                                                        RMA No
                                                    </th>
                                                    <th sortable="date" class="sortable">
                                                        Date
                                                    </th>

                                                    <th sortable="gs_no" class="sortable">
                                                        GS No
                                                    </th>
                                                    <th sortable="act_reference" class="sortable">
                                                        ACT Reference
                                                    </th>
                                                    <th sortable="customer_name" class="sortable">
                                                        Customer Name
                                                    </th>
                                                    <th sortable="end_customer" class="sortable">
                                                        End Customer
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr grid-item>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <td>
                                                        <div class="table-data-feature float-left">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="EditRMAForm(item.id);">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                                    title="Add"
                                                                    ng-click="AddPVForm(item.id);">
                                                                <i class="zmdi zmdi-plus-box"></i>
                                                            </button>
                                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button> -->
                                                        </div>
                                                    </td>
                                                    @endif
                                                    <td ng-bind="item.formatted_rma_id"></td>
                                                    <td ng-bind="item.date | date:'dd/MM/yyyy'"></td>

                                                    <td ng-bind="item.gs_no"></td>
                                                    <td ng-bind="item.act_reference"></td>
                                                    <td ng-bind="item.customer_name"></td>
                                                    <td ng-bind="item.end_customer"></td>
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
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END DATA TABLE-->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="opensitecard" role="tabpanel" aria-labelledby="opensitecard-tab">
                                    <div class="col-md-12">
                                        @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                        <button type="button" class="btn btn-primary btn-md pull-right m-b-10" ng-click="CreateSiteCard();">
                                            <i class="fa fa-check-circle"></i>&nbsp;Create SiteCard
                                        </button>
                                        @endif
                                        <!-- DATA TABLE-->
                                        <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="">
                                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                            <table class="table table-borderless table-data3 table-responsive">
                                                <thead>
                                                <tr>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <th>
                                                        Actions
                                                    </th>
                                                    @endif
                                                    <th sortable="formatted_rma_id" class="sortable">
                                                        RMA No
                                                    </th>
                                                    <th sortable="date" class="sortable">
                                                        Date
                                                    </th>
                                                    <th sortable="gs_no" class="sortable">
                                                        GS No
                                                    </th>
                                                    <th sortable="act_reference" class="sortable">
                                                        ACT Reference
                                                    </th>
                                                    <th sortable="customer_name" class="sortable">
                                                        Customer Name
                                                    </th>
                                                    <th sortable="end_customer" class="sortable">
                                                        End Customer
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr grid-item>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <td>
                                                        <div class="table-data-feature float-left">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="EditRMAForm(item.id);">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button> -->
                                                        </div>
                                                    </td>
                                                    @endif
                                                    <td ng-bind="item.formatted_rma_id"></td>
                                                    <td ng-bind="item.date | date:'dd/MM/yyyy'"></td>

                                                    <td ng-bind="item.gs_no"></td>
                                                    <td ng-bind="item.act_reference"></td>
                                                    <td ng-bind="item.customer_name"></td>
                                                    <td ng-bind="item.end_customer"></td>
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
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END DATA TABLE-->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    <div class="col-md-12">
                                        <!-- DATA TABLE-->
                                        <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="">
                                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                            <table class="table table-borderless table-data3 table-responsive">
                                                <thead>
                                                <tr>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <th>
                                                        Actions
                                                    </th>
                                                    @endif
                                                    <th sortable="formatted_rma_id" class="sortable">
                                                        RMA No
                                                    </th>
                                                    <th sortable="date_unix" class="sortable">
                                                        Date
                                                    </th>
                                                    <th sortable="status" class="sortable">
                                                        Status
                                                    </th>
                                                    <th sortable="gs_no" class="sortable">
                                                        GS No
                                                    </th>
                                                    <th sortable="act_reference" class="sortable">
                                                        ACT Reference
                                                    </th>
                                                    <th sortable="customer_name" class="sortable">
                                                        Customer Name
                                                    </th>
                                                    <th sortable="end_customer" class="sortable">
                                                        End Customer
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr grid-item>
                                                    @if(Auth::user()->isTechnician() || Auth::user()->isAdmin())
                                                    <td>
                                                        <div class="table-data-feature float-left">
                                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle item"><span><i class="zmdi zmdi-print"></i></span></button>
                                                            <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
                                                                <!-- <button ng-click="PrintRMAForm(item.id)" type="button" tabindex="0" class="dropdown-item">RMA Form</button> -->
                                                                <button ng-click="PrintPVForm(item.id);" type="button" tabindex="0" class="dropdown-item">PV Form</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @endif
                                                    <td ng-bind="item.formatted_rma_id"></td>
                                                    <td ng-bind="item.date | date:'dd/MM/yyyy'"></td>
                                                    <td ng-if="item.status == 1">Open</td>
                                                    <td ng-if="item.status == 2">Saved</td>
                                                    <td ng-if="item.status == 3">Completed</td>
                                                    <td ng-bind="item.gs_no"></td>
                                                    <td ng-bind="item.act_reference"></td>
                                                    <td ng-bind="item.customer_name"></td>
                                                    <td ng-bind="item.end_customer"></td>
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
           <div class="row" ng-if="showrmaform">
                @component('forms.creatermaform')
                    
                @endcomponent
            </div>
            <div class="row" ng-if="showsitecardform">
                @component('forms.sitecardform')
                    
                @endcomponent
            </div>
            <div class="row" ng-if="addpvform">
                @component('forms.addpvform')
                    
                @endcomponent
            </div>
	   </div>
    </div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/RMAController.js')}}"></script>
	<script>
        $( document ).ready(function() {
            $( "#date" ).datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });

               $( "#dateFilter" ).datepicker({
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
            });

            $("#dateToFilter").datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
            });
        });
    </script>
@endsection