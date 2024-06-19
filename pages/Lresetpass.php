<?php
include'../includes/connection.php';

$sql = "SELECT ID,code,e.FIRST_NAME,e.LAST_NAME,e.GENDER,e.EMAIL,e.PHONE_NUMBER,j.JOB_TITLE,l.PROVINCE,l.CITY,t.TYPE
        FROM  `users` u
        join `employee` e on e.EMPLOYEE_ID=u.EMPLOYEE_ID
        JOIN `location` l ON e.LOCATION_ID=l.LOCATION_ID
        join `job` j on e.JOB_ID=j.JOB_ID
        join `type` t ON t.TYPE_ID=u.TYPE_ID
        WHERE u.code='".$_POST['otp']."'";
        $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");
        if($row = mysqli_fetch_array($result)) {
            $id = $row["ID"];
        }else{
            echo "<script type='text/javascript'>alert('error.'); window.location = 'Lforgotpass.php';</script>";
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="Lnewpass.php" method="POST" autocomplete="off">
                    <h2 class="text-center">New Password</h2>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>