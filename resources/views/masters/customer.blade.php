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
                <div class="col-md-12 ">
                    <div class="card-header card-title">
                        Search 
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-data3 table-custom">
                            <thead>
                                <tr>
                                    <th>
                                       <input id="customerNameFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Customer Name" ng-change="gridActions.filter()" ng-model="filterCustomerName" filter-by="name" filter-type="text">
                                   </th>
                                   <th>
                                       <input id="addressFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Address" ng-change="gridActions.filter()" ng-model="filterAddress" filter-by="address" filter-type="text">
                                   </th>
                                   <th>
                                       <input id="contactPersonFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Contact Person" ng-change="gridActions.filter()" ng-model="filterContactPerson" filter-by="contact_person" filter-type="text">
                                   </th>
                                   <th>
                                       <input id="gstFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="GST" ng-change="gridActions.filter()" ng-model="filtergst" filter-by="gst" filter-type="text">
                                   </th>
                                   <th>
                                       <input id="emailFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Email" ng-change="gridActions.filter()" ng-model="filterEmail" filter-by="email" filter-type="text">
                                   </th>
                                   <th>
                                       <input id="contactFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Contact No" ng-change="gridActions.filter()" ng-model="filterContactNo" filter-by="contact" filter-type="text">
                                   </th>
                                   <th>
                                       <input id="siteFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Site" ng-change="gridActions.filter()" ng-model="filterSite" filter-by="site_name" filter-type="text">
                                   </th>
                                   <th>
                                       <input id="locationFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Location" ng-change="gridActions.filter()" ng-model="filterLocation" filter-by="location_name" filter-type="text">
                                   </th>
                                   <th>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="ResetCustomerSearch();gridActions.filter()">Reset</button>
                                    </th>
                                    <th>
                                        <!-- <button type="button" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-search"></i>&nbsp; Search
                                        </button> -->
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div grid-data grid-options="customergridOptions" grid-actions="gridActions">
                        <div class="overflow-auto">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th sortable="name" class="sortable">Customer Name</th>
                                        <th sortable="address" class="sortable">Address</th>
                                        <th sortable="contact_person" class="sortable">Contact Person</th>
                                        <th sortable="gst" class="sortable">GST</th>
                                        <th sortable="email" class="sortable">Email</th>
                                        <th sortable="contact" class="sortable">Contact</th>
                                        <th sortable="site_name" class="sortable">Site</th>
                                        <th sortable="location_name" class="sortable">Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr grid-item>
                                        <td>
                                            <div class="table-data-feature float-left">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenCustomerModal(item.id)">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" ng-click="DeleteCustomer(item.id, item.code);">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td ng-bind="item.name"></td>
                                        <td ng-bind="item.address"></td>
                                        <td ng-bind="item.contact_person"></td>
                                        <td ng-bind="item.gst"></td>
        	                            <td ng-bind="item.email"></td>
        	                            <td ng-bind="item.contact"></td>
        	                            <td ng-bind="item.site_name"></td>
        	                            <td ng-bind="item.location_name"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form class="form-inline pull-right margin-bottom-basic">
                            <div class="form-group">
                                <grid-pagination max-size="5"
                                boundary-links="true"
                                class="pagination-sm"
                                total-items="paginationOptions.totalItems"
                                ng-model="paginationOptions.currentPage"
                                ng-change="reloadGrid()"
                                items-per-page="paginationOptions.itemsPerPage">
                                </grid-pagination>
                            </div>
                            <div class="form-group items-per-page">
                                <label for="itemsOnPageSelect2">Items per page:</label>
                                <select id="itemsOnPageSelect2" class="form-control input-sm"
                                ng-init="paginationOptions.itemsPerPage = '10'"
                                ng-model="paginationOptions.itemsPerPage" ng-change="reloadGrid()">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>75</option>
                                </select>
                            </div>
                        </form>
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
                                <!-- <div class="row form-group">
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
                                </div> -->
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
                                        <label for="gst" class=" form-control-label">GST</label>
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
                                        ng-maxlength="15">
                                        <div ng-show="AddCustomerForm.gst.$touched && AddCustomerForm.gst.$error">
                                            <span class="help-block" 
                                            ng-show="AddCustomerForm.gst.$error.minlength">
                                                Should Not Be Less Than 15 Digits
                                            </span>
                                            <span class="help-block" 
                                            ng-show="AddCustomerForm.gst.$error.maxlength">
                                                Should Not Be Greater Than 15 Digits
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
                    <button ng-if="!customermodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddCustomerForm.$invalid" ng-click="AddCustomer();">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button ng-if="customermodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddCustomerForm.$invalid" ng-click="AddCustomer();">
                        <i class="fa fa-dot-circle-o"></i> Update
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseCustomerModal()">
                        <i class="fa fa-ban"></i> Cancel
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