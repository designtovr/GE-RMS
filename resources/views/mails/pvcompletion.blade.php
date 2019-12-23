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
	<br>
	@endforeach
	<br>
	<br>
	RECEIPT CONDITION: < PHYSICAL DAMAGE STATUS> Relay recived with the following
	(All relay received with status skipping not applicable criteria)
	<br>
	<br>

	We shall provide the next update upon on (Warrantry / Chargable)  declaration
	If you need further assistance, please contact <b>CRC Hotline</b>
	<br>
	<br>

	Thank you,
	<br>
	Certified Repair Centre 

</body>
</html>