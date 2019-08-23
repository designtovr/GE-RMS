@extends('layouts.app')
@section('title', 'ADD RMS')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12">
    			<div class="card">
    				<div class="card-header">
                        <strong>Relay Movement Scanning</strong> Form
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
                                    <label for="rack" class=" form-control-label">Rack <span class="mandatory">*</span></label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select name="rack" id="rack" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <span class="help-block">Please Select Rack</span>
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