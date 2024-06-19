<?php
include'../includes/connection.php';
    $pass = $_POST["password"];
    $cpass = $_POST["cpassword"];
    $ids = $_POST["id"];
    if($pass == $cpass){
        $password = sha1($pass);
        $sql = "UPDATE users
        INNER JOIN employee ON users.EMPLOYEE_ID = employee.EMPLOYEE_ID
        SET users.code = 0, users.Status = 'Active', users.PASSWORD = '".$password."'
        WHERE users.ID = '".$ids."'";
        mysqli_query($db,$sql)or die ('Error in Database '.$sql);
        echo "<script type='text/javascript'>alert('Successfully Change Password.'); window.location = 'Login.php';</script>";
    }else{
        echo "<script type='text/javascript'>alert('Password are not match.'); window.location = 'Lresetpass.php';</script>";
    }
?>