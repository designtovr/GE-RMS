<!DOCTYPE html>
<html lang="en" ng-app="ge" ng-controller="LoginController">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{url('public/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{url('public/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
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
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-ui-notification/dist/angular-ui-notification.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-confirm/dist/angular-confirm.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/bower_components/angular-ui-select/dist/select.min.css')}}">

    <!-- Main CSS-->
    <link href="{{url('public/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{url('public/images/179x52px-ge-logo.png')}}" alt="GE">
                            </a>
                        </div>
                        <div class="login-form" ng-if="form == 'login'">
                            <form>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" ng-model="logindata.username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" ng-model="logindata.password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <!-- <label>
                                        <input type="checkbox" ng-model="logindata.remember_me">Remember Me
                                    </label> -->
                                    <label ng-if="invalid_credentials">
                                        <a href="#">Invalid Credentials!</a>
                                    </label>
                                    <label>
                                        <a href="#" ng-click="ChangeTab('forgotpass')">Forgot Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue2 m-b-20" type="submit" ng-click="login();">sign in</button>
                                <!-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                                        <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                                    </div>
                                </div> -->
                            </form>
                            <!-- <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p>
                            </div> -->
                        </div>
                        <div class="forgotpass-form" ng-if="form == 'forgotpass'">
                            <form name="ForgotPassForm" id="ForgotPassForm" novalidate>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" ng-model="forgotpass.username" name="username" placeholder="Username" required>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" ng-click="ForgotPassword()" type="submit">submit</button>
                                <button class="au-btn au-btn--block au-btn--blue2 m-b-20" type="submit" ng-click="ChangeTab('login')">Back</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="{{url('public/bower_components/angular/angular.js')}}"></script>
    <!-- Jquery JS-->
    <script src="{{url('public/vendor/jquery-3.2.1.min.js')}}"></script>
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
    <script type="text/javascript" src="{{url('public/bower_components/nprogress/nprogress.js')}}"></script>
     <script type="text/javascript" src="{{url('public/bower_components/angular-data-grid/src/js/dataGrid.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-data-grid/src/js/pagination.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-bootstrap/ui-bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-animate/angular-animate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-sanitize/angular-sanitize.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-ui-notification/dist/angular-ui-notification.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-confirm/dist/angular-confirm.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-ui-select/dist/select.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/angular-ui-mask/dist/mask.min.js')}}"></script>
    <script type="text/javascript" src="{{url('public/bower_components/ng-file-upload/ng-file-upload.js')}}"></script>

    <!-- Main JS-->
    <script src="{{url('public/js/main.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/app.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/controllers/LoginController.js')}}"></script>

</body>

</html>
<!-- end document-->