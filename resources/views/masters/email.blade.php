@extends('layouts.app')
@section('title', 'Site')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getsites();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Email</h6>
    		        </div>
    		    </div>
                <div class="col-md-12 ">
                    <div class="card-header card-title">
                        Search 
                    </div>
                    <div class="table-responsive">
                        <div class="overflow-auto">
                            <table class="table table-borderless table-data3 table-custom">
                                <thead>
                                    <tr>
                                        <th>
                                            <input id="codeFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Email" ng-change="gridActions.filter()" ng-model="filterEmail" filter-by="code" filter-type="text">
                                        </th>
                              
                                       <th>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="ResetSiteSearch();gridActions.filter()">Reset</button>
                                        </th>
                                        <th>
                                            <button type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="fa fa-search"></i>&nbsp; Search
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 p-b-20">
                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-primary btn-md float-right" ng-click="OpenSiteModal(0);">
                                <i class="fa fa-plus"></i>&nbsp; Add Email
                            </button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-md float-right box m-r-10"  ng-click="exportToExcelSave('#sitetable' , 'SiteMaster.xls')">
                                <i class="fa fa-file-excel-o"></i>&nbsp;Export
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div grid-data grid-options="emailgridOptions" grid-actions="gridActions">
                        <table class="table table-borderless table-data3" id="sitetable" name="sitetable">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th sortable="code" class="sortable">Email</th>
                                    <th sortable="name" class="sortable">To/Cc</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr grid-item>
                                    <td>
                                        <div class="table-data-feature float-left">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenSiteModal(item)">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" ng-click="DeleteSite(item.id, item.code)">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
    	                            <td ng-bind="item.code"></td>
                                    <td ng-bind="item.name"></td>
                                </tr>
                            </tbody>
                        </table>
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
                                    <option>10000000</option>
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
    <div class="modal fade" id="sitemodal" tabindex="-1" role="dialog" aria-labelledby="sitemodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sitemodalLabel">Add Email</h5>
                    <button type="button" class="close" ng-click="CloseSiteModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddSiteForm" id="AddSiteForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="sitecode" class=" form-control-label" >Email ID <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="sitecode" 
                                            name="sitecode" 
                                            ng-model="site.code" 
                                            placeholder="Email ID" 
                                            class="form-control"
                                            ng-minlength="1" 
                                            ng-maxlength="20"
                                            required>
                                            <div ng-show="AddSiteForm.sitecode.$touched && AddSiteForm.sitecode.$error">
                                                <span class="help-block"
                                                 ng-show="AddSiteForm.sitecode.$error.required">
                                                    Please Enter Email ID                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddSiteForm.sitecode.$error.minlength">
                                                    Minimum 1 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddSiteForm.sitecode.$error.maxlength">
                                                    Maximum 20 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="sitename" class=" form-control-label" >To /Cc<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="sitename" 
                                            name="sitename" 
                                            ng-model="site.name" 
                                            placeholder="To / Cc" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="50"
                                            required>
                                            <div ng-show="AddSiteForm.sitename.$touched && AddSiteForm.sitename.$error">
                                                <span class="help-block"
                                                 ng-show="AddSiteForm.sitename.$error.required">
                                                    Please Enter Location Name
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddSiteForm.sitename.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddSiteForm.sitename.$error.maxlength">
                                                    Maximum 50 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-sm" ng-click="CloseSiteModal()">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                    <button ng-if="!sitemodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddSiteForm.$invalid" ng-click="AddSite();">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button ng-if="sitemodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddSiteForm.$invalid" ng-click="AddSite();">
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