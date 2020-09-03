<?php

	require 'header.php';
	require 'footer.php';

	session_start();
	$connect = mysqli_connect("localhost","root","","ot_logbook"); 

	if (mysqli_connect_errno())
	{
		echo "Oops! There might be a problem with the connection." . mysqli_connect_error();
	}

	$user_id = $_SESSION['staffID'];
	$query = "SELECT department_otlog.Id,department_otlog.staff_name,department_otlog.employment_no,department_otlog.email,department_otlog.reason,department_otlog.total_hrs,
			department_otlog.start_time,department_otlog.end_time,department_otlog.status, department_hr.dep
			FROM
			department_otlog, department_hr
			WHERE
			department_otlog.deptID LIKE department_hr.id_dep AND department_log.employment_no LIKE $user_id;
			ORDER BY department_otlog.Id";
	$resultTable = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>OTLS | View</title>

	<meta charset="utf-8">
	<meta name="viewport" content="user-scalable=no, width=device-width" />

<!--css for content-->
	<link rel="stylesheet" type="text/css" href="style/display.css"> 
	<!-- jquery for datatables -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- css for datatables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<!-- js script for datatables -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>


	<script src="https://ajax.googleapis.com/ajax/libs/d3js/5.15.1/d3.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min. js" />

	<!-- BOOTSTRAP CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>
<div class="main">
	<table id="tableOT" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Application Id</th>
				<th>Status</th>
				<th>Staff Id</th>
				<th>Staff Name</th>
				<th>Department</th>
				<th>Start</th>	
				<th>End</th>
				<th>Reason</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			while ($row = mysqli_fetch_array($resultTable)){
				echo '
				<tr>
					<td id="Id" class="Id">'.$row["Id"].'</td>
					<td id="status" class="status">'.$row["status"].'</td>
					<td id="staffID" class="staffID">'.$row["employment_no"].'</td>
					<td id="staffName" class="staffName">'.$row["staff_name"].'</td>
					<td id="department" class="department">'.$row["dep"].'</td>							
					<td id="start" class="start">'.$row["start_time"].'</td>
					<td id="end" class="end">'.$row["end_time"].'</td>
					<td id="reason" class="reason">'.$row["reason"].'</td>
				</tr> 
				';
			}?>
		</tbody>
	</table>
</div>
</body>
</html>

<script>
	$(document).ready(function(){

		var table = $('#tableOT').DataTable({
			// orderCellsTop: true,
			// fixedHeader: true,
			scrollY: '350px',
			scrollCollapse: true,
			paging: true,
			"autoWidth": false

		});
	});
</script>	