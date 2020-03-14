<!DOCTYPE html>
<html>
<head>
	<title>Dispatch Completion</title>
</head>
<body>
	<p><b>Dear Customer,</b></p>
			The below product shall be dispatched today with the below correspondance
	<br>
	<br>
	<b>Delivery Challan:</b> {{$dispatches[0]->dc_no}}
	<br>
	@if(!is_null($dispatches[0]->docket_details))
		<b>Dispatch by:</b> Courier
		<br>
		<b>Dispatch Docket:</b> {{$dispatches[0]->docket_details}}
		<br>
		<b>Courier Name:</b> {{$dispatches[0]->courier_name}}
	@else
		<b>Dispatch by:</b> Hand
		<br>
		<b>Person Name:</b> {{$dispatches[0]->person_name}}
		<br>
		<b>Concern Name:</b> {{$dispatches[0]->concern_name}}
		<br>
		<b>Contact:</b> {{$dispatches[0]->contact}}
	@endif
	<br>
	<br>
	@foreach($dispatches as $key => $dispatch)
	<b>{{$key + 1}}</b>
	<br>
	<b>RMA:</b> {{$dispatch['formatted_rma_id']}}
	<br>
	<b>RID:</b> {{$dispatch['formatted_pv_id']}}
	<br>
	<b>MODEL:</b> {{$dispatch['part_no']}}
	<br>
	<b>SERIAL:</b> {{$dispatch['serial_no']}} 
	<br>
	<br>
	@endforeach
	<br>
	<br>
	If you need further assistance, please reply
	<br>
	<br>
	Thank you,
	<br>
	Certified Repair Centre 
</body>
</html>