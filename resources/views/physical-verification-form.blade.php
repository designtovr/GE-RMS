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
<div class="main-content" ng-controller="TestReportFormController">
	<div class="section__content section__content--p30" ng-init="Start();">
	    <div class="container-fluid ">

<div class = "front">
<div class="text-uppercase">
			<div class="row">
				<div class="col" style="padding: 0;">
					<h1 class="text-right float-left d-md-flex justify-content-md-end" style="color: #000000;margin-top: 89px;margin-left: 150px;"><strong><u>Physical Verification Form</u></strong></h1><img src="./public/images/240px-ge-logo.png" class="img-fluid float-right d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px;margin-bottom: 0;"/></div>
			</div>

	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6">
			<h2 class="text-left float-left" style="font-size: 26px; color: #000000"><strong>RMA :  </strong></h2>

		</div>

		<div class="col-6">
			<h2 class="text-left float-left" style="font-size: 26px; color: #000000"><strong>Customer :  </strong></h2>

		</div>
	</div>

	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 float-left">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center">
					<thead>
					<tr>
						<th><u>Model No. </u></th>
						<th><u>S No. </u></th>

					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Text</td>
						<td>Text</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class=" col-12 text-left">
					<h4 class ="" style="color:#000000;">Remarks: <u>Remarks</u></h4></div>
		</div>
		<div class="col-6 float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-left">
					<tbody>

					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Battery : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">TBs : </label></td>

					</tr>
					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Flops : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Screws : </label></td>

					</tr>	<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Rusted : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Damaged : </label></td>

					</tr>
					</tbody>
				</table>
			</div>


		</div>
	</div>
	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 float-left">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center">
					<thead>
					<tr>
						<th><u>Model No. </u></th>
						<th><u>S No. </u></th>

					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Text</td>
						<td>Text</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class=" col-12 text-left">
				<h4 class ="" style="color:#000000;">Remarks: <u>Remarks</u></h4></div>
		</div>
		<div class="col-6 float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-left">
					<tbody>

					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Battery : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">TBs : </label></td>

					</tr>
					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Flops : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Screws : </label></td>

					</tr>	<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Rusted : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Damaged : </label></td>

					</tr>
					</tbody>
				</table>
			</div>


		</div>
	</div>
	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 float-left">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center">
					<thead>
					<tr>
						<th><u>Model No. </u></th>
						<th><u>S No. </u></th>

					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Text</td>
						<td>Text</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class=" col-12 text-left">
				<h4 class ="" style="color:#000000;">Remarks: <u>Remarks</u></h4></div>
		</div>
		<div class="col-6 float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-left">
					<tbody>

					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Battery : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">TBs : </label></td>

					</tr>
					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Flops : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Screws : </label></td>

					</tr>	<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Rusted : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Damaged : </label></td>

					</tr>
					</tbody>
				</table>
			</div>


		</div>
	</div>
	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 float-left">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center">
					<thead>
					<tr>
						<th><u>Model No. </u></th>
						<th><u>S No. </u></th>

					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Text</td>
						<td>Text</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class=" col-12 text-left">
				<h4 class ="" style="color:#000000;">Remarks: <u>Remarks</u></h4></div>
		</div>
		<div class="col-6 float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-left">
					<tbody>

					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Battery : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">TBs : </label></td>

					</tr>
					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Flops : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Screws : </label></td>

					</tr>	<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Rusted : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Damaged : </label></td>

					</tr>
					</tbody>
				</table>
			</div>


		</div>
	</div>
	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 float-left">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center">
					<thead>
					<tr>
						<th><u>Model No. </u></th>
						<th><u>S No. </u></th>

					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Text</td>
						<td>Text</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class=" col-12 text-left">
				<h4 class ="" style="color:#000000;">Remarks: <u>Remarks</u></h4></div>
		</div>
		<div class="col-6 float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-left">
					<tbody>

					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Battery : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">TBs : </label></td>

					</tr>
					<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Flops : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Screws : </label></td>

					</tr>	<tr>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Rusted : </label></td>
						<td>	<input type="checkbox" class="m-t-10" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Damaged : </label></td>

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
	         <script>
                $(document).ready(function () {
                    $("#dateFilter").datepicker({
                        autoclose: true,
                        format: 'yyyy-mm-dd',
                        todayHighlight: true,
                        setDate: new Date(),
                        update: new Date()
                    });
                });

				$("#dateFromFilter").datepicker({
					autoclose: true,
					format: 'yyyy-mm-dd',
					todayHighlight: true,
				});

				$("#dateToFilter").datepicker({
					autoclose: true,
					format: 'yyyy-mm-dd',
					todayHighlight: true,
				});
            </script>
