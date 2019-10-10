@extends('layouts.app')
@section('title', 'RMS List')
@section('content')
<div class="main-content" ng-controller="RelayMovementController">
	<div class="section__content section__content--p30" ng-init = "getRMS();">
	    <div class="container-fluid">
	    	<div class="row">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">RMS List</h6>
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
                                                   ng-model="filterID" filter-by="rid" filter-type="text">
                                        </th>
                                        <th>

                                            <input id="productFilter" type="text"
                                                   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
                                                   placeholder="Enter Rack ID" ng-change="gridActions.filter();"
                                                   ng-model="filterreceipt_id" filter-by="rack"
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
			    	<button type="button" class="btn btn-primary btn-md float-right" ng-click="OpenRMSModal();">
	                        <i class="fa fa-plus"></i>&nbsp;Add
	                </button>
			    </div>
	            <div class="col-md-12">
	                <!-- DATA TABLE-->
	                <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="table-responsive">
		                 <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
		                 <table class="table table-borderless table-data3">
		                     <thead>
		                     <tr>
                                <th>
                                    Select
                                </th>
                                <th sortable='date' class="sortable">
                                     Date
                                 </th>
		                         <th sortable="id" class="sortable">
		                             RID No
		                         </th>
								 <th sortable="location" class="sortable">
									 Location
								 </th>
								 <th sortable="rack" class="sortable">
									 Rack
								 </th>
		                     </tr>
		                     </thead>
		                     <tbody>
		                     <tr grid-item>
                                <td>
                                    <label class="au-checkbox">
                                        <input type="checkbox" ng-model="item.selected">
                                        <span class="au-checkmark"></span>
                                    </label>
                                </td>
                                <td ng-bind="item.moved_date | date:'dd/MM/yyyy'"></td>
		                         <td ng-bind="item.rid"></td>
								 <!-- <td ng-bind="item.location"></td> -->
                                 <td>Customer Waiting Rack</td>
								 <td ng-bind="item.rack"></td>
		                     </tr>
		                     </tbody>
		                 </table>
					 </div>
	                <!-- END DATA TABLE-->
	            </div>
	        </div>
	    </div>
	</div>
	<!-- modal scroll -->
    <div class="modal fade" id="rmsmodal" tabindex="-1" role="dialog" aria-labelledby="rmsmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rmsmodalLabel">@{{rmsmodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseRMSModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddUserForm" id="AddUserForm" novalidate>
		                		<div class="row">
		                			<div class="col-md-12">
		                				<div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="comment" class=" form-control-label"><b>RID</b> <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <input type="text" id="comment" name="comment" ng-model = "rmsmodal.rid" placeholder="RID" class="form-control">
			                                    <!-- <span class="help-block">Please Enter RID</span> -->
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-12">
		                				<div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="comment" class=" form-control-label"><b>Rack Id</b> <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <input type="text" id="comment" name="comment" ng-model = "rmsmodal.rack" placeholder="Rack Id" class="form-control">
			                                    <!-- <span class="help-block">Please Enter Rack Id</span> -->
			                                </div>
			                            </div>
		                			</div>
		                		</div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseRMSModal();">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm"  ng-click="AddRMS();">
                        <i class="fa fa-dot-circle-o"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal scroll -->
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/RelayMovementController.js')}}"></script>
@endsection