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
	<title>GE-RMS - Verification Completion Form</title>

	<link href="{{url('public/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/css/theme.css')}}" rel="stylesheet" media="all">

</head>
<body class="text-right" style="height: 1196px;padding-left: 30px;padding-right: 30px; font-family: 'Oswald', sans-serif !important;">
<div class="main-content" ng-controller="TestReportFormController">
	<div class="section__content section__content--p30" ng-init="Start();">
	    <div class="container-fluid ">

<div class = "front ftr">
<div class="text-uppercase">
			<div class="row">
				<div class="col" style="padding: 0;">
					<img src="{{url('public/images/240px-ge-logo.png')}}" class="img-fluid float-right d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 5px;margin-bottom: 0;"/>
					</div>
			</div>

	<div class="row">
		<div class="col border-bottom border-dark" style="padding: 0;">
			<h2 class="text-right float-left d-md-flex justify-content-md-end" style="color: #000000;margin-top: 10px;"><strong>Certified Repair Center</strong></h2>
			<h2 class="text-right float-right d-md-flex justify-content-md-end" style="color: #000000;margin-top: 10px;"><strong>Test Report</strong></h2>
		</div>
	</div>

	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-12">
		<div class="col-6 float-left text-nowrap">
			<h2 class="text-left float-left col-12" style="font-size: 22px; color: #000000"><strong>R Id: </strong><span class="text-nowrap" style="font-weight: normal">{{$formatted_pv_id}}</span></h2>
			<h2 class="text-left float-left col-12" style="font-size: 22px; color: #000000"><strong>RMA No: </strong><span class="text-nowrap" style="font-weight: normal">{{$formatted_rma_id}}</span></h2>
			<h2 class="text-left float-left col-12" style="font-size: 22px; color: #000000"><strong>Customer: </strong><span class="text-nowrap" style="font-weight: normal">{{$customer_name}}</span></h2>
			<h2 class="text-left float-left col-12" style="font-size: 22px; color: #000000"><strong>Model Number: </strong><span class="text-nowrap" style="font-weight: normal">{{$model_no}}</span></h2>
			<h2 class="text-left float-left col-12" style="font-size: 22px; color: #000000"><strong>Serial Number: </strong><span class="text-nowrap" style="font-weight: normal">{{$serial_no}}</span></h2>
			<h2 class="text-left float-left col-12" style="font-size: 22px; color: #000000"><strong>Software Reference: </strong><span class="text-nowrap" style="font-weight: normal">{{$updated_sw_version}}</span></h2>
			<h2 class="text-left float-left col-12" style="font-size: 22px; color: #000000">
				<strong>Terminal Block: </strong>
				<span class="text-nowrap" style="font-weight: normal">
				@if($updated_no_of_terminal_blocks == 0)
					0
				@else
					{{substr($updated_no_of_terminal_blocks, 0, 2)}} + {{substr($updated_no_of_terminal_blocks, 2, 2)}}
				@endif
				</span>
			</h2>
			<h2 class="text-left float-left col-12" style="font-size: 22px; color: #000000"><strong>Short Links:  </strong>
				<span class="text-nowrap" style="font-weight: normal">
				@if($updated_no_of_short_links == null)
					0
				@else
					{{$updated_no_of_short_links}}
				@endif
				</span>
			</h2>

		</div>
		<div class="col-6 float-right">
			<h2 class="text-left float-left" style="font-size: 26px; color: #000000"><strong>Date :  </strong><span class="text-nowrap" style="font-weight: normal">{{ date('d/m/Y',strtotime($vc_updated_at))}}</span></h2>

		</div>

		</div>
	</div>
</div>

	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-12 text-left">
			<p class="text-left float-left col-12" style="font-size: 22px; color: #000000"><strong>This Product has been tested in accordance with the aprropriate Test Specification. Product operation and performance is within the limits specified in the relevant publication.</strong></p>
		</div>
	</div>

	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 float-left">

			<div class=" col-12 text-left">
					<h4 class ="" style="color:#000000; font-weight: bold">Summary of Tests Performed: <u></u></h4></div>
		</div>



		</div>


	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Communication Port Tests: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th>NA</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>

	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">LED Test: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th >NA <i class="zmdi zmdi-check"></i></th>
					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>


	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">CLIO Tests*: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						@if($clio_test)
							<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
							<th>NA</th>
						@else
							<th>Pass</th>
							<th class ="bgOn"  style="background-color: #d3d3d3">NA</th>
						@endif
					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>


	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">RTD Tests*: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						@if($rtd_test)
							<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
							<th>NA</th>
						@else
							<th>Pass</th>
							<th class ="bgOn" style="background-color: #d3d3d3">NA</th>
						@endif
					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>

	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Opto Isolator Input Tests: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>

	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Output Contact Tests: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" >Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>

	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">LCD & Keypad Tests: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>

	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">In Built Field Voltage Check: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>
	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Watch dog Contact Test: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>

	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">VA Burden Checks*: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Battery Fail Alarm: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Functional Checks: <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>	<div class="row  h-40 " style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">IRIG-B & Real Time Clock Tests* <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>

	<div class="row  h-40 " style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Loaded Customer Settings* <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>


		<div class="row h-40 " style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Aging Test(Power On Test For 24 hours)<br> <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th class ="bgOn" style="background-color: #d3d3d3">Pass</th>
						<th>NA</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>
	<div class ="Footer" style="margin-top:10px;">
	{{--	<div class="row ">
			<div class="col" style="padding: 0;">
				<img src="./public/images/240px-ge-logo.png" class="img-fluid float-left d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px 0px;margin-bottom: 0;"
				/></div>
		</div>--}}

		<div class = "row footerText text-left">
			<div class="col-12">
			<h6 style="font-weight: normal"> GE T&D India LTD , 19/1 , G.S.T Road ,Pallavaram,Chennai - 600 043</h6></div>
			<div class="col-12">
			<h6 class ="font-weight-bold "> Tel: +91 44 22648000 FAX: +91 442264 0040.<u>www.alstom.com</u> </h6>
			</div>
		</div>

		<div class ="row border-bottom border-dark">
		</div>
		<div class ="row">
			<div>
				<h6 style="color:#000000;margin-top:10px;font-weight: normal">REGISTERED OFFICE: A18 - 1st floor, Okhla Industrial Area , Phase - II , New Delhi - 110 020</h6>
			</div>
		</div>
	</div>

	<br>
	<br>
	<br>


	<div class="row">
		<div class="col" style="padding: 0;">
			<img src="{{url('public/images/240px-ge-logo.png')}}" class="img-fluid float-right d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 5px;margin-bottom: 0;"/>
		</div>
	</div>

	<div class="row">
		<div class="col border-bottom border-dark" style="padding: 0;">
			<h2 class="text-right float-left d-md-flex justify-content-md-end" style="color: #000000;margin-top: 10px;"><strong>Certified Repair Center</strong></h2>
			<h2 class="text-right float-right d-md-flex justify-content-md-end" style="color: #000000;margin-top: 10px;"><strong>Test Report</strong></h2>
		</div>
	</div>

	<div class="row h-40 " style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Store Test Results :<u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						<th  class ="bgOn" style="background-color: #d3d3d3">Yes</th>
						<th>No</th>

					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>	<div class="row h-40 " style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Relay Received With Battery : <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						@if($battery)
							<th class ="bgOn" style="background-color: #d3d3d3">Yes</th>
							<th>No</th>
						@else
							<th>Yes</th>
							<th class ="bgOn" style="background-color: #d3d3d3">No</th>
						@endif
					</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>	<div class="row h-40" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: bold">Relay Received With Case : <u></u></h4></div>

		<div class="col-3 text-left float-right">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered text-center no-padding" >
					<thead>
					<tr>
						@if($case)
							<th class ="bgOn" style="background-color: #d3d3d3">Yes</th>
							<th>No</th>
						@else
							<th>Yes</th>
							<th class ="bgOn" style="background-color: #d3d3d3">No</th>
						@endif
					</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

		<div class="row h-40 " style="margin-top: 9px;margin-left: 1px;">
			<div class="col-6 text-left float-left m-l-10">
				<h4 class ="col-12" style="color:#000000; font-weight: bold">Relay Received With Screws : <u></u></h4></div>

			<div class="col-3 text-left float-right">
				<div class="table-responsive">
					<table class="table tableStyle table-bordered text-center no-padding" >
						<thead>
						<tr>
							@if($received_with_screws)
								<th class ="bgOn" style="background-color: #d3d3d3">Yes</th>
								<th>No</th>
							@else
								<th>Yes</th>
								<th class ="bgOn" style="background-color: #d3d3d3">No</th>
							@endif
						</tr>
						</thead>
					</table>
				</div>
			</div>

		</div>	<div class="row" style="margin-top: 9px;margin-left: 1px;">
			<div class="col-6 text-left float-left m-l-10">
				<h4 class ="col-12" style="color:#000000; font-weight: bold">Relay Received With Terminal Case : <u></u></h4></div>

			<div class="col-3 text-left float-right">
				<div class="table-responsive">
					<table class="table tableStyle table-bordered text-center no-padding" >
						<thead>
						<tr>
							@if($received_with_terminal)
								<th class ="bgOn" style="background-color: #d3d3d3">Yes</th>
								<th>No</th>
							@else
								<th>Yes</th>
								<th class ="bgOn" style="background-color: #d3d3d3">No</th>
							@endif
						</tr>
						</thead>
					</table>
				</div>
			</div>
	</div>


	<br>
	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-12 text-left float-left m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: normal;font-size: 16px">Note : The same quantities of terminal Blocks & Screws are enclosed along with the relay. <u></u></h4></div>
	</div>

	<br>
	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-9  float-right m-l-10">
			<h4 class ="col-12" style="color:#000000; font-weight: normal;font-size: 20px"><u>Tested By :</u></h4></div>
			<br>
			<br>
			<h4 class ="col-9" style="color:#000000; font-weight: normal;font-size: 20px">Sign:</h4>
		<br>

			<br>
			<h4 class ="col-9" style="color:#000000; font-weight: normal;font-size: 20px">Name:</h4></div>
</div>


			<div class ="Footer ftr" style="margin-top:800px;">
				<div class = "row footerText text-left">
					<div class="col-12">
						<h6 style="font-weight: normal"> GE T&D India LTD , 19/1 , G.S.T Road ,Pallavaram,Chennai - 600 043</h6></div>
					<div class="col-12">
						<h6 class ="font-weight-bold "> Tel: +91 44 22648000 FAX: +91 442264 0040.<u>www.alstom.com</u> </h6>
					</div>
				</div>

				<div class ="row border-bottom border-dark">
				</div>
				<div class ="row">
					<div>
						<h6 style="color:#000000;margin-top:10px;font-weight: normal">REGISTERED OFFICE: A18 - 1st floor, Okhla Industrial Area , Phase - II , New Delhi - 110 020</h6>
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
<script>
	$(document).ready(function(){
	  window.print();
	});
</script>
</html>
