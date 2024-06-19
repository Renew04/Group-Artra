<?php
include('../includes/connection.php');
		 $query = "SELECT ID, e.FIRST_NAME, e.LAST_NAME, e.GENDER, USERNAME, PASSWORD, e.EMAIL, PHONE_NUMBER, j.JOB_TITLE, e.HIRED_DATE, t.TYPE, l.PROVINCE, l.CITY
                      FROM users u
                      join employee e on u.EMPLOYEE_ID = e.EMPLOYEE_ID
                      join job j on e.JOB_ID=j.JOB_ID
                      join location l on e.LOCATION_ID=l.LOCATION_ID
                      join type t on u.TYPE_ID=t.TYPE_ID
                      WHERE ID =".$_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
          while($row = mysqli_fetch_array($result))
          {  
                $zz= $row['ID'];
          }
            $id = $_GET['id'];
        $stats = $_GET['action'];
        if($stats == "active"){
           $query = 'UPDATE users u 
	 						join employee e on e.EMPLOYEE_ID=u.EMPLOYEE_ID
	 						join location l on l.LOCATION_ID=e.LOCATION_ID
	 						set u.Status="Active" WHERE ID ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
            echo "<script type='text/javascript'>alert('User are Activated!'); window.location = 'user.php';</script>";
        }else if($stats == "suspend"){
            $query = 'UPDATE users u 
	 						join employee e on e.EMPLOYEE_ID=u.EMPLOYEE_ID
	 						join location l on l.LOCATION_ID=e.LOCATION_ID
	 						set u.Status="Suspended" WHERE ID ="'.$zz.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
            echo "<script type='text/javascript'>alert('User are Suspended!'); window.location = 'user.php';</script>";
        }else{
            echo "<script type='text/javascript'>alert('Error'); window.location = 'user.php';</script>";
        }
?>