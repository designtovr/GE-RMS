@extends('layouts.app')
@section('title', 'RMA Linkage')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="card">
                    <div class="card-header">
                        <strong>RMA Linkage</strong> Form
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
                                    <label for="customer" class=" form-control-label">Customer <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="customer" name="customer" placeholder="Customer" class="form-control">
                                    <span class="help-block">Please Enter Customer</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="rma-no" class=" form-control-label">RMA No <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="rma-no" name="rma-no" placeholder="RMA No" class="form-control">
                                    <span class="help-block">Please Enter RMA No</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="remark" class=" form-control-label">Remark <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" id="remark" name="remark" placeholder="Remark" class="form-control">
                                    <span class="help-block">Please Enter Remark</span>
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