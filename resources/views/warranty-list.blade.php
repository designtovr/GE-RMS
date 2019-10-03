@extends('layouts.app')
@section('title', 'Warranty List')
@section('content')
<div class="main-content" ng-controller="WarrantyController">
    <div class="section__content section__content--p30" ng-init="Start();">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h6 class="pb-4 display-5">Warranty List</h6>
                    </div>
                </div>
                <div class="col-md-12 ">
                   <div class="card-header card-title">
                     Search 
                 </div>
                 <div >
                    <div class="table-responsive">
                        <table class="table table-borderless table-data3 table-custom">
                            <thead>
                                <tr>
                                    <th>

                                        <input id="ridFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Enter RID #" ng-change="gridActions.filter();" ng-model="filterID" filter-by="id" filter-type="text">
                                    </th>
                                    <th>

                                        <input id="productFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Enter Product ID" ng-change="gridActions.filter();" ng-model="filterreceipt_id" filter-by="product_id" filter-type="text">
                                    </th>
                                    <th>
                                        <input type="text"
                                        id="dateFilter"
                                        class="form-control"
                                        placeholder="Date"
                                        max-date="dateTo"
                                        close-text="Close"
                                        ng-model="filterpvdate"
                                        show-weeks="true"
                                        is-open="dateFromOpened"
                                        ng-click="dateFromOpened = true"
                                        filter-by="pvdate"
                                        filter-type="text"
                                        ng-change="gridActions.filter()"
                                        close-text="Close"/>

                                    </th>
                           <!--          <th>
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
                            </th> -->
                            <th>
                               <input id="customerFilter" type="text" class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" placeholder="Enter Customer Name" ng-change="gridActions.filter()" ng-model="filterCustomer" filter-by="customer_name" filter-type="text">
                           </th>
                           <th>
                            <button type="button" class="btn btn-outline-secondary btn-sm" ng-click="Reset();gridActions.filter()">Reset</button>
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
    <button type="button" class="btn btn-primary btn-md float-right"
    ng-click="OpenWarrantyModal();">
    <i class="fa fa-check-circle"></i>&nbsp;W/C
</button>
</div>
<div class="col-md-12">
    <!-- DATA TABLE-->
    <div grid-data grid-options="gridOptions" grid-actions="gridActions"  >
        <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
        <div class = "">
        <table class="table table-borderless table-data3  overflow-auto">
            <thead>
                <tr>

                    <th >
                        Select
                    </th>
                    <th sortable="id" class="sortable">
                        RID
                    </th>
                    <th  sortable="pvdate" class="sortable">
                        Date
                    </th>
                    <th sortable="product_id" class="sortable">
                        Product Id
                    </th>
                    <th  sortable="serial_no" class="sortable">
                        Serial
                    </th>
                    <th  sortable="customer_name" class="sortable">
                        End Customer
                    </th>
                    <th  sortable="end_customer" class="sortable">
                        End Customer
                    </th>

                    <th  sortable="comment" class="sortable">
                        Comment
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
                    <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                    <td ng-bind="item.product_id"></td>
                    <td ng-bind="item.serial_no"></td>
                    <td ng-bind="item.customer_name"></td>
                    <td ng-bind="item.end_customer"></td>
                    <td ng-bind="item.comment"></td>
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
                items-per-page="paginationOptions.itemsPerPage"></grid-pagination>
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
                    <form action="" method="post" class="form-horizontal" name="AddWarrantyForm"
                    id="AddWarrantyForm" novalidate>
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
                                                    <input type="radio" id="radio1" name="smp_chargeable"
                                                    value="1" class="form-check-input"
                                                    ng-model = "warrantymodal.smp" ng-change ="ValidateStatus()">Chargable
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio2" class="form-check-label ">
                                                    <input type="radio" id="radio2" name="smp" ng-model = "warrantymodal.smp" 
                                                    value="2" class="form-check-input" ng-change ="ValidateStatus()">Warranty
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
                                                        <input type="radio" id="radio1" name="pcp"
                                                        value="1" ng-model = "warrantymodal.pcp" class="form-check-input" ng-change ="ValidateStatus()">Chargable
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label for="radio2" class="form-check-label ">
                                                        <input type="radio" id="radio2" name="pcp" ng-model = "warrantymodal.pcp"
                                                        value="2" class="form-check-input" ng-change ="ValidateStatus()">Warranty
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
                                                            <input type="radio" id="radio1" name="type" ng-model = "warrantymodal.type"
                                                            value="1" class="form-check-input">Repair
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="radio2" class="form-check-label ">
                                                            <input type="radio" id="radio2" name="type" ng-model = "warrantymodal.type"
                                                            value="2" class="form-check-input">Modification
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label for="radio2" class="form-check-label ">
                                                            <input type="radio" id="radio2" name="type" ng-model = "warrantymodal.type"
                                                            value="3" class="form-check-input">Investigation
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
                                                                <input type="radio" id="radio1" name="move" ng-model = "warrantymodal.move"
                                                                value="1" class="form-check-input">Repair
                                                                Rack
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="radio2" class="form-check-label ">
                                                                <input type="radio" id="radio2" name="move" ng-model = "warrantymodal.move"
                                                                value="2" class="form-check-input">Customer
                                                                Hold Rack
                                                            </label>
                                                        </div>

                                                        <div ng-show = show_rca_options>
                                                            <div class="radio">
                                                                <label for="radio2" class="form-check-label ">
                                                                    <input type="radio" id="radio2" name="move" ng-model = "warrantymodal.move"
                                                                    value="3" class="form-check-input" ">Post Lab

                                                                </label>
                                                            </div>

                                                            <div class="radio">
                                                                <label for="radio2" class="form-check-label ">
                                                                    <input type="radio" id="radio2" name="move" ng-model = "warrantymodal.move"
                                                                    value="4" class="form-check-input" >Application Lab
                                                                </label>
                                                            </div>
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
                                                    <input type="checkbox" id="checkbox1" name="checkbox1" name="rca" ng-model = "warrantymodal.rca" ng-change ="OnRCAChanged()"
                                                    value="1" class="form-check-input">
                                                {{--</label>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20" ng-show ="show_po">
                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="comment" class=" form-control-label"><b>PO</b>
                                                        <span class="mandatory">*</span></label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="comment"  placeholder="PO" name="po" ng-model = "warrantymodal.po"
                                                        class="form-control">
                                                        <span class="help-block">Please Enter PO</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-t-20" ng-show ="show_wbs">
                                            <div class="col-md-12">
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="comment" class=" form-control-label"><b>WBS / SO</b>
                                                            <span class="mandatory">*</span></label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="comment"  placeholder="WBS" name="wbs" ng-model = "warrantymodal.wbs"
                                                            class="form-control">
                                                            <span class="help-block">Please Enter WBS</span>
                                                        </div>
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


                                                <div ng-show = show_rca_options>
                                                    <div class="row p-t-20">
                                                        <div class="col-md-12">
                                                            <div class="row form-group">
                                                                <div class="col col-md-3">
                                                                    <label for="mail" class=" form-control-label"><b>  RID </b>
                                                                        <span class="mandatory">*</span></label>
                                                                    </div>
                                                                    <div class="col-12 col-md-9">
                                                                        <ui-select multiple ng-model="selectedRID" theme="bootstrap"  sortable="true" close-on-select="false" >
                                                                            <ui-select-match placeholder="Select RID...">@{{$item}}</ui-select-match>
                                                                            <ui-select-choices class = "d-block" repeat="rid in loadedRIDs | filter: $select.search">
                                                                                <div ng-bind-html="rid"></div>

                                                                            </ui-select-choices>
                                                                        </ui-select>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div ng-show = show_rca_options>
                                                        <div class="row p-t-20">
                                                            <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <div class="col col-md-3">
                                                                      <label for="mail" class=" form-control-label"><b>Mail To: </b>
                                                                        <span class="mandatory">*</span></label>
                                                                    </div>
                                                                    <div class="col-12 col-md-9">
                                                                        <ui-select multiple ng-model="selectedPeople" theme="bootstrap"  sortable="true" close-on-select="false" >
                                                                            <ui-select-match placeholder="Select person...">@{{$item.name}} &lt;@{{$item.email}}&gt;</ui-select-match>
                                                                            <ui-select-choices class = "d-block" repeat="person.email as person in people | propsFilter: {name: $select.search, age: $select.search}">
                                                                              <div ng-bind-html="person.name | highlight: $select.search"></div>
                                                                              <small>
                                                                                email: @{{person.email}}
                                                                                age: <span ng-bind-html="''+person.age | highlight: $select.search"></span>
                                                                            </small>
                                                                        </ui-select-choices>
                                                                    </ui-select>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div ng-show = show_rca_options>
                                                        <div class="row p-t-20">
                                                            <div class="col-md-12">
                                                                <div class="row form-group">
                                                                    <div class="col col-md-3">
                                                                      <label for="mail" class=" form-control-label"><b>  Cc: </b>
                                                                        <span class="mandatory">*</span></label>
                                                                    </div>
                                                                    <div class="col-12 col-md-9">
                                                                        <ui-select multiple ng-model="selectedCCPeople" theme="bootstrap"  sortable="true" close-on-select="false" >
                                                                            <ui-select-match placeholder="Select person...">@{{$item.name}} &lt;@{{$item.email}}&gt;</ui-select-match>
                                                                            <ui-select-choices class = "d-block" repeat="person.email as person in people | propsFilter: {name: $select.search, age: $select.search}">
                                                                              <div ng-bind-html="person.name | highlight: $select.search"></div>
                                                                              <small>
                                                                                email: @{{person.email}}
                                                                                age: <span ng-bind-html="''+person.age | highlight: $select.search"></span>
                                                                            </small>
                                                                        </ui-select-choices>
                                                                    </ui-select>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row p-t-20">
                                                    <div class="col-md-12">
                                                        <div class="row form-group">
                                                            <div class="col col-md-3">
                                                                <label for="comment" class=" form-control-label"><b>Message</b>
                                                                    <span class="mandatory">*</span></label>
                                                                </div>
                                                                <div class="col-12 col-md-9">
                                                                    <input type="text" id="comment" name="comment" placeholder="Message"
                                                                    class="form-control">
                                                                    <span class="help-block">Please Enter Customer</span>
                                                                </div>
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
            <script>
                $(document).ready(function () {
                    $("#dateFilter").datepicker({
                        autoclose: true,
                        format: 'yyyy-mm-dd',
                        todayHighlight: true,
                        setDate: new Date(),
                        update: new Date()
                    });
                });
            </script>
            @endsection

<!--     format: 'dd/mm/yyyy', -->