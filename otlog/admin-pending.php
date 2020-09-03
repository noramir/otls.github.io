<?php
	require 'header.php';
	require 'footer.php';

	$connect = mysqli_connect("localhost","root","","ot_logbook"); 

	if (mysqli_connect_errno())
	{
		echo "Oops! There might be a problem with the connection." . mysqli_connect_error();
	}
	$query = "SELECT * FROM department_otlog ORDER BY start_time ASC";
	$resultTable = mysqli_query($connect, $query);

	if( status)
?>
<!DOCTYPE html>
<html>
<head>
	<title>OTLS | Pending List</title>

		<meta charset="utf-8"/>
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" type="text/css" href="style/admin-pending-style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min. js" />

        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

		<script type="text/javascript" href="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>
	<div class="main">
		<div class="container">
			<div class="row">
				<table id="myTable" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th >Staff Id</th>
							<th >Staff Name</th>
							<th >Department</th>
							<th >Start</th>
							<th >End</th>
							<th >Reason</th>
							<th >Accept</th>
							<th >Reject</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						while ($row = mysqli_fetch_array($resultTable)){
							echo '<tr id='.$row["Id"].'>
								<td id="staffID" class="staffID">'.$row["employment_no"].'</td>
								<td id="staffName" class="staffName">'.$row["staff_name"].'</td>
								<td id="department" class="department">'.$row["deptID"].'</td>						
								<td id="start" class="start">'.$row["start_time"].'</td>
								<td id="end" class="end">'.$row["end_time"].'</td>
								<td id="reason" class="reason">'.$row["reason"].'</td>
								<td id="accept"><button class="btn btn-success"><span class="material-icons">check</span></button></td>
								<td id="accept"><button class="btn btn-danger"><span class="material-icons">close</span></button></td>
							</tr> 
							';
						}?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready( function () {
    	$('#myTable').DataTable({
    		scrollY:        '300px',
			scrollCollapse: true,
			paging:         true,
			"columnDefs":
			[
				{ "orderable": false, "targets": 0 }
			]
    	});
	});
</script>