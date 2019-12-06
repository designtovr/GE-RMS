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
@section('title', 'Job Ticket List')
<body class="text-right" style="height: 1196px;padding-left: 30px;padding-right: 30px; font-family: 'Oswald', sans-serif !important;">
<div class="main-content" ng-controller="JobTicketFormController">
	<div class="section__content section__content--p30" ng-init="Start();">
	    <div class="container-fluid ">

<div class = "front">
<div class="text-uppercase">
			<div class="row">
				<div class="col" style="padding: 0;">
					<h1 class="text-right float-left d-md-flex justify-content-md-end" style="color: #000000;margin-top: 89px;margin-left: 350px;"><strong>Job Ticket</strong></h1><img src="./public/images/240px-ge-logo.png" class="img-fluid float-right d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px;margin-bottom: 0;"
					/></div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col">
					<h2 class="text-left float-left" style="font-size: 26px; color: #000000"><strong>Type Of Work : </strong></h2>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000"><strong>Repair </strong></h1>
				</div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000;height:  ;">P.O Date      : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">RMA<strong></strong>No    <strong>: </strong></h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair<strong></strong></h1>
				</div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Given Date<strong>  : </strong></h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Customer  <strong>: </strong></h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Taken Date  : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">End Customer  : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair<strong></strong></h1>
				</div>
			</div>
			<div class="row" style="margin-top: 9px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Model No   : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;color: #000000">Serial No : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="row" style="margin-top: 45px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;height:  ;color: #000000">NATURE OF DEFECT : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="row" style="margin-top: -1px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;height:  ;color: #000000">POWER ON TEST      : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="row" style="margin-top: -1px;margin-left: 1px;">
				<div class="col" style="margin-top: 8px;">
					<h1 class="text-left float-left" style="font-size: 26px;height:  ;color: #000000">FIRMWARE               : </h1>
					<h1 class="text-left float-left" style="font-size: 26px;margin-left: 18px;color: #000000">Repair </h1>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table tableStyle table-bordered">
					<thead>
					<tr>
						<th>SL No.</th>
						<th>Description</th>
						<th>Material Part No</th>
						<th>Qty</th>
						<th>Value (Rs)</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Text</td>
						<td>Text</td>
						<td>Text</td>
						<td>Cell 1</td>
						<td>Cell 2</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class="row" style="margin-top: 30px">
				<div class="col-5 float-left">
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top:0px;">Test Results Documented :</h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;"></h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;">Tested:</h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;">Sign:</h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;">Completed Date :</h1>
					<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;">Category      :</h1>
				</div>

				<div class="col-7 float-right">
					<h1 class="text-left border border-dark" style="font-size: 26px;color:#000000;height:250px;padding :10px">Remarks :</h1>

				</div>

			</div>
</div>
<div class ="Footer" style="margin-top:100px;">
			<div class="row ">
		<div class="col" style="padding: 0;">
			<img src="./public/images/240px-ge-logo.png" class="img-fluid float-left d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px 0px;margin-bottom: 0;"
			/></div>
	</div>

	<div class = "row footerText">
		<h6> ALSTOM T&D India LTD , 19/1 , G.S.T Road ,Pallavaram,Chennai - 600 043</h6>
		<br>
		<h6 class ="font-weight-bold "> Tel: +91 44 22648000 FAX: +91 442264 0040.<u>www.alstom.com</u> </h6>
	</div>

	<div class ="row border-bottom border-dark">
	</div>
			<div class ="row">
			<div>
				<h6 style="color:#000000;margin-top:10px;">REGISTERED OFFICE: A18 - 1st floor, Okhla Industrial Area , Phase - II , New Delhi - 110 020</h6>
			</div>
			</div>
</div>
		</div>
	<div class = "back">

		<div class = "row m-t-70">
			<div class="col-md-12 m-t-70">
				<h1 class="text-center font-weight-bold" style="font-size:24px;color:#000000;" > <u>Details of Changed Components</u></h1>
	    </div>


		</div>
		<div class = "row ">
			<div class="col-12 border-top border-bottom border-dark">
				<div class="col-6 float-left">
					<h1 class="text-center" style="font-size:24px;color:#000000;" > <u>OLD COMPONENT</u></h1>
				</div>
				<div class="col-6 float-right ">
					<h1 class="text-center" style="font-size:24px;color:#000000;" > <u>NEW COMPONENT</u></h1>
				</div>
			</div>
	</div>

		<div class = "row ">
			<div class="col-12">
				<div class="col-6 float-left border-right border-dark h-250" style="height:600px">
				</div>
				<div class="col-6 float-right ">
				</div>
			</div>
		</div>

        <div class = "row ">
            <div class="col-12 text-left border border-dark h-250" style="height:250px;color:#000000;font-size: 20px;">
                <u>ACTIVITY :</u>
            </div>

            <div class="col-12 text-left border border-dark h-250" style="color:#000000;font-size: 20px;">
                <u>TIME SPENT :</u>
            </div>
        </div>

            <div class = "row ">
                <div class="col-12 m-t-70 text-left " style="color:#000000;font-size: 20px;">
                    <span class="zmdi zmdi-arrow-right"></span><u>Relay Received With</u>
                </div>
                <div class="col-6 m-t-50 m-l-50 text-left " style="color:#000000;font-size: 20px;">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Case</label>

                </div>

                <div class="col-4 m-t-50  text-left " style="color:#000000;font-size: 20px;">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Terminal Blocks : </label>

                </div>
                <div class="col-6 m-t-10 m-l-50 text-left " style="color:#000000;font-size: 20px;">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Battery</label>

                </div>

                <div class="col-4 m-t-10  text-left " style="color:#000000;font-size: 20px;">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Short Links : </label>

                </div>     <div class="col-6 m-t-10 m-l-50 text-left " style="color:#000000;font-size: 20px;">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Screws</label>

                </div>

                <div class="col-4 m-t-10  text-left " style="color:#000000;font-size: 20px;">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Top/Bottom Access Cover(Flops) </label>

                </div>



        </div>
	</div>
	</div>
</div>
</body>
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
	<script type="text/javascript" src="{{url('public/js/services/ChangePVStatusService.js')}}"></script>
	<script type="text/javascript" src="{{url('public/js/controllers/JobTicketController.js')}}"></script>

