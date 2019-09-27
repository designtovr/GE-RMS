@extends('layouts.app')
@section('title', 'Receipt List')
@section('content')
    <div class="main-content" ng-controller="ReceiptController">
        <div class="section__content section__content--p30" ng-init="Initiate();getReceipts();">
            <div class="container-fluid">
                <div class="row" ng-show="!receiptform">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h6 class="pb-4 display-5">Receipt List</h6>
                            <button type="button" class="btn btn-primary btn-sm" ng-click="ShowReceiptForm();">
                                <i class="fa fa-plus"></i>&nbsp;Add Item
                            </button>
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
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" ng-click="EditReceipt(item);">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" ng-click="DeleteReceipt(item.id);">
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
                <div class="row" ng-show="receiptform">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Receipt</strong> Form
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" class="form-horizontal" name="AddReceiptForm"
                                      id="AddReceiptForm" novalidate>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="rf-no" class=" form-control-label">Receipt No. <span
                                                        class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input
                                                    type="text"
                                                    id="receipt_no"
                                                    name="receipt_no"
                                                    ng-model="receipt.receipt_no"
                                                    placeholder="Receipt No"
                                                    class="form-control"
                                                    ng-minlength="3"
                                                    ng-maxlength="10"
{{--                                                    ng-disabled="EditReceipt"--}}
                                                    required>
                                            <div ng-show="AddReceiptForm.receipt_no.$touched && AddReceiptForm.receipt_no.$error">
                                            <span class="help-block form-text"
                                                  ng-show="AddReceiptForm.receipt_no.$error.required">
                                                Please Enter Receipt Number
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.receipt_no.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.receipt_no.$error.maxlength">
                                                Maximum 10 Characters Allowed
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="ga_no" class=" form-control-label">GS No. <span
                                                        class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input
                                                    type="text"
                                                    id="gs_no"
                                                    name="gs_no"
                                                    ng-model="receipt.gs_no"
                                                    placeholder="GS No"
                                                    class="form-control"
                                                    ng-minlength="3"
                                                    ng-maxlength="20"
                                                    required>
                                            <div ng-show="AddReceiptForm.gs_no.$touched && AddReceiptForm.gs_no.$error">
                                            <span class="help-block"
                                                  ng-show="AddReceiptForm.gs_no.$error.required">
                                                Please Enter GS Number
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.gs_no.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.gs_no.$error.maxlength">
                                                Maximum 20 Characters Allowed
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="re_date" class=" form-control-label">Receipt Date <span
                                                        class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input
                                                    type="text"
                                                    id="re_date"
                                                    name="re_date"
                                                    ng-model="receipt.receipt_date"
                                                    placeholder="Receipt Date"
                                                    class="form-control"
                                                    required>
                                            <div ng-show="AddReceiptForm.re_date.$touched && AddReceiptForm.re_date.$error">
                                            <span class="help-block"
                                                  ng-show="AddReceiptForm.re_date.$error.required">
                                                Please Select Receipt Date
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="cu_name" class=" form-control-label">Customer Name/Manufacture
                                                Name <span class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input
                                                    type="text"
                                                    id="cu_name"
                                                    name="cu_name"
                                                    ng-model="receipt.customer_name"
                                                    placeholder="Customer Name/Manufacture Name"
                                                    class="form-control"
                                                    ng-minlength="3"
                                                    ng-maxlength="20"
                                                    required>
                                            <div ng-show="AddReceiptForm.cu_name.$touched && AddReceiptForm.cu_name.$error">
                                            <span class="help-block"
                                                  ng-show="AddReceiptForm.cu_name.$error.required">
                                                Please Enter Customer Name/Manufacture Name
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.cu_name.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.cu_name.$error.maxlength">
                                                Maximum 20 Characters Allowed
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="end_cusname" class=" form-control-label">End Customer <span
                                                        class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input
                                                    type="text"
                                                    id="end_cusname"
                                                    name="end_cusname"
                                                    ng-model="receipt.end_customer"
                                                    placeholder="End Customer"
                                                    class="form-control"
                                                    ng-minlength="3"
                                                    ng-maxlength="20"
                                                    required>
                                            <div ng-show="AddReceiptForm.end_cusname.$touched && AddReceiptForm.end_cusname.$error">
                                            <span class="help-block"
                                                  ng-show="AddReceiptForm.end_cusname.$error.required">
                                                Please Enter End Customer
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.end_cusname.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.end_cusname.$error.maxlength">
                                                Maximum 20 Characters Allowed
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="courier_name" class=" form-control-label">Courier Name <span
                                                        class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input
                                                    type="text"
                                                    id="courier_name"
                                                    name="courier_name"
                                                    ng-model="receipt.courier_name"
                                                    placeholder="Courier Name"
                                                    class="form-control"
                                                    ng-minlength="3"
                                                    ng-maxlength="20"
                                                    required>
                                            <div ng-show="AddReceiptForm.courier_name.$touched && AddReceiptForm.courier_name.$error">
                                            <span class="help-block"
                                                  ng-show="AddReceiptForm.courier_name.$error.required">
                                                Please Enter Courier Name
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.courier_name.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.courier_name.$error.maxlength">
                                                Maximum 20 Characters Allowed
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="docket_details" class=" form-control-label">Docket Details <span
                                                        class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input
                                                    type="text"
                                                    id="docket_details"
                                                    name="docket_details"
                                                    ng-model="receipt.docket_details"
                                                    placeholder="Docket Details"
                                                    class="form-control"
                                                    ng-minlength="3"
                                                    ng-maxlength="20"
                                                    required>
                                            <div ng-show="AddReceiptForm.docket_details.$touched && AddReceiptForm.docket_details.$error">
                                            <span class="help-block"
                                                  ng-show="AddReceiptForm.docket_details.$error.required">
                                                Please Enter Docket Details
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.docket_details.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.docket_details.$error.maxlength">
                                                Maximum 20 Characters Allowed
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="no_of_boxes" class=" form-control-label">No Of Boxes <span
                                                        class="mandatory">*</span></label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input
                                                    type="text"
                                                    id="no_of_boxes"
                                                    name="no_of_boxes"
                                                    ng-model="receipt.total_boxes"
                                                    placeholder="No Of Boxes"
                                                    class="form-control"
                                                    ng-pattern="/^[0-9]*$/"
                                                    required>
                                            <div ng-show="AddReceiptForm.no_of_boxes.$touched && AddReceiptForm.no_of_boxes.$error">
                                            <span class="help-block"
                                                  ng-show="AddReceiptForm.no_of_boxes.$error.required">
                                                Please Enter No Of Boxes
                                            </span>
                                                <span class="help-block"
                                                      ng-show="AddReceiptForm.no_of_boxes.$error.pattern">
                                                Only Numbers Allowed
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm"
                                        {{--ng-disabled="AddReceiptForm.$invalid"--}}
                                        ng-click="AddReceipt();">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-refresh"></i> Reset
                                </button>
                                <button class="btn btn-danger btn-sm" ng-click="HideReceiptForm();">
                                    <i class="fa fa-ban"></i> Close
                                </button>

                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary btn-sm"
                                            ng-disabled="AddReceiptForm.$invalid">
                                        <i class="fa fa-print"></i> Print
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('public/js/controllers/ReceiptController.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#re_date").datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                todayHighlight: true,
                setDate: new Date(),
                update: new Date()
            });
        });
    </script>
@endsection