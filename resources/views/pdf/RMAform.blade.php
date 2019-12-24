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
@section('title', 'RMA Form')
<body class="text-right" style="height: 1196px;padding-left: 30px;padding-right: 30px; font-family: 'Oswald', sans-serif !important;">
<div class="main-content" ng-controller="JobTicketFormController">
	<div class="section__content section__content--p30" ng-init="Start();">
		<div class="container-fluid ">

			<div class = "front">
					<div class="row">
						<div class="col" style="padding: 0;">
							<h5 class=" float-left d-md-flex justify-content-md-end" style="color: #000000;margin-top: 89px;">Repair / Modification Return Authorization Form  - RMA Form</h5><img src="./public/images/240px-ge-logo.png" class="img-fluid float-right d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px;margin-bottom: 15px;"/></div>
					</div>
					<div class = "border-3 border-dark bg-grey p-10 ">

					<div class="row" style="margin-top: 9px;margin-left: 1px;">
						<div class="col">
							<div class = "float-left text-left f13"><p>FIELD ONLY TO BE FILLED IN BY A GE Grid Automation REPRESENTATIVE</p></div>
							<div class = "float-right text-left"><p> Date : </p></div>
						</div>


					</div>
<div class="row">
					<div class="col">
						<div class = "float-left text-left f13"><p> RMA Reference : </p></div>
						<div class = "float-right text-left f13"><p><u>ABCDEFGHIJK</u> </p></div>

					</div>


	</div>
					<div class="row">
						<div class="col">
							<div class = "float-right text-left f13"><p>ACT Reference(M)</p></div>
						</div>
					</div>


					</div>

					<div class = "border-top-2 border-l-r-3 border-dark bg-grey  p-10 ">

						<div class="row" style="margin-top: 9px;margin-left: 1px;">
							<div class="col">
								<div class = "float-left text-left f10 font-weight-bold"><p><u>Repair Center address to Ship the Unit :</u> </p></div>
							</div>
						</div>

						<div class="row" style="margin-left: 1px;">
							<div class="col-4 color-black">
								<div class = "float-left text-left f13 font-weight-bold">GE T&D India Limited (Formerly ALSTOM T&D India Limited),
								<br> Certified Repair Center
									<br> 19/1 , GST Road , Pallavaram,
									<br>Chennai - 600043
									<br>GST - 33AAACG2115R1ZO
								</div>
							</div>
						</div>
					</div>

					<div class = "border-top-2 border-l-r-3 border-b-3 border-dark bg-grey  ">

						<div class="row" style="margin-top: 9px;margin-left: 1px;">
							<div class="col-12">
								<div class = "float-left text-left f12 font-weight-bold"><p>GE GRID Automation Local Contact Information : Loganathan Krishnan </p></div>
							</div>

							<div class="col-4">
								<div class = "float-left text-left f12 font-weight-bold"><p>Name of Contact - +91 9952099332</p></div>
							</div>

							<div class="col-4">
								<div class = "float-left text-left f12 font-weight-bold"><p>Tel No - +914422648164</p></div>
							</div>

							<div class="col-4">
								<div class = "float-left text-left f12 font-weight-bold"><p>Email - krishnan.loganathan@ge.com</p></div>
							</div>
						</div>


					</div>

					<div class="row" style="margin-top: 9px;margin-left: 1px;">
						<div class="col-12 color-black">
							<div class = " text-left f15 font-weight-bold">1. IDENTIFICATION OF UNIT & FAULT INFORMATION
								<span class="f10">  - Fields marked (M) are mandatory.
								</span></div>
						</div>
					</div>


					<div class="table-responsive">
						<table class="table tablesmall table-bordered">
							<thead>
							<tr>
								<th>Qty</th>
								<th>Type of Material (M)
								Model N (M)</th>

								<th>Serial n (M) / Part N (M)</th>
								<th>SW Vers</th>
								<th>Description of Fault or Modification required (M)</th>
								<th>Are Field Volts Used (M)</th>
								<th>Warranty Y/N ?. if Yes Mention your PO no.</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							</tbody>
						</table>
					</div>
					<div class="row color-black">

					<div class = "col-3 text-left border-l-3 f13" style="margin-left: 14px;">
						<label><strong>(M)</strong> Equipment failed during Installation / Community</label>
					</div>
						<div class = "col-2 text-right border-r-3">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
						<strong>Yes</strong></div>

						<div class = "col-4 text-left  f13" style = "margin-left: 14px;">
							<label><strong>(M)</strong> Equipment failed during Service</label>
						</div>
						<div class = "col-2 text-right border-r-3 f13 m-lg-r-30">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<strong>Yes</strong> How Long?</div>
					</div>

					<div class="row color-black" style="margin-left:1px;">

					<div class="table-responsive">
						<table class="table tablesmall table-bordered">
							<thead >
							<tr>
								<th>Qty</th>
								<th>Type of Material (M)
									Model N (M)</th>

								<th>Serial n (M) / Part N (M)</th>
								<th>SW Vers</th>
								<th>Description of Fault or Modification required (M)</th>
								<th>Are Field Volts Used (M)</th>
								<th>Warranty Y/N ?. if Yes Mention your PO no.</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>

							</tr>
							</tbody>
						</table>
					</div>
					</div>
					<div class="row color-black">

						<div class = "col-3 text-left border-l-3 border-b-3 f13" style="margin-left: 14px;">
							<label><strong>(M)</strong> Equipment failed during Installation / Community</label>
						</div>
						<div class = "col-2 text-right border-r-3 border-b-3">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<strong>Yes</strong></div>

						<div class = "col-4 text-left  f13 border-b-3" >
							<label><strong>(M)</strong> Equipment failed during Service</label>
						</div>
						<div class = "col-2 text-right border-r-3 f13 border-b-3">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<strong>Yes</strong> How Long?</div>
					</div>

					<div class="row" style="margin-top: 9px;margin-left: 1px;">
						<div class="col-12 color-black">
							<div class = " text-left f15 font-weight-bold">2. SPECIALIST REPAIR INSTRUCTIONS</div>
						</div>
					</div>

					<div class = "border-3-all border-dark	 p-10 ">

						<div class="row" style="margin-top: 9px;margin-left: 1px;">
							<div class="col-6">
								<div class = "float-left text-left f13"><p><strong>Do you want an updated firmware version</strong></p></div>

							</div>
							<div class = "col-2 text-right f13 color-black">
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
								<strong>Yes</strong></div>

							<div class = "col-2 text-right f13 color-black">
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
								<strong>No</strong></div>

						</div>

						<div class="row" style="margin-top: 9px;margin-left: 1px;">
							<div class="col-6">
								<div class = "float-left text-left f13"><p><strong>Is the relay being returned in a case?</strong></p></div>

							</div>
							<div class = "col-2 text-right f13 color-black">
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
								<strong>Yes</strong></div>

							<div class = "col-2 text-right f13 color-black">
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
								<strong>No</strong></div>

						</div>
					</div>





			<div class = "back">
				<div class="row" style="margin-top: 9px;margin-left: 1px;">
					<div class="col-12 color-black">
						<div class = " text-left f15 font-weight-bold">3.CUSTOMS AND INVOICING INFORMATION REQUIRED TO ALLOW RETURN OF REPAIRED ITEMS - Mention your GST NO</div>
					</div>
				</div>
				<div class = "row border-3">
					<div class="col-md-12 m-t-10">
						<h1 class="text-center font-weight-bold" style="font-size:18px;color:#000000;" > <u>Value for Customs (M) : </u></h1>
						<h1 class="text-center font-weight-bold f12" style="color:#000000;" > In case the product requires Export</h1>
					</div>


				</div>
				<div class = "row ">
					<div class="col-12 border-top border-l-r-3 border-dark">
						<div class="col-6  float-left">
							<h1 class="text-left" style="font-size:12px;color:#000000;" > <u>Customer Invoice Address if paid(M)</u></h1>
						</div>
						<div class="col-6 float-right   border-left border-dark ">
							<h1 class="text-left" style="font-size:12px;color:#000000;" > <u>Customer Return Delivery Address (Full Screen Address)(M)</u></h1>

						</div>
					</div>
				</div>

				<div class = "row border-l-r-3 border-dark">
					<div class="col-12">
						<div class="col-6 float-left  h-250" style="height:100px">
						</div>
						<div class="col-6 float-right border-left border-dark  h-250" style="height:100px">
						</div>
					</div>
				</div>
				<div class = "row ">
					<div class="col-12  border-l-r-3 border-dark">
						<div class="col-6 border-right border-dark float-left">
						</div>
						<div class="col-6 float-right  border-left border-dark">
							<h1 class="text-left" style="font-size:12px;color:#000000;">Part Shipment Accepted (Yes/No)- </h1>

						</div>
					</div>
				</div>

				<div class = "row ">
					<div class="col-12 border-top border-l-r-3 border-b-3 border-dark">
						<div class="col-6  float-left">
							<h1 class="text-left" style="font-size:12px;color:#000000; margin-top: 5px;" >Contact Name : </h1>
							<h1 class="text-left" style="font-size:12px;color:#000000; margin-top: 5px;" >Tel No : </h1>
							<h1 class="text-left" style="font-size:12px;color:#000000; margin-top: 5px;" >Email  : </h1>
						</div>
						<div class="col-6 float-right   border-left border-dark ">
							<h1 class="text-left" style="font-size:12px;color:#000000; margin-top: 5px;" >Contact Name : </h1>
							<h1 class="text-left" style="font-size:12px;color:#000000; margin-top: 5px;" >Tel No : </h1>
							<h1 class="text-left" style="font-size:12px;color:#000000; margin-top: 5px;" >Email  : </h1>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top: 9px;margin-left: 1px;">
					<div class="col-12 color-black">
						<div class = " text-left f15 font-weight-bold">4.Repair Terms And Condition</div>
					</div>
				</div>

				<div class = "border-3-all border-dark	 p-10 ">

					<div class="row" style="margin-top: 9px;margin-left: 1px;">
						<div class="col-6">
							<div class = "float-left text-left f13"><p style="margin-bottom: 0rem;">1.<strong>Please ensure a copy of the import invoice is attached with the returned unit</strong>/Airwaybill document copy emailed(M)</p></div>
							<div class = "float-left text-left f13"><p style="margin-bottom: 0rem;">2.Please ensure a copy of the import invoice is attached with the returned unit/Airwaybill document copy emailed(M)</p></div>


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

