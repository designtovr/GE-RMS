@extends('layouts.app')
@section('title', 'Physical Verification List')
@section('content')
    <div class="main-content" ng-controller="PhysicalVerificationController">
        <div class="section__content section__content--p30" ng-init="getReceipts();GetProductList();">
            <div class="container-fluid">
                <div class="row" ng-show="!pvform">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h6 class="pb-4 display-5">Physical Verification List</h6>
                            <!-- <button type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>&nbsp; Add Item</button> -->
                        </div>
                    </div>
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
                    </div>
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="table-responsive">
                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr>
                                    <th sortable="code" class="sortable">
                                        Receipt No
                                    </th>
                                    <th sortable="placed" class="sortable">
                                        Receipt Date
                                    </th>

                                    <th sortable='total.value' class="sortable">
                                        Customer Name
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        End Customer
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        Courier Name
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        Docket Details
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        Number of Boxes
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr grid-item>
                                    <td ng-bind="item.receipt_no"></td>
                                    <td ng-bind="item.receipt_date | date:'MM/dd/yyyy'"></td>

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
                                                    ng-click="DeletePV(item.receipt_no);">
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
                <div class="row" ng-show="pvform">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Physical Verification</strong> Form
                            </div>
                            <div class="card-body card-block">
                                <div class="row" ng-show="physicalVerification.edit">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="receipt-no" class=" form-control-label">RID <span
                                                            class="mandatory">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="selected"
                                                    ng-model="selected"
                                                    id="selected" class="form-control" ng-options="ridoption as ridoption.rid for ridoption in ridoptions" ng-change="AssignValuesInEditForms();">
                                                    <option value="" style="display:none"></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post" class="form-horizontal" name="EditPhysicalVerification">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="receipt-no" class=" form-control-label">Receipt No <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="receipt-no" name="receipt-no"
                                                           placeholder="Receipt No" class="form-control" disabled
                                                           ng-model="physicalVerification.receipt_no"
                                                           ng-minlength="3"
                                                           ng-maxlength="10"
                                                           required>

                                                    <div ng-show="EditPhysicalVerification.receipt-no.$touched && EditPhysicalVerification.receipt-no.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.receipt-no.$error.required">Please Enter Receipt Number</span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.receipt-no.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.receipt-no.$error.r.maxlength">
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
                                                <div class="col col-md-3">
                                                    <label for="courier" class=" form-control-label">Courier <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="courier" name="courier_name"
                                                           placeholder="Courier"
                                                           class="form-control"
                                                           ng-model="physicalVerification.courier_name"
                                                           ng-minlength="3"
                                                           ng-maxlength="10"
                                                           required>
                                                    <div ng-show="EditPhysicalVerification.courier_name.$touched && EditPhysicalVerification.courier_name.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.courier_name.$error.required">Please Enter Courier</span>

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.courier_name.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.courier_name.$error.maxlength">
                                                Maximum 10 Characters Allowed
                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="docket_details" class=" form-control-label">Docket
                                                        Details <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="docket_details" name="docket_details"
                                                           placeholder="Docket Details" class="form-control"
                                                           ng-model="physicalVerification.docket_details"
                                                           ng-minlength="3"
                                                           ng-maxlength="10"
                                                           required>

                                                    <div ng-show="EditPhysicalVerification.docket_details.$touched && EditPhysicalVerification.docket_details.$error">
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.docket_details.$error.required">Please Enter Docket Details</span>

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.docket_details.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.docket_details.$error.maxlength">
                                                Maximum 10 Characters Allowed
                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" ng-show="physicalVerification.edit">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="rid" class=" form-control-label">RID No <span
                                                        class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="rid" name="rid" placeholder="RID No"
                                                           class="form-control"
                                                           ng-model="physicalVerification.rid"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="date" class=" form-control-label">Date <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="pvdate" name="pvdate" placeholder="Date"
                                                           class="form-control"
                                                           ng-model="physicalVerification.pvdate"
                                                           ng-minlength="3"
                                                           ng-maxlength="10"
                                                           required>

                                                    <div ng-show="EditPhysicalVerification.pvdate.$touched && EditPhysicalVerification.pvdate.$error">

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.pvdate.$error.required">Please Enter Physical Verified Date</span>

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
                                                <div class="col col-md-3">
                                                    <label for="product" class=" form-control-label">Product <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select id="product" name="product"
                                                    ng-model="physicalVerification.product"
                                                    class="form-control"
                                                    ng-change="ChangeProductType();"
                                                    ng-options="product as product.type_name for product in products" required>
                                                        <option value="" style="display:none"></option>>
                                                    </select>
                                                    <div ng-show="EditPhysicalVerification.product.$touched && EditPhysicalVerification.product.$error">
                                                        <span class="help-block form-text"
                                                              ng-show="EditPhysicalVerification.product.$error.required">Please Select Product
                                                          </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="product_category" class=" form-control-label">Product Category
                                                        <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
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
                                                <div class="col col-md-3">
                                                    <label for="model-no" class=" form-control-label">Model No <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="model-no" name="model-no"
                                                           placeholder="Model No" class="form-control"
                                                           ng-model="physicalVerification.model_no"
                                                           disabled>

                                                    <div ng-show="EditPhysicalVerification.model_no.$touched && EditPhysicalVerification.model_no.$error">

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.model_no.$error.required">Please Enter Model No</span>

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.model_no.$error.minlength">
                                                                Minimum 3 Characters Required
                                                        </span>

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.model_no.$error.maxlength">
                                                            Maximum 10 Characters Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="serial_no" class=" form-control-label">Serial No <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
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
                                        <div class="col-md-6">
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
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <strong>Relay Received With </strong>
                                    </div>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Case <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-9">
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
                                                <div class="col col-md-3">
                                                    <label for="case-condition" class=" form-control-label">Case
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
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Battery <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check-inline form-check">
                                                        <label for="battery1" class="form-check-label ">
                                                            <input type="radio" id="battery1" name="battery"
                                                                   ng-model="physicalVerification.battery" value="1"
                                                                   ng-checked = "physicalVerification.battery == 1"
                                                                   class="form-check-input">Yes
                                                        </label>
                                                        <label for="case2" class="form-check-label ">
                                                            <input type="radio" id="battery2" name="battery"
                                                                   ng-model="physicalVerification.battery" value="2"
                                                                   ng-checked = "physicalVerification.battery == 2"

                                                                   class="form-check-input">No
                                                        </label>
                                                        <label for="case3" class="form-check-label ">
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
                                                <div class="col col-md-3">
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
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Terminal Blocks <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-9">
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
                                                            <input type="radio" id="terminal-blocks2"
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
                                                <div class="col col-md-3">
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Top/Bottom Access Cover <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-9">
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
                                                            <input type="radio" id="top-bottom-cover3"
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
                                                <div class="col col-md-3">
                                                    <label for="top-bottom-cover-condition" class=" form-control-label">Top/Bottom
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
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Short links <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-9">
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
                                                <div class="col col-md-3">
                                                    <label for="top-bottom-cover-condition" class=" form-control-label">Short
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="sales_order_no" class=" form-control-label">Sale
                                                        Order/WBS No <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="sales_order_no" name="sales_order_no"
                                                           ng-model="physicalVerification.sales_order_no"
                                                           placeholder="Sale Order/WBS No" class="form-control"
                                                           ng-minlength="3"
                                                           ng-maxlength="10"
                                                           required>

                                                    <div ng-show="EditPhysicalVerification.sales_order_no.$touched && EditPhysicalVerification.sales_order_no.$error">

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.sales_order_no.$error.required">Please Enter Sales Order No</span>

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.sales_order_no.$error.minlength">
                                                                Minimum 3 Characters Required
                                                        </span>

                                                        <span class="help-block"
                                                              ng-show="EditPhysicalVerification.sales_order_no.$error.maxlength">
                                                            Maximum 10 Characters Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm" ng-click="AddPV();">
                                    <i class="fa fa-save"></i> Save
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
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('public/js/controllers/PhysicalVerificationController.js')}}"></script>
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