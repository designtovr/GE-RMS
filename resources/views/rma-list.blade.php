@extends('layouts.app')
@section('title', 'RMA List')
@section('content')
<div class="main-content" ng-controller="RMAController">
	<div class="section__content section__content--p30" ng-init="GetRMAList();InitiateForm();">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!showrmaform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">RMA List</h6>
			            <!-- <button type="button" class="btn btn-primary btn-sm" ng-click="ShowRMAForm();">
	                        <i class="fa fa-plus"></i>&nbsp; Create</button> -->
			        </div>
			    </div>
			    <div class="col-md-12">
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
			    </div>
	            <div class="col-md-12">
	                <!-- DATA TABLE-->
	                <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="table-responsive">
                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr>
                                    <th>
                                        RMA Ref No
                                    </th>
                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        GS No
                                    </th>
                                    <th>
                                        ACT Reference
                                    </th>
                                    <th>
                                        End Customer
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr grid-item>
                                    <td ng-bind="item.id"></td>
                                    <td ng-bind="item.date | date:'dd/MM/yyyy'"></td>

                                    <td ng-bind="item.gs_no"></td>
                                    <td ng-bind="item.act_reference"></td>
                                    <td ng-bind="item.end_customer"></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="EditRMAForm(item.id);">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Add"
                                                    ng-click="AddPVForm(item.id);">
                                                <i class="zmdi zmdi-plus-box"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
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
	        <div class="row" ng-if="showrmaform">
                @component('forms.creatermaform')
                    
                @endcomponent
            </div>
	    </div>
	</div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/RMAController.js')}}"></script>
	<script>
        $( document ).ready(function() {
            $( "#date" ).datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });
        });
    </script>
@endsection