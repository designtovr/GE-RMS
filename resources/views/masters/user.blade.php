@extends('layouts.app')
@section('title', 'User')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getusers();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Users</h6>
    		            <button type="button" class="btn btn-primary btn-sm" ng-click="OpenUserModal(0);">
                            <i class="fa fa-plus"></i>&nbsp; Add User</button>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="user in users">
    	                            <td>@{{user.name}}</td>
                                    <td>@{{user.email}}</td>
                                    <td>@{{user.role}}</td>
                                    <td>
    	                                <div class="table-data-feature">
    	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
    	                                        <i class="zmdi zmdi-edit"></i>
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
        </div>
    </div>
    <!-- modal scroll -->
    <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-labelledby="usermodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="usermodalLabel">@{{usermodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseUserModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddUserForm" id="AddUserForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="usercode" class=" form-control-label" >User Code <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="usercode" 
                                            name="usercode" 
                                            ng-model="user.code" 
                                            placeholder="User Code" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="10"
                                            required>
                                            <div ng-show="AddUserForm.usercode.$touched && AddUserForm.usercode.$error">
                                                <span class="help-block"
                                                 ng-show="AddUserForm.usercode.$error.required">
                                                    Please Enter User Code
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddUserForm.usercode.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddUserForm.usercode.$error.maxlength">
                                                    Maximum 10 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="username" class=" form-control-label" >User Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="username" 
                                            name="username" 
                                            ng-model="user.name" 
                                            placeholder="User Name" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="10"
                                            required>
                                            <div ng-show="AddUserForm.username.$touched && AddUserForm.username.$error">
                                                <span class="help-block"
                                                 ng-show="AddUserForm.username.$error.required">
                                                    Please Enter Customer Name
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddUserForm.username.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddUserForm.username.$error.maxlength">
                                                    Maximum 10 Characters Allowed
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
                                        ng-model="user.email" 
                                        placeholder="Email" 
                                        class="form-control" 
                                        ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/"
                                        required>
                                        <div ng-show="AddUserForm.email.$touched && AddUserForm.email.$error">
                                            <span class="help-block" ng-show="AddUserForm.email.$error.required">Please Enter Email</span>
                                            <span class="help-block" ng-show="AddUserForm.email.$error.pattern">Invalid Email</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="role" class=" form-control-label">Role <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select 
                                        ng-model="user.role" 
                                        id="role" 
                                        name="role" 
                                        class="form-control" 
                                        required>
                                            <option ng-repeat="role in roles" value="@{{role.id}}" ng-selected="">@{{role.name}}</option>
                                        </select>
                                        <div ng-show="AddUserForm.role.$touched && AddUserForm.role.$error">
                                            <span class="help-block" ng-show="AddUserForm.role.$error.required">
                                                Please Select Site
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="password" class=" form-control-label">Password <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                        type="text" 
                                        id="password" 
                                        name="password" 
                                        ng-model="user.password" 
                                        placeholder="Password" 
                                        class="form-control" 
                                        ng-minlength="6" 
                                        ng-maxlength="12"
                                        required>
                                        <div ng-show="AddUserForm.password.$touched && AddUserForm.password.$error">
                                            <span class="help-block" 
                                            ng-show="AddUserForm.password.$error.required">
                                                Please Enter Password
                                            </span>
                                            <span class="help-block"
                                             ng-show="AddUserForm.password.$error.minlength">
                                                Minimum 6 Characters Required
                                            </span>
                                            <span class="help-block"
                                             ng-show="AddUserForm.password.$error.maxlength">
                                                Maximum 12 Characters Allowed
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseUserModal();">
                        <i class="fa fa-ban"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddUserForm.$invalid" ng-click="AddUser();">
                        <i class="fa fa-dot-circle-o"></i> Submit
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