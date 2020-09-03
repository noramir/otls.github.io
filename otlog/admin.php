<?php
	include 'header.php';
	include 'footer.php';

	$connect = mysqli_connect("localhost","root","","ot_logbook"); 

	if (mysqli_connect_errno())
	{
		echo "Oops! There might be a problem with the connection." . mysqli_connect_error();
	}
  $query = "SELECT * FROM department_otlog ORDER BY start_time ASC";
	$resultTable = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>

  <link rel="stylesheet" type="text/css" href="style/admin-style.css">
<!-- jquery for datatables -->  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- css for datatables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<!-- js script for datatables -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</head>
<body>
  <div class="container">
  <table id="myTable" class="display" width="auto">
    <thead>
      <tr>
          <th>Status</th>
					<th>Staff Id</th>
					<th>Staff Name</th>
					<th>Department</th>
					<th>Start</th>
					<th>End</th>
					<th>Reason</th>
					<th>Approve</th>
          <th>Reject</th>
		  </tr>
    </thead>
    <tbody id="displayTable">
      <?php
      while($row =  mysqli_fetch_array($resultTable)){
        echo '
          <tr >
            <td id="status" class="status">'.$row["status"].'</td>
            <td id="staffID" class="staffID">'.$row["employment_no"].'</td>
            <td id="staffName" class="staffName">'.$row["staff_name"].'</td>
						<td id="department" class="department">'.$row["deptID"].'</td>						
						<td id="start" class="start">'.$row["start_time"].'</td>
						<td id="end" class="end">'.$row["end_time"].'</td>
						<td id="reason" class="reason">'.$row["reason"].'</td>
						<td id="accept"><button href="admin.php?=action=approve" class="btn btn-success"><span class="material-icons">check</span></button></td>
						<td id="reject"><button class="btn btn-danger"><span class="material-icons">close</span></button></td>
          </tr>
          ';
      }?>
    </tbody>
  </table>
  </div>
</body>
</html>

<script>
$(document).ready(function() {
    $('#myTable').DataTable({
      scrollY: '350px'
    });
} );  
  </script>