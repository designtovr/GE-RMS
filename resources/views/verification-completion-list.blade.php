@extends('layouts.app')
@section('title', 'Verification Completion List')
@section('content')
<div class="main-content" ng-controller="VerificationCompleteController">
	<div class="section__content section__content--p30">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!vcform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">Verification Completion List</h6>
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
		                         	<div class="table-data-feature">
		                         		<button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="ShowVCForm();">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
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
	        <div class="row" ng-show="vcform">
	    		<div class="col-lg-12">
	    			<div class="card">
	    				<div class="card-header">
	                        <strong>Verification Completion</strong> Form
	                    </div>
	                    <div class="card-body card-block">
	                    	<form action="" method="post" class="form-horizontal">
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="rma-no" class=" form-control-label">RMA NO <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="rma-no" name="rma-no" placeholder="RMA NO" class="form-control" disabled>
			                                    <span class="help-block">Please Enter RMA NO</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="given-date" class=" form-control-label">Date<span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="given-date" name="given-date" placeholder="Date" class="form-control" disabled>
			                                    <span class="help-block">Please Select Date</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="taken-date" class=" form-control-label">Customer<span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="taken-date" name="taken-date" placeholder="Customer" class="form-control" disabled>
			                                    <span class="help-block">Please Select Customer</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="nature-of-defect" class=" form-control-label">Model No <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="nature-of-defect" name="nature-of-defect" placeholder="Model No" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Model No</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc-comment" class=" form-control-label">Series No <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="crc-comment" name="crc-comment" placeholder="Series No" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Series No</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc-comment" class=" form-control-label">Software Ref. <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="crc-comment" name="crc-comment" placeholder="Software Reference" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Software Ref</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc-comment" class=" form-control-label">Teriminal Block <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="crc-comment" name="crc-comment" placeholder="Terminal Block" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Terminal Block</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc-comment" class=" form-control-label">Short Link <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="crc-comment" name="crc-comment" placeholder="Short Link" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Short Link</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
	                    	</form>
	                    </div>
	                    <div class="card-header">
	                        <strong></strong>
	                    </div>
	                    <div class="card-body card-block">
	                    	<form action="" method="post" class="form-horizontal">
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="material-part-no" class=" form-control-label">CLI Test <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true">
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="material-part-no" class=" form-control-label">RTD Test <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true">
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="material-part-no" class=" form-control-label">VA Burden Test <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true">
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="material-part-no" class=" form-control-label">Relay Received With Screw <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true">
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="material-part-no" class=" form-control-label">Relay Received With Terminal Block <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <label class="switch switch-text switch-success switch-pill">
					                      <input type="checkbox" class="switch-input" checked="true">
					                      <span data-on="Yes" data-off="No" class="switch-label"></span>
					                      <span class="switch-handle"></span>
					                    </label>
	                                </div>
	                            </div>
	                    	</form>
	                    </div>
	                    <div class="card-footer">
	                        <button type="submit" class="btn btn-primary btn-sm">
	                            <i class="fa fa-dot-circle-o"></i> Save
	                        </button>
	                        <button type="reset" class="btn btn-danger btn-sm">
	                            <i class="fa fa-ban"></i> Reset
	                        </button>
	                        <button type="reset" class="btn btn-secondary btn-sm" ng-click="CloseJTForm();">
	                            <i class="fa fa-ban"></i> Close
	                        </button>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    </div>
	</div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/VerificationCompleteController.js')}}"></script>
@endsection