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
	                    <div class="col-md-6">
	                    	<div class="table-responsive">
		                        <table class="table table-borderless table-data3 table-custom">
		                            <thead>
		                                <tr>
		                                    <th>
		                                        <input id="ridFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="R Id#" ng-change="gridActions.filter()" ng-model="filterRId" filter-by="rid" filter-type="text">
		                                    </th>
		                                   <th>
		                                        <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="ResetSiteSearch();gridActions.filter()">Reset</button>
		                                    </th>
		                                </tr>
		                            </thead>
		                        </table>
		                    </div>
	                    </div>
	                </div>
	                <div class="col-md-12">
	                    <!-- DATA TABLE-->
	                    <div grid-data grid-options="gridOptions" grid-actions="gridActions">
	                        <table class="table table-borderless table-data3">
	                            <thead>
	                                <tr>
	                                    <th sortable="code" class="sortable">RId</th>
	                                    <th sortable="name" class="sortable">Customer Name</th>
	                                    <th>Actions</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <tr grid-item>
	    	                            <td ng-bind="item.formatted_pv_id"></td>
	                                    <td></td>
	                                    <td>
	    	                                <div class="table-data-feature">
	    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Report" ng-click="GenerateReport(item.id)">
	    	                                        <i class="zmdi zmdi-file-text"></i>
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
@endsection