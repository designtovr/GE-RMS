<!DOCTYPE html>
<html>
<head>
    <title>Daily Report</title>

    <link rel="stylesheet" type="text/css" href="{{url('public/css/theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="main-content">
    <div class="section__content section__content--p30 ">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="overview-wrap">
                    <h2 class="title-1 text-white" id="DashBoard">Daily Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 h-25">
               <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                   <div class="au-card-title"  >
                       <div class="bg-overlay bg-overlay--androidblue"></div>
                       <div class="row">
                           <div class="col-sm-7">
                               <h3>
                                   <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Received Relays
                               </h3>
                           </div>
                       </div>
                   </div>
                   <div class="au-task js-list-load">
                       <div class="au-task-list js-scrollbar3">
                           <div class="table-responsive m-b-40">
                               <table class="table table-borderless table-data3-blue table-data4">
                                   <thead>
                                       <tr style="background-color: #333333;color: white;">
                                           <th>Family</th>
                                           <th>Number of Relays Received</th>
                                           <th>Cumulative Relays</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr ng-repeat="pr in dashboardvalues.repair_priority">
                                        <td ng-bind="pr.type_name"></td>
                                        <td ng-bind="pr.serial_no" style="cursor: pointer;" ng-click="OnHoverShowStage(pr);"></td>
                                        <td ng-bind="pr.rack_id"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                <div class="au-card-title"  >
                    <div class="bg-overlay bg-overlay--androidblue"></div>
                    <h3>
                        <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Total Relays Completed</h3>

                    </div>
                    <div class="au-task js-list-load">
                        <div class="au-task-list js-scrollbar3">
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3 table-data4 table-data3-blue">
                                    <thead>
                                        <tr>
                                            <th>Family</th>
                                            <th>Repair</th>
                                            <th>Test</th>
                                            <th>Dispatch</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="test in dashboardvalues.for_test">
                                            <td ng-bind="test.type_name"></td>
                                            <td ng-bind="test.total"></td>
                                            <td style="cursor: pointer;" ng-click="ShowOverDueList('Test',test);"> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-10s" ng-bind="test.overdue"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE -->
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                    <div class="au-card-title"  >
                        <div class="bg-overlay bg-overlay--androidblue"></div>
                        <h3>
                            <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Total Relays OverDue</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class="au-task-list js-scrollbar3">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue table-data4">
                                        <thead>
                                            <tr>
                                                <th>Family</th>
                                                <th>Repair</th>
                                                <th>Test</th>
                                                <th>Dispatch</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="pack in dashboardvalues.for_pack">
                                                <td ng-bind="pack.type_name"></td>
                                                <td ng-bind="pack.total"></td>
                                                <td  style="cursor: pointer;" ng-click="ShowOverDueList('Dispatch',pack);"> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-10s" ng-bind="pack.overdue"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                 <div class="col-lg-4 h-25">
                  <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                      <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                          <div class="bg-overlay bg-overlay--androidblue"></div>
                          <h3>
                              <i class="zmdi animated slideInLeft infinite slower-10s zmdi-seat"></i>Total Chargeable</h3>

                          </div>
                          <div class="au-task js-list-load">
                              <div class="au-task-list js-scrollbar3 ">
                                  <div class="table-responsive m-b-40">
                                      <table class="table table-borderless table-data3 table-data3-blue">
                                          <thead>
                                              <tr>
                                                  <th>Family</th>
                                                  <th>Total</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr ng-repeat="forpv in dashboardvalues.for_physical_verification">
                                                  <td ng-bind="forpv.customer_name | uppercase"></td>
                                                  <td ng-bind="forpv.total"></td>
                                                  <td style="cursor: pointer;" ng-click="ShowOverDueList('Physical Verification',forpv);"><span class="badge badge-danger badge-fs-15 animated infinite flash slower-10s" ng-bind="forpv.overdue"></span></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>

                              </div>

                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 h-25">
                   <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                       <div class="au-card-title"  >
                           <div class="bg-overlay bg-overlay--androidblue"></div>
                           <h3>
                               <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Total Completed</h3>

                           </div>
                           <div class="au-task js-list-load">
                               <div class="au-task-list js-scrollbar3">
                                   <div class="table-responsive m-b-40">
                                       <table class="table table-borderless table-data3 table-data3-blue">
                                           <thead>
                                               <tr>
                                                   <th>Completed</th>
                                                   <th>Numerical</th>
                                                   <th>Multilin</th>
                                                   <th>Recent</th>
                                                   <th>BOJ</th>
                                                   <th>Total</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <tr ng-repeat="forwc in dashboardvalues.wch">
                                                   <td ng-bind="forwc.type_name"></td>
                                                   <td ng-bind="forwc.total"></td>
                                                   <td style="cursor: pointer;" ng-click="ShowOverDueList('W/Ch Declaration',forwc);"> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-10s" ng-bind="forwc.overdue"></span></td>
                                               </tr>
                                           </tbody>
                                       </table>
                                   </div>

                               </div>

                           </div>
                       </div>
                   </div>
                   <div class="col-lg-4">
                    <div class="au-card au-card--no-shadow au-card--no-pad ">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Warranty  Overdue</h3>

                            </div>
                            <div class="au-task js-list-load">
                                <div class="au-task-list js-scrollbar3">
                                    <div class="table-responsive m-b-40">
                                        <table class="table table-borderless table-data4 table-data3-blue">
                                            <thead>
                                                <tr style="background-color: #333333;color: white;">
                                                    <th>Family</th>
                                                    <th>Overdues</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="pr in dashboardvalues.priority">
                                                    <td ng-bind="pr.type_name"></td>
                                                    <td style="cursor: pointer;" ng-bind="pr.serial_no" ng-click="OnHoverShowStage(pr);"></td>
                                                    <td ng-bind="pr.rack_id"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- END DATA TABLE -->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 h-25">
                      <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                          <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                              <div class="bg-overlay bg-overlay--androidblue"></div>
                              <h3>
                                  <i class="zmdi animated slideInLeft infinite slower-10s zmdi-seat"></i>Repair Lead Time</h3>
                              </div>
                              <div class="au-task js-list-load">
                                  <div class="au-task-list js-scrollbar3 ">
                                      <div class="table-responsive m-b-40">
                                          <table class="table table-borderless table-data3 table-data3-blue">
                                              <thead>
                                                  <tr>
                                                      <th>Type / Category</th>
                                                      <th>Days</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr ng-repeat="rc in dashboardvalues.receipt">
                                                      <td ng-bind="rc.customer_name | uppercase"></td>
                                                      <td ng-bind="rc.total_boxes"></td>
                                                      <td ng-bind="rc.status"></td>
                                                      <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-10s" ng-bind="rc.DateDiff"></span></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
          </div>
    </div>
</div>
</body>
</html>
