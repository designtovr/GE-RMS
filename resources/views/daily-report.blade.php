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
      <!--                     <button type="button" class="btn btn-lg btn-danger m-l-10 m-b-10 animated infinite flash slower-10s">Live
                            <span class="badge badge-light"></span></button> -->

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
                                                     <tr style="background-color: #333333;color: white;">
                                                         <th>Family</th>
                                                         <th>Number of Relays Received</th>
                                                         <th>Cumulative Relays</th>
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
                                            <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Total Relays Completed </h3> 

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
<!--                           <div class="col-lg-4">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title"  >
                                        <div class="bg-overlay bg-overlay--androidblue"></div>
                                        <div class="row">
                                             <div class="col-sm-6">
                                                 <h3>
                                                    <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Repair
                                                </h3>
                                             </div> -->
                                             <!-- <div class="col-sm-6">
                                                 <h3 style="color: red; font-weight: bolder; font-size: 28px;">
                                                     Total Relays: <span ng-bind="dashboardvalues.total_overdue.for_repair"></span>
                                                 </h3>
                                             </div> -->
                 <!--                         </div>
                                    </div>
                                    <div class="au-task js-list-load">
                                        <div class="au-task-list js-scrollbar3">
                                            <div class="table-responsive m-b-40">
                                                <table class="table table-borderless table-data3 table-data4 table-data3-blue">
                                                    <thead>
                                                    <tr>
                                                        <th>Family</th>
                                                        <th>Total Relays</th>
                                                        <th>Over Due</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr ng-repeat="repair in dashboardvalues.for_repair track by $index">
                                                        <td ng-bind="repair.type_name"></td>
                                                        <td ng-bind="repair.total"></td>
                                                        <td style="cursor: pointer;" ng-click="ShowOverDueList('Repair',repair);"> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-10s" ng-bind="repair.overdue"></span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            END DATA TABLE -->
                                       <!--  </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
         <!--            </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div> -->

        </div>
           <!--  <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header" style="background: -webkit-linear-gradient(90deg, #001235 0%, #0259b5 100%) !important">
                            <strong class="card-title text-light" style="color: white">Live Updates
                            </strong>
                        </div>
                        <div class="card-body">
                            <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel" data-interval="10000">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators1" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators1" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators1" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <h3 class="card-title">Physical Verification:</h3>
                                        <br>
                                        <h4 style="cursor: pointer;" ng-click="ShowTotalOverdue('Physical Verification', dashboardvalues.total_overdue.for_pv_due_list)">Total Overdues: <b ><span class="badge-danger badge-fs-25 animated infinite flash slower-10s p-md-l-10 p-md-r-10 p-md-t-10 p-md-b-10" ng-bind="dashboardvalues.total_overdue.for_pv"></span></b></h4>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="carousel-item">
                                        <h3 class="card-title">W/Ch. Declaration:</h3>
                                        <br>
                                        <h4 style="cursor: pointer;" ng-click="ShowTotalOverdue('W/Ch', dashboardvalues.total_overdue.wch_due_list)">Total Overdues: <b ><span class="badge-danger badge-fs-25 animated infinite flash slower-10s p-md-l-10 p-md-r-10 p-md-t-10 p-md-b-10" ng-bind="dashboardvalues.total_overdue.wch" ></span></b></h4>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="carousel-item">
                                        <h3 class="card-title">Testing:</h3>
                                        <br>
                                        <h4 style="cursor: pointer;" ng-click="ShowTotalOverdue('Test', dashboardvalues.total_overdue.for_test_due_list)">Total Overdues: <b class="" ><span class="badge-danger badge-fs-25 animated infinite flash slower-10s p-md-l-10" ng-bind="dashboardvalues.total_overdue.for_test">2</span></b></h4>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->
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