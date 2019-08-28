@extends('layouts.app')
@section('title', 'Material')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getmaterials();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Materials</h6>
    		            <button type="button" class="btn btn-primary btn-sm" ng-click="OpenMaterialModal(0);">
                            <i class="fa fa-plus"></i>&nbsp; Add Material</button>
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
                                    <th>Part No</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="material in materials">
    	                            <td>@{{material.part_no}}</td>
                                    <td>@{{material.type}}</td>
                                    <td>@{{material.description}}</td>
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
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
    <!-- modal scroll -->
    <div class="modal fade" id="materialmodal" tabindex="-1" role="dialog" aria-labelledby="materialmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materialmodalLabel">@{{materialmodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseMaterialModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddMaterialForm" id="AddMaterialForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="partno" class=" form-control-label" >Part No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="partno" 
                                            name="partno" 
                                            ng-model="material.part_no" 
                                            placeholder="Part No" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="10"
                                            required>
                                            <div ng-show="AddMaterialForm.partno.$touched && AddMaterialForm.partno.$error">
                                                <span class="help-block"
                                                 ng-show="AddMaterialForm.partno.$error.required">
                                                    Please Enter Part No
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddMaterialForm.partno.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddMaterialForm.partno.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="materialtype" class=" form-control-label">Material Type <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select 
                                        ng-model="material.type" 
                                        id="materialtype" 
                                        name="materialtype" 
                                        class="form-control" 
                                        required>
                                            <option ng-repeat="materialtype in materialtypes" value="@{{materialtype.id}}" ng-selected="">@{{materialtype.name}}</option>
                                        </select>
                                        <div ng-show="AddMaterialForm.materialtype.$touched && AddMaterialForm.materialtype.$error">
                                            <span class="help-block" ng-show="AddMaterialForm.materialtype.$error.required">
                                                Please Select Material Type
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="materialdescription" class=" form-control-label" >Material Description <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <textarea
                                            type="text" 
                                            id="materialdescription" 
                                            name="materialdescription" 
                                            ng-model="material.description" 
                                            placeholder="Material Description" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="50"
                                            rows="3"
                                            required>
                                        </textarea>
                                            <div ng-show="AddMaterialForm.materialdescription.$touched && AddMaterialForm.materialdescription.$error">
                                                <span class="help-block"
                                                 ng-show="AddMaterialForm.materialdescription.$error.required">
                                                    Please Enter Material Description
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddMaterialForm.materialdescription.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddMaterialForm.materialdescription.$error.maxlength">
                                                    Maximum 50 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseMaterialModal();">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddMaterialForm.$invalid" ng-click="AddMaterial();">
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