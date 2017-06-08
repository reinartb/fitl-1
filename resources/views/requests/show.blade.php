<!DOCTYPE html>
<html>
	<head>
		<title>PHIC Regional VII Office Supplies System</title>
	</head>
	<body>
		<h1>Requisition and Issuance Slip Number: {{ $request->ris_number }}</h1>
		<p>{{ $request->requested_by_section }}</p>
		<p>{{ $request->requested_by_user }}</p>
		<p>{{ $request->created_at }}</p>
		<p>{{ $request->purpose }}</p>
	</body>
</html> 