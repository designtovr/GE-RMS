@extends('layouts.app')
@section('title', 'Add Physical Verification')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="card">
    				<div class="card-header">
                        <strong>Physical Verification</strong> Form
                    </div>
                    <div class="card-body card-block">
	                	<form action="" method="post" class="form-horizontal">
	                		<div class="row form-group">
	                            <div class="col col-md-3">
	                                <label for="receipt-no" class=" form-control-label">Receipt No <span class="mandatory">*</span></label>
	                            </div>
	                            <div class="col-12 col-md-6">
	                                <input type="text" id="receipt-no" name="receipt-no" placeholder="Receipt No" class="form-control">
	                                <span class="help-block">Please Enter Receipt No</span>
	                            </div>
	                        </div>
	                        <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="rid" class=" form-control-label">RID No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="rid" name="rid" placeholder="RID No" class="form-control">
                                    <span class="help-block">Please Enter RID No</span>
                                </div>
                            </div>
	                        <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="date" class=" form-control-label">Physical Verified Date <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="date" name="date" placeholder="Physical Verified Date" class="form-control">
                                    <span class="help-block">Please Enter Physical Verified Date</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="product" class=" form-control-label">Product <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="product" name="product" placeholder="Product" class="form-control">
                                    <span class="help-block">Please Enter Product</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="product-type" class=" form-control-label">Product Type <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="product-type" name="product-type" placeholder="Product Type" class="form-control">
                                    <span class="help-block">Please Enter Product Type</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="defect" class=" form-control-label">Defect Mentioned by Customer <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="defect" name="defect" placeholder="Defect Mentioned by Customer" class="form-control">
                                    <span class="help-block">Please Enter Defect Mentioned by Customer</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="serial-no" class=" form-control-label">Serial No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="serial-no" name="serial-no" placeholder="Serial No" class="form-control">
                                    <span class="help-block">Please Enter Serial No</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="model-no" class=" form-control-label">Model No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="model-no" name="model-no" placeholder="Model No" class="form-control">
                                    <span class="help-block">Please Enter Model No</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">Relay Received With Case <span class="mandatory">*</span></label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="form-check-inline form-check">
                                        <label for="case1" class="form-check-label ">
                                            <input type="radio" id="case1" name="case" value="option1" class="form-check-input">Yes
                                        </label>
                                        <label for="case2" class="form-check-label ">
                                            <input type="radio" id="case2" name="case" value="option2" class="form-check-input">No
                                        </label>
                                        <label for="case3" class="form-check-label ">
                                            <input type="radio" id="case3" name="case" value="option3" class="form-check-input">Not Applicable
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="case-condition" class=" form-control-label">Case Condition <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select name="case-condition" id="case-condition" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Damaged</option>
                                        <option value="2">Undamaged</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">Relay Received With Battery <span class="mandatory">*</span></label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="form-check-inline form-check">
                                        <label for="battery1" class="form-check-label ">
                                            <input type="radio" id="battery1" name="battery" value="option1" class="form-check-input">Yes
                                        </label>
                                        <label for="case2" class="form-check-label ">
                                            <input type="radio" id="battery2" name="battery" value="option2" class="form-check-input">No
                                        </label>
                                        <label for="case3" class="form-check-label ">
                                            <input type="radio" id="battery3" name="battery" value="option3" class="form-check-input">Not Applicable
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="case-condition" class=" form-control-label">Battery Condition <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select name="battery-condition" id="battery-condition" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Damaged</option>
                                        <option value="2">Undamaged</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">Relay Received With Terminal Blocks <span class="mandatory">*</span></label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="form-check-inline form-check">
                                        <label for="terminal-blocks1" class="form-check-label ">
                                            <input type="radio" id="terminal-blocks1" name="terminal-blocks" value="option1" class="form-check-input">Yes
                                        </label>
                                        <label for="terminal-blocks2" class="form-check-label ">
                                            <input type="radio" id="terminal-blocks2" name="terminal-blocks" value="option2" class="form-check-input">No
                                        </label>
                                        <label for="terminal-blocks3" class="form-check-label ">
                                            <input type="radio" id="terminal-blocks3" name="terminal-blocks" value="option3" class="form-check-input">Not Applicable
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="terminal-blocks-condition" class=" form-control-label">Terminal Blocks Condition <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select name="terminal-blocks-condition" id="battery-condition" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Damaged</option>
                                        <option value="2">Undamaged</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">Relay Received With Top or Bottom Access Cover <span class="mandatory">*</span></label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="form-check-inline form-check">
                                        <label for="top-bottom-cover1" class="form-check-label ">
                                            <input type="radio" id="top-bottom-cover1" name="top-bottom-cover" value="option1" class="form-check-input">Yes
                                        </label>
                                        <label for="top-bottom-cover2" class="form-check-label ">
                                            <input type="radio" id="top-bottom-cover2" name="top-bottom-cover" value="option2" class="form-check-input">No
                                        </label>
                                        <label for="top-bottom-cover3" class="form-check-label ">
                                            <input type="radio" id="top-bottom-cover3" name="top-bottom-cover" value="option3" class="form-check-input">Not Applicable
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="top-bottom-cover-condition" class=" form-control-label">Top or Bottom Access Cover Condition <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select name="top-bottom-cover-condition" id="top-bottom-cover" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Damaged</option>
                                        <option value="2">Undamaged</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="sales-order-no" class=" form-control-label">Sale Order/WBS No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="sales-order-no" name="sales-order-no" placeholder="Sale Order/WBS No" class="form-control">
                                    <span class="help-block">Please Enter Model No</span>
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