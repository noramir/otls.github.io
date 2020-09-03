<?php
	include 'header.php';
	include 'footer.php';

	$connect = mysqli_connect("localhost","root","","ot_logbook"); 

	if (mysqli_connect_errno())
	{
		echo "Oops! There might be a problem with the connection." . mysqli_connect_error();
	}
	$query = "SELECT department_otlog.Id,department_otlog.staff_name,department_otlog.employment_no,department_otlog.email,department_otlog.reason,department_otlog.total_hrs,
			department_otlog.start_time,department_otlog.end_time,department_otlog.status, department_hr.dep
			FROM
			department_otlog, department_hr
			WHERE
			department_otlog.deptID LIKE department_hr.id_dep AND department_otlog.status LIKE 'pending'
			ORDER BY department_otlog.Id"; //SELECT * FROM department_otlog WHERE status = 'pending'
	$resultTable = mysqli_query($connect, $query);

	if  (isset($_GET["action"])){ //FOR APPROVING

		if ($_GET["action"] == "approve"){

			$user_id = $_GET["id"];
			$sql = "UPDATE department_otlog SET status ='Approved' WHERE Id = '$user_id'";
			$result = mysqli_query($connect, $sql);

			if($result){
				echo '<script>alert("Application has been approved!")</script>';
			}
		}

		if ($_GET["action"] == "decline"){ //FOR DECLINING

			$user_id = $_GET["id"];
			$sql = "UPDATE department_otlog SET status ='Decline' WHERE Id = '$user_id'";
			$result = mysqli_query($connect, $sql);

			if($result){
				echo '<script>alert("Staff application has been rejected")</script>';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="EN">	
<head>
	<title>OTLS | Admin</title>

	<link rel="stylesheet" type="text/css" href="style/admin-style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- bootstrap cdn -->
	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> <!-- google fonts -->

	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#myTable').DataTable( {
				scrollY: '350px',
				scrollCollapse: true,
				paging: false,
				"autoWidth": true
			});
		});
	</script>
</head>
<body>
<div class="main-div">
	<table id="myTable" class="display" width="100%">
		<thead>
			<tr>
				<th>Id</th>
				<th>Status</th>
				<th>Staff Id</th>
				<th>Staff Name</th>
				<th>Department</th>
				<th>Start</th>	
				<th>End</th>
				<th>Reason</th>
				<th>Accept</th>
				<th>Reject</th>
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
					<td id="accept"><a class="btn btn-success" href="admin-panel.php?action=approve&id=' .$row["Id"]. '"><span class="material-icons">check</span></a></td>
					<td id="accept"><a class="btn btn-danger" href="admin-panel.php?action=decline&id=' .$row["Id"]. '"><span class="material-icons">close</span></a></td>
				</tr> 
				';
			}?>
		</tbody>
	</table>
</div>
</body>
</html>