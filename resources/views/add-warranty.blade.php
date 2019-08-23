@extends('layouts.app')
@section('title', 'Add Warranty Declaration')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="card">
                    <div class="card-header">
                        <strong>Warranty/Chargeable Declaration</strong> Form
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" class="form-horizontal">
                        	<div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="rid" class=" form-control-label">RID <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="rid" name="rid" placeholder="RID" class="form-control">
                                    <span class="help-block">Please Enter RID</span>
                                </div>
                            </div>
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
                                    <label for="ga-no" class=" form-control-label">GA No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="ga-no" name="ga-no" placeholder="GA No" class="form-control">
                                    <span class="help-block">Please Enter GA No</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="customer" class=" form-control-label">Customer <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="customer" name="customer" placeholder="Customer" class="form-control">
                                    <span class="help-block">Please Enter Customer</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="po-date" class=" form-control-label">PO Date <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="po-date" name="po-date" placeholder="PO Date" class="form-control">
                                    <span class="help-block">Please Select PO Date</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">SMP <span class="mandatory">*</span></label>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-check-inline form-check">
                                        <div class="radio">
                                            <label for="smp1" class="form-check-label ">
                                                <input type="radio" id="smp1" name="smp" value="option1" class="form-check-input">Chargeable
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="smp2" class="form-check-label ">
                                                <input type="radio" id="smp2" name="smp" value="option2" class="form-check-input">Warranty
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">PCP <span class="mandatory">*</span></label>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-check-inline form-check">
                                        <div class="radio">
                                            <label for="pcp1" class="form-check-label ">
                                                <input type="radio" id="pcp1" name="pcp" value="option1" class="form-check-input">Chargeable
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="pcp2" class="form-check-label ">
                                                <input type="radio" id="pcp2" name="pcp" value="option2" class="form-check-input">Warranty
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="type" class=" form-control-label">Type <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select name="type" id="type" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Repair</option>
                                        <option value="2">Modification</option>
                                        <option value="3">Investigation</option>
                                    </select>
                                    <span class="help-block">Please Select Type</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="repair-rack" class=" form-control-label">Repair Rack <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select name="repair-rack" id="repair-rack" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <span class="help-block">Please Select Repair Rack</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="cu-hold-rack" class=" form-control-label">Customer Hold Rack <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select name="cu-hold-rack" id="cu-hold-rack" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <span class="help-block">Please Select Repair Rack</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="comment" class=" form-control-label">Comment <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="comment" name="comment" placeholder="Comment" class="form-control">
                                    <span class="help-block">Please Enter Customer</span>
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