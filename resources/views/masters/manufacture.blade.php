@extends('layouts.app')
@section('title', 'Manufacture')
@section('content')
<div class="section__content section__content--p30" ng-controller="MastersController">
    <div class="container-fluid" ng-init="manufactures();">
    	<div class="row">
			<div class="col-md-12">
		        <div class="overview-wrap">
		            <h6 class="pb-4 display-5">Manufacture</h6>
		            <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>&nbsp; Add Manufacture</button>
		        </div>
		    </div>
		    <!-- <div class="col-md-12">
		    	<div class="table-responsive">
                    <table class="table table-borderless table-data3 table-custom">
                    	<thead>
                            <tr>
                                <th>
	                                <input type="text" id="se-from-date" name="se-from-date" placeholder="From Date" class="form-control-sm form-control">
                            	</th>
                                <th>
                                	<input type="text" id="se-to-date" name="se-to-date" placeholder="To Date" class="form-control-sm form-control">
                                </th>
                                <th>
                                	<select name="field-volts-used" id="field-volts-used" class="form-control-sm form-control">
                                        <option value="0">From</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                        <option value="2">Customer</option>
                                    </select>
                                </th>
                                <th>
                                	<select name="field-volts-used" id="field-volts-used" class="form-control-sm form-control">
                                        <option value="0">To</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                        <option value="2">Customer</option>
                                    </select>
                                </th>
                                <th>
                                	<input type="text" id="se-cus" name="se-cus" placeholder="Customer" class="form-control-sm form-control">
                                </th>
                                <th>
                                	<button type="button" class="btn btn-outline-secondary btn-sm">Reset</button>
                                </th>
                                <th>
                                	<button type="button" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-search"></i>&nbsp; Search</button>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
		    </div> -->
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="manufacture in manufactures">
	                            <td></td>
	                            <td></td>
                                <td>
	                                <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
	                                        <i class="zmdi zmdi-more"></i>
	                                    </button>
	                                </div>
	                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE-->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/MastersController.js')}}"></script>
@endsection