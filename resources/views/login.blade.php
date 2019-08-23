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
                        <div class="login-form">
                            <form>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" ng-model="logindata.email" placeholder="Email">
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
                                        <a href="#">Forgotten Password?</a>
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
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="{{url('public/bower_components/angular/angular.min.js')}}"></script>
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

    <!-- Main JS-->
    <script src="{{url('public/js/main.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/app.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/controllers/LoginController.js')}}"></script>

</body>

</html>
<!-- end document-->