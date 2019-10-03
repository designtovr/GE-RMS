@extends('layouts.app')
@section('title', 'Physical Verification List')
@section('content')
    <div class="main-content" ng-controller="PhysicalVerificationController">
        <div class="section__content section__content--p30" ng-init="getReceipts();GetProductTypeList();GetProductList();">
            <div class="container-fluid">
                <div class="row" ng-show="!pvform && !showcreatermaform">
                    <!-- <div class="col-md-12">
                        <div class="overview-wrap">
                            <h6 class="pb-4 display-5">Physical Verification List</h6>
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-borderless table-data3 table-custom">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="text" id="se-from-date" name="se-from-date" placeholder="From Date"
                                                   class="form-control-sm form-control">
                                        </th>
                                        <th>
                                            <input type="text" id="se-to-date" name="se-to-date" placeholder="To Date"
                                                   class="form-control-sm form-control">
                                        </th>
                                        <th>
                                            <select name="field-volts-used" id="field-volts-used"
                                                    class="form-control-sm form-control">
                                                <option value="0">From</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="2">Customer</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select name="field-volts-used" id="field-volts-used"
                                                    class="form-control-sm form-control">
                                                <option value="0">To</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="2">Customer</option>
                                            </select>
                                        </th>
                                        <th>
                                            <input type="text" id="se-cus" name="se-cus" placeholder="Customer"
                                                   class="form-control-sm form-control">
                                        </th>
                                        <th>
                                            <button type="button" class="btn btn-outline-secondary btn-sm">Reset</button>
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
                            <div class="card">
                                <div class="card-header">
                                    <h4>Physical Verification List</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" ng-click="ChangeTab('all')">
                                            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
                                        </li>
                                        <li class="nav-item" ng-click="ChangeTab('withrma')">
                                            <a class="nav-link" id="withrma-tab" data-toggle="tab" href="#withrma" role="tab" aria-controls="withrma" aria-selected="false">With RMA</a>
                                        </li>
                                        <li class="nav-item" ng-click="ChangeTab('withoutrma')">
                                            <a class="nav-link" id="withoutrma-tab" data-toggle="tab" href="#withoutrma" role="tab" aria-controls="withoutrma" aria-selected="false">Without RMA</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content pl-3 p-1" id="myTabContent">
                                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                            <!-- DATA TABLE-->
                                            <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="table-responsive">
                                                <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                                <table class="table table-borderless table-data3">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            Receipt No
                                                        </th>
                                                        <th>
                                                            Receipt Date
                                                        </th>

                                                        <th>
                                                            Customer Name
                                                        </th>
                                                        <th>
                                                            End Customer
                                                        </th>
                                                        <th>
                                                            Courier Name
                                                        </th>
                                                        <th>
                                                            Docket Details
                                                        </th>
                                                        <th>
                                                            Number of Boxes
                                                        </th>
                                                        <th>
                                                            Actions
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr grid-item>
                                                        <td ng-bind="item.id"></td>
                                                        <td ng-bind="item.receipt_date | date:'dd/MM/yyyy'"></td>

                                                        <td ng-bind="item.customer_name"></td>
                                                        <td ng-bind="item.end_customer"></td>
                                                        <td ng-bind="item.courier_name"></td>
                                                        <td ng-bind="item.docket_details"></td>
                                                        <td ng-bind="item.total_boxes"></td>
                                                        <td>
                                                            <div class="table-data-feature">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit"
                                                                        ng-click="OpenPVForm(item, true);">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                                        title="Add"
                                                                        ng-click="OpenPVForm(item, false);">
                                                                    <i class="zmdi zmdi-plus-box"></i>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                                        title="Delete"
                                                                        ng-click="DeletePV(item.id);">
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
                                        <div class="tab-pane fade" id="withrma" role="tabpanel" aria-labelledby="withrma-tab">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary btn-md float-right m-b-10" ng-click="CreateRMA();">
                                                    <i class="fa fa-check-circle"></i>&nbsp;Create RMA
                                                </button>
                                            </div>
                                            <!-- DATA TABLE-->
                                            <div grid-data grid-options="pvgridOptions" grid-actions="gridActions" class="table-responsive">
                                                <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                                <table class="table table-borderless table-data3">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            Select
                                                        </th>
                                                        <th>
                                                            Id
                                                        </th>
                                                        <th>
                                                            Receipt Id
                                                        </th>
                                                        <th>
                                                            Date
                                                        </th>
                                                        <th>
                                                            Customer Name
                                                        </th>
                                                        <th>
                                                            End Customer
                                                        </th>
                                                        <th>
                                                            Courier Name
                                                        </th>
                                                        <th>
                                                            Docket Details
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr grid-item>
                                                        <td>
                                                            <label class="au-checkbox">
                                                                <input type="checkbox" ng-model="item.create_rma">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td ng-bind="item.id"></td>
                                                        <td ng-bind="item.receipt_id"></td>
                                                        <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                                                        <td ng-bind="item.customer_name"></td>
                                                        <td ng-bind="item.end_customer"></td>
                                                        <td ng-bind="item.courier_name"></td>
                                                        <td ng-bind="item.docket_details"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- END DATA TABLE-->
                                        </div>
                                        <div class="tab-pane fade" id="withoutrma" role="tabpanel" aria-labelledby="withoutrma-tab">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary btn-md float-right m-b-10" ng-click="CreateRMA();">
                                                    <i class="fa fa-check-circle"></i>&nbsp;Create RMA
                                                </button>
                                            </div>
                                            <!-- DATA TABLE-->
                                            <div grid-data grid-options="pvgridOptions" grid-actions="gridActions" class="table-responsive">
                                                <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                                                <table class="table table-borderless table-data3">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            Select
                                                        </th>
                                                        <th>
                                                            Id
                                                        </th>
                                                        <th>
                                                            Receipt Id
                                                        </th>
                                                        <th>
                                                            Date
                                                        </th>
                                                        <th>
                                                            Customer Name
                                                        </th>
                                                        <th>
                                                            End Customer
                                                        </th>
                                                        <th>
                                                            Courier Name
                                                        </th>
                                                        <th>
                                                            Docket Details
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr grid-item>
                                                        <td>
                                                            <label class="au-checkbox">
                                                                <input type="checkbox" ng-model="item.create_rma">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
                                                        <td ng-bind="item.id"></td>
                                                        <td ng-bind="item.receipt_id"></td>
                                                        <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                                                        <td ng-bind="item.customer_name"></td>
                                                        <td ng-bind="item.end_customer"></td>
                                                        <td ng-bind="item.courier_name"></td>
                                                        <td ng-bind="item.docket_details"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- END DATA TABLE-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" ng-show="pvform && !showcreatermaform">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Physical Verification</strong> Form
                            </div>
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="col-md-6" ng-show="physicalVerification.edit">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="id" class=" form-control-label">RID <span
                                                            class="mandatory">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="selected"
                                                    ng-model="selected"
                                                    id="selected" class="form-control" ng-options="ridoption as ridoption.id for ridoption in ridoptions" ng-change="AssignValuesInEditForms();">
                                                    <option value="" style="display:none"></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" ng-show="!physicalVerification.edit">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="id" class=" form-control-label">Receipt Id <span class="mandatory">*</span></label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" id="receipt_id" name="receipt_id"
                                                   placeholder="Receipt No" class="form-control" disabled
                                                   ng-model="physicalVerification.receipt_id"
                                                   disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post" class="form-horizontal" name="EditPhysicalVerification" novalidate>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="courier" class=" form-control-label">Courier <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="courier" name="courier_name"
                                                           placeholder="Courier"
                                                           class="form-control"
                                                           ng-model="physicalVerification.courier_name"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="docket_details" class=" form-control-label">Docket
                                                        Details <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="docket_details" name="docket_details"
                                                       placeholder="Docket Details" class="form-control"
                                                       ng-model="physicalVerification.docket_details"
                                                       disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" ng-show="physicalVerification.edit">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="rid" class=" form-control-label">Receipt No <span
                                                        class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="rid" name="rid" placeholder="RID No"
                                                           class="form-control"
                                                           ng-model="physicalVerification.receipt_id"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="pvdate" class=" form-control-label">Date <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="pvdate" name="pvdate" placeholder="Date"
                                                           class="form-control"
                                                           ng-model="physicalVerification.pvdate"
                                                           ng-minlength="3"
                                                           ng-maxlength="10"
                                                           required>

                                                    <div ng-show="EditPhysicalVerification.pvdate.$touched && EditPhysicalVerification.pvdate.$error">

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.pvdate.$error.required">Please Select Date</span>

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.pvdate.$error.minlength">
                                                                Minimum 3 Characters Required
                                                        </span>

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.pvdate.$error.maxlength">
                                                            Maximum 10 Characters Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="producttype" class=" form-control-label">Product Type <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <select id="producttype" name="producttype"
                                                    ng-model="physicalVerification.producttype"
                                                    class="form-control"
                                                    ng-change="ChangeProductType();"
                                                    ng-options="pt as pt.name for pt in producttypes" 
                                                    required>
                                                        <option value="" style="display:none"></option>>
                                                    </select>
                                                    <div ng-show="EditPhysicalVerification.producttype.$touched && EditPhysicalVerification.producttype.$error">
                                                        <span class="help-block form-text"
                                                              ng-show="EditPhysicalVerification.producttype.$error.required">Please Select Product Type
                                                          </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="product_category" class=" form-control-label">Product Category
                                                        <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="product_category" name="product_category"
                                                       placeholder="Product Category" class="form-control"
                                                       ng-model="physicalVerification.product_category"
                                                       disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="product" class=" form-control-label">Model No <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <ui-select ng-model="physicalVerification.product" theme="selectize" title="Select Model No" ng-change="AssignModelNo();" required>
                                                        <ui-select-match placeholder="Select Model No">@{{$select.selected.part_no}}</ui-select-match>
                                                        <ui-select-choices id="part_no" 
                                                            name="product" repeat="product in products | filter: $select.search">
                                                          <span ng-bind-html="product.part_no | highlight: $select.search"></span>
                                                        </ui-select-choices>
                                                      </ui-select>
                                                    <input ng-if="physicalVerification.product.id == -1" type="text" id="manual_part_no" name="manual_part_no"
                                                       placeholder="Model No" class="form-control"
                                                       ng-model="physicalVerification.manual_part_no"
                                                       required>
                                                    <div ng-show="EditPhysicalVerification.manual_part_no.$touched && EditPhysicalVerification.manual_part_no.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.manual_part_no.$error.required">Please Enter Model No</span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.manual_part_no.$error.minlength">
                                                                Minimum 3 Characters Required
                                                        </span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.manual_part_no.$error.maxlength">
                                                            Maximum 10 Characters Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="serial_no" class=" form-control-label">Serial No <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="serial_no" name="serial_no"
                                                           placeholder="Serial No" class="form-control"
                                                           ng-model="physicalVerification.serial_no"
                                                           ng-minlength="3"
                                                           ng-maxlength="10"
                                                           required>
                                                    <div ng-show="EditPhysicalVerification.serial_no.$touched && EditPhysicalVerification.serial_no.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.serial_no.$error.required">Please Enter Serial No</span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.serial_no.$error.minlength">
                                                                Minimum 3 Characters Required
                                                        </span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.serial_no.$error.maxlength">
                                                            Maximum 10 Characters Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="defect" class=" form-control-label">Defect Mentioned by
                                                        Customer <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                   <textarea 
                                                    type="text" 
                                                    id="defect" 
                                                    name="defect"
                                                    ng-model="physicalVerification.defect"
                                                    placeholder="Defect Mentioned by Customer" 
                                                    class="form-control"
                                                    ng-minlength="3" 
                                                    ng-maxlength="200"
                                                    rows="4"
                                                    required>
                                                    </textarea>
                                                    <div ng-show="EditPhysicalVerification.defect.$touched && EditPhysicalVerification.defect.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.defect.$error.required">Please Enter Defect Mentioned by Customer</span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.defect.$error.minlength">
                                                                Minimum 3 Characters Required
                                                        </span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.defect.$error.maxlength">
                                                            Maximum 200 Characters Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="crc_comment" class=" form-control-label">Comment By CRC</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                   <textarea 
                                                    type="text" 
                                                    id="crc_comment" 
                                                    name="crc_comment"
                                                    ng-model="physicalVerification.crc_comment"
                                                    placeholder="Comment" 
                                                    class="form-control"
                                                    rows="4"
                                                    >
                                                    </textarea>
                                                    <div ng-show="EditPhysicalVerification.crc_comment.$touched && EditPhysicalVerification.crc_comment.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.crc_comment.$error.required">Please Enter Comment</span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.crc_comment.$error.minlength">
                                                                Minimum 3 Characters Required
                                                        </span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.crc_comment.$error.maxlength">
                                                            Maximum 200 Characters Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <strong>Relay Received With </strong>
                                    </div>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Case <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <div class="form-check-inline form-check">
                                                        <label for="case1" class="form-check-label ">
                                                            <input type="radio" id="case1" name="case"
                                                                   ng-model="physicalVerification.case" value="1"
                                                                   ng-checked = "physicalVerification.case == 1"

                                                                   class="form-check-input">Yes
                                                        </label>
                                                        <label for="case2" class="form-check-label ">
                                                            <input type="radio" id="case2" name="case"
                                                                   ng-model="physicalVerification.case" value="2"
                                                                   ng-checked = "physicalVerification.case == 2"

                                                                   class="form-check-input">No
                                                        </label>
                                                        <label for="case3" class="form-check-label ">
                                                            <input type="radio" id="case3" name="case"
                                                                   ng-model="physicalVerification.case" value="3"
                                                                   ng-checked = "physicalVerification.case == 3"

                                                                   class="form-check-input">Not Applicable
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="case_condition" class=" form-control-label">Case
                                                        Condition <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="case_condition"
                                                            ng-options="condition.value as condition.name for condition in conditions"
                                                            ng-model="physicalVerification.case_condition"
                                                            id="case_condition" class="form-control" >
                                                            <option style="display: none;" value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Battery <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <div class="form-check-inline form-check">
                                                        <label for="battery1" class="form-check-label ">
                                                            <input type="radio" id="battery1" name="battery"
                                                                   ng-model="physicalVerification.battery" value="1"
                                                                   ng-checked = "physicalVerification.battery == 1"
                                                                   class="form-check-input">Yes
                                                        </label>
                                                        <label for="battery2" class="form-check-label ">
                                                            <input type="radio" id="battery2" name="battery"
                                                                   ng-model="physicalVerification.battery" value="2"
                                                                   ng-checked = "physicalVerification.battery == 2"

                                                                   class="form-check-input">No
                                                        </label>
                                                        <label for="battery3" class="form-check-label ">
                                                            <input type="radio" id="battery3" name="battery"
                                                                   ng-model="physicalVerification.battery" value="3"
                                                                   ng-checked = "physicalVerification.battery == 3"

                                                                   class="form-check-input">Not Applicable
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="battery_condition" class=" form-control-label">Battery
                                                        Condition <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="battery_condition"
                                                            ng-options="condition.value as condition.name for condition in conditions"
                                                            ng-model="physicalVerification.battery_condition"
                                                            id="battery_condition" class="form-control" >
                                                            <option style="display: none;" value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Terminal Blocks <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <div class="form-check-inline form-check">
                                                        <label for="terminal_blocks1" class="form-check-label ">
                                                            <input type="radio" id="terminal_blocks1"
                                                                   name="terminal_blocks"
                                                                   ng-model="physicalVerification.terminal_blocks"
                                                                   value="1"
                                                                   ng-checked = "physicalVerification.terminal_blocks == 1"

                                                                   class="form-check-input">Yes
                                                        </label>
                                                        <label for="terminal_blocks2" class="form-check-label ">
                                                            <input type="radio" id="terminal_blocks2"
                                                                   name="terminal_blocks"
                                                                   ng-model="physicalVerification.terminal_blocks"
                                                                   ng-checked = "physicalVerification.terminal_blocks == 2"

                                                                   value="2" class="form-check-input">No
                                                        </label>
                                                        <label for="terminal_blocks3" class="form-check-label ">
                                                            <input type="radio" id="terminal_blocks3"
                                                                   name="terminal_blocks"
                                                                   ng-model="physicalVerification.terminal_blocks"
                                                                   ng-checked = "physicalVerification.terminal_blocks == 3"

                                                                   value="3" class="form-check-input">Not
                                                            Applicable
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="terminal_blocks_condition" class=" form-control-label">Terminal
                                                        Blocks Condition <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="terminal_blocks_condition"
                                                            ng-options="condition.value as condition.name for condition in conditions"
                                                            ng-model="physicalVerification.terminal_blocks_condition"
                                                            id="terminal_blocks_condition" class="form-control" >
                                                            <option style="display: none;" value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" ng-if="physicalVerification.terminal_blocks == 1">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="no_of_terminal_blocks" class=" form-control-label">Number Of Terminal Blocks <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="no_of_terminal_blocks" name="no_of_terminal_blocks"
                                                           class="form-control"
                                                           ng-model="physicalVerification.no_of_terminal_blocks"
                                                           ui-mask="9 + 9" placeholder="N+N" 
                                                           add-default-placeholder="9 + 9"
                                                           ui-mask-placeholder-char="N"
                                                           required>
                                                    <div ng-show="EditPhysicalVerification.no_of_terminal_blocks.$touched && EditPhysicalVerification.no_of_terminal_blocks.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.no_of_terminal_blocks.$error.required">Please Enter No Of Blocks</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Top/Bottom Access Cover <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <div class="form-check-inline form-check">
                                                        <label for="top_bottom_cover1" class="form-check-label ">
                                                            <input type="radio" id="top_bottom_cover1"
                                                                   name="top_bottom_cover"
                                                                   ng-model="physicalVerification.top_bottom_cover"
                                                                   ng-checked = "physicalVerification.top_bottom_cover == 1"
                                                                   value="1" class="form-check-input">Yes
                                                        </label>
                                                        <label for="top_bottom_cover2" class="form-check-label ">
                                                            <input type="radio" id="top_bottom_cover2"
                                                                   name="top_bottom_cover"
                                                                   ng-model="physicalVerification.top_bottom_cover"
                                                                   ng-checked = "physicalVerification.top_bottom_cover == 2"
                                                                   value="2" class="form-check-input">No
                                                        </label>
                                                        <label for="top_bottom_cover3" class="form-check-label ">
                                                            <input type="radio" id="top_bottom_cover3"
                                                                   name="top_bottom_cover"
                                                                   ng-model="physicalVerification.top_bottom_cover"
                                                                   ng-checked = "physicalVerification.top_bottom_cover == 3"
                                                                   value="3" class="form-check-input">Not Applicable
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="top_bottom_cover_condition" class=" form-control-label">Top/Bottom
                                                        Access Cover Condition <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="top_bottom_cover_condition"
                                                            ng-options="condition.value as condition.name for condition in conditions"
                                                            ng-model="physicalVerification.top_bottom_cover_condition"
                                                            id="top_bottom_cover_condition" class="form-control" >
                                                            <option style="display: none;" value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Short links <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-8">
                                                    <div class="form-check-inline form-check">
                                                        <label for="short_links1" class="form-check-label ">
                                                            <input type="radio" id="short_links1"
                                                                   name="short_links"
                                                                   ng-model="physicalVerification.short_links" value="1"
                                                                   ng-checked = "physicalVerification.short_links == 1"

                                                                   class="form-check-input">Yes
                                                        </label>
                                                        <label for="short_links2" class="form-check-label ">
                                                            <input type="radio" id="short_links2"
                                                                   name="short_links"
                                                                   ng-model="physicalVerification.short_links" value="2"
                                                                   ng-checked = "physicalVerification.short_links == 2"

                                                                   class="form-check-input">No
                                                        </label>
                                                        <label for="short_links3" class="form-check-label ">
                                                            <input type="radio" id="short_links3"
                                                                   name="short_links"
                                                                   ng-model="physicalVerification.short_links" value="3"
                                                                   ng-checked = "physicalVerification.short_links == 3"
                                                                   class="form-check-input">Not Applicable
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="short_links_condition" class=" form-control-label">Short
                                                        Links Condition <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="short_links_condition"
                                                            ng-options="condition.value as condition.name for condition in conditions"
                                                            ng-model="physicalVerification.short_links_condition"
                                                            id="short_links_condition" class="form-control" >
                                                            <option style="display: none;" value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" ng-if="physicalVerification.short_links == 1">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="no_of_short_links" class=" form-control-label">No Of Short links <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input 
                                                       type="text" 
                                                       id="no_of_short_links" 
                                                       name="no_of_short_links"
                                                       ng-model="physicalVerification.no_of_short_links"
                                                       placeholder="No Of Short Links" 
                                                       class="form-control"
                                                       ng-pattern="/^[0-9]*$/"
                                                       required>
                                                       <div ng-show="EditPhysicalVerification.no_of_short_links.$touched && EditPhysicalVerification.no_of_short_links.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.no_of_short_links.$error.required">Please Enter No Of Short Links</span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.no_of_short_links.$error.pattern">
                                                                Only Numbers Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="sales_order_no" class=" form-control-label">Sale
                                                        Order/WBS No</label>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input type="text" id="sales_order_no" name="sales_order_no"
                                                       ng-model="physicalVerification.sales_order_no"
                                                       placeholder="Sale Order/WBS No" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="is_rma_available" class=" form-control-label">IS RMA Available? <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="au-checkbox">
                                                        <input type="checkbox" name="is_rma_available" id="is_rma_available" ng-model="physicalVerification.is_rma_available">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button ng-if="!physicalVerification.edit" type="submit" class="btn btn-primary btn-sm" ng-click="AddPV();" ng-disabled="EditPhysicalVerification.$invalid">
                                    <i class="fa fa-save"></i> Save
                                </button>
                                <button ng-if="physicalVerification.edit" type="submit" class="btn btn-primary btn-sm" ng-click="AddPV();" ng-disabled="EditPhysicalVerification.$invalid">
                                    <i class="fa fa-save"></i> Update
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-undo"></i> Reset
                                </button>
                                <button type="reset" class="btn btn-secondary btn-sm" ng-click="ClosePVForm();">
                                    <i class="fa fa-ban"></i> Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" ng-if="!pvform && showcreatermaform" ng-controller="RMAController">
                    @component('forms.creatermaform')
                        
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('public/js/controllers/PhysicalVerificationController.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/controllers/RMAController.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#pvdate").datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });
        });
    </script>
@endsection