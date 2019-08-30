@extends('layouts.app')
@section('title', 'Repair Initiation List')
@section('content')
<div class="main-content" ng-controller="RepairInitiationController">
	<div class="section__content section__content--p30">
	    <div class="container-fluid">
	    	<div class="row">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">Repair Initiation List</h6>
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
	                                	<input type="text" id="se-rma-no" name="se-rma-no" placeholder="RMA No" class="form-control-sm form-control">
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
		                         <td ng-bind="item.customer_comment"></td>
		                         <td ng-bind="item.remark"></td>
		                         <td ng-bind="item.wbsno"></td>
		                         <td>
                                    <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
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
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/RepairInitiationController.js')}}"></script>
@endsection