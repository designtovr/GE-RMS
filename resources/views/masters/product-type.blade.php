@extends('layouts.app')
@section('title', 'Product Type')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getproducttypes();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Product Types</h6>
    		            <button type="button" class="btn btn-primary btn-sm" ng-click="OpenProductTypeModal();">
                            <i class="fa fa-plus"></i>&nbsp; Add Product Type</button>
    		        </div>
    		    </div>
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="producttype in producttypes">
    	                            <td>@{{producttype.code}}</td>
    	                            <td>@{{producttype.name}}</td>
                                    <td>@{{producttype.category | uppercase}}</td>
                                    <td>
    	                                <div class="table-data-feature">
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenProductTypeModal(producttype)">
    	                                        <i class="zmdi zmdi-edit"></i>
    	                                    </button>
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" ng-click="DeleteProductType(producttype.id, producttype.code)">
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
    <div class="modal fade" id="producttypemodal" tabindex="-1" role="dialog" aria-labelledby="producttypeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="producttypeLabel">@{{producttypemodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseProductTypeModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="ProductTypeForm" id="ProductTypeForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="productcategory" class=" form-control-label">Product Category <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select
                                            id="productcategory"
                                            name="productcategory"
                                            ng-model="producttype.category"
                                            class="form-control"
                                            required>
                                            <option value="" style="display: none;"></option>
                                            <option value="ge">GE</option>
                                            <option value="omu">OMU</option>
                                            <option value="boj">BOJ</option>
                                        </select>
                                        <div ng-show="ProductTypeForm.productcategory.$touched && ProductTypeForm.productcategory.$error">
                                            <span class="help-block" ng-show="ProductTypeForm.productcategory.$error.required">
                                                Please Select Category
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="producttypecode" class=" form-control-label" >Product Type Family <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="producttypecode"
                                            name="producttypecode"
                                            ng-model="producttype.code"
                                            placeholder="Product Type Family"
                                            class="form-control"
                                            ng-minlength="1"
                                            ng-maxlength="20"
                                            required>
                                            <div ng-show="ProductTypeForm.producttypecode.$touched && ProductTypeForm.producttypecode.$error">
                                                <span class="help-block"
                                                      ng-show="ProductTypeForm.producttypecode.$error.required">
                                                    Please Enter Product Type Family
                                                </span>
                                                <span class="help-block"
                                                  ng-show="ProductTypeForm.producttypecode.$error.minlength">
                                                    Minimum 1 Characters Required
                                                </span>
                                                <span class="help-block"
                                                  ng-show="ProductTypeForm.producttypecode.$error.maxlength">
                                                    Maximum 20 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="producttypename" class=" form-control-label">Product Type<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                                type="text"
                                                id="producttypename"
                                                name="producttypename"
                                                ng-model="producttype.name"
                                                placeholder="Product Type"
                                                class="form-control"
                                                ng-minlength="3"
                                                ng-maxlength="50"
                                                required>
                                        <div ng-show="ProductTypeForm.producttypename.$touched && ProductTypeForm.producttypename.$error">
                                            <span class="help-block"
                                                  ng-show="ProductTypeForm.producttypename.$error.required">
                                                Please Enter Product Type
                                            </span>
                                            <span class="help-block"
                                              ng-show="ProductTypeForm.producttypename.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                            <span class="help-block"
                                              ng-show="ProductTypeForm.producttypename.$error.maxlength">
                                                Maximum 50 Characters Allowed
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="productdescription" class=" form-control-label" >Product Description</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <textarea
                                                type="text"
                                                id="productdescription"
                                                name="productdescription"
                                                ng-model="producttype.description"
                                                placeholder="Product Description"
                                                class="form-control"
                                                rows="4"
                                                >
                                        </textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseProductTypeModal()">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button ng-if="!producttype.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="ProductTypeForm.$invalid" ng-click="AddProductType();">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button ng-if="producttype.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="ProductTypeForm.$invalid" ng-click="AddProductType();">
                        <i class="fa fa-dot-circle-o"></i> Update
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