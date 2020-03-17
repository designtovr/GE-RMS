@extends('layouts.app')
@section('title', 'Location')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getlocations();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Locations</h6>
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
                                        <input id="codeFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Code" ng-change="gridActions.filter()" ng-model="filterCode" filter-by="code" filter-type="text">
                                    </th>
                                    <th>
                                       <input id="nameFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Name" ng-change="gridActions.filter()" ng-model="filterName" filter-by="name" filter-type="text">
                                   </th>
                                   <th>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="ResetLocationSearch();gridActions.filter()">Reset</button>
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
                <div class="col-md-12 p-b-20">
                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-primary btn-md float-right" ng-click="OpenLocationModal(0);">
                                <i class="fa fa-plus"></i>&nbsp; Add Location
                            </button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-md float-right box m-r-10"  ng-click="exportToExcelSave('#locationtable' , 'LocationMaster.xls')">
                                <i class="fa fa-file-excel-o"></i>&nbsp;Export
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div grid-data grid-options="locationgridOptions" grid-actions="gridActions">
                        <div class="overflow-auto">
                            <table class="table table-borderless table-data3" id="locationtable" name="locationtable">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th sortable="code" class="sortable">Code</th>
                                        <th sortable="name" class="sortable">Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr grid-item>
                                        <td>
                                            <div class="table-data-feature float-left">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenLocationModal(item)">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" ng-click="DeleteLocation(item.id, item.code);">
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
    <div class="modal fade" id="locationmodal" tabindex="-1" role="dialog" aria-labelledby="locationmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationmodalLabel">@{{locationmodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseLocationModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddLocationForm" id="AddLocationForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="locationcode" class=" form-control-label" >Location Code <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="locationcode" 
                                            name="locationcode" 
                                            ng-model="location.code" 
                                            placeholder="Location Code" 
                                            class="form-control"
                                            ng-minlength="1" 
                                            ng-maxlength="20"
                                            required>
                                            <div ng-show="AddLocationForm.locationcode.$touched && AddLocationForm.locationcode.$error">
                                                <span class="help-block"
                                                 ng-show="AddLocationForm.locationcode.$error.required">
                                                    Please Enter Location Code
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddLocationForm.locationcode.$error.minlength">
                                                    Minimum 1 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddLocationForm.locationcode.$error.maxlength">
                                                    Maximum 20 Characters Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="locationname" class=" form-control-label" >Location Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input 
                                            type="text" 
                                            id="locationname" 
                                            name="locationname" 
                                            ng-model="location.name" 
                                            placeholder="Location Name" 
                                            class="form-control"
                                            ng-minlength="3" 
                                            ng-maxlength="50"
                                            required>
                                            <div ng-show="AddLocationForm.locationname.$touched && AddLocationForm.locationname.$error">
                                                <span class="help-block"
                                                 ng-show="AddLocationForm.locationname.$error.required">
                                                    Please Enter Location Name
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddLocationForm.locationname.$error.minlength">
                                                    Minimum 3 Characters Required
                                                </span>
                                                <span class="help-block"
                                                 ng-show="AddLocationForm.locationname.$error.maxlength">
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
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseLocationModal()">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                    <button ng-if="!locationmodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddLocationForm.$invalid" ng-click="AddLocation();">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button ng-if="locationmodal.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="AddLocationForm.$invalid" ng-click="AddLocation();">
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