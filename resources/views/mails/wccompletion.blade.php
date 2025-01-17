<!DOCTYPE html>
<html>
<head>
	<title>W/C Declaration Completion</title>
</head>
<body>
	<p><b>Dear Customer,</b></p>
			The below relay is declared to be repaired / Modified on 
			@if($pcp == 1)
				Chargable
			@elseif($pcp == 2)
				Warranty
			@else
				NA
			@endif
	<br>
	<br>
	<b>RMA:</b> {{$formatted_rma_id}}
	<br>
	<b>RID:</b> {{$formatted_pv_id}}
	<br>
	<b>MODEL:</b> {{$part_no}}
	<br>
	<b>SERIAL:</b> {{$serial_no}} 
	<br>
	<b>Defect reported by customer:</b> {{$comment}}
	<br>
	<br>
	@if($pcp == 2)
		The tentative date of dispatch would be <b>{{ $created_date }}</b>
	@elseif($pcp == 1)
		A quote containig Repair / Modification Charges would be updated you separately. 
	@endif
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