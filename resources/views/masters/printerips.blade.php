@extends('layouts.app')
@section('title', 'Product Type')
@section('content')
<div class="main-content" ng-controller="MastersController">
    <div class="section__content section__content--p30">
        <div class="container-fluid" ng-init="getprintersip();">
        	<div class="row">
    			<div class="col-md-12">
    		        <div class="overview-wrap">
    		            <h6 class="pb-4 display-5">Printer IPs</h6>
    		        </div>
    		    </div>
                <div class="col-md-12 p-b-20">
                    <ul class="list-inline">
                        <li>
                            <button type="button" class="btn btn-primary btn-md float-right box m-r-10"  ng-click="exportToExcelSave('#priteripstable' , 'PrinterIpsMaster.xls')">
                                <i class="fa fa-file-excel-o"></i>&nbsp;Export
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div grid-data grid-options="printersipsgridOptions" grid-actions="gridActions">
                        <div class="overflow-auto">
                            <table class="table table-borderless table-data3" id="priteripstable" name="priteripstable">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th sortable="name" class="sortable">Printers</th>
                                        <th sortable="ip" class="sortable">IP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr grid-item>
                                        <td>
                                            <div class="table-data-feature float-left">
                                                @if(Auth::user()->isManager() || Auth::user()->isAdmin())
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="OpenPrintersIPModal(item)">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
        	                            <td ng-bind="item.name"></td>
                                        <td ng-bind="item.ip"></td>
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
    <div class="modal fade" id="printersipmodal" tabindex="-1" role="dialog" aria-labelledby="printersipLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="producttypeLabel">Printers IP</h5>
                    <button type="button" class="close" ng-click="ClosePrintersIPModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="ProductTypeForm" id="ProductTypeForm" novalidate>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="name" class=" form-control-label" >Printer Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            ng-model="printeripsmodal.name"
                                            placeholder="Product Type Family"
                                            class="form-control"
                                            disabled>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="ip" class=" form-control-label" >IP <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input
                                            type="text"
                                            id="ip"
                                            name="ip"
                                            ng-model="printeripsmodal.ip"
                                            class="form-control"
                                            ng-pattern='/^([0-9]{1,3})[.]([0-9]{1,3})[.]([0-9]{1,3})[.]([0-9]{1,3})$/' 
                                            placeholder='0.0.0.0'
                                            required>
                                            <div ng-show="ProductTypeForm.ip.$touched && ProductTypeForm.ip.$error">
                                                <span class="help-block"
                                                      ng-show="ProductTypeForm.ip.$error.required">
                                                    Please Enter Product Type Family
                                                </span>
                                                <span class="help-block"
                                                  ng-show="ProductTypeForm.ip.$error.pattern">
                                                    Invalid IP Address
                                                </span>
                                            </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="ClosePrintersIPModal()">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="ProductTypeForm.$invalid" ng-click="ChangePrinterIP();">
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