@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style type="text/css">
    .slower-10s{
        animation-duration: 10s;
        animation-delay: 2s;
        animation-iteration-count: infinite;
    }
</style>
<div class="main-content bg" ng-controller="DailyReportController">
    <div class="section__content section__content--p30 " ng-init="GetDashboardValues();">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="overview-wrap">
                        <h2 class="title-1 text-white" id="DashBoard">Daily Dashboard</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="float-right">
                        <button type="button"  class="btn btn-lg btn-light m-l-10 m-b-10" ng-click="GoToReceipt();"><a class="zmdi animated zoomIn  slower zmdi-home "  href="#"></a>
                            <span class="badge badge-light"></span>
                        </button>

                    </div>
                </div>
            </div>

          <!--   <div id="carouselExampleIndicators" class="carousel slide">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active"> -->
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
                                        <!--      <div class="col-sm-5">
                                                 <h3 style="color: white; font-size: 22px;font-weight: 500;">
                                                     Total Relays: <span style="font-weight: bolder;" ng-bind="dashboardvalues.repair_priority.length"></span>
                                                 </h3>
                                             </div> -->
                                         </div>
                                     </div>
                                     <div class="au-task js-list-load">
                                         <div class="au-task-list js-scrollbar3">
                                             <div class="table-responsive m-b-40">
                                                 <table class="table table-borderless table-data3-blue table-data4">
                                                     <thead>
                                                          <?php $dateObj = new DateTime(); $monthName = $dateObj->format('M'); 
                                                          $datenow = $dateObj-> format('d-m-Y');?>
                                                     <tr style="background-color: #333333;color: white;">
                                                         <th>Family</th>
                                                         <th>Number of Relays Received</th>
                                                         <th>Cumulative Relays({{$monthName}})</th>
                                                     </tr>
                                                     </thead>
                                                     <tbody>
                                                     <tr ng-repeat="pr in dashboardvalues.received_relays">
                                                        <td ng-bind="pr.type_name"></td>
                                                        <td ng-bind="pr.total"></td>
                                                        <td ng-bind="pr.cumulative"></td>
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

                                            <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Total Relays Completed<span>({{$datenow}})</span></h3>  

                                    </div>
                                    <div class="au-task js-list-load">
                                        <div class="au-task-list js-scrollbar3">
                                            <div class="table-responsive m-b-40">
                                                <table class="table table-borderless table-data4 table-data4 table-data3-blue">
                                                    <thead>
                                                     <tr style="background-color: #333333;color: white;">
                                                
                                                        <th>Family</th>
                                                        <th>Repair</th>
                                                        <th>Test</th>
                                                        <th>Dispatch</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr ng-repeat="test in dashboardvalues.total_relays_completed">
                                                        <td ng-bind="test.type_name"></td>
                                                        <td ng-bind="test.repair"></td>
                                                        <td ng-bind="test.test"></td>
                                                        <td ng-bind="test.dispatch"></td>
                                                        <td ng-bind="test.total"></td>
                                       
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
                                                <table class="table table-borderless table-data4 table-data3-blue table-data4">
                                                    <thead>
                                                     <tr style="background-color: #333333;color: white;">
                                                        <th>Family</th>
                                                        <th>Repair</th>
                                                        <th>Test</th>
                                                        <th>Dispatch</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr ng-repeat="test in dashboardvalues.total_relays_overdues">
                                                        <td ng-bind="test.type_name"></td>
                                                        <td ng-bind="test.repair"></td>
                                                        <td ng-bind="test.test"></td>
                                                        <td ng-bind="test.dispatch"></td>
                                                        <td ng-bind="test.total"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                 <!--        </div>
                    </div> -->
                    <!-- <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Today And Monthly Status</h3>
                                        <canvas id="TodayStatus"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Repair - Warranty</h3>
                                        <canvas id="Warranty"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="au-card m-b-30 ">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 m-b-40">Repair - Chargable</h3>
                                        <canvas id="OutOfWarranty"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
   <!--                  <div class="carousel-item"> -->
                        <div class="row">
                                       <div class="col-lg-4 h-25">
                                          <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                              <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                                                  <div class="bg-overlay bg-overlay--androidblue"></div>
                                                  <h3>
                                                      <i class="zmdi animated slideInLeft infinite slower-10s zmdi-seat"></i>Total Chargeable Relays</h3>

                                              </div>
                                              <div class="au-task js-list-load">
                                                  <div class="au-task-list js-scrollbar3 ">
                                                      <div class="table-responsive m-b-40">
                                                          <table class="table table-borderless table-data4 table-data3-blue">
                                                              <thead>
                                                              <tr style="background-color: #333333;color: white;">
                                                                  <th>Family</th>
                                                                  <th>Total</th>
                                                              </tr>
                                                              </thead>
                                                              <tbody>
                                                              <tr ng-repeat="test in dashboardvalues.total_chargeable">
                                                                    <td ng-bind="test.type_name"></td>
                                                                    <td ng-bind="test.total"></td>
                                                              </tr>
                                                              </tbody>
                                                          </table>
                                                      </div>

                                                  </div>

                                              </div>
                                          </div>
                                      </div>
                           
                            <div class="col-lg-4 h-25">
                                <div class="au-card au-card--no-shadow au-card--no-pad ">
                                    <div class="au-card-title"  >
                                        <div class="bg-overlay bg-overlay--androidblue"></div>
                                        <h3>
                                            <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Warranty Overdue</h3>

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
                                               <tr ng-repeat="test in dashboardvalues.warranty_overdue">
                                                                    <td ng-bind="test.type_name"></td>
                                                                    <td ng-bind="test.total"></td>
                                                              </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- END DATA TABLE -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                  <!--       </div>
                    </div> -->
                    <!-- <div class="carousel-item"> -->
                       <!--  <div class="row"> -->
                           <div class="col-lg-4 h-25">
                              <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                  <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                                      <div class="bg-overlay bg-overlay--androidblue"></div>
                                      <h3>
                                          <i class="zmdi animated slideInLeft infinite slower-10s zmdi-seat"></i>Repair Lead Time</h3>
                                  </div>
                                  <div class="au-task js-list-load">
                                      <div class="au-task-list js-scrollbar3 ">
                                          <div class="table-responsive">
                                              <table class="table table-borderless table-data4 table-data3-blue">
                                                  <thead>
                                                    <tr style="background-color: #333333;color: white;">
                                                      <th>Type / Category</th>
                                                      <th>Days</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                  <tr ng-repeat="rc in dashboardvalues.repair_lead_time">
                                                   <td ng-bind="rc.type_name | uppercase"></td>
                                                                    <td ng-bind="rc.average  | number : 1"></td>
                                                  </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                             <div class="col-lg-6 h-25">
                                 <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                     <div class="au-card-title"  >
                                         <div class="bg-overlay bg-overlay--androidblue"></div>
                                   <?php $dateObj = new DateTime(); $monthName = $dateObj->format('M');?>
                                         <h3>
                                             <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Total Completed ({{$monthName}})</h3>

                                     </div>
                                     <div class="au-task js-list-load">
                                         <div class="au-task-list js-scrollbar3">
                                             <div class="table-responsive m-b-40">
                                                 <table class="table table-borderless table-data4 table-data3-blue">
                                                     <thead>
                                                    <tr style="background-color: #333333;color: white;">
                                                         <th>Conventional</th>
                                                         <th>Numerical</th>
                                                         <th>Multilin</th>
                                                         <th>Reason</th>
                                                         <th>BOJ</th>
                                                         <th>Total</th>
                                                     </tr>
                                                     </thead>
                                                     <tbody>
                                                     <tr>
                                                         <td ng-bind="dashboardvalues.total_completed.CONVENTIONAL"></td>
                                                         <td ng-bind="dashboardvalues.total_completed.NUMERICAL"></td>
                                                         <td ng-bind="dashboardvalues.total_completed.MULTILIN"></td>
                                                         <td ng-bind="dashboardvalues.total_completed.REASON"></td>
                                                         <td ng-bind="dashboardvalues.total_completed.BOJ"></td>
                                                         <td ng-bind="dashboardvalues.total_completed.total"></td>
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
            <!-- modal small -->
            <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="smallmodalLabel">Relay Stage</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col col-3">
                                    <p><b>R Id:</b></p>
                                </div>
                                <div class="col col-6">
                                     <p style="font-weight: 500;" ng-bind="modal.formatted_pv_id"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-3">
                                    <p><b>Serial No:</b></p>
                                </div>
                                <div class="col col-6">
                                     <p style="font-weight: 500;" ng-bind="modal.serial_no"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-3">
                                    <p><b>Current Stage:</b></p>
                                </div>
                                <div class="col col-6">
                                     <p style="font-weight: 500;" ng-bind="modal.stage"></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" ng-click="OnHoverLeaveStage();">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal small -->
            <!-- modal medium -->
            <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel" ng-bind="overdueModal.title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- TOP CAMPAIGN-->
                                <div class="top-campaign">
                                    <h3 class="title-3 m-b-30">Relay Serial Nos.</h3>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <tbody>
                                                <tr ng-repeat="list in overdueModal.serial_no_list track by $index">
                                                    <td style="text-align: left;"><span ng-bind="$index+1"></span><span>.</span> <span ng-bind="list"></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--  END TOP CAMPAIGN-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal medium -->
        </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{url('public/js/controllers/DailyReportController.js')}}"></script>
    <script>
        $(document).ready(function () {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementsByClassName("page-container")[0].style.paddingLeft = "0px";
            document.getElementById("headerID").style.display = "none";
            document.getElementsByClassName("main-content")[0].style.paddingTop = "25px";
        });
    </script>

@endsection