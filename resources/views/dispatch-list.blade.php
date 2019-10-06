@extends('layouts.app')
@section('title', 'Dispatch List')
@section('content')
<div class="main-content" ng-controller="DispatchController">
	<div class="section__content section__content--p30" ng-init = "Initiate();getDispatches();Start()">
	    <div class="container-fluid">
	    	<div class="row" ng-show="!showdpform">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="display-5">Dispatch List</h6>
			        </div>
			    </div>
			   <div class="col-md-12 ">
                        <div class="card-header card-title">
                            Search
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-borderless table-data3 table-custom">
                                    <thead>
                                    <tr>
                                        <th>

                                            <input id="ridFilter" type="text"
                                                   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
                                                   placeholder="Enter RID #" ng-change="gridActions.filter();"
                                                   ng-model="filterID" filter-by="id" filter-type="text">
                                        </th>
                                        <th>

                                            <input id="productFilter" type="text"
                                                   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
                                                   placeholder="Enter Product ID" ng-change="gridActions.filter();"
                                                   ng-model="filterreceipt_id" filter-by="product_id"
                                                   filter-type="text">
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
                                            <input id="customerFilter" type="text"
                                                   class="form-control ng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched"
                                                   placeholder="Enter Customer Name" ng-change="gridActions.filter()"
                                                   ng-model="filterCustomer" filter-by="customer_name"
                                                   filter-type="text">
                                        </th>
                                        <th>
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    ng-click="Reset();gridActions.filter()">Reset
                                            </button>
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
                                ng-click="ShowDPForm();">
                            <i class="fa fa-plus"></i>&nbsp;Create Dispatch
                        </button>
                    </div>
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div grid-data grid-options="gridOptions" grid-actions="gridActions">
                            <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                            <div class="overflow-auto">
                                <table class="table table-borderless table-data3  ">
                                    <thead>
                                    <tr>

                                        <th>
                                            Select
                                        </th>
                                        <th sortable="id" class="sortable">
                                            RID
                                        </th>
                                        <th sortable="pvdate" class="sortable">
                                            Date
                                        </th>
                                        <th sortable="product_id" class="sortable">
                                            Product Id
                                        </th>
                                        <th sortable="serial_no" class="sortable">
                                            Serial
                                        </th>
                                        <th sortable="part_no" class="sortable">
                                            Model
                                        </th>
                                        <th sortable="customer_name" class="sortable">
                                            Customer
                                        </th>
                                        <th sortable="end_customer" class="sortable">
                                            End Customer
                                        </th>

                                        <th sortable="comment" class="sortable">
                                            Comment
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr grid-item>
                                        <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox" ng-model="item.create_wc">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td ng-bind="item.id"></td>
                                        <td ng-bind="item.pvdate | date:'dd/MM/yyyy'"></td>
                                        <td ng-bind="item.product_id"></td>
                                        <td ng-bind="item.serial_no"></td>
                                        <td ng-bind="item.part_no"></td>
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
	        <div class="row" ng-show="showdpform">
        		<div class="col-lg-12">
        			<div class="card">
        				<div class="card-header">
                            <strong>Dispatch</strong> Form
                        </div>
                        <div class="card-body card-block">
    	                	<form action="" method="post" class="form-horizontal">
    	                		<div class="row form-group">
    	                            <div class="col col-md-3">
    	                                <label for="dispatch-no" class=" form-control-label">Dispatch No <span class="mandatory">*</span></label>
    	                            </div>
    	                            <div class="col-12 col-md-6">


    	                                <input type="text" id="dispatch-no" name="dispatch-no"  placeholder="Dispatch No" class="form-control"
											   ng-model="dispatch.dispatch_no"
											   ng-minlength="3"
											   ng-maxlength="10"
											   required>
										<div ng-show="AddDispatchForm.dispatch_no.$touched && AddDispatchForm.dispatch_no.$error"><span class="help-block">Please Enter Dispatch No</span></div>

								</div>
    	                        </div>
    	                        <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="date" class=" form-control-label">Date<span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="date" name="date" placeholder="Date" class="form-control"
											   ng-model="dispatch.date"
											   ng-minlength="3"
											   ng-maxlength="10"
											   required>
                                        <span class="help-block">Please Select Date</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="rid" class=" form-control-label">RID No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="rid" name="rid" placeholder="RID No" class="form-control"
											   ng-model="dispatch.id"
											   ng-minlength="3"
											   ng-maxlength="10"
											   required>
                                        <span class="help-block">Please Enter RID No</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="dc-no" class=" form-control-label">DC No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="dc-no" name="dc-no" placeholder="DC No" class="form-control"
											   ng-model="dispatch.dc_no"
											   ng-minlength="3"
											   ng-maxlength="10"
											   required>
                                        <span class="help-block">Please Enter DC No</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="docket-details" class=" form-control-label">Docket Details <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="docket-details" name="docket-details" placeholder="Docket Details" class="form-control"
											   ng-model="dispatch.docket_details"
											   ng-minlength="3"
											   ng-maxlength="10"
											   required>
                                        <span class="help-block">Please Enter Docket Details</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="rma" class=" form-control-label">RMA No <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="rma" name="rma" placeholder="RMA" class="form-control"
											   ng-model="dispatch.rma_no"
											   ng-minlength="3"
											   ng-maxlength="10"
											   required>
                                        <span class="help-block">Please Enter RMA No </span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="courier-name" class=" form-control-label">Courier Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="courier-name" name="courier-name" placeholder="Courier Name" class="form-control"
											   ng-model="dispatch.courier_name"
											   ng-minlength="3"
											   ng-maxlength="10"
											   required>
                                        <span class="help-block">Please Enter Courier Name </span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="person-name" class=" form-control-label">Person  Name <span class="mandatory">*</span></label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="person-name" name="person-name" placeholder="Person Name" class="form-control"
											   ng-model="dispatch.person_name"
											   ng-minlength="3"
											   ng-maxlength="10"
											   required>
                                        <span class="help-block">Please Enter Person Name </span>
                                    </div>
                                </div>
    	                	</form>
    	                </div>
    	                <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" ng-click = "AddDispatch()">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                            <button type="reset" class="btn btn-secondary btn-sm" ng-click="HideDPForm();">
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
	<script type="text/javascript" src="{{url('public/js/controllers/DispatchController.js')}}"></script>
@endsection