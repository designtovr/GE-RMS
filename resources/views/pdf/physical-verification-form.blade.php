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
	<title>GE-RMS - Physicalverification Form</title>

	<link href="{{url('public/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/css/theme.css')}}" rel="stylesheet" media="all">
	<style type="text/css">
		.printform table tr th {
			font-size: 18px !important;
			border: 1px solid !important;
		}
		.printform table tr td {
			font-size: 18px !important;
			border: 1px solid !important;
		}
	</style>
</head>
<body class="text-right ftr" style="height: 1196px;padding-left: 30px;padding-right: 30px; font-family: 'Oswald', sans-serif !important;">
<div class="main-content" ng-controller="TestReportFormController">
	<div class="section__content section__content--p30" ng-init="Start();">
	    <div class="container-fluid ">

<div class = "front ftr">
<div class="text-uppercase">
			<div class="row">
				<div class="col" style="padding: 0;">
					<h1 class="text-right float-left d-md-flex justify-content-md-end" style="color: #000000;margin-top: 89px;margin-left: 150px; font-size: 35px;"><strong><u>Physical Verification Form</u></strong></h1><img src="{{url('public/images/240px-ge-logo.png')}}" class="img-fluid float-right d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px;margin-bottom: 0;"/></div>
			</div>

	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6">
			<h2 class="text-left float-left" style="font-size: 18px; color: #000000"><strong>RMA :</strong>  <span style="font-weight: normal;">{{ $id }}</span> </h2>
		</div>

		<div class="col-6">
			<h2 class="text-left float-left" style="font-size: 18px; color: #000000"><strong>Customer : </strong>  <span style="font-weight: normal;">{{ $customer_name }}</span></h2>
		</div>
	</div>
	<div class="row" style="margin-top: 5px;margin-left: 1px;">
		<div class="col-6">
			<h2 class="text-left float-left" style="font-size: 18px; color: #000000"><strong>Location :</strong>  <span style="font-weight: normal;">{{ $location }}</span> </h2>
		</div>
		<div class="col-6">
			<h2 class="text-left float-left" style="font-size: 18px; color: #000000"><strong>Date :</strong>  <span style="font-weight: normal;">
				@if(isset($unit_information[0]))
					{{ date('d/m/Y',strtotime($unit_information[0]['created_at']))}}
				@else
					NA
				@endif</span> </h2>
		</div>
	</div>

	@foreach($unit_information as $unit)
		<div class="row" style="margin-top: 9px;margin-left: 1px;">
			<div class="col-7 float-left">
				<div class="table-responsive printform">
					<table class="table tableStyle table-bordered text-center">
						<thead>
						<tr>
							<th style="font-size: 20px;">R Id</th>
							<th style="font-size: 20px;">Model No.</th>
							<th style="font-size: 20px;">S No.</th>

						</tr>
						</thead>
						<tbody>
						<tr>
							<td style="font-size: 18px;">{{$unit['formatted_pv_id']}}</td>
							<td style="font-size: 18px">{{$unit['part_no']}}</td>
							<td style="font-size: 18px;">{{$unit['serial_no']}}</td>
						</tr>
						</tbody>
					</table>
				</div>
				<br>
				<div class=" col-12 text-left">
						<h4 class ="" style="color:#000000;">Remarks: <u>{{$unit['remark']}}</u></h4>
				</div>
			</div>
			<div class="col-5 float-right">
				<div class="table-responsive printform">
					<table class="table tableStyle table-bordered text-left">
						<tbody>

						<tr>
							<td>
								<label class="au-checkbox aucbab">
								@if($unit['battery'] == 1)
								<input type="checkbox" class="m-t-10 cb01" checked="1" disabled>
								@else
								<input type="checkbox" class="m-t-10" disabled>
								@endif
								<span class="au-checkmark"></span>
								</label>

								<label class="form-check-label" for="exampleCheck1" style="font-size: 13px; font-weight: bold;">Battery : </label>
							</td>
							<td>
								<label class="au-checkbox aucbab">

								@if($unit['terminal_blocks'] == 1)
								<input type="checkbox" class="m-t-10" checked="1" disabled>
								@else
								<input type="checkbox" class="m-t-10" disabled>
								@endif
									<span class="au-checkmark"></span>
								</label>
								<label class="form-check-label" for="exampleCheck1" style="font-size: 13px; font-weight: bold;">TBs :
									@if($unit['no_of_terminal_blocks'] == 0)
										{{$unit['no_of_terminal_blocks']}}
									@else
										{{substr($unit['no_of_terminal_blocks'], 0, 2)}} + {{substr($unit['no_of_terminal_blocks'], 2, 2)}}
									@endif
								</label>
							</td>

						</tr>
						<tr>
							<td>
								<label class="au-checkbox aucbab">

								@if($unit['top_bottom_cover'] == 1)
									<input type="checkbox" class="m-t-10" checked="1" disabled>
								@else
									<input type="checkbox" class="m-t-10" disabled>
								@endif
									<span class="au-checkmark"></span>
								</label>
								<label class="form-check-label" for="exampleCheck1" style="font-size: 13px; font-weight: bold;">Flops : </label>
							</td>
							<td>
								<label class="au-checkbox aucbab">

								@if($unit['screws'] == 1)
								<input type="checkbox" class="m-t-10" checked="1" disabled>
								@else
								<input type="checkbox" class="m-t-10" disabled>
								@endif
									<span class="au-checkmark"></span>
								</label>
								<label class="form-check-label" for="exampleCheck1" style="font-size: 13px; font-weight: bold;">Screws : </label>
							</td>

						</tr>
						<tr>
							<td>
								<label class="au-checkbox aucbab">

								<input type="checkbox" class="m-t-10" disabled>
								<span class="au-checkmark"></span>
								</label>
								<label class="form-check-label" for="exampleCheck1" style="font-size: 13px; font-weight: bold;">Rusted : </label></td>
							<td>
								<label class="au-checkbox aucbab">

								<input type="checkbox" class="m-t-10" disabled>
								<span class="au-checkmark"></span>
								</label>
								<label class="form-check-label" for="exampleCheck1" style="font-size: 13px; font-weight: bold;">Damaged : </label>
							</td>

						</tr>
						</tbody>
					</table>
				</div>


			</div>
		</div>
	@endforeach

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
