@extends('layouts.app')
@section('title', 'RMA List')
@section('content')
<div class="main-content" ng-controller="RMAController">
	<div class="section__content section__content--p30" ng-init="Initiate();">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!showrmaform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">RMA List</h6>
			            <button type="button" class="btn btn-primary btn-sm" ng-click="ShowRMAForm();">
	                        <i class="fa fa-plus"></i>&nbsp; Create</button>
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
	                <div class="table-responsive m-b-40">
	                    <table class="table table-borderless table-data3">
	                        <thead>
	                            <tr>
	                                <th>RMA Reference No</th>
	                                <th>GA No.</th>
	                                <th>Date</th>
	                                <th>Customer Name</th>
	                                <th>Faulty Unit Quantity</th>
	                                <th>Total Faulty Units</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr>
	                                <td>2018-09-29 05:57</td>
	                                <td>Mobile</td>
	                                <td>iPhone X 64Gb Grey</td>
	                                <td class="process">Processed</td>
	                                <td>$999.00</td>
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
	                            <tr>
	                                <td>2018-09-28 01:22</td>
	                                <td>Mobile</td>
	                                <td>Samsung S8 Black</td>
	                                <td class="process">Processed</td>
	                                <td>$756.00</td>
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
	                            <tr>
	                                <td>2018-09-27 02:12</td>
	                                <td>Game</td>
	                                <td>Game Console Controller</td>
	                                <td class="denied">Denied</td>
	                                <td>$22.00</td>
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
	                            <tr>
	                                <td>2018-09-26 23:06</td>
	                                <td>Mobile</td>
	                                <td>iPhone X 256Gb Black</td>
	                                <td class="denied">Denied</td>
	                                <td>$1199.00</td>
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
	                            <tr>
	                                <td>2018-09-25 19:03</td>
	                                <td>Accessories</td>
	                                <td>USB 3.0 Cable</td>
	                                <td class="process">Processed</td>
	                                <td>$10.00</td>
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
	                            <tr>
	                                <td>2018-09-29 05:57</td>
	                                <td>Accesories</td>
	                                <td>Smartwatch 4.0 LTE Wifi</td>
	                                <td class="denied">Denied</td>
	                                <td>$199.00</td>
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
	                            <tr>
	                                <td>2018-09-24 19:10</td>
	                                <td>Camera</td>
	                                <td>Camera C430W 4k</td>
	                                <td class="process">Processed</td>
	                                <td>$699.00</td>
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
	                            <tr>
	                                <td>2018-09-22 00:43</td>
	                                <td>Computer</td>
	                                <td>Macbook Pro Retina 2017</td>
	                                <td class="process">Processed</td>
	                                <td>$10.00</td>
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
	        <div class="row" ng-show="showrmaform">
	        	<form name="RMAForm" id="RMAForm" class="form-horizontal" novalidate>
	                <div class="col-lg-12">
	                    <div class="card">
	                        <div class="card-header">
	                            <strong>RMA</strong> Form
	                        </div>
	                        <div class="card-body card-block">
	                                <div class="row form-group">
	                                    <div class="col col-md-3">
	                                        <label for="rma_ref_no" class=" form-control-label">RMA Reference No</label>
	                                    </div>
	                                    <div class="col-12 col-md-6">
	                                        <input 
	                                        	type="text" 
	                                        	id="rma_ref_no" 
	                                        	name="rma_ref_no"
	                                        	ng-model="rmaformdata.ref_no"
	                                            placeholder="RMA Reference No"
	                                            class="form-control"
	                                            ng-minlength="1" 
	                                            ng-maxlength="10"
	                                            required
	                                            disabled>
	                                            <div ng-show="RMAForm.rma_ref_no.$touched && RMAForm.rma_ref_no.$error">
	                                                <span class="help-block"
	                                                 ng-show="RMAForm.rma_ref_no.$error.required">
	                                                    Please Enter RMA Reference No
	                                                </span>
	                                                <span class="help-block"
	                                                 ng-show="RMAForm.rma_ref_no.$error.minlength">
	                                                    Minimum 1 Characters Required
	                                                </span>
	                                                <span class="help-block"
	                                                 ng-show="RMAForm.rma_ref_no.$error.maxlength">
	                                                    Maximum 10 Characters Allowed
	                                                </span>
	                                            </div>
	                                    </div>
	                                </div>
	                                <div class="row form-group">
	                                    <div class="col col-md-3">
	                                        <label for="ga_no" class=" form-control-label">GA No</label>
	                                    </div>
	                                    <div class="col-12 col-md-6">
	                                        <input 
	                                        type="text" 
	                                        id="ga_no" 
	                                        name="ga_no" 
	                                        ng-model="rmaformdata.ga_no"
	                                        placeholder="GA No"
	                                        class="form-control"
	                                        ng-minlength="3" 
	                                        ng-maxlength="10"
	                                        required>
	                                        <div ng-show="RMAForm.ga_no.$touched && RMAForm.ga_no.$error">
                                                <span class="help-block"
                                                 ng-show="RMAForm.ga_no.$error.required">
                                                    Please Enter GA Number
                                                </span>
                                                <span class="help-block"
                                                 ng-show="RMAForm.ga_no.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="RMAForm.ga_no.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
	                                    </div>
	                                </div>
	                                <div class="row form-group">
	                                    <div class="col col-md-3">
	                                        <label for="act_reference" class="form-control-label">ACT Reference</label>
	                                    </div>
	                                    <div class="col-12 col-md-6">
	                                        <input 
	                                        type="text" 
	                                        id="act_reference" 
	                                        name="act_reference"
	                                        ng-model="rmaformdata.act_reference"
	                                        placeholder="ACT Reference" 
	                                        class="form-control"
	                                        ng-minlength="3" 
	                                        ng-maxlength="10"
	                                        required>
	                                        <div ng-show="RMAForm.act_reference.$touched && RMAForm.act_reference.$error">
                                                <span class="help-block"
                                                 ng-show="RMAForm.act_reference.$error.required">
                                                    Please Select ACT Reference
                                                </span>
                                                <span class="help-block"
                                                 ng-show="RMAForm.act_reference.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="RMAForm.act_reference.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
	                                    </div>
	                                </div>
	                                <div class="row form-group">
	                                    <div class="col col-md-3">
	                                        <label for="date" class=" form-control-label">Date</label>
	                                    </div>
	                                    <div class="col-12 col-md-6">
	                                        <input 
	                                        type="text" 
	                                        id="date" 
	                                        name="date" 
	                                        ng-model="rmaformdata.date"
	                                        placeholder="Date"
	                                        class="form-control"
	                                        required>
	                                        <!-- <div ng-show="RMAForm.date.$touched && RMAForm.date.$error">
                                                <span class="help-block"
                                                 ng-show="RMAForm.date.$error.required">
                                                    Please Select Date
                                                </span>
                                            </div> -->
	                                    </div>
	                                </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <div class="card ">
	                                <div class="card-header">
	                                    <strong>IDENTIFICATION OF UNIT & FAULT INFORMATION</strong>
	                                </div>
	                                <div class="card-body card-block">
	                                    <div class="col-lg-12 p-b-20 b-b-2 p-t-10" ng-repeat="info in rmaformdata.unit_information">
	                                    	<div class="row p-b-10">
	                                    		<div class="col-md-12">
	                                                <button class="btn btn-danger btn-md float-right" ng-click="RemoveUnitInformation($index);">
	                                                    <i class="fa fa-minus"></i>&nbsp; Remove
	                                                </button>
	                                            </div>
	                                    	</div>
	                                    	<div class="row">
	                                    		<div class="col-lg-6">
	                                    			<div class="row form-group">
		                                                <div class="col col-md-4">
		                                                    <label for="quantity" class=" form-control-label">Quantity</label>
		                                                </div>
		                                                <div class="col-3 col-md-8">
		                                                    <input 
		                                                    type="text" 
		                                                    id="quantity" 
		                                                    name="quantity_@{{$index}}"
		                                                    ng-model="info.quantity"
		                                                    placeholder="Quantity" 
		                                                    class="form-control"
		                                                    ng-pattern="/^[0-9]*$/"
		                                                    min=1
					                                        required>
					                                        <div ng-show="RMAForm.quantity_@{{$index}}.$touched && RMAForm.quantity_@{{$index}}.$error">
				                                                <span class="help-block"
				                                                 ng-show="RMAForm.quantity_@{{$index}}.$error.required">
				                                                    Please Enter Quantity
				                                                </span>
				                                                <span class="help-block"
				                                                 ng-show="RMAForm.quantity_@{{$index}}.$error.range">
				                                                    Minimum 1 Quantity Required
				                                                </span>
				                                                <span class="help-block"
				                                                 ng-show="RMAForm.quantity_@{{$index}}.$error.pattern">
				                                                    Only Numbers Allowed
				                                                </span>
				                                            </div>
		                                                </div>
		                                            </div>
	                                    		</div>
	                                    		<div class="col-lg-6">
	                                    			<div class="row form-group">
		                                                <div class="col-md-4">
		                                                    <label for="model_no" class=" form-control-label">Model
		                                                        No</label>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <input 
		                                                    type="text" 
		                                                    id="model_no" 
		                                                    name="model_no_@{{$index}}"
		                                                    ng-model="info.model_no"
		                                                    placeholder="Model No" 
		                                                    class="form-control"
		                                                    ng-minlength="3" 
					                                        ng-maxlength="10"
					                                        required>
		                                                    <div ng-show="RMAForm.model_no_@{{$index}}.$touched && RMAForm.model_no_@{{$index}}.$error">
				                                                <span class="help-block"
				                                                 ng-show="RMAForm.model_no_@{{$index}}.$error.required">
				                                                    Please Enter Model Number
				                                                </span>
				                                                <span class="help-block"
				                                                 ng-show="RMAForm.model_no_@{{$index}}.$error.minlength">
				                                                    Minimum 3 Characters Required
				                                                </span>
				                                                <span class="help-block"
				                                                 ng-show="RMAForm.model_no_@{{$index}}.$error.maxlength">
				                                                    Maximum 10 Characters Allowed
				                                                </span>
				                                            </div>
		                                                </div>
		                                            </div>
	                                    		</div>
	                                    	</div>
	                                    	<div class="row">
	                                    		<div class="col-lg-6">
	                                    			<div class="row form-group">
	                                    				<div class="col-md-4">
		                                                    <label for="type_of_material" class=" form-control-label">Type Of Material</label>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <input 
		                                                    type="text" 
		                                                    id="type_of_material"
		                                                    name="type_of_material"
		                                                    ng-model="info.type_of_material"
		                                                    placeholder="Type of Material"
		                                                    class="form-control"
		                                                    disabled>
		                                                </div>
	                                    			</div>
	                                    		</div>
	                                    		<div class="col-lg-6">
	                                    			<div class="row form-group">
		                                    			<div class="col-md-4">
		                                                    <label for="serial_no" class=" form-control-label">Serial
		                                                        Number</label>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <input 
		                                                    type="text" 
		                                                    id="serial_no" 
		                                                    name="serial_no"
		                                                    placeholder="Serial Number" 
		                                                    class="form-control">
		                                                    <span class="help-block">Please Enter Serial Number</span>
		                                                </div>
		                                            </div>
	                                    		</div>
	                                    	</div>
	                                    	<div class="row">
	                                    		<div class="col-lg-6">
	                                    			<div class="row form-group">
		                                                <div class="col col-md-4">
		                                                    <label for="model-no" class=" form-control-label">SW
		                                                        Version</label>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <input type="text" id="model-no" name="model-no"
		                                                           placeholder="SW Version" class="form-control">
		                                                    <span class="help-block">Please Enter SW Version</span>
		                                                </div>
		                                            </div>
	                                    		</div>
	                                    		<div class="col-lg-6">
	                                    			<div class="row form-group">
	                                    				<div class="col col-md-4">
		                                                    <label for="serial-no" class=" form-control-label">Service Type
		                                                        </label>
		                                                </div>
		                                                <div class="col-md-8">
		                                                    <select name="service-type" id="service-type" class="form-control">
		                                                        <option value="0">Please select</option>
		                                                        <option value="1">Physical Relay</option>
		                                                        <option value="2">Site Card</option>
		                                                    </select>
		                                                    <span class="help-block">Please Select Service Type</span>
		                                                </div>
	                                    			</div>
	                                    		</div>
	                                    	</div>
	                                    </div>
	                                    <div class="col-lg-12 p-b-20 p-t-10">
	                                    	<div class="row">
	                                    		<div class="col-md-12">
	                                                <button class="btn btn-primary btn-md float-right" ng-click="AddUnitInformation();">
	                                                    <i class="fa fa-plus fa-lg"></i>&nbsp;
	                                                    <span id="payment-button-amount">Add</span>
	                                                </button>
	                                            </div>
	                                    	</div>
	                                    </div>
	                                    <div class="col-lg-12">
	                                        <div class="row form-group">

	                                            <!-- DATA TABLE-->
	                                            <div class="table-responsive col-lg-12">
	                                                <table class="table table-borderless table-data3">
	                                                    <thead>
	                                                    <tr>
	                                                        <th>

	                                                        </th>
	                                                        <th>
	                                                            Quantity
	                                                        </th>
	                                                        <th>
	                                                            Type of Material
	                                                        </th>
	                                                        <th>
	                                                            Model No.
	                                                        </th>
	                                                        <th>
	                                                            Serial Number
	                                                        </th>
	                                                        <th>
	                                                            Sw Version
	                                                        </th>
	                                                        <th>
	                                                            Service Type
	                                                        </th>
	                                                    </tr>
	                                                    </thead>
	                                                    <tbody>
	                                                    <tr>
	                                                        <td>
	                                                            <label class="au-checkbox">
	                                                                <input type="checkbox">
	                                                                <span class="au-checkmark"></span>
	                                                            </label>
	                                                        </td>
	                                                        <td>
	                                                            MP001
	                                                        </td>
	                                                        <td>
	                                                            1000
	                                                        </td>
	                                                        <td>
	                                                            PCB001
	                                                        </td>
	                                                        <td>
	                                                            PCB002
	                                                        </td>
	                                                        <td>
	                                                            Not Good
	                                                        </td>
	                                                        <td>
	                                                            Physical Relay
	                                                        </td>
	                                                    </tbody>
	                                                </table>
	                                            </div>
	                                            <!-- END DATA TABLE-->
	                                        </div>
	                                        <div class="row form-group">
	                                            <div class="col col-md-3">
	                                                <label for="dec-of-fault" class=" form-control-label">Description
	                                                    of
	                                                    Fault/Modification Required </label>
	                                            </div>
	                                            <div class="col-12 col-md-6">
	                                                <input type="text" id="dec-of-fault" name="dec-of-fault"
	                                                       placeholder="Description of Fault" class="form-control">
	                                                <span class="help-block">Please Enter Description Of Fault</span>
	                                            </div>
	                                        </div>
	                                        <div class="row form-group">
	                                            <div class="col col-md-3">
	                                                <label for="wbs" class=" form-control-label">WBS/Sales Order
	                                                    No</label>
	                                            </div>
	                                            <div class="col-12 col-md-6">
	                                                <input type="text" id="wbs" name="wbs"
	                                                       placeholder="WBS/Sales Order No" class="form-control">
	                                                <span class="help-block">Please Enter WBS/Sales Order No</span>
	                                            </div>
	                                        </div>
	                                        <div class="row form-group">
	                                            <div class="col col-md-3">
	                                                <label for="field-volts-used" class=" form-control-label">Are
	                                                    field
	                                                    Volts used(Y/N)?</label>
	                                            </div>
	                                            <div class="col-12 col-md-6">
	                                                <select name="field-volts-used" id="field-volts-used"
	                                                        class="form-control">
	                                                    <option value="0">Please select</option>
	                                                    <option value="1">Yes</option>
	                                                    <option value="2">No</option>
	                                                </select>
	                                                <span class="help-block">Please Select Volts Used</span>
	                                            </div>
	                                        </div>
	                                        <div class="row form-group">
	                                            <div class="col col-md-3">
	                                                <label for="warrenty"
	                                                       class=" form-control-label">Warranty </label>
	                                            </div>
	                                            <div class="col-12 col-md-6">
	                                                <input type="text" id="warrenty" name="warrenty"
	                                                       placeholder="Warranty" class="form-control">
	                                                <span class="help-block">Please Enter Warranty</span>
	                                            </div>
	                                        </div>
	                                        <div class="row form-group">
	                                            <div class="col col-md-4">
	                                                <label class=" form-control-label">Equipment failed during
	                                                    installation/commissioning</label>
	                                            </div>
	                                            <div class="col col-md-6">
	                                                <div class="form-check">
	                                                    <div class="radio">
	                                                        <label for="equip-failed-installation1"
	                                                               class="form-check-label ">
	                                                            <input type="radio" id="equip-failed-installation1"
	                                                                   name="equip-failed-installation"
	                                                                   value="option1"
	                                                                   class="form-check-input">Yes
	                                                        </label>
	                                                    </div>
	                                                    <div class="radio">
	                                                        <label for="equip-failed-installation2"
	                                                               class="form-check-label ">
	                                                            <input type="radio" id="equip-failed-installation2"
	                                                                   name="equip-failed-installation"
	                                                                   value="option2"
	                                                                   class="form-check-input">No
	                                                        </label>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="row form-group">
	                                            <div class="col col-md-4">
	                                                <label class=" form-control-label">Equipment failed during
	                                                    service </label>
	                                            </div>
	                                            <div class="col col-md-6">
	                                                <div class="form-check">
	                                                    <div class="radio">
	                                                        <label for="equip-failed-service1"
	                                                               class="form-check-label ">
	                                                            <input type="radio" id="equip-failed-service1"
	                                                                   name="equip-failed-service" value="option1"
	                                                                   class="form-check-input">Yes
	                                                        </label>
	                                                    </div>
	                                                    <div class="radio">
	                                                        <label for="equip-failed-service2"
	                                                               class="form-check-label ">
	                                                            <input type="radio" id="equip-failed-service2"
	                                                                   name="equip-failed-service" value="option2"
	                                                                   class="form-check-input">No
	                                                        </label>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="row form-group">
	                                            <div class="col col-md-3">
	                                                <label for="how-long" class=" form-control-label">How
	                                                    Long</label>
	                                            </div>
	                                            <div class="col-12 col-md-6">
	                                                <input type="text" id="how-long" name="how-long"
	                                                       placeholder="How Long" class="form-control">
	                                                <span class="help-block">Please Enter How Long</span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-lg-6">
	                            <div class="card">
	                                <div class="card-header">
	                                    <strong>SPECIALIST REPAIR INSTRUCTIONS</strong>
	                                </div>
	                                <div class="card-body card-block">
	                                <div class="row form-group">
	                                    <div class="col col-md-4">
	                                        <label class=" form-control-label">Do you want an updated firmware
	                                            version after repair </label>
	                                    </div>
	                                    <div class="col col-md-6">
	                                        <div class="form-check">
	                                            <div class="radio">
	                                                <label for="update-version1" class="form-check-label ">
	                                                    <input type="radio" id="update-version1"
	                                                           name="update-version" value="option1"
	                                                           class="form-check-input">Yes
	                                                </label>
	                                            </div>
	                                            <div class="radio">
	                                                <label for="update-version2" class="form-check-label ">
	                                                    <input type="radio" id="update-version2"
	                                                           name="update-version" value="option2"
	                                                           class="form-check-input">No
	                                                </label>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row form-group">
	                                    <div class="col col-md-4">
	                                        <label class=" form-control-label">Is the relay being returned in a
	                                            case </label>
	                                    </div>
	                                    <div class="col col-md-6">
	                                        <div class="form-check">
	                                            <div class="radio">
	                                                <label for="return-in-case1" class="form-check-label ">
	                                                    <input type="radio" id="return-in-case1"
	                                                           name="return-in-case" value="option1"
	                                                           class="form-check-input">Yes
	                                                </label>
	                                            </div>
	                                            <div class="radio">
	                                                <label for="return-in-case2" class="form-check-label ">
	                                                    <input type="radio" id="return-in-case2"
	                                                           name="return-in-case" value="option2"
	                                                           class="form-check-input">No
	                                                </label>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row form-group">
	                                    <div class="col col-md-4">
	                                        <label for="service-type" class=" form-control-label">Service
	                                            Type</label>
	                                    </div>
	                                    <div class="col-12 col-md-6">
	                                        <select name="service-type" id="service-type" class="form-control">
	                                            <option value="0">Please select</option>
	                                            <option value="1">Physical Relay</option>
	                                            <option value="2">Site Card</option>
	                                        </select>
	                                        <span class="help-block">Please Select Service Type</span>
	                                    </div>
	                                </div>
	                            </div>
	                            </div>
	                        </div>
	                        <div class=" col-lg-6">
	                            <div class="card">
	                                <div class="card-header">
	                                    <strong>CUSTOMER & INVOICING INFORMATION</strong>
	                                </div>
	                                <div class="card-body card-block">
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="customer-name" class=" form-control-label">Customer Name
	                                                <span class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="customer-name" name="customer-name"
	                                                   placeholder="Customer Name" class="form-control">
	                                            <span class="help-block">Please Enter Customer Name</span>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-lg-6">
	                            <div class="card">
	                                <div class="card-header">
	                                    <strong>Customer Invoice Address</strong>
	                                </div>
	                                <div class="card-body card-block">
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="customer-invoice-address" class=" form-control-label">Customer
	                                                Invoice Address <span class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="customer-invoice-address"
	                                                   name="customer-invoice-address"
	                                                   placeholder="Customer Invoice Address" class="form-control">
	                                            <span class="help-block">Please Enter Customer Invoice Address</span>
	                                        </div>
	                                    </div>
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="invoice-contact-name" class=" form-control-label">Contact
	                                                Name <span class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="invoice-contact-name"
	                                                   name="invoice-contact-name" placeholder="Contact Name"
	                                                   class="form-control">
	                                            <span class="help-block">Please Enter Contact Name</span>
	                                        </div>
	                                    </div>
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="invoice-tel-no" class=" form-control-label">Tel No <span
	                                                        class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="invoice-tel-no" name="invoice-tel-no"
	                                                   placeholder="Tel No" class="form-control">
	                                            <span class="help-block">Please Enter Tel No</span>
	                                        </div>
	                                    </div>
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="invoice-email" class=" form-control-label">Email <span
	                                                        class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="invoice-email" name="invoice-email"
	                                                   placeholder="Email" class="form-control">
	                                            <span class="help-block">Please Enter Email</span>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-6">
	                            <div class="card">
	                                <div class="card-header">
	                                    <strong>Customer Return Delivery Address</strong>
	                                </div>
	                                <div class="card-body card-block">
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="customer-delivery-address" class=" form-control-label">Customer
	                                                Delivery Address <span class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="customer-delivery-address"
	                                                   name="customer-delivery-address"
	                                                   placeholder="Customer Delivery Address" class="form-control">
	                                            <span class="help-block">Please Enter Customer Delivery Address</span>
	                                        </div>
	                                    </div>
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="delivery-contact-name" class=" form-control-label">Contact
	                                                Name <span class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="delivery-contact-name"
	                                                   name="delivery-contact-name" placeholder="Contact Name"
	                                                   class="form-control">
	                                            <span class="help-block">Please Enter Contact Name</span>
	                                        </div>
	                                    </div>
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="delivery-tel-no" class=" form-control-label">Tel No
	                                                <span class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="delivery-tel-no" name="delivery-tel-no"
	                                                   placeholder="Tel No" class="form-control">
	                                            <span class="help-block">Please Enter Tel No</span>
	                                        </div>
	                                    </div>
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="delivery-email" class=" form-control-label">Email <span
	                                                        class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="delivery-email" name="delivery-email"
	                                                   placeholder="Email" class="form-control">
	                                            <span class="help-block">Please Enter Email</span>
	                                        </div>
	                                    </div>
	                                    <div class="row form-group">
	                                        <div class="col col-md-3">
	                                            <label for="gst-number" class=" form-control-label">GST Number <span
	                                                        class="mandatory">*</span></label>
	                                        </div>
	                                        <div class="col-12 col-md-9">
	                                            <input type="text" id="gst-number" name="gst-number"
	                                                   placeholder="GST Number" class="form-control">
	                                            <span class="help-block">Please Enter GST Number</span>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <div class="card">
	                                <div class="card-footer">
	                                    <button type="submit" class="btn btn-primary btn-sm">
	                                        <i class="fa fa-dot-circle-o"></i> Submit
	                                    </button>
	                                    <button type="reset" class="btn btn-danger btn-sm">
	                                        <i class="fa fa-ban"></i> Reset
	                                    </button>
	                                    <button type="reset" class="btn btn-secondary btn-sm" ng-click="HideRMAForm();">
				                            <i class="fa fa-ban"></i> Close
				                        </button>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                </form>
            </div>
	    </div>
	</div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/RMAController.js')}}"></script>
	<script>
        $( document ).ready(function() {
            $( "#date" ).datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });
        });
    </script>
@endsection