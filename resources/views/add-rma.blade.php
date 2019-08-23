@extends('layouts.app')
@section('title', 'RMA')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>RMA</strong> Form
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" class="form-horizontal">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="rma-ref-no" class=" form-control-label">RMA Reference No</label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="rma-ref-no" name="rma-ref-no" placeholder="RMA Reference No..." class="form-control">
                                    <span class="help-block">Please Enter RMA Reference No</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="ga-no" class=" form-control-label">GA No.</label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="ga-no" name="ga-no" placeholder="GA No..." class="form-control">
                                    <span class="help-block">Please Enter GA number</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="act-reference" class=" form-control-label">ACT Reference</label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="act-reference" name="act-reference" placeholder="ACT Reference" class="form-control">
                                    <span class="help-block">Please Select ACT Reference</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="date" class=" form-control-label">Date</label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="date" name="date" placeholder="Date" class="form-control">
                                    <span class="help-block">Please Select Date</span>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-lg-6">
                            		<div class="card">
	                            		<div class="card-header">
	                                        <strong>IDENTIFICATION OF UNIT & FAULT INFORMATION</strong>
	                                    </div>
                                	</div>
                                	<div class="card-body card-block">
	                            		<div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="quantity" class=" form-control-label">Quantity</label>
			                                </div>
			                                <div class="col-12 col-md-6">
			                                    <input type="text" id="quantity" name="quantity" placeholder="Quantity" class="form-control">
			                                    <span class="help-block">Please Enter Quantity</span>
			                                </div>
			                            </div>
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="type-of-material" class=" form-control-label">Type of Material</label>
			                                </div>
			                                <div class="col-12 col-md-6">
			                                    <input type="text" id="type-of-material" name="type-of-material" placeholder="Type of Material" class="form-control">
			                                    <span class="help-block">Please Enter Type of Material</span>
			                                </div>
			                            </div>
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="model-no" class=" form-control-label">Model No</label>
			                                </div>
			                                <div class="col-12 col-md-6">
			                                    <input type="text" id="model-no" name="model-no" placeholder="Model No" class="form-control">
			                                    <span class="help-block">Please Enter Model No</span>
			                                </div>
			                            </div>
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="model-no" class=" form-control-label">SW Version</label>
			                                </div>
			                                <div class="col-12 col-md-6">
			                                    <input type="text" id="model-no" name="model-no" placeholder="SW Version" class="form-control">
			                                    <span class="help-block">Please Enter SW Version</span>
			                                </div>
			                            </div>
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="dec-of-fault" class=" form-control-label">Description of Fault/Modification Required </label>
			                                </div>
			                                <div class="col-12 col-md-6">
			                                    <input type="text" id="dec-of-fault" name="dec-of-fault" placeholder="Description of Fault" class="form-control">
			                                    <span class="help-block">Please Enter Description Of Fault</span>
			                                </div>
			                            </div>
			                            <div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="wbs" class=" form-control-label">WBS/Sales Order No</label>
			                                </div>
			                                <div class="col-12 col-md-6">
			                                    <input type="text" id="wbs" name="wbs" placeholder="WBS/Sales Order No" class="form-control">
			                                    <span class="help-block">Please Enter WBS/Sales Order No</span>
			                                </div>
			                            </div>
			                            <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="field-volts-used" class=" form-control-label">Are field Volts used(Y/N)?</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="field-volts-used" id="field-volts-used" class="form-control">
                                                    <option value="0">Please select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                                <span class="help-block">Please Select Volts Used</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="warrenty" class=" form-control-label">Warranty </label>
			                                </div>
			                                <div class="col-12 col-md-6">
			                                    <input type="text" id="warrenty" name="warrenty" placeholder="Warranty" class="form-control">
			                                    <span class="help-block">Please Enter Warranty</span>
			                                </div>
			                            </div>
			                            <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label class=" form-control-label">Equipment failed during installation/commissioning</label>
                                            </div>
                                            <div class="col col-md-6">
                                                <div class="form-check">
                                                    <div class="radio">
                                                        <label for="equip-failed-installation1" class="form-check-label ">
                                                            <input type="radio" id="equip-failed-installation1" name="equip-failed-installation" value="option1" class="form-check-input">Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="equip-failed-installation2" class="form-check-label ">
                                                            <input type="radio" id="equip-failed-installation2" name="equip-failed-installation" value="option2" class="form-check-input">No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label class=" form-control-label">Equipment failed during service </label>
                                            </div>
                                            <div class="col col-md-6">
                                                <div class="form-check">
                                                    <div class="radio">
                                                        <label for="equip-failed-service1" class="form-check-label ">
                                                            <input type="radio" id="equip-failed-service1" name="equip-failed-service" value="option1" class="form-check-input">Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="equip-failed-service2" class="form-check-label ">
                                                            <input type="radio" id="equip-failed-service2" name="equip-failed-service" value="option2" class="form-check-input">No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
			                                <div class="col col-md-3">
			                                    <label for="how-long" class=" form-control-label">How Long</label>
			                                </div>
			                                <div class="col-12 col-md-6">
			                                    <input type="text" id="how-long" name="how-long" placeholder="How Long" class="form-control">
			                                    <span class="help-block">Please Enter How Long</span>
			                                </div>
			                            </div>
                                	</div>
                            	</div>
                            	<div class="col-lg-6">
                            		<div class="card">
	                            		<div class="card-header">
	                                        <strong>SPECIALIST REPAIR INSTRUCTIONS</strong>
	                                    </div>
                                	</div>
                                	<div class="card-body card-block">
	                            		<div class="row form-group">
                                            <div class="col col-md-4">
                                                <label class=" form-control-label">Do you want an updated firmware version after repair  </label>
                                            </div>
                                            <div class="col col-md-6">
                                                <div class="form-check">
                                                    <div class="radio">
                                                        <label for="update-version1" class="form-check-label ">
                                                            <input type="radio" id="update-version1" name="update-version" value="option1" class="form-check-input">Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="update-version2" class="form-check-label ">
                                                            <input type="radio" id="update-version2" name="update-version" value="option2" class="form-check-input">No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label class=" form-control-label">Is the relay being returned in a case  </label>
                                            </div>
                                            <div class="col col-md-6">
                                                <div class="form-check">
                                                    <div class="radio">
                                                        <label for="return-in-case1" class="form-check-label ">
                                                            <input type="radio" id="return-in-case1" name="return-in-case" value="option1" class="form-check-input">Yes
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="return-in-case2" class="form-check-label ">
                                                            <input type="radio" id="return-in-case2" name="return-in-case" value="option2" class="form-check-input">No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="service-type" class=" form-control-label">Service Type</label>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>CUSTOMER & INVOICING INFORMATION</strong>
                                        </div>
                                        <div class="card-body card-block">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="customer-name" class=" form-control-label">Customer Name <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="customer-name" name="customer-name" placeholder="Customer Name" class="form-control">
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
                                                    <label for="customer-invoice-address" class=" form-control-label">Customer Invoice Address <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="customer-invoice-address" name="customer-invoice-address" placeholder="Customer Invoice Address" class="form-control">
                                                    <span class="help-block">Please Enter Customer Invoice Address</span>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="invoice-contact-name" class=" form-control-label">Contact Name <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="invoice-contact-name" name="invoice-contact-name" placeholder="Contact Name" class="form-control">
                                                    <span class="help-block">Please Enter Contact Name</span>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="invoice-tel-no" class=" form-control-label">Tel No <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="invoice-tel-no" name="invoice-tel-no" placeholder="Tel No" class="form-control">
                                                    <span class="help-block">Please Enter Tel No</span>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="invoice-email" class=" form-control-label">Email <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="invoice-email" name="invoice-email" placeholder="Email" class="form-control">
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
                                                    <label for="customer-delivery-address" class=" form-control-label">Customer Delivery Address <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="customer-delivery-address" name="customer-delivery-address" placeholder="Customer Delivery Address" class="form-control">
                                                    <span class="help-block">Please Enter Customer Delivery Address</span>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="delivery-contact-name" class=" form-control-label">Contact Name <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="delivery-contact-name" name="delivery-contact-name" placeholder="Contact Name" class="form-control">
                                                    <span class="help-block">Please Enter Contact Name</span>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="delivery-tel-no" class=" form-control-label">Tel No <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="delivery-tel-no" name="delivery-tel-no" placeholder="Tel No" class="form-control">
                                                    <span class="help-block">Please Enter Tel No</span>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="delivery-email" class=" form-control-label">Email <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="delivery-email" name="delivery-email" placeholder="Email" class="form-control">
                                                    <span class="help-block">Please Enter Email</span>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="gst-number" class=" form-control-label">GST Number <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="gst-number" name="gst-number" placeholder="GST Number" class="form-control">
                                                    <span class="help-block">Please Enter GST Number</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
    	</div>
    </div>
</div>
@endsection