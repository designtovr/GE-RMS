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

</head>
<body class="text-right" style="height: 1196px;padding-left: 30px;padding-right: 30px; font-family: 'Oswald', sans-serif !important;">
<div class="main-content" ng-controller="TestReportFormController">
	<div class="section__content section__content--p30" ng-init="Start();">
	    <div class="container-fluid ">

<div class = "front">
<div class="text-uppercase">
			<div class="row">
				<div class="col" style="padding: 0;">
					<h1 class="text-right float-left d-md-flex justify-content-md-end" style="color: #000000;margin-top: 89px;margin-left: 150px;"><strong><u>Physical Verification Form</u></strong></h1><img src="{{url('public/images/240px-ge-logo.png')}}" class="img-fluid float-right d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px;margin-bottom: 0;"/></div>
			</div>

	<div class="row" style="margin-top: 9px;margin-left: 1px;">
		<div class="col-6">
			<h2 class="text-left float-left" style="font-size: 26px; color: #000000"><strong>RMA :  {{ $id }}</strong></h2>

		</div>

		<div class="col-6">
			<h2 class="text-left float-left" style="font-size: 26px; color: #000000"><strong>Customer :  {{ $customer_name }}</strong></h2>

		</div>
	</div>

	@foreach($unit_information as $unit)
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
							<td>{{$unit['part_no']}}</td>
							<td>{{$unit['serial_no']}}</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class=" col-12 text-left">
						<h4 class ="" style="color:#000000;">Remarks: <u>{{$unit['remark']}}</u></h4></div>
			</div>
			<div class="col-6 float-right">
				<div class="table-responsive">
					<table class="table tableStyle table-bordered text-left">
						<tbody>

						<tr>
							<td>
								@if($unit['battery'] == 1)
								<input type="checkbox" class="m-t-10" checked="1" disabled>
								@else
								<input type="checkbox" class="m-t-10" disabled>
								@endif
								<label class="form-check-label" for="exampleCheck1">Battery : </label>
							</td>
							<td>
								@if($unit['terminal_blocks'] == 1)
								<input type="checkbox" class="m-t-10" checked="1" disabled>
								@else
								<input type="checkbox" class="m-t-10" disabled>
								@endif
								<label class="form-check-label" for="exampleCheck1">TBs :
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
								@if($unit['top_bottom_cover'] == 1)
									<input type="checkbox" class="m-t-10" checked="1" disabled>
								@else
									<input type="checkbox" class="m-t-10" disabled>
								@endif
								<label class="form-check-label" for="exampleCheck1">Flops : </label>
							</td>
							<td>
								@if($unit['screws'] == 1)
								<input type="checkbox" class="m-t-10" checked="1" disabled>
								@else
								<input type="checkbox" class="m-t-10" disabled>
								@endif
								<label class="form-check-label" for="exampleCheck1">Screws : </label>
							</td>

						</tr>
						<tr>
							<td>
								<input type="checkbox" class="m-t-10" disabled>
								<label class="form-check-label" for="exampleCheck1">Rusted : </label></td>
							<td>
								<input type="checkbox" class="m-t-10" disabled>
								<label class="form-check-label" for="exampleCheck1">Damaged : </label>
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
