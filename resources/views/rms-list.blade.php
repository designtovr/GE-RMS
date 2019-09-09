@extends('layouts.app')
@section('title', 'RMS List')
@section('content')
<div class="main-content" ng-controller="RelayMovementController">
	<div class="section__content section__content--p30">
	    <div class="container-fluid">
	    	<div class="row">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">RMS List</h6>
			        </div>
			    </div>
			    <div class="col-md-12">
			    	<div class="table-responsive">
	                    <table class="table table-borderless table-data3 table-custom">
	                    	<thead>
	                            <tr>
	                                <th>
		                                <input type="text" id="se-rid" name="se-rid" placeholder="RID" class="form-control-sm form-control">
	                            	</th>
	                                <th>
	                                	<input type="text" id="se-rack" name="se-rack" placeholder="Rack" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                	<select name="se-date" id="se-date" class="form-control-sm form-control">
	                                        <option value="0">Date</option>
	                                        <option value="1">Yes</option>
	                                        <option value="2">No</option>
	                                        <option value="2">Customer</option>
	                                    </select>
	                                </th>
	                                <th>
	                                	<button type="button" class="btn btn-outline-secondary btn-sm">Reset</button>
	                                </th>
	                                <th>
	                                	<button type="button" class="btn btn-outline-primary btn-sm">
	                                            <i class="fa fa-search"></i>&nbsp; Search</button>
	                                </th>
	                            </tr>
	                        </thead>
	                    </table>
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
		                         <th sortable="placed" class="sortable">
		                             RID No
		                         </th>
		                         <th sortable="purchaseOrderNumber" class="sortable">
		                             Rack
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             Date
		                         </th>
		                     </tr>
		                     </thead>
		                     <tbody>
		                     <tr grid-item>
		                         <td ng-bind="item.rid_no"></td>
		                         <td ng-bind="item.rack"></td>
		                         <td ng-bind="item.date"></td>
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
			                                    <input type="text" id="comment" name="comment" placeholder="RID" class="form-control">
			                                    <span class="help-block">Please Enter RID</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-12">
		                				<div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="comment" class=" form-control-label"><b>Rack Id</b> <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <input type="text" id="comment" name="comment" placeholder="Rack Id" class="form-control">
			                                    <span class="help-block">Please Enter Rack Id</span>
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
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddUserForm.$invalid" ng-click="AddUser();">
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