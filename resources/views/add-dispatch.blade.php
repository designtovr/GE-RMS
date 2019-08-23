@extends('layouts.app')
@section('title', 'Dispatch')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="card">
    				<div class="card-header">
                        <strong>Dispatch</strong> Form
                    </div>
                    <div class="card-body card-block">
	                	<form action="" method="post" class="form-horizontal">
	                		<div class="row form-group">
	                            <div class="col col-md-3">
	                                <label for="dispatch-no" class=" form-control-label">Dispatch No <span class="mandatory">*</span></label>
	                            </div>
	                            <div class="col-12 col-md-6">
	                                <input type="text" id="dispatch-no" name="dispatch-no" placeholder="Dispatch No" class="form-control">
	                                <span class="help-block">Please Enter Dispatch No</span>
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
                                    <label for="dc-no" class=" form-control-label">DC No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="dc-no" name="dc-no" placeholder="DC No" class="form-control">
                                    <span class="help-block">Please Enter DC No</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="docket-details" class=" form-control-label">Docket Details <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="docket-details" name="docket-details" placeholder="Docket Details" class="form-control">
                                    <span class="help-block">Please Enter Docket Details</span>
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
                                    <label for="courier-name" class=" form-control-label">Courier Name <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="courier-name" name="courier-name" placeholder="Courier Name" class="form-control">
                                    <span class="help-block">Please Enter Courier Name </span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="person-name" class=" form-control-label">Person  Name <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="person-name" name="person-name" placeholder="Person Name" class="form-control">
                                    <span class="help-block">Please Enter Person Name </span>
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