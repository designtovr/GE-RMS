<!DOCTYPE html>
<html lang="en" ng-app="ge" ng-controller="QRController">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>QR Scanner</title>

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
<style>
    canvas {
        display: none;
    }

    hr {
        margin-top: 32px;
    }

    input[type="file"] {
        display: block;
        margin-bottom: 16px;
    }

    div {
        margin-bottom: 16px;
    }

    video {
        width: 80%;
        height: 80%;
    }

    .videoArea {
        max-width: 100%;
        height: 30%;
    }

    .centered-thing {
        position: absolute;
        margin: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<body class="animsition">
    <div  id = "qrID" class="page-wrapper">
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
                    <video muted playsinline id="qr-video"></video>

                                 <label>Relay ID:</label>
                                 <input type="text" id="cam-qr-result" name="comment" ng-model="rmsmodal.pv_id" ng-change ="Digest();" placeholder="Relay Id"
                                 class="au-input au-input--full">
                                 <!-- <span class="help-block">Please Enter Rack Id</span> -->
                                 <button class = "btn btn-primary m-3" id="startRelay">Scan Relay QR</button>
                                 

                             </div>
                             <div class="form-group">
                                <label>Rack ID</label>
                                       <input type="text" id="cam-qr-result1" name="comment" ng-model="rmsmodal.rack_id" ng-change ="Digest();"
                            placeholder="Rack Id" class="au-input au-input--full">
                               <button class ="btn btn-primary m-3" id="startRack">Scan Rack QR</button>
                            </div>
                
                                <button class="au-btn au-btn--block au-btn--blue2 m-b-20" type="submit" ng-click="AddRMS();">Submit</button>
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

            </body>

   <!--  <div class="card text-center centered-thing" ng-controller="QRController">
        <div class="card-header">
            <h1>Scan QR:</h1>

        </div>
        <div class="card-body">

            <div class="videoArea col-lg-4">
                {{--    <b>Device has camera: </b>
                    <span id="cam-has-camera"></span>
                    <br>--}}
                    <video muted playsinline id="qr-video"></video>

                </div>
                <button id="stop">Stop</button>
                <br>
                <div class="row">

                    <div class="col-md-12">


                        <b>Relay ID: </b>
                        <div class="col-md-12">

                            <input type="text" id="cam-qr-result" name="comment" ng-model="rmsmodal.pv_id" placeholder="Relay Id"
                            class="form-control">
                          <span class="help-block">Please Enter Rack Id</span> -->
                            <!--   <button id="startRelay">Scan Relay QR</button>
                        </div>
                        {{--<span id="cam-qr-result" ng-model="rmsmodal.pv_id"></span>--}}


                        <br>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">

                        <b>Rack ID: </b>
                        <div class="col-md-12">

                            <input type="text" id="cam-qr-result1" name="comment" ng-model="rmsmodal.rack_id"
                            placeholder="Rack Id" class="form-control">
                       <span class="help-block">Please Enter Rack Id</span> -->
                              <!--    <button id="startRack">Scan Rack QR</button>
                        </div>

                        <br>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 offset-3 text-center">

                            <button class="btn btn-primary" ng-click="AddRMS();">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


            

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

            <!-- Main JS-->
            <script src="{{url('public/js/main.js')}}"></script>
            <script type="text/javascript" src="{{url('public/js/app.js')}}"></script>
    <script type="text/javascript" src="{{url('public/js/controllers/QRController.js')}}"></script>

        <script type="module">
            import QrScanner from "./public/js/qr-scanner.min.js";

            QrScanner.WORKER_PATH = './public/js/qr-scanner-worker.min.js';

            const video = document.getElementById('qr-video');
            video.style.visibility = "hidden";
            video.style.display = "none";
            /*const camHasCamera = document.getElementById('cam-has-camera');*/
            const camQrResult = document.getElementById('cam-qr-result');
            const camQrResult1 = document.getElementById('cam-qr-result1');

            const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
            const fileSelector = document.getElementById('file-selector');
            const fileQrResult = document.getElementById('file-qr-result');
            var QRScannerInstance = null;

            function setResult(label, result) {
                console.log("Set QR" + label + " " + result);
                label.textContent = result;
                label.value = result;
       /*         OnChange(label);*/
/*                label.trigger('input');
                label.trigger('change');*/
                console.log(camQrResult.value);
                console.log(camQrResult1.value);
                /*camQrResultTimestamp.textContent = new Date().toString();*/
                label.style.color = 'teal';
                clearTimeout(label.highlightTimeout);
                label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
                QRScannerInstance.stop();
                Stop();
                
                   var appElement = document.querySelector('[ng-app=ge]');
    var $scope = angular.element(appElement).scope();
    $scope.$apply(function() {
        $scope.rmsmodal.pv_id = camQrResult.value;
        $scope.rmsmodal.rack_id = camQrResult1.value;
    });
                /* angular.element(document.getElementById('qrID')).scope().Digest();*/
            }

          /*  function OnChange(label){
                $('#camQrResult').myfunction();
    camQrResult.trigger('input'); // Use for Chrome/Firefox/Edge
    camQrResult.trigger('change'); // Use for Chrome/Firefox/Edge + IE11
}
*/
/*
(function( $ ){
   $.fn.myfunction = function() {
     $('#camQrResult').trigger('input'); // Use for Chrome/Firefox/Edge
     $('#camQrResult').trigger('change'); // Use for Chrome/Firefox/Edge + IE11

          $('#camQrResult1').trigger('input'); // Use for Chrome/Firefox/Edge
     $('#camQrResult1').trigger('change'); // Use for Chrome/Firefox/Edge + IE11
   }; 
})( jQuery );*/

        // ####### Web Cam Scanning #######

        /*  QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);*/



        /*  document.getElementById('inversion-mode-select').addEventListener('change', event => {
                scanner.setInversionMode(event.target.value);
            });*/


            document.querySelector('#startRelay').addEventListener('click', StartRelayScan);
            document.querySelector('#startRack').addEventListener('click', StartRackScan);
          /*  document.querySelector('#stop').addEventListener('click', Stop);*/

            function StartRelayScan() {
                const scanner = new QrScanner(video, result => setResult(camQrResult, result));
                scanner.setInversionMode("original");
                scanner.start();
                QRScannerInstance = scanner;
                video.style.visibility = "visible";
                video.style.display = "inline";

            }

            function StartRackScan() {
                const scanner = new QrScanner(video, result => setResult(camQrResult1, result));
                scanner.setInversionMode("original");
                scanner.start();
                QRScannerInstance = scanner;
                video.style.visibility = "visible";
                video.style.display = "inline";

            }

            function Stop() {
                QRScannerInstance.stop();
                QRScannerInstance.destroy();
                QRScannerInstance = null;
                console.log("Stopped");
                video.style.visibility = "hidden";
                video.style.display = "none";
            }

        /*  // ####### File Scanning #######

            fileSelector.addEventListener('change', event => {
                const file = fileSelector.files[0];
                if (!file) {
                    return;
                }
                QrScanner.scanImage(file)
                        .then(result => setResult(fileQrResult, result))
                        .catch(e => setResult(fileQrResult, e || 'No QR code found.'));
                    });*/

                </script>

        </body>

        </html>
        <!-- end document-->

        </html>