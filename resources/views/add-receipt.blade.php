@extends('layouts.app')
@section('title', 'Add Receipt')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
        	<div class="row">
        		<div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Receipt</strong> Form
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="rf-no" class=" form-control-label">Receipt No. <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="rf-no" name="rf-no" placeholder="Receipt No..." class="form-control">
                                        <span class="help-block">Please enter receipt number</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="ga-no" class=" form-control-label">GA No. <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="ga-no" name="ga-no" placeholder="GA No..." class="form-control">
                                        <span class="help-block">Please enter GA number</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="re-date" class=" form-control-label">Receipt Date <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="re-date" name="re-date" placeholder="Receipt Date" class="form-control">
                                        <span class="help-block">Please select receipt date</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="cu-name" class=" form-control-label">Customer Name/Manufacture Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="cu-name" name="cu-name" placeholder="Customer Name/Manufacture Name" class="form-control">
                                        <span class="help-block">Please enter customer name/manufacture name</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="end-cusname" class=" form-control-label">End Customer <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="end-cusname" name="end-cusname" placeholder="End Customer" class="form-control">
                                        <span class="help-block">Please enter end customer</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="courier-name" class=" form-control-label">Courier Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="courier-name" name="courier-name" placeholder="Courier Name" class="form-control">
                                        <span class="help-block">Please enter courier name</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="courier-name" class=" form-control-label">Docket Details <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="docket-details" name="docket-details" placeholder="Courier Name" class="form-control">
                                        <span class="help-block">Please enter docket details</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="no-of-boxes" class=" form-control-label">No Of Boxes <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="docket-details" name="docket-details" placeholder="No Of Boxes" class="form-control">
                                        <span class="help-block">Please enter no of boxes</span>
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
</div>
@endsection