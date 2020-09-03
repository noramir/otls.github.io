<?php
    include 'includes/db.inc.php';
    include 'header.php';
    include 'footer.php';
?>

<!DOCTYPE html>
<html>   
    <head>
        <title>Application</title>
        <link rel="stylesheet" type="text/css" href="style/form-style.css">

        <meta charset="utf-8"/>
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script>
        	$(document).ready(function(){
        		var dt = new Date();
        		var month = dt.getMonth()+1;
        		var day = dt.getDate();
        		var time = '18:30';
        		var startdate = dt.getFullYear() + '-' + ((''+month).length<2 ? '0' : '') + month + '-' + ((''+day).length<2 ? '0' : '') + day + 'T'+  time; 
        		var enddate = dt.getFullYear() + '-' + ((''+month).length<2 ? '0' : '') + month + '-' + ((''+day).length<2 ? '0' : '') + day;   

        		$("#start").val(startdate); //for auto select today's date and 6:30pm.
        	})
        </script>
        <script>
        	$(document).ready(function(){
        		var dt = new Date();
        		var month = dt.getMonth()+1;
        		var day = dt.getDate();
                var etime = '9:30';
        		var enddate = dt.getFullYear() + '-' + ((''+month).length<2 ? '0' : '') + month + '-' + ((''+day).length<2 ? '0' : '') + day + 'T' + etime;   
        		$("#enddate").val(enddate);	//for auto select today's date only.
        	})
        </script>
    </head>
    <body>
    <div class="main">
        <div class="container">
            <div class="row">

                <div class="banner col-3">
                    <h3>Application Form</h3>
                </div>

                <div class="form col-9">
                    <form class="apply-form" action="apply.php" method="post">

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="fullName" class="form-control" value="<?php echo $_SESSION['fname'], $_SESSION['mname'] .'&nbsp;'. $_SESSION['lname']?>" required readonly>
                        </div>    

                        <div class="form-row">
                            <div class="form-group col-5">
                                <label>Employment No.</label>
                                <input type="text" name="staffID" class="form-control" value="<?php echo $_SESSION['staff']?>" style="text-transform:uppercase" required readonly>
                            </div>

                            <div class="form-group col-7">
                                <label>Department</label>
                                <select class="form-control; custom-select" id="department" name="deptsel">

                                <?php echo "<option value='". $_SESSION['deptid'] ."' selected>" .$_SESSION['dept'] ."</option>";?> <!-- echo dept here based on user_en --> 

                                <?php 
                                    while($data = mysqli_fetch_array($resultDropdown))
                                    {
                                        echo "<option value='". $data['id_dep'] ."' required>" .$data['dep'] ."</option>";
                                    }   
                                ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="userEmail" class="form-control" value="<?php echo $_SESSION['email']?>" required readonly>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-1">
                                <label>Start</label>
                            </div>
                            <div class="form-group col-5">
                            	<input type="datetime-local" id="start" class="form-control" class="start" name="startTime">
                                <!-- <input type="text" value="<?php echo date()?>" class="form-control" id="start" name="startTime" required> -->
                                <!-- <input  class="form-control" id="sdateField" type="date" value="<?php echo date("Y-m-d")?>" selected>
                            </div>
                            <div class="form-group col-5">
                                <input class="form-control" id="stimeField" name="startTime" type="time" value="18:30">
                                <input style="display: none" id="sresultField" name="startTime" type="datetime-local">   -->
                            </div>
                          <!--   <div class="form-group col-1">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="button" aria-pressed="false" autocomplete="off"><span class="material-icons">check</span></button>
                            </div> -->
                        </div>
                        <div class="form-row">
                            <div class="form-group col-1">
                                <label>End</label>
                            </div>
                            <div class="form-group col-5">
                            	<input type="datetime-local" id="enddate" class="form-control" name="endTime">
                                <!-- <input type="text" value="<?php echo date()?>" class="form-control" id="start" name="startTime" required> -->
                              <!--   <input  class="form-control" id="edField" type="date" value="<?php echo date("Y-m-d")?>">
                            </div>
                            <div class="form-group col-5">
                                <input class="form-control" id="etField" name="endTime" type="time">
                                <input style="display: none;" id="erField" name="endTime" type="datetime-local">   -->
                            </div>
                            <!-- <div class="form-group col-1">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="button" aria-pressed="false" autocomplete="off"><span class="material-icons">check</span></button>
                            </div> -->
                        </div>

                        <!-- <div class="form-row">
                            <div class="form-group col-1">
                                <label>End</label>
                            </div> -->
                                <!-- <input type="datetime-local" class="form-control" id="end" name="endTime" required> -->
                                <!-- <input  class="form-control" id="edField" type="date">
                                <input  class="form-control" id="etField" type="time">
                                <input  id="erField" name="endTime" type="datetime-local">  
                            </div>
                        </div>  -->

                        <div class="form-group">
                            <label>Reason</label>
                            <textarea class="form-control" id="reason" value="reason" name="reason" placeholder="Reason for applying OT" rows="2" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-outline-primary btn-block">Sumbit</button> 

                    </form>
                </div>
            </div>
        </div>
    </div>

   <!--  <script>
        $(document).ready(function() {
        var mydate, mytime, mystring;
        $("#sdateField").blur(function() {
            if ($(this).val()) {
            setResult();
            }
        })

        $("#stimeField").change(function() {
            setResult()
        })
        })

        function setResult() {
        mydate = $("#sdateField").val();
        mytime = $("#stimeField").val();
        mystring = mydate + 'T' + mytime;
        document.getElementById('sresultField').value = mystring;
        }
    </script>
    <script>
        $(document).ready(function() {
        var mydate, mytime, mystring;
        $("#edField").blur(function() {
            if ($(this).val()) {
                endDateTime();
            }
        })

        $("#etField").change(function() {
            endDateTime();
        })
        })

        function endDateTime() {
        mydate = $("#edField").val();
        mytime = $("#etField").val();
        mystring = mydate + 'T' + mytime;
        document.getElementById('erField').value = mystring;
        }
    </script>   --> 


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>