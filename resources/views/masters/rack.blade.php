@extends('layouts.app')
@section('title', 'Rack')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getracks();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Rack</h6>
    		            <button type="button" class="btn btn-primary btn-sm" ng-click="OpenRackModal(0);">
                            <i class="fa fa-plus"></i>&nbsp; Add Rack</button>
    		        </div>
    		    </div>
    		    <!-- <div class="col-md-12">
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
    		    </div> -->
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="rack in racks">
    	                            <td>@{{rack.code}}</td>
    	                            <td>@{{rack.name}}</td>
                                    <td>@{{rack.type_name}}</td>
                                    <td>
    	                                <div class="table-data-feature">
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
    	                                        <i class="zmdi zmdi-mail-send"></i>
    	                                    </button>
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
    	                                        <i class="zmdi zmdi-edit"></i>
    	                                    </button>
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
    	                                        <i class="zmdi zmdi-delete"></i>
    	                                    </button>
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
    	                                        <i class="zmdi zmdi-more"></i>
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
    <div class="modal fade" id="rackmodal" tabindex="-1" role="dialog" aria-labelledby="rackmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rackmodalLabel">@{{rackmodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseRackModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddRackForm" id="AddRackForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="rackcode" class=" form-control-label" >Rack Code <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="rackcode" 
                                            name="rackcode" 
                                            ng-model="rack.code" 
                                            placeholder="Rack Code" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="10"
                                            required>
                                            <div ng-show="AddRackForm.rackcode.$touched && AddRackForm.rackcode.$error">
                                                <span class="help-block"
                                                 ng-show="AddRackForm.rackcode.$error.required">
                                                    Please Enter Rack Code
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddRackForm.rackcode.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddRackForm.rackcode.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="rackname" class=" form-control-label" >Rack Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="rackname" 
                                            name="rackname" 
                                            ng-model="rack.name" 
                                            placeholder="Rack Name" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="10"
                                            required>
                                            <div ng-show="AddRackForm.rackname.$touched && AddRackForm.rackname.$error">
                                                <span class="help-block"
                                                 ng-show="AddRackForm.rackname.$error.required">
                                                    Please Enter Rack Name
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddRackForm.rackname.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddRackForm.rackname.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="racktype" class=" form-control-label">Rack Type <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select 
                                        ng-model="rack.type" 
                                        id="racktype" 
                                        name="racktype" 
                                        class="form-control" 
                                        required>
                                            <option ng-repeat="racktype in racktypes" value="@{{racktype.id}}" ng-selected="">@{{racktype.name}}</option>
                                        </select>
                                        <div ng-show="AddRackForm.racktype.$touched && AddRackForm.racktype.$error">
                                            <span class="help-block" ng-show="AddRackForm.racktype.$error.required">
                                                Please Select Rack Type
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseRackModal();">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddRackForm.$invalid" ng-click="AddRack();">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal scroll -->
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/MastersController.js')}}"></script>
@endsection