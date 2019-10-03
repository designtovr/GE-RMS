@extends('layouts.app')
@section('title', 'RMA List')
@section('content')
<div class="main-content" ng-controller="RMAController">
	<div class="section__content section__content--p30" ng-init="GetRMAList();InitiateForm();">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!showrmaform">
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
                 <div >
                    <div class="table-responsive">
                        <table class="table table-borderless table-data3 table-custom">
                            <thead>
                                <tr>
                                    <th>

                                        <input id="ridFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Enter RMA #" ng-change="gridActions.filter();" ng-model="filterID" filter-by="id" filter-type="text">
                                    </th>  <th>
                                        <input type="text"
                                        id="dateFilter"
                                        class="form-control"
                                        placeholder="Date"
                                        max-date="dateTo"
                                        close-text="Close"
                                        ng-model="filterdate"
                                        show-weeks="true"
                                        is-open="dateFromOpened"
                                        ng-click="dateFromOpened = true"
                                        filter-by="date"
                                        filter-type="text"
                                        ng-change="gridActions.filter()"
                                        close-text="Close"/>

                                    </th>
                                    <th>

                                        <input id="productFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Enter GS No" ng-change="gridActions.filter();" ng-model="filtergs_no" filter-by="gs_no" filter-type="text">
                                    </th>

                                     <th>

                                        <input id="productFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Enter ACT" ng-change="gridActions.filter();" ng-model="filteract" filter-by="act_reference" filter-type="text">
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
                               <input id="customerFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Enter Customer Name" ng-change="gridActions.filter()" ng-model="filterCustomer" filter-by="end_customer" filter-type="text">
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
	            <div class="col-md-12">
	                <!-- DATA TABLE-->
	                <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="">
                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr>
                                    <th sortable="id" class="sortable">
                                        RMA Ref No
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
                                    <th sortable="end_customer" class="sortable">
                                        End Customer
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr grid-item>
                                    <td ng-bind="item.id"></td>
                                    <td ng-bind="item.date | date:'dd/MM/yyyy'"></td>

                                    <td ng-bind="item.gs_no"></td>
                                    <td ng-bind="item.act_reference"></td>
                                    <td ng-bind="item.end_customer"></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="EditRMAForm(item.id);">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Add"
                                                    ng-click="AddPVForm(item.id);">
                                                <i class="zmdi zmdi-plus-box"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
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
	        <div class="row" ng-if="showrmaform">
                @component('forms.creatermaform')
                    
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
        });
    </script>
@endsection