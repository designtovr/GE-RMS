<!DOCTYPE html>
<html>
<head>
	<title>Daily Report</title>
	<style type="text/css">
		.blue
		{
		border:1.0pt solid #000000 !important;
		background:#5B9BD5 !important;
		font-size:11.0pt !important;
		color:white !important;
		}
		.bluebody tr:nth-child(odd) {background-color: #BDD7EE;}
		.bluebody tr:nth-child(even) {background-color: #DDEBF7;}
		.green
		{
		border:1.0pt solid #090909 !important;
		background:#96cb69 !important;
		font-size:11.0pt !important;
		color:white !important;
		}
		.greenbody tr:nth-child(even) {background-color: #C6E0B4;}
		.greenbody tr:nth-child(odd) {background-color: #E2EFDA;}
		.yellow
		{
		font-family:Arial !important;
		border:1.0pt solid white !important;
		background:#FFC000 !important;
		font-size:11.0pt !important;
		color:white !important;
		}
		.yellowbody tr:nth-child(even) {background-color: #D9D9D9;}
		.yellowbody tr:nth-child(odd) {background-color: #f2f2f2;}
		.orange
		{
		font-family:Arial !important;
		border:1.0pt solid white !important;
		background:#ED7D31 !important;
		font-size:11.0pt !important;
		color:white !important;
		}
		.orangebody tr:nth-child(even) {background-color: #FCE4D6;}
		.orangebody tr:nth-child(odd) {background-color: #FCE4D6;}
		table
		{
		border-collapse: collapse;
		font-family: 'Poppins', sans-serif !important;
		font-weight: 600;
		}
		table,  td {
		border: 1px solid black;
		font-family: 'Poppins', sans-serif;
		font-size: 18px ;
		color: #0a0a0a ;
		font-weight: bolder ;
		}
		.main-content
		{

		}
		.h2-heading
		{
			font-size: 20px !important;
		}

		h2
		{
		font-family: 'Poppins', sans-serif !important;
		font-size: 24px !important;
		color: #0a0a0a !important;
		font-weight: bolder !important;
		}

		thead
		{
		color: white;
		background: -webkit-linear-gradient(90deg, #001235 0%, #0259b5 100%) ;
		border: 1px solid black;
		font-family: 'Poppins', sans-serif ;
		font-weight: 600;
		}
		th
		{
		border: 1px solid black;
		font-family: 'Poppins', sans-serif ;
		font-weight: 600;
		padding: 10px;
		}
		ul li
		{
		list-style: none;
		}
	</style>
</head>
<body style ="font-family: 'Poppins', sans-serif !important;">
	<div class="main-content">
		<div class="section__content section__content--p30">
			<ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
				<li>
					<h2 class="h2-heading">Received Relays</h2>
					<table>
						<thead class="blue">
							<th>Family</th>
							<th>Number of Relays Received</th>
							<th>Cumulative Relays</th>
						</thead>
						<tbody class="bluebody">
							@foreach ($received_relays as $relays)
							<tr>
								<td >{{$relays->type_name}}</td>
								<td >{{$relays->total}}</td>
								<td >{{$relays->cumulative}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</li>
			</ul>
			<ul class="tablerowlist" id="tablerowlist"style ="width : 40%;float:left">
			<li>
			<h2 class="h2-heading">Total Relays Completed</h2>
				<table>
				<thead class="green">
					<th>Family</th>
					<th>Repair</th>
					<th>Test</th>
					<th>Dispatch</th>
					<th>Total</th>
				</thead>
				<tbody class="greenbody">
					@foreach ($total_relays_completed as $relays)
					<tr>
						<td >{{$relays->type_name}}</td>
						<td >{{$relays->repair}}</td>
						<td >{{$relays->test}}</td>
						<td >{{$relays->dispatch}}</td>
						<td >{{$relays->total}}</td>
					</tr>
					@endforeach
				</tbody>
				</table>
			</li>
			</ul>
			<ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
				<li>
					<h2 class="h2-heading">Total Relays Overdue</h2>
					<table>
						<thead class = "yellow">
							<th>Family</th>
							<th>Repair</th>
							<th>Test</th>
							<th>Dispatch</th>
							<th>Total</th>
						</thead>
						<tbody class = "yellowbody">
							@foreach ($total_relays_overdues as $relays)
							<tr>
								<td >{{$relays->type_name}}</td>
								<td >{{$relays->repair}}</td>
								<td >{{$relays->test}}</td>
								<td >{{$relays->dispatch}}</td>
								<td >{{$relays->total}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</li>
			</ul>
			<ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
				<li>
					<h2 class="h2-heading">Total Chargeable</h2>
					<table>
						<thead class="green">
							<th>Family</th>
							<th>Total</th>
						</thead>
						<tbody class="greenbody">
							@foreach ($total_chargeable as $relays)
							<tr>
								<td >{{$relays->type_name}}</td>
								<td >{{$relays->total}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</li>
			</ul>
			<ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
				<li>
				<h2 class="h2-heading">Total Completed</h2>
				<table>
					<thead class="green">
						<th>Conventional</th>
						<th>Numerical</th>
						<th>Multilin</th>
						<th>Recent</th>
						<th>BOJ</th>
						<th>Total</th>
					</thead>
					<tbody class="greenbody">
					<tr>
						<td >{{$total_completed['CONVENTIONAL']}}</td>
						<td >{{$total_completed['NUMERICAL']}}</td>
						<td >{{$total_completed['MULTILIN']}}</td>
						<td >{{$total_completed['REASON']}}</td>
						<td >{{$total_completed['BOJ']}}</td>
						<td >{{$total_completed['total']}}</td>
					</tr>
					</tbody>
				</table>
				</li>
			</ul>
			<br>
			<ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:right">
				<li>
					<h2 class="h2-heading">Warranty Overdue</h2>
					<table>
						<thead class="blue">
							<th>Family</th>
							<th>Overdues</th>
						</thead>
						<tbody class="bluebody">
						@foreach ($warranty_overdue as $relays)
						<tr>
							<td >{{$relays->type_name}}</td>
							<td >{{$relays->total}}</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</li>
			</ul>
			<ul class="tablerowlist" id="tablerowlist" style ="width : 40%;float:left">
				<li>
					<h2 class="h2-heading">Repair Lead Time</h2>
					<table>
						<thead class="orange">
							<th>Type / Category</th>
							<th>Days</th>
						</thead>
						<tbody class="orangebody">
							@foreach ($repair_lead_time as $relays)
							<tr>
								<td >{{strtoupper($relays->type_name)}}</td>
								<td >{{number_format($relays->average, 1, '.', ',')}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>
