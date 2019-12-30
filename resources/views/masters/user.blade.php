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
                        @if(Auth::user()->isManager() || Auth::user()->isAdmin())
    		            <button type="button" class="btn btn-primary btn-sm" ng-click="OpenUserModal(0);">
                            <i class="fa fa-plus"></i>&nbsp; Add User</button>
                        @endif
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
                                        <input id="modelnoFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Name" ng-change="gridActions.filter()" ng-model="filtermodelno" filter-by="name" filter-type="text">
                                    </th>
                                    <th>
                                       <input id="producttypeFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Email" ng-change="gridActions.filter()" ng-model="filterProductType" filter-by="email" filter-type="text">
                                   </th>
                                   <th>
                                       <input id="categoryFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Role" ng-change="gridActions.filter()" ng-model="filterCategory" filter-by="role" filter-type="text">
                                   </th>
                                   <th>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="ResetUserSearch();gridActions.filter()">Reset</button>
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
                    <div grid-data grid-options="usergridOptions" grid-actions="gridActions">
                        <div class="overflow-auto">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                        <th>Actions</th>
                                        @endif
                                        <th sortable="name" class="sortable">Name</th>
                                        <th sortable="email" class="sortable">Email</th>
                                        <th sortable="role" class="sortable">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr grid-item>
                                        @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                        <td>
                                            <div class="table-data-feature float-left">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenUserModal(item)">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button ng-if="item.id != 1" class="item" data-toggle="tooltip" data-placement="top" title="Delete" ng-click="DeleteUser(item)">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                        @endif
        	                            <td ng-bind="item.name"></td>
                                        <td ng-bind="item.email"></td>
                                        <td ng-bind="item.role"></td>
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
                                            ng-maxlength="50"
                                            required>
                                            <div ng-show="AddUserForm.username.$touched && AddUserForm.username.$error">
                                                <span class="help-block"
                                                 ng-show="AddUserForm.username.$error.required">
                                                    Please Enter User Name
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddUserForm.username.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddUserForm.username.$error.maxlength">
                                                    Maximum 50 Characters Allowed
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
                                        <ui-select ng-model="user.role" id="role" 
                                            name="role" theme="selectize" title="Select Role" ng-disabled="user.id == 1 && usermodal.edit" required>
                                            <ui-select-match placeholder="Select Role">@{{$select.selected.name}}</ui-select-match>
                                            <ui-select-choices repeat="role.id as role in roles | filter: $select.search">
                                              <span ng-bind-html="role.name | highlight: $select.search"></span>
                                            </ui-select-choices>
                                          </ui-select>
                                        <div ng-show="AddUserForm.role.$touched && AddUserForm.role.$error">
                                            <span class="help-block" ng-show="AddUserForm.role.$error.required">
                                                Please Select Role
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
                                        required>
                                        <div ng-show="AddUserForm.password.$touched && AddUserForm.password.$error">
                                            <span class="help-block" 
                                            ng-show="AddUserForm.password.$error.required">
                                                Please Enter Password
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
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                    <button ng-if="!usermodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddUserForm.$invalid" ng-click="AddUser();">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button ng-if="usermodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddUserForm.$invalid" ng-click="AddUser();">
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