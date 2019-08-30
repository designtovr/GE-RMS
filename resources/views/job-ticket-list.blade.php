@extends('layouts.app')
@section('title', 'Job Ticket List')
@section('content')
<div class="main-content" ng-controller="JobTicketController">
	<div class="section__content section__content--p30">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!showjtform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">Job Ticket List</h6>
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
	            <div class="col-md-12">
	                <!-- DATA TABLE-->
	                <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="table-responsive">
		                 <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
		                 <table class="table table-borderless table-data3">
		                     <thead>
		                     <tr>
		                         <th sortable="code" class="sortable">
		                             Material Part No
		                         </th>
		                         <th sortable="placed" class="sortable">
		                             Value
		                         </th>
		                         <th sortable="purchaseOrderNumber" class="sortable">
		                             Old PCB
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             New PCB
		                         </th>
		                         <th sortable='total.value' class="sortable">
		                             Comment
		                         </th>
		                         <th>
		                         	Actions
		                         </th>
		                     </tr>
		                     </thead>
		                     <tbody>
		                     <tr grid-item>
		                         <td ng-bind="item.part_no"></td>
		                         <td ng-bind="item.value"></td>
		                         <td ng-bind="item.old_pcb"></td>
		                         <td ng-bind="item.new_pcb"></td>
		                         <td ng-bind="item.comment"></td>
		                         <td>
		                         	<div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenJTForm();">
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
	        <div class="row" ng-show="showjtform">
	    		<div class="col-lg-12">
	    			<div class="card">
	    				<div class="card-header">
	                        <strong>Job Ticket</strong> Form
	                    </div>
	                    <div class="card-body card-block">
	                    	<form action="" method="post" class="form-horizontal">
	                    		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="case-condition" class=" form-control-label">Type Of Work <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <select name="case-condition" id="case-condition" class="form-control" disabled>
			                                        <option value="1" selected>Repair</option>
			                                        <option value="2">Modification</option>
			                                        <option value="2">Investigation</option>
			                                    </select>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="rid" class=" form-control-label">RID <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="rid" name="rid" placeholder="RID" class="form-control" disabled>
			                                    <span class="help-block">Please Enter RID</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
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
			                                    <label for="given-date" class=" form-control-label">PO Date<span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="given-date" name="given-date" placeholder="PO Date" class="form-control" disabled>
			                                    <span class="help-block">Please Select PO Date</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="taken-date" class=" form-control-label">Given Date<span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="taken-date" name="taken-date" placeholder="Taken Date" class="form-control" disabled>
			                                    <span class="help-block">Please Select Given Date</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="nature-of-defect" class=" form-control-label">Taken Date <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="nature-of-defect" name="nature-of-defect" placeholder="Taken Date" class="form-control" disabled>
			                                    <span class="help-block">Please Enter Taken Date</span>
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
			                                    <label for="nature-of-defect" class=" form-control-label">End Customer <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="nature-of-defect" name="nature-of-defect" placeholder="End Customer" class="form-control" disabled>
			                                    <span class="help-block">Please Enter End Customer</span>
			                                </div>
			                            </div>
		                			</div>
		                			
		                		</div>
		                		<div class="row">
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
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="nature-of-defect" class=" form-control-label">Nature Of Defect <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <textarea name="textarea-input" id="textarea-input" rows="2" placeholder="Content..." class="form-control"></textarea>
			                                    <span class="help-block">Please Enter Nature Of Defect</span>
			                                </div>
			                            </div>
		                			</div>
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc-comment" class=" form-control-label">CRC Comment <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <textarea name="textarea-input" id="textarea-input" rows="2" placeholder="Content..." class="form-control"></textarea>
			                                    <span class="help-block">Please Enter CRC Comment</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
		                		<div class="row">
		                			<div class="col-md-6">
		                				<div class="row form-group">
			                                <div class="col col-md-4">
			                                    <label for="crc-comment" class=" form-control-label">Power On Test <span class="mandatory">*</span></label>
			                                </div>
			                                <div class="col-12 col-md-8">
			                                    <input type="text" id="crc-comment" name="crc-comment" placeholder="Power On Test" class="form-control">
			                                    <span class="help-block">Please Enter Power On Test</span>
			                                </div>
			                            </div>
		                			</div>
		                		</div>
	                    	</form>
	                    </div>
	                    <div class="card-header">
	                        <strong>Material</strong>
	                    </div>
	                    <div class="card-body card-block">
	                    	<form action="" method="post" class="form-horizontal">
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="material-part-no" class=" form-control-label">Material Part No <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <input type="text" id="material-part-no" name="material-part-no" placeholder="Material Part No" class="form-control">
	                                    <span class="help-block">Please Enter Material Part No</span>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="value" class=" form-control-label">Value <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <input type="text" id="value" name="value" placeholder="Value" class="form-control">
	                                    <span class="help-block">Please Enter Value</span>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="old-pcp" class=" form-control-label">Old PCP <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <input type="text" id="old-pcp" name="old-pcp" placeholder="Old PCP" class="form-control">
	                                    <span class="help-block">Please Enter Old PCP</span>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="new-pcp" class=" form-control-label">New PCP <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <input type="text" id="new-pcp" name="new-pcp" placeholder="New PCP" class="form-control">
	                                    <span class="help-block">Please Enter New PCP</span>
	                                </div>
	                            </div>
	                            <div class="row form-group">
	                                <div class="col col-md-3">
	                                    <label for="new-pcp" class=" form-control-label">Comment <span class="mandatory">*</span></label>
	                                </div>
	                                <div class="col-12 col-md-6">
	                                    <textarea name="textarea-input" id="textarea-input" rows="2" placeholder="Content..." class="form-control"></textarea>
	                                    <span class="help-block">Please Enter Comment</span>
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
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/JobTicketController.js')}}"></script>
@endsection