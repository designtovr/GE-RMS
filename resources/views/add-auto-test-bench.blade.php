@extends('layouts.app')
@section('title', 'Auto Test Bench')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="card">
    				<div class="card-header">
                        <strong>Auto Test Bench</strong> Form
                    </div>
                    <div class="card-body card-block">
                    	<form action="" method="post" class="form-horizontal">
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
                                    <label for="date" class=" form-control-label">Date <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="date" name="date" placeholder="Date" class="form-control">
                                    <span class="help-block">Please Select Date</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="rma" class=" form-control-label">RMA No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="rma" name="rma" placeholder="RMA" class="form-control">
                                    <span class="help-block">Please Enter RMA No </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="existing-firmware" class=" form-control-label">Existing Firmware <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="existing-firmware" name="existing-firmware" placeholder="Existing Firmware" class="form-control">
                                    <span class="help-block">Please Enter Existing Firmwar </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="updated-firmware" class=" form-control-label">Updated  Firmware <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="updated-firmware" name="updated-firmware" placeholder="Updated Firmware" class="form-control">
                                    <span class="help-block">Please Enter Updated Firmwar </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">Pass/Fail <span class="mandatory">*</span></label>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-check-inline form-check">
                                        <div class="radio">
                                            <label for="pass-fail1" class="form-check-label ">
                                                <input type="radio" id="pass-fail1" name="pass-fail" value="option1" class="form-check-input">Yes
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="pass-fail2" class="form-check-label ">
                                                <input type="radio" id="pass-fail2" name="pass-fail" value="option2" class="form-check-input">No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="comment" class=" form-control-label">Comment <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="comment" name="comment" placeholder="Comment" class="form-control">
                                    <span class="help-block">Please Enter Comment </span>
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