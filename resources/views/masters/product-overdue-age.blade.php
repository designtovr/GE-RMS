@extends('layouts.app')
@section('title', 'Product Overdue Age')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getproductoverdueage();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Product Overdue Age</h6>
    		        </div>
    		    </div>
                <div class="col-md-12 p-b-20">
                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-primary btn-md float-right box m-r-10"  ng-click="exportToExcelSave('#productoverdueagetable' , 'ProductOverdueMaster.xls')">
                                <i class="fa fa-file-excel-o"></i>&nbsp;Export
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div grid-data grid-options="productoverdueagegridOptions" grid-actions="gridActions" >
                        <div class="overflow-auto">
                            <table class="table table-borderless table-data3" id="productoverdueagetable" name="productoverdueagetable">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th sortable="category" class="sortable">Category</th>
                                        <th sortable="pv" class="sortable">Phy. Verification</th>
                                        <th sortable="wch" class="sortable">W/Ch</th>
                                        <th sortable="jt" class="sortable">Job Ticket</th>
                                        <th sortable="testing" class="sortable">Testing</th>
                                        <th sortable="aging" class="sortable">Aging</th>
                                        <th sortable="dispatch" class="sortable">Dispatch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr grid-item>
                                        <td>
                                            <div class="table-data-feature float-left">
                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenProductOverdueAgeModal(item);">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td ng-bind="item.category | uppercase"></td>
                                        <td ng-bind="item.pv"></td>
                                        <td ng-bind="item.wch"></td>
                                        <td ng-bind="item.jt"></td>
                                        <td ng-bind="item.testing"></td>
                                        <td ng-bind="item.aging"></td>
                                        <td ng-bind="item.dispatch"></td>
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
    <div class="modal fade" id="productoverdueagemodal" tabindex="-1" role="dialog" aria-labelledby="productoverdueageLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productoverdueageLabel">@{{productoverdueage.title}}</h5>
                    <button type="button" class="close" ng-click="CloseProductOverdueAgeModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="ProductTypeForm" id="ProductTypeForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="productcategory" class=" form-control-label">Product Category<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="productcategory"
                                            name="producttypecode"
                                            ng-model="productoverdueage.category"
                                            placeholder="Product Category"
                                            class="form-control"
                                            disabled>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="pv" class=" form-control-label" >Physical Verification<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="pv"
                                            name="pv"
                                            ng-model="productoverdueage.pv"
                                            placeholder="Physical Verification"
                                            class="form-control"
                                            ng-pattern="/^[0-9]*$/"
                                            required>
                                            <div ng-show="ProductTypeForm.pv.$touched && ProductTypeForm.pv.$error">
                                                <span class="help-block"
                                                      ng-show="ProductTypeForm.pv.$error.required">
                                                    Please Enter Value
                                                </span>
                                                <span class="help-block"
                                                  ng-show="ProductTypeForm.pv.$error.pattern">
                                                    Only Numbers Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="wch" class=" form-control-label" >W/Ch<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="wch"
                                            name="wch"
                                            ng-model="productoverdueage.wch"
                                            placeholder="W/Ch"
                                            class="form-control"
                                            ng-pattern="/^[0-9]*$/"
                                            required>
                                            <div ng-show="ProductTypeForm.wch.$touched && ProductTypeForm.wch.$error">
                                                <span class="help-block"
                                                      ng-show="ProductTypeForm.wch.$error.required">
                                                    Please Enter Value
                                                </span>
                                                <span class="help-block"
                                                  ng-show="ProductTypeForm.wch.$error.pattern">
                                                    Only Numbers Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="jt" class=" form-control-label" >Job Ticket<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="jt"
                                            name="jt"
                                            ng-model="productoverdueage.jt"
                                            placeholder="Job Ticket"
                                            class="form-control"
                                            ng-pattern="/^[0-9]*$/"
                                            required>
                                            <div ng-show="ProductTypeForm.jt.$touched && ProductTypeForm.jt.$error">
                                                <span class="help-block"
                                                      ng-show="ProductTypeForm.jt.$error.required">
                                                    Please Enter Value
                                                </span>
                                                <span class="help-block"
                                                  ng-show="ProductTypeForm.jt.$error.pattern">
                                                    Only Numbers Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="testing" class=" form-control-label" >Testing<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="testing"
                                            name="testing"
                                            ng-model="productoverdueage.testing"
                                            placeholder="Testing"
                                            class="form-control"
                                            ng-pattern="/^[0-9]*$/"
                                            required>
                                            <div ng-show="ProductTypeForm.testing.$touched && ProductTypeForm.testing.$error">
                                                <span class="help-block"
                                                      ng-show="ProductTypeForm.testing.$error.required">
                                                    Please Enter Value
                                                </span>
                                                <span class="help-block"
                                                  ng-show="ProductTypeForm.testing.$error.pattern">
                                                    Only Numbers Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="aging" class=" form-control-label" >Aging<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="aging"
                                            name="aging"
                                            ng-model="productoverdueage.aging"
                                            placeholder="Testing"
                                            class="form-control"
                                            ng-pattern="/^[0-9]*$/"
                                            required>
                                            <div ng-show="ProductTypeForm.aging.$touched && ProductTypeForm.aging.$error">
                                                <span class="help-block"
                                                      ng-show="ProductTypeForm.aging.$error.required">
                                                    Please Enter Value
                                                </span>
                                                <span class="help-block"
                                                  ng-show="ProductTypeForm.aging.$error.pattern">
                                                    Only Numbers Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="dispatch" class=" form-control-label" >Dispatch<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="dispatch"
                                            name="dispatch"
                                            ng-model="productoverdueage.dispatch"
                                            placeholder="Dispatch"
                                            class="form-control"
                                            ng-pattern="/^[0-9]*$/"
                                            required>
                                            <div ng-show="ProductTypeForm.dispatch.$touched && ProductTypeForm.dispatch.$error">
                                                <span class="help-block"
                                                      ng-show="ProductTypeForm.dispatch.$error.required">
                                                    Please Enter Value
                                                </span>
                                                <span class="help-block"
                                                  ng-show="ProductTypeForm.dispatch.$error.pattern">
                                                    Only Numbers Allowed
                                                </span>
                                            </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseProductOverdueAgeModal()">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="ProductTypeForm.$invalid" ng-click="UpdateProductOverDueAge();">
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