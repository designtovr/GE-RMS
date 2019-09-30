@extends('layouts.app')
@section('title', 'RMA Form Linkage')
@section('content')
    <div class="main-content" ng-controller="RMAFormLinkageController">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row" ng-show="!pvform">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h6 class="pb-4 display-5">RMA Form Linkage</h6>
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
                                        <input type="text" id="se-from-date" name="se-from-date" placeholder="Date"
                                               class="form-control-sm form-control">
                                    </th>
                                    <th>
                                        <input type="text" id="se-to-date" name="se-to-date" placeholder="Customer Name"
                                               class="form-control-sm form-control">
                                    </th>

                                    <th>
                                        <input type="text" id="se-cus" name="se-cus" placeholder="End Customer"
                                               class="form-control-sm form-control">
                                    </th>
                                    <th>
                                        <input type="text" id="se-cus" name="se-cus" placeholder="Model No"
                                               class="form-control-sm form-control">
                                    </th>
                                    <th>
                                        <input type="text" id="se-cus" name="se-cus" placeholder="Serial No"
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
                        <div grid-data grid-options="rmagridOptions" grid-actions="gridActions" class="table-responsive">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr>
                                    <th>
                                        Select
                                    </th>
                                    <th>
                                        RMA Ref. No
                                    </th>
                                    <th>
                                        GS No.
                                    </th>
                                    <th>
                                        Model No
                                    </th>
                                    <th>
                                        Serial No
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Customer Name
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
                                    <td ng-bind="item.ref_no"></td>
                                    <td ng-bind="item.gs_no"></td>
                                    <td ng-bind="item.model_no"></td>
                                    <td ng-bind="item.serial_no"></td>
                                    <td ng-bind="item.date | date:'MM/dd/yyyy'"></td>
                                    <td ng-bind="item.customer_name"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div grid-data grid-options="pvgridOptions" grid-actions="gridActions" class="table-responsive">
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                    <tr>
                                        <th>
                                            Select
                                        </th>
                                        <th>
                                            Receipt No
                                        </th>
                                        <th>
                                            RID No.
                                        </th>
                                        <th>
                                            Model No.
                                        </th>
                                        <th>
                                            Serial No.
                                        </th>
                                        <th>
                                            Customer Name
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr grid-item>
                                        <td><label class="au-checkbox">
                                                <input type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label></td>
                                        <td ng-bind="item.receipt_no"></td>
                                        <td ng-bind="item.rid"></td>
                                        <td ng-bind="item.model_no"></td>
                                        <td ng-bind="item.serial_no"></td>
                                        <td ng-bind="item.customer_name"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END DATA TABLE-->
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Link
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('public/js/controllers/RMAFormLinkageController.js')}}"></script>
@endsection