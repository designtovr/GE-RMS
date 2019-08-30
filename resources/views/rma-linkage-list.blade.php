@extends('layouts.app')
@section('title', 'RMA Linkage List')
@section('content')
<div class="main-content" ng-controller="RMALinkageController">
	<div class="section__content section__content--p30">
	    <div class="container-fluid">
	    	<div class="row">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">RMA Linkage List</h6>
			        </div>
			    </div>
			    <div class="col-md-12">
			    	<div class="table-responsive">
	                    <table class="table table-borderless table-data3 table-custom">
	                    	<thead>
	                            <tr>
	                                <th>
		                                <input type="text" id="se-from-date" name="se-from-date" placeholder="From Date" class="form-control-sm form-control">
	                            	</th>
	                                <th>
	                                	<input type="text" id="se-to-date" name="se-to-date" placeholder="To Date" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                	<select name="field-volts-used" id="field-volts-used" class="form-control-sm form-control">
	                                        <option value="0">From</option>
	                                        <option value="1">Yes</option>
	                                        <option value="2">No</option>
	                                        <option value="2">Customer</option>
	                                    </select>
	                                </th>
	                                <th>
	                                	<select name="field-volts-used" id="field-volts-used" class="form-control-sm form-control">
	                                        <option value="0">To</option>
	                                        <option value="1">Yes</option>
	                                        <option value="2">No</option>
	                                        <option value="2">Customer</option>
	                                    </select>
	                                </th>
	                                <th>
	                                	<input type="text" id="se-cus" name="se-cus" placeholder="Customer" class="form-control-sm form-control">
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
			    	<button type="button" class="btn btn-primary btn-md float-right" ng-click="OpenLinkageModal();">
	                   <i class="fa fa-plus"></i>&nbsp;Link
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
		                             
		                         </th>
		                         <th sortable="placed" class="sortable">
		                             RID No
		                         </th>
		                         <th sortable="purchaseOrderNumber" class="sortable">
		                             Product
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             Customer Name
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             End Customer
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             Serial No
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             Model No
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             Courier
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             Docket No
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             Customer Comment
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             Remark
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             WBS No
		                         </th>
		                         <th>
		                             Actions
		                         </th>
		                     </tr>
		                     </thead>
		                     <tbody>
		                     <tr grid-item>
		                     	 <td>
		                     	 	<label class="au-checkbox">
                                        <input type="checkbox">
                                        <span class="au-checkmark"></span>
                                    </label>
		                     	 </td>
		                         <td ng-bind="item.rid_no"></td>
		                         <td ng-bind="item.product"></td>
		                         <td ng-bind="item.customer_name"></td>
		                         <td ng-bind="item.end_customer"></td>
		                         <td ng-bind="item.serial_no"></td>
		                         <td ng-bind="item.model_no"></td>
		                         <td ng-bind="item.courier_name"></td>
		                         <td ng-bind="item.docket_details"></td>
		                         <td ng-bind="item.customer_comment"></td>
		                         <td>
		                         	<input type="text" id="remark" name="remark" placeholder="Remark" class="form-control">
		                         </td>
		                         <td>
		                         	<input type="text" id="wbsno" name="wbsno" placeholder="WBS No" class="form-control">
		                         </td>
		                         <td>
		                         	<div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                </div>
		                         </td>
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
    <div class="modal fade" id="linkagemodal" tabindex="-1" role="dialog" aria-labelledby="linkagemodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="linkagemodalLabel">@{{linkagemodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseLinkageModal();" aria-label="Close">
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
			                                    <label for="comment" class=" form-control-label"><b>RMA No</b> <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-9">
			                                    <input type="text" id="comment" name="comment" placeholder="RMA No" class="form-control">
			                                    <span class="help-block">Please Enter RMA No</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseLinkageModal();">
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
	<script type="text/javascript" src="{{url('public/js/controllers/RMALinkageController.js')}}"></script>
@endsection