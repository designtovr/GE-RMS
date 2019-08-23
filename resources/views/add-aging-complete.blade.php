@extends('layouts.app')
@section('title', 'Aging Complete')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="card">
    				<div class="card-header">
                        <strong>Aging Complete</strong> Form
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
                                    <label for="date-time" class=" form-control-label">Date & Time <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="date-time" name="date-time" placeholder="Date" class="form-control">
                                    <span class="help-block">Please Select Date & Time</span>
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