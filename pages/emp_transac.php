<?php
include'../includes/connection.php';
?>
            <?php
              $fname = $_POST['firstname'];
              $lname = $_POST['lastname'];
              $gen = $_POST['gender'];
              $email = $_POST['email'];
              $phone = $_POST['phonenumber'];
              $jobb = $_POST['jobs'];
              $hdate = $_POST['hireddate'];
              $prov = $_POST['province'];
              $cit = $_POST['city'];
              
              mysqli_query($db,"INSERT INTO location
                              (LOCATION_ID, PROVINCE, CITY)
                              VALUES (Null,'$prov','$cit')");
              mysqli_query($db,"INSERT INTO employee
                              (EMPLOYEE_ID, FIRST_NAME, LAST_NAME,GENDER, EMAIL, PHONE_NUMBER, JOB_ID, HIRED_DATE, LOCATION_ID)
                              VALUES (Null,'{$fname}','{$lname}','{$gen}','{$email}','{$phone}','{$jobb}','{$hdate}',(SELECT LOCATION_ID FROM location ORDER BY LOCATION_ID DESC LIMIT 1))");
              echo "<script type='text/javascript'>alert('Successfully Created a Employee'); window.location = 'Employee.php';</script>";
            ?>