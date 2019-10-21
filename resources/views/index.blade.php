@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="main-content" ng-controller="DashBoardController">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1" id="DashBoard">CRC Dashboard</h2>
                        <!-- <button class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add item</button> -->
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-lg btn-danger m-l-10 m-b-10 animated infinite flash slower-5s">Live
                          <span class="badge badge-light"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 h-25">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated slideInLeft infinite slower-5s zmdi-seat"></i>For Physical Verification</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class="au-task-list js-scrollbar3 ">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Total Boxes</th>
                                            <th>Over Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>AK Electricals</td>
                                            <td>5 </td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">10</span></td>
                                        </tr>
                                        <tr>
                                            <td>PGCIL - Vadodara</td>
                                            <td>5 </td>

                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 h-25">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>For W/Ch. Decleration</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class=" ">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Relays</th>
                                            <th>Over Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PX40</td>
                                            <td>5</td>
                                            <td> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">2</span></td>
                                        </tr>
                                        <tr>
                                            <td>C264</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Conventional</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Other</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>BOJ</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>For Test</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class=" ">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Relays</th>
                                            <th>Over Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PX40</td>
                                            <td>5</td>
                                            <td> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">2</span></td>
                                        </tr>
                                        <tr>
                                            <td>C264</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Conventional</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Other</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>BOJ</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>For Packing</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class=" ">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Relays</th>
                                            <th>Over Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PX40</td>
                                            <td>5</td>
                                            <td> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">2</span></td>
                                        </tr>
                                        <tr>
                                            <td>C264</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Conventional</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Other</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>BOJ</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

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

            <div class="row">

                <div class="col-lg-3">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-40">Today And Monthly Status</h3>
                            <canvas id="TodayStatus"></canvas>
                        </div>
                    </div>
                </div>



                <div class="col-lg-3">
                    <div class="au-card m-b-30">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-40">Repair - Warranty</h3>
                            <canvas id="Warranty"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="au-card m-b-30 ">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-40">Repair - Chargable</h3>
                            <canvas id="OutOfWarranty"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Repair Priority List</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class=" ">
                                <div class="table-responsive table-height200">
                                    <table class="table table-borderless table-data3 table-data3-blue table-height200">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Serial Number</th>
                                            <th>Location</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PX40</td>
                                            <td>43976987</td>
                                            <td>R2</td>
                                        </tr>
                                        <tr>
                                            <td>PX40</td>
                                            <td>43976987</td>
                                            <td>R2</td>
                                        </tr>    <tr>
                                            <td>PX40</td>
                                            <td>43976987</td>
                                            <td>R2</td>
                                        </tr>

                                        <tr>
                                            <td>C264</td>
                                            <td>328946598</td>
                                            <td>C4</td>

                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td>23578230</td>
                                            <td>R45</td>

                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td>23578230</td>
                                            <td>R45</td>

                                        </tr> <tr>
                                            <td>Agile</td>
                                            <td>23578230</td>
                                            <td>R45</td>

                                        </tr>
                                        <tr>
                                            <td>Conventional</td>
                                            <td>238230</td>
                                            <td>R4</td>
                                        </tr>
                                        <tr>
                                            <td>Other</td>
                                            <td>237598</td>
                                            <td>R3</td>

                                        </tr>
                                        <tr>
                                            <td>BOJ</td>
                                            <td>29385698</td>
                                            <td>R46</td>

                                        </tr>
                                        <tr>
                                            <td>BOJ</td>
                                            <td>29385698</td>
                                            <td>R46</td>

                                        </tr>          <tr>
                                            <td>BOJ</td>
                                            <td>29385698</td>
                                            <td>R46</td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>
                    </div>
                </div>
    {{--            <div class="col-lg-3">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>For Packing</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class=" ">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Relays</th>
                                            <th>Over Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PX40</td>
                                            <td>5</td>
                                            <td> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">2</span></td>
                                        </tr>
                                        <tr>
                                            <td>C264</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Conventional</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>Other</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>
                                        <tr>
                                            <td>BOJ</td>
                                            <td>10</td>
                                            <td> 0<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s"></span></td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>
                    </div>
                </div>--}}
               {{-- <div class="col-lg-3 h-25">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated slideInLeft infinite slower-5s zmdi-seat"></i>For Repair</h3>

                        </div>
                        <div class="p-l-20 p-r-10 p-b-10 p-t-10" style="background:#000; color: #fff">
                            <h5>
                                <i class="zmdi animated fade-in infinite slow zmdi-plus-box"></i>
                                Warranty</h5>
                        </div>
                        <div class="au-task js-list-load">
                            <div class="au-task-list js-scrollbar3 h-auto">
                                <div class="table-responsive m-b-10">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Relays</th>

                                            <th>Over Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PX40</td>
                                            <td>4</td>
                                            <td> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">10</span></td>
                                        </tr>
                                        <tr>
                                            <td>C264</td>
                                            <td>3</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td>3</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>

                        <div class="p-l-20 p-r-10 p-b-10 p-t-10" style="background:#000; color: #fff">
                            <h5>
                                <i class="zmdi animated fade-in infinite slow zmdi-plus-box"></i>
                                Out of Warranty</h5>
                        </div>
                        <div class="au-task js-list-load">
                            <div class="au-task-list js-scrollbar3 h-auto">
                                <div class="table-responsive m-b-10">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Relays</th>
                                            <th>Over Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PX40</td>
                                            <td>3</td>
                                            <td> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">10</span></td>
                                        </tr>
                                        <tr>
                                            <td>C264</td>
                                            <td>3</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td>3</td>

                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        <tr>
                                            <td>OMU</td>
                                            <td>3</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        <tr>
                                            <td>BOJ</td>
                                            <td>3</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 h-25">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated slideInLeft infinite slower-5s zmdi-seat"></i>For Repair</h3>

                        </div>
                        <div class="p-l-20 p-r-10 p-b-10 p-t-10" style="background:#000; color: #fff">
                            <h5>
                                <i class="zmdi animated fade-in infinite slow zmdi-plus-box"></i>
                                Warranty</h5>
                        </div>
                        <div class="au-task js-list-load">
                            <div class="au-task-list js-scrollbar3 h-auto">
                                <div class="table-responsive m-b-10">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Relays</th>
                                            <th>Over Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PX40</td>
                                            <td>3</td>
                                            <td> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">10</span></td>
                                        </tr>
                                        <tr>
                                            <td>C264</td>
                                            <td>3</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td>3</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>

                        <div class="p-l-20 p-r-10 p-b-10 p-t-10" style="background:#000; color: #fff">
                            <h5>
                                <i class="zmdi animated fade-in infinite slow zmdi-plus-box"></i>
                                Out of Warranty</h5>
                        </div>
                        <div class="au-task js-list-load">
                            <div class="au-task-list js-scrollbar3 h-auto">
                                <div class="table-responsive m-b-10">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Over Due</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>PX40</td>
                                            <td> <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">10</span></td>
                                        </tr>
                                        <tr>
                                            <td>C264</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        <tr>
                                            <td>Agile</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        <tr>
                                            <td>OMU</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        <tr>
                                            <td>BOJ</td>
                                            <td><span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>
                    </div>
                </div>--}}
            </div>

        </div>
           {{-- <div class="row">
                <div class="col-md-6">
                    <h2 class="title-1 m-b-25">For Physical Verification</h2>
                    <!-- DATA TABLE-->

                </div>                
                <div class="col-md-6">
                    <h2 class="title-1 m-b-25"> For W/C Decleration</h2>
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>type</th>
                                    <th>date</th>
                                    <th>count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mobile</td>
                                    <td>2018-09-29</td>
                                    <td>999</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>2018-09-29</td>
                                    <td>999</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>2018-09-29</td>
                                    <td>999</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>2018-09-29</td>
                                    <td>999</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>2018-09-29</td>
                                    <td>999</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>2018-09-29</td>
                                    <td>999</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>2018-09-29</td>
                                    <td>999</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>2018-09-29</td>
                                    <td>999</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>--}}


            <div class="row">



            <div class="col-lg-3">
                <div class="au-card col-lg-12 m-b-30">
                    <div class="au-card-inner">
                        <h3 class="title-2 m-b-40">OTD</h3>
                        <div class="d-inline-block">
                            <div class="p-l-120">
                        <h6 class=" ">Numerical Relays - 75%</h6>
                        <canvas id="doughChart"></canvas>
                        </div>
                {{--            <div class="m-l-10 ">
                        <h6 class=" ">Conventional Relays - 85%</h6>
                        <canvas id="doughChart1"></canvas>
                        </div>--}}
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-lg-3">
            <div class="au-card col-lg-12 m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">OTD</h3>
                    <div class="d-inline-block">
                 {{--       <div class=" ">
                            <h6 class=" ">Numerical Relays - 75%</h6>
                            <canvas id="doughChart"></canvas>
                        </div>--}}
                        <div class="p-l-120 ">
                            <h6 class=" ">Conventional Relays - 85%</h6>
                            <canvas id="doughChart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header" style="background-color: #dc3545">
                    <strong class="card-title text-light" style="color: white">Live Updates
                    </strong>
                </div>
                <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <h3 class="card-title">Physical Verification:</h3>
                          <br>
                          <h4>Total Overdues: <b>15</b></h4>
                          <br>
                          <br>
                          <br>
                          <br>
                          <br>
                        </div>
                        <div class="carousel-item">
                          <h3 class="card-title">W/Ch. Declaration:</h3>
                          <br>
                          <h4>Total Overdues: <b>2</b></h4>
                          <br>
                          <br>
                          <br>
                          <br>
                          <br>
                        </div>
                        <div class="carousel-item">
                          <h3 class="card-title">For Testing:</h3>
                          <br>
                          <h4>Total Overdues: <b>2</b></h4>
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