<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="au theme template">
	<meta name="author" content="Hau Nguyen">
	<meta name="keywords" content="au theme template">

	<title>GE-RMS - Job Ticket</title>
	<link href="{{url('public/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
	<link href="{{url('public/css/theme.css')}}" rel="stylesheet" media="all">
	<style type="text/css">
		.footer {
		  position: fixed;
		  bottom: 0;
		}
	</style>
</head>
<body class="text-right" style="height: 1196px;padding-left: 30px;padding-right: 30px; font-family: 'Oswald', sans-serif !important;">
<div class="main-content" style="padding-top: 30px;">
<div class="section__content section__content--p30">
<div class="container-fluid ">
<div class = "front">
<div class="text-uppercase ftr">
	<div class="row">
		<div class="col" style="padding: 0;">
			<h1 class="text-right float-left d-md-flex justify-content-md-end" style="color: #000000;margin-top: 40px;margin-left: 350px;"><strong>Job Ticket</strong></h1><img src="{{url('public/images/240px-ge-logo.png')}}" class="img-fluid float-right d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px;margin-bottom: 0;"
			/></div>
	</div>
	<div class="row" style="margin-top: 5px;margin-left: 1px;">
		<div class="col">
			<h2 class="text-left float-left" style="font-size: 18px; color: #000000"><strong>Type Of Work : </strong></h2>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal; ;margin-left: 10px;color: #000000">
					@if($type == 1)
						Repair
					@elseif($type == 2)
						Modification
					@elseif($type == 3)
						Investigation
					@endif
			</h1>
		</div>
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;color: #000000"><strong>R Id: </strong></h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{$formatted_pv_id}}<strong></strong></h1>
		</div>
	</div>
	<div class="row" style="margin-top: 5px;margin-left: 1px;">
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;color: #000000;height:  ;">P.O Date: </h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{ date('d/m/Y',strtotime($podate))}}</h1>
		</div>
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;color: #000000"><strong>RMA No: </strong></h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{$formatted_rma_id}}<strong></strong></h1>
		</div>
	</div>
	<div class="row" style="margin-top: 5px;margin-left: 1px;">
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;color: #000000"><strong>Given Date: </strong></h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{ date('d/m/Y',strtotime($pvdate))}} </h1>
		</div>
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;color: #000000"><strong>Customer: </strong></h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{$customer_name}}</h1>
		</div>
	</div>
	<div class="row" style="margin-top: 5px;margin-left: 1px;">
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;color: #000000"><strong>Taken Date: </strong> </h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{ date('d/m/Y',strtotime($podate))}}</h1>
		</div>
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;color: #000000">End Customer  : </h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{$end_customer}}<strong></strong></h1>
		</div>
	</div>
	<div class="row" style="margin-top: 5px;margin-left: 1px;">
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;color: #000000">Model No: </h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{$model_no}}</h1>
		</div>
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;color: #000000">Serial No: </h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{$serial_no}}</h1>
		</div>
	</div>
	<div class="row" style="margin-top: 5px;margin-left: 1px;">
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;height:  ;color: #000000">POWER ON TEST: </h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{$power_on_test}}</h1>
		</div>
	</div>
	<div class="row" style="margin-top: 5px;margin-left: 1px;">
		<div class="col" style="margin-top: 8px;">
			<h1 class="text-left float-left" style="font-size: 18px;height:  ;color: #000000">NATURE OF DEFECT: </h1>
			<h1 class="text-left float-left" style="font-size: 18px;font-weight: normal ;margin-left: 10px;color: #000000">{{$nature_of_defect}}</h1>
		</div>
	</div>
	<br>
	<div class="table-responsive">
		<table class="table tableStyle table-bordered">
			<thead>
			<tr>
				<th style="font-size: 18px">SL No.</th>
				<th style="font-size: 18px">Material Part No</th>
				<th style="font-size: 18px">Description</th>
				<th style="font-size: 18px">Qty</th>
				<th style="font-size: 18px">Value (Rs)</th>
			</tr>
			</thead>
			<tbody>
				<tr>
					<td style="font-size: 15px">1</td>
					<td style="font-size: 15px">{{$job_materials[0]['part_no']}}</td>
					<td style="font-size: 15px">{{$job_materials[0]['comment']}}</td>
					<td style="font-size: 15px">{{$job_materials[0]['quantity']}}</td>
					<td style="font-size: 15px">{{$job_materials[0]['value']}}</td>
				</tr>
				<tr>
					<td style="font-size: 15px">2</td>
					<td style="font-size: 15px">{{$job_materials[1]['part_no']}}</td>
					<td style="font-size: 15px">{{$job_materials[1]['comment']}}</td>
					<td style="font-size: 15px">{{$job_materials[1]['quantity']}}</td>
					<td style="font-size: 15px">{{$job_materials[1]['value']}}</td>
				</tr>
				<tr>
					<td style="font-size: 15px">3</td>
					<td style="font-size: 15px">{{$job_materials[2]['part_no']}}</td>
					<td style="font-size: 15px">{{$job_materials[2]['comment']}}</td>
					<td style="font-size: 15px">{{$job_materials[2]['quantity']}}</td>
					<td style="font-size: 15px">{{$job_materials[2]['value']}}</td>
				</tr>
				<tr>
					<td style="font-size: 15px">4</td>
					<td style="font-size: 15px">{{$job_materials[3]['part_no']}}</td>
					<td style="font-size: 15px">{{$job_materials[3]['comment']}}</td>
					<td style="font-size: 15px">{{$job_materials[3]['quantity']}}</td>
					<td style="font-size: 15px">{{$job_materials[3]['value']}}</td>
				</tr>
				<tr>
					<td style="font-size: 15px">5</td>
					<td style="font-size: 15px">{{$job_materials[4]['part_no']}}</td>
					<td style="font-size: 15px">{{$job_materials[4]['comment']}}</td>
					<td style="font-size: 15px">{{$job_materials[4]['quantity']}}</td>
					<td style="font-size: 15px">{{$job_materials[4]['value']}}</td>
				</tr>
				<tr>
					<td style="font-size: 15px">6</td>
					<td style="font-size: 15px">{{$job_materials[5]['part_no']}}</td>
					<td style="font-size: 15px">{{$job_materials[5]['comment']}}</td>
					<td style="font-size: 15px">{{$job_materials[5]['quantity']}}</td>
					<td style="font-size: 15px">{{$job_materials[5]['value']}}</td>
				</tr>
				<tr>
					<td style="font-size: 15px">7</td>
					<td style="font-size: 15px">{{$job_materials[6]['part_no']}}</td>
					<td style="font-size: 15px">{{$job_materials[6]['comment']}}</td>
					<td style="font-size: 15px">{{$job_materials[6]['quantity']}}</td>
					<td style="font-size: 15px">{{$job_materials[6]['value']}}</td>
				</tr>
				<tr>
					<td style="font-size: 15px">8</td>
					<td style="font-size: 15px">{{$job_materials[7]['part_no']}}</td>
					<td style="font-size: 15px">{{$job_materials[7]['comment']}}</td>
					<td style="font-size: 15px">{{$job_materials[7]['quantity']}}</td>
					<td style="font-size: 15px">{{$job_materials[7]['value']}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<br>
	<div class="row" style="margin-top: 15px">
		<div class="col-5 float-left">
			<h1 class="text-left" style="font-size: 26px;color:#000000;margin-top: 25px;"></h1>
			<h1 class="text-left" style="font-size: 18px;color:#000000;margin-top: 25px;">Sign:</h1>
			<h1 class="text-left" style="font-size: 18px;color:#000000;margin-top: 25px;">Category:</h1>
		</div>
		<div class="col-7 float-right border border-dark" style="height:250px;padding :10px">
			<h1 class="text-left" style="font-size: 18px;color:#000000">Remarks: <span class="" style="font-weight: normal">{{$remarks}}</span></h1>
		</div>
	</div>
</div>
<div class ="Footer ftr footer" style="margin-top:15px;">
	<div class="row ">
		<div class="col" style="padding: 0;">
			<img src="{{url('public/images/240px-ge-logo.png')}}" class="img-fluid float-left d-md-flex justify-content-end align-items-end justify-content-md-end align-items-md-end" style="width: 100px;height: 100px;margin: 48px 0px;margin-bottom: 0;"
			/>
		</div>
	</div>
	<div class = "row footerText">
		<h6 style="color:#000000; font-weight:normal;"> ALSTOM T&D India LTD , 19/1 , G.S.T Road ,Pallavaram,Chennai - 600 043</h6>
		<br>
		<h6 class ="font-weight-bold" >    Tel: +91 44 22648000 FAX: +91 442264 0040.<u>www.alstom.com</u> </h6>
	</div>
	<div class ="row border-bottom border-dark">
	</div>
	<div class ="row">
		<div>
			<h6 style="color:#000000; font-weight:normal;margin-top:10px;">REGISTERED OFFICE: A18 - 1st floor, Okhla Industrial Area , Phase - II , New Delhi - 110 020</h6>
		</div>
	</div>
</div>
<div class = "back ftr">
	<div class = "row m-t-70">
		<div class="col-md-12 m-t-70">
			<h1 class="text-center font-weight-bold" style="font-size:24px;color:#000000;" > <u>Details of Changed Components</u>
			</h1>
    	</div>
	</div>
	<br>
	<div class = "row ">
		<div class="col-12 p-l-0 p-r-0">
			<div class="table-responsive">
				<table class="table tableStyle table-bordered">
			    <thead>
			      <tr>
			        <th>
			        	<h1 class="text-center" style="font-size:18px;color:#000000;" >OLD COMPONENT</h1>
			        </th>
			        <th>
			        	<h1 class="text-center" style="font-size:18px;color:#000000;" >NEW COMPONENT</h1>
			        </th>
			      </tr>
			    </thead>
			    <tbody>
			    	@foreach($job_materials as $index => $material)
					<tr>
						<td style="font-size:15px">{{$material['old_pcp']}}</td>
						<td style="font-size:15px">{{$material['new_pcp']}}</td>
					</tr>
					@endforeach
			    </tbody>
			 </table>
			</div>
		</div>
	</div>
	<br>
    <div class = "row ">
        <div class="col-12 text-left border border-dark h-250" style="height:250px;color:#000000;font-size: 20px;">
            <u>Notes :</u>
        </div>
    </div>
        <div class = "row">
            <div class="col-12 text-left " style="color:#000000;font-size: 20px;">
                <span class="zmdi zmdi-arrow-right"></span><u>Relay Received With</u>
            </div>
            <div class="col-sm-6">
            	<div class="col-sm-3">
            		<label class="au-checkbox">
            			@if($case == 1)
	                    <input type="checkbox" checked="1" disabled>
	                    @else
	                    <input type="checkbox" disabled>
	                    @endif
	                    <span class="au-checkmark"></span>
	                </label>
            	</div>
        		<div class="col-sm-3">
        			<label class="form-check-label" for="exampleCheck1">Case</label>
        		</div>
        	</div>
        	<div class="col-sm-6">
        		<div class="col-sm-2">
            		<label class="au-checkbox">
            			@if($terminal_blocks == 1)
	                    <input type="checkbox" checked="1" disabled>
	                    @else
	                    <input type="checkbox" disabled>
	                    @endif
	                    <span class="au-checkmark"></span>
	                </label>
            	</div>
        		<div class="col-sm-6">
        			<label class="form-check-label" for="exampleCheck1">Terminal Blocks: 
        				<u>
        					@if($no_of_terminal_blocks == 0)
        						{{ $no_of_terminal_blocks }}
        					@else
        						{{substr($no_of_terminal_blocks, 0, 2)}} + {{substr($no_of_terminal_blocks, 2, 2)}}
        					@endif
        				</u>
        			</label>
        		</div>
        	</div>

        	<div class="col-sm-6">
        		<div class="col-sm-3">
        			<label class="au-checkbox">
        				@if($battery == 1)
	                    <input type="checkbox" checked="1" disabled>
	                    @else
	                    <input type="checkbox" disabled>
	                    @endif
	                    <span class="au-checkmark"></span>
	                </label>
        		</div>
        		<div class="col-sm-3">
        			<label class="form-check-label" for="exampleCheck1">Battery</label>
        		</div>
        	</div>

        	<div class="col-sm-6">
        		<div class="col-sm-2">
            		<label class="au-checkbox">
	                    @if($short_links == 1)
	                    <input type="checkbox" checked="1" disabled>
	                    @else
	                    <input type="checkbox" disabled>
	                    @endif
	                    <span class="au-checkmark"></span>
	                </label>
            	</div>
        		<div class="col-sm-6">
        			<label class="form-check-label" for="exampleCheck1">Short Links: <u>{{$no_of_short_links}}</u></label>
        		</div>
        	</div>

        	<div class="col-sm-6">
        		<div class="col-sm-3">
        			<label class="au-checkbox">
	                    @if($screws == 1)
	                    <input type="checkbox" checked="1" disabled>
	                    @else
	                    <input type="checkbox" disabled>
	                    @endif
	                    <span class="au-checkmark"></span>
	                </label>
        		</div>
        		<div class="col-sm-3">
        			<label class="form-check-label" for="exampleCheck1">Screws</label>
        		</div>
        	</div>

        	<div class="col-sm-6">
        		<div class="col-sm-2">
        			<label class="au-checkbox">
	                    @if($top_bottom_cover == 1)
	                    <input type="checkbox" checked="1" disabled>
	                    @else
	                    <input type="checkbox" disabled>
	                    @endif
	                    <span class="au-checkmark"></span>
	                </label>
        		</div>
        		<div class="col-sm-6">
        			<label class="form-check-label" for="exampleCheck1">Top/Bottom Access Cover(Flops)</label>
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

