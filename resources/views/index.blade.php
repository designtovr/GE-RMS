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
<div class="main-content bg" ng-controller="DashBoardController">
    <div class="section__content section__content--p30 " ng-init="GetDashboardValues();">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="overview-wrap">
                        <h2 class="title-1 text-white" id="DashBoard">CRC Dashboard</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="float-right">
                        <button type="button"  class="btn btn-lg btn-light m-l-10 m-b-10 " ng-click="GoToReceipt();"><a class="zmdi animated zoomIn  slower zmdi-home "  href="#"></a>
                            <span class="badge badge-light"></span>
                        </button>
                        <button type="button" class="btn btn-lg btn-danger m-l-10 m-b-10 animated infinite flash slower-10s">Live
                            <span class="badge badge-light"></span></button>

                        </div>
                    </div>
                </div>

                <div id="carouselExampleIndicators" class="carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <!-- <li data-target="#carouselExampleIndicators" data-slide-to="1"></li> -->
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-lg-4 h-25">
                                   <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                       <div class="au-card-title"  >
                                           <div class="bg-overlay bg-overlay--androidblue"></div>
                                           <div class="row">
                                               <div class="col-sm-7">
                                                   <h3>
                                                       <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Repair Priority
                                                   </h3>
                                               </div>
                                               <div class="col-sm-5">
                                                   <h3 style="color: white; font-size: 22px;font-weight: 500;">
                                                       Total Relays: <span style="font-weight: bolder;" ng-bind="dashboardvalues.repair_priority.length"></span>
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
                                                               <th>Serial Number</th>
                                                               <th>Location</th>
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
                                        <div class="row">
                                           <div class="col-sm-7">
                                               <h3>
                                                   <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Test and Aging
                                               </h3>
                                           </div>
                                           <div class="col-sm-5">
                                               <h3 style="color: white; font-size: 22px;font-weight: 500;">
                                                   Total Relays: <span style="font-weight: bolder;" ng-bind="dashboardvalues.total_overdue.for_test"></span>
                                               </h3>
                                           </div>
                                       </div>
                                  <!--       <h3>
                                    <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i></h3> -->

                                </div>
                                <div class="au-task js-list-load">
                                    <div class="au-task-list js-scrollbar3">
                                        <div class="table-responsive m-b-40">
                                            <table class="table table-borderless table-data3-blue table-data4">
                                                <thead>
                                                    <tr style="background-color: #333333;color: white;"> 
                                                        <th>Family</th>
                                                        <th>Total Relays</th>
                                                        <th>Overdue Relays</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="test in dashboardvalues.for_test">
                                                        <td ng-bind="test.type_name"></td>
                                                        <td ng-bind="test.total"></td>
                                                        <td style="cursor: pointer;" ng-click="ShowOverDueList('Testing and Aging',test);"> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-10s" ng-bind="test.overdue"></span></td>
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
                                    <div class="row">
                                       <div class="col-sm-7">
                                           <h3>
                                               <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Dispatch 
                                           </h3>
                                       </div>
                                       <div class="col-sm-5">
                                           <h3 style="color: white; font-size: 22px;font-weight: 500;">
                                               Total Relays: <span style="font-weight: bolder;" ng-bind="dashboardvalues.total_overdue.for_pack"></span>
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
                                                    <th>Total Relays</th>
                                                    <th>Over Due</th>
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
                </div>
            </div>
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
                    <div class="carousel-item">
                        <div class="row">
                         <div class="col-lg-4 h-25">
                          <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                              <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                                  <div class="bg-overlay bg-overlay--androidblue"></div>
                                  <div class="row">
                                   <div class="col-sm-7">
                                       <h3>
                                           <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Physical Verification 
                                       </h3>
                                   </div>
                                   <div class="col-sm-5">
                                       <h3 style="color: white; font-size: 22px;font-weight: 500;">
                                           Total Relays: <span style="font-weight: bolder;" ng-bind="dashboardvalues.for_physical_verification.length"></span>
                                       </h3>
                                   </div>
                               </div>

                           </div>
                           <div class="au-task js-list-load">
                              <div class="au-task-list js-scrollbar3 ">
                                  <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3-blue table-data4">
                                      <thead>
                                          <tr style="background-color: #333333;color: white;">
                                              <th>Customer</th>
                                              <th>Boxes Qty</th>
                                              <th>Overdue Days</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr ng-repeat="forpv in dashboardvalues.for_physical_verification">
                                              <td ng-bind="forpv.customer_name | uppercase"></td>
                                              <td ng-bind="forpv.total_boxes"></td>
                                              <td style="cursor: pointer;"  ><!-- ng-click="ShowOverDueList('Physical Verification',forpv);" --><span class="badge badge-danger badge-fs-15 animated infinite flash slower-10s" ng-bind="forpv.overdue_days"></span></td>
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
                       <div class="row">
                           <div class="col-sm-7">
                               <h3>
                                   <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>W/Ch. Declerations 
                               </h3>
                           </div>
                           <div class="col-sm-5">
                               <h3 style="color: white; font-size: 22px;font-weight: 500;">
                                   Total Relays: <span style="font-weight: bolder;" ng-bind="dashboardvalues.total_overdue.wch"></span>
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
                                   <th>Total Relays</th>
                                   <th>Overdue Relays</th>
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
    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
        <div class="au-card-title"  >
            <div class="bg-overlay bg-overlay--androidblue"></div>
            <div class="row">
               <div class="col-sm-7">
                   <h3>
                       <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Customer Priority 
                   </h3>
               </div>
               <div class="col-sm-5">
                   <h3 style="color: white; font-size: 22px;font-weight: 500;">
                       Total Relays: <span style="font-weight: bolder;" ng-bind="dashboardvalues.priority.length"></span>
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
                        <th>S.No</th>
                        <th>Overall Overdue Days</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="pr in dashboardvalues.priority">
                        <td ng-bind="pr.type_name"></td>
                        <td style="cursor: pointer;" ng-bind="pr.serial_no"></td>
                        <td ng-bind="pr.overall_due"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
    </div>

</div>
</div>
</div>
</div>
</div>
<div class="carousel-item">
    <div class="row">
     <div class="col-lg-4 h-25">
      <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
          <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
              <div class="bg-overlay bg-overlay--androidblue"></div>
              <div class="row">
               <div class="col-sm-7">
                   <h3>
                       <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Receipt 
                   </h3>
               </div>
               <div class="col-sm-5">
                   <h3 style="color: white; font-size: 22px;font-weight: 500;">
                       Total Relays: <span style="font-weight: bolder;" ng-bind="dashboardvalues.receipt.length"></span>
                   </h3>
               </div>
           </div>
       </div>
       <div class="au-task js-list-load">
          <div class="au-task-list js-scrollbar3 ">
              <div class="table-responsive m-b-40">
                 <table class="table table-borderless table-data3-blue table-data4">
                  <thead>
                      <tr style="background-color: #333333;color: white;">
                          <th>Customer</th>
                          <th>Total Boxes</th>
                          <th>Overdue Days</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr ng-repeat="rc in dashboardvalues.receipt">
                          <td ng-bind="rc.customer_name | uppercase"></td>
                          <td ng-bind="rc.total_boxes"></td>
                          <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-10s" ng-bind="rc.DateDiff"></span></td>
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
            <div class="row">
               <div class="col-sm-7">
                   <h3>
                       <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Repair
                   </h3>
               </div>
               <div class="col-sm-5">
                   <h3 style="color: white; font-size: 22px;font-weight: 500;">
                       Total Relays: <span style="font-weight: bolder;" ng-bind="dashboardvalues.for_repair.total"></span>
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
                        <th>Total Relays</th>
                        <th>Overdue Relays  </th>
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
        <!-- END DATA TABLE -->
    </div>
</div>
</div>
</div>
</div>
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
<div class="row">
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
                            <h3 class="card-title">Testing and Aging:</h3>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel" ng-bind="overdueModal.title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>R Id</th>
                            <th>Family</th>
                            <th>S.No</th>
                            <th>Stage Overdue Days</th>
                            <th>Overall Overdue Days</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="list in overdueModal.serial_no_list track by $index">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="list.formatted_pv_id"></td>
                            <td ng-bind="list.product_family"></td>
                            <td ng-bind="list.serial_no"></td>
                            <td ng-bind="list.stage_overdue"></td>
                            <td ng-bind="list.overall_due"></td>
                        </tr>
                    </tbody>
                </table>
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
<script type="text/javascript" src="{{url('public/js/controllers/DashBoardController.js')}}"></script>
<script>
    $(document).ready(function () {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementsByClassName("page-container")[0].style.paddingLeft = "0px";
        document.getElementById("headerID").style.display = "none";
        document.getElementsByClassName("main-content")[0].style.paddingTop = "25px";
    });
</script>

@endsection