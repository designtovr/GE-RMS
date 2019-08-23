@extends('layouts.app')
@section('title', 'Add Job Ticket')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="card">
    				<div class="card-header">
                        <strong>Job Ticket</strong> Form
                    </div>
                    <div class="card-body card-block">
                    	<form action="" method="post" class="form-horizontal">
                    		<div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="job-id" class=" form-control-label">Job ID <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="job-id" name="job-id" placeholder="Job ID" class="form-control">
                                    <span class="help-block">Please Enter Job ID</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="rma-no" class=" form-control-label">RMA NO <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="rma-no" name="rma-no" placeholder="RMA NO" class="form-control">
                                    <span class="help-block">Please Enter RMA NO</span>
                                </div>
                            </div>
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
                                    <label for="given-date" class=" form-control-label">Given Date<span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="given-date" name="given-date" placeholder="Given Date" class="form-control">
                                    <span class="help-block">Please Select Given Date</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="taken-date" class=" form-control-label">Taken Date<span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="taken-date" name="taken-date" placeholder="Taken Date" class="form-control">
                                    <span class="help-block">Please Select Taken Date</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="nature-of-defect" class=" form-control-label">Nature Of Defect <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="nature-of-defect" name="nature-of-defect" placeholder="Nature Of Defect" class="form-control">
                                    <span class="help-block">Please Enter Nature Of Defect</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="crc-comment" class=" form-control-label">CRC Comment <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="crc-comment" name="crc-comment" placeholder="CRC Comment" class="form-control">
                                    <span class="help-block">Please Enter CRC Comment</span>
                                </div>
                            </div>
                    	</form>
                    </div>
                    <div class="card-header">
                        <strong>Material</strong>
                    </div>
                    <div class="card-body card-block">
                    	<form action="" method="post" class="form-horizontal">
                    		<div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="material" class=" form-control-label">Material <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="material" name="material" placeholder="Material" class="form-control">
                                    <span class="help-block">Please Enter Material</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="material-type" class=" form-control-label">Material Type <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="material-type" name="material-type" placeholder="Material Type" class="form-control">
                                    <span class="help-block">Please Enter Material Type</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="material-part-no" class=" form-control-label">Material Part No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="material-part-no" name="material-part-no" placeholder="Material Part No" class="form-control">
                                    <span class="help-block">Please Enter Material Part No</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="quantity" class=" form-control-label">Quantity <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="quantity" name="quantity" placeholder="Quantity" class="form-control">
                                    <span class="help-block">Please Enter Quantity</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="value" class=" form-control-label">Value <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="value" name="value" placeholder="Value" class="form-control">
                                    <span class="help-block">Please Enter Value</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="old-pcp" class=" form-control-label">Old PCP <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="old-pcp" name="old-pcp" placeholder="Old PCP" class="form-control">
                                    <span class="help-block">Please Enter Old PCP</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="new-pcp" class=" form-control-label">New PCP <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="new-pcp" name="new-pcp" placeholder="New PCP" class="form-control">
                                    <span class="help-block">Please Enter New PCP</span>
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