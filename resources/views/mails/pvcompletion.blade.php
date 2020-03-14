<!DOCTYPE html>
<html>
<head>
	<title>Physical Verification Completion</title>
</head>
<body>
	<p><b>Dear Customer,</b></p>
	           Kindly find the Physical verification details of <b>Receipt ID : {{$formatted_receipt_id}} </b> below...
	<br>
	<br>
	<b>RMA :</b> {{$formatted_rma_id}}
	<br>
	<br>
	@foreach($unit_information as $key => $unit)
	<b>{{$key + 1}}</b>
	<br>
	<b>RID:</b> {{$unit['formatted_pv_id']}}
	<br>
	<b>MODEL:</b> {{$unit['part_no']}}
	<br>
	<b>SERIAL:</b> {{$unit['serial_no']}}
	<br>
	<b>Relay recived with the following:</b>
	<br>
		1.<b>Case: </b>
		@if($unit['case'] == 1)
			Yes 
		@elseif($unit['case'] == 2)
			No
		@else
			Not Applicable
		@endif,
		<b>Condition: </b>
		@if($unit['case'] == 1 && $unit['case_condition'] == 1)
			Damaged
		@elseif($unit['case'] == 1 && $unit['case_condition'] == 2)
			Undamaged
		@else
			Not Applicable
		@endif
		<br>
		2.<b>Battery: </b>
		@if($unit['battery'] == 1)
			Yes 
		@elseif($unit['battery'] == 2)
			No
		@else
			Not Applicable
		@endif, 
		<b>Condition: </b>
		@if($unit['battery'] == 1 && $unit['battery_condition'] == 1)
			Damaged
		@elseif($unit['battery'] == 1 && $unit['battery_condition'] == 2)
			Undamaged
		@else
			Not Applicable
		@endif
		<br>
		3.<b>Terminal Blocks: </b>
		@if($unit['terminal_blocks'] == 1)
			Yes 
		@elseif($unit['terminal_blocks'] == 2)
			No
		@else
			Not Applicable
		@endif,
		<b>No. Of Terminal Blocks: </b>
		@if($unit['terminal_blocks'] == 1 && $unit['no_of_terminal_blocks'] != 0)
			{{substr($unit['no_of_terminal_blocks'], 0, 2)}} + {{substr($unit['no_of_terminal_blocks'], 2, 2)}}
		@else
			0
		@endif, <b>Condition: </b>
		@if($unit['terminal_blocks'] == 1 && $unit['terminal_blocks_condition'] == 1)
			Damaged
		@elseif($unit['terminal_blocks'] == 1 && $unit['terminal_blocks_condition'] == 2)
			Undamaged
		@else
			Not Applicable
		@endif
		<br>
		4.<b>Top/Bottom Access Cover: </b>
		@if($unit['top_bottom_cover'] == 1)
			Yes 
		@elseif($unit['top_bottom_cover'] == 2)
			No
		@else
			Not Applicable
		@endif, <b>Condition: </b>
		@if($unit['top_bottom_cover'] == 1 && $unit['top_bottom_cover_condition'] == 1)
			Damaged
		@elseif($unit['top_bottom_cover'] == 1 && $unit['top_bottom_cover_condition'] == 2)
			Undamaged
		@else
			Not Applicable
		@endif
		<br>
		5.<b>Short links: </b>
		@if($unit['short_links'] == 1)
			Yes 
		@elseif($unit['short_links'] == 2)
			No
		@else
			Not Applicable
		@endif, <b>No. Of Short Links: </b>
		@if($unit['short_links'] == 1)
			{{$unit['no_of_short_links']}}
		@else
			0
		@endif, <b>Condition: </b>Not Applicable
		<br>
		6.<b>Screws: </b>
		@if($unit['screws'] == 1)
			Yes 
		@elseif($unit['screws'] == 2)
			No
		@else
			Not Applicable
		@endif
	<br>
	<br>
	@endforeach
	We shall provide the next update upon on (Warrantry / Chargable)  declaration
	If you need further assistance, please reply
	<br>
	<br>

	Thank you,
	<br>
	Certified Repair Centre 

</body>
</html>