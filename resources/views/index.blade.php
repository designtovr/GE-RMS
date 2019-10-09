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
                                            <th>Time Exceeded Relays</th>
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
                                            <th>Time Exceeded Relays</th>
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
                </div>
                <div class="col-lg-6">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated slideInLeft infinite slower-5s zmdi-seat"></i>Waiting For Repair</h3>

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
                                            <th>Time Exceeded Relays</th>
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
                                            <th>Time Exceeded Relays</th>
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
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Waiting For Test</h3>

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
                <div class="col-lg-6">
                    <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                        <div class="au-card-title"  >
                            <div class="bg-overlay bg-overlay--androidblue"></div>
                            <h3>
                                <i class="zmdi animated zoomIn infinite slower zmdi-assignment-alert"></i>Waiting For Packing</h3>

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
        <div class="row">
            <div class="col-lg-6">
                <div class="">{{--au-card au-card--no-shadow au-card--no-pad m-b-40--}}
                    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                        <div class="bg-overlay bg-overlay--androidblue"></div>
                        <h3>
                            <i class="zmdi animated slideInLeft infinite slower-5s zmdi-seat"></i>Today Status</h3>

                    </div>
                        <div class="overview-item overview-item--c2 m-b-0">
                            <div class="overview__inner">
                                <div class="text">
                                    <h2 style = "color: #fff;">Completed Relays</h2>
                                </div>
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                    <div class="text">
                                        <h2>30</h2>
                                        <h4 style = "color: #fff;">Numerical Relays</h4>
                                    </div>
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-calendar-note"></i>
                                        </div>
                                        <div class="text">
                                            <h2>15</h2>
                                            <h4 style = "color: #fff;">Conventional Relays</h4>
                                        </div>
                                    </div></div>

                            </div>
                        </div>
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="text">
                                    <h2 style = "color: #fff;">Pending Relays</h2>
                                </div>
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                    <div class="text">
                                        <h2>5</h2>
                                        <h4 style = "color: #fff;">Numerical Relays</h4>
                                    </div>
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-calendar-note"></i>
                                        </div>
                                        <div class="text">
                                            <h2>6</h2>
                                            <h4 style = "color: #fff;">Conventional Relays</h4>
                                        </div>
                                    </div></div>

                            </div>

                        </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="">{{--au-card au-card--no-shadow au-card--no-pad m-b-40--}}
                    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');" >
                        <div class="bg-overlay bg-overlay--androidblue"></div>
                        <h3>
                            <i class="zmdi animated slideInLeft infinite slower-5s zmdi-seat"></i>Monthly Status</h3>

                    </div>
                    <div class="overview-item overview-item--c2 m-b-0">
                        <div class="overview__inner">
                            <div class="text">
                                <h2 style = "color: #fff;">Completed Relays</h2>
                            </div>
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                                <div class="text">
                                    <h2>30</h2>
                                    <h4 style = "color: #fff;">Numerical Relays</h4>
                                </div>
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                    <div class="text">
                                        <h2>15</h2>
                                        <h4 style = "color: #fff;">Conventional Relays</h4>
                                    </div>
                                </div></div>

                        </div>
                    </div>
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="text">
                                <h2 style = "color: #fff;">Pending Relays</h2>
                            </div>
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                                <div class="text">
                                    <h2>5</h2>
                                    <h4 style = "color: #fff;">Numerical Relays</h4>
                                </div>
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                    <div class="text">
                                        <h2>6</h2>
                                        <h4 style = "color: #fff;">Conventional Relays</h4>
                                    </div>
                                </div></div>

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

        <div class="row m-t-25">


        </div>

        <div class ="row">
            <div class="col-sm-6 col-lg-4">
                <div class="overview-item overview-item--c4">
                    <div class="overview__inner">
                        <div class="text">
                            <h2 style = "color: #fff;">OTD</h2>
                        </div>
                        <div class="overview-box clearfix">

                            <div class="text">
                                <h2>80%</h2>
                                <h4 style = "color: #fff;">Numerical Relays</h4>
                            </div>


                        </div>
                        <div class="overview-box clearfix">


                        <div class="text">
                            <h2>92%</h2>
                            <h4 style = "color: #fff;">Conventional Relays</h4>
                        </div>
                        </div>
                        <div class="overview-chart">
                            <canvas id="widgetChart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
@endsection