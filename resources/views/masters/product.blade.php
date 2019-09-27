@extends('layouts.app')
@section('title', 'Product')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getproducts();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Products</h6>
    		            <button type="button" class="btn btn-primary btn-sm" ng-click="OpenProductModal();">
                            <i class="fa fa-plus"></i>&nbsp; Add Product</button>
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
                                    <th>Product ID</th>
                                    <th>Part No</th>
                                    <th>Product Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="product in products">
                                    <td>@{{product.id}}</td>
                                    <td>@{{product.part_no}}</td>
                                    <td>@{{product.type_name}}</td>
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
    <div class="modal fade" id="productmodal" tabindex="-1" role="dialog" aria-labelledby="productmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productmodalLabel">@{{productmodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseProductModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="ProductForm" id="ProductForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="producttype" class=" form-control-label">Product Type <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select
                                            ng-model="product.type"
                                            id="producttype"
                                            name="producttype"
                                            class="form-control"
                                            ng-change="ChangeProductCategory();"
                                            required>
                                            <option ng-repeat="producttype in producttypes" value="@{{producttype.id}}">@{{producttype.name}}</option>
                                        </select>
                                        <div ng-show="ProductForm.producttype.$touched && ProductForm.producttype.$error">
                                            <span class="help-block" ng-show="ProductForm.producttype.$error.required">
                                                Please Select Product Type
                                            </span>
                                        </div>
                                    </div>
                                </div> <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="producttype" class=" form-control-label">Product Category <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="productpartno" 
                                            name="productpartno" 
                                            ng-model="product.category" 
                                            placeholder="Product Category" 
                                            class="form-control"
                                            disabled>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="productpartno" class=" form-control-label" >Product No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="productpartno" 
                                            name="productpartno" 
                                            ng-model="product.part_no" 
                                            placeholder="Product Part No" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="10"
                                            required>
                                            <div ng-show="ProductForm.productpartno.$touched && ProductForm.productpartno.$error">
                                                <span class="help-block"
                                                 ng-show="ProductForm.productpartno.$error.required">
                                                    Please Enter Product Part No
                                                </span>
                                                <span class="help-block"
                                                 ng-show="ProductForm.productpartno.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="ProductForm.productpartno.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="productdescription" class=" form-control-label" >Product Description <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <textarea
                                            type="text" 
                                            id="productdescription" 
                                            name="productdescription" 
                                            ng-model="product.description" 
                                            placeholder="Product Description" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="50"
                                            rows="3"
                                            required>
                                        </textarea>
                                            <div ng-show="ProductForm.productdescription.$touched && ProductForm.productdescription.$error">
                                                <span class="help-block"
                                                 ng-show="ProductForm.productdescription.$error.required">
                                                    Please Enter Product Description
                                                </span>
                                                <span class="help-block"
                                                 ng-show="ProductForm.productdescription.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="ProductForm.productdescription.$error.maxlength">
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
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseProductModal()">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="ProductForm.$invalid" ng-click="AddProduct();">
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