<!DOCTYPE html>
<html>
<head>
	<title>Receipt Completion</title>
</head>
<body>
	<p><b>Dear Customer,</b></p>
			GE Certified Repair Centre Pallavaram has received materials for repair / investigation. Kindly find the 
		relevantdetails below...
	<br>
	<br>
	<b>Receipt Id:</b> {{$formatted_receipt_id}}
	<br>
	<b>No Of Boxes:</b> {{$total_boxes}}
	<br>
	<b>Mode Of Receipt:</b> COURIER 
	<br>
	<b>Name Of Courier:</b> {{strtoupper($courier_name)}}
	<br>
	<b>Docket Number:</b> {{$docket_details}}
	<br>
	<br>
	We shall provide the next update upon unpacking, Physical verification of the materials. 
	<br>
	If you need further assistance, please reply
	<br>
	<br>
	Thank you,
	<br>
	Certified Repair Centre 

</body>
</html>