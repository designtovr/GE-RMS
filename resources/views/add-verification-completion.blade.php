@extends('layouts.app')
@section('title', 'Add Verification Completion')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="card">
    				<div class="card-header">
                        <strong>Verification Completion</strong> Form
                    </div>
                    <div class="card-body card-block">
                    	<form action="" method="post" class="form-horizontal">
                    		<div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="relay-mo-no" class=" form-control-label">Relay Model No & Serial No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="relay-mo-no" name="relay-mo-no" placeholder="Relay Model No & Serial No" class="form-control">
                                    <span class="help-block">Please Enter Relay Model No & Serial No</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="initial-firmware" class=" form-control-label">Initial Firmware <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="initial-firmware" name="initial-firmware" placeholder="Initial Firmware" class="form-control">
                                    <span class="help-block">Please Enter Initial Firmware</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="updated-firmware" class=" form-control-label">Updated Firmware <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="updated-firmware" name="updated-firmware" placeholder="Updated Firmware" class="form-control">
                                    <span class="help-block">Please Enter Updated Firmware</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="date" class=" form-control-label">Date<span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="date" name="date" placeholder="Date" class="form-control">
                                    <span class="help-block">Please Select Date</span>
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