@extends('layouts.app')
@section('title', 'Holidays List')
@section('content')
<div class="main-content" ng-controller="HolidaysController">
  <div class="section__content section__content--p30" ng-init = "getHolidays();">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
              <div class="overview-wrap">
                  <h6 class="pb-4 display-5">Holidays List</h6>
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
                                            <input type="text"
                                                   class="form-control"
                                                   placeholder="From Date"

                                                   max-date="dateTo"
                                                   ng-model = "dateFrom"
                                                   filter-by="date_unix"

                                                   ng-change="gridActions.filter();"
                                                   id="dateFromFilter"
                                                   filter-type="dateFrom"
                                            />
                                        </th>
                                        <th>
                                            <input type="text"
                                                   placeholder="To Date"
                                                   filter-by="date_unix"
                                                   ng-change="gridActions.filter();"
                                                   id="dateToFilter"
                                                   class="form-control"
                                                   min-date="dateFrom"
                                                   close-text="Close"
                                                   ng-model="dateTo"
                                                   filter-type="dateTo"
                                                   close-text="Close">
                                        </th>
                                        <th>
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    ng-click="Reset();gridActions.filter()">Reset
                                            </button>
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>
          <div class="col-md-12 p-b-20">
            <button type="button" class="btn btn-primary btn-md float-right" ng-click="OpenHolidaysModal();">
                          <i class="fa fa-plus"></i>&nbsp;Add
                  </button>
          </div>
              <div class="col-md-12">
                  <!-- DATA TABLE-->
                  <div grid-data grid-options="gridOptions" grid-actions="gridActions" class="table-responsive">
                     <!-- sample table layout goes below, but remember that you can you any mark-up here. -->
                     <table class="table table-borderless table-data3">
                         <thead>
                         <tr>
                                
                                <th sortable='date' class="sortable">
                                     Date
                                 </th>
                             <th sortable="description" class="sortable">
                                 Description
                             </th>
                        
                         </tr>
                         </thead>
                         <tbody>
                         <tr grid-item>
                           
                                <td ng-bind="item.date_unix | date:'dd/MM/yyyy'"></td>
                                <td ng-bind="item.description"></td>
                         </tr>
                         </tbody>
                     </table>
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
    <div class="modal fade" id="Holidaysmodal" tabindex="-1" role="dialog" aria-labelledby="HolidaysmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="HolidaysmodalLabel">@{{Holidaysmodal.title}}</h5>
                    <button type="button" class="close" ng-click="CloseHolidaysModal();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="post" class="form-horizontal" name="AddUserForm" id="AddUserForm" novalidate>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row form-group">
                                      <div class="col col-md-3">
                                          <label for="comment" class=" form-control-label"><b>Date</b> <span class="mandatory">*</span></label>
                                      </div>
                                      <div class="col-12 col-md-9">
                              

                                                <input type="text"
                                                   class="form-control"
                                                   placeholder="Date"
                                                   max-date="dateTo"
                                                   ng-model = "Holidaysmodal.date"
                                                   id="dateFilter"
                                            />
                                          <!-- <span class="help-block">Please Enter RID</span> -->
                                      </div>
                                  </div>
                          </div>
                          <div class="col-md-12">
                            <div class="row form-group">
                                      <div class="col col-md-3">
                                          <label for="comment" class=" form-control-label"><b>Description</b> <span class="mandatory">*</span></label>
                                      </div>
                                      <div class="col-12 col-md-9">
                                          <input type="text" id="comment" name="comment" ng-model = "Holidaysmodal.description" placeholder="Description" class="form-control">
                                          <!-- <span class="help-block">Please Enter Rack Id</span> -->
                                      </div>
                                  </div>
                          </div>
                        </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" ng-click="CloseHolidaysModal();">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm"  ng-click="AddHolidays();">
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
  <script type="text/javascript" src="{{url('public/js/controllers/HolidaysController.js')}}"></script>
    <script>
        $(document).ready(function () {


            $("#dateFromFilter").datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
            });

            $("#dateToFilter").datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
            });

                  $("#dateFilter").datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
            });

        });
    </script>
@endsection