@extends('layouts.app')
@section('title', 'Customer')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getcustomers();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Customers</h6>
    		            <button type="button" class="btn btn-primary btn-sm" ng-click="OpenCustomerModal(0);">
                            <i class="fa fa-plus"></i>&nbsp; Add Customer</button>
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
                                    <th>Customer Code</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Contact Person</th>
                                    <th>GST</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Site</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="customer in customers">
                                    <td>@{{customer.code}}</td>
                                    <td>@{{customer.name}}</td>
                                    <td>@{{customer.address}}</td>
                                    <td>@{{customer.contact_person}}</td>
                                    <td>@{{customer.gst}}</td>
    	                            <td>@{{customer.email}}</td>
    	                            <td>@{{customer.contact}}</td>
    	                            <td>@{{customer.site_name}}</td>
    	                            <td>@{{customer.location_name}}</td>
                                    <td>
    	                                <div class="table-data-feature">
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenCustomerModal(customer.id)">
    	                                        <i class="zmdi zmdi-edit"></i>
    	                                    </button>
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" ng-click="DeleteCustomer(customer.id, customer.code);">
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
        </div>
    </div>
    <!-- modal scroll -->
    <div class="modal fade" id="customermodal" tabindex="-1" role="dialog" aria-labelledby="customermodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customermodalLabel">@{{customermodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseCustomerModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddCustomerForm" id="AddCustomerForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="customer-code" class=" form-control-label" >Customer Code <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="customercode" 
                                            name="customercode" 
                                            ng-model="customer.code" 
                                            placeholder="Customer Code" 
                                            class="form-control"
                                            ng-minlength="1" 
                                            ng-maxlength="25"
                                            required>
                                            <div ng-show="AddCustomerForm.customercode.$touched && AddCustomerForm.customercode.$error">
                                                <span class="help-block"
                                                 ng-show="AddCustomerForm.customercode.$error.required">
                                                    Please Enter Customer Code
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddCustomerForm.customercode.$error.minlength">
                                                    Minimum 1 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddCustomerForm.customercode.$error.maxlength">
                                                    Maximum 25 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="customername" class=" form-control-label">Customer Name <span class="mandatory" >*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="customername" 
                                            name="customername" 
                                            ng-model="customer.name" 
                                            placeholder="Customer Name" 
                                            class="form-control" 
                                            ng-minlength="2" 
                                            ng-maxlength="100"
                                            required>
                                        <div ng-show="AddCustomerForm.customername.$touched && AddCustomerForm.customername.$error">
                                            <span class="help-block" 
                                            ng-show="AddCustomerForm.customername.$error.required">
                                                Please Enter Customer Name
                                            </span>
                                            <span class="help-block"
                                             ng-show="AddCustomerForm.customername.$error.minlength">
                                                Minimum 2 Characters Required
                                            </span>
                                            <span class="help-block"
                                             ng-show="AddCustomerForm.customername.$error.maxlength">
                                                Maximum 100 Characters Allowed
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="address" class=" form-control-label">Address <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <textarea 
                                        ng-model="customer.address" 
                                        id="address" 
                                        name="address" 
                                        rows="3" 
                                        placeholder="Address" 
                                        class="form-control" 
                                        ng-minlength="3" 
                                        required>
                                        </textarea>
                                        <div ng-show="AddCustomerForm.address.$touched && AddCustomerForm.address.$error">
                                            <span class="help-block" ng-show="AddCustomerForm.address.$error.required">
                                                Please Enter Address
                                            </span>
                                            <span class="help-block" ng-show="AddCustomerForm.address.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="pincode" class=" form-control-label">Pincode <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="pincode" 
                                            name="pincode" 
                                            ng-model="customer.pincode" 
                                            placeholder="Pincode" 
                                            class="form-control" 
                                            ng-pattern="/^[0-9]*$/"
                                            required>
                                        <div ng-show="AddCustomerForm.pincode.$touched && AddCustomerForm.pincode.$error">
                                            <span class="help-block" ng-show="AddCustomerForm.pincode.$error.required">
                                                Please Enter Pincode
                                            </span>
                                            <span class="help-block" ng-show="AddCustomerForm.pincode.$error.pattern">
                                                Should Be Number
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="contact_person" class=" form-control-label">Contact Person <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                        type="text" 
                                        id="contact_person" 
                                        name="contact_person" 
                                        ng-model="customer.contact_person" 
                                        placeholder="Contact Person" 
                                        class="form-control" 
                                        ng-minlength="3" 
                                        ng-maxlength="50"
                                        required>
                                        <div ng-show="AddCustomerForm.contact_person.$touched && AddCustomerForm.contact_person.$error">
                                            <span class="help-block" ng-show="AddCustomerForm.contact_person.$error.required">
                                                Please Enter Contact Person
                                            </span>
                                            <span class="help-block" ng-show="AddCustomerForm.contact_person.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                            <span class="help-block" ng-show="AddCustomerForm.contact_person.$error.maxlength">
                                                Maximum 50 Characters Allowed
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="gst" class=" form-control-label">GST <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                        type="text" 
                                        id="gst" 
                                        name="gst" 
                                        ng-model="customer.gst" 
                                        placeholder="GST" 
                                        class="form-control"
                                        ng-minlength="15"
                                        ng-maxlength="15"
                                        required>
                                        <div ng-show="AddCustomerForm.gst.$touched && AddCustomerForm.gst.$error">
                                            <span class="help-block" 
                                            ng-show="AddCustomerForm.gst.$error.required">
                                                Please Enter GST
                                            </span>
                                            <span class="help-block" 
                                            ng-show="AddCustomerForm.gst.$error.minlength">
                                                Should Be Less Than 15 Digits
                                            </span>
                                            <span class="help-block" 
                                            ng-show="AddCustomerForm.gst.$error.maxlength">
                                                Should Be Greater Than 15 Digits
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="email" class=" form-control-label">Email <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        ng-model="customer.email" 
                                        placeholder="Email" 
                                        class="form-control" 
                                        ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/"
                                        required>
                                        <div ng-show="AddCustomerForm.email.$touched && AddCustomerForm.email.$error">
                                            <span class="help-block" ng-show="AddCustomerForm.email.$error.required">Please Enter Email</span>
                                            <span class="help-block" ng-show="AddCustomerForm.email.$error.pattern">Invalid Email</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="contact" class=" form-control-label">Contact No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                        type="text" 
                                        id="contact" 
                                        name="contact" 
                                        ng-model="customer.contact" 
                                        placeholder="Contact No" 
                                        class="form-control"
                                        ng-minlength="7" 
                                        ng-maxlength="15"
                                        ng-pattern="/^[0-9]*$/" 
                                        required>
                                        <div ng-show="AddCustomerForm.contact.$touched && AddCustomerForm.contact.$error">
                                            <span class="help-block" ng-show="AddCustomerForm.contact.$error.required">
                                                Please Enter Contact No
                                            </span>
                                            <span class="help-block" ng-show="AddCustomerForm.contact.$error.pattern">
                                                Only Numbers Allowed
                                            </span>
                                            <span class="help-block" ng-show="AddCustomerForm.contact.$error.minlength">
                                                Minimum 7 Numbers Required
                                            </span>
                                            <span class="help-block" ng-show="AddCustomerForm.contact.$error.maxlength">
                                                Maximum 15 Numbers Allowed
                                            </span>
                                            <span class="help-block" ng-show="AddCustomerForm.contact.$error.pattern">
                                                Only Numbers Allowed
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="site" class=" form-control-label">Site <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select 
                                        ng-model="customer.site_id" 
                                        id="site" 
                                        name="site" 
                                        class="form-control" 
                                        required>
                                            <option ng-repeat="site in sites" value="@{{site.id}}" ng-selected="@{{customer.site_id}} == @{{site.id}}">@{{site.name}}</option>
                                        </select>
                                        <div ng-show="AddCustomerForm.site.$touched && AddCustomerForm.site.$error">
                                            <span class="help-block" ng-show="AddCustomerForm.site.$error.required">
                                                Please Select Site
                                            </span>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="site" class=" form-control-label">Site</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <ui-select ng-model="customer.site_id" id="site" 
                                        name="site" theme="selectize" title="Select Site Name">
                                        <ui-select-match placeholder="Select Site Name">@{{$select.selected.name}}</ui-select-match>
                                        <ui-select-choices repeat="site.id as site in sites | filter: $select.search">
                                          <span ng-bind-html="site.name | highlight: $select.search"></span>
                                        </ui-select-choices>
                                      </ui-select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="location" class=" form-control-label">Location <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <ui-select ng-model="customer.location_id" id="location" 
                                            name="location" theme="selectize" title="Select Location Name" required>
                                            <ui-select-match placeholder="Select Location Name">@{{$select.selected.name}}</ui-select-match>
                                            <ui-select-choices repeat="location.id as location in locations | filter: $select.search">
                                              <span ng-bind-html="location.name | highlight: $select.search"></span>
                                            </ui-select-choices>
                                        </ui-select>
                                        <div ng-show="AddCustomerForm.location.$touched && AddCustomerForm.location.$error">
                                            <span class="help-block" ng-show="AddCustomerForm.location.$error.required">
                                                Please Select Location
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseCustomerModal()">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button ng-if="!customermodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddCustomerForm.$invalid" ng-click="AddCustomer();">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button ng-if="customermodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddCustomerForm.$invalid" ng-click="AddCustomer();">
                        <i class="fa fa-dot-circle-o"></i> Update
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal scroll -->
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/MastersController.js')}}"></script>
@endsection