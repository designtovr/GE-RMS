    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="ge">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>GE-RMS - @yield('title')</title>

    <!-- Fontfaces CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('public/css/theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/animate.css')}}">
    <link href="{{url('public/css/font-face.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{url('public/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" media="all">
    <link href="{{url('public/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{url('public/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{url('public/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/nprogress/nprogress.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/jquery-ui/themes/ui-lightness/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.standalone.min.css')}}">
    <link rel="stylesheet/less" type="text/css" href="{{'public/js/bootstrap-less/bootstrap/dropdowns.less'}}" />
    <link rel="stylesheet/less" type="text/css" href="{{'public/js/bootstrap-less/bootstrap/sprites.less'}}" />
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-ui-notification/dist/angular-ui-notification.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-confirm/dist/angular-confirm.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-ui-select/dist/select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-bootstrap/ui-bootstrap-csp.css')}}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.default.css"> -->
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/selectize/dist/css/selectize.default.css')}}">
    <!-- Main CSS-->
    <!-- <link href="css/theme.css" rel="stylesheet" media="all"> -->

</head>
<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{url('public/images/240px-ge-logo.png')}}" alt="GE" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block" id="mySidebar">
            <div class="logo">
                <a href="#">
                    <img src="{{url('public/images/179x52px-ge-logo.png')}}" alt="GE" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="{{url('/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-database"></i>Inbound</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('/receipt')}}">
                                        <i class="far fa-check-square"></i>Receipt</a>
                                </li>
                                <li>
                                    <a href="{{url('/physical-verification')}}">
                                        <i class="far fa-check-square"></i>Physical Verification</a>
                                </li>
                                <li>
                                    <a href="{{url('/rma')}}">
                                        <i class="far fa-check-square"></i>RMA</a>
                                </li>
                                <li>
                                    <a href="{{url('/rms')}}">
                                        <i class="far fa-check-square"></i>RMS</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-database"></i>Approval</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                              {{--  <li>
                                    <a href="{{url('/rma-form-linkage')}}">
                                        <i class="far fa-check-square"></i>RMA Form Linkage</a>
                                </li>--}}
                                <li>
                                    <a href="{{url('/warranty')}}">
                                        <i class="far fa-check-square"></i>W/C Declaration</a>
                                </li>
                               {{-- <li>
                                    <a href="{{url('/rma-linkage')}}">
                                        <i class="far fa-check-square"></i>RMA No Linkage</a>
                                </li>--}}
                                <li>
                                    <a href="{{url('/other-relay-repair-status')}}">
                                        <i class="far fa-check-square"></i>Other Relay Repair Status</a>
                                </li>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-database"></i>Repair & Testing</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">

                             {{--   <li>
                                    <a href="{{url('/repair-initiation')}}">
                                        <i class="far fa-check-square"></i>Repair Initiation</a>
                                </li>--}}
                                <li>
                                    <a href="{{url('/job-ticket')}}">
                                        <i class="far fa-check-square"></i>Job Ticket</a>
                                </li>
                                <li>
                                    <a href="{{url('/auto-test-bench')}}">
                                        <i class="far fa-check-square"></i>Testing</a>
                                </li>
                                <li>
                                    <a href="{{url('/aging-complete')}}">
                                        <i class="far fa-check-square"></i>Aging</a>
                                </li>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-database"></i>Outbound</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">

                                <li>
                                    <a href="{{url('/verification-completion')}}">
                                        <i class="far fa-check-square"></i>Verification Completion</a>
                                </li>
                                <li>
                                    <a href="{{url('/dispatch-approval')}}">
                                        <i class="far fa-check-square"></i>Dispatch Approval</a>
                                </li>
                                <li>
                                    <a href="{{url('/dispatch')}}">
                                        <i class="far fa-check-square"></i>Dispatch</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-database"></i>Masters</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('/masters-page/customer')}}">Customer</a>
                                </li>
                                <li>
                                    <a href="{{url('/masters-page/product')}}">Product</a>
                                </li>
                                <li>
                                    <a href="{{url('/masters-page/user')}}">User</a>
                                </li>
                                <li>
                                    <a href="{{url('/masters-page/location')}}">Location</a>
                                </li>
                                <li>
                                    <a href="{{url('/masters-page/site')}}">Site</a>
                                </li>
                                <!-- <li>
                                    <a href="{{url('/masters-page/rack')}}">Rack</a>
                                </li> -->
                                <!-- <li>
                                    <a href="{{url('/masters-page/rack-type')}}">Rack Type</a>
                                </li> -->
                                <!-- <li>
                                    <a href="{{url('/masters-page/material')}}">Material</a>
                                </li> -->
                                <!-- <li>
                                    <a href="{{url('/masters-page/packing-style')}}">Packing Style</a>
                                </li> -->
                                <li>
                                    <a href="{{url('/masters-page/product-type')}}">Product Type</a>
                                </li>
                                <!-- <li>
                                    <a href="{{url('/masters-page/material-type')}}">Material Type</a>
                                </li> -->
                                <!-- <li>
                                    <a href="{{url('/masters-page/manufacture')}}">Manufacture</a>
                                </li> -->
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
       {{-- <button id="openBtn" class="openbtn" onclick="closeNav()">☰ Toggle Sidebar</button>--}}
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container" id = "Page">

            <!-- HEADER DESKTOP-->
            <header class="header-desktop" id="headerID">

                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="header-wrap float-right">
                                <div class="header-button">
                                    <div class="noti-wrap">
                                    <!-- <div class="noti__item js-item-menu">
                                            <i class="zmdi zmdi-comment-more"></i>
                                            <span class="quantity">1</span>
                                            <div class="mess-dropdown js-dropdown">
                                                <div class="mess__title">
                                                    <p>You have 2 news message</p>
                                                </div>
                                                <div class="mess__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="{{url('public/images/icon/avatar-06.jpg')}}" alt="Michelle Moreno" />
                                                    </div>
                                                    <div class="content">
                                                        <h6>Michelle Moreno</h6>
                                                        <p>Have sent a photo</p>
                                                        <span class="time">3 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="mess__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="{{url('public/images/icon/avatar-04.jpg')}}" alt="Diane Myers" />
                                                    </div>
                                                    <div class="content">
                                                        <h6>Diane Myers</h6>
                                                        <p>You are now connected on message</p>
                                                        <span class="time">Yesterday</span>
                                                    </div>
                                                </div>
                                                <div class="mess__footer">
                                                    <a href="#">View all messages</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="noti__item js-item-menu">
                                            <i class="zmdi zmdi-email"></i>
                                            <span class="quantity">1</span>
                                            <div class="email-dropdown js-dropdown">
                                                <div class="email__title">
                                                    <p>You have 3 New Emails</p>
                                                </div>
                                                <div class="email__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="{{url('public/images/icon/avatar-06.jpg')}}" alt="Cynthia Harvey" />
                                                    </div>
                                                    <div class="content">
                                                        <p>Meeting about new dashboard...</p>
                                                        <span>Cynthia Harvey, 3 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="email__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="{{url('public/images/icon/avatar-05.jpg')}}" alt="Cynthia Harvey" />
                                                    </div>
                                                    <div class="content">
                                                        <p>Meeting about new dashboard...</p>
                                                        <span>Cynthia Harvey, Yesterday</span>
                                                    </div>
                                                </div>
                                                <div class="email__item">
                                                    <div class="image img-cir img-40">
                                                        <img src="{{url('public/images/icon/avatar-04.jpg')}}" alt="Cynthia Harvey" />
                                                    </div>
                                                    <div class="content">
                                                        <p>Meeting about new dashboard...</p>
                                                        <span>Cynthia Harvey, April 12,,2018</span>
                                                    </div>
                                                </div>
                                                <div class="email__footer">
                                                    <a href="#">See all emails</a>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="noti__item js-item-menu">
                                            <i class="zmdi zmdi-notifications"></i>
                                            <span class="quantity">3</span>
                                            <div class="notifi-dropdown js-dropdown">
                                                <div class="notifi__title">
                                                    <p>You have 3 Notifications</p>
                                                </div>
                                                <div class="notifi__item">
                                                    <div class="bg-c1 img-cir img-40">
                                                        <i class="zmdi zmdi-email-open"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>You got a email notification</p>
                                                        <span class="date">April 12, 2018 06:50</span>
                                                    </div>
                                                </div>
                                                <div class="notifi__item">
                                                    <div class="bg-c2 img-cir img-40">
                                                        <i class="zmdi zmdi-account-box"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>Your account has been blocked</p>
                                                        <span class="date">April 12, 2018 06:50</span>
                                                    </div>
                                                </div>
                                                <div class="notifi__item">
                                                    <div class="bg-c3 img-cir img-40">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>You got a new file</p>
                                                        <span class="date">April 12, 2018 06:50</span>
                                                    </div>
                                                </div>
                                                <div class="notifi__footer">
                                                    <a href="#">All notifications</a>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="account-wrap">
                                        <div class="account-item clearfix js-item-menu">
                                            <div class="image">
                                                <img src="{{url('public/images/icon/avatar-01.jpg')}}" alt="{{ Auth::user()->name }}" />
                                            </div>
                                            <div class="content">
                                                <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                            </div>
                                            <div class="account-dropdown js-dropdown">
                                                <div class="info clearfix">
                                                    <div class="image">
                                                        <a href="#">
                                                            <img src="{{url('public/images/icon/avatar-01.jpg')}}" alt="{{ Auth::user()->name }}" />
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h5 class="name">
                                                            <a href="#">{{ Auth::user()->name }}</a>
                                                        </h5>
                                                        <span class="email">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="#">
                                                            <i class="zmdi zmdi-account"></i>Account</a>
                                                    </div>
                                                    <div class="account-dropdown__item">
                                                        <a href="#">
                                                            <i class="zmdi zmdi-settings"></i>Setting</a>
                                                    </div>
                                                    <div class="account-dropdown__item">
                                                        <a href="#">
                                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__footer">
                                                    <a href="{{url('/logout')}}">
                                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
                @yield('content')

            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <script src="{{url('public/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular/angular.min.js')}}"></script>
    <!-- Jquery JS-->
    <!-- Bootstrap JS-->
    <script src="{{url('public/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{url('public/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{url('public/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{url('public/vendor/wow/wow.min.js')}}"></script>
    <script src="{{url('public/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{url('public/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{url('public/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{url('public/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{url('public/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{url('public/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{url('public/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{url('public/vendor/select2/select2.min.js')}}">
    </script>
    <script src="{{url('public/bower_components/nprogress/nprogress.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-data-grid/src/js/dataGrid.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-data-grid/src/js/pagination.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-bootstrap/ui-bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-animate/angular-animate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-sanitize/angular-sanitize.min.js')}}"></script>
    <!-- <script type="text/javascript" src="{{url('public/bower_components/jquery-ui/jquery-ui.js')}}"></script> -->
    <script type="text/javascript" src="{{url('public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-ui-notification/dist/angular-ui-notification.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-confirm/dist/angular-confirm.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-ui-select/dist/select.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-ui-mask/dist/mask.min.js')}}"></script>

    <!-- Main JS-->
    <script src="{{url('public/js/main.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/app.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/services/datashareservice.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/services/ChangePVStatusService.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/services/PVPriorityService.js')}}"></script>
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "300px";
        }

        function closeNav() {
           }
        

    </script>
    @yield('scripts')

</body>
</html>