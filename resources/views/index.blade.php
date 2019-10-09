@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">dashboard</h2>
                        <!-- <button class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add item</button> -->
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                                <div class="text">
                                    <h2>388,688</h2>
                                    <span>this year</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                                <div class="text">
                                    <h2>1,086</h2>
                                    <span>this week</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-collection-item-9"></i>
                                </div>
                                <div class="text">
                                    <h2>1,060,386</h2>
                                    <span>total</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- RECENT REPORT 2-->
                    <div class="recent-report2">
                        <h3 class="title-3">recent reports</h3>
                        <div class="chart-info">
                            <div class="chart-info__left">
                                <div class="chart-note">
                                    <span class="dot dot--blue"></span>
                                    <span>GE Relays</span>
                                </div>
                                <div class="chart-note">
                                    <span class="dot dot--green"></span>
                                    <span>Other Relays</span>
                                </div>
                            </div>
                            <!-- <div class="chart-info-right">
                                <div class="rs-select2--dark rs-select2--md m-r-10">
                                    <select class="js-select2" name="property">
                                        <option selected="selected">All Properties</option>
                                        <option value="">Products</option>
                                        <option value="">Services</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <div class="rs-select2--dark rs-select2--sm">
                                    <select class="js-select2 au-select-dark" name="time">
                                        <option selected="selected">All Time</option>
                                        <option value="">By Month</option>
                                        <option value="">By Day</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div> -->
                        </div>
                        <div class="recent-report__chart">
                            <canvas id="recent-rep2-chart"></canvas>
                        </div>
                    </div>
                    <!-- END RECENT REPORT 2             -->
                </div>
                <div class="col-lg-6">
                    <div class="au-card chart-percent-card">
                        <div class="au-card-inner">
                            <h3 class="title-2 tm-b-5">char by %</h3>
                            <div class="row no-gutters">
                                <div class="col-xl-6">
                                    <div class="chart-note-wrap">
                                        <div class="chart-note mr-0 d-block">
                                            <span class="dot dot--blue"></span>
                                            <span>GE Relays</span>
                                        </div>
                                        <div class="chart-note mr-0 d-block">
                                            <span class="dot dot--red"></span>
                                            <span>Other Relays</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="percent-chart">
                                        <canvas id="percent-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated slideInLeft infinite slower-5s zmdi-seat"></i>Waiting For Physical Verification</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class="au-task-list js-scrollbar3 ">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Total Boxes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>AK Electricals</td>
                                            <td>5 <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">10</span></td>
                                        </tr>
                                        <tr>
                                            <td>PGCIL - Vadodara</td>
                                            <td>3<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Waiting For Manager Clearence</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class=" ">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Relays</th>
                                            <th>Time Exceeded Relays</th>
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
                <div class="col-lg-6">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated slideInLeft infinite slower-5s zmdi-seat"></i>Waiting For Repair</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class="au-task-list js-scrollbar3 ">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Total Boxes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>AK Electricals</td>
                                            <td>5 <span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">10</span></td>
                                        </tr>
                                        <tr>
                                            <td>PGCIL - Vadodara</td>
                                            <td>3<span class="badge badge-danger badge-fs-15 animated infinite flash slower-5s">5</span> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Waiting For Manager Clearence</h3>

                        </div>
                        <div class="au-task js-list-load">
                            <div class=" ">
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 table-data3-blue">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Relays</th>
                                            <th>Time Exceeded Relays</th>
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

        </div>

           {{-- <div class="row">
                <div class="col-md-6">
                    <h2 class="title-1 m-b-25">Waiting For Physical Verification</h2>
                    <!-- DATA TABLE-->

                </div>                
                <div class="col-md-6">
                    <h2 class="title-1 m-b-25">Waiting for Manager Clearence</h2>
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
                <div class="col-lg-6">
                    <!-- TOP CAMPAIGN-->
                    <div class="top-campaign">
                        <h3 class="title-3 m-b-30">waiting for repair</h3>
                        <div class="table-responsive">
                            <table class="table table-top-campaign">
                                <tbody>
                                    <tr>
                                        <td>1. Australia</td>
                                        <td>70,261</td>
                                    </tr>
                                    <tr>
                                        <td>2. United Kingdom</td>
                                        <td>46,399</td>
                                    </tr>
                                    <tr>
                                        <td>3. Turkey</td>
                                        <td>35,364</td>
                                    </tr>
                                    <tr>
                                        <td>4. Germany</td>
                                        <td>20,366</td>
                                    </tr>
                                    <tr>
                                        <td>5. France</td>
                                        <td>10,366</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END TOP CAMPAIGN-->
                </div>
                <div class="col-lg-6">
                    <!-- TOP CAMPAIGN-->
                    <div class="top-campaign">
                        <h3 class="title-3 m-b-30">out of warrenty</h3>
                        <div class="table-responsive">
                            <table class="table table-top-campaign">
                                <tbody>
                                    <tr>
                                        <td>1. Australia</td>
                                        <td>70,261</td>
                                    </tr>
                                    <tr>
                                        <td>2. United Kingdom</td>
                                        <td>46,399</td>
                                    </tr>
                                    <tr>
                                        <td>3. Turkey</td>
                                        <td>35,364</td>
                                    </tr>
                                    <tr>
                                        <td>4. Germany</td>
                                        <td>20,366</td>
                                    </tr>
                                    <tr>
                                        <td>5. France</td>
                                        <td>10,366</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END TOP CAMPAIGN-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- TOP CAMPAIGN-->
                    <div class="top-campaign">
                        <h3 class="title-3 m-b-30">waiting for packing</h3>
                        <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>type</th>
                                    <th>date</th>
                                    <th>count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow">
                                    <td>Lori Lynch</td>
                                    <td>2018-09-27</td>
                                    <td>679</td>
                                </tr>
                                <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td>Lori Lynch</td>
                                    <td>2018-09-27</td>
                                    <td>679</td>
                                </tr>
                                <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td>Lori Lynch</td>
                                    <td>2018-09-27</td>
                                    <td>679</td>
                                </tr>
                                <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td>Lori Lynch</td>
                                    <td>2018-09-27</td>
                                    <td>679</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <!-- END TOP CAMPAIGN-->
                </div>
                <div class="col-lg-6">
                    <!-- TOP CAMPAIGN-->
                    <div class="top-campaign">
                        <h3 class="title-3 m-b-30">waiting for packing</h3>
                        <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>type</th>
                                    <th>date</th>
                                    <th>price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow">
                                    <td>Lori Lynch</td>
                                    <td>2018-09-27</td>
                                    <td>679</td>
                                </tr>
                                <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td>Lori Lynch</td>
                                    <td>2018-09-272</td>
                                    <td>679</td>
                                </tr>
                                <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td>Lori Lynch</td>
                                    <td>2018-09-27</td>
                                    <td>679</td>
                                </tr>
                                <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td>Lori Lynch</td>
                                    <td>2018-09-27</td>
                                    <td>679</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <!-- END TOP CAMPAIGN-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection