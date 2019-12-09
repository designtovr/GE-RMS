@extends('layouts.app')
@section('title', 'Material Type')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getmaterialtypes();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Material Types</h6>
    		            <button type="button" class="btn btn-primary btn-sm" ng-click="OpenMaterialTypeModal(0);">
                            <i class="fa fa-plus"></i>&nbsp; Add Material Type</button>
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
                        <div class="overflow-auto">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="materialtype in materialtypes">
        	                            <td>@{{materialtype.code}}</td>
        	                            <td>@{{materialtype.name}}</td>
                                        <td>
        	                                <div class="table-data-feature">
        	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
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
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
    <!-- modal scroll -->
    <div class="modal fade" id="materialtypemodal" tabindex="-1" role="dialog" aria-labelledby="materialtypemodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materialtypemodalLabel">@{{materialtypemodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseMaterialTypeModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddMaterialTypeForm" id="AddMaterialTypeForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="materialtypecode" class=" form-control-label" >Material Type Code <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="materialtypecode" 
                                            name="materialtypecode" 
                                            ng-model="materialtype.code" 
                                            placeholder="Material Type Code" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="10"
                                            required>
                                            <div ng-show="AddMaterialTypeForm.materialtypecode.$touched && AddMaterialTypeForm.materialtypecode.$error">
                                                <span class="help-block"
                                                 ng-show="AddMaterialTypeForm.materialtypecode.$error.required">
                                                    Please Enter Material Type Code
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddMaterialTypeForm.materialtypecode.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddMaterialTypeForm.materialtypecode.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="materialtypename" class=" form-control-label" >Material Type Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="materialtypename" 
                                            name="materialtypename" 
                                            ng-model="materialtype.name" 
                                            placeholder="Material Type Name" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="10"
                                            required>
                                            <div ng-show="AddMaterialTypeForm.materialtypename.$touched && AddMaterialTypeForm.materialtypename.$error">
                                                <span class="help-block"
                                                 ng-show="AddMaterialTypeForm.materialtypename.$error.required">
                                                    Please Enter Material Type Name
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddMaterialTypeForm.materialtypename.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddMaterialTypeForm.materialtypename.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseMaterialTypeModal();">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddMaterialTypeForm.$invalid" ng-click="AddMaterialType();">
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