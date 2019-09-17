@extends('layouts.app')
@section('title', 'Warranty List')
@section('content')
    <div class="main-content" ng-controller="WarrantyController">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h6 class="pb-4 display-5">Warranty List</h6>
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
                    <div class="col-md-12 p-b-20">
                        <button type="button" class="btn btn-primary btn-md float-right"
                                ng-click="OpenWarrantyModal();">
                            <i class="fa fa-check-circle"></i>&nbsp;W/C
                        </button>
                    </div>
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="table-responsive">
                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th sortable="placed" class="sortable">
                                        RID No
                                    </th>
                                    <th sortable="purchaseOrderNumber" class="sortable">
                                        Product
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        Customer Name
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        End Customer
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        Serial No
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        Model No
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        Courier
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        Docket No
                                    </th>
                                    <th sortable='total.value' class="sortable">
                                        Customer Comment
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr grid-item>
                                    <td>
                                        <label class="au-checkbox">
                                            <input type="checkbox">
                                            <span class="au-checkmark"></span>
                                        </label>
                                    </td>
                                    <td ng-bind="item.rid_no"></td>
                                    <td ng-bind="item.product"></td>
                                    <td ng-bind="item.customer_name"></td>
                                    <td ng-bind="item.end_customer"></td>
                                    <td ng-bind="item.serial_no"></td>
                                    <td ng-bind="item.model_no"></td>
                                    <td ng-bind="item.courier_name"></td>
                                    <td ng-bind="item.docket_details"></td>
                                    <td ng-bind="item.customer_comment"></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
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
        <div class="modal fade" id="warrantymodal" tabindex="-1" role="dialog" aria-labelledby="warrantymodalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="warrantymodalLabel">@{{warrantymodal.title}}</h5>
                        <button type="button" class="close" ng-click="CloseWarrantyModal();" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="" method="post" class="form-horizontal" name="AddUserForm"
                                      id="AddUserForm" novalidate>
                                    <div class="row b-b-1">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-6">
                                                    <label class=" form-control-label"><b>SMP</b> <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="radio" id="radio1" name="radios"
                                                                       value="option1" class="form-check-input">Chargable
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" name="radios"
                                                                       value="option2" class="form-check-input">Warranty
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-6">
                                                    <label class=" form-control-label"><b>PCP</b> <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="radio" id="radio1" name="radios"
                                                                       value="option1" class="form-check-input">Chargable
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" name="radios"
                                                                       value="option2" class="form-check-input">Warranty
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row b-b-1 p-t-20">
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-6">
                                                    <label class=" form-control-label"><b>Type</b> <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="radio" id="radio1" name="radios"
                                                                       value="option1" class="form-check-input">Repair
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" name="radios"
                                                                       value="option2" class="form-check-input">Modification
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" name="radios"
                                                                       value="option2" class="form-check-input">Investigation
                                                            </label>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row form-group">
                                                <div class="col col-md-6">
                                                    <label class=" form-control-label"><b>Move To</b> <span
                                                                class="mandatory">*</span></label>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="form-check">
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="radio" id="radio1" name="radios"
                                                                       value="option1" class="form-check-input">Repair
                                                                Rack
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" name="radios"
                                                                       value="option2" class="form-check-input">Customer
                                                                Hold Rack
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-md-6 offset-md-6">
                                            <div class="row form-group col-md-2">
                                                <label class=" form-control-label"><b>RCA</b></label>

                                            </div>

                                            <div class="checkbox  col-md-2 offset-md-1">
                                                {{--  <label for="checkbox1" class="form-check-label">--}}
                                                <input type="checkbox" id="checkbox1" name="checkbox1"
                                                       value="option1" class="form-check-input">
                                                {{--</label>--}}
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row p-t-20">
                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="comment" class=" form-control-label"><b>Comment</b>
                                                        <span class="mandatory">*</span></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="comment" name="comment" placeholder="Comment"
                                                           class="form-control">
                                                    <span class="help-block">Please Enter Customer</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" ng-click="CloseWarrantyModal();">
                            <i class="fa fa-ban"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" ng-disabled="AddUserForm.$invalid"
                                ng-click="AddUser();">
                            <i class="fa fa-dot-circle-o"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal scroll -->
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('public/js/controllers/WarrantyController.js')}}"></script>
@endsection